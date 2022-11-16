@extends('layouts.user_navigation')
@section('title')
    E-TUROK MO | MY PROFILE
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid h-100">
        @include('layouts.flash-message')
        <div class="dropdown container-fluid d-flex align-items-center justify-content-end px-2 bg-dark rounded-top ">
            <i class="fas fa-cog text-light mt-4 mr-2" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#changeProfilePictureModal">Change Profile
                    Image</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#changeProfileModal">Edit Profile</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#changePasswordModal">Change Password</a>
            </div>
        </div>
        <div class="container-fluid d-flex flex-column align-items-center justify-content-center p-2 bg-dark">

            @if (empty(auth()->user()->profile_img))
                <img class="img-profile border border-primary rounded-circle border-5"
                    src="{{ asset('storage/default-profile-image.jpg') }}" height="200" weight="200">
            @else
                <img class="img-profile border border-primary rounded-circle border-5"
                    src="{{ asset('storage/avatars/' . auth()->user()->profile_img) }}" height="200" weight="200">
            @endif

            <h4 class="text-light font-weight-light mt-2">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</h4>
            <h6 class="text-light font-weight-light">
                @switch(Auth::user()->user_type_id)
                    @case(1)
                        {{ 'Admin' }}
                    @break

                    @case(2)
                        {{ 'Nurse/Midwife' }}
                    @break

                    @case(3)
                        {{ 'Barangay Health Worker' }}
                    @break

                    @default
                        {{ 'Error' }}
                @endswitch


            </h6>
        </div>

        <div class="container-fluid p-2 mt-4">
            <form>
                <div class="row">
                    <div class="col">
                        <label>Name</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->first_name." ".Auth::user()->middle_name." ".Auth::user()->last_name }}" readonly>
                    </div>
                    <div class="col">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="{{ Auth::user()->date_of_birth }}" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label>Age</label>
                        <input type="text" name="age" value="{{ Auth::user()->age}}" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label>Gender</label>
                        <input type="text" name="gender" value="{{ Auth::user()->gender}}" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label>Civil Status</label>
                        <input type="text" name="civil status" value="{{ Auth::user()->civil_status}}" class="form-control" readonly>
                    </div>
                    
                    

                </div>

               

                <div class="row">
                    <div class="col">
                        <label>Province</label>
                        <input type="text" name="province" value="{{ Auth::user()->province}}" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label>Municipality</label>
                        <input type="text" name="municipality" value="{{ Auth::user()->municipality}}" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label>Barangay</label>
                        <input type="text" name="barangay" value="{{ Auth::user()->barangay}}" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label>User Type</label>
                        <input type="email" class="form-control"
                            value="
                    @switch(Auth::user()->user_type_id)
                        @case(1)
                            {{ 'Admin' }}
                            @break
                        @case(2)
                            {{ 'Nurse/Midwife' }}
                            @break
                        @case(3)
                            {{ 'Barangay Health Worker' }}
                            @break
                        @default
                            {{ 'Error' }}
                    @endswitch
                    "
                            readonly>
                    </div>
                    <div class="col">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    </div>
                </div>

                
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="changeProfilePictureModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.setProfilePicture') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf

                            <div class="container d-flex align-items-center justify-content-center">
                                <input type="file" name="profile_img" class="form-control" accept="image/*">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Set</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->


        <!-- Modal -->
        <div class="modal fade" id="changeProfileModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.changeProfile') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <label>Firstname</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ Auth::user()->first_name }}">
                                </div>
                                <div class="col">
                                    <label>Middlename</label>
                                    <input type="text" name="middle_name" class="form-control"
                                        value="{{ Auth::user()->middle_name }}">
                                </div>
                                <div class="col">
                                    <label>Lastname</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ Auth::user()->last_name }}">
                                </div>
                                <div class="col">
                                    <label>Date of Birth</label>
                                    @php
                                        $maxDate = date('Y-m-d');
                                    @endphp
                                    <input type="date" name="date_of_birth" class="form-control"
                                        value="{{ Auth::user()->date_of_birth }}" max="{{ $maxDate }}">
                                </div>
                                

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input mr-5" type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked(Auth::user()->gender == "Male")>
                                        <label class="form-check-label mr-5" for="flexRadioDefault1">
                                          Male
                                        </label>
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked(Auth::user()->gender == "Female")>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          Female
                                        </label>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Civil Status</label>
                                    <select name="civil_status" class="form-control">
                                        <option selected disabled>--Select Civil Status--</option>
                                        <option @selected(Auth::user()->civil_status == "Single") value="Single">Single</option>
                                        <option @selected(Auth::user()->civil_status == "Married") value="Married">Married</option>
                                        <option @selected(Auth::user()->civil_status == "Widowed") value="Widowed">Widowed</option>
                                        <option @selected(Auth::user()->civil_status == "Separated") value="Separated">Separated</option>
                                    </select>
                                </div>
                                
                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

        <!-- Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.changePassword') }}" method="POST">
                            @csrf



                            <div class="container">
                                <div class="row">
                                    <label>Old Password</label>
                                    <input type="password" name="old_password" class="form-control">
                                </div>
                                <div class="row">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" class="form-control">
                                </div>
                                <div class="row">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control">
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    @endsection
