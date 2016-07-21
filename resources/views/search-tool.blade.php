@extends("layouts.master")

@section("view-content")

<div class="row">
    <div class="page-header">
        <h2>
            Payment Search<br/>
            <small>
                Research physician's financial relationships with health care companies.
            </small>
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form>
            <div class="form-group">
                <label for="search-term">Search by physician or hospital name:</label>
                <div class="input-group">
                    <input type="text" class="form-control" autocomplete="off" name="txt-search-term" id="txt-search-term" placeholder="Ex.: 'Mount Sinai' or 'John Smith'">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary" id="btn-search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            Search
                        </button>
                    </span>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="row ">
    <div class="col-md-12">
        <div class="panel panel-primary search-results">
            <!-- Default panel contents -->
            <div class="panel-heading">
                Search Results: 
            </div>

            <!-- List group -->
            <div class="list-group" id="search_results">
                <div href="#" class="list-group-item" >
                    <i class="fa fa-hospital-o fa-2x" aria-hidden="true"></i>
                    <span class="recipient_name">Bruno Couras</span>
                    <button type="button" class="btn btn-info btn-xs pull-right">
                        Transactions
                    </button>
                    <div class="recipient-transactions">
                        <br/>
                        @include("transactions")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Template for result search row --}}
<div id="result_row_template" class="hide">
    <div href="#" class="list-group-item" >
        <i class="fa fa-2x" aria-hidden="true"></i>
        <span class="recipient_name">Bruno Couras</span>
        <button type="button" class="btn btn-info btn-xs pull-right">
            Transactions
        </button>
        <div class="recipient-transactions"></div>
    </div>
</div>

@endsection

@section("page_specific_js")
@parent
<script src="{{ URL::asset('assets/js/vendor/bootstrap-typeahead.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/vendor/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/search-tool.js') }}"></script>
@endsection