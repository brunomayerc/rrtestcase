<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\OpenPaymentsData;

class ViewsController extends Controller {

    public function index() {

        return view("index");
    }

    public function search() {

        return view("search-tool");
    }

    public function transactions() {

        // Retrieves the recipient id
        $recipient_id = \Request::input("recipient_id", "");

        // Retrieves the recipient type
        $recipient_type = \Request::input("recipient_type", "");

        // Connects to the open payments seerver and retrieves the latest transactions
        $transactions = OpenPaymentsData::retrieveTransactions($recipient_type, $recipient_id);

        // Prepares the chart info
        $chartData = array();
        foreach ($transactions as $transaction) {

            if (key_exists($transaction->applicable_manufacturer_or_applicable_gpo_making_payment_name, $chartData)) {
                // first transaction from the payer
                $chartData[$transaction->applicable_manufacturer_or_applicable_gpo_making_payment_name] += $transaction->total_amount_of_payment_usdollars;
            } else {
                // Accumulates with previous transactions from the payer
                $chartData[$transaction->applicable_manufacturer_or_applicable_gpo_making_payment_name] = $transaction->total_amount_of_payment_usdollars;
            }
        }

        // Renders the view with all the transactions
        return view("transactions", [
            "transactions" => $transactions,
            "chartData" => json_encode($chartData),
            "recipient_type" => constant("App\Models\Recipient::$recipient_type"),
            "recipient_id" => $recipient_id
        ]);
    }

}
