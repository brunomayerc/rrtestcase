<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipient extends Model {

    /**
     * Laravel config: Table name in the database
     *
     * @var string
     */
    protected $table = 'openpaymentsdata_recipient';

    /**
     * Recipient type for Providers (Doctors)
     *
     * @var string
     */
    const PROVIDER = "Covered Recipient Physician";

    /**
     * Recipient type for Health Providers (Hospitals)
     *
     * @var string
     */
    const HOSPITAL = "Covered Recipient Teaching Hospital";

    /**
     * Type Ahead.
     *
     * Function that provides the info for the type ahead functionality.
     *     
     * @param  string $search_term The value entered by the user that is used to filter the type ahead info.
     * @return stdClass            Array of objects with the query results.
     */
    public static function typeahed($search_term) {
        // Uses the raw query builder to return a standard object instead of the entire Recipient class
        return DB::select("SELECT DISTINCT name FROM openpaymentsdata_recipient WHERE name LIKE '%{$search_term}%'");
    }

    /**
     * Search.
     *
     * Function that searches recipients.
     *     
     * @param  string $search_term The value entered by the user that is used to filter the search.
     * @return stdClass            Array of objects with the query results.
     */
    public static function search($search_term) {

        return parent::select('openpaymentsdata_reference_id', 'name', 'type')->distinct()->where('name', 'like', '%' . $search_term . '%')->orderBy('name', 'ASC')->get();
    }

}
