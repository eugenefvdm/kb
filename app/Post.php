<?php

namespace App;

use App\Scopes\KnowledgebaseScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = "wp_posts";
    protected $primaryKey = "ID";
    protected $guarded = [];

    protected $casts = [
        'post_date'         => 'datetime',
        'post_date_gmt'     => 'datetime',
        'post_modified'     => 'datetime',
        'post_modified_gmt' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new KnowledgebaseScope);
    }

    public function post_metas()
    {
        return $this->hasMany(Postmeta::class, 'post_id', 'ID');
    }

    public function category()
    {
        return $this->belongsToMany(
            'App\Category',
            'wp_term_relationships',
            'object_id',
            'term_taxonomy_id'
        );
    }

    public function tags()
    {
        return $this->belongsToMany(
            'App\Tag',
            'wp_term_relationships',
            'object_id',
            'term_taxonomy_id'
        );
    }
}
