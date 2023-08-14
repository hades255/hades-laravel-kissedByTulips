@extends('layouts.dashboard')

@section('content')

<div class="page-wrapper">

    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Customer Location Type</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="{!! route('customer.customer-location-types.index') !!}">Customer Location Type</a></li>
                    </ol>
                    <a href="{!! route('customer.customer-location-types.add') !!}">
                         <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button>
                    </a>
                </div>
            </div>
        </div>

        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Customer Location Type</th>
                                        <th>Active</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $value)
                                        <tr>
                                            <td>{!! $value->customer_location_types !!}</td>
                                            <td>{!! ($value->active==1)?'Yes':'No' !!}</td>
                                            <td style="text-align:center;">
                                                <a href="/superadmin/customer-location-types/edit/{!! $value->pk_customer_location_types !!}"><button class="btn btn-danger text-white">Edit</button></a>
                                                <a href="/superadmin/customer-location-types/delete/{!! $value->pk_customer_location_types !!}"><button class="btn btn-danger text-white">Delete</button></a>
                                                <a href="javascript:" onclick="form_alert('customer-location-types-{{$value->pk_customer_location_types}}', '{{'want to delete '}}{{$value->customer_location_types}} {{' customer location type?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                                <form action="{{route('customer.customer-location-types.delete',[$value->pk_customer_location_types])}}" method="get" id="customer-location-types-{{$value->pk_customer_location_types}}">
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
    </div>
</div>

@endsection
