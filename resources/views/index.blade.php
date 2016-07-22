@extends("layouts.master")

@section("view-content")
<div class="row">
    <div class="page-header">
        <h2>
            Reorg Reseach Test Case<br/>
            <small>
                About the application
            </small>
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3>1. Frameworks I used?</h3>
        <p>
            Laravel, Bootstrap 3, JQuery, CanvasJS, DataTables
        </p>
        <br/>
        <h3>2. The application:</h3>
        <p>
            So the basic idea behind the application as a whole is as follows:

        <ul>
            <li>
                Instead of download the entire ~13 million records from the openpaymentsdata.cms.gov I took a different approach.
                <br/>
                My idea was not to import all the transactions, but instead, use the power of the <b>openpaymentsdata</b> to my favor.
                I used their query builder to retrieve only unique <b>Doctor Names</b> and <b>Hospital Names</b>, and that information is the only thing I store locally.
                I did that, building this application to focus on people searching for specific Doctors and Hospitals financial relationships.
            </li>
            <li>
                That approach allowed me to store only necessary data locally and not entire transactions that would take a huge amount of time to import and to store in the servers. The idea here was to save cost and store only the necessary info.
            </li>
            <li>
                But what about the transactions?
                <br/>
                That's the beauty of this approach, the transactions are never stored locally, and are retrieved using the <b>openpaymentsdata</b> API on a per Doctor/Hospital basis, ensuring the accuracy of the data since you are always retrieving the latest info on the specific Doctor/Hospital. 
            </li>
            <li>
                The transactions are displayed in a <i>Smart Table</i>, allowing the user to search specific transactions and even order them.
            </li>
            <li>
                I also included a Pie Chart for every Doctor/Hospital that is created dynamically every time transactions are retrieved. The chart compiles all the payments by payer, given the user a better idea of where the money is going to/coming from.
            </li>
        </ul>

        <br/>
        <h3>3. How to use it:</h3>
        <ul>
            <li>
                <b>1. </b>Use the Import Data Tool to connect to the <b>openpaymentsdata</b> and import Doctor/Hospital names and unique identifiers.
                <br/>
                P.s. There is a setting in the App\Helpers\OpenPaymentsData where you can change the number of Doctor/Hospital that will be imported from the <b>openpaymentsdata</b> database.
            </li>
            <li>
                <b>2. </b>Go to the <a href="<?= env("APP_URL")?>/search">Search Tool</a> and use the search input with <b>Type Ahead</b> to find a doctor or hospital that you wish to view transactions from.
            </li>
            <li>
                <b>3. </b> In the results box, just click in the <b>Transactions</b> button for a Doctor/Hospital and and API call will be made to retrieve all the data for that Doctor/Hospital from the <b>openpaymentsdata</b>.
                <br/>
                Now you are ready to research all transactions as well as visualize a transactions chart breakdown.
            </li>
        </ul>
        <br/>
    </div>
</div>
@endsection