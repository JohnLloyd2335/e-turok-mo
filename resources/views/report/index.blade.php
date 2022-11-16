@extends('layouts.user_navigation')
@section('title')
    E-TUROK MO | REPORTS
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid px-4">



        @include('layouts.flash-message')

        <!-- Page Heading -->
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#addImmunizationModal">Add Immunization</button> --}}


          <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="card shadow ">
                        <div class="card-header text-center">
                        Immunization
                        </div>
                        <div class="card-body pt-4">
                            <table class="table table-bordered mt-5" >
                                <thead>
                                    <tr class="text-center">
                                        <th></th>
                                        <th>Counts</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>This Day</td>
                                        <td class="text-center">{{ $immunizationsThisDay->count() }}</td>
                                        <td class="text-center">
                                            <span data-toggle="tooltip" data-placement="right" title="View">
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#viewImmunizationThisDayModal"><i
                                                        class="fas fa-eye"></i></i></button>
                                            </span>
        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Month</td>
                                        <td class="text-center">{{ $immunizationsThisMonth->count() }}</td>
                                        <td class="text-center">
                                            <span data-toggle="tooltip" data-placement="right" title="View">
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#viewImmunizationThisMonthModal"><i
                                                        class="fas fa-eye"></i></i></button>
                                            </span>
        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td class="text-center">{{ $immunizationsThisYear->count() }}</td>
                                        <td class="text-center">
                                            <span data-toggle="tooltip" data-placement="right" title="View">
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#viewImmunizationThisYearModal"><i
                                                        class="fas fa-eye"></i></i></button>
                                            </span>
        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>

                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header text-center">
                          Generate Report
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                
                                <div class="col">
                                    <form action="{{ route('export') }}" method="GET">
                                    @csrf
                                    <label>Start Date</label>
                                    @php
                                        $maxDate = date('Y-m-d');
                                    @endphp
                                    <input type="date" name="start_date" class="form-control" max="{{ $maxDate }}">
                                
          
                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <label>End Date</label>
                                  @php
                                      $maxDate = date('Y-m-d');
                                  @endphp
                                  <input type="date" name="end_date" class="form-control" max="{{ $maxDate }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <label>Select Category</label>
                                  <select name="immunization_category" class="form-control">
                                      <option disabled selected>
                                          --Select Category--
                                      </option>
                                      <option value="all">
                                          All Categories
                                      </option>
                                  @foreach ($immunization_categories as $immunization_category)
                                      <option value="{{ $immunization_category->id }}">{{ $immunization_category->immunization_category_name }}</option>
                                  @endforeach
                                  </select>
                                </div>
                            </div>
                      
                          
                          
                         
              
                            <div class="row mt-4 text-center">
                                <div class="col">
                                  <a data-toggle="modal" data-target="#exportImmunizationModal"
                                  class=" d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                                      class="fas fa-download fa-sm text-white-50"></i> Generate Report
                                  </a>
                                </div>
                            </div>
                        </div>
                      </div>
                   

              </div>
                <!--Export Modal -->
                <div class="modal fade" id="exportImmunizationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Export Immunization</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container d-flex justify-content-center align-itmes-center flex-column">
                                <h4 class="font-weight-light">Enter password to export Immunization</h4>
                                <input type="password" name="password" class="form-control" >

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
              </form>

            </div>

            <div class="row my-2 ">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            Missed Second Dose
                        </div>
                        <div class="card-body">
                            
                        
                        <table class="table table-bordered text-center w-100" id="filterExceeded2ndDose">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Dose</th>
                                    <th>Dose Received</th>
                                    <th>Second Dose Schedule</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($incompletes2ndDose as $incomplete2ndDose)
                                    <tr class="text-center">
                                        <td>{{$incomplete2ndDose->id}}</td>
                                        <td>{{ $incomplete2ndDose->first_name . ' ' . $incomplete2ndDose->middle_name . ' ' . $incomplete2ndDose->last_name }}
                                        </td>
                                        <td>{{ $incomplete2ndDose->immunization_category->immunization_category_name }}</td>
                                        <td>{{ $incomplete2ndDose->doses }}</td>
                                        <td>{{ $incomplete2ndDose->doses_received }}</td>
                                        <td>{{ $incomplete2ndDose->second_dose_schedule }}</td>
                                        <td>{{ $incomplete2ndDose->second_dose_vaccinated_at}}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewImmunizationModal{{ $incomplete2ndDose->id }}"><i class="fas fa-eye"></i></button>
                                        </td>
                                    </tr>

                                    <!-- View Immunization Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="viewImmunizationModal{{ $incomplete2ndDose->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">View Immunization</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- -->
                                            
                                                
                                                <div class="container-fluid my-2 mx-2">
                                                <h4 class="font-weight-light">Personal Information</h4>
                                                <div class="row px-1">
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Firstname</label>
                                                        <input type="text" class="form-control" name="first_name" value="{{ $incomplete2ndDose->first_name }}"  readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Middlename</label>
                                                    <input type="text" class="form-control" name="middle_name"  value="{{ $incomplete2ndDose->middle_name }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Lastname</label>
                                                    <input type="text" class="form-control" name="last_name"  value="{{ $incomplete2ndDose->last_name }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                    
                                    
                                                </div>
                                    
                                                <div class="row px-1">
                                    
                                                    <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Place of Birth</label>
                                                        <input type="text" class="form-control" name="place_of_birth"  value="{{ $incomplete2ndDose->place_of_birth }}" readonly>
                                                    </div>
                                                    </div>
                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <input type="text" name="gender" value="{{ $incomplete2ndDose->gender }}"class="form-control" readonly>
                                                            
                                                        </div>
                                                    </div>
                                                
                                    
                                                </div>
                                            
                                    
                                            <div class="row px-1">
                                    
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    
                                                    <input type="date" class="form-control" name="date_of_birth"  value="{{ $incomplete2ndDose->date_of_birth }}"readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlFile1">Age</label>
                                                        
                                                            <input type="text" name="age" class="form-control" value="{{ $incomplete2ndDose->age }}"  readonly>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                    
                                    
                                            </div>
                                            
                                            <div class="row px-1">
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Province</label>
                                                    <input type="text" class="form-control"  value="{{ $incomplete2ndDose->province }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Municipality</label>
                                                    <input type="text" class="form-control"  value="{{ $incomplete2ndDose->municipality }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                <div class="form-group">
                                                    <label>Barangay</label>
                                                    <input type="text" class="form-control"   value="{{ $incomplete2ndDose->barangay }}" readonly>
                                                </div>
                                                </div>
                                    
                                                <div class="col">
                                                <div class="form-group">
                                                    <label>Contact No.</label>
                                                    <input type="text" class="form-control"   value="{{ $incomplete2ndDose->contact_no }}" readonly>
                                                </div>
                                                </div>
                                    
                                            </div>
                                            
                                    
                                                <div class="row px-1">
                                    
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Father's Name</label>
                                                        <input type="text" class="form-control" name="father_full_name"  value="{{ $incomplete2ndDose->father_full_name }}" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mother's Name</label>
                                                        <input type="text" class="form-control" name="mother_full_name"  value="{{ $incomplete2ndDose->mother_full_name }}" readonly>
                                                    </div>
                                                    </div>
                                    
                                                </div>
                                    
                                                <div class="row px-1">
                                    
                                                    <div class="col-md-6">
                                                    <div class="form-group d-flex align-items-center justify-content-center">
                                                        <label>Height</label>
                                                        <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $incomplete2ndDose->height }}" readonly>
                                                        <label>cm</label>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group d-flex align-items-center justify-content-center">
                                                    @php  
                                                        $weightArray = explode(" ", $incomplete2ndDose->weight);
                                                        $actualWeight = intval(reset($weightArray)); 
                                                        @endphp
                                                        <label>Weight</label>
                                                        <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$incomplete2ndDose->weight}}" readonly>
                                                        <label>kg</label>
                                                    </div>
                                                    </div>
                                    
                                                </div>
                                    
                                                </div>
                                                <div class="container-fluid my-2 mx-2">
                                                <h4 class="font-weight-light">Immunization Details</h4>
                                                <div class="row px-1">
                                    
                                                
                                    
                                                    <div class="col">
                                                        <label>Vaccine Name</label>
                                                        <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $incomplete2ndDose->vaccine_received}}" >    
                                                    </div>
                                                    <div class="col">
                                                        <label>Category</label>
                                                        <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $incomplete2ndDose->immunization_category->immunization_category_name}}" >
                                                    </div>
                                    
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="col">
                                                    <label>Doses</label>
                                                    <input type="number" value="{{ $incomplete2ndDose->doses}}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col">
                                                    <label>Doses Received</label>
                                                        <input type="text" name="doses_received" value="{{ $incomplete2ndDose->doses_received }}"  class="form-control" readonly>
                                                    </div>
                                                </div>
                                    
                                    
                                                
                                                    @if($incomplete2ndDose->doses == 1)
                                                    <div class="row">
                                                        <div class="col">
                                                        <label>First Dose</label>
                                                        <input type="datetime" name="first_dose_schedule" value="{{ date('M-d-Y g:i A',strtotime($incomplete2ndDose->first_dose_schedule))." @ ".$incomplete2ndDose->first_dose_vaccinated_at}}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    @elseif($incomplete2ndDose->doses == 2)
                                                    <div class="row">
                                                    <div class="col">
                                                        <label>First Dose</label>
                                                        <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete2ndDose->first_dose_schedule))." @ ".$incomplete2ndDose->first_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label>Second Dose</label>
                                                        <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete2ndDose->second_dose_schedule))." @ ".$incomplete2ndDose->second_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    </div>
                                                    
                                                    @else
                                                    <div class="row">
                                                    <div class="col">
                                                        <label>First Dose</label>
                                                        <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete2ndDose->first_dose_schedule))." @ ".$incomplete2ndDose->first_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label>Second Dose</label>
                                                        <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete2ndDose->second_dose_schedule))." @ ".$incomplete2ndDose->second_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col">
                                                        <label>Third Dose</label>
                                                        <input type="datetime" name="third_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete2ndDose->third_dose_schedule))." @ ".$incomplete2ndDose->third_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    </div>
                                                    @endif
                                                
                                    
                                                <div class="row">
                                                    <div class="col">
                                                    <label>Remarks</label>
                                                    <textarea name="remarks" class="form-control" style="resize: none;"  rows="5" readonly>{{$incomplete2ndDose->remarks}}</textarea>
                                                    </div>
                                                </div>
                                                </div>
                                    
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        
                                        
                                            </div>
                                        </div>
                                        </div>
                                    </div> 
                                    <!-- View Immunization Modal -->
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th class="text-light">ID</th>
                                    <th class="text-light">Name</th>
                                    <th>Category</th>
                                    <th>Dose</th>
                                    <th class="text-light">Dose Received</th>
                                    <th class="text-light">Second Dose Schedule</th>
                                    <th>Location</th>
                                    <th class="text-light">Action</th>
                                </tr>
                            </tfoot>
                         </table>
                        </div>
                    </div>
                </div>
                <!-- -->
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            Missed Third Dose
                        </div>
                        <div class="card-body">
                            
                        
                        <table class="table table-bordered text-center w-100" id="filterExceeded3rdDose">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Dose</th>
                                    <th>Dose Received</th>
                                    <th>Third Dose Schedule</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($incompletes3rdDose as $incomplete3rdDose)
                                    <tr class="text-center">
                                        <td>{{$incomplete3rdDose->id}}</td>
                                        <td>{{ $incomplete3rdDose->first_name . ' ' . $incomplete3rdDose->middle_name . ' ' . $incomplete3rdDose->last_name }}
                                        </td>
                                        <td>{{ $incomplete3rdDose->immunization_category->immunization_category_name }}</td>
                                        <td>{{ $incomplete3rdDose->doses }}</td>
                                        <td>{{ $incomplete3rdDose->doses_received }}</td>
                                        <td>{{ $incomplete3rdDose->third_dose_schedule }}</td>
                                        <td>{{ $incomplete3rdDose->third_dose_vaccinated_at}}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewImmunizationModal{{ $incomplete3rdDose->id }}"><i class="fas fa-eye"></i></button>
                                        </td>
                                    </tr>

                                    <!-- View Immunization Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="viewImmunizationModal{{ $incomplete3rdDose->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">View Immunization</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- -->
                                            
                                                
                                                <div class="container-fluid my-2 mx-2">
                                                <h4 class="font-weight-light">Personal Information</h4>
                                                <div class="row px-1">
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Firstname</label>
                                                        <input type="text" class="form-control" name="first_name" value="{{ $incomplete3rdDose->first_name }}"  readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Middlename</label>
                                                    <input type="text" class="form-control" name="middle_name"  value="{{ $incomplete3rdDose->middle_name }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Lastname</label>
                                                    <input type="text" class="form-control" name="last_name"  value="{{ $incomplete3rdDose->last_name }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                    
                                    
                                                </div>
                                    
                                                <div class="row px-1">
                                    
                                                    <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Place of Birth</label>
                                                        <input type="text" class="form-control" name="place_of_birth"  value="{{ $incomplete3rdDose->place_of_birth }}" readonly>
                                                    </div>
                                                    </div>
                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <input type="text" name="gender" value="{{ $incomplete3rdDose->gender }}"class="form-control" readonly>
                                                            
                                                        </div>
                                                    </div>
                                                
                                    
                                                </div>
                                            
                                    
                                            <div class="row px-1">
                                    
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    
                                                    <input type="date" class="form-control" name="date_of_birth"  value="{{ $incomplete3rdDose->date_of_birth }}"readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlFile1">Age</label>
                                                        
                                                            <input type="text" name="age" class="form-control" value="{{ $incomplete3rdDose->age }}"  readonly>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                    
                                    
                                            </div>
                                            
                                            <div class="row px-1">
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Province</label>
                                                    <input type="text" class="form-control"  value="{{ $incomplete3rdDose->province }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Municipality</label>
                                                    <input type="text" class="form-control"  value="{{ $incomplete3rdDose->municipality }}" readonly>
                                                    </div>
                                                </div>
                                    
                                                <div class="col">
                                                <div class="form-group">
                                                    <label>Barangay</label>
                                                    <input type="text" class="form-control"   value="{{ $incomplete3rdDose->barangay }}" readonly>
                                                </div>
                                                </div>
                                    
                                                <div class="col">
                                                <div class="form-group">
                                                    <label>Contact No.</label>
                                                    <input type="text" class="form-control"   value="{{ $incomplete3rdDose->contact_no }}" readonly>
                                                </div>
                                                </div>
                                    
                                            </div>
                                            
                                    
                                                <div class="row px-1">
                                    
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Father's Name</label>
                                                        <input type="text" class="form-control" name="father_full_name"  value="{{ $incomplete3rdDose->father_full_name }}" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mother's Name</label>
                                                        <input type="text" class="form-control" name="mother_full_name"  value="{{ $incomplete3rdDose->mother_full_name }}" readonly>
                                                    </div>
                                                    </div>
                                    
                                                </div>
                                    
                                                <div class="row px-1">
                                    
                                                    <div class="col-md-6">
                                                    <div class="form-group d-flex align-items-center justify-content-center">
                                                        <label>Height</label>
                                                        <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $incomplete3rdDose->height }}" readonly>
                                                        <label>cm</label>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group d-flex align-items-center justify-content-center">
                                                    @php  
                                                        $weightArray = explode(" ", $incomplete3rdDose->weight);
                                                        $actualWeight = intval(reset($weightArray)); 
                                                        @endphp
                                                        <label>Weight</label>
                                                        <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$incomplete3rdDose->weight}}" readonly>
                                                        <label>kg</label>
                                                    </div>
                                                    </div>
                                    
                                                </div>
                                    
                                                </div>
                                                <div class="container-fluid my-2 mx-2">
                                                <h4 class="font-weight-light">Immunization Details</h4>
                                                <div class="row px-1">
                                    
                                                
                                    
                                                    <div class="col">
                                                            <label>Vaccine Name</label>
                                                            <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $incomplete3rdDose->vaccine_received}}" >
                                                            
                                                    </div>
                                                    <div class="col">
                                                        <label>Category</label>
                                                        <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $incomplete3rdDose->immunization_category->immunization_category_name}}" >
                                                    </div>
                                    
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="col">
                                                    <label>Doses</label>
                                                    <input type="number" value="{{ $incomplete3rdDose->doses}}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col">
                                                    <label>Doses Received</label>
                                                        <input type="text" name="doses_received" value="{{ $incomplete3rdDose->doses_received }}"  class="form-control" readonly>
                                                    </div>
                                                </div>
                                    
                                    
                                                
                                                    @if($incomplete3rdDose->doses == 1)
                                                    <div class="row">
                                                        <div class="col">
                                                        <label>First Dose</label>
                                                        <input type="datetime" name="first_dose_schedule" value="{{ date('M-d-Y g:i A',strtotime($incomplete3rdDose->first_dose_schedule))." @ ".$incomplete3rdDose->first_dose_vaccinated_at}}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    @elseif($incomplete3rdDose->doses == 2)
                                                    <div class="row">
                                                    <div class="col">
                                                        <label>First Dose</label>
                                                        <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete3rdDose->first_dose_schedule))." @ ".$incomplete3rdDose->first_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label>Second Dose</label>
                                                        <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete3rdDose->second_dose_schedule))." @ ".$incomplete3rdDose->second_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    </div>
                                                    
                                                    @else
                                                    <div class="row">
                                                    <div class="col">
                                                        <label>First Dose</label>
                                                        <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete3rdDose->first_dose_schedule))." @ ".$incomplete3rdDose->first_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label>Second Dose</label>
                                                        <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete3rdDose->second_dose_schedule))." @ ".$incomplete3rdDose->second_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col">
                                                        <label>Third Dose</label>
                                                        <input type="datetime" name="third_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($incomplete3rdDose->third_dose_schedule))." @ ".$incomplete3rdDose->third_dose_vaccinated_at}}" class="form-control" readonly>
                                                    </div>
                                                    </div>
                                                    @endif
                                                
                                    
                                                <div class="row">
                                                    <div class="col">
                                                    <label>Remarks</label>
                                                    <textarea name="remarks" class="form-control" style="resize: none;"  rows="5" readonly>{{$incomplete3rdDose->remarks}}</textarea>
                                                    </div>
                                                </div>
                                                </div>
                                    
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        
                                        
                                            </div>
                                        </div>
                                        </div>
                                    </div> 
                                    <!-- View Immunization Modal -->
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th class="text-light">ID</th>
                                    <th class="text-light">Name</th>
                                    <th>Category</th>
                                    <th>Dose</th>
                                    <th class="text-light">Dose Received</th>
                                    <th class="text-light">Second Dose Schedule</th>
                                    <th>Location</th>
                                    <th class="text-light">Action</th>
                                </tr>
                            </tfoot>
                         </table>
                        </div>
                    </div>
                </div>
                <!-- -->
            </div>
              
          </div>
       

            







    </div>
    <!-- /.container-fluid -->




    </div>
    <!-- End of Main Content -->

    <!-- Immunization This Day Modal -->
    <div class="modal fade bd-example-modal-xl" id="viewImmunizationThisDayModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Immunization This Day</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- -->
                    <table class="table table-bordered text-center w-100" id="thisDayImmunization">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">Name</th>
                                <th rowspan="2">Category</th>
                                <th rowspan="2">Vaccine Received</th>
                                <th rowspan="2">Dose(s)</th>
                                <th rowspan="2">Dose(s) Received</th>
                                <th colspan="3">Dose Management</th>
                                <th rowspan="2">Status</th>
                                {{-- <th rowspan="2">Action</th> --}}
                            </tr>
                            <tr class="text-center">
                                <th>First Dose</th>
                                <th>Second Dose</th>
                                <th>Third Dose</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($immunizationsThisDay as $immunizationThisDay)
                                <tr class="text-center">
                                    <td>{{ $immunizationThisDay->first_name . ' ' . $immunizationThisDay->middle_name . ' ' . $immunizationThisDay->last_name }}
                                    </td>
                                    <td>{{ $immunizationThisDay->immunization_category->immunization_category_name }}</td>
                                    <td>{{ $immunizationThisDay->vaccine_received }}</td>
                                    <td>{{ $immunizationThisDay->doses }}</td>
                                    <td>{{ $immunizationThisDay->doses_received }}</td>
                                    <td>{{ $immunizationThisDay->first_dose_schedule . ' @ ' . $immunizationThisDay->first_dose_vaccinated_at }}
                                    </td>
                                    <td>
                                        @if ($immunizationThisDay->second_dose_schedule == 'Not Applicable')
                                            {{ 'Not Applicable' }}
                                        @else
                                            {{ $immunizationThisDay->second_dose_schedule . ' @ ' . $immunizationThisDay->second_dose_vaccinated_at }}
                                        @endif


                                    </td>
                                    <td>
                                        @if ($immunizationThisDay->third_dose_schedule == 'Not Applicable')
                                            {{ 'Not Applicable' }}
                                        @else
                                            {{ $immunizationThisDay->third_dose_schedule . ' @ ' . $immunizationThisDay->third_dose_vaccinated_at }}
                                        @endif

                                    </td>
                                    <td>
                                        @if ($immunizationThisDay->doses_received === $immunizationThisDay->doses)
                                            <p class="d-flex justify-content-center align-items-center">
                                            <p
                                                class="d-flex justify-content-center align-items-center small  rounded text-dark font-weight-bold p-1 text-center text-small">
                                                Dose(s) Completed</p>
                                        @elseif($immunizationThisDay->doses == '2')
                                            @if ($immunizationThisDay->doses_received >= 1)
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 2nd Dose</p>
                                            @endif
                                        @else
                                            @if ($immunizationThisDay->doses_received === 1)
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 2nd Dose and 3rd Dose</p>
                                            @else
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 3rd Dose</p>
                                            @endif
                                        @endif
                                    </td>
                                    {{-- <td class="d-flex justify-content-around align-items-center gap-1">

                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewImmunizationThisDayModal{{ $immunizationThisDay->id }}"><i class="fas fa-eye"></i></i></button>
                            
                          </td> --}}



                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th rowspan="2" class="text-light">Name</th>
                                <th rowspan="2" class="text-light">Category</th>
                                <th rowspan="2">Vaccine Received</th>
                                <th rowspan="2">Dose(s)</th>
                                <th rowspan="2">Dose(s) Received</th>
                                <th colspan="3" class="text-light">Dose Management</th>
                                <th rowspan="2">Status</th>
                            </tr>
                            <tr class="text-center">
                                <th class="text-light">First Dose</th>
                                <th class="text-light">Second Dose</th>
                                <th class="text-light">Third Dose</th>
                            </tr>
                        </tfoot>
                    </table>



                    <!-- -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Immunization This Day Modal-->

    <!-- Immunization This Month Modal -->
    <div class="modal fade bd-example-modal-xl" id="viewImmunizationThisMonthModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Immunization This Month</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- -->
                    <table class="table table-bordered text-center w-100" id="thisMonthImmunization">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">Name</th>
                                <th rowspan="2">Category</th>
                                <th rowspan="2">Vaccine Received</th>
                                <th rowspan="2">Dose(s)</th>
                                <th rowspan="2">Dose(s) Received</th>
                                <th colspan="3">Dose Management</th>
                                <th rowspan="2">Status</th>

                            </tr>
                            <tr class="text-center">
                                <th>First Dose</th>
                                <th>Second Dose</th>
                                <th>Third Dose</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($immunizationsThisMonth as $immunizationThisMonth)
                                <tr class="text-center">
                                    <td>{{ $immunizationThisMonth->first_name . ' ' . $immunizationThisMonth->middle_name . ' ' . $immunizationThisMonth->last_name }}
                                    </td>
                                    <td>{{ $immunizationThisMonth->immunization_category->immunization_category_name }}
                                    </td>
                                    <td>{{ $immunizationThisMonth->vaccine_received }}</td>
                                    <td>{{ $immunizationThisMonth->doses }}</td>
                                    <td>{{ $immunizationThisMonth->doses_received }}</td>
                                    <td>{{ $immunizationThisMonth->first_dose_schedule . ' @ ' . $immunizationThisMonth->first_dose_vaccinated_at }}
                                    </td>
                                    <td>
                                        @if ($immunizationThisMonth->second_dose_schedule == 'Not Applicable')
                                            {{ 'Not Applicable' }}
                                        @else
                                            {{ $immunizationThisMonth->second_dose_schedule . ' @ ' . $immunizationThisMonth->second_dose_vaccinated_at }}
                                        @endif


                                    </td>
                                    <td>
                                        @if ($immunizationThisMonth->third_dose_schedule == 'Not Applicable')
                                            {{ 'Not Applicable' }}
                                        @else
                                            {{ $immunizationThisMonth->third_dose_schedule . ' @ ' . $immunizationThisMonth->third_dose_vaccinated_at }}
                                        @endif

                                    </td>
                                    <td>
                                        @if ($immunizationThisMonth->doses_received === $immunizationThisMonth->doses)
                                            <p class="d-flex justify-content-center align-items-center">
                                            <p
                                                class="d-flex justify-content-center align-items-center small text-dark font-weight-bold p-1 text-center text-small">
                                                Dose(s) Completed</p>
                                        @elseif($immunizationThisMonth->doses == '2')
                                            @if ($immunizationThisMonth->doses_received >= 1)
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold p-1 text-center text-small">
                                                    Incomplete 2nd Dose</p>
                                            @endif
                                        @else
                                            @if ($immunizationThisMonth->doses_received === 1)
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 2nd Dose and 3rd Dose</p>
                                            @else
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 3rd Dose</p>
                                            @endif
                                        @endif
                                    </td>




                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th rowspan="2" class="text-light">Name</th>
                                <th rowspan="2" class="text-light">Category</th>
                                <th rowspan="2">Vaccine Received</th>
                                <th rowspan="2">Dose(s)</th>
                                <th rowspan="2">Dose(s) Received</th>
                                <th colspan="3" class="text-light">Dose Management</th>
                                <th rowspan="2">Status</th>

                            </tr>
                            <tr class="text-center">
                                <th class="text-light">First Dose</th>
                                <th class="text-light">Second Dose</th>
                                <th class="text-light">Third Dose</th>
                            </tr>
                        </tfoot>
                    </table>



                    <!-- -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Immunization This Month Modal-->

    <!-- Immunization This Year Modal -->
    <div class="modal fade bd-example-modal-xl" id="viewImmunizationThisYearModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Immunization This Year</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- -->
                    <table class="table table-bordered text-center w-100" id="thisYearImmunization">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">Name</th>
                                <th rowspan="2">Category</th>
                                <th rowspan="2">Vaccine Received</th>
                                <th rowspan="2">Dose(s)</th>
                                <th rowspan="2">Dose(s) Received</th>
                                <th colspan="3">Dose Management</th>
                                <th rowspan="2">Status</th>

                            </tr>
                            <tr class="text-center">
                                <th>First Dose</th>
                                <th>Second Dose</th>
                                <th>Third Dose</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($immunizationsThisYear as $immunizationThisYear)
                                <tr class="text-center">
                                    <td>{{ $immunizationThisYear->first_name . ' ' . $immunizationThisYear->middle_name . ' ' . $immunizationThisYear->last_name }}
                                    </td>
                                    <td>{{ $immunizationThisYear->immunization_category->immunization_category_name }}</td>
                                    <td>{{ $immunizationThisYear->vaccine_received }}</td>
                                    <td>{{ $immunizationThisYear->doses }}</td>
                                    <td>{{ $immunizationThisYear->doses_received }}</td>
                                    <td>{{ $immunizationThisYear->first_dose_schedule . ' @ ' . $immunizationThisYear->first_dose_vaccinated_at }}
                                    </td>
                                    <td>
                                        @if ($immunizationThisYear->second_dose_schedule == 'Not Applicable')
                                            {{ 'Not Applicable' }}
                                        @else
                                            {{ $immunizationThisYear->second_dose_schedule . ' @ ' . $immunizationThisYear->second_dose_vaccinated_at }}
                                        @endif


                                    </td>
                                    <td>
                                        @if ($immunizationThisYear->third_dose_schedule == 'Not Applicable')
                                            {{ 'Not Applicable' }}
                                        @else
                                            {{ $immunizationThisYear->third_dose_schedule . ' @ ' . $immunizationThisYear->third_dose_vaccinated_at }}
                                        @endif

                                    </td>
                                    <td>
                                        @if ($immunizationThisYear->doses_received === $immunizationThisYear->doses)
                                            <p class="d-flex justify-content-center align-items-center">
                                            <p
                                                class="d-flex justify-content-center align-items-center small text-dark font-weight-bold p-1 text-center text-small">
                                                Dose(s) Completed</p>
                                        @elseif($immunizationThisYear->doses == '2')
                                            @if ($immunizationThisYear->doses_received >= 1)
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 2nd Dose</p>
                                            @endif
                                        @else
                                            @if ($immunizationThisYear->doses_received === 1)
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 2nd Dose and 3rd Dose</p>
                                            @else
                                                <p class="d-flex justify-content-center align-items-center">
                                                <p
                                                    class="d-flex justify-content-center align-items-center small text-dark font-weight-bold rounded text-light p-1 text-center text-small">
                                                    Incomplete 3rd Dose</p>
                                            @endif
                                        @endif
                                    </td>




                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th rowspan="2" class="text-light">Name</th>
                                <th rowspan="2" class="text-light">Category</th>
                                <th rowspan="2">Vaccine Received</th>
                                <th rowspan="2">Dose(s)</th>
                                <th rowspan="2">Dose(s) Received</th>
                                <th colspan="3" class="text-light">Dose Management</th>
                                <th rowspan="2">Status</th>

                            </tr>
                            <tr class="text-center">
                                <th class="text-light">First Dose</th>
                                <th class="text-light">Second Dose</th>
                                <th class="text-light">Third Dose</th>
                            </tr>
                        </tfoot>
                    </table>



                    <!-- -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Immunization This Year Modal-->
@endsection
