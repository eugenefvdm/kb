<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class WhmcsKnowledgebaseLink extends Pivot
{
    protected $connection= 'whmcs';
    protected $table="tblknowledgebaselinks";
}
