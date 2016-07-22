<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipient extends Model {

    // Table name
    protected $table = 'openpaymentsdata_recipient';

    // Recipient types
    const PROVIDER = "Covered Recipient Physician";
    const HOSPITAL = "Covered Recipient Teaching Hospital";
    
    public static function typeahed($search_term) {
        // Uses the raw query builder to return a standard object instead of the entire Recipient class
        return DB::select("SELECT DISTINCT name FROM openpaymentsdata_recipient WHERE name LIKE '%{$search_term}%'");
    }

    public static function search($search_term) {

        return parent::select('openpaymentsdata_reference_id', 'name', 'type')->distinct()->where('name', 'like', '%' . $search_term . '%')->orderBy('name', 'ASC')->get();
    }

}
