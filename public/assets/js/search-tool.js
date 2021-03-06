/* 
 * This script contains all functionality for the Search Tool.
 */

$(document).ready(function () {

    // Binds the API call to the import data button
    $('#txt-search-term').typeahead({
        ajax: {
            url: app_url + '/api/search/typeahead'
        },
        onSelect: function (item) {
            // This is called when the user clicks on a type ahead item
            performSearch(item.text);
        }
    });

    // Binds the search functionality to the search button
    $('#btn-search').click(performSearch);

});

/**
 * @summary 
 * 
 * Function that connects to the RESTful api and performs the search in the local db.
 *
 * @return void this function does not return any data.
 */
function performSearch(searchTerm) {

    $.ajax({
        type: "POST",
        url: app_url + "/api/search",
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

                    // Binds the click event to the transactions button
                    template.find("button").
                            attr("data-openpaymentsdata_reference_id", response[recipient].openpaymentsdata_reference_id).
                            attr("data-type", response[recipient].type).
                            click(function () {
                                viewTransactions($(this).attr("data-openpaymentsdata_reference_id"), $(this).attr("data-type"));
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

    // Closes other transactions that are oppen
    $("div.recipient-transactions").slideUp("fast");

    // Loads the transactions based on the recipient id
    $.ajax({
        type: "POST",
        url: app_url + "/transactions",
        beforeSend: function (request)
        {
            request.setRequestHeader("X-CSRF-Token", $("#_token").val());
        },
        data: {
            recipient_id: recipient_id,
            recipient_type: type
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
            renderChart(recipient_id);

            // Resets the transaction button to its normal state
            recipient_row.find("button").button('reset');

            // Slides down the transactions
            recipient_row.find("div.recipient-transactions").slideDown();

        }
    });

}

/**
 * @summary 
 * 
 * Function that renders the Breakdown Chart for a recipient.
 *
 * @param int recipient_id The unique identifier of the Recipient
 */
function renderChart(recipient_id) {

    // Formats the chart data before rendering the chart
    var chartData = JSON.parse($("#charts_data_" + recipient_id).val());
    var dataPoints = [];
    for (var name in chartData) {
        dataPoints.push({
            y: Math.round(chartData[name]),
            amount: parseFloat(chartData[name]),
            name: name
        });
    }

    // Renders the chart
    var chart = new CanvasJS.Chart("chart_container_" + recipient_id,
            {
                theme: "theme2",
                title: {
                    text: "Breakdown by Provider Name"
                },
                data: [
                    {
                        type: "pie",
                        startAngle: 0,
                        toolTipContent: "{name}: ${amount}",
                        showInLegend: true,
                        indexLabel: "#percent%",
                        percentFormatString: "#0",
                        dataPoints: dataPoints
                    }
                ]
            });
    chart.render();

}