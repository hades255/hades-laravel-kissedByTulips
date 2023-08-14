@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row" style="margin: 40px 0;">
            <div class="col-md-12">
                @if ($dataRows)
                    @foreach ($dataRows as $k => $item)
                        <h2><b> {{ $item->county }} </b></h2>
                        @if ($item->county)
                            <div class="row">
                                @foreach ($item->cities as $key => $city)
                                    <div class="col-lg-3 col-6">
                                        <h4 style="margin-left: 10px;"><b> {{ $city->city }} </b></h4>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
