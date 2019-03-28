<?php

namespace App\Console\Commands;

use App\Post;
use App\WhmcsKnowledgebaseArticle;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KnowledgebaseMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whmcs:migrate-kb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Knowledgebase articles, categories, and tags from WHMCS to WordPress';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

//        DB::table('wp_posts')->truncate();
//        DB::table('wp_terms')->truncate();
//        DB::table('wp_term_taxonomy')->truncate();
//        DB::table('wp_term_relationships')->truncate();
//        DB::table('wp_post_views')->truncate();

        $categories = [];
        $tags       = [];
        foreach (WhmcsKnowledgebaseArticle::all() as $kb) {
            echo "Article: " . $kb->title . "\n";
            $post = Post::create([
                'post_title'            => $kb->title,
                'post_name'             => Str::slug($kb->title),
                'post_content'          => $kb->article,
                'post_type'             => "knowledgebase",
                'post_excerpt'          => "",
                'to_ping'               => "",
                'pinged'                => "",
                'post_content_filtered' => "",
                'post_date'             => now(),
                'post_date_gmt'         => now(),
                'post_modified'         => now(),
                'post_modified_gmt'     => now(),
            ]);

            // Only insert category if it doesn't already exist
            if (!in_array($kb->category[0]->name, $categories)) {
                echo "\tCategory: " . $kb->category[0]->name . "\n";
                $categories[]     = $kb->category[0]->name;
                $category_term_id = DB::table('wp_terms')->insertGetId([
                    'name' => $kb->category[0]->name,
                    'slug' => Str::slug($kb->category[0]->name),

                ]);
                $term_taxonomy_id_for_categories = DB::table('wp_term_taxonomy')->insertGetId([
                    'term_id'     => $category_term_id,
                    'taxonomy'    => "knowledgebase_categories",
                    'description' => $kb->category[0]->description,
                ]);
            } else {
                $category_term_id = DB::table('wp_terms')->where('name', $kb->category[0]->name)->first()->term_id;
                $term_taxonomy_id_for_categories = DB::table('wp_term_taxonomy')->where('term_id', $category_term_id)->first()->term_taxonomy_id;
            }

            echo "\t\t\t Article Post ID" . $post->ID . "\n";;

            DB::table('wp_term_relationships')->insert([
                'object_id'        => $post->ID,
                'term_taxonomy_id' => $term_taxonomy_id_for_categories,
            ]);

            foreach ($kb->tags as $tag) {
                // Only insert tag if it doesn't already exist
                if (!in_array($tag->tag, $tags)) {
                    echo "\t\tTag: " . $tag->tag . "\n";
                    $tags[]     = $tag->tag;
                    $tag_term_id = DB::table('wp_terms')->insertGetId([
                        'name' => $tag->tag,
                        'slug' => Str::slug($tag->tag),

                    ]);
                    $term_taxonomy_id = DB::table('wp_term_taxonomy')->insertGetId([
                        'term_id'     => $tag_term_id,
                        'taxonomy'    => "knowledgebase_tags",
                        'description' => "",
                    ]);
                } else {
                    $tag_term_id = DB::table('wp_terms')->where('name', $tag->tag)->first()->term_id;
                    $term_taxonomy_id = DB::table('wp_term_taxonomy')->where('term_id', $tag_term_id)->first()->term_taxonomy_id;
                }

                echo "\t\t\tArticle  #2Post ID" . $post->ID  . "\n";

                DB::table('wp_term_relationships')->insert([
                    'object_id'        => $post->ID,
                    'term_taxonomy_id' => $term_taxonomy_id,
                ]);
            }

            Db::table('wp_post_views')->insert([
                'id'     => $post->ID,
                'type'   => 4,
                'period' => 'total',
                'count'  => $kb->views
            ]);

        }
    }
}
