@extends('layouts.backend_new')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Dashboard</h4>
                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('accountadmin.sale-types.index') }}">Sale Types</a>
                            </li>
                        </ol>
                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"
                                style="margin-top: -34px;">
                            <i class="fa fa-edit"></i>
                            Edit Sale Type
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"
                                style="text-align: center;">
                                Edit Vase Type
                            </h4>
                            <div class="tab-content br-n pn">
                                <div id="navpills-1" class="tab-pane active">
                                    <div class="row">
                                        <form class="form-horizontal mt-4 " style="margin-left: 550px;" method="post"
                                              action="{{ route('accountadmin.sale-types.update', $saleType->pk_sales_type) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="styles">Sale Type</label>
                                                <input type="text" name="sale_type"
                                                       class="form-control @error('sale_type') is-invalid @enderror"
                                                       value="{{ old('sale_type', $saleType->sale_type) }}">
                                                @error('sale_type')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <a href="{{ route('accountadmin.sale-types.index') }}"
                                               class="btn btn-primary">
                                                Cancel
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
