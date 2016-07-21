<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipient extends Model {

    // Table name
    protected $table = 'openpaymentsdata_recipient';

    public static function deleteDoctors() {
        //parent::where("type", 'HOSPITAL')->delete();
    }

    public static function deleteProviders() {
        //parent::where("type", 'PROVIDER')->delete();
    }

    public static function typeahed($search_term) {
        // Uses the raw query builder to return a standard object instead of the entire Recipient class
        return DB::select("SELECT DISTINCT name FROM openpaymentsdata_recipient WHERE name LIKE '%{$search_term}%'");
    }

    public static function search($search_term) {

        return parent::where('name', 'like', '%' . $search_term . '%')->orderBy('name', 'ASC')->get();
    }

}
