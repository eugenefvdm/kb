<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    const UPDATED_AT = null;

    protected $table="wp_postmeta";
    protected $primaryKey = "meta_id";

    public function post() {
        return $this->belongsTo(Post::class, 'post_id', 'ID');
    }
}
