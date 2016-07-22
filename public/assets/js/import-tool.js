/* 
 * This script contains all functionality for the Import Data Tool.
 */

$(document).ready(function () {

    // Binds the API call to the import data button
    $("#btn_importData").click(importData);

});

/**
 * @summary 
 * 
 * Function that connects to the RESTful api and imports the data.
 *
 * @access public
 * @return void this function does not return any data.
 */
function importData() {

    // Import doctors first
    waitingDialog.show('Importing Data from OpenPaymentsData...<br/>Please wait.', {progressType: 'info', progress: "100%"});

    $.ajax({
        type: "POST",
        beforeSend: function (request)
        {
            request.setRequestHeader("X-CSRF-Token", $("#_token").val());
        },
        url: "/api/import",
        data: {},
        async: true,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error', jqXHR);
            waitingDialog.show('Oops! Something Went Wrong!<br/>Please try again later.', {progressType: 'danger', progress: "100%", showClose: true});
        },
        success: function (response) {
            // If success shows success message
            waitingDialog.show('All Data Imported Successfully!', {progressType: 'success', progress: "100%", showClose: true});

        }
    });

}