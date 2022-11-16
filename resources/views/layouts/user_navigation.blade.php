<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- -->

    <link href="{{ asset('users/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css ">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('users/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('users/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">



    <!-- -->


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    {{-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-0 m-0">
            <div class="container-fluid px-5 bg bg-dark ">
                <a class="navbar-brand text-light" href="{{ route('dashboard') }}">
                    {{ config('app.name', 'wew') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown " class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
    <main>
        <!-- -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark text-light accordion font-weight-bold"
                id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center flex-column mt-5"
                    href="{{ route('dashboard') }}">
                    <div class="sidebar-brand-icon">
                        <img src="{{ asset('images/pila_logo.png') }}" alt="LOGO" width="80" height="80">
                    </div>
                    <div class="sidebar-brand-text mx-3">E-TUROK MO</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-3">
                @if (in_array(auth()->user()->user_type_id, [1, 2]))
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('report') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Report</span></a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vaccines.index') }}">
                            <i class="fas fa-syringe"></i>
                            <span>Vaccine</span></a>
                    </li>





                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-shield-alt"></i>
                            <span>Immunization</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Immunization Category:</h6>
                                <a class="collapse-item" href="{{ route('infant_immunizations.index') }}">Infant</a>
                                <a class="collapse-item" href="{{ route('school_aged_immunizations.index') }}">School
                                    Aged Children</a>
                                <a class="collapse-item"
                                    href="{{ route('pregnant_immunizations.index') }}">Pregnant</a>
                                <a class="collapse-item" href="{{ route('adult_immunizations.index') }}">Adult</a>
                                <a class="collapse-item"
                                    href="{{ route('senior_citizen_immunizations.index') }}">Senior Citizen</a>
                            </div>
                        </div>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    {{-- <div class="sidebar-heading">
                        Doses
                    </div> --}}

                    <!-- Nav Item - Utilities Collapse Menu -->
                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Second Dose Schedule</span>
                        </a>
                        <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Immunization Category:</h6>
                                <a class="collapse-item" href="{{ route('infant_second_dose') }}">Infant</a>
                                <a class="collapse-item" href="{{ route('school_aged_second_dose') }}">School Aged
                                    Children</a>
                                <a class="collapse-item" href="{{ route('pregnant_second_dose') }}">Pregnant</a>
                                <a class="collapse-item" href="{{ route('adult_second_dose') }}">Adult</a>
                                <a class="collapse-item" href="{{ route('senior_second_dose') }}">Senior Citizen</a>
                            </div>
                        </div>
                    </li> --}}

                    <!-- Nav Item - Utilities Collapse Menu -->
                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Third Dose Schedule:</span>
                        </a>
                        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Immunization Category</h6>
                                <a class="collapse-item" href="{{ route('infant_third_dose') }}">Infant</a>
                                <a class="collapse-item" href="{{ route('school_aged_third_dose') }}">School Aged
                                    Children</a>
                                <a class="collapse-item" href="{{ route('pregnant_third_dose') }}">Pregnant</a>
                                <a class="collapse-item" href="{{ route('adult_third_dose') }}">Adult</a>
                                <a class="collapse-item" href="{{ route('senior_third_dose') }}">Senior Citizen</a>
                            </div>
                        </div>
                    </li> --}}

                    
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        SETTINGS
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('archives.index') }}">
                            <i class="fas fa-archive"></i>
                            <span>Archive</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('database_backup.index') }}">
                            <i class="fas fa-database"></i>
                            <span>Database Backup</span></a>
                    </li>
                    
                    @if (auth()->user()->user_type_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('manage_users') }}">
                                <i class="fas fa-users"></i>
                                <span>Manage User</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user_activity_log.index') }}">
                                <i class="fas fa-address-book"></i>
                                <span>Activity Log</span></a>
                        </li>
                    @endif
                @else
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-shield-alt"></i>
                            <span>Immunization</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Immunization Category</h6>
                                <a class="collapse-item" href="{{ route('infant_immunizations.index') }}">Infant</a>
                                <a class="collapse-item" href="{{ route('school_aged_immunizations.index') }}">School
                                    Aged Children</a>
                                <a class="collapse-item"
                                    href="{{ route('pregnant_immunizations.index') }}">Pregnant</a>
                                <a class="collapse-item" href="{{ route('adult_immunizations.index') }}">Adult</a>
                                <a class="collapse-item"
                                    href="{{ route('senior_citizen_immunizations.index') }}">Senior Citizen</a>
                            </div>
                        </div>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    {{-- <div class="sidebar-heading">
                        Doses
                    </div> --}}

                    <!-- Nav Item - Utilities Collapse Menu -->
                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Second Dose Schedule</span>
                        </a>
                        <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Immunization Category:</h6>
                                <a class="collapse-item" href="{{ route('infant_second_dose') }}">Infant</a>
                                <a class="collapse-item" href="{{ route('school_aged_second_dose') }}">School Aged
                                    Children</a>
                                <a class="collapse-item" href="{{ route('pregnant_second_dose') }}">Pregnant</a>
                                <a class="collapse-item" href="{{ route('adult_second_dose') }}">Adult</a>
                                <a class="collapse-item" href="{{ route('senior_second_dose') }}">Senior Citizen</a>
                            </div>
                        </div>
                    </li> --}}

                    <!-- Nav Item - Utilities Collapse Menu -->
                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Third Dose Schedule</span>
                        </a>
                        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Immunization Category</h6>
                                <a class="collapse-item" href="{{ route('infant_third_dose') }}">Infant</a>
                                <a class="collapse-item" href="{{ route('school_aged_third_dose') }}">School Aged
                                    Children</a>
                                <a class="collapse-item" href="{{ route('pregnant_third_dose') }}">Pregnant</a>
                                <a class="collapse-item" href="{{ route('adult_third_dose') }}">Adult</a>
                                <a class="collapse-item" href="{{ route('senior_third_dose') }}">Senior Citizen</a>
                            </div>
                        </div>
                    </li> --}}

                    
                @endif





                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>



            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content ">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        {{-- <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form> --}}

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>


                            {{-- @if (in_array(auth()->user()->id, [1, 2]))
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-bell fa-fw text-dark"></i>
                                        <!-- Counter - Alerts -->
                                        
                                        <span
                                            class="badge badge-danger badge-counter">+1</span>
                                    </a>
                                    <!-- Dropdown - Alerts -->
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="alertsDropdown">
                                        <h6 class="dropdown-header">
                                            Notification
                                        </h6>
                                        <div class="text-center mt-2">
                                            <p>Exprired Vaccine</p>
                                        </div>
                                        {{-- @forelse ($expired_vaccines as $expired_vaccine) --}}
                                            {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-danger text-light">
                                                        <i class="fas fa-syringe"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="small text-dark-500"> --}}
                                                        {{-- {{ $expired_vaccine->expiration_date }}</div> --}}
                                                    {{-- <span> --}}
                                                        {{-- class="font-weight-bold">{{ $expired_vaccine->vaccine_name }} --}}
                                                    {{-- </span> --}}
                                                {{-- </div>
                                            </a> --}}
                                        {{-- @empty --}}
                                            {{-- <h4 class="text-center mt-2 font-weight-light">Empty</h4> --}}
                                        {{-- @endforelse --}}

                                        {{-- <div class="text-center mt-2">
                                            <p>Soon to Exprire Vaccine</p>
                                        </div> --}}
                                        {{-- @forelse ($soon_to_expire_vaccines as $vaccine) --}}
                                            {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary text-light">
                                                        <i class="fas fa-syringe"></i>
                                                    </div>
                                                </div>
                                                <div> --}}
                                                    {{-- <div class="small text-dark-500">{{ $vaccine->expiration_date }} --}}
                                                    {{-- </div> --}}
                                                    {{-- <span class="font-weight-bold">{{ $vaccine->vaccine_name }}</span> --}}
                                                {{-- </div>
                                            </a> --}}
                                        {{-- @empty --}}
                                            {{-- <h4 class="text-center mt-2 font-weight-light">Empty</h4> --}}
                                        {{-- @endforelse --}}



                                    {{-- </div>
                                </li>
                            @endif --}}
                            <!-- Nav Item - Alerts -->


                            {{-- <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw text-dark"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                                alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                                problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                                alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month, how
                                                would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                                alt="...">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                                the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                                told me that people say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                </div>
                            </li> --}}

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @guest

                                        @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small text-dark font-weight-bold">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</span>


                                @if (empty(auth()->user()->profile_img))
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/default-profile-image.jpg') }}">
                                @else
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/avatars/' . auth()->user()->profile_img) }}">
                                @endif


                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('my_profile.index') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout

                                    </a>
                                </div>
                                </li>
                            @endguest

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <span id='page-top'></span>

                    @yield('content')



                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">

                            {{-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> --}}



                            @guest
                                @if (Route::has('login'))
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <a id="navbarDropdown " class="nav-link dropdown-toggle text-light" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>


                                <a class="btn btn-primary" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>


                            @endguest

                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('users/vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('users/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <!-- Bootstrap core JavaScript-->

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('users/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
            <!-- Core plugin JavaScript-->

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('users/js/sb-admin-2.min.js') }}"></script>
            <!-- Custom scripts for all pages-->

            <!-- Graphs and chars -->
            <script src="{{ asset('users/vendor/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('users/js/demo/chart-area-demo.js') }}"></script>
            <script src="{{ asset('users/js/demo/chart-pie-demo.js') }}"></script>
            <!-- Graphs and chars -->

            <!-- Pages Tables -->
            <script src="{{ asset('users/vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('users/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('users/js/demo/datatables-demo.js') }}"></script>
            <!-- Pages Tables -->




    </main>
    </div>
    <script>
        $('#dataTable').DataTable( {
            "ordering": false
        } );
    </script>
    <script>
        
        $(document).ready(function () {
          $('#filterDataTable').DataTable({
            "ordering": false,
              initComplete: function () {
                  this.api()
                      .columns([3,4,5,9])
                      .every(function () {
                          var column = this;
                          
                          var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                              .appendTo($(column.footer()).empty())
                              .on('change', function () {
                                  var val = $.fn.dataTable.util.escapeRegex($(this).val());
       
                                  column.search(val ? '^' + val + '$' : '', true, false).draw();
                              });
       
                          column
                              .data()
                              .unique()
                              .sort()
                              .each(function (d, j) {
                                var val = $('<div/>').html(d).text();
                                select.append( '<option value="' + val + '">' + val + '</option>' )
                              });
                      });
              },
          });
      });
      </script>

