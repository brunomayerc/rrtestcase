<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="{{ URL::asset('assets/img/logo.png') }}">
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @if(\Request::route()->getName() == "home") class="active" @endif>
                    <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li @if(\Request::route()->getName() == "search") class="active" @endif>
                    <a href="/search"><i class="fa fa-search" aria-hidden="true"></i> Payment Search Tool</a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#sync-tool-modal"><i class="fa fa-cloud-download" aria-hidden="true"></i> Import Data Tool</a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>