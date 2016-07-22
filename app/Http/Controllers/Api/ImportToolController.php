<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\OpenPaymentsData;
use App\Models\Recipient;

/**
 *
 * Procedure api responsible for procedure functions
 *
 */
class ImportToolController extends Controller {

    /**
     * Default handler for route.
     * Performs the import
     */
    public function index() {


        // Removes all legacy data from table
        Recipient::getQuery()->delete();

        // Uses the OpenPaymentsData helper to import the doctrs
        $doctors = OpenPaymentsData::importDoctors();

        // Loop trough the doctors returned and savae them to the local DB
        foreach ($doctors as $doctor) {

            $new_doctor = new Recipient();
            $new_doctor->openpaymentsdata_reference_id = $doctor->physician_profile_id;
            $new_doctor->name = mb_convert_case(trim($doctor->physician_first_name . " " . $doctor->physician_last_name), MB_CASE_TITLE, "UTF-8");
            $new_doctor->type = "PROVIDER";
            $new_doctor->total_number_of_transactions = $doctor->transactions;

            // Saves the doctor to the local DB
            $new_doctor->save();
        }

        // Uses the OpenPaymentsData helper to import the providers
        $providers = OpenPaymentsData::importHealthProviders();

        // Loop trough the providers returned and savae them to the local DB
        foreach ($providers as $provider) {

            $new_provider = new Recipient();
            $new_provider->openpaymentsdata_reference_id = $provider->teaching_hospital_id;
            $new_provider->name = mb_convert_case(trim($provider->teaching_hospital_name), MB_CASE_TITLE, "UTF-8");
            $new_provider->type = "HOSPITAL";
            $new_provider->total_number_of_transactions = $provider->transactions;

            // Saves the provider to the local DB
            $new_provider->save();
        }

        return response()->json(['success' => 'true', 'message' => 'Data Successfully Imported.']);
    }

}
