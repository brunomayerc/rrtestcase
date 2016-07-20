<div class="modal fade" tabindex="-1" role="dialog" id="sync-tool-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Import Data Tool</h4>
            </div>
            <div class="modal-body">
                <p>
                    Use this tool to sync this application with the latest data from the <b>Open Payments</b> platform.
                </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-info" id="btn_importData" data-dismiss="modal">
                    <i class="fa fa-cloud-download" aria-hidden="true"></i> Import Data
                </button>
            </div>
        </div>
    </div>
</div>

@section("page_specific_js")
    <script src="{{ URL::asset('assets/js/import-tool.js') }}"></script>
@endsection