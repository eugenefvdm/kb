<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const UPDATED_AT = null;
    protected $table="wp_posts";

    protected $primaryKey = "ID";

    protected $casts = ['post_date' => 'datetime'];

    public function attributes() {
        return $this->hasMany(Attribute::class, 'post_id', 'ID');
    }
}
