/* 
 * This script contains all functionality for the Search Tool.
 */

$(document).ready(function () {

    // Binds the API call to the import data button
    $('#search-term').typeahead({
        ajax: {
            url: '/api/typeahead'
        }
    });

});