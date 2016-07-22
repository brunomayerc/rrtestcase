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
                    template.find("button").click(function () {
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

    // Pointer to the recipient row
    var recipient_row = $("#recipient_" + recipient_id);

    // Shows the loading
    recipient_row.find("button").button('loading');

    // Loads the transactions based on the recipient id
    $.ajax({
        type: "POST",
        url: "transactions",
        beforeSend: function (request)
        {
            request.setRequestHeader("X-CSRF-Token", $("#_token").val());
        },
        data: {
            recipient_id: recipient_id,
            type: type
        },
        async: true,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error', jqXHR);
            alert('Error', 'Error: ' + textStatus + " - " + errorThrown);
        },
        success: function (response) {

            // Adds the transactions view to the recipient row
            recipient_row.find("div.recipient-transactions").html(response);

            // Renders the transactions Tables
            recipient_row.find("table").DataTable();

            // Renders the chart
            renderChart();

            // Resets the transaction button to its normal state
            recipient_row.find("button").button('reset');

            // Slides down the transactions
            recipient_row.find("div.recipient-transactions").slideDown();

        }
    });

}

function renderChart() {
    var chart = new CanvasJS.Chart("chartContainer",
            {
                theme: "theme2",
                title: {
                    text: "Money Received in 2015"
                },
                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{y} - #percent %",
                        yValueFormatString: "#0.#,,. Million",
                        legendText: "{indexLabel}",
                        dataPoints: [
                            {y: 4181563, indexLabel: "PlayStation 3"},
                            {y: 2175498, indexLabel: "Wii"},
                            {y: 3125844, indexLabel: "Xbox 360"},
                            {y: 1176121, indexLabel: "Nintendo DS"},
                            {y: 1727161, indexLabel: "PSP"},
                            {y: 4303364, indexLabel: "Nintendo 3DS"},
                            {y: 1717786, indexLabel: "PS Vita"}
                        ]
                    }
                ]
            });
    chart.render();

}