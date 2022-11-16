@extends('layouts.guest')
@section('guest')
    <div class="main-container d-flex flex-column justify-content-between">
        <div class="container">
            @include('layouts.flash-message')
            <section class="h-90 gradient-form">
                <div class="container h-90 shadow shadow-lg">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-xl">

                            <div class="row  ">


                                <div class="col-lg-6 d-flex align-items-center justify-content-center"
                                    style="background-image: url({{ asset('images/rhubg.jpg') }})"
                                    alt=""width="100" height="100" id="rhubg" class="img-fluid">
                                    <!--  gradient-custom-2"> -->
                                    <!-- <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                  <h4 class="mb-4">We are more than just a company</h4>
                                  <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div> -->


                                </div>

                                <div class="col-lg-6  bg-light  border-dark">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <img src="{{ asset('images/pila_logo.png') }}" alt="LOGO" id="logo">
                                            <p class="pb-1 ">Rural Health Unit of Pila Laguna</p>

                                        </div>

                                        <form action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <center>
                                                <p class="text-muted">Login to your account</p>
                                            </center>

                                            <div class="form-outline mb-2">
                                                <label class="form-label"
                                                    for="form2Example11">{{ __('Email Address') }}</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example11">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div
                                                class="text-center pt-1 mb-5 pb-1 d-flex align-items-center justify-content-center flex-column">
                                                <button class="btn text-light px-5 btn-block fa-lg mb-3" id="button_submit"
                                                    type="submit">LOGIN
                                                </button>
                                                <a class="text-muted" href="{{ route('password.request') }}">Forgot
                                                    password?</a>
                                            </div>


                                        </form>

                                    </div>
                                </div>

                            </div>
                            </nav>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </section>
@endsection
