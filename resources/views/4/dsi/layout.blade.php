@php
use App\Models\User;
$user = User::where('id', session('Loggeduser'))->first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}"> --}}

    <title>{{ $page }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Scripts --> 
     <script src="{{ asset('js/app.js') }}"></script>
     <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> 
     <script src="{{ asset('js/script.js') }}"></script>

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
   
</head>

<body oncontextmenu='return false' class='snippet-body'>

    <body class="body-pd" id="body-pd">

        <!-- Page Heading -->
        <header class="headercust" id="headercust">
            <div class="header_toggle">
                <i class="fas fa-bars" id="header-toggle"></i>
            </div>
            <div class="titre float-start me-auto ">
                <h3 style="font-weight: bold;">BIENVENUE DANS LE GESTIONNAIRE DE STOCK </h3>
            </div>
            <div class="navbar-nav float-end ">
                <h5 class="fw-bold text-primary">{{ $user->name}} </h5>
            </div>
        </header>
        <!-- Page Sidebar -->

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">

                <div class="nav_list">
                    <a href="/index" class="nav_link mb-5 mt-3 @if ($pageSlug == 'index') {{ "active" }} @endif">
                        <i class='fas fa-home nav_icon ' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Accueil"></i>
                        <span class="nav_name">Accueil</span>
                    </a>
                    
                    
                    <a href="/acquisition" class="nav_link @if ($pageSlug == 'acquisition') {{ "active" }} @endif ">
                        <i class='fas fa-laptop nav_icon' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Acquisition"></i>
                        <span class="nav_name">Acquisition</span>
                    </a>

                </div>
                <div>
                    <a href="/profile" class="nav_link  @if ($pageSlug == 'profile') {{ "active" }} @endif">
                        <i class='fas fa-user  nav_icon' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Profile"></i>
                        <span class="nav_name">Profile</span>
                    </a>

                    <a href="/logout" class="nav_link">
                        <i class='fas fa-sign-out-alt  nav_icon' data-bs-toggle="tooltip"
                            data-bs-placement="right" title="Déconnexion"></i>
                        <span class="nav_name">Déconnexion</span>
                    </a>
                </div>

            </nav>
        </div>

        <!-- Page Content -->
        <!--Container Main start-->
        
        <div class="container-fluid  ">
            @yield('content')
        </div>

        @stack('modals')

        @stack('scripts')
        
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
        <script>
            $("select").select2({
                theme: "bootstrap-5",
            });
            // Small using Select2 properties
            $("#form-select-sm").select2({
                theme: "bootstrap-5",
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
            });

            /* // Small using Bootstrap 5 classes
            $("#form-select-sm").select2({
                theme: "bootstrap-5",
                dropdownParent: $("#form-select-sm").parent(), // Required for dropdown styling
            });

            // Large using Select2 properties
            $("select").select2({
                theme: "bootstrap-5",
                containerCssClass: "select2--large", // For Select2 v4.0
                selectionCssClass: "select2--large", // For Select2 v4.1
                dropdownCssClass: "select2--large",
            });

            // Large using Bootstrap 5 classes
            $("#form-select-lg").select2({
                theme: "bootstrap-5",
                dropdownParent: $("#form-select-lg").parent(), // Required for dropdown styling
            }); */
        </script>
    </body>

</html>
