<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Case Study for Reorg Research">
        <meta name="author" content="Bruno Mayer Couras">

        <title>Reorg Research - Case Study</title>

        <!-- Reorgs Favicon -->
        <link rel="shortcut icon" href="/favicon_r.ico" />
        <link rel="icon" href="favicon.png" type="image/png">

        <!-- Bootstrap Core CSS -->
        <link href="{{ URL::asset('assets/css/vendor/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Font-Awesome Core CSS -->
        <link href="{{ URL::asset('assets/css/vendor/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Data-Tables Core CSS -->
        <link href="{{ URL::asset('assets/css/vendor/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Application Custom CSS -->
        <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

        <!-- Application Custom Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Neuton:400,700,800,400italic' rel='stylesheet' type='text/css'>
    </head>

    <body>

        <!-- Application Main Header Navigation -->
        @include("layouts.includes.nav")
        <!-- //Application Main Header -->

        <!-- Application Views Content -->
        <div class="row views-content">
            <div class="col-xs-10 col-xs-offset-1">
                @yield("view-content")
            </div>
        </div>
        <!-- //Application Views Contents -->

        <!-- Application SYNC Tool Modal  -->
        @include("modals.import-tool")
        <!-- //Application SYNC Tool Modal -->



        <!-- jQuery Core JavaScript -->
        <script src="{{ URL::asset('assets/js/vendor/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ URL::asset('assets/js/vendor/bootstrap.min.js') }}"></script>

        <!-- Loader for Bootstrap -->
        <script src="{{ URL::asset('assets/js/vendor/loader.js') }}"></script>

        <!-- Includes any Page Specific scripts -->
        @yield("page_specific_js")

    </body>

</html>