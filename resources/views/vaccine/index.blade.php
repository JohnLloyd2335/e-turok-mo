@section('title')
    E-TUROK MO | VACCINE
@endsection
@extends('layouts.user_navigation')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid px-4">



        @include('layouts.flash-message')

        <!-- Page Heading -->
       
        <form action="{{ route('vaccineMultiAction') }}" method="POST" style="margin:0;padding:0;">
        @csrf
            <!--Multi Delete Modal -->
            <div class="modal fade" id="multiDeleteModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Vaccines</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">

                        <h3 class="font-weight-light">Are you sure you want to delete selected vaccines?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                        
                            
                            <button type="submit" class="btn btn-danger">Yes</button>
                        


                    </div>
                </div>
            </div>
        </div>
        <!--Multi Delete Modal -->
        <!--Set Vaccine Not Available Modal -->
        <div class="modal fade" id="multisetNotAvailableModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Vaccines </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <h3 class="font-weight-light">Are you sure you want to update selected vaccines?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    
                        
                        <button type="submit" class="btn btn-primary">Yes</button>
                    


                </div>
            </div>
        </div>
    </div>
    <!--Set Vaccine Not Available Modal-->
    <!--Set Vaccine Available Modal -->
    <div class="modal fade" id="multisetAvailableModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Vaccines</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">

                <h3 class="font-weight-light">Are you sure you want to update selected vaccines?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                
                    
                    <button type="submit" class="btn btn-primary">Yes</button>
                


            </div>
        </div>
    </div>
