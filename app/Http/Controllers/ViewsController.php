<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\OpenPaymentsData;

class ViewsController extends Controller {

    /**
     * Route for index page.
     *     
      \     * @return Laravel View.
     */
    public function index() {

        return view("index");
    }

    /**
     * Route for the search tool page.
     *     
     * @return Laravel View.
     */
    public function search() {

        return view("search-tool");
    }

    /**
     * Route for the transactions view that is loaded by the search tool view.
     *     
     * @param  int    $recipient_id   The unique id of the recipient to which load the transactions for.
     * @param  string $recipient_type The type of the recipient to which load the transactions for (see App\Models\Recipient). 
     * @return Laravel View.
     */
    public function transactions() {

        // Retrieves the recipient id from the POST
        $recipient_id = \Request::input("recipient_id", "");

        // Retrieves the recipient type from the POST
        $recipient_type = \Request::input("recipient_type", "");

        // Uses the OpenPaymentsData helper to retrieve the latest transactions based on the criteria
        $transactions = OpenPaymentsData::retrieveTransactions($recipient_type, $recipient_id);

        // Prepares the data that will be used to render the BREAKDOWN CHART in this view
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
