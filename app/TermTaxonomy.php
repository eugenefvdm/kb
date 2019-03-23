<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{

    const UPDATED_AT = null;

    protected $table="wp_term_taxonomy";
    protected $primaryKey="term_taxonomy_id";

}
