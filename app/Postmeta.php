<?php

namespace App;

use App\Scopes\PostmetaScope;
use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{

    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table="wp_postmeta";
    protected $primaryKey = "meta_id";

    public function post() {
        return $this->belongsTo(Post::class, 'post_id', 'ID');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PostmetaScope());
    }

}
