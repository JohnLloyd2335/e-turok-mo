@extends('layouts.user_navigation')
@section('title')
  E-TUROK MO | ARCHIVE
@endsection
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid px-4">



    @include('layouts.flash-message')

     <!-- Page Heading -->
     <form action="{{ route('archiveMultiaction') }}" method="POST" style="margin:0;padding:0;">
      @csrf
      <!--Multi Restore Modal -->
      <div class="modal fade" id="multiRestoreModal" tabindex="-1" role="dialog"
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

                  <h3 class="font-weight-light">Are you sure you want to restore selected immunizations?</h3>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                  
                      
                  <button type="submit" class="btn btn-primary">Yes</button>
                  


              </div>
          </div>
      </div>
  </div>
  <!--Multi Restore Modal-->
  <!--Delete Immunizations-->
  <div class="modal fade" id="multiDeleteModal" tabindex="-1" role="dialog"
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

              <h3 class="font-weight-light">Are you sure you want to delete selected immunizations?</h3>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

              
                  
                  
                  <button type="submit" class="btn btn-danger">Yes</button>
              


            </div>
        </div>
    </div>
  </div>
  <!--Delete Immunizations-->
  <div class="d-flex justify-content-end align-items-center">

    <div class="d-flex align-items-center justify-content-around">
     <div class="p-1">
         <label>On Selected</label>
     </div>
     
     <div class="p-1">
         <select name="actions"  class="form-select" id="options">
             <option value="Restore">Restore</option>
             <option value="Delete">Delete</option>
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
            <h5 class="m-0 font-weight-bold text-primary">Archive Records</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="filterArchiveDataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Vaccine Received</th>
                            <th>Dose(s)</th>
                            <th>Dose(s) Received</th>
                            <th>Remarks</th>
                            <th>Date Recorded</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                           @foreach ($archives as $archive)
                          <tr class="text-center">
                            <td class="text-center"><input type="checkbox" class="form-check-input" name="immunizationIds[]" value="{{ $archive->id }}"></td>
                            <td>{{$archive->id}}</td>
                            <td>{{$archive->first_name." " .$archive->middle_name." " .$archive->last_name}}</td>
                            <td>{{$archive->immunization_category->immunization_category_name}}</td>
                            <td>{{$archive->vaccine_received}}</td>
                            <td>{{$archive->doses}}</td>
                            <td>{{$archive->doses_received}}</td>
                            <td>{{$archive->remarks}}</td>
                            <td>{{date('M-d-Y', strtotime($archive->date_recorded))}}</td>

                            <td class="d-flex justify-content-around align-items-center gap-1">
                              <span data-toggle="tooltip"  data-placement="right" title="View">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewImmunizationModal{{ $archive->id }}"><i class="fas fa-eye"></i></i></button>
                              </span>
                              <span data-toggle="tooltip"  data-placement="right" title="Restore">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#restoreImmunizationModal{{ $archive->id }}"><i class="fas fa-trash-restore"></i></button>
                              </span>
                              <span data-toggle="tooltip"  data-placement="right" title="Delete">
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteImmunizationModal{{ $archive->id }}"><i class="fas fa-trash-alt"></i></button>
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
                        <th>Category</th>
                        <th>Vaccine Received</th>
                        <th>Dose(s)</th>
                        <th>Dose(s) Received</th>
                        <th class="text-light">Remarks</th>
                        <th class="text-light">Date Recorded</th>
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

     @foreach($archives as $archive) 

        <!-- Delete Immunization Modal -->

        <div class="modal fade" id="deleteImmunizationModal{{ $archive->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Vaccine</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body text-center">
                 
                <h3 class="font-weight-light">Are you sure you want to permanently delete?</h3>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

               <form action="{{ route('archives.destroy', $archive->id) }}" method="POST"> 
                @csrf
                @method('DELETE')

                <input type="hidden" class="form-control" name="immunization_id" value="{{ $archive->id }}" required>

                <input type="hidden" class="form-control" name="immunization_category_id" value="{{ $archive->immunization_category->id }}" required>

                <input type="hidden" class="form-control" name="first_name" value="{{ $archive->first_name }}" required>
                        

                    
                <input type="hidden" class="form-control" name="middle_name" required value="{{ $archive->middle_name }}">
              

           
                <input type="hidden" class="form-control" name="last_name" required value="{{ $archive->last_name }}">
              

                

            
                  <input type="hidden" class="form-control" name="date_of_birth" required value="{{ $archive->date_of_birth }}">
               

              
                    <input type="hidden" class="form-control" name="sex" required value="{{ $archive->sex }}">
                   

            
                
                <input type="hidden" class="form-control" name="place_of_birth" required value="{{ $archive->place_of_birth }}">
              
                      <input type="hidden" class="form-control" name="age" required value="{{ $archive->age }}">
                      
             
                  <input type="hidden" class="form-control" name="address" required value="{{ $archive->address }}">
                
                  <input type="hidden" class="form-control" name="contact_no" required value="{{ $archive->contact_no }}">
                
            
                  <input type="hidden" class="form-control" name="father_full_name" required value="{{ $archive->father_full_name }}">
                
                  <input type="hidden" class="form-control" name="mother_full_name" required  value="{{ $archive->mother_full_name }}">
                
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="height" required value="{{ $archive->height }}">
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="weight" required value="{{ $archive->weight }}">
                  
          
                    
                  
                      

                      <input type="hidden" name="vaccine_received" value="{{ $archive->vaccine_received }}">
               
                <input type="hidden" name="doses" value="{{ $archive->doses }}">
              
                <input type="hidden" name="doses_received" value="{{ $archive->doses_received }}">
                <input type="hidden" name="first_dose_schedule" value="{{ $archive->first_dose_schedule }}">
                <input type="hidden" name="second_dose_schedule" value="{{ $archive->second_dose_schedule }}">
                <input type="hidden" name="third_dose_schedule" value="{{ $archive->third_dose_schedule }}">

              
                <input type="hidden"name="remarks" class="form-control" value="{{ $archive->remarks }}">

                <input type="hidden" name="date_recorded" class="form-control"  value="{{ $archive->created_at }}">

                <input type="hidden" name="date_updated" class="form-control"  value="{{ $archive->updated_at }}">  

                  <button type="submit" class="btn btn-danger" >Yes</button>
                </form>
              
              
              </div>
          </div>
          </div>
      </div>
      
  <!-- Delete Immunization Modal -->

  <!-- Restore Immunization Modal -->
  <div class="modal fade" id="restoreImmunizationModal{{ $archive->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restore Immunization</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body d-flex align-items-center justify-content-center ">
            <!-- -->
            <h3 class="font-weight-light">Are you sure you want to restore?</h3>
          <form action="{{ route('restore_immunization.destroy', $archive->id) }}" method="post">
            @method('DELETE')
            @csrf
            <input type="hidden" class="form-control" name="immunization_id" value="{{ $archive->id }}" required>

                <input type="hidden" class="form-control" name="immunization_category_id" value="{{ $archive->immunization_category->id }}" required>

                <input type="hidden" class="form-control" name="first_name" value="{{ $archive->first_name }}" required>
                        

                    
                <input type="hidden" class="form-control" name="middle_name" required value="{{ $archive->middle_name }}">
              

           
                <input type="hidden" class="form-control" name="last_name" required value="{{ $archive->last_name }}">
              

                

            
                  <input type="hidden" class="form-control" name="date_of_birth" required value="{{ $archive->date_of_birth }}">
               

              
                    <input type="hidden" class="form-control" name="gender" required value="{{ $archive->gender }}">
                   

            
                
                <input type="hidden" class="form-control" name="place_of_birth" required value="{{ $archive->place_of_birth }}">
              
                      <input type="hidden" class="form-control" name="age" required value="{{ $archive->age }}">
                      
             
                  <input type="hidden" class="form-control" name="barangay" required value="{{ $archive->barangay }}">

                  <input type="hidden" class="form-control" name="municipality" required value="{{ $archive->municipality }}">

                  <input type="hidden" class="form-control" name="province" required value="{{ $archive->province }}">
                
                  <input type="hidden" class="form-control" name="contact_no" required value="{{ $archive->contact_no }}">
                
            
                  <input type="hidden" class="form-control" name="father_full_name" required value="{{ $archive->father_full_name }}">
                
                  <input type="hidden" class="form-control" name="mother_full_name" required  value="{{ $archive->mother_full_name }}">
                
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="height" required value="{{ $archive->height }}">
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="weight" required value="{{ $archive->weight }}">
                  
          
                    
                  
                      

                      <input type="hidden" name="vaccine_received" value="{{ $archive->vaccine_received }}">
               
                <input type="hidden" name="doses" value="{{ $archive->doses }}">
              
                <input type="hidden" name="doses_received" value="{{ $archive->doses_received }}">
                <input type="hidden" name="first_dose_schedule" value="{{ $archive->first_dose_schedule }}">
                <input type="hidden" name="second_dose_schedule" value="{{ $archive->second_dose_schedule }}">
                <input type="hidden" name="third_dose_schedule" value="{{ $archive->third_dose_schedule }}">

                <input type="hidden" name="first_dose_vaccinated_at" value="{{ $archive->first_dose_vaccinated_at }}">
                <input type="hidden" name="second_dose_vaccinated_at" value="{{ $archive->second_dose_vaccinated_at }}">
                <input type="hidden" name="third_dose_vaccinated_at" value="{{ $archive->third_dose_vaccinated_at }}">

              
                <input type="hidden"name="remarks" class="form-control" value="{{ $archive->remarks }}">

                <input type="hidden" name="date_recorded" class="form-control"  value="{{ $archive->date_recorded }}">

                

           
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes</button>
        </form>
        </div>
    </div>
    </div>
