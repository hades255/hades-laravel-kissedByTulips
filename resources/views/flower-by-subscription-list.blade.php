@extends('layouts.app')

@section('content')
            <div class="row">
             <div class="col-md-12">
               <form method="POST" action="">
                   @csrf
                   <div class="row">
                     <h4 style="text-align:center;"><u>Select Flower</u></h4></br>
                     @foreach($flowerSubscriptions as $flowerSubscription)
                       <div class="col-md-3">
                         <img src="/flower-subscription/{{$flowerSubscription->path}}">
                       </div>
                     @endforeach
                   </div>
               </form>
             </div>
            </div>
@endsection
