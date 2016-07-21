/* 
 * This script contains all functionality for the Search Tool.
 */

$(document).ready(function () {

    // Binds the API call to the import data button
    $('#txt-search-term').typeahead({
        ajax: {
            url: '/api/search/typeahead'
        },
        onSelect: function (item) {
            // This is called when the user clicks on a type ahead item
            performSearch(item.text);
        }
    });

    // Binds the search functionality to the search button
    $('#btn-search').click(performSearch);
    
    // Formats the table
    $('#example').DataTable();

});

// Function that performs the search
function performSearch(searchTerm) {

    $.ajax({
        type: "POST",
        url: "/api/search",
        beforeSend: function (request)
        {
            request.setRequestHeader("X-CSRF-Token", $("#_token").val());
        },
        data: {
            query: (typeof searchTerm === 'string') ? searchTerm : $('#txt-search-term').val()
        },
        async: true,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error', jqXHR);
            alert('Error', 'Error: ' + textStatus + " - " + errorThrown);
        },
        success: function (response) {

            // If results adds them to the screen
            if (response.length > 0) {

                // Clears the current results
                $("#search_results").empty();

                // Loops trough the recipients
                for (var recipient in response) {

                    // Gets the result row template
                    var template = $("#result_row_template > div").clone();

                    // Adds the custom properties and values to the template
                    template.attr("id", "recipient_" + response[recipient].openpaymentsdata_reference_id);
                    template.find(".recipient_name").html(response[recipient].name);
                    if (response[recipient].type == "HOSPITAL") {
                        // Hospital badge
                        template.find("i").addClass("fa-hospital-o");
                    } else {
                        // Physician badge
                        template.find("i").addClass("fa-user-md");
                    }

                    // Binds the view transactions to the element
                    template.click(function () {
                        viewTransactions(response[recipient].openpaymentsdata_reference_id, response[recipient].type);
                    });

                    // Adds the template to the view
                    $("#search_results").append(template);

                }

            } else {
                // Not found
            }
        }
    });
}

function viewTransactions(recipient_id, type) {
    alert(recipient_id + " " + type);
}