</div>
<!--Set Vaccine Not Available Modal-->
        <div class="d-flex justify-content-between align-items-center">

           <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addVaccineModal">Add Vaccine</button>
           </div>
           <div class="d-flex align-items-center justify-content-around">
            <div class="p-1">
                <label>On Selected</label>
            </div>
            
            <div class="p-1">
                <select name="actions"  class="form-select" id="options">
                    <option value="Delete">Delete</option>
                    <option value="Set Not Available">Set Not Available</option>
                    <option value="Set Available">Set Available</option>
                </select>
            </div>
            <div class="p-1">
                <button type="button" class="btn btn-primary btn-sm" id="options-button">Go</button>
            </div>
            
            
           </div>
        </div>
       







        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-3" >

            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Vaccines</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive px-1" >
                    <table class="table table-bordered table-hover" id="filterVaccineDataTable" cellspacing="0" style="table-layout:fixed;
                    width: 99% !important; ">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2"></th>
                                <th rowspan="2">ID</th>
                                <th rowspan="2">Vaccine Name</th>
                                <th rowspan="2">Category</th>
                                <th rowspan="2">Dose(s)</th>
                                <th colspan="2">Doses Interval</th>
                                <th rowspan="2">Status</th>
                                <th rowspan="2">Description</th>
                                <th rowspan="2">Date Created</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr class="text-center">
                                <th>Second Dose</th>
                                <th>Third Dose</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($vaccines as $vaccine)
                                <tr class="text-center">
                                    <td class="text-center"><input type="checkbox" class="form-check-input" name="vaccineIds[]" value="{{ $vaccine->id }}"></td>
                                    <td>{{ $vaccine->id}}</td>
                                    <td>{{ $vaccine->vaccine_name}}</td>
                                    <td>{{ $vaccine->vaccine_category->vaccine_category_name }}</td>
                                    <td>{{ $vaccine->doses }}</td>
                                    <td>
                                        @if(empty($vaccine->second_dose_years_interval.$vaccine->second_dose_months_interval.$vaccine->second_dose_days_interval))
                                            {{"Not Applicable"}} 
                                        
                                        @else
                                            {{$vaccine->second_dose_years_interval." year(s), ".$vaccine->second_dose_months_interval." month(s), ".$vaccine->second_dose_days_interval." day(s)"}}
                                        @endif
                                      
                                    </td>
                                    <td>
                                        @if(empty($vaccine->third_dose_years_interval.$vaccine->third_dose_months_interval.$vaccine->third_dose_days_interval))
                                            {{"Not Applicable"}} 
                                        
                                        @else
                                            {{$vaccine->third_dose_years_interval." year(s), ".$vaccine->third_dose_months_interval." month(s), ".$vaccine->third_dose_days_interval." day(s)"}}
                                        @endif
                                      
                                    </td>
                                
                                    
                                    @if ($vaccine->status == "Available")
                                      <td class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small bg bg-success rounded text-white p-1 text-center text-small">{{ $vaccine->status}}</p></td>
                                    @else
                                      <td class="d-flex justify-content-center align-items-center"><p class="d-flex justify-content-center align-items-center small bg bg-danger rounded text-white p-1 text-center text-small">{{ $vaccine->status}}</p></td>
                                    @endif
                                    
                                    <td>{{ $vaccine->description }}</td>

                                    <td>{{ date('M-d-Y',strtotime($vaccine->date_created)) }}</td>
                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                        <span data-toggle="tooltip"  data-placement="left" title="Edit">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editVaccineModal{{ $vaccine->id }}"><i
                                                class="fas fa-edit"></i></button>
                                        </span>
                                        <span data-toggle="tooltip"  data-placement="left" title="Delete">
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteVaccineModal{{ $vaccine->id }}"><i
                                            class="fas fa-trash-alt"></i></button>
                                        <span>
                                            
                                        
                                        


                                    </td>



                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot class="text-center">
                            <th class="text-light text-center">ID</th>
                            <th class="text-light">ID</th>
                            <th class="text-light">Vaccine Name</th>
                            <th>Vaccine Category</th>
                            <th>Dose(s)</th>
                            <th class="text-light">First Dose</th>
                            <th class="text-light">Second Dose</th>
                            <th class="text-light">Description</th>
                            <th class="text-light">Date Created</th>
                            <th class="text-light">Action</th>
                        </tfoot>
                    </table>
                </form>
                </div>
            </div>
        </div>

        <!--end of table -->


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->




    <!-- Modals -->

    <!-- Add Vaccine Modal -->
    <div class="modal fade bd-example-modal-lg" id="addVaccineModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Vaccine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- -->
                    <form action="{{ route('vaccines.store') }}" method="post">
                        @csrf
                        <div class="container-fluid my-2 mx-2">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Vaccine Category</label>
                                        <select class="form-control" aria-label="Default select example"
                                            name="vaccine_category_id">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($vaccine_categories as $vaccine_category)
                                                <option value="{{ $vaccine_category->id }}"
                                                    {{ old('vaccine_category_id') == $vaccine_category->id ? 'selected' : '' }}>
                                                    {{ $vaccine_category->vaccine_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vaccine Name</label>
                                        <input type="text" class="form-control" name="vaccine_name"
                                            value="{{ old('vaccine_name') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label>Dose(s)</label>
                                    <select class="form-control" name="doses" id="doses" onchange="intervalChange()">
                                        <option selected disabled>--Select Dose(s)--</option>
                                        <option @selected(old('doses') == '1') value="1">1</option>
                                        <option @selected(old('doses') == '2') value="2">2</option>
                                        <option @selected(old('doses') == '3') value="3">3</option>
                                    </select>
                                </div>
                                
                            </div>



                            <div class="row">
                                <div class="col text-center">
                                    <h4>Interval of Doses</h4>
                                </div>
                            </div>

                            <div class="row gap-2">
                                {{-- <div class="col bg-secondary text-light py-1 rounded">
                                    <div class="row text-center">
                                        <div class="label">First Dose</div>
                                        <div class="col">
                                            <label>Year(s)</label>
                                            <select name="" id="" class="form-control">
                                                <option value="0">0 year</option>
                                                <option value="1">1 year</option>
                                                @for($i = 2; $i < 11; $i++)
                                                    <option value="{{$i}}">{{ $i." years" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Month(s)</label>
                                            <select name="" id="" class="form-control">
                                                <option value="0">0 month</option>
                                                <option value="1">1 month</option>
                                                @for($i = 2; $i < 13; $i++)
                                                    <option value="{{$i}}">{{ $i." months" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Day(s)</label>
                                            <select name="" id="" class="form-control">
                                                <option value="0">0 day</option>
                                                <option value="1">1 day</option>
                                                @for($i = 2; $i < 32; $i++)
                                                    <option value="{{$i}}">{{ $i." days" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                    
                                <div class="col bg-secondary text-light pt-1 rounded">
                                    <div class="row text-center">
                                        <div class="label">Second Dose</div>
                                        <div class="col">
                                            <label>Year(s)</label>
                                            <select name="second_dose_years_interval" class="form-control date" disabled>
                                                <option value="0">0 year</option>
                                                <option value="1">1 year</option>
                                                @for($i = 2; $i < 11; $i++)
                                                    <option value="{{$i}}">{{ $i." years" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Month(s)</label>
                                            <select name="second_dose_months_interval" class="form-control date" disabled>
                                                <option value="0">0 month</option>
                                                <option value="1">1 month</option>
                                                @for($i = 2; $i < 13; $i++)
                                                    <option value="{{$i}}">{{ $i." months" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Day(s)</label>
                                            <select name="second_dose_days_interval" class="form-control date" disabled>
                                                <option value="0">0 day</option>
                                                <option value="1">1 day</option>
                                                @for($i = 2; $i < 33; $i++)
                                                    <option value="{{$i}}">{{ $i." days" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mt-2">
                                        <p class="small text-light">Note: How many Year(s), Month(s), and Day(s) after 1st Dose</p>
                                    </div>
                                </div>

                                <div class="col border bg-secondary text-light py-1 rounded">
                                    <div class="row text-center">
                                        <div class="label">Third Dose</div>
                                        <div class="col">
                                            <label>Year(s)</label>
                                            <select name="third_dose_years_interval" class="form-control date third_dose" disabled>
                                                
                                                <option value="0">0 year</option>
                                                <option value="1">1 year</option>
                                                @for($i = 2; $i < 11; $i++)
                                                    <option value="{{$i}}">{{ $i." years" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Month(s)</label>
                                            <select name="third_dose_months_interval" class="form-control date third_dose" disabled>
                                                <option value="0">0 month</option>
                                                <option value="1">1 month</option>
                                                @for($i = 2; $i < 13; $i++)
                                                    <option value="{{$i}}">{{ $i." months" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Day(s)</label>
                                            <select name="third_dose_days_interval" class="form-control date third_dose" disabled>
                                                <option value="0">0 day</option>
                                                <option value="1">1 day</option>
                                                @for($i = 2; $i < 33; $i++)
                                                    <option value="{{$i}}">{{ $i." days" }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mt-2">
                                        <p class="small text-light">Note: How many Year(s), Month(s), and Day(s) after 2nd Dose</p>
                                    </div>
                                </div>
                                
                            </div>



                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description" style="resize: none;">{{ old('description') }}</textarea>
                                    </div>
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
    <!-- Add Vaccine Modal -->
    

    @foreach ($vaccines as $vaccine)
        <!-- Delete Vaccine Modal -->

        <div class="modal fade" id="deleteVaccineModal{{ $vaccine->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                        <form action="{{ route('vaccines.destroy', $vaccine) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Vaccine Modal -->

        <!-- Edit Vaccine Modal -->
        <div class="modal fade bd-example-modal-lg" id="editVaccineModal{{ $vaccine->id }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Vaccine</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- -->
                        <form action="{{ route('vaccines.update', $vaccine) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="container-fluid my-2 mx-2">
                                <div class="row">

                                    <div class="col-md-5">

                                        <label>Vaccine Category</label>
                                        <select class="form-control" aria-label="Default select example"
                                            name="vaccine_category_id">
                                            @foreach ($vaccine_categories as $vaccine_category)
                                                <option value="{{ $vaccine_category->id }}" @selected($vaccine_category->id == $vaccine->vaccine_category_id)>
                                                    {{ $vaccine_category->vaccine_category_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-7">

                                        <label>Vaccine Name</label>
                                        <input type="text" class="form-control" name="vaccine_name"
                                            value="{{ $vaccine->vaccine_name }}" >

                                    </div>








                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-6">

                                        <label>Dose(s)</label>
                                        <select name="doses" class="form-control" id="doses" onchange="intervalChange()">
                                            <option @selected($vaccine->doses == '1') value="1">1</option>
                                            <option @selected($vaccine->doses == '2') value="2">2</option>
                                            <option @selected($vaccine->doses == '3') value="3">3</option>
                                        </select>

                                    </div>

                                    <div class="col-md-6">

                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option @selected($vaccine->status === 'Available') value="Available">Available</option>
                                            <option @selected($vaccine->status === 'Not Available') value="Not Available">Not Available
                                            </option>
                                        </select>

                                    </div>




                                </div>

                                {{-- <div class="row mt-2">
                                    <div class="col bg-secondary text-light pt-1 rounded">
                                        <div class="row text-center">
                                            <div class="label">Second Dose</div>
                                            <div class="col">
                                                <label>Year(s)</label>
                                                <select name="second_dose_years_interval" class="form-control date" disabled>
                                                    <option value="0">0 year</option>
                                                    <option value="1">1 year</option>
                                                    @for($i = 2; $i < 11; $i++)
                                                        <option value="{{$i}}">{{ $i." years" }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label>Month(s)</label>
                                                <select name="second_dose_months_interval" class="form-control date" disabled>
                                                    <option value="0">0 month</option>
                                                    <option value="1">1 month</option>
                                                    @for($i = 2; $i < 13; $i++)
                                                        <option value="{{$i}}">{{ $i." months" }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label>Day(s)</label>
                                                <select name="second_dose_days_interval" class="form-control date" disabled>
                                                    <option value="0">0 day</option>
                                                    <option value="1">1 day</option>
                                                    @for($i = 2; $i < 33; $i++)
                                                        <option value="{{$i}}">{{ $i." days" }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mt-2">
                                            <p class="small text-light">Note: How many Year(s), Month(s), and Day(s) after 1st Dose</p>
                                        </div>
                                    </div>
    
                                    <div class="col border bg-secondary text-light py-1 rounded">
                                        <div class="row text-center">
                                            <div class="label">Third Dose</div>
                                            <div class="col">
                                                <label>Year(s)</label>
                                                <select name="third_dose_years_interval" class="form-control date third_dose" disabled>
                                                    
                                                    <option value="0">0 year</option>
                                                    <option value="1">1 year</option>
                                                    @for($i = 2; $i < 11; $i++)
                                                        <option value="{{$i}}">{{ $i." years" }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label>Month(s)</label>
                                                <select name="third_dose_months_interval" class="form-control date third_dose" disabled>
                                                    <option value="0">0 month</option>
                                                    <option value="1">1 month</option>
                                                    @for($i = 2; $i < 13; $i++)
                                                        <option value="{{$i}}">{{ $i." months" }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label>Day(s)</label>
                                                <select name="third_dose_days_interval" class="form-control date third_dose" disabled>
                                                    <option value="0">0 day</option>
                                                    <option value="1">1 day</option>
                                                    @for($i = 2; $i < 33; $i++)
                                                        <option value="{{$i}}">{{ $i." days" }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mt-2">
                                            <p class="small text-light">Note: How many Year(s), Month(s), and Day(s) after 2nd Dose</p>
                                        </div>
                                    </div>
                                </div> --}}



                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description"
                                                style="resize: none;">{{ $vaccine->description }}</textarea>
                                        </div>
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
        <!-- Edit Vaccine Modal -->
    @endforeach


    <!-- Modals -->

    <script>
       
        function intervalChange() {
                if (document.getElementById("doses").value == "1"){
                    var cells = document.getElementsByClassName("date"); 
                    for (var i = 0; i < cells.length; i++) { 
                        cells[i].disabled = true;
                        cells[i].value = "0";
                    }
                } 
                else if(document.getElementById("doses").value == "2"){
                    var cells1 = document.getElementsByClassName("date"); 
                    for (var i = 0; i < cells1.length; i++) { 
                        cells1[i].disabled = false;
                    }

                    var cells2 = document.getElementsByClassName("third_dose"); 
                    for (var i = 0; i < cells2.length; i++) { 
                        cells2[i].disabled = true;
                        cells2[i].value = "0";
                    }
                }    
                else{
                    var cells = document.getElementsByClassName("date"); 
                    for (var i = 0; i < cells.length; i++) { 
                        cells[i].disabled = false;
                    }
                }       
        }

    </script>

    <script>
        $(document).ready(function(){ //Make script DOM ready
        $('#options-button').click(function() { //jQuery Change Function

            var opval = $('#options').val(); //Get value from select element
            if(opval=="Delete"){ //Compare it and if true
                $('#multiDeleteModal').modal("show"); //Open Modal
            }
            else if(opval=="Set Not Available"){
                $('#multisetNotAvailableModal').modal("show"); //Open Modal
            }
            else if(opval=="Set Available"){
                $('#multisetAvailableModal').modal("show"); //Open Modal
            }
        });
    });
    </script>

    



@endsection
