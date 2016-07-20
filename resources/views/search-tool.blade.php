@extends("layouts.master")

@section("view-content")

<div class="row">
    <div class="page-header">
        <h2>
            Payment Search
            <small>
                research your physician's financial relationships with health care companies
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
                    <input type="text" class="form-control" autocomplete="off" name="search-term" id="search-term" placeholder="Ex.: 'Mount Sinai' or 'John Smith'">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            Search
                        </button>
                    </span>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="row hide">
    <div class="col-md-12">
        <div class="panel panel-default search-results">
            <!-- Default panel contents -->
            <div class="panel-heading">Search Results</div>

            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">John Smith</li>
                <li class="list-group-item">Mount Sinai</li>
            </ul>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">

    </div>
</div>
@endsection

@section("page_specific_js")
    @parent
    <script src="{{ URL::asset('assets/js/vendor/bootstrap-typeahead.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/search-tool.js') }}"></script>
@endsection