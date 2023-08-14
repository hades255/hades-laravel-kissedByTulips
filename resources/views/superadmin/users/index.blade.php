@extends('layouts.dashboard')

@section('content')
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Users</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="http://kbt.test/home">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                    <a href="/superadmin/users/create"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                            class="fa fa-plus-circle"></i> Create New</button></a>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Users Export</h4>
                        <h6 class="card-subtitle">Export accounts to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>UserName</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($users as $user)
                                    <tr>
                                        <td onclick="window.location='{{ route('users.edit', ['id' => $user->pk_users]) }}'">{{$user->first_name}} {{$user->last_name}}</td>
                                        <td onclick="window.location='{{ route('users.edit', ['id' => $user->pk_users]) }}'">{{$user->email}}</td>
                                        <td onclick="window.location='{{ route('users.edit', ['id' => $user->pk_users]) }}'">{{$user->phone}}</td>
                                        <td onclick="window.location='{{ route('users.edit', ['id' => $user->pk_users]) }}'">{{$user->username}}</td>
                                        <td style="text-align:center;">
                                         <a href="/superadmin/users/edit/{{$user->pk_users}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('users-{{$user->pk_users}}', '{{'want to delete '}}{{$user->first_name}} {{$user->last_name}}{{' User?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('users.delete',[$user->pk_users])}}" method="get" id="users-{{$user->pk_users}}">
                                         @csrf
                                         </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

@endsection
