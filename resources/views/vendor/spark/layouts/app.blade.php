<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet'
          type='text/css'>

    <!-- CSS -->
    <link href="/css/sweetalert.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- ADMIN LTE -->
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/adminlte/css/skins/skin-black-light.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="/adminlte/css/dataTables.bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- End of ADMIN LTE -->


    <link rel="stylesheet" href="/css/custom.css">


    <!-- Scripts -->
@yield('scripts', '')

<!-- Global Spark Object -->
    <script>
        window.Spark = <?php echo json_encode(array_merge(
            Spark::scriptVariables(), []
        )); ?>;
    </script>
</head>
<body class="sidebar-mini skin-black-light">

<div class="wrapper">

    <div id="spark-app" v-cloak>

        <!-- Main Header -->
        <header class="main-header">

            <!-- Branding Image -->
        @include('spark::nav.brand')

        <!-- Navigation -->
            @if (Auth::check())
                @include('spark::nav.user')
            @else
                @include('spark::nav.guest')
            @endif

        </header>

        @if(Auth::check())

            @include('spark::nav.left-bar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <!-- this needs to be in the page itself-->
                <section class="content-header">
                    <h1>
                        Page Header
                        <small>Optional description</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                        <li class="active">Here</li>
                    </ol>
                </section>
                <!-- -->

                <!-- Main Content -->

                <section class="content container-fluid">
                    @yield('content')
                </section>
            </div>

            <!-- Application Level Modals -->
            @include('spark::modals.notifications')
            @include('spark::modals.support')
            @include('spark::modals.session-expired')

        @else

            <div class="login-box">
                <div class="login-logo">
                    <a href="../../index2.html"><b>Admin</b>LTE</a>
                </div>

                @yield('content')

            </div>
            <!-- /.login-box -->

        @endif

    </div>
</div>

@yield('before_footer') <!-- footer added by Nik -->

<!-- JavaScript -->
<script src="/js/config.js"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="/js/sweetalert.min.js"></script>

<!-- Admin LTE-->
<!-- Slimscroll -->
<script src="/adminlte/js/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/adminlte/js/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>

<!-- End of Admin LTE-->

@yield('after_footer') <!-- footer added by Nik -->

</body>
</html>
