<?php

namespace App;

use App\Scopes\CategoryScope;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const UPDATED_AT = null;
    
    protected $table="wp_terms";

    protected $primaryKey = "term_id";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CategoryScope);
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
