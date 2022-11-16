@section('title')
  E-TUROK MO | SCHOOL AGED IMMUNIZATION
@endsection

@extends('layouts.user_navigation')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid px-4">


    @include('layouts.flash-message')

   <!-- Page Heading -->
   <form action="{{ route('schoolAgedMultiAction') }}" method="POST" style="margin:0;padding:0;">
    @csrf
    <!--Multi Archive Modal -->
    <div class="modal fade" id="multiArchiveModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Archive Immunization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">

                <h3 class="font-weight-light">Are you sure you want to archive selected immunizations?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                
                    
                    <button type="submit" class="btn btn-danger">Yes</button>
                


            </div>
        </div>
    </div>
</div>
<!--Multi Archive Modal -->
<!--Administered Immunizations-->
<div class="modal fade" id="multiAdministerModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Administer Immunization</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">

            <h3 class="font-weight-light">Are you sure you want to administer selected vaccines?</h3>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

            
                
                <button type="submit" class="btn btn-primary">Yes</button>
            


          </div>
      </div>
  </div>
</div>
<!--Administered Immunizations-->
<div class="d-flex justify-content-between align-items-center">

  <div class="d-flex justify-content-between align-items-center">
    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addImmunizationModal">Add Immunization</button>
  </div>
  <div class="d-flex align-items-center justify-content-around">
   <div class="p-1">
       <label>On Selected</label>
   </div>
   
   <div class="p-1">
       <select name="actions"  class="form-select" id="options">
           <option value="Archive">Archive</option>
           <option value="Administer">Administer</option>
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
        <h5 class="m-0 font-weight-bold text-primary">School Aged Immunizations</h5>
    </div>
    <div class="card-body">
    
        <div class="table-responsive">
            <table class="table table-bordered" id="filterDataTable" width="100%" cellspacing="0" >
                <thead>
                    <tr class="text-center">
                        <th rowspan="2"></th>
                        <th rowspan="2">ID</th>
                        <th rowspan="2">Name</th>
                       
                        <th rowspan="2">Vaccine Received</th>
                        <th rowspan="2">Dose(s)</th>
                        <th rowspan="2">Dose(s) Received</th>
                        <th colspan="3">Dose Management</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Action</th>
                    </tr>
                    <tr class="text-center">
                      <th>First Dose</th>
                      <th>Second Dose</th>
                      <th>Third Dose</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                       @foreach ($immunizations as $immunization)
                      <tr class="text-center">
                        <td class="text-center"><input type="checkbox" class="form-check-input" name="immunizationIds[]" value="{{ $immunization->id }}"></td>
                        <td>{{$immunization->id}}</td>
                        <td>{{$immunization->first_name." ". $immunization->middle_name." ".$immunization->last_name}}</td>
                        <td>{{$immunization->vaccine_received}}</td>
                        <td>{{$immunization->doses}}</td>
                        <td>{{$immunization->doses_received}}</td>
                        <td>{{ $immunization->first_dose_schedule." @ ".$immunization->first_dose_vaccinated_at }}</td>
                        <td> 
                        @if($immunization->second_dose_schedule == "Not Applicable")
                          {{ "Not Applicable" }}
                        
                        @else
                          {{ $immunization->second_dose_schedule." @ ".$immunization->second_dose_vaccinated_at }}
                        
                        @endif
                     
                       
                        </td>
                        <td>
                          @if($immunization->third_dose_schedule == "Not Applicable")
                            {{ "Not Applicable" }}
                        
                          @else
                            {{ $immunization->third_dose_schedule." @ ".$immunization->third_dose_vaccinated_at }}
                          @endif
                          
                        </td>
                        <td>
                          @if ($immunization->doses_received === $immunization->doses)
                              <p class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small font-weight-bold rounded text-dark p-1 text-center text-small">Dose(s) Completed</p>
                          @elseif($immunization->doses == "2")
                              @if ($immunization->doses_received >= 1)
                                <p class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small  font-weight-bold rounded text-dark p-1 text-center text-small">Incomplete 2nd Dose</p>
                              @endif
                              
                          @else
                            @if ($immunization->doses_received === 1)
                              <p class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small  font-weight-bold rounded text-dark p-1 text-center text-small">Incomplete 2nd Dose and 3rd Dose</p>
                            @else
                              <p class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small  font-weight-bold rounded text-dark p-1 text-center text-small">Incomplete 3rd Dose</p>
                           @endif
                          @endif
                        </td>
                        <td class="d-flex justify-content-between align-items-center gap-1">
                          <span data-toggle="tooltip"  data-placement="right" title="View">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewImmunizationModal{{ $immunization->id }}"><i class="fas fa-eye"></i></button>
                          </span>
                          <span data-toggle="tooltip"  data-placement="right" title="Edit">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editImmunizationModal{{ $immunization->id }}"><i class="fas fa-edit"></i></button>
                          </span>
                          <span data-toggle="tooltip"  data-placement="right" title="Administer">
                            <button type="button" class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#administeredImmunizationModal{{ $immunization->id }}" @disabled($immunization->doses_received >= $immunization->doses)><i class="fas fa-syringe"></i></button>
                          </span>
                          @if(in_array(auth()->user()->user_type_id,[1,2]))
                          <span data-toggle="tooltip"  data-placement="right" title="Send SMS">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#sendSMSModal{{ $immunization->id }}" @disabled($immunization->doses_received >= $immunization->doses)><i class="fas fa-sms" ></i></button>
                          </span>
                          @endif
                          <span data-toggle="tooltip"  data-placement="right" title="Archive">
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteImmunizationModal{{ $immunization->id }}"><i class="fas fa-archive"></i></button>
                          </span>
                        </td>

                        

                      </tr>
                      @endforeach
                         
                    
                </tbody>
                <tfoot>
                  <tr class="text-center">
                    <th rowspan="2" class="text-light">checkbox</th>
                    <th rowspan="2" class="text-light">ID</th>
                    <th rowspan="2" class="text-light">Name</th>
                   
                    <th rowspan="2">Vaccine Received</th>
                    <th rowspan="2">Dose(s)</th>
                    <th rowspan="2">Dose(s) Received</th>
                    <th colspan="3" class="text-light">Dose Management</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2" class="text-light">Action</th>
                </tr>
                <tr class="text-center">
                  <th class="text-light">First Dose</th>
                  <th class="text-light">Second Dose</th>
                  <th class="text-light">Third Dose</th>
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

    <!-- Add Immunization Modal -->
        <div class="modal fade bd-example-modal-lg" id="addImmunizationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Immunization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <!-- -->
                   <form action="{{ route('school_aged_immunizations.store') }}" method="post"> 
                    @csrf
                    
                      <div class="container-fluid my-2 mx-2">
                        <h4 class="font-weight-light">Personal Information</h4>
                        <div class="row px-1">
                        <input type="hidden" name="immunization_category_id" value= "2">
                        <div class="col">
                            <div class="form-group">
                              <label>Firstname</label>
                              <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                            </div>
                        </div>
    
                        <div class="col">
                          <div class="form-group">
                            <label>Middlename</label>
                            <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name')}}">
                          </div>
                        </div>
    
                        <div class="col">
                          <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                          </div>
                        </div>
    
                            
    
                        </div>
    
                        <div class="row px-1">
    
                          <div class="col-md-7">
                            <div class="form-group">
                              <label>Date of Birth</label>
                              @php  
                                $maxDate = date('Y-m-d');
                              @endphp
                              <input type="date" class="form-control" name="date_of_birth"  max=" {{$maxDate}} " value="{{ old('date_of_birth') }}">
                            </div>
                          </div>
    
                          <div class="col-md-5">
                                <div class="form-group">
                                  <label>Gender</label>
                                
                                
                                {{-- <select class="form-control" aria-label="Default select example" name="sex" value="{{ old('sex') }}">
                                    <option value="Male" {{ (old('sex') == "Male") ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ (old('sex') == "Female") ? 'selected' : '' }}>Female</option>
                                </select> --}}
                                <div class="form-check">
                                  <input class="form-check-input mr-5" type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked(old('sex') == "Male")>
                                  <label class="form-check-label mr-5" for="flexRadioDefault1">
                                    Male
                                  </label>
                                  <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked(old('sex') == "Female")>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                  </label>
                                </div>
                                
                                

                                </div>
                            </div>
                        </div>
    
                        <div class="row px-1">
    
                          <div class="col-md-7">
                            <div class="form-group">
                              <label>Place of Birth</label>
                              <input type="text" class="form-control" name="place_of_birth" value="{{ old('place_of_birth') }}">
                            </div>
                          </div>
    
                          <div class="col">
                            <div class="form-group">
                              <label>Contact No.</label>
                              <input type="number" class="form-control" name="contact_no" value="{{ old('contact_no') }}">
                            </div>
                          </div>
    
                        </div>
    
                        <div class="row px-1">
    
                          <div class="col">
                            <label for="province" >{{ __('Province') }}</label>
                            <input type="text" name="province" class="form-control" value="Laguna" disabled>
                          </div>

                          <div class="col">
                            <label for="municipality" >{{ __('Municiplaity') }}</label>
                            <input type="text" name="municipality" class="form-control" value="Pila" disabled>
                          </div>

                          <div class="col">
                            <label for="barangay">{{ __('Barangay') }}</label>
                            <select  class="form-control" name="barangay"  required autocomplete="barangay" autofocus>
                                <option selected disabled>--Select Barangay--</option>
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

                            
                        </div>


                          
    
                        </div>
    
                        <div class="row px-1">
    
                           <div class="col-md-6">
                            <div class="form-group">
                              <label>Father's Name</label>
                              <input type="text" class="form-control" name="father_full_name" value="{{ old('father_full_name') }}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Mother's Name</label>
                              <input type="text" class="form-control" name="mother_full_name" value="{{ old('mother_full_name') }}">
                            </div>
                          </div>
    
                        </div>
    
                        <div class="row px-1">
    
                           <div class="col-md-6">
                            <label>Height</label>
                            <div class="form-group d-flex align-items-center justify-content-center" step=".01">
                              
                              <input type="number" class="form-control mr-2" name="height" value="{{ old('height') }}">
                              <label>cm</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label>Weight</label>
                            <div class="form-group d-flex align-items-center justify-content-center" >
                              
                              <input type="number" class="form-control mr-2" name="weight" value="{{ old('weight') }}">
                              <label>kg</label>
                            </div>
                          </div>
    
                        </div>
    
                      </div>
                      <div class="container-fluid my-2 mx-2">
                        <h4 class="font-weight-light">Immunization Details</h4>
                        <div class="row px-1">
                            <div class="col-md-6">
                                  <label>Vaccine Name</label>
                                  <select name="vaccine_received" id="vaccine_name" class="form-control"   >
                                    <option disabled selected>Select Vaccine</option>
                                    @foreach ($vaccines as $vaccine)
                                    <option value='{{ $vaccine->vaccine_name }}' {{ (old('vaccine_received') == $vaccine->vaccine_name) ? 'selected' : '' }}>{{ $vaccine->vaccine_name }}</option>
                                    @endforeach
                                  </select>
                                  <input type="hidden" value='1' name="doses_received">
                            </div>

                            <div class="col-md-6">
                              <label>Vaccinated at</label>
                              <select class="form-control" name="first_dose_vaccinated_at">
                                <option selected disabled>--Select Location--</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'RHU Pila') value="RHU Pila">RHU Pila</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Aplaya Health Center') value="Brgy. Aplaya Health Center">Brgy. Aplaya Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Bagong Pook Health Center') value="Brgy. Bagong Pook Health Center">Brgy. Bagong Pook Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Bukal Health Center') value="Brgy. Bukal Health Center">Brgy. Bukal Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Bulilan Norte Health Center') value="Brgy. Bulilan Norte Health Center">Brgy. Bulilan Norte Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Bulilan Sur Health Center') value="Brgy. Bulilan Sur Health Center">Brgy. Bulilan Sur Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Concepcion Health Center') value="Brgy. Concepcion Health Center">Brgy. Concepcion Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Labuin Health Center') value="Brgy. Labuin Health Center">Brgy. Labuin Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Linga Health Center') value="Brgy. Linga Health Center">Brgy. Linga Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Masico Health Center') value="Brgy. Masico Health Center">Brgy. Masico Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Mojon Health Center') value="Brgy. Mojon Health Center">Brgy. Mojon Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Pansol Health Center') value="Brgy. Pansol Health Center">Brgy. Pansol Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Pinagbayanan Health Center') value="Brgy. Pinagbayanan Health Center">Brgy. Pinagbayanan Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. San Antonio Health Center') value="Brgy. San Antonio Health Center">Brgy. San Antonio Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. San Miguel Health Center') value="Brgy. San Miguel Health Center">Brgy. San Miguel Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Santa Clara Norte Health Center') value="Brgy. Santa Clara Norte Health Center">Brgy. Santa Clara Norte Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Santa Clara Sur Health Center') value="Brgy. Santa Clara Sur Health Center">Brgy. Santa Clara Sur Health Center</option>
                                <option @selected(old('first_dose_vaccinated_at') == 'Brgy. Tubuan Health Center') value="Brgy. Tubuan Health Center">Brgy. Tubuan Health Center</option>
                            </select>
                            </div>
    
                        </div>
    
                        <div class="row px-1">
                          <div class="col">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control" style="resize: none;"  rows="5">{{ old('remarks') }}</textarea>
                          </div>
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
    <!-- Add Immunization Modal -->

     @foreach($immunizations as $immunization) 

        <!-- Delete Immunization Modal -->

        <div class="modal fade" id="deleteImmunizationModal{{ $immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Vaccine</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body text-center">
                 
                <h3 class="font-weight-light">Are you sure you want to achive this record?</h3>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

               <form action="{{ route('school_aged_immunizations.destroy', $immunization->id) }}" method="POST"> 
                @csrf
                @method('DELETE')

                <input type="hidden" class="form-control" name="immunization_id" value="{{ $immunization->id }}" required>

                <input type="hidden" class="form-control" name="immunization_category_id" value="{{ $immunization->immunization_category->id }}" required>

                <input type="hidden" class="form-control" name="first_name" value="{{ $immunization->first_name }}" required>
                        

                    
                <input type="hidden" class="form-control" name="middle_name" required value="{{ $immunization->middle_name }}">
              

           
                <input type="hidden" class="form-control" name="last_name" required value="{{ $immunization->last_name }}">
              

                

            
                  <input type="hidden" class="form-control" name="date_of_birth" required value="{{ $immunization->date_of_birth }}">
               

              
                    <input type="hidden" class="form-control" name="gender" required value="{{ $immunization->gender }}">
                   

            
                
                <input type="hidden" class="form-control" name="place_of_birth" required value="{{ $immunization->place_of_birth }}">
              
                      <input type="hidden" class="form-control" name="age" required value="{{ $immunization->age }}">
                      
             
                  <input type="hidden" class="form-control" name="barangay" required value="{{ $immunization->barangay }}">

                  <input type="hidden" class="form-control" name="municipality" required value="{{ $immunization->municipality }}">

                  <input type="hidden" class="form-control" name="province" required value="{{ $immunization->province }}">
                
                  <input type="hidden" class="form-control" name="contact_no" required value="{{ $immunization->contact_no }}">
                
            
                  <input type="hidden" class="form-control" name="father_full_name" required value="{{ $immunization->father_full_name }}">
                
                  <input type="hidden" class="form-control" name="mother_full_name" required  value="{{ $immunization->mother_full_name }}">
                
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="height" required value="{{ $immunization->height }}">
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="weight" required value="{{ $immunization->weight }}">
                  
          
                    
                  
                      

                      <input type="hidden" name="vaccine_received" value="{{ $immunization->vaccine_received }}">
               
                <input type="hidden" name="doses" value="{{ $immunization->doses }}">
              
                <input type="hidden" name="doses_received" value="{{ $immunization->doses_received }}">
                <input type="hidden" name="first_dose_schedule" value="{{ $immunization->first_dose_schedule }}">
                <input type="hidden" name="second_dose_schedule" value="{{ $immunization->second_dose_schedule }}">
                <input type="hidden" name="third_dose_schedule" value="{{ $immunization->third_dose_schedule }}">

                <input type="hidden" name="first_dose_vaccinated_at" value="{{ $immunization->first_dose_vaccinated_at }}">
                <input type="hidden" name="second_dose_vaccinated_at" value="{{ $immunization->second_dose_vaccinated_at }}">
                <input type="hidden" name="third_dose_vaccinated_at" value="{{ $immunization->third_dose_vaccinated_at }}">

              
                <input type="hidden"name="remarks" class="form-control" value="{{ $immunization->remarks }}">

                <input type="hidden" name="date_recorded" class="form-control"  value="{{ $immunization->date_recorded }}">

                

                  <button type="submit" class="btn btn-danger" >Yes</button>
                </form>
              
              
              </div>
          </div>
          </div>
      </div>
      
  <!-- Delete Immunization Modal -->


          <!-- Administered Immunization Modal -->

          <div class="modal fade" id="administeredImmunizationModal{{ $immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Administered Immunization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body text-center">
                   
                  <h3 class="font-weight-light">Are you sure you want to administer next dose?</h3>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  
                 <form action="{{ route('school_aged.administered', $immunization->id) }}" method="POST"> 
                  @csrf
                  
  
                  <input type="hidden" class="form-control" name="immunization_id" value="{{ $immunization->id }}" required>
  
                  
  
                  
  
                    <button type="submit" class="btn btn-primary" >Yes</button>
                  </form>
                
                
                </div>
            </div>
            </div>
        </div>
        
    <!-- Administered Immunization Modal -->

  <!-- Edit Immunization Modal -->
  <div class="modal fade bd-example-modal-lg" id="editImmunizationModal{{ $immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Immunization</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <!-- -->
          <form action="{{ route('school_aged_immunizations.update', $immunization->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="container-fluid my-2 mx-2">
              <h4 class="font-weight-light">Personal Information</h4>
              <div class="row px-1">

              <div class="col">
                  <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $immunization->first_name }}" >
                  </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>Middlename</label>
                  <input type="text" class="form-control" name="middle_name"  value="{{ $immunization->middle_name }}">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>Lastname</label>
                  <input type="text" class="form-control" name="last_name"  value="{{ $immunization->last_name }}">
                </div>
              </div>

                  

              </div>

              <div class="row px-1">

                 <div class="col-md-3">
                  <div class="form-group">
                    <label>Place of Birth</label>
                    <input type="text" class="form-control" name="place_of_birth"  value="{{ $immunization->place_of_birth }}">
                  </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                      <label>Gender</label>
                      <div class="form-check">
                        <input class="form-check-input mr-5" type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked($immunization->gender == "Male")>
                        <label class="form-check-label mr-5" for="flexRadioDefault1">
                          Male
                        </label>
                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked($immunization->gender == "Female")>
                        <label class="form-check-label" for="flexRadioDefault2">
                          Female
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <input type="date" class="form-control" name="date_of_birth"  value="{{ $immunization->date_of_birth }}">
                    </div>
                  </div>
             

              </div>

           

  
              <div class="row px-1 mt-4">

                 <div class="col">
                  <div class="form-group">
                    <label>Province</label>
                    <input type="text" class="form-control" name="province"  value="{{ $immunization->province }}" readonly>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label>Municipality</label>
                    <input type="text" class="form-control" name="municipality"  value="{{ $immunization->municipality }}" readonly>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label>Barangay</label>
                    <select  class="form-control" name="barangay"  required autocomplete="barangay" autofocus>
                      <option selected disabled>--Select Barangay--</option>
                      <option @selected($immunization->barangay == 'Aplaya') value="Aplaya">Aplaya</option>
                      <option @selected($immunization->barangay == 'Bagong Pook') value="Bagong Pook">Bagong Pook</option>
                      <option @selected($immunization->barangay == 'Bukal') value="Bukal">Bukal</option>
                      <option @selected($immunization->barangay == 'Bulilan Norte') value="Bulilan Norte">Bulilan Norte</option>
                      <option @selected($immunization->barangay == 'Bulilan Sur') value="Bulilan Sur">Bulilan Sur</option>
                      <option @selected($immunization->barangay == 'Concepcion') value="Concepcion">Concepcion</option>
                      <option @selected($immunization->barangay == 'Labuin') value="Labuin">Labuin</option>
                      <option @selected($immunization->barangay == 'Linga') value="Linga">Linga</option>
                      <option @selected($immunization->barangay == 'Masico') value="Masico">Masico</option>
                      <option @selected($immunization->barangay == 'Mojon') value="Mojon">Mojon</option>
                      <option @selected($immunization->barangay == 'Pansol') value="Pansol">Pansol</option>
                      <option @selected($immunization->barangay == 'Pinagbayanan') value="Pinagbayanan">Pinagbayanan</option>
                      <option @selected($immunization->barangay == 'San Antonio') value="San Antonio">San Antonio</option>
                      <option @selected($immunization->barangay == 'San Miguel') value="San Miguel">San Miguel</option>
                      <option @selected($immunization->barangay == 'Santa Clara Norte') value="Santa Clara Norte">Santa Clara Norte</option>
                      <option @selected($immunization->barangay == 'Santa Clara Sur') value="Santa Clara Sur">Santa Clara Sur</option>
                      <option @selected($immunization->barangay == 'Tubuan') value="Tubuan">Tubuan</option>
                  </select>
                  </div>
                </div>


                <div class="col">
                  <div class="form-group">
                    <label>Contact No.</label>
                    <input type="number" class="form-control" name="contact_no"  value="{{ $immunization->contact_no }}">
                  </div>
                </div>

              </div>

              <div class="row px-1">

                 <div class="col-md-6">
                  <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" class="form-control" name="father_full_name"  value="{{ $immunization->father_full_name }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mother's Name</label>
                    <input type="text" class="form-control" name="mother_full_name"  value="{{ $immunization->mother_full_name }}">
                  </div>
                </div>

              </div>

              <div class="row px-1">

                 <div class="col-md-6">
                  <div class="form-group d-flex align-items-center justify-content-center">
                    <label>Height</label>
                    <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $immunization->height }}">
                    <label>cm</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group d-flex align-items-center justify-content-center">
                    <label>Weight</label>
                    <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$immunization->weight}}">
                    <label>kg</label>
                  </div>
                </div>

              </div>

            </div>
            <div class="container-fluid my-2 mx-2">
              <h4 class="font-weight-light">Immunization Details</h4>
              <div class="row px-1">

              

                  <div class="col-md-6">
                        <label>Vaccine Name</label>
                        <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $immunization->vaccine_received}}">
                          
                  </div>
                  <div class="col">
                    <label>Doses</label>
                    <input type="number" value="{{ $immunization->doses}}" class="form-control" readonly>
                  </div>
                  <div class="col">
                    <label>Doses Received</label>
                    <input type="text" name="doses_received" value="{{$immunization->doses_received}}" class="form-control" readonly>
                    
  
                  </div>

              </div>

              @if($immunization->doses == 1)
                <div class="row">
                  <div class="col">
                    <label>First Dose</label>
                    <input type="datetime" name="first_dose_schedule" value="{{ date('M-d-Y g:i A',strtotime($immunization->first_dose_schedule))." @ ".$immunization->first_dose_vaccinated_at}}" class="form-control" readonly>
                  </div>
                </div>
              @elseif($immunization->doses == 2)
              <div class="row">
                <div class="col">
                  <label>First Dose</label>
                  <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($immunization->first_dose_schedule))." @ ".$immunization->first_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>Second Dose</label>
                  <input type="datetime-local" name="second_dose_schedule" value="{{$immunization->second_dose_schedule}}" class="form-control" {{ ($immunization->doses_received >= 2) ? 'readonly' : '' }} min="{{$immunization->second_dose_schedule}}">
                </div>
                <div class="col">
                  <label>Location</label>
                  <select class="form-control" name="second_dose_vaccinated_at" {{ ($immunization->doses_received >= 2) ? 'readonly' : '' }}>
                    <option selected disabled>--Select Location--</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'RHU Pila') value="RHU Pila">RHU Pila</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Aplaya Health Center') value="Brgy. Aplaya Health Center">Brgy. Aplaya Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bagong Pook Health Center') value="Brgy. Bagong Pook Health Center">Brgy. Bagong Pook Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bukal Health Center') value="Brgy. Bukal Health Center">Brgy. Bukal Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bulilan Norte Health Center') value="Brgy. Bulilan Norte Health Center">Brgy. Bulilan Norte Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bulilan Sur Health Center') value="Brgy. Bulilan Sur Health Center">Brgy. Bulilan Sur Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Concepcion Health Center') value="Brgy. Concepcion Health Center">Brgy. Concepcion Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Labuin Health Center') value="Brgy. Labuin Health Center">Brgy. Labuin Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Linga Health Center') value="Brgy. Linga Health Center">Brgy. Linga Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Masico Health Center') value="Brgy. Masico Health Center">Brgy. Masico Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Mojon Health Center') value="Brgy. Mojon Health Center">Brgy. Mojon Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Pansol Health Center') value="Brgy. Pansol Health Center">Brgy. Pansol Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Pinagbayanan Health Center') value="Brgy. Pinagbayanan Health Center">Brgy. Pinagbayanan Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. San Antonio Health Center') value="Brgy. San Antonio Health Center">Brgy. San Antonio Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. San Miguel Health Center') value="Brgy. San Miguel Health Center">Brgy. San Miguel Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Santa Clara Norte Health Center') value="Brgy. Santa Clara Norte Health Center">Brgy. Santa Clara Norte Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Santa Clara Sur Health Center') value="Brgy. Santa Clara Sur Health Center">Brgy. Santa Clara Sur Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Tubuan Health Center') value="Brgy. Tubuan Health Center">Brgy. Tubuan Health Center</option>
                </select>
                </div>
              </div>
              
              @else
              <div class="row">
                <div class="col">
                  <label>First Dose</label>
                  <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($immunization->first_dose_schedule))." @ ".$immunization->first_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>Second Dose</label>
                  <input type="datetime-local" name="second_dose_schedule" value="{{$immunization->second_dose_schedule}}" class="form-control" {{ ($immunization->doses_received >= 2) ? 'readonly' : '' }} min="{{$immunization->second_dose_schedule}}">
                </div>
                <div class="col">
                  <label>Location</label>
                  <select class="form-control" name="second_dose_vaccinated_at" {{ ($immunization->doses_received >= 2) ? 'readonly' : '' }}>
                    <option selected disabled>--Select Location--</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'RHU Pila') value="RHU Pila">RHU Pila</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Aplaya Health Center') value="Brgy. Aplaya Health Center">Brgy. Aplaya Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bagong Pook Health Center') value="Brgy. Bagong Pook Health Center">Brgy. Bagong Pook Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bukal Health Center') value="Brgy. Bukal Health Center">Brgy. Bukal Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bulilan Norte Health Center') value="Brgy. Bulilan Norte Health Center">Brgy. Bulilan Norte Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Bulilan Sur Health Center') value="Brgy. Bulilan Sur Health Center">Brgy. Bulilan Sur Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Concepcion Health Center') value="Brgy. Concepcion Health Center">Brgy. Concepcion Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Labuin Health Center') value="Brgy. Labuin Health Center">Brgy. Labuin Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Linga Health Center') value="Brgy. Linga Health Center">Brgy. Linga Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Masico Health Center') value="Brgy. Masico Health Center">Brgy. Masico Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Mojon Health Center') value="Brgy. Mojon Health Center">Brgy. Mojon Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Pansol Health Center') value="Brgy. Pansol Health Center">Brgy. Pansol Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Pinagbayanan Health Center') value="Brgy. Pinagbayanan Health Center">Brgy. Pinagbayanan Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. San Antonio Health Center') value="Brgy. San Antonio Health Center">Brgy. San Antonio Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. San Miguel Health Center') value="Brgy. San Miguel Health Center">Brgy. San Miguel Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Santa Clara Norte Health Center') value="Brgy. Santa Clara Norte Health Center">Brgy. Santa Clara Norte Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Santa Clara Sur Health Center') value="Brgy. Santa Clara Sur Health Center">Brgy. Santa Clara Sur Health Center</option>
                    <option @selected($immunization->second_dose_vaccinated_at == 'Brgy. Tubuan Health Center') value="Brgy. Tubuan Health Center">Brgy. Tubuan Health Center</option>
                </select>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>Third Dose</label>
                  <input type="datetime-local" name="third_dose_schedule" value="{{$immunization->third_dose_schedule}}" class="form-control" {{ ($immunization->doses_received >= 3) ? 'readonly' : '' }} min="{{$immunization->third_dose_schedule}}">
                </div>
                <div class="col">
                  <label>Location</label>
                  <select class="form-control" name="third_dose_vaccinated_at" {{ ($immunization->doses_received >= 3) ? 'readonly' : '' }}>
                    <option selected disabled>--Select Location--</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'RHU Pila') value="RHU Pila">RHU Pila</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Aplaya Health Center') value="Brgy. Aplaya Health Center">Brgy. Aplaya Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Bagong Pook Health Center') value="Brgy. Bagong Pook Health Center">Brgy. Bagong Pook Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Bukal Health Center') value="Brgy. Bukal Health Center">Brgy. Bukal Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Bulilan Norte Health Center') value="Brgy. Bulilan Norte Health Center">Brgy. Bulilan Norte Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Bulilan Sur Health Center') value="Brgy. Bulilan Sur Health Center">Brgy. Bulilan Sur Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Concepcion Health Center') value="Brgy. Concepcion Health Center">Brgy. Concepcion Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Labuin Health Center') value="Brgy. Labuin Health Center">Brgy. Labuin Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Linga Health Center') value="Brgy. Linga Health Center">Brgy. Linga Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Masico Health Center') value="Brgy. Masico Health Center">Brgy. Masico Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Mojon Health Center') value="Brgy. Mojon Health Center">Brgy. Mojon Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Pansol Health Center') value="Brgy. Pansol Health Center">Brgy. Pansol Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Pinagbayanan Health Center') value="Brgy. Pinagbayanan Health Center">Brgy. Pinagbayanan Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. San Antonio Health Center') value="Brgy. San Antonio Health Center">Brgy. San Antonio Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. San Miguel Health Center') value="Brgy. San Miguel Health Center">Brgy. San Miguel Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Santa Clara Norte Health Center') value="Brgy. Santa Clara Norte Health Center">Brgy. Santa Clara Norte Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Santa Clara Sur Health Center') value="Brgy. Santa Clara Sur Health Center">Brgy. Santa Clara Sur Health Center</option>
                    <option @selected($immunization->third_dose_vaccinated_at == 'Brgy. Tubuan Health Center') value="Brgy. Tubuan Health Center">Brgy. Tubuan Health Center</option>
                </select>
                </div>
              </div>
              @endif

              

              <div class="row px-1">
                <div class="col">
                  <label>Remarks</label>
                  <textarea name="remarks" class="form-control" style="resize: none;"  rows="5">{{$immunization->remarks}}</textarea>
                </div>
              </div>
            </div

             -->
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </div>
    </div>
    </div>