<script>
        
    $(document).ready(function () {
      $('#thisDayImmunization').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([1 , 2 , 3, 4,8])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>
  <script>
        
    $(document).ready(function () {
      $('#thisMonthImmunization').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([1 , 2 , 3, 4,8])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>

<script>
        
    $(document).ready(function () {
      $('#thisYearImmunization').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([1 , 2 , 3, 4,8])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>

<script>
    $(document).ready(function () {
      $('#filterVaccineDataTable').DataTable({
        "ordering": false,
        "scrollX": false,
          initComplete: function () {
              this.api()
                  .columns([3, 4,7])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>

<script>
    $(document).ready(function () {
      $('#filterSecondDoseDataTable').DataTable({
        "ordering": false,
          initComplete: function () {
            
              this.api()
                  .columns([1 , 2 , 3, 4,6])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>
  <script>
    $(document).ready(function () {
        
      $('#filterThirdDoseDataTable').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([1 , 2 , 3, 4,7])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>

<script>
    $(document).ready(function () {
        
      $('#filterArchiveDataTable').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([3, 4,5,6])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>
  <script>
    $(document).ready(function () {
      $('#filterManageUserDataTable').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([4,5,6])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>
    <script>
        $(document).ready(function () {
          $('#filterUserActivityLogDataTable').DataTable({
            "ordering": false,
              initComplete: function () {
                  this.api()
                      .columns([0,1, 2 , 3,5])
                      .every(function () {
                          var column = this;
                          
                          var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                              .appendTo($(column.footer()).empty())
                              .on('change', function () {
                                  var val = $.fn.dataTable.util.escapeRegex($(this).val());
       
                                  column.search(val ? '^' + val + '$' : '', true, false).draw();
                              });
       
                          column
                              .data()
                              .unique()
                              .sort()
                              .each(function (d, j) {
                                var val = $('<div/>').html(d).text();
                                select.append( '<option value="' + val + '">' + val + '</option>' )
                              });
                      });
              },
          });
      });
      </script>

<script>
    $(document).ready(function () {
      $('#filterExceeded2ndDose').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([2,3,6])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>

<script>
    $(document).ready(function () {
      $('#filterExceeded3rdDose').DataTable({
        "ordering": false,
          initComplete: function () {
              this.api()
                  .columns([2,3,6])
                  .every(function () {
                      var column = this;
                      
                      var select = $('<select class="form-control border border-primary"><option value="">Filter</option></select>')
                          .appendTo($(column.footer()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex($(this).val());
   
                              column.search(val ? '^' + val + '$' : '', true, false).draw();
                          });
   
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                            var val = $('<div/>').html(d).text();
                            select.append( '<option value="' + val + '">' + val + '</option>' )
                          });
                  });
          },
      });
  });
  </script>

  <script>
    /*
 *  jquery-ph-locations - v1.0.1
 *  jQuery Plugin for displaying dropdown list of Philippines' Region, Province, City and Barangay in your webpage.
 *  https://github.com/buonzz/jquery-ph-locations
 *
 *  Made by Buonzz Systems
 *  Under MIT License
 */
 ;( function( $, window, document, undefined ) {
	var filterfieldname = "";
	
	"use strict";

		// defaults
		var pluginName = "ph_locations",
			defaults = {
                location_type : "provinces", // what data this control supposed to display? regions, provinces, cities or barangays?,
				api_base_url: 'https://ph-locations-api.buonzz.com/',
				order: "name asc",
				filter: {}
            };

		// plugin constructor
		function Plugin ( element, options ) {
			this.element = element;
			this.settings = $.extend( {}, defaults, options );
			this._defaults = defaults;
			this._name = pluginName;
			this.init();
		}

		// Avoid Plugin.prototype conflicts
		$.extend( Plugin.prototype, {
			init: function() {
				return this
            },
            
			fetch_list: function (filter) {
				
				this.settings.filter = filter;
					
				$.ajax({
                    type: "GET",
                    url: this.settings.api_base_url + 'v1/' +  this.settings.location_type,
					success: this.onDataArrived.bind(this),
					data: $.param(this.map_parameters())
                });
				

				
				
				

            }, // fetch list
            onDataArrived(data){
				var shtml = "";
				$(this.element).html(this.build_options(data));
			},

			map_parameters(){

				var mapped_parameter = {"filter": {
					"where": {},
					"order" : this.settings.order
					}
				};

				 for(var property in this.settings.filter)
				    mapped_parameter.filter.where[property] = this.settings.filter[property];

				 return mapped_parameter;
			},

			build_options(params){
				var shtml = "";
				shtml += '<option disabled selected>-SELECT-</option>';
				for(var i=0; i<params.data.length;i++){
					shtml += '<option value="' + params.data[i].id + '">';
					shtml +=  params.data[i].name ;
					shtml += '</option>';
				}

				return shtml
			}
            
		} );


		$.fn[ pluginName ] = function( options, args ) {
			return this.each( function() {
				var $plugin = $.data( this, "plugin_" + pluginName );
				if (!$plugin) {
					var pluginOptions = (typeof options === 'object') ? options : {};
					$plugin = $.data( this, "plugin_" + pluginName, new Plugin( this, pluginOptions ) );
				}
				
				if (typeof options === 'string') {
					if (typeof $plugin[options] === 'function') {
						if (typeof args !== 'object') args = [args];
						$plugin[options].apply($plugin, args);
					}
				}
			} );
		};

} )( jQuery, window, document );
  </script>
  <script type="text/javascript">
            
    var my_handlers = {

        // fill_provinces:  function(){

        //     var region_code = $(this).val();
        //     $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
            
        // },

        fill_cities: function(){

            var province_code = $(this).val();
            $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
        },


        fill_barangays: function(){

            var city_code = $(this).val();
            $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
        }
    };

    $(function(){
        // $('#region').on('change', my_handlers.fill_provinces);
        $('#province').on('change', my_handlers.fill_cities);
        $('#city').on('change', my_handlers.fill_barangays);

        // $('#region').ph_locations({'location_type': 'regions'});
        $('#province').ph_locations({'location_type': 'provinces'});
        $('#city').ph_locations({'location_type': 'cities'});
        $('#barangay').ph_locations({'location_type': 'barangays'});

        $('#province').ph_locations('fetch_list');
    });
</script>

<script>
    $(function(){

// whenever the province dropdown change, update the value of hidden field
 $('#province').on('change', function(){

       // we are getting the text() here, not val()
       var selected_caption = $("#province option:selected").text();
       

      // the hidden field will contain the name of the region, not the code
       $('input[name=province_name]').val(selected_caption);

 }).ph_locations('fetch_list');

});

$(function(){

// whenever the city dropdown change, update the value of hidden field
 $('#city').on('change', function(){

       // we are getting the text() here, not val()
       var selected_caption = $("#city option:selected").text();

      // the hidden field will contain the name of the region, not the code
       $('input[name=municipality_name]').val(selected_caption);

 }).ph_locations('fetch_list');

});

$(function(){

// whenever the city dropdown change, update the value of hidden field
 $('#barangay').on('change', function(){

       // we are getting the text() here, not val()
       var selected_caption = $("#barangay option:selected").text();

      // the hidden field will contain the name of the region, not the code
       $('input[name=barangay_name]').val(selected_caption);

 }).ph_locations('fetch_list');

});
</script>

</body>

</html>
