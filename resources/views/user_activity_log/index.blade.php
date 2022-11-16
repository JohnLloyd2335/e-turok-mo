@extends('layouts.user_navigation')
@section('title')
    E-TUROK MO | USER ACTIVITY LOGS
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid px-4">



        @include('layouts.flash-message')

        <!-- Page Heading -->
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#addImmunizationModal">Add Immunization</button> --}}







       <!-- DataTales Example -->
       <div class="card shadow mb-4 mt-3">

        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">User Activity Logs</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="filterUserActivityLogDataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>User FullName</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Activity</th>
                            <th>Description</th>
                            <th>Date Time</th>
                            
                        </tr>
                    </thead>

                    <tbody>

                            @foreach ($user_activity_logs as $user_activity_log)
                                <tr class="text-center">
                                    <td>{{ $user_activity_log->user->first_name." ".$user_activity_log->user->middle_name." ".$user_activity_log->user->last_name }}</td>
                                    <td>{{ $user_activity_log->user->email }}</td>
                                    <td>
                                        @switch($user_activity_log->user->user_type_id)
                                            @case(1)
                                                {{ "Admin" }}
                                                @break
                                            @case(2)
                                                {{ "Nurse/Midwife" }}
                                                @break
                                            @case(3)
                                                {{ "BHW" }}
                                                @break
                                        
                                            @default
                                                {{" "}}
                                        @endswitch
                                    </td>
                                    <td>{{ $user_activity_log->activity}}</td>
                                    <td class="d-flex justify-content-start align-items-center">{{ $user_activity_log->description}}</td>
                                    <td>{{ $user_activity_log->date_time}}</td>
                                </tr>
                            @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <th>User FullName</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Activity</th>
                            <th class="text-light">Description</th>
                            <th>Date Time</th>
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

    
@endsection
