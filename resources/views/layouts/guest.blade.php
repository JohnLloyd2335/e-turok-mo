<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>E-TUROK MO | LOGIN</title>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ asset('users/css/login_style.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->

</head>

<body>
    <div class="container-fluid  py-2" id="header">
        <div class="row" id="main_header">

            <div class="col col-md-1 d-flex align-items-center justify-content-end" id="header_1">
                <img src="{{ asset('images/pila_logo.png') }}" alt="LOGO"  id="logo_small">
            </div>
            <div class="col col-md-4 d-flex flex-column align-items-start justify-content-center text-light" id="header_2">
                <h3 id="header_title">RURAL HEALTH UNIT OF PILA LAGUNA</h3>
            </div>
            <div class="col col-md-7 d-flex align-items-center justify-content-end text-light" id="header_3">
                <h4 id="header_subtitle">E - TUROK MO</h4>

            </div>


        </div>

    </div>

    @yield('guest')

    <!-- Footer -->
    <footer class="text-center text-lg-start text-muted text-light  py-2" id="footer">
        <!-- Section: Social media -->
        

        <!-- Section: Links  -->
        <section class="text-light">
            <div class="container text-center text-md-start mt-5 ">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4 text-center">
                            Rural Health Unit of Pila Laguna
                        </h6>
                        <p class="text-center">
                            E - TUROK MO- A Vaccine Data Record and Information Management System for the Rural
                            Health Unit of Pila Laguna with SMS Notification
                        </p>
                    </div>
                    <!-- Grid column -->



                    <!-- Grid column -->
                    {{-- <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Learn More
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">About</a>
                        </p>
                    </div> --}}
                    <!-- Grid column -->

                    <!-- Grid column -->
                    {{-- <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-phone me-3"></i>Mobile: 00000000000</p>
                        <p><i class="fas fa-print me-3"></i>Land Line: 00000000</p>
                    </div> --}}
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            RHU Pila
            <!-- <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a> -->
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    </div>
    </nav>
    </div>
</body>

</html>

