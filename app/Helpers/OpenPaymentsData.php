<?php

namespace App\Helpers;

use App\Models\Recipient;

/**
 *
 * Custom helper class with some useful generic functions
 *
 */
class OpenPaymentsData {

    // OpenPaymentsData API endpoint
    CONST API_ENDPOINT = "https://openpaymentsdata.cms.gov/resource/tf25-5jad.json";
    // OpenPaymentsData App specific token
    CONST API_TOKEN = "NrPCd7oOVsga9x4cA1CsA20wd";
    // Limit records per API request
    CONST LIMIT_PER_REQUEST = "5000";

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

    public static function importDoctors() {

        $type = Recipient::PROVIDER;
        $columns = "physician_profile_id, physician_first_name,physician_last_name, count(*) as transactions";
        $group_by = "physician_profile_id, physician_first_name,physician_last_name";

        $doctors = OpenPaymentsData::connectAndRetrieve($type, false, $columns, $group_by);

        return $doctors;
    }

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
