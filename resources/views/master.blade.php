<!DOCTYPE html>
<html>
    <head>
        <title>
		    @yield('title')
	    </title>

        <meta charset="utf-8">

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link href="{{URL::asset("css/simple-sidebar.css")}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset("css/bootstrap-datepicker.css")}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset("css/custom.css")}}" rel="stylesheet" type="text/css">

        <link href="{{URL::asset("css/bootstrap-duallistbox.css")}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset("css/prettify.min.css")}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset("css/bootstrap3.css")}}" rel="stylesheet" type="text/css">

        <script src="{{URL::asset("js/jquery.js")}}"></script>
        <script src="{{URL::asset("js/bootstrap3.js")}}"></script>
        <script src="{{URL::asset("js/angular.js")}}"></script>
        <script src="{{URL::asset("js/bootstrap-datepicker.js")}}"></script>
        <script src="{{URL::asset("js/script.js")}}"></script>

        <script src="{{URL::asset("js/jquery.bootstrap-duallistbox.js")}}"></script>
        <script src="{{URL::asset("js/prettyfy.min.js")}}"></script>


    </head>
    <body ng-app="app" ng-controller="appCtrl">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#menu-toggle" id="menu-toggle"><h3>EgicomAdmin</h3></a>
            </div>
        </div><!-- /.container-fluid -->
    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            @include('sidebar')
        </div>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("modal")

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        $("#menu-toggle1").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        function goBack() {
            window.history.back();
        }
    </script>

    <script>
        $(document).ready(function(){
            var date_input=$('input[id="date"]'); //our date input has the id "date"
            //var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: 'mm-dd-yyyy',
                //container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        })
    </script>

    </body>
</html>
