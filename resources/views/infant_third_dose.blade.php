@extends('layouts.user_navigation')
@section('title')
  E-TUROK MO | THIRD DOSE IMMUNIZATION
@endsection
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid px-4">

  

    @include('layouts.flash-message')


    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Infant Third Dose Immunizations</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="filterThirdDoseDataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Address</th>
                            
                            <th>Vaccine Received</th>
                            <th>Dose(s)</th>
                            <th>Dose(s) Received</th>
                            <th>First Dose Schedule</th>
                            <th>Second Dose Schedule</th>
                            <th>Third Dose Schedule</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                           @foreach ($third_doses as $third_dose)
                          <tr class="text-center">
                            <td>{{$third_dose->first_name." ". $third_dose->middle_name." ".$third_dose->last_name}}</td>
                            <td>{{$third_dose->barangay.", ".$third_dose->municipality.", ".$third_dose->province}}</td>
                            <td>{{$third_dose->vaccine_received}}</td>
                            <td>{{$third_dose->doses}}</td>
                            <td>{{$third_dose->doses_received}}</td>
                            <td>{{date('M-d-Y h:i A',strtotime($third_dose->first_dose_schedule)) .' @ '. $third_dose->first_dose_vaccinated_at}}</td>
                            <td>
                              @if($third_dose->second_dose_schedule == "Set Schedule" || $third_dose->second_dose_schedule == "")
                                {{
                                 ""
                                }}
                              @else
                              {{date('M-d-Y h:i A',strtotime($third_dose->second_dose_schedule)) .' @ '. $third_dose->second_dose_vaccinated_at}}
                              @endif
                          </td>
                            <td>
                                @if ($third_dose->third_dose_schedule == "Set Schedule" || $third_dose->third_dose_schedule == "")
                                  @if (in_array(auth()->user()->user_type_id, [1,2]))
                                    <button data-toggle="modal" data-target="#setScheduleModal{{ $third_dose->id }}" class="bg-primary border rounded text-light p-1 text-decoration-none cursor-pointer btn btn-sm">Set Schedule</button>
                                  @else
                                    {{""}}
                                  @endif
                                  
                                @else
                                {{date('M-d-Y h:i A',strtotime($third_dose->third_dose_schedule)) .' @ '. $third_dose->third_dose_vaccinated_at}}
                                @endif
                            </td>
                            <td class="d-flex justify-content-around align-items-center">
                              <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#viewImmunizationModal{{ $third_dose->id }}"><i class="fas fa-eye"></i></i></button>
                              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editImmunizationModal{{ $third_dose->id }}"><i class="fas fa-edit"></i></button>
                              @if (in_array(auth()->user()->user_type_id, [1,2]))
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#sendSMSModal{{ $third_dose->id }}" @disabled($third_dose->third_dose_schedule == "Set Schedule" || $third_dose->third_dose_schedule == "")><i class="fas fa-sms"></i></button> 
                              @endif
                              
                              
                            </td>

                            

                          </tr>
                          @endforeach
                             
                        
                    </tbody>
                    <tfoot>
                      <tr class="text-center">
                        <th class="text-light">Name</th>
                        <th>Address</th>
                        <th>Vaccine Received</th>
                        <th>Dose(s)</th>
                        <th>Dose(s) Received</th>
                        <th class="text-light">First Dose Schedule</th>
                        <th class="text-light">Second Dose Schedule</th>
                        <th>Third Dose Schedule</th>
                        <th class="text-light">Action</th>
                      </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->




