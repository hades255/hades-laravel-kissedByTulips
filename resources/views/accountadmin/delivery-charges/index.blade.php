@extends('layouts.backend_new')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Delivery Charges</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/accountadmin/delivery-charges">Delivery Charges</a></li>
                    </ol>
                    <a href="/accountadmin/delivery-charges/add" style="margin-top:-34px;"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                            class="fa fa-plus-circle"></i> Create New</button></a>
                </div>
            </div>
        </div>

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
                                        <th>MIles From</th>
                                        <th>Miles To</th>
                                        <th class="text-center">Cost</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$data->isEmpty())
                                        @foreach($data as $value)
                                            <tr>
                                                <td onclick="window.location='{{ route('accountadmin.deliverycharges.edit', ['id' => $value->pk_delivery_charges]) }}'">{!! $value->miles_from !!}</td>
                                                <td  onclick="window.location='{{ route('accountadmin.deliverycharges.edit', ['id' => $value->pk_delivery_charges]) }}'">{!! $value->miles_to !!}</td>
                                                <td  onclick="window.location='{{ route('accountadmin.deliverycharges.edit', ['id' => $value->pk_delivery_charges]) }}'" class="text-center">${!! number_format($value->cost,2) !!} </td>
                                                <td style="text-align:center;">
                                                    <a href="/accountadmin/delivery-charges/edit/{!! $value->pk_delivery_charges !!}"><button class="btn btn-danger text-white">Edit</button></a>
                                                    <a href="javascript:" onclick="form_alert('deliverycharges-{{$value->pk_delivery_charges}}', '{{'want to delete '}} {{'Delivery Charge?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                                    <form action="{{route('accountadmin.deliverycharges.delete',[$value->pk_delivery_charges])}}" method="get" id="deliverycharges-{{$value->pk_delivery_charges}}">
                                                    @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
