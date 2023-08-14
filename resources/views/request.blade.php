@extends('layouts.frontend')

@section('content')
            <div class="row">
             <div class="col-md-12">
               <form method="POST" action="">
                   @csrf
                   <h2 style="text-align: center;margin-left: 152px;margin-bottom:20px;"> Request a Quote </h2>
                   <div class="row mb-3">
                       <div class ="col-md-2"></div>
                       <label for="name" class="col-md-2 col-form-label text-md-end">Your Name</label>

                       <div class="col-md-6">
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                           @error('name')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="row mb-3">
                       <div class ="col-md-2"></div>
                       <label for="phone" class="col-md-2 col-form-label text-md-end">Your Email</label>
                       <div class="col-md-6">
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                   </div>

                   <div class="row mb-3">
                     <div class ="col-md-2"></div>
                       <label for="phone" class="col-md-2 col-form-label text-md-end">Your Phone number</label>
                       <div class="col-md-6">
                         <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                          @error('phone')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                   </div>


                   <div class="row mb-3">
                     <div class ="col-md-2"></div>
                       <label for="phone" class="col-md-2 col-form-label text-md-end">Date of Event</label>
                       <div class="col-md-6">
                         <input type="text" id="datepicker" class="form-control @error('date_of_event') is-invalid @enderror" name="date_of_event" value="{{ old('date_of_event') }}" required>
                          @error('date_of_event')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                   </div>

                   <div class="row mb-3">
                     <div class ="col-md-2"></div>
                       <label for="event_venue" class="col-md-2 col-form-label text-md-end">Event Venue</label>
                       <div class="col-md-6">
                         <input id="event_venue" type="text" class="form-control @error('event_venue') is-invalid @enderror" name="event_venue" value="{{ old('event_venue') }}" required autocomplete="event_venue">
                          @error('event_venue')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                   </div>

                   <div class="row mb-3">
                     <div class ="col-md-2"></div>
                       <label for="event_type" class="col-md-2 col-form-label text-md-end">Event type</label>
                       <div class="col-md-6">
                         <select class="form-control form-select">
                           @foreach($events as $event)
                           <option value="{{$event->pk_event_type}}">{{$event->event_type}}</option>
                           @endforeach
                          </select>
                           @error('event_type')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>


                   <div class="row mb-3">
                     <div class ="col-md-2"></div>
                       <label for="number_bouquet" class="col-md-2 col-form-label text-md-end">No of Bouquet?</label>

                       <div class="col-md-6">
                           <input id="number_bouquet" type="number" class="form-control @error('number_bouquet') is-invalid @enderror" name="number_bouquet" value="{{ old('number_bouquet') }}" required autocomplete="number_bouquet">

                           @error('number_bouquet')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>

                   <div class="row mb-3">
                     <div class ="col-md-2"></div>
                       <label for="flower_arrangement_requests" class="col-md-2 col-form-label text-md-end">Flower arrangement Requests</label>
                       <div class="col-md-6">
                         <textarea name="flower_arrangement_requests" class="form-control"></textarea>
                          @error('flower_arrangement_requests')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                   </div>

                   <div class="row mb-3">
                     <div class ="col-md-2"></div>
                       <label for="notes" class="col-md-2 col-form-label text-md-end">Notes</label>
                       <div class="col-md-6">
                         <textarea name="notes" class="form-control"></textarea>
                          @error('notes')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                   </div>

                   <div class="row mb-0">
                       <div class="col-md-6 offset-md-4">
                           <a href="/"><button type="button" class="btn btn-primary">
                               Back
                           </button></a>
                           <button type="submit" class="btn btn-primary">
                               Submit
                           </button>
                       </div>
                   </div>
               </form>
             </div>
            </div>
@endsection