</div> 
<!-- Edit Immunization Modal -->


<!-- View Immunization Modal -->
<div class="modal fade bd-example-modal-lg" id="viewImmunizationModal{{ $immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <input type="text" class="form-control" name="first_name" value="{{ $immunization->first_name }}"  readonly>
                </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Middlename</label>
                <input type="text" class="form-control" name="middle_name"  value="{{ $immunization->middle_name }}" readonly>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Lastname</label>
                <input type="text" class="form-control" name="last_name"  value="{{ $immunization->last_name }}" readonly>
              </div>
            </div>

                

            </div>

            <div class="row px-1">

              <div class="col-md-8">
                <div class="form-group">
                  <label>Place of Birth</label>
                  <input type="text" class="form-control" name="place_of_birth"  value="{{ $immunization->place_of_birth }}" readonly>
                </div>
              </div>

              <div class="col-md-4">
                    <div class="form-group">
                      <label>Gender</label>
                      <input type="text" name="gender" value="{{ $immunization->gender }}"class="form-control" readonly>
                      
                    </div>
                </div>
           

            </div>
         

         <div class="row px-1">

            <div class="col-md-8">
              <div class="form-group">
                <label>Date of Birth</label>
                
                <input type="date" class="form-control" name="date_of_birth"  value="{{ $immunization->date_of_birth }}"readonly>
              </div>
            </div>

            <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleFormControlFile1">Age</label>
                     
                        <input type="text" name="age" class="form-control" value="{{ $immunization->age }}"  readonly>
                        
                      
                  </div>
              </div>


         </div>
         
         <div class="row px-1">

            <div class="col">
              <div class="form-group">
                <label>Province</label>
                <input type="text" class="form-control"  value="{{ $immunization->province }}" readonly>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Municipality</label>
                <input type="text" class="form-control"  value="{{ $immunization->municipality }}" readonly>
              </div>
            </div>

          <div class="col">
            <div class="form-group">
              <label>Barangay</label>
              <input type="text" class="form-control"   value="{{ $immunization->barangay }}" readonly>
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label>Contact No.</label>
              <input type="text" class="form-control"   value="{{ $immunization->contact_no }}" readonly>
            </div>
          </div>

       </div>
      

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group">
                  <label>Father's Name</label>
                  <input type="text" class="form-control" name="father_full_name"  value="{{ $immunization->father_full_name }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mother's Name</label>
                  <input type="text" class="form-control" name="mother_full_name"  value="{{ $immunization->mother_full_name }}" readonly>
                </div>
              </div>

            </div>

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                  <label>Height</label>
                  <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $immunization->height }}" readonly>
                  <label>cm</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                @php  
                  $weightArray = explode(" ", $immunization->weight);
                  $actualWeight = intval(reset($weightArray)); 
                  @endphp
                  <label>Weight</label>
                  <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$immunization->weight}}" readonly>
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
                      <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $immunization->vaccine_received}}" >
                        
                </div>

            </div>

            <div class="row">
              <div class="col">
                <label>Doses</label>
                <input type="number" value="{{ $immunization->doses}}" class="form-control" readonly>
              </div>
              <div class="col">
                <label>Doses Received</label>
                  <input type="text" name="doses_received" value="{{ $immunization->doses_received }}"  class="form-control" readonly>
              </div>
            </div>


           
              @if($immunization->doses == 1)
                <div class="row">
                  <div class="col">
                    <label>First Dose</label>
                    <input type="datetime" name="first_dose_schedule" value="{{ date('M-d-Y g:i A',strtotime($immunization->first_dose_schedule))." @ ".$immunization->first_dose_vaccinated_at}}" class="form-control" readonly>
                  </div>
                </div>
              @elseif($immunization->doses == 2)
              <div class="row">
                <div class="col">
                  <label>First Dose</label>
                  <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($immunization->first_dose_schedule))." @ ".$immunization->first_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
                <div class="col">
                  <label>Second Dose</label>
                  <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($immunization->second_dose_schedule))." @ ".$immunization->second_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              
              @else
              <div class="row">
                <div class="col">
                  <label>First Dose</label>
                  <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($immunization->first_dose_schedule))." @ ".$immunization->first_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
                <div class="col">
                  <label>Second Dose</label>
                  <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($immunization->second_dose_schedule))." @ ".$immunization->second_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>Third Dose</label>
                  <input type="datetime" name="third_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($immunization->third_dose_schedule))." @ ".$immunization->third_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              @endif
           

            <div class="row">
              <div class="col">
                <label>Remarks</label>
                <textarea name="remarks" class="form-control" style="resize: none;"  rows="5" readonly>{{$immunization->remarks}}</textarea>
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

