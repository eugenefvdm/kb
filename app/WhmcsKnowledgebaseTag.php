<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhmcsKnowledgebaseTag extends Model
{
    protected $connection= 'whmcs';
    protected $table="tblknowledgebasetags";

    public function article() {
        return $this->belongsTo(WhmcsKnowledgebaseArticle::class, 'article_id');
    }
}
