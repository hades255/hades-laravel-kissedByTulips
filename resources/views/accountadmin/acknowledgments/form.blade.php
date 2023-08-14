@extends('layouts.backend_new')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">

            @include('accountadmin.common.breadcumb')

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style="text-align:center;">
                                {{ isset($Acknowledgment) && $Acknowledgment->pk_acknowledgments ? 'Edit Acknowledgment' : 'Create New Acknowledgment' }}
                            </h4>
                            @if (Session::has('message'))
                                <p class="alert alert-{{ Session::get('messageType') }}">{{ Session::get('message') }}</p>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="mt-4 " method="post" action="/accountadmin/acknowledgments/submit">
                                @csrf
                                <input type="hidden" name="pk_acknowledgments"
                                    value="{{ @$Acknowledgment->pk_acknowledgments }}">
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">


                                            <div class="form-group col-lg-12">
                                                <label for="description">Message Code</label>
                                                <input type="text" name="message_code"
                                                    class="form-control @error('message_code') is-invalid @enderror"
                                                    value="{{ isset($Acknowledgment) && $Acknowledgment->message_code ? $Acknowledgment->message_code : old('message_code') }}">
                                                @error('message_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="form-group col-lg-12">
                                                <label for="description">Message</label>
                                                <input type="text" name="message"
                                                    class="form-control @error('message') is-invalid @enderror"
                                                    value="{{ isset($Acknowledgment) && $Acknowledgment->message ? $Acknowledgment->message : old('message') }}">
                                                @error('message')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="styles">Message Type</label>
                                                <select class="form-control col-12" name="message_type">
                                                    <option value="success">Success</option>
                                                    <option value="info">Info</option>
                                                    <option value="warning">Warning</option>
                                                    <option value="danger">Danger</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-12">

                                                <input class="btn btn-primary" type="submit"
                                                    value="{{ isset($Acknowledgment) && $Acknowledgment->pk_acknowledgments ? 'Update' : 'Submit' }}">

                                                <a href="/accountadmin/acknowledgments/back">
                                                    <input class="btn btn-danger" type="button" value="Cancel"></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
