<?php

namespace App;

use App\Scopes\TagScope;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table="wp_terms";

    protected $primaryKey = "term_id";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TagScope);
    }

    public function post()
    {
        return $this->belongsToMany(
            'App\Post',
            'wp_term_relationships',
            'term_taxonomy_id',
            'object_id'
        );
    }

}