</div> 
<!-- Edit Immunization Modal -->


<!-- View Immunization Modal -->
<div class="modal fade bd-example-modal-lg" id="viewImmunizationModal{{ $archive->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <input type="text" class="form-control" name="first_name" value="{{ $archive->first_name }}"  readonly>
                </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Middlename</label>
                <input type="text" class="form-control" name="middle_name"  value="{{ $archive->middle_name }}" readonly>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Lastname</label>
                <input type="text" class="form-control" name="last_name"  value="{{ $archive->last_name }}" readonly>
              </div>
            </div>

                

            </div>

            <div class="row px-1">

              <div class="col-md-8">
                <div class="form-group">
                  <label>Place of Birth</label>
                  <input type="text" class="form-control" name="place_of_birth"  value="{{ $archive->place_of_birth }}" readonly>
                </div>
              </div>

              <div class="col-md-4">
                    <div class="form-group">
                      <label>Gender</label>
                      <input class="form-control" name="gender" value="{{$archive->gender}}" readonly>
                    </div>
                </div>
           

            </div>
         

         <div class="row px-1">

            <div class="col-md-8">
              <div class="form-group">
                <label>Date of Birth</label>
                
                <input type="date" class="form-control" name="date_of_birth"  value="{{ $archive->date_of_birth }}"readonly>
              </div>
            </div>

            <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleFormControlFile1">Age</label>
                     
                        <input type="text" name="age" class="form-control" value="{{ $archive->age }}"  readonly>
                        
                      
                  </div>
              </div>


         </div>
         
         <div class="row px-1">

          <div class="col">
            <div class="form-group">
              <label>Province</label>
              <input type="text" class="form-control"  value="{{ $archive->province }}" readonly>
            </div>
           </div>
           
           <div class="col">
            <div class="form-group">
              <label>Municipality</label>
              <input type="text" class="form-control"  value="{{ $archive->municipality }}" readonly>
            </div>
           </div>
           
           <div class="col">
            <div class="form-group">
              <label>Barangay</label>
              <input type="text" class="form-control"   value="{{ $archive->barangay }}" readonly>
            </div>
           </div>

          <div class="col">
            <div class="form-group">
              <label>Contact No.</label>
              <input type="text" class="form-control"   value="{{ $archive->contact_no }}" readonly>
            </div>
          </div>

       </div>
      

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group">
                  <label>Father's Name</label>
                  <input type="text" class="form-control" name="father_full_name"  value="{{ $archive->father_full_name }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mother's Name</label>
                  <input type="text" class="form-control" name="mother_full_name"  value="{{ $archive->mother_full_name }}" readonly>
                </div>
              </div>

            </div>

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                  <label>Height</label>
                  @php  
                  $heightArray = explode(" ",  $archive->height);
                  $actualHeight = reset($heightArray); 
                  @endphp
                  <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $archive->height }}" readonly>
                  <label>cm</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                @php  
                  $weightArray = explode(" ", $archive->weight);
                  $actualWeight = intval(reset($weightArray)); 
                  @endphp
                  <label>Weight</label>
                  <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$archive->height}}" readonly>
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
                      <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $archive->vaccine_received}}" >
                        
                </div>

                <div class="col">
                  <label>Doses</label>
                  <input type="number" value="{{ $archive->doses}}" class="form-control" readonly>
                </div>
                <div class="col">
                  <label>Doses Received</label>
                  <input type="text" name="doses_received" class="form-control" value="{{$archive->doses_received}}" readonly>
                  
  
                </div>

            </div>


            <div class="row px-1">
              <div class="col">
                <label>Remarks</label>
                <textarea name="remarks" class="form-control" style="resize: none;"  rows="5" readonly>{{$archive->remarks}}</textarea>
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
 @endforeach 

<!-- Modals -->

<script>
  $(document).ready(function(){ //Make script DOM ready
  $('#options-button').click(function() { //jQuery Change Function

      var opval = $('#options').val(); //Get value from select element
      if(opval=="Restore"){
          $('#multiRestoreModal').modal("show"); //Open Modal
      }
      else if(opval=="Delete"){
          $('#multiDeleteModal').modal("show"); //Open Modal
      }
  });
});
</script>


@endsection
