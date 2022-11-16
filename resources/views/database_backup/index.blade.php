@extends('layouts.user_navigation')
@section('title')
    E-TUROK MO | DATABASE BACKUP
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid px-4">



        @include('layouts.flash-message')

        <!-- Page Heading -->
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#addImmunizationModal">Add Immunization</button> --}}







        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-3 pb-5">

            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Database Backup</h5>
            </div>
            <div class="card-body">
                <div class="row mt-5">

                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <h3>Backup Name:</h3>
                    </div>
                    <div class="col-md-7 d-flex justify-content-start align-items-center">
                        <form action="{{ route('exportDatabase') }}" method="POST">
                        <input type="text" name="backup_name" class="form-control"  value="{{ old('backup_name') }}">
                    </div>
                    <div class="col-md-3 d-flex justify-content-start align-items-center">
                        
                            @csrf
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exportDatabaseModal">Export</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!--Export Modal -->
    <div class="modal fade" id="exportDatabaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <input type="password" name="password" class="form-control" required>

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
@endsection