<!-- Modals -->

     @foreach($third_doses as $third_dose) 

        <!-- Set Schedule Modal -->
        <div class="modal fade" id="setScheduleModal{{ $third_dose->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <!-- -->
                <form action="{{ route('3rdinfantsetSchedule', $third_dose->id) }}" method="post"> 
                    @method('PUT')
                    @csrf
                    
                    
                    <div class="container-fluid my-2 mx-2">
                      <label>Third Dose Schedule</label>
                      @php
                          date_default_timezone_set('Asia/Manila');
                          $datenow = date('Y-m-d')."T00:00";
                      @endphp
                      <input type="datetime-local" name="third_dose_schedule" class="form-control" min="{{ $datenow }}">
                  </div> 

                  <div class="container-fluid my-2 mx-2">
                    <label>Location</label>
                    <select class="form-control" name="location">
                      <option selected disabled>--Select Location--</option>
                      <option @selected(old('location') == 'RHU Pila') value="RHU Pila">RHU Pila</option>
                      <option @selected(old('location') == 'Brgy. Aplaya Health Center') value="Brgy. Aplaya Health Center">Brgy. Aplaya Health Center</option>
                      <option @selected(old('location') == 'Brgy. Bagong Pook Health Center') value="Brgy. Bagong Pook Health Center">Brgy. Bagong Pook Health Center</option>
                      <option @selected(old('location') == 'Brgy. Bukal Health Center') value="Brgy. Bukal Health Center">Brgy. Bukal Health Center</option>
                      <option @selected(old('location') == 'Brgy. Bulilan Norte Health Center') value="Brgy. Bulilan Norte Health Center">Brgy. Bulilan Norte Health Center</option>
                      <option @selected(old('location') == 'Brgy. Bulilan Sur Health Center') value="Brgy. Bulilan Sur Health Center">Brgy. Bulilan Sur Health Center</option>
                      <option @selected(old('location') == 'Brgy. Concepcion Health Center') value="Brgy. Concepcion Health Center">Brgy. Concepcion Health Center</option>
                      <option @selected(old('location') == 'Brgy. Labuin Health Center') value="Brgy. Labuin Health Center">Brgy. Labuin Health Center</option>
                      <option @selected(old('location') == 'Brgy. Linga Health Center') value="Brgy. Linga Health Center">Brgy. Linga Health Center</option>
                      <option @selected(old('location') == 'Brgy. Masico Health Center') value="Brgy. Masico Health Center">Brgy. Masico Health Center</option>
                      <option @selected(old('location') == 'Brgy. Mojon Health Center') value="Brgy. Mojon Health Center">Brgy. Mojon Health Center</option>
                      <option @selected(old('location') == 'Brgy. Pansol Health Center') value="Brgy. Pansol Health Center">Brgy. Pansol Health Center</option>
                      <option @selected(old('location') == 'Brgy. Pinagbayanan Health Center') value="Brgy. Pinagbayanan Health Center">Brgy. Pinagbayanan Health Center</option>
                      <option @selected(old('location') == 'Brgy. San Antonio Health Center') value="Brgy. San Antonio Health Center">Brgy. San Antonio Health Center</option>
                      <option @selected(old('location') == 'Brgy. San Miguel Health Center') value="Brgy. San Miguel Health Center">Brgy. San Miguel Health Center</option>
                      <option @selected(old('location') == 'Brgy. Santa Clara Norte Health Center') value="Brgy. Santa Clara Norte Health Center">Brgy. Santa Clara Norte Health Center</option>
                      <option @selected(old('location') == 'Brgy. Santa Clara Sur Health Center') value="Brgy. Santa Clara Sur Health Center">Brgy. Santa Clara Sur Health Center</option>
                      <option @selected(old('location') == 'Brgy. Tubuan Health Center') value="Brgy. Tubuan Health Center">Brgy. Tubuan Health Center</option>
                  </select>
                  </div> 
                    <!-- -->
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Set</button>
                </form>
                </div>
            </div>
            </div>
        </div>
        <!-- Set Schedule Modal -->

        <!-- Delete Immunization Modal -->

        <div class="modal fade" id="deleteImmunizationModal{{ $third_dose->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Vaccine</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body text-center">
                 
                <h3 class="font-weight-light">Are you sure you want to delete?</h3>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

               <form action="" method="POST"> 
                @csrf
                @method('DELETE')

                <input type="hidden" class="form-control" name="immunization_id" value="{{ $third_dose->id }}" required>

                <input type="hidden" class="form-control" name="immunization_category_id" value="{{ $third_dose->immunization_category->id }}" required>

                <input type="hidden" class="form-control" name="first_name" value="{{ $third_dose->first_name }}" required>
                        

                    
                <input type="hidden" class="form-control" name="middle_name" required value="{{ $third_dose->middle_name }}">
              

           
                <input type="hidden" class="form-control" name="last_name" required value="{{ $third_dose->last_name }}">
              

                

            
                  <input type="hidden" class="form-control" name="date_of_birth" required value="{{ $third_dose->date_of_birth }}">
               

              
                    <input type="hidden" class="form-control" name="sex" required value="{{ $third_dose->sex }}">
                   

            
                
                <input type="hidden" class="form-control" name="place_of_birth" required value="{{ $third_dose->place_of_birth }}">
              
                      <input type="hidden" class="form-control" name="age" required value="{{ $third_dose->age }}">
                      
             
                  <input type="hidden" class="form-control" name="address" required value="{{ $third_dose->address }}">
                
                  <input type="hidden" class="form-control" name="contact_no" required value="{{ $third_dose->contact_no }}">
                
            
                  <input type="hidden" class="form-control" name="father_full_name" required value="{{ $third_dose->father_full_name }}">
                
                  <input type="hidden" class="form-control" name="mother_full_name" required  value="{{ $third_dose->mother_full_name }}">
                
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="height" required value="{{ $third_dose->height }}">
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="weight" required value="{{ $third_dose->weight }}">
                  
          
                    
                  
                      

                      <input type="hidden" name="vaccine_received" value="{{ $third_dose->vaccine_received }}">
               
                <input type="hidden" name="doses" value="{{ $third_dose->doses }}">
              
                <input type="hidden" name="doses_received" value="{{ $third_dose->doses_received }}">
                <input type="hidden" name="first_dose_schedule" value="{{ $third_dose->first_dose_schedule }}">
                <input type="hidden" name="second_dose_schedule" value="{{ $third_dose->second_dose_schedule }}">
                <input type="hidden" name="third_dose_schedule" value="{{ $third_dose->third_dose_schedule }}">

              
                <input type="hidden"name="remarks" class="form-control" value="{{ $third_dose->remarks }}">

                <input type="hidden" name="date_recorded" class="form-control"  value="{{ $third_dose->created_at }}">

                <input type="hidden" name="date_updated" class="form-control"  value="{{ $third_dose->updated_at }}">  

                  <button type="submit" class="btn btn-danger" >Yes</button>
                </form>
              
              
              </div>
          </div>
          </div>
      </div>
      
  <!-- Delete Immunization Modal -->

  <!-- Edit Immunization Modal -->
  <div class="modal fade bd-example-modal-lg" id="editImmunizationModal{{ $third_dose->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="{{ route('3rdeditInfantImmunization', $third_dose->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="container-fluid my-2 mx-2">
              <h4 class="font-weight-light">Personal Information</h4>
              <div class="row px-1">

              <div class="col">
                  <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $third_dose->first_name }}" readonly>
                  </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>Middlename</label>
                  <input type="text" class="form-control" name="middle_name"  value="{{ $third_dose->middle_name }}" readonly>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>Lastname</label>
                  <input type="text" class="form-control" name="last_name"  value="{{ $third_dose->last_name }}" readonly>
                </div>
              </div>

                  

              </div>

              <div class="row px-1">

                 <div class="col-md-8">
                  <div class="form-group">
                    <label>Place of Birth</label>
                    <input type="text" class="form-control" name="place_of_birth"  value="{{ $third_dose->place_of_birth }}" readonly>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Gender</label>
                    <div class="form-check">
                      <input class="form-check-input mr-5" type="radio" name="gender" id="flexRadioDefault1" value="Male" @checked($third_dose->gender == "Male")>
                      <label class="form-check-label mr-5" for="flexRadioDefault1">
                        Male
                      </label>
                      <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female" @checked($third_dose->gender == "Female")>
                      <label class="form-check-label" for="flexRadioDefault2">
                        Female
                      </label>
                    </div>
                  </div>
                </div>

                
             

              </div>

           <div class="row px-1">

              <div class="col-md-12">
                <div class="form-group">
                  <label>Date of Birth</label>
                  
                  <input type="date" class="form-control" name="date_of_birth"  value="{{ $third_dose->date_of_birth }}" readonly>
                </div>
              </div>



           </div>
              <div class="row px-1 mt-4">

                <div class="col">
                  <div class="form-group">
                   <label>Province</label>
                   <input type="text" class="form-control"  value="{{ $third_dose->province }}" readonly>
                  </div>
                 </div>
                 
                 <div class="col">
                  <div class="form-group">
                   <label>Municipality</label>
                    <input type="text" class="form-control"  value="{{ $third_dose->municipality }}" readonly>
                  </div>
                 </div>
                 
                 <div class="col">
                  <div class="form-group">
                   <label>Barangay</label>
                   <input type="text" class="form-control"   value="{{ $third_dose->barangay }}" readonly>
                  </div>
                 </div>


                <div class="col-md-3">
                  <div class="form-group">
                    <label>Contact No.</label>
                    <input type="number" class="form-control" name="contact_no"  value="{{ $third_dose->contact_no }}">
                  </div>
                </div>

              </div>

              <div class="row px-1">

                 <div class="col-md-6">
                  <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" class="form-control" name="father_full_name"  value="{{ $third_dose->father_full_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mother's Name</label>
                    <input type="text" class="form-control" name="mother_full_name"  value="{{ $third_dose->mother_full_name }}" readonly>
                  </div>
                </div>

              </div>

              <div class="row px-1">

                 <div class="col-md-6">
                  <div class="form-group d-flex align-items-center justify-content-center">
                    <label>Height</label>
                    @php  
                    $heightArray = explode(" ",  $third_dose->height);
                    $actualHeight = reset($heightArray); 
                    @endphp
                    <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $third_dose->height }}" readonly>
                    <label>cm</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group d-flex align-items-center justify-content-center">
                  @php  
                    $weightArray = explode(" ", $third_dose->weight);
                    $actualWeight = intval(reset($weightArray)); 
                    @endphp
                    <label>Weight</label>
                    <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$third_dose->height}}" readonly>
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
                        <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $third_dose->vaccine_received}}">
                          
                  </div>

              </div>

              <div class="row">
                <div class="col">
                  <label>Doses</label>
                  <input type="number" value="{{ $third_dose->doses}}" class="form-control" readonly>
                </div>
                <div class="col">
                  <label>Doses Received</label>
                  <select name="doses_received" class="form-control">
                  
                   
                    @if($third_dose->doses == 1)
                      <option selected value="1">1</option>
                     
                    @elseif($third_dose->doses == 2 && $third_dose->doses_received == 1)
                        <option selected value="1">1</option>
                        <option  value="2">2</option>
                    
                    @elseif($third_dose->doses == 2 && $third_dose->doses_received == 2)
                        
                        <option selected value="2">2</option>
                      
                    @elseif($third_dose->doses == 3 && $third_dose->doses_received == 1)
                        <option selected value="1">1</option>
                        <option  value="2">2</option>
                        <option  value="3">3</option>

                    @elseif($third_dose->doses == 3 && $third_dose->doses_received == 2)
                        <option selected value="2">2</option>
                        <option value="3">3</option>
                    
                    @elseif($third_dose->doses == 3 && $third_dose->doses_received == 3)
                        
                        <option selected value="3">3</option>


                    @endif
                    
                  </select>
                  

                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label>First Dose</label>
                  <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($third_dose->first_dose_schedule))." @ ".$third_dose->first_dose_vaccinated_at}}" class="form-control" readonly >
                </div>

                <div class="col">
                  <label>Second Dose</label>
                  <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($third_dose->second_dose_schedule))." @ ".$third_dose->second_dose_vaccinated_at}}" class="form-control" readonly >
                </div>
                
              </div>
              <div class="row">
                <div class="col">
                  <label>Third Dose Date and Time</label>
                  <input type="datetime-local" name="third_dose_date_time" value="{{$third_dose->third_dose_schedule}}" class="form-control" min="{{$third_dose->third_dose_schedule}}">
                </div>
                <div class="col">
                  <label>Second Dose Location</label>
                  <select class="form-control" name="third_dose_location">
                    <option selected disabled>--Select Location--</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'RHU Pila') value="RHU Pila">RHU Pila</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Aplaya Health Center') value="Brgy. Aplaya Health Center">Brgy. Aplaya Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Bagong Pook Health Center') value="Brgy. Bagong Pook Health Center">Brgy. Bagong Pook Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Bukal Health Center') value="Brgy. Bukal Health Center">Brgy. Bukal Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Bulilan Norte Health Center') value="Brgy. Bulilan Norte Health Center">Brgy. Bulilan Norte Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Bulilan Sur Health Center') value="Brgy. Bulilan Sur Health Center">Brgy. Bulilan Sur Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Concepcion Health Center') value="Brgy. Concepcion Health Center">Brgy. Concepcion Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Labuin Health Center') value="Brgy. Labuin Health Center">Brgy. Labuin Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Linga Health Center') value="Brgy. Linga Health Center">Brgy. Linga Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Masico Health Center') value="Brgy. Masico Health Center">Brgy. Masico Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Mojon Health Center') value="Brgy. Mojon Health Center">Brgy. Mojon Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Pansol Health Center') value="Brgy. Pansol Health Center">Brgy. Pansol Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Pinagbayanan Health Center') value="Brgy. Pinagbayanan Health Center">Brgy. Pinagbayanan Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. San Antonio Health Center') value="Brgy. San Antonio Health Center">Brgy. San Antonio Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. San Miguel Health Center') value="Brgy. San Miguel Health Center">Brgy. San Miguel Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Santa Clara Norte Health Center') value="Brgy. Santa Clara Norte Health Center">Brgy. Santa Clara Norte Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Santa Clara Sur Health Center') value="Brgy. Santa Clara Sur Health Center">Brgy. Santa Clara Sur Health Center</option>
                    <option @selected($third_dose->third_dose_vaccinated_at == 'Brgy. Tubuan Health Center') value="Brgy. Tubuan Health Center">Brgy. Tubuan Health Center</option>
                </select>
                </div>
              </div>

              <div class="row px-1">
                <div class="col">
                  <label>Remarks</label>
                  <textarea name="remarks" class="form-control" style="resize: none;"  rows="5" readonly>{{$third_dose->remarks}}</textarea>
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
<div class="modal fade bd-example-modal-lg" id="viewImmunizationModal{{ $third_dose->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <input type="text" class="form-control" name="first_name" value="{{ $third_dose->first_name }}"  readonly>
                </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Middlename</label>
                <input type="text" class="form-control" name="middle_name"  value="{{ $third_dose->middle_name }}" readonly>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Lastname</label>
                <input type="text" class="form-control" name="last_name"  value="{{ $third_dose->last_name }}" readonly>
              </div>
            </div>

                

            </div>

            <div class="row px-1">

              <div class="col-md-8">
                <div class="form-group">
                  <label>Place of Birth</label>
                  <input type="text" class="form-control" name="place_of_birth"  value="{{ $third_dose->place_of_birth }}" readonly>
                </div>
              </div>

              <div class="col-md-4">
                    <div class="form-group">
                      <label>Gender</label>
                      <input type="text" name="gender" readonly value="{{ $third_dose->gender }}" class="form-control">
                    </div>
                </div>
           

            </div>
         

         <div class="row px-1">

            <div class="col-md-8">
              <div class="form-group">
                <label>Date of Birth</label>
                
                <input type="date" class="form-control" name="date_of_birth"  value="{{ $third_dose->date_of_birth }}"readonly>
              </div>
            </div>

            <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleFormControlFile1">Age</label>
                     
                        <input type="text" name="age" class="form-control" value="{{ $third_dose->age }}"  readonly>
                        
                      
                  </div>
              </div>


         </div>
         
         <div class="row px-1">

          <div class="col">
            <div class="form-group">
             <label>Province</label>
             <input type="text" class="form-control"  value="{{ $third_dose->province }}" readonly>
            </div>
           </div>
           
           <div class="col">
            <div class="form-group">
             <label>Municipality</label>
              <input type="text" class="form-control"  value="{{ $third_dose->municipality }}" readonly>
            </div>
           </div>
           
           <div class="col">
            <div class="form-group">
             <label>Barangay</label>
             <input type="text" class="form-control"   value="{{ $third_dose->barangay }}" readonly>
            </div>
           </div>

          <div class="col">
            <div class="form-group">
              <label>Contact No.</label>
              <input type="text" class="form-control"   value="{{ $third_dose->contact_no }}" readonly>
            </div>
          </div>

       </div>
      

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group">
                  <label>Father's Name</label>
                  <input type="text" class="form-control" name="father_full_name"  value="{{ $third_dose->father_full_name }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mother's Name</label>
                  <input type="text" class="form-control" name="mother_full_name"  value="{{ $third_dose->mother_full_name }}" readonly>
                </div>
              </div>

            </div>

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                  <label>Height</label>
                  @php  
                  $heightArray = explode(" ",  $third_dose->height);
                  $actualHeight = reset($heightArray); 
                  @endphp
                  <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $third_dose->height }}" readonly>
                  <label>cm</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                @php  
                  $weightArray = explode(" ", $third_dose->weight);
                  $actualWeight = intval(reset($weightArray)); 
                  @endphp
                  <label>Weight</label>
                  <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$third_dose->height}}" readonly>
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
                      <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $third_dose->vaccine_received}}" >
                        
                </div>

            </div>

            <div class="row">
              <div class="col">
                <label>Doses</label>
                <input type="number" value="{{ $third_dose->doses}}" class="form-control" readonly>
              </div>
              <div class="col">
                <label>Doses Received</label>
                  <input type="text" name="doses_received" value="{{ $third_dose->doses_received }}"  class="form-control" readonly>
              </div>
            </div>


           
              @if($third_dose->doses == 1)
                <div class="row">
                  <div class="col">
                    <label>First Dose</label>
                    <input type="datetime" name="first_dose_schedule" value="{{ date('M-d-Y g:i A',strtotime($third_dose->first_dose_schedule))." @ ".$third_dose->first_dose_vaccinated_at}}" class="form-control" readonly>
                  </div>
                </div>
              @elseif($third_dose->doses == 2)
              <div class="row">
                <div class="col">
                  <label>First Dose</label>
                  <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($third_dose->first_dose_schedule))." @ ".$third_dose->first_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
                <div class="col">
                  <label>Second Dose</label>
                  <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($third_dose->second_dose_schedule))." @ ".$third_dose->second_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              
              @else
              <div class="row">
                <div class="col">
                  <label>First Dose</label>
                  <input type="datetime" name="first_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($third_dose->first_dose_schedule))." @ ".$third_dose->first_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
                <div class="col">
                  <label>Second Dose</label>
                  <input type="datetime" name="second_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($third_dose->second_dose_schedule))." @ ".$third_dose->second_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>Third Dose</label>
                  <input type="datetime" name="third_dose_schedule" value="{{date('M-d-Y g:i A',strtotime($third_dose->third_dose_schedule))." @ ".$third_dose->third_dose_vaccinated_at}}" class="form-control" readonly>
                </div>
              </div>
              @endif

            <div class="row px-1">
              <div class="col">
                <label>Remarks</label>
                <textarea name="remarks" class="form-control" style="resize: none;"  rows="5" readonly>{{$third_dose->remarks}}</textarea>
              </div>
            </div>
          </div

           -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
     
      </div>
  </div>
  </div>
