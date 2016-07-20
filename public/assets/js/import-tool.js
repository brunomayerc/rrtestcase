/* 
 * This script contains all functionality for the Import Data Tool.
 */

$(document).ready(function () {

    // Binds the API call to the import data button
    $("#btn_importData").click(performImportData);

});

/**
 * @summary 
 * 
 * Function that connects to the RESTful api and starts the import data.
 *
 * @access public
 * @return void this function does not return any data.
 */
function performImportData() {

    // Import doctors first
    waitingDialog.show('Importing Doctors...', {progressType: 'info', progress: "35%"});
    importDoctors(function () {
        // After the import of doctors is complete, imports providers
        waitingDialog.show('Importing Hospitals...', {progress: "70%"});
        importProviders(function () {
            // Hides the loading screen
            waitingDialog.show('All Data Imported Successfully', {progressType: 'success', progress: "100%", showClose: true});
        });
    });



}

function importDoctors(callback) {
    // Simple post to the API that performs the import
    $.ajax({
        type: "POST",
        beforeSend: function (request)
        {
            request.setRequestHeader("X-CSRF-Token", $("#_token").val());
        },
        url: "/api/importdocs",
        data: {},
        async: true,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error', jqXHR);
            alert('Error', 'Error: ' + textStatus + " - " + errorThrown);
        },
        success: function (response) {
            // If success
            callback();
        }
    });
}

function importProviders(callback) {
    // Simple post to the API that performs the import
    $.ajax({
        type: "POST",
        beforeSend: function (request)
        {
            request.setRequestHeader("X-CSRF-Token", $("#_token").val());
        },
        url: "/api/importprov",
        data: {},
        async: true,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error', jqXHR);
            alert('Error', 'Error: ' + textStatus + " - " + errorThrown);
        },
        success: function (response) {
            // If success
            callback();
        }
    });
}
