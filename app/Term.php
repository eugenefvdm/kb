<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{

    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table="wp_terms";

    protected $primaryKey = "term_id";

}
