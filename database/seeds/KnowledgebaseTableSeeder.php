<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgebaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $post_id = DB::table('wp_posts')->insertGetId([
            'post_title'            => "Eugene's Second KB by Code",
            'post_name'             => "eugenes-first-kb-by-code",
            'post_content'          => "Hello World!",
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

        $category_term_id = DB::table('wp_terms')->insertGetId([
            'name' => "Programming Category",
            'slug' => "programming-category",
        ]);

        $term_taxonomy_id = DB::table('wp_term_taxonomy')->insertGetId([
            'term_id'     => $category_term_id,
            'taxonomy'    => "knowledgebase_categories",
            'description' => "",
        ]);

        DB::table('wp_term_relationships')->insert([
            'object_id'        => $post_id,
            'term_taxonomy_id' => $term_taxonomy_id,
        ]);

        $tag_term_id = DB::table('wp_terms')->insertGetId([
            'name' => "Linux",
            'slug' => "linux",
        ]);

        $term_taxonomy_id = DB::table('wp_term_taxonomy')->insertGetId([
            'term_id'     => $tag_term_id,
            'taxonomy'    => "knowledgebase_tags",
            'description' => "",
        ]);

        DB::table('wp_term_relationships')->insert([
            'object_id'        => $post_id,
            'term_taxonomy_id' => $term_taxonomy_id,
        ]);

        $tag_term_id = DB::table('wp_terms')->insertGetId([
            'name' => "WordPress",
            'slug' => "wordpress",
        ]);

        $term_taxonomy_id = DB::table('wp_term_taxonomy')->insertGetId([
            'term_id'     => $tag_term_id,
            'taxonomy'    => "knowledgebase_tags",
            'description' => "",
        ]);

        DB::table('wp_term_relationships')->insert([
            'object_id'        => $post_id,
            'term_taxonomy_id' => $term_taxonomy_id,
        ]);

    }
}
