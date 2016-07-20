<?php

namespace App\Helpers;

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

    public static function importData($type, $columns, $group_by) {

        // Basic import options
        $importOptions = array(
            "$\$app_token" => OpenPaymentsData::API_TOKEN,
            "\$offset" => "0",
            "\$limit" => OpenPaymentsData::LIMIT_PER_REQUEST
        );

        // Adds the type of users being imported
        $importOptions["covered_recipient_type"] = $type;

        // Adds the columns being imported
        $importOptions["\$select"] = $columns;

        // Adds the group by criteria
        $importOptions["\$group"] = $group_by;

        // Connects to the OpenPaymentsData API End point and retrieves the data based on the criteria
        $response = \Curl::to(OpenPaymentsData::API_ENDPOINT)->withData($importOptions)->get();

        // Returns the JSON returned by the API call
        return json_decode($response);
    }

    public static function importDoctors() {

        $type = "Covered Recipient Physician";
        $columns = "physician_profile_id, physician_first_name,physician_last_name, count(*) as transactions";
        $group_by = "physician_profile_id, physician_first_name,physician_last_name";

        $doctors = OpenPaymentsData::importData($type, $columns, $group_by);
        
        return $doctors;
        
    }

    public static function importHealthProviders() {

        $type = "Covered Recipient Teaching Hospital";
        $columns = "teaching_hospital_id, teaching_hospital_name, count(*) as transactions";
        $group_by = "teaching_hospital_id, teaching_hospital_name";

        $providers = OpenPaymentsData::importData($type, $columns, $group_by);
        
        return $providers;
        
    }

}
