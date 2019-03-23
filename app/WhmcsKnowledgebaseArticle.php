<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhmcsKnowledgebaseArticle extends Model
{
    protected $connection = 'whmcs';
    protected $table = "tblknowledgebase";

    public function category()
    {
        return $this->belongsToMany(
            'App\WhmcsKnowledgebaseCategory',
            'tblknowledgebaselinks',
            'articleid',
            'categoryid'
        );
    }

    public function tags()
    {
        return $this->hasMany(WhmcsKnowledgebaseTag::class, 'articleid');
    }
}
