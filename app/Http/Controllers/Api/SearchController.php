<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipient;

/**
 *
 * Procedure api responsible for procedure functions
 *
 */
class SearchController extends Controller {

    /**
     * Default handler for the typeahed route.]
     * 
     * @return JSON Array of objects with the typeahead results.
     */
    public function typeahead() {

        // Retrieve search term entered by user
        $search_term = \Request::input("query", "");

        // Prepares the typeahead base results based on the query entered
        $typeahead_results = Recipient::typeahed($search_term);

        // Formats the results as a JSON object
        return response()->json($typeahead_results);
    }

    /**
     * Default handler for the search route.
     * 
     * @return JSON Array of objects with the search results.
     */
    public function search() {

        // Retrieve search term entered by user
        $search_term = \Request::input("query", "");

        // Retrieves the recipients based on the search term
        $results = Recipient::search($search_term);

        // Formats the results as a JSON object
        return response()->json($results);
    }

}
