@extends('layouts.app')


@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                                

                            <div class="col">
                                <label for="first_name">{{ __('Firstname') }}</label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}"  autocomplete="name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="middle_name">{{ __('Middlename') }}</label>
                                <input id="middle_name" type="text"
                                    class="form-control @error('middle_name') is-invalid @enderror" name="middle_name"
                                    value="{{ old('middle_name') }}"  autocomplete="name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="last_name">{{ __('Lastname') }}</label>
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}"  autocomplete="name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label>Date of Birth</label>
                                    @php  
                                        $maxDate = date('Y-m-d');
                                    @endphp
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"  max=" {{$maxDate}} " value="{{ old('date_of_birth') }}">

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label>Gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input " type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked(old('sex') == "Male")>
                                        <label class="form-check-label " for="flexRadioDefault1">
                                          Male
                                        </label>

                                        <input class="form-check-input " type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked(old('sex') == "Female")>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          Female
                                        </label>
                                      </div>
                                      
                                </div>

                                <div class="col ml-5">
                                    <label>Civil Status</label>
                                    <select name="civil_status" class="form-control @error('civil_status') is-invalid @enderror">
                                        <option selected disabled>--Select Civil Status--</option>
                                        <option @selected(old('civil_status' == "Single")) value="Single">Single</option>
                                        <option @selected(old('civil_status' == "Married")) value="Married">Married</option>
                                        <option @selected(old('civil_status' == "Widowed")) value="Widowed">Widowed</option>
                                        <option @selected(old('civil_status' == "Separated")) value="Separated">Separated</option>
                                    </select>

                                    @error('civil_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            

                            

                            <div class="row">
                                
    
                                <div class="col">
                                    <label for="province" >{{ __('Province') }}</label>
                                    <input type="hidden" name="province_name" >
                                    <select id="province" class="form-control @error('province') is-invalid @enderror" name="province"  required autocomplete="province" autofocus>
                                        
                                    </select>
    
                                    @error('province_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                
    
                                <div class="col">
                                    <label for="municipality" >{{ __('Municiplaity') }}</label>
                                    <input type="hidden" name="municipality_name" >
                                    <select id="city" class="form-control @error('municipality') is-invalid @enderror" name="municipality"  required autocomplete="municipality" autofocus >
                                        
                                       
                                    </select>
    
                                    @error('municipality_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                
    
                                <div class="col">
                                    <label for="barangay">{{ __('Barangay') }}</label>
                                    <input type="hidden" name="barangay_name" >
                                    <select id="barangay" class="form-control @error('barangay') is-invalid @enderror" name="barangay"  required autocomplete="barangay" autofocus >
                                        
                                        {{-- <option @selected(old('barangay') == 'Aplaya') value="Aplaya">Aplaya</option>
                                        <option @selected(old('barangay') == 'Bagong Pook') value="Bagong Pook">Bagong Pook</option>
                                        <option @selected(old('barangay') == 'Bukal') value="Bukal">Bukal</option>
                                        <option @selected(old('barangay') == 'Bulilan Norte') value="Bulilan Norte">Bulilan Norte</option>
                                        <option @selected(old('barangay') == 'Bulilan Sur') value="Bulilan Sur">Bulilan Sur</option>
                                        <option @selected(old('barangay') == 'Concepcion') value="Concepcion">Concepcion</option>
                                        <option @selected(old('barangay') == 'Labuin') value="Labuin">Labuin</option>
                                        <option @selected(old('barangay') == 'Linga') value="Linga">Linga</option>
                                        <option @selected(old('barangay') == 'Masico') value="Masico">Masico</option>
                                        <option @selected(old('barangay') == 'Mojon') value="Mojon">Mojon</option>
                                        <option @selected(old('barangay') == 'Pansol') value="Pansol">Pansol</option>
                                        <option @selected(old('barangay') == 'Pinagbayanan') value="Pinagbayanan">Pinagbayanan</option>
                                        <option @selected(old('barangay') == 'San Antonio') value="San Antonio">San Antonio</option>
                                        <option @selected(old('barangay') == 'San Miguel') value="San Miguel">San Miguel</option>
                                        <option @selected(old('barangay') == 'Santa Clara Norte') value="Santa Clara Norte">Santa Clara Norte</option>
                                        <option @selected(old('barangay') == 'Santa Clara Sur') value="Santa Clara Sur">Santa Clara Sur</option>
                                        <option @selected(old('barangay') == 'Tubuan') value="Tubuan">Tubuan</option> --}}
                                    </select>
    
                                    @error('barangay_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                
                            </div>
    
                            

                            

                            

                            

                        </div>



                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            

                            <div class="col-md-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                     autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            

                            <div class="col-md-3">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation"  autocomplete="new-password">
                            </div>


                        </div>



                        <!-- -->

                        <div class="row mb-3">
                            

                            {{-- <div class="col">
                                <label for="profile">{{ __('Profile Image') }}</label>
                                <input id="profile" type="file"
                                    class="form-control @error('profile_img') is-invalid @enderror" name="profile_img"
                                     value="{{ old('profile_img') }}">

                                @error('profile_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}


                            

                            <div class="col">
                                <label for="name">{{ __('User Type') }}</label>
                                <select name="user_type_id" id="" class="form-control">
                                    <option selected disabled>--Select User Type--</option>
                                    @foreach ($user_types as $user_type)
                                        <option @selected(old("user_type_id") == $user_type->id) value="{{ $user_type->id }}">{{ $user_type->user_type }}</option>
                                    @endforeach

                                </select>

                                @error('user_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            

                        

                        </div>
                    

                        <!-- -->

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
