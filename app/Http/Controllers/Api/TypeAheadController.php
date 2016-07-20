<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipient;

/**
 *
 * Procedure api responsible for procedure functions
 *
 */
class TypeAheadController extends Controller {

    /**
     * Default handler for route.
     * Performs the type ahead search
     */
    public function index() {
        
        // Retrieve search term entered by user
        $search_term = \Request::input("query", "");
        
        // Prepares the typeahead base results based on the query entered
        $typeahead_results = Recipient::typeahed($search_term);
        
        
               
        return response()->json($typeahead_results);
    }

}
