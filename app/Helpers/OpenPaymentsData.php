<?php

namespace App\Helpers;

use App\Models\Recipient;

/**
 *
 * Custom helper class with some useful generic functions
 *
 */
class OpenPaymentsData {

    /**
     * OpenPaymentsData API endpoint.
     *
     * @var string
     */
    CONST API_ENDPOINT = "https://openpaymentsdata.cms.gov/resource/tf25-5jad.json";

    /**
     * OpenPaymentsData App specific token.
     *
     * @var string
     */
    CONST API_TOKEN = "NrPCd7oOVsga9x4cA1CsA20wd";

    /**
     * Limit records per API request.
     *
     * @var string
     */
    CONST LIMIT_PER_REQUEST = "5000";

    /**
     * Connect to OpenPaymentsData.
     *
     * Functiion that connects to the OpenPaymentsData endpoint.
     *     
     * @param string $type         the user type (see App\Models\Recipient).
     * @param int    $recipient_id Optional. The unique itentifier for the provide.
     * @param array  $columns      Optional. The unique itentifier for the provide.
     * @param array  $group_by     Optional. The unique itentifier for the provide.
     * @return stdClass            Array of objects with the results from the OpenPaymentsData.
     */
    public static function connectAndRetrieve($type, $recipient_id = false, $columns = false, $group_by = false) {

        // Basic import options
        $importOptions = array(
            "$\$app_token" => OpenPaymentsData::API_TOKEN,
            "\$offset" => "0",
            "\$limit" => OpenPaymentsData::LIMIT_PER_REQUEST
        );

        // Adds the type of users being imported
        $importOptions["covered_recipient_type"] = $type;

        // Adds the recipient id based on the type
        if ($recipient_id) {
            if ($type == "Covered Recipient Physician") {
                $importOptions["physician_profile_id"] = $recipient_id;
            } else {
                $importOptions["teaching_hospital_id"] = $recipient_id;
            }
        }

        // Adds the columns being imported
        if ($columns) {
            $importOptions["\$select"] = $columns;
        }

        // Adds the group by criteria
        if ($group_by) {
            $importOptions["\$group"] = $group_by;
        }

        // Connects to the OpenPaymentsData API End point and retrieves the data based on the criteria
        $response = \Curl::to(OpenPaymentsData::API_ENDPOINT)->withData($importOptions)->get();

        // Returns the JSON returned by the API call
        return json_decode($response);
    }

    /**
     * Imports Doctors.
     *
     * Import Doctors from the OpenPaymentsData data pool.
     *     
     * @return stdClass Array of objects with the results from the OpenPaymentsData.
     */
    public static function importDoctors() {

        $type = Recipient::PROVIDER;
        $columns = "physician_profile_id, physician_first_name,physician_last_name, count(*) as transactions";
        $group_by = "physician_profile_id, physician_first_name,physician_last_name";

        $doctors = OpenPaymentsData::connectAndRetrieve($type, false, $columns, $group_by);

        return $doctors;
    }

    /**
     * Imports Health Providers (Hospitals).
     *
     * Import Health Providers (Hospitals) from the OpenPaymentsData data pool.
     *     
     * @return stdClass Array of objects with the results from the OpenPaymentsData.
     */
    public static function importHealthProviders() {

        $type = Recipient::HOSPITAL;
        $columns = "teaching_hospital_id, teaching_hospital_name, count(*) as transactions";
        $group_by = "teaching_hospital_id, teaching_hospital_name";

        $providers = OpenPaymentsData::connectAndRetrieve($type, false, $columns, $group_by);

        return $providers;
    }

    public static function retrieveTransactions($recipient_type, $recipient_id) {

        $transactions = OpenPaymentsData::connectAndRetrieve(constant("App\Models\Recipient::$recipient_type"), $recipient_id);

        return $transactions;
    }

}