<!-- SMS Modal -->
<div class="modal fade" id="sendSMSModal{{ $immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Send SMS</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <!-- -->
      <form action="{{ route('sendSMS')}}" method="GET"> 
          @csrf
          
          
          <div class="container-fluid my-2 mx-2">
            <div class="row px-1">

              <div class="col">
                  <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $immunization->first_name }}"  readonly>
                  </div>
              </div>
  
              <div class="col">
                <div class="form-group">
                  <label>Middlename</label>
                  <input type="text" class="form-control" name="middle_name"  value="{{ $immunization->middle_name }}" readonly>
                </div>
              </div>
  
              <div class="col">
                <div class="form-group">
                  <label>Lastname</label>
                  <input type="text" class="form-control" name="last_name"  value="{{ $immunization->last_name }}" readonly>
                </div>
              </div>

              
  
                  
  
              </div>

              <div class="row px-1">

                <div class="col">
                  <div class="form-group">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" name="contact_no"  value="{{ $immunization->contact_no }}" readonly>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label>Vaccine Name</label>
                    <input type="text" class="form-control" name="vaccine_name"  value="{{ $immunization->vaccine_received }}" readonly>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col">
                  <label for="">Message</label>
                  @if ($immunization->doses_received == '1')
                    <textarea name="message" class="form-control" cols="30" rows="10">{{ "Good Day ". $immunization->first_name." ".$immunization->middle_name." ".$immunization->last_name. " your schedule of second dose immunization is on ".$immunization->second_dose_schedule." at ".$immunization->second_dose_vaccinated_at.", Thankyou"
                      }}
                  </textarea>
                  @else
                    <textarea name="message" class="form-control" cols="30" rows="10">{{ "Good Day ". $immunization->first_name." ".$immunization->middle_name." ".$immunization->last_name. " your schedule of third dose immunization is on ".$immunization->third_dose_schedule." at ".$immunization->third_dose_vaccinated_at.", Thankyou"
                    }}
                </textarea>
                @endif
                </div>
              </div>
          </div> 
          <!-- -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Send</button>
      </form>
      </div>
  </div>
  </div>
</div>
<!-- SMS Modal -->
 @endforeach 

<!-- Modals -->

<script>
  $(document).ready(function(){ //Make script DOM ready
  $('#options-button').click(function() { //jQuery Change Function

      var opval = $('#options').val(); //Get value from select element
      if(opval=="Archive"){
          $('#multiArchiveModal').modal("show"); //Open Modal
      }
      else if(opval=="Administer"){
          $('#multiAdministerModal').modal("show"); //Open Modal
      }
  });
});
</script>



@endsection
