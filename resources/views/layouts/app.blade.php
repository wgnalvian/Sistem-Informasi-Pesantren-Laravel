<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<?php 
$user= App\Models\Profile::find(Auth::id());



?>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="/home/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/home/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/home/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/home/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/home/vendors/jqvmap/dist/jqvmap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="/home/assets/css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

    @include('sweetalert::alert')
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./" style="margin-left : -10px">
                    <img src="/images/{{ $user->school_image}}"
                        style="width: 50px; height : 50px; margin-right : 10px" />
                    <h5 class="text-wrap">{{ $user->school_name }}</h5>
                </a>
                <a class="navbar-brand hidden" href="./"><img src="/home/images/logo2.png" alt="Logo"></a>
            </div>
            <p>{{ Auth::user()->name }}</p>
            <div id="main-menu" class="main-menu collapse navbar-collapse" style="margin-top : -30px">
                <ul class="nav navbar-nav">
                    <h3 class="menu-title">
                        <div class="badge text-wrap " style="width: 6rem; background-color : #FF4281">
                            Dashboard
                        </div>
                    </h3>
                    <li>
                        <a href="/"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">
                        <div class="badge text-wrap " style="width: 6rem; background-color : #38FDFE; color : black">
                            General
                        </div>
                    </h3>
                    <li>
                        <a href="/profile"> <i class="menu-icon fa fa-dashboard"></i>Profil </a>
                    </li>

                    <li>
                        <a href="/change-password"> <i class="menu-icon fa fa-dashboard"></i>Change Password</a>
                    </li>
                    <h3 class="menu-title"><span class="badge bg-warning text-dark">Keuangan</span></h3>
                    <!-- /.menu-title -->
                    <li class="menu-item">
                        <a href="{{ route('finance-data') }}"><i class="menu-icon fa fa-laptop"></i>Data Master</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Input</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="/input-pemasukan">Pemasukan</a></li>
                            <li><i class="fa fa-table"></i><a href="/input-pengeluaran">Pengeluaran</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title"><span class="badge bg-success text-white">Santri</span></h3>
                    <!-- /.menu-title -->

                    <li class="menu-item">
                        <a href="/santri"> <i class="menu-icon fa fa-tasks"></i>Data Students</a>

                    </li>
                    <li>
                        <a href="/santri/create"> <i class="menu-icon ti-email"></i>Tambah Santri</a>
                    </li>



                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">

                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                    aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5 d-flex justify-content-end">

                    <h3 style="margin-right : 7rem">كُلُّ نَفْسٍ ذَائِقَةُ الْمَوْتِ</h3>
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle"
                                src="/images/{{ $user->user_image }}" alt="User Avatar">

                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="/profile"><i class="fa fa-user"></i> My Profile</a>





                            <a class="nav-link" href="/logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>



                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>@yield('title')</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')


    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="/home/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/home/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="/home/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/home/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <script src="/home/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="/home/assets/js/dashboard.js"></script>
    <script src="/home/assets/js/widgets.js"></script>
    <script src="/home/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="/home/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="/home/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>