</div> 
<!-- View Immunization Modal -->
<!-- SMS Modal -->
<div class="modal fade" id="sendSMSModal{{ $third_dose->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="text" class="form-control" name="first_name" value="{{ $third_dose->first_name }}"  readonly>
                  </div>
              </div>
  
              <div class="col">
                <div class="form-group">
                  <label>Middlename</label>
                  <input type="text" class="form-control" name="middle_name"  value="{{ $third_dose->middle_name }}" readonly>
                </div>
              </div>
  
              <div class="col">
                <div class="form-group">
                  <label>Lastname</label>
                  <input type="text" class="form-control" name="last_name"  value="{{ $third_dose->last_name }}" readonly>
                </div>
              </div>

              
  
                  
  
              </div>

              <div class="row px-1">

                <div class="col">
                  <div class="form-group">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" name="contact_no"  value="{{ $third_dose->contact_no }}" readonly>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label>Vaccine Name</label>
                    <input type="text" class="form-control" name="vaccine_name"  value="{{ $third_dose->vaccine_received }}" readonly>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col">
                  <label for="">Message</label>
                  <textarea name="message" class="form-control" cols="30" rows="10">{{ "Good Day ". $third_dose->first_name." ".$third_dose->middle_name." ".$third_dose->last_name. " your schedule of third dose immunization is on ".$third_dose->third_dose_schedule." at Rural Health Unit of Pila Laguna, Thankyou"
                  }}</textarea>
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


@endsection
