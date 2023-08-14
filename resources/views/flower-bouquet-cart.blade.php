@extends('layouts.app')

@section('content')
            <div class="row">
             <div class="col-md-12">
               <form method="POST" action="/flower-bouquet/cart/submit">
                   @csrf
                   <div class="row mb-3">
                       <label for="flower" class="col-md-4 col-form-label text-md-end">Select Flower</label>
                       <div class="col-md-6">
                         <select class="form-control form-select" name="flower">
                           <option value="">-Select Flower--</option>
                           @foreach($flowers as $flower)
                           <option value="{{$flower->pk_flowers}}">{{$flower->flowers}}</option>
                           @endforeach
                          </select>
                           @error('flower')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="color" class="col-md-4 col-form-label text-md-end">Select Color</label>
                       <div class="col-md-6">
                         <select class="form-control form-select" name="color">
                           <option value="">-Select Color--</option>
                           @foreach($colorFlowers as $colorFlower)
                           <option value="{{$colorFlower->pk_color_flower}}">{{$colorFlower->color_flower}}</option>
                           @endforeach
                          </select>
                           @error('color')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="price" class="col-md-4 col-form-label text-md-end">Price $</label>
                       <div class="col-md-6">
                           <input type="text" class="form-control" name="price" value="25" required autocomplete="quantity" readonly>
                       </div>
                   </div>

                   <div class="row mb-3">
                       <label for="quantity" class="col-md-4 col-form-label text-md-end">Enter Quantity</label>
                       <div class="col-md-6">
                           <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity">
                           @error('quantity')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>

                   <div class="row mb-3">
                       <label for="vase_type" class="col-md-4 col-form-label text-md-end">Vase Type</label>
                       <div class="col-md-6">
                         <select class="form-control form-select" id="select" name="vase_type">
                           <option value="">-Select Vase Type--</option>
                           @foreach($vaseTypes as $vaseType)
                           @if($vaseType->pk_vase_type == '1')
                           <option value="1">Glass</option>
                           @else
                           <option value="{{$vaseType->pk_vase_type}}">{{$vaseType->vase_type}}</option>
                           @endif
                           @endforeach
                          </select>
                           @error('vase_type')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>

                   <div class="row mb-3" style="display:none;" id="vase_color">
                       <label for="vase_color" class="col-md-4 col-form-label text-md-end">Vase Color</label>
                       <div class="col-md-6">
                           <select class="form-control form-select" name="vase_color">
                             <option value="">-Select Vase Color--</option>
                             @foreach($vaseColors as $vaseColor)
                              <option value="{{$vaseColor->pk_vase_colors}}">{{$vaseColor->vase_colors}}</option>
                             @endforeach
                           </select>
                           @error('vase_color')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="row mb-0">
                       <div class="col-md-6 offset-md-4">
                           <a href="/shop"><button type="button" class="btn btn-primary">
                               Back
                           </button></a>
                           <button type="submit" class="btn btn-primary">
                               Add to Cart
                           </button>
                       </div>
                   </div>
               </form>
             </div>
            </div>
        <script>
        $("#select").change(function () {
          if ($(this).val() == 1) {
            $("#vase_color").show();
          }
          else{
            $("#vase_color").hide();
          }
        });
        </script>
@endsection
