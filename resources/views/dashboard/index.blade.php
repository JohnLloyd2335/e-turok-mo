@extends('layouts.user_navigation')

@section('title')
    E-TUROK MO | DASHBOARD
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <h1 class="h3 mb-0 text-dark-900">Dashboard</h1>
        

           
        </div>

        <!-- Content Row -->
        <div class="row">
            @if (in_array(auth()->user()->user_type_id, [1,2]))
                <!-- Vaccine Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2 bg-primary">
                        <div class="card-body pl-5">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                        Vaccines</div>
                                    <div class="text-light h3 mb-0 font-weight-bold text-gray-800">{{ $vaccine_rows }}</div>
                                </div>
                                <div class="col-auto pr-5">
                                    <i class="fas fa-syringe fa-2x text-gray-300 border rounded bg-primary p-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            

            <!-- Immunization Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2 bg-success">
                    <div class="card-body pl-5">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                    Immunizations</div>
                                <div class="text-light h3 mb-0 font-weight-bold text-gray-800">{{ $immunization_rows }}
                                </div>
                            </div>
                            <div class="col-auto pr-5">
                                <i class="fas fa-user-shield fa-2x text-gray-300 border rounded bg-success p-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (auth()->user()->user_type_id == 1)
                <!-- Immunization Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2 bg-primary">
                        <div class="card-body pl-5">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                        Users</div>
                                    <div class="text-light h3 mb-0 font-weight-bold text-gray-800">{{ $user_rows }}</div>
                                </div>
                                <div class="col-auto pr-5">
                                    <i class="fas fa-users fa-2x text-gray-300 border rounded bg-primary p-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            @if (in_array(auth()->user()->user_type_id, [1,2]))
            <!-- Archive Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2 bg-dark">
                    <div class="card-body pl-5">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                    Archives</div>
                                <div class="text-light h3 mb-0 font-weight-bold text-gray-800">{{ $archive_rows }}</div>
                            </div>
                            <div class="col-auto pr-5">
                                <i class="fas fa-archive fa-2x text-gray-300 border rounded bg-dark p-2"></i>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow pb-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Monthly Immunization</h6>
                            {{-- <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Card Body -->
                        <div class="card-body pb-5">
                            <div class="chart-area">
                                {{-- <script src="{{ asset('users/vendor/chart.js/Chart.min.js') }}"></script>
                                <script src="{{ asset('users/js/demo/chart-area-demo.js') }}"></script> --}}
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <canvas id="monthlyImmunizationChart"></canvas>
                                <script>
                                    var labels = {{ Js::from($labels) }};
                                    var immunizations = {{ Js::from($data) }};
                                    var lastYearlabels = {{ Js::from($lastYearlabels) }};
                                    var lastYearimmunizations = {{ Js::from($lastYeardata) }};
                                    const data = {
                                        labels: labels ,
                                        datasets: [{
                                            label: {{\Carbon\Carbon::now()->year - 1}},
                                            backgroundColor: '#008551',
                                            data: lastYearimmunizations,
                                        },
                                        {
                                            label: {{\Carbon\Carbon::now()->year}},
                                            backgroundColor: '#0D6EFD',
                                            data: immunizations,
                                        }
                                        ]
                                    };
                                    // const data = {
                                    //     labels: labels,
                                    //     datasets: []
                                    // };
                                    // const config = {
                                    //     type: 'bar',
                                    //     data: data,
                                    //     options: {}
                                    // };
                                    
                                    const config = {
                                        type: 'bar',
                                        data: data,
                                        options: {}
                                    }
                                    ;
                                    const myChart = new Chart(
                                        document.getElementById('monthlyImmunizationChart'),
                                        config
                                    );
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-5 pb-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Immunization Category</h6>
                            {{-- <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Card Body -->
                        <div class="card-body pb-5 pt-5">
                            <div class="chart-pie d-flex align-items-center justify-content-center mt-2">
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                <script type="text/javascript">
                                    google.charts.load('current', {
                                        'packages': ['corechart']
                                    });
                                    google.charts.setOnLoadCallback(drawChart);
                                    

                                    function drawChart() {

                                        var data = google.visualization.arrayToDataTable([
                                            ['Immunization Category', 'Number of Rows'],
                                            ['Infant', {{ $infant_rows }}],
                                            ['School Aged Children', {{ $school_aged_rows }}],
                                            ['Pregnant', {{ $pregnant_rows }}],
                                            ['Adult', {{ $adult_rows }}],
                                            ['Senior Citizen', {{ $senior_citizen_rows }}]
                                        ]);

                                        var options = {
                                            title: '',
                                            chartArea: {
                                                left: "3%",
                                                top: "3%",
                                                height: "100%",
                                                width: "100%"
                                            }
                                        };

                                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                        chart.draw(data, options);
                                    }
                                    
                                </script>
                                <div id="piechart"></div>
                               


                            </div>
                            {{-- <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Direct
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Social
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Referral
                                </span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            {{-- <div class="row">

                <!-- Content Column -->
                <div class="col-lg-6 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Color System -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Primary
                                    <div class="text-white-50 small">#4e73df</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Success
                                    <div class="text-white-50 small">#1cc88a</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Info
                                    <div class="text-white-50 small">#36b9cc</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-warning text-white shadow">
                                <div class="card-body">
                                    Warning
                                    <div class="text-white-50 small">#f6c23e</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-danger text-white shadow">
                                <div class="card-body">
                                    Danger
                                    <div class="text-white-50 small">#e74a3b</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Secondary
                                    <div class="text-white-50 small">#858796</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-light text-black shadow">
                                <div class="card-body">
                                    Light
                                    <div class="text-black-50 small">#f8f9fc</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    Dark
                                    <div class="text-white-50 small">#5a5c69</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}

            {{-- <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="img/undraw_posting_photo.svg" alt="...">
                            </div>
                            <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank"
                                    rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                constantly updated collection of beautiful svg images that you can use
                                completely free and without attribution!</p>
                            <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                unDraw &rarr;</a>
                        </div>
                    </div>

                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                        </div>
                        <div class="card-body">
                            <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                CSS bloat and poor page performance. Custom CSS classes are used to create
                                custom components and custom utility classes.</p>
                            <p class="mb-0">Before working with this theme, you should become familiar with the
                                Bootstrap framework, especially the utility classes.</p>
                        </div>
                    </div>

                </div> --}}
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    
@endsection
