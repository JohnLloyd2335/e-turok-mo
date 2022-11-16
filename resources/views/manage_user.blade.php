@extends('layouts.user_navigation')
@section('title')
    E-TUROK MO | MANAGE USER
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid px-4">

        

        @include('layouts.flash-message')

       <!-- Page Heading -->
       <form action="{{ route('manageUserMultiAction') }}" method="POST" style="margin:0;padding:0;">
        @csrf
        <!--Multi Delete Modal -->
        <div class="modal fade" id="multiDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <h3 class="font-weight-light">Are you sure you want to delete selected users?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    
                        
                        <button type="submit" class="btn btn-danger">Yes</button>
                    


                </div>
            </div>
        </div>
    </div>
    <!--Multi Delete Modal -->
    <!--Multi Set Inactive Modal-->
    <div class="modal fade" id="multiSetInactiveModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">

                <h3 class="font-weight-light">Are you sure you want to update selected user?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                
                    
                    <button type="submit" class="btn btn-primary">Yes</button>
                


              </div>
          </div>
      </div>
    </div>
    <!--Multi Set Inactive Modal-->
    <!--Multi Set Active Modal-->
    <div class="modal fade" id="multiSetActiveModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">

                <h3 class="font-weight-light">Are you sure you want to update selected user?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                
                    
                    <button type="submit" class="btn btn-primary">Yes</button>
                


                </div>
            </div>
        </div>
    </div>
    <!---Multi Set Active Modal-->
    <div class="d-flex justify-content-between align-items-center">

      <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addUserModal">Add User</button>
      </div>
      <div class="d-flex align-items-center justify-content-around">
       <div class="p-1">
           <label>On Selected</label>
       </div>
       
       <div class="p-1">
           <select name="actions"  class="form-select" id="options">
               <option value="Delete">Delete</option>
               <option value="Set Inactive">Set Inactive</option>
               <option value="Set Active">Set Active</option>
           </select>
       </div>
       <div class="p-1">
           <button type="button" class="btn btn-primary btn-sm" id="options-button">Go</button>
       </div>
       
       
      </div>
   </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-3">

            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Users</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="filterManageUserDataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($non_admin_users as $non_admin_user)
                                <tr class="text-center">
                                    <td class="text-center"><input type="checkbox" class="form-check-input" name="userIds[]" value="{{ $non_admin_user->id }}"></td>
                                    <td>{{$non_admin_user->id}}</td>
                                    <td>{{ $non_admin_user->first_name." ".$non_admin_user->middle_name." ".$non_admin_user->last_name }}</td>
                                    <td>{{ $non_admin_user->email }}</td>
                                    <td>{{ $non_admin_user->user_type->user_type }}</td>
                                    
                                        @if ($non_admin_user->status == "Active")
                                            <td class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small bg bg-success rounded text-white p-1 px-3 text-center">{{ $non_admin_user->status}}</p></td>
                                        @else
                                            <td class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small bg bg-danger rounded text-white p-1 px-3 text-center">{{ $non_admin_user->status}}</p></td>
                                        @endif
                                    
                                    <td>{{ $non_admin_user->date_recorded }}</td>


                                    <td class="d-flex justify-content-around align-items-center">
                                        <span data-toggle="tooltip"  data-placement="right" title="View">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#viewUserModal{{ $non_admin_user->id }}"><i class="fas fa-eye"></i></button>
                                        </span>
                                       <span data-toggle="tooltip"  data-placement="right" title="Edit">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editUserModal{{ $non_admin_user->id }}"><i
                                            class="fas fa-edit"></i></button>
                                       </span>
                                       <span data-toggle="tooltip"  data-placement="right" title="Delete">
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteUserModal{{ $non_admin_user->id }}"><i
                                                class="fas fa-trash-alt"></i></button>
                                       </span>
                                    </td>



                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th class="text-light">checkbox</th>
                                <th class="text-light">ID</th>
                                <th class="text-light">Name</th>
                                <th class="text-light">Email</th>
                                <th>User Type</th>
                                <th>Destined To</th>
                                <th>Created</th>
                                <th class="text-light">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->




    <!-- Modals -->

    <!-- Add non_admin_user Modal -->
    <div class="modal fade bd-example-modal-lg" id="addUserModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-3">
                    <!-- -->
                    <form method="POST" action="{{ route('manage_users.store') }}" enctype="multipart/form-data" >
                        @csrf

                       
                        <div class="row mb-3">
                                

                            <div class="col">
                                <label for="firstname">{{ __('Firstname') }}</label>
                                <input id="firstname" type="text"
                                    class="form-control @error('firstname') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}"  autocomplete="name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="middlename">{{ __('Middlename') }}</label>
                                <input id="middlename" type="text"
                                    class="form-control @error('middlename') is-invalid @enderror" name="middle_name"
                                    value="{{ old('middlename') }}"  autocomplete="name" autofocus>

                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="lastname">{{ __('Lastname') }}</label>
                                <input id="lastname" type="text"
                                    class="form-control @error('lastname') is-invalid @enderror" name="last_name"
                                    value="{{ old('lastname') }}"  autocomplete="name" autofocus>

                                @error('lastname')
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
                                        <input class="form-check-input mr-5 @error('gender') is-invalid @enderror" type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked(old('sex') == "Male")>
                                        <label class="form-check-label mr-5" for="flexRadioDefault1">
                                          Male
                                        </label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked(old('sex') == "Female")>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          Female
                                        </label>
                                      </div>
                                      @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
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
                                        <option value="Laguna" selected>Laguna</option>
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
                                        <option value="Pila" selected>Pila</option>
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
                                        
                                        <option @selected(old('barangay') == 'Aplaya') value="Aplaya">Aplaya</option>
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
                                        <option @selected(old('barangay') == 'Tubuan') value="Tubuan">Tubuan</option>
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



                        <!-- -->
                </div>
                <div class="modal-footer">


                    <div class="row mb-0">
                        <div class="col-md-6 d-flex">
                            

                            <button type="button" class="btn btn-secondary  mr-2" data-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- Add non_admin_user Modal -->

    @foreach ($non_admin_users as $non_admin_user)

    <!-- View non_admin_user Modal -->
    <div class="modal fade bd-example-modal-lg" id="viewUserModal{{$non_admin_user->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-3">
                    <!-- -->
                    <form method="POST" action="{{ route('manage_users.store') }}" enctype="multipart/form-data" >
                        @csrf

                       
                        <div class="row mb-3">
                                

                            <div class="col">
                                <label for="firstname">{{ __('Firstname') }}</label>
                                <input id="firstname" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                     autocomplete="name" autofocus value="{{$non_admin_user->first_name}}" readonly>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="middlename">{{ __('Middlename') }}</label>
                                <input id="middlename" type="text"
                                    class="form-control @error('middle_name') is-invalid @enderror" name="middle_name"
                                    autocomplete="name" autofocus value="{{$non_admin_user->middle_name}}" readonly>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="lastname">{{ __('Lastname') }}</label>
                                <input id="lastname" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                     autocomplete="name" autofocus value="{{$non_admin_user->first_name}}" readonly>

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
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"  max=" {{$maxDate}} " value="{{ $non_admin_user->date_of_birth }}" readonly>

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label>Gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input mr-5 @error('gender') is-invalid @enderror" type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked($non_admin_user->gender == "Male") readonly>
                                        <label class="form-check-label mr-5" for="flexRadioDefault1">
                                          Male
                                        </label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked($non_admin_user->gender == "Female") readonly>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          Female
                                        </label>
                                      </div>
                                      @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                </div>

                                <div class="col ml-5">
                                    <label>Civil Status</label>
                                    <select name="civil_status" class="form-control @error('civil_status') is-invalid @enderror" readonly>
                                        <option selected disabled>--Select Civil Status--</option>
                                        <option @selected($non_admin_user->civil_status == "Single") value="Single">Single</option>
                                        <option @selected($non_admin_user->civil_status == "Married") value="Married">Married</option>
                                        <option @selected($non_admin_user->civil_status == "Widowed") value="Widowed">Widowed</option>
                                        <option @selected($non_admin_user->civil_status == "Separated") value="Separated">Separated</option>
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
                                    
                                    <input type="text" name="province_name" id="province_name" class="form-control" value="{{$non_admin_user->province}}" readonly>
                                </div>

                                
    
                                <div class="col">
                                    <label for="municipality" >{{ __('Municiplaity') }}</label>
                                    <input type="text" name="municipality_name" id="municipality_name" class="form-control" value="{{$non_admin_user->municipality}}" readonly>
                                </div>

                                
    
                                <div class="col">
                                    <label for="barangay">{{ __('Barangay') }}</label>
                                    <input type="text" name="barangay_name" id="barangay_name" class="form-control" value="{{$non_admin_user->barangay}}" readonly>
                                        
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

                            <div class="col-md-8">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $non_admin_user->email }}"  autocomplete="email" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col">
                                <label for="date_created">{{ __('Date Created') }}</label>
                                <input id="date_created" type="date_created"
                                    class="form-control @error('date_created') is-invalid @enderror" name="date_created"
                                    value="{{ date('M-d-Y',strtotime($non_admin_user->date_recorded)) }}"  autocomplete="email" readonly>

                                @error('date_created')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                <input type="text" name="user_type" class="form-control" value="{{$non_admin_user->user_type->user_type}}" readonly>
                                
                            </div>

                            

                        <div class="col">
                            <label for="status">{{ __('Status') }}</label>
                            <input type="text" name="status" class="form-control" value="{{$non_admin_user->status}}" readonly>
                        </div>

                    </div>

                        






                        <!-- -->



                        <!-- -->
                </div>
                <div class="modal-footer">


                    <div class="row mb-0">
                        <div class="col-md-6 d-flex">
                            

                            <button type="button" class="btn btn-secondary  mr-2" data-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- View non_admin_user Modal -->

    
        <!-- Delete non_admin_user Modal -->

        <div class="modal fade" id="deleteUserModal{{ $non_admin_user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">

                        <h3 class="font-weight-light">Are you sure you want to delete?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <form action="{{ route('manage_users.destroy', $non_admin_user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $non_admin_user->id }}">
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        <!-- Delete non_admin_user Modal -->

        <!-- Edit non_admin_user Modal -->
        <div class="modal fade bd-example-modal-lg" id="editUserModal{{ $non_admin_user->id }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- -->
                        <form action="{{ route('manage_users.update', $non_admin_user->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                

                                <div class="col">
                                    <label for="firstname">{{ __('Firstname') }}</label>
                                    <input id="firstname" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                         autocomplete="name" autofocus value="{{$non_admin_user->first_name}}" >
    
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
                                <div class="col">
                                    <label for="middlename">{{ __('Middlename') }}</label>
                                    <input id="middlename" type="text"
                                        class="form-control @error('middle_name') is-invalid @enderror" name="middle_name"
                                        autocomplete="name" autofocus value="{{$non_admin_user->middle_name}}" >
    
                                    @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
                                <div class="col">
                                    <label for="lastname">{{ __('Lastname') }}</label>
                                    <input id="lastname" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                         autocomplete="name" autofocus value="{{$non_admin_user->first_name}}" >
    
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
                                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"  max=" {{$maxDate}} " value="{{ $non_admin_user->date_of_birth }}" >
    
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label>Gender</label>
                                        <div class="form-check">
                                            <input class="form-check-input mr-5 @error('gender') is-invalid @enderror" type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked($non_admin_user->gender == "Male") >
                                            <label class="form-check-label mr-5" for="flexRadioDefault1">
                                              Male
                                            </label>
                                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked($non_admin_user->gender == "Female") >
                                            <label class="form-check-label" for="flexRadioDefault2">
                                              Female
                                            </label>
                                          </div>
                                          @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                    </div>
    
                                    <div class="col ml-5">
                                        <label>Civil Status</label>
                                        <select name="civil_status" class="form-control @error('civil_status') is-invalid @enderror" >
                                            <option selected disabled>--Select Civil Status--</option>
                                            <option @selected($non_admin_user->civil_status == "Single") value="Single">Single</option>
                                            <option @selected($non_admin_user->civil_status == "Married") value="Married">Married</option>
                                            <option @selected($non_admin_user->civil_status == "Widowed") value="Widowed">Widowed</option>
                                            <option @selected($non_admin_user->civil_status == "Separated") value="Separated">Separated</option>
                                        </select>
    
                                        @error('civil_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                
    
                                
    
                                <div class="row">
                                    
        
                                    {{-- <div class="col">
                                        <label for="province" >{{ __('Province') }}</label>
                                        <input type="hidden" name="province_name" >
                                        <select id="province" class="form-control @error('province_name') is-invalid @enderror" name="province"  required autocomplete="province" autofocus>
                                            
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
                                        <select id="city" class="form-control @error('municipality_name') is-invalid @enderror" name="municipality"  required autocomplete="municipality" autofocus >
                                            
                                           
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
                                        <select id="barangay" class="form-control @error('barangay_name') is-invalid @enderror" name="barangay"  required autocomplete="barangay" autofocus >
                                            
                                         
                                        </select>
        
                                        @error('barangay_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div> --}}
        
                                
    
                                
    
                                
    
                                
    
                            </div>
    
    
    
                            <div class="row mb-3">
    
                                <div class="col">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $non_admin_user->email }}"  autocomplete="email" >
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
    
                               
                                
    
                                
    
    
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
                                            <option @selected($non_admin_user->user_type_id == $user_type->id) value="{{ $user_type->id }}">{{ $user_type->user_type }}</option>
                                        @endforeach
    
                                    </select>
    
                                    @error('user_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
    
                                
    
                                <div class="col">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" autofocus>
                                        
                                        <option @selected($non_admin_user->status == 'Active') value="Active">Active</option>
                                        <option @selected($non_admin_user->status == 'Inactive') value="Inactive">Inactive</option>
                                        
                                    </select>
        
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
        
        
        
    
                        </div>
    

                            


                            <!-- -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit non_admin_user Modal -->
    @endforeach

    <!-- Modals -->

    <script>
        $(document).ready(function(){ //Make script DOM ready
        $('#options-button').click(function() { //jQuery Change Function
      
            var opval = $('#options').val(); //Get value from select element
            if(opval=="Delete"){
                $('#multiDeleteModal').modal("show"); //Open Modal
            }
            else if(opval=="Set Inactive"){
                $('#multiSetInactiveModal').modal("show"); //Open Modal
            }
            else if(opval=="Set Active"){
                $('#multiSetActiveModal').modal("show"); //Open Modal
            }
        });
      });
      </script>


@endsection
