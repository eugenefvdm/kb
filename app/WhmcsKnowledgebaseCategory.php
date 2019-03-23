<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhmcsKnowledgebaseCategory extends Model
{
    protected $connection = 'whmcs';
    protected $table = "tblknowledgebasecats";

    public function articles()
    {
        return $this->belongsToMany(
            'App\WhmcsKnowledgebaseArticle',
            'tblknowledgebaselinks',
            'categoryid',
            'articleid'
        );
    }

}
