@extends('tech-admin.layout')
@section('title','Edit Details')
@section('content')
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="{{asset('assets/tech/css/star-rating.css')}}" rel="stylesheet">
<script type="text/javascript" src="{{asset('assets/tech/js/star-rating.js')}}"></script>

<style type="text/css">
        .ui-autocomplete {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .well {
            margin: 5px 0;
        }

        .m-top-50 {
            margin-top: 50px;
        }

        .m-top-15 {
            margin-top: 15px;
        }

    </style>

<style type="text/css">
    .selecteddays{margin-top:10px;}
    .selecteddays .daysblock{
        border: 1px solid #000;
        padding: 3px;
        margin-right: 5px;
        border-radius: 5px;
    }
    .selecteddays .crossx{
            font-size: 10px;
            margin-top: -5px;
            color: #5a5656;
    }
    #delete_img_23{
        position: relative;
        width: 100px;
        height: 100px;
    }
    #delete_img_23 a{
            font-size: 25px;
    position: absolute;
    right: 0;
    top: -15px;
    font-weight: 600;
    z-index: 999;
    color: #000;
    }
    .btnClickAl,.btnClickAl:focus,button,button:focus{
        border: none;
        outline: none;
    }
    .form-control.formNew{
        height: 45px;
/*        resize: none;*/
    }
    .btnCssa{
        background: #fff;
    border: 0;
    color: var(--colorBlue);
    font-weight: 600;
    text-align: center;
    width: 100%;
    margin-bottom: 25px;
    }
    .inputDnD .form-control-file {
  position: relative;
  width: 100%;
  height: 100%;
  min-height: 6em;
  outline: none;
  visibility: hidden;
  cursor: pointer;
  background-color: #c61c23;
  box-shadow: 0 0 5px solid currentColor;
}
.inputDnD .form-control-file:before {
  content: attr(data-title);
  position: absolute;
  top: 0.5em;
  left: 0;
  width: 100%;
  min-height: 6em;
  line-height: 2em;
  padding-top: 1.5em;
  opacity: 1;
  visibility: visible;
  text-align: center;
  border: 2px solid #ccc;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  overflow: hidden;
}
.inputDnD .form-control-file:hover:before {
  border: 2px solid #ccc;

}
.select2-container{
        width: 100%;
    }
    #snackbar {

        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;

    }
    .switch{
        position: absolute;
    right: 0;
    top: 5px;
            padding: 2px 0 3px 40px;
    }
    .newDrag{
        width: 90%;
            margin-top: 60px;
    }

    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s;
        animation: fadein 0.5s;
    }
    .startWidth{
        width: 100px;
    }

    @-webkit-keyframes fadein {
        from {
            bottom: 2;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }

</style>
<section class="bgAll boxs">
    <div class="bgAllInner boxs">
       <h2 class="heading">@if(isset($page_title)) {{$page_title}} @endif Edit Details</h2>
       @if(isset($page_title))
       @if($page_title=='Untouched Business Data >' || $page_title=='Saved Business >')
        <div class="sendNotification">
            <ul>
                <li><a href="javascript:void(0)" data-toggle="modal" data-id = "{{$business->id}}" data-target="#deleteModal"  class="Btns colorRED" id="btn_delete">Delete</a></li>

            </ul>
           </div>
           @endif
           @endif
       <br>
        <div class="tabsProfile scrollbarnew scrollbarnew2" id="style-41">
            <div id="demoTabs">
            <ul class="nav nav-pills profiletabsAl profiletabsAlScroll force-overflownew">
                <li class=""><a data-toggle="pill" href="#home" id="first" class="active">Basic Details</a></li>
                <li id="second1"><a data-toggle="pill" href="#menu1" id="second">HH Hours Details</a></li>
                <li id="third1"><a data-toggle="pill" href="#menu2" id="third">Reverse HH Hours Details</a></li>
                <li id="fourth1"><a data-toggle="pill" href="#menu3" id="fourth">Brunch Details</a></li>
                <li id="fifth1"><a data-toggle="pill" href="#menu4" id="fifth">Live Music Details</a></li>
                <!-- <li><a data-toggle="pill" href="#menu5">Main Menu Details</a></li> -->
                <li id="six1"><a data-toggle="pill" href="#menu6" id="six">Other Details</a></li>
            </ul>
            </div>
            <div class="tab-content">

                <div id="home" class="tab-pane fade show active">
                    <!--start baic detail-->


                    <!-- end basic details-->
                    <!--start main menue-->
                    <div class="profileDeet padding-Top boxs">
                        <h2 class="profilee"><span>Main Menu Upload</span></h2>
                        <div class="alert" id="message" style="display: none"></div>
                        <form id="memuForm" method="post" enctype="multipart/form-data" class="from">
                            @csrf
                            <div class="subcriptionAll subcriptionAlltech">

                                <div class="row ">
                                    <div class="col-sm-6">

                                        <div class="form-group inputDnD">
                                            <label class="sr-only" for="inputFile">File Upload</label>
                                            <input type="file" name="image" id="fileimage" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag and drop a file">
                                        </div>
                                        <p><strong>Note</strong> : No PDFs, Please only upload .jpeg, .png</p>
                                            <!-- <button type="button" class="btnCssa" onclick="document.getElementById('inputFile').click()">Upload</button> -->
                                    </div>
                                    <div class="col-sm-6" style="margin-top:8px">
                                        <div class="form-group">
                                            <input type="hidden" name="business_id" value="{{$business->id}}">
                                            <input type="hidden" name="type" value="1">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                                        </div>
                                    </div>
                                </div>
                                <ul class="btnSub">
                                    <li> <button class="Btns" type="submit"><span id="btn1">Save</span></button>
                                        <!-- <input type="submit" name="" class="Btns" value="Save"> -->
                                        <!-- <a href="javascrit:void(0)" class="Btns">Save</a> -->
                                    </li>
                                    <li><a href="javascript:void(0)" onclick="ResetMenueForm()" class="Btns">Reset</a></li>
                                </ul>
                                <div id="test"></div>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Last Updated Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="menue_result">
                                @if(count($menues)>0)
                                @php $sn=1;@endphp
                                @foreach($menues as $menu)
                                <tr id="row_{{$menu->id}}">
                                    <td>{{$sn++}}</td>
                                    <td>{{$menu->title}}</td>
                                    <td><a href="{{$menu->image}}" target="_blank"><img src="{{$menu->image}}" height="40" width="40"></a></td>
                                    <td>{{$menu->updated_at}}</td>
                                    <td><a href="javascript:void(0)" onclick="deleteMenue('{{$menu->id}}')"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                   <!--end main menue-->
                    <form method="post" id="SaveBasicDetails">
                        @csrf
                        <div class="basic_Details">
                            <div class="detailExit">
                                <div class="profileDeet padding-Top boxs">
                                    <h2 class="profilee"><span>Profile Details</span></h2>
                                    <div class="row padding-Top">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Business Name <span class="start_validation">*</span></label>
                                                <input type="hidden" name="button_type" id="button_type">
                                                <input type="hidden" name="business_id" value="{{$business->id}}">
                                                <input type="text" name="business_name" class="form-control" value="{{$business->name}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Contact Number <span class="start_validation">*</span></label>
                                                <input type="text" name="mobile" class="form-control phone_us" value="{{$business->phone}}" maxlength="12">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email <span class="start_validation">*</span></label>
                                                <input type="text" name="email_id" class="form-control" value="{{$business->email}}">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Category <span class="start_validation">*</span></label>
                                                <input type="text" name="category" class="form-control" value="{{$business->category}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Other category</label>
                                                <input type="text" name="other_category" class="form-control" value="{{sort_alphabet($business->other_category)}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Other category 2</label>
                                                <input type="text" name="other_category_2" class="form-control" value="{{sort_alphabet($business->other_category_2)}}">
                                            </div>
                                        </div>

                                       <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Website @if(!empty($business->website)) <span class="start_validation">*</span><a href="{{$business->website}}" target="_blank" style="color:#0042b9;">(Click Here)</a> @endif</label>
                                                <input type="text" name="webiste" class="form-control" value="{{$business->website}}" >
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                             <div class="form-group">
                                                 <label>Price</label>
                                                 <input type="text" name="price" class="form-control" value="${{$business->price}}" >
                                             </div>
                                         </div>


                                          <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Facebook @if(!empty($business->facebook)) <a href="{{$business->facebook}}" target="_blank" style="color:#0042b9;">(Click Here)</a> @endif</label>
                                                <input type="text" name="facebook" class="form-control" value="{{$business->facebook}}" >
                                            </div>
                                        </div>

                                          <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Instagram @if(!empty($business->instagram)) <a href="{{$business->website}}" target="_blank" style="color:#0042b9;">(Click Here)</a> @endif</label>
                                                <input type="text" name="instagram" class="form-control" value="{{$business->instagram}}" >
                                            </div>
                                        </div>

                                          <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Twitter @if(!empty($business->twitter)) <a href="{{$business->twitter}}" target="_blank" style="color:#0042b9;">(Click Here)</a> @endif</label>
                                                <input type="text" name="twitter" class="form-control" value="{{$business->twitter}}" >
                                            </div>
                                        </div>

                                         <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Google Place ID <span class="start_validation">*</span><span style="color:#0042b9;margin-left:10px"><a href="https://developers.google.com/maps/documentation/javascript/examples/places-placeid-geocoder" target="_blank" style="color:#0042b9;">(Click here to find out the Google Place ID)</a></span></label>
                                                <input type="text" name="google_place_id" class="form-control" value="{{$business->google_place_id}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Business Description from: 1. Biz website 2. FB 3. Google <span class="start_validation">*</span></label>

                                                <textarea name="business_description" class="form-control" rows="4">{{$business->business_description}}</textarea>
                                            </div>
                                        </div>
<!--                                                    <div class="row padding-Top">-->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Google Rating <span class="start_validation">*</span></label>
                                                <div class="card">
                                                   <input id="google_rating" name="google_rating" value="{{$business->google_rating}}" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="lg"  title="" onchange="GoogleRating()">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Yelp Rating <span class="start_validation">*</span></label>
                                                <div class="card">
                                                 <input id="yelp_rating" name="yelp_rating" value="{{$business->yelp_rating}}" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="lg"  title="" onchange="YelpRating()">

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="profileDeet padding-Top boxs">
                                    <h2 class="profilee"><span>Address Details</span></h2>
                                    <div class="row padding-Top">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Search Address <span class="start_validation">*</span></label>
                                                <input type="text" id="searchMapInput_0" autocomplete="off" placeholder="Search Address"  class="form-control username" name="profile_address"  value="{{$business->temp_address}}">
                                               <p><strong>Note</strong>:- Please only select from the Pop Up Menu.  Do not type or copy paste address.</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Address <span class="start_validation">*</span></label>
                                                <input type="hidden" name="pro_lat" id="lat_0" value="{{$business->latitude}}">
                                                <input type="hidden" name="pro_long" id="long_0" value="{{$business->longitude}}">
                                                <input type="hidden" name="" id="address_00">
                                                <input type="text" name="pro_address" id="address_0" class="form-control" value="{{$business->address}}" data-validation="required" data-validation-error-msg="Please enter address" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>City <span class="start_validation">*</span></label>
                                                <input type="hidden" name="" id="city_00">
                                                <input type="text" name="pro_city" id="city_0" class="form-control" value="{{$business->city}}" data-validation="required" data-validation-error-msg="Please enter city">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>State <span class="start_validation">*</span></label>
                                                <input type="hidden" name="" id="state_00">
                                                <input type="text" name="pro_state" id="state_0" class="form-control" value="{{$business->state}}" data-validation="required" data-validation-error-msg="Please enter state">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>County <span class="start_validation">*</span></label>
                                                <input type="hidden" name="" id="country_00">
                                                <input type="text" name="pro_country" id="country_0" class="form-control" value="{{$business->country}}" data-validation="required" data-validation-error-msg="Please enter county">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Zipcode <span class="start_validation">*</span></label>
                                                <input type="hidden" name="" id="zipcode_00">
                                                <input type="text" name="pro_zipcode" id="zipcode_0" class="form-control" value="{{$business->zipcode}}" data-validation="required" data-validation-error-msg="Please enter zipcode" >
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="">
                                    <input type="hidden" id="get_branch_count" value="@if(count($branches)>0){{count($branches)+2}} @else 2 @endif">
                                    <div class="optionBox">
                                        <span class="add Btns">Add New Branch<i class="fa fa-plus"></i></span>
                                        <i style="color:#000;display:block;margin:10px 0px;font-size:16px">If multiple location exist with same Happy Hours add here.</i>
                                        @if(count($branches)>0)
                                        @php $i=2;@endphp
                                        @foreach($branches as $branche)
                                        <div class="profileDeet padding-Top boxs" id="rem1_{{$i}}">
                                            <h2 class="profilee"><span>Branch {{$i}}</span></h2>

                                            <span class="Btns removeSS" onclick="removeRows('{{$i}}')">Remove<i class="fa fa-minus"></i></span>

                                            <div class="row padding-Top">
                                                 <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Search Address <span class="start_validation">*</span></label>
                                                <input type="text" id="searchMapInput_{{$i}}" placeholder="Search Address"  class="form-control username"  >
                                            </div>
                                        </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Google place Id <span class="start_validation">*</span></label>
                                                        <input type="text" name="google_id[]" id="google_id" class="form-control" data-validation="required" data-validation-error-msg="Please enter google id" value="{{$branche->google_id}}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Branch Email <span class="start_validation">*</span></label>
                                                        <input type="text" name="email[]" class="form-control" data-validation="required email" data-validation-error-msg="Please enter email address" value="{{$branche->email}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Address <span class="start_validation">*</span></label>
                                                        <input type="text" name="address[]" class="form-control" id="address_{{$i}}" data-validation="required" data-validation-error-msg="Please enter address" value="{{$branche->address}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>City <span class="start_validation">*</span></label>
                                                        <input type="text" name="city[]" class="form-control" id="city_{{$i}}" data-validation="required" data-validation-error-msg="Please enter city" value="{{$branche->city}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>State <span class="start_validation">*</span></label>
                                                        <input type="text" name="state[]" class="form-control" id="state_{{$i}}" data-validation="required" data-validation-error-msg="Please enter state" value="{{$branche->state}}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Zipcode <span class="start_validation">*</span></label>
                                                        <input type="hidden" name="lat[]" id="lat_{{$i}}" value="{{$branche->latitude}}">
                                                        <input type="hidden" name="long[]" id="long_{{$i}}" value="{{$branche->longitude}}">
                                                        <input type="text" name="zipcode[]" class="form-control" id="zipcode_{{$i}}" data-validation="required" data-validation-error-msg="Please enter zipcode" value="{{$branche->zipcode}}">
                                                    </div>
                                                </div>
                                          </div>
                                        </div>
                                        @php $i++; @endphp
                                        @endforeach
                                        @else

                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="profileDeet padding-Top boxs">
                                <h2 class="profilee"><span>Others Details
                              </span></h2>

                            <!--hh hours-->
                             <div class="sliderLeftAt boxs">
                                <lable>Happy Hours</lable>
                                <div class="radioAlIn radioAlIn2 boxs">
                                    <div class="radioShow rad">
                                    <input type="radio"   name="happy_status" class="" value="1" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_days==1) checked @endif>
                                        <label for="first">Yes</label>
                                    </div>
                                    <div class="radioShow rad">
                                        <input type="radio"  name="happy_status" class="" value="0" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_days==0) checked @endif>
                                        <label for="second">No</label>
                                    </div>

                                </div>
                            </div>
                           <!--end hh hours-->
                           <!--hh reverse-->
                            <div class="sliderLeftAt boxs">
                                <lable>Reverse Happy Hours</lable>
                                <div class="radioAlIn radioAlIn2 boxs">
                                    <div class="radioShow rad">
                                        <input type="radio"  name="reverse_status" value="1" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_reverse==1) checked @endif >
                                        <label for="first">Yes</label>
                                    </div>
                                    <div class="radioShow rad">
                                        <input type="radio"  name="reverse_status" value="0" data-validation="required" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_reverse==0) checked @endif>
                                        <label for="second">No</label>
                                    </div>

                                </div>
                            </div>
                           <!--end reverse-->
                           <!--brunch-->
                             <div class="sliderLeftAt boxs">
                                <lable>Brunch </lable>
                                <div class="radioAlIn radioAlIn2 boxs">
                                    <div class="radioShow rad">
                                        <input type="radio"  name="brunch_status" value="1" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_brunch==1) checked @endif>
                                        <label for="first">Yes</label>
                                    </div>
                                    <div class="radioShow rad">
                                        <input type="radio" name="brunch_status" value="0" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_brunch==0) checked @endif>
                                        <label for="second">No</label>
                                    </div>

                                </div>
                            </div>
                           <!--end of brunch-->
                           <!--live music-->
                            <div class="sliderLeftAt boxs">
                                <lable>Live Music </lable>
                                <div class="radioAlIn radioAlIn2 boxs">
                                    <div class="radioShow rad">
                                        <input type="radio"  name="music_status" value="1" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_music==1) checked @endif>
                                        <label for="first">Yes</label>
                                    </div>
                                    <div class="radioShow rad">
                                        <input type="radio" name="music_status" value="0" data-validation="required" data-validation-error-msg="Please select one option" @if($business->hh_music==0) checked @endif>
                                        <label for="second">No</label>
                                    </div>

                                </div>
                            </div>
                            <div class="profileDeet padding-Top boxs">
                                <h2 class="profilee"><span>Reviews
                              </span></h2>
                              <div class="row">
                              <div class="col-sm-2" style="margin-right: 32px;">
                                <table class="table" style="border: 1px solid black;">
                                  <thead>
                                    <label>Review 1</label>
                                  </thead>
                                  <tbody>
                                    <tr style="border: 1px solid black;">
                                      <td style="border: 1px solid black;"><label>Date:</label>
                                        <input type="date" name="reviewer_publish_date_0" value="{{date('Y-m-d', strtotime($business->reviewer_publish_date_0))}}">
                                      </td>
                                      <td style="border: 1px solid black;"><label>Stars:</label> <span> <input type="text" name="reviewer_star_0" value="{{$business->reviewer_star_0}}" style="width: 40px;"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                      <td colspan ="2" style="border: 1px solid black;"><label>Name:</label> <span><input type="text" name="reviewer_name_0" value="{{$business->reviewer_name_0}}"></span></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><label>Comment:</label> <span><textarea name="reviewer_comment_0" rows="6">{{$business->reviewer_comment_0}}</textarea></span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="col-sm-2" style="margin-right: 32px;">
                                <table class="table" style="border: 1px solid black;">
                                  <thead>
                                    <label>Review 2</label>
                                  </thead>
                                  <tbody>
                                    <tr style="border: 1px solid black;">
                                      <td style="border: 1px solid black;"><label>Date:</label>
                                        <input type="date" name="reviewer_publish_date_1" value="{{date('Y-m-d', strtotime($business->reviewer_publish_date_1))}}">
                                      </td>
                                      <td style="border: 1px solid black;"><label>Stars:</label> <span> <input type="text" name="reviewer_star_1" value="{{$business->reviewer_star_1}}" style="width: 40px;"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                      <td colspan ="2" style="border: 1px solid black;"><label>Name:</label> <span><input type="text" name="reviewer_name_1" value="{{$business->reviewer_name_1}}"></span></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><label>Comment:</label> <span><textarea name="reviewer_comment_1" rows="6">{{$business->reviewer_comment_1}}</textarea></span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="col-sm-2" style="margin-right: 32px;">
                                <table class="table" style="border: 1px solid black;">
                                  <thead>
                                    <label>Review 3</label>
                                  </thead>
                                  <tbody>
                                    <tr style="border: 1px solid black;">
                                      <td style="border: 1px solid black;"><label>Date:</label>
                                        <input type="date" name="reviewer_publish_date_2" value="{{date('Y-m-d', strtotime($business->reviewer_publish_date_2))}}">
                                      </td>
                                      <td style="border: 1px solid black;"><label>Stars:</label> <span> <input type="text" name="reviewer_star_2" value="{{$business->reviewer_star_2}}" style="width: 40px;"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                      <td colspan ="2" style="border: 1px solid black;"><label>Name:</label> <span><input type="text" name="reviewer_name_2" value="{{$business->reviewer_name_2}}"></span></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><label>Comment:</label> <span><textarea name="reviewer_comment_2" rows="6">{{$business->reviewer_comment_2}}</textarea></span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="col-sm-2" style="margin-right: 32px;">
                                <table class="table" style="border: 1px solid black;">
                                  <thead>
                                    <label>Review 4</label>
                                  </thead>
                                  <tbody>
                                    <tr style="border: 1px solid black;">
                                      <td style="border: 1px solid black;"><label>Date:</label>
                                        <input type="date" name="reviewer_publish_date_3" value="{{date('Y-m-d', strtotime($business->reviewer_publish_date_3))}}">
                                      </td>
                                      <td style="border: 1px solid black;"><label>Stars:</label> <span> <input type="text" name="reviewer_star_3" value="{{$business->reviewer_star_3}}" style="width: 40px;"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                      <td colspan ="2" style="border: 1px solid black;"><label>Name:</label> <span><input type="text" name="reviewer_name_3" value="{{$business->reviewer_name_3}}"></span></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><label>Comment:</label> <span><textarea name="reviewer_comment_3" rows="6">{{$business->reviewer_comment_3}}</textarea></span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="col-sm-2" style="margin-right: 32px;">
                                <table class="table" style="border: 1px solid black;">
                                  <thead>
                                    <label>Review 5</label>
                                  </thead>
                                  <tbody>
                                    <tr style="border: 1px solid black;">
                                      <td style="border: 1px solid black;"><label>Date:</label>
                                        <input type="date" name="reviewer_publish_date_4" value="{{date('Y-m-d', strtotime($business->reviewer_publish_date_4))}}">
                                      </td>
                                      <td style="border: 1px solid black;"><label>Stars:</label> <span> <input type="text" name="reviewer_star_4" value="{{$business->reviewer_star_4}}" style="width: 40px;"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                      <td colspan ="2" style="border: 1px solid black;"><label>Name:</label> <span><input type="text" name="reviewer_name_4" value="{{$business->reviewer_name_4}}"></span></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><label>Comment:</label> <span><textarea name="reviewer_comment_4" rows="6">{{$business->reviewer_comment_4}}</textarea></span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            </div>
                             <div class="approveRight approveRight22 boxs">
                                <ul>

                                    <li><button type="submit" class="Btns" id="b1" >Save For Future</button></li>
                                    <li><button type="submit" class="Btns" id="b2">Save and Next</button></li>
                                </ul>

                            </div>
                           <!--end live music-->
                          </div>
                        </div>
                    </form>

                </div>
                <!--end of basic detail-->


                <div id="menu1" class="tab-pane fade">


                    <div class="profileDeet padding-Top boxs">
                        <h2 class="profilee"><span>HH Menu Upload</span></h2>
                        <form id="HhMenueForm" method="post" enctype="multipart/form-data">
                            @csrf
                           <div class="subcriptionAll subcriptionAlltech">

                                <div class="row ">
                                    <div class="col-sm-6">

                                        <div class="form-group inputDnD">
                                            <label class="sr-only" for="inputFile">File Upload</label>
                                            <input type="hidden" name="business_id" value="{{$business->id}}">
                                            <input type="file" name="image" id="imagefile2" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag and drop a file">
                                        </div>
                                        <p><strong>Note</strong> : No PDFs, Please only upload .jpeg, .png</p>
                                           <!--  <button type="button" class="btnCssa" onclick="document.getElementById('inputFile').click()">Upload</button> -->
                                    </div>
                                    <div class="col-sm-6" style="margin-top:8px">
                                        <div class="form-group">
                                             <input type="hidden" name="type" value="2">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                                        </div>
                                    </div>
                                </div>
                                <ul class="btnSub">
                                    <li><button class="Btns" type="submit"><span id="btn2">Save</span></button>
                                        <!-- <a href="javascrit:void(0)" class="Btns">Save</a> -->
                                    </li>
                                    <li><a href="javascript:void(0)" class="Btns" onclick="ResetMenueForm()">Reset</a></li>
                                </ul>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Last Uploaded Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="hh_menue_result">
                                @if(count($hh_menues)>0)
                                @php $sn=1;@endphp
                                @foreach($hh_menues as $hh_menu)
                                <tr id="row_{{$hh_menu->id}}">
                                    <td>{{$sn++}}</td>
                                    <td>{{$hh_menu->title}}</td>
                                    <td><a href="{{$hh_menu->image}}" target="_blank"><img src="{{$hh_menu->image}}" height="40" width="40"></a></td>
                                    <td>{{$hh_menu->updated_at}}</td>
                                    <td><a href="javascript:void(0)" onclick="deleteMenue('{{$hh_menu->id}}')"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                     <form id="saveHappyDetail" method="post">
                        @csrf
                        <div class="sliderComonAt boxs">
                            <div class="sliderLeftAt boxs">
                                <h2 class="heading">Happy Hours</h2>
                            </div>

                        </div>



                    <div class="tabSlide boxs">

                    <div class="">
                     <table id="myTable" class=" table order-list">
                            <thead>
                                <tr>
                                    <td>Days <span class="start_validation">*</span></td>
                                    <td>Start Time <span class="start_validation">*</span></td>
                                    <td>End Time <span class="start_validation">*</span></td>
                                    <td>Food</td>
                                    <td>Drink</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>
                                </td>
                                   <input type="hidden" name="filter_str" id="filter_str"/>
                                    <input type="hidden" name="common_filed" id="comm_0" value="{{ returnDays($business->id,1) }}">
                                     <input type="hidden" name="common_filed" value="@if(count($happy_hours)>0) {{count($happy_hours)-1}} @else 0 @endif" id="getcounter">
                                     <input type="hidden" name="" id="counter_cout" value="@if(count($happy_hours)>0) {{count($happy_hours)}} @else 1 @endif">
                                </td></tr>
                                @if(count($happy_hours)>0)
                                @php $x=0;@endphp
                                @foreach($happy_hours as $hh_hours)
                                 <tr id="remove_row_{{$x}}">
                                 <td colspan="6" class="allcol"><div><h2 class="heading">Quick Filters</h2> <span class="start_validation">*</span></div><div>
                                   @php $filterArray = explode(',',$hh_hours->hh_filter) @endphp
                                   @if(count($filter)>0)
                                    @foreach($filter as $filters)
                                    <label><input type="checkbox" onchange="QuickFilters(this.value,'{{$x}}')" class="quickFilter_{{$x}}" value="{{$filters->name}}" @if(in_array($filters->name,$filterArray)) checked @endif>{{ucwords($filters->name)}}</label>
                                    @endforeach
                                    @endif
                                    <input type="hidden" name="quick_filter[]" id="quick_days_{{$x}}" value="{{$hh_hours->hh_filter}}">
                                     </div></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days"  data-validation="required"  name="days[]" id="days_{{$x}}"  style="width: 200px" onchange="selectonchange(this.value, this.id)">
                                    <option value="">Select Days</option>
                                    @foreach(daysList() as $days)
                                    <option value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                    <div class="selecteddays" id="selectddays_{{$x}}">
                                    @php $dayss = explode(',',$hh_hours->days); @endphp
                                    @foreach($dayss as $dy)
                                    <button type='button' class='daysblock' id="{{$dy}}_{{$x}}" value="{{$dy}}" onclick='removeddays(this.value,"{{$x}}")'> <span class='crossx'>X</span>{{$dy}}</button>
                                    @endforeach
                                </div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]"  value="{{date('H:i A',strtotime($hh_hours->start_time))}}" class="form-control timepicker" autocomplete="off" placeholder="Start Time" data-validation="required" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]"  value="{{date('H:i A',strtotime($hh_hours->end_time))}}" class="form-control timepicker" placeholder="End Time" data-validation="required" autocomplete="off" />
                                    </td>
                                    <td class="col-sm-3">
                                        <textarea class="form-control" name="food[]" placeholder="Food" data-validation="required">{{$hh_hours->food}}</textarea>
                                    </td>
                                    <td class="col-sm-3"> <textarea class="form-control" name="drink[]" placeholder="Drink" data-validation="required">{{$hh_hours->drink}}</textarea>
                                     <input type="hidden" name="srt_day[]" id="tt_{{$x}}" value="{{$hh_hours->days}}">



                                    </td>
                                     @if($x!=0)
                                    <td><input type="button" class="ibtnDel btn btn-md btn-danger " onclick="delRow('{{$x}}')" value="Delete"></td>
                                    @endif
                                </tr>
                                @php $x++;@endphp
                                @endforeach
                                @else
                                <tr id="remove_row_0">
                                 <td colspan="5" class="allcol"><div><h2 class="heading">Quick Filters</h2> <span class="start_validation">*</span></div><div>
                                   @if(count($filter)>0)
                                    @foreach($filter as $filters)
                                    <label><input type="checkbox" class="quickFilter_0" onchange="QuickFilters(this.value,0)" class="quickFilter" value="{{$filters->name}}">{{ucwords($filters->name)}}</label>
                                    @endforeach
                                    @endif
                                    <input type="hidden" name="quick_filter[]" id="quick_days_0">
                                     </div></td>
                                </tr>
                                 <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days" name="days[]"  id="days_0" style="width: 200px" onchange="selectonchange(this.value, this.id)">
                                    <option value="">Select Days</option>
                                    @foreach(daysList() as $days)
                                    <option value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                    <div class="selecteddays" id="selectddays_0"></div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]" class="form-control timepicker" placeholder="Start Time timepicker" data-validation="required"  autocomplete="off" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]"   class="form-control timepicker" placeholder="End Time" data-validation="required"/>
                                    </td>
                                    <td class="col-sm-3">
                                        <textarea class="form-control" name="food[]" placeholder="Food" data-validation="required"></textarea>
                                    </td>
                                    <td class="col-sm-3"> <textarea class="form-control"  name="drink[]" placeholder="Drink" data-validation="required"></textarea></a>
                                     <input type="hidden" name="srt_day[]" id="tt_0">


                                    </td>
                                </tr>

                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: left;">
                                        <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                      <div class="approveRight approveRight22 boxs">
                                <ul>
                                    <li><button type="submit" class="Btns" id="c1">Save For Future</button></li>
                                    <li><button type="submit" class="Btns" id="c2">Save and Next</button></li>
                                    <li><input type="hidden" name="button_type" id="hh_button_type"></li>
                                </ul>

                            </div>
                </form>
                </div>

                <div id="menu2" class="tab-pane fade">



                    <div class="profileDeet padding-Top boxs">
                        <h2 class="profilee"><span>Reverse HH Menu Upload</span></h2>
                        <form method="post" id="REVERSE_MENUE" enctype="multiple/form-data">
                            @csrf
                                     <div class="subcriptionAll subcriptionAlltech">

                                <div class="row ">
                                    <div class="col-sm-6">

                                        <div class="form-group inputDnD">
                                            <label class="sr-only" for="inputFile">File Upload</label>
                                            <input type="file" name="image" id="fileimage3" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag and drop a file">
                                        </div>
                                        <p><strong>Note</strong> : No PDFs, Please only upload .jpeg, .png</p>
                                         <!--    <button type="button" class="btnCssa" onclick="document.getElementById('inputFile').click()">Upload</button> -->
                                    </div>
                                    <div class="col-sm-6" style="margin-top:8px">
                                        <div class="form-group">
                                            <input type="hidden" name="business_id" value="{{$business->id}}">
                                            <input type="hidden" name="type" value="3">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                                        </div>
                                    </div>
                                </div>
                                <ul class="btnSub">
                                    <li><button class="Btns" type="submit"><span id="btn3">Save</span></button>
                                        <!-- <a href="javascrit:void(0)" class="Btns">Save</a> -->
                                    </li>
                                    <li><a href="javascript:void(0)" class="Btns" onclick="ResetMenueForm()">Reset</a></li>
                                </ul>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Last Uploaded Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="reverse_menue_result">
                                @if(count($revers_menues)>0)
                                @php $sn=1;@endphp
                                @foreach($revers_menues as $revers_menue)
                                <tr id="row1_{{$revers_menue->id}}">
                                    <td>{{$sn++}}</td>
                                    <td>{{$revers_menue->title}}</td>
                                    <td><a href="{{$revers_menue->image}}" target="_blank"><img src="{{$revers_menue->image}}" height="40" width="40"></a></td>
                                    <td>{{$revers_menue->updated_at}}</td>
                                    <td><a href="javascript:void(0)" onclick="deleteMenue('{{$revers_menue->id}}')"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <form id="saveReverseHappy" method="post">
                 @csrf
                  <div class="sliderComonAt boxs">
                     <div class="sliderLeftAt boxs">
                        <h2 class="heading">Reverse Happy Hours</h2>
                        </div>

                        </div>

                    <div class="tabSlide boxs">
                    <div class="">
                     <table id="ReverseTbl" class=" table reverse_table">
                            <thead>
                                <tr>
                                    <td>Days <span class="start_validation">*</span></td>
                                    <td>Start Time <span class="start_validation">*</span></td>
                                    <td>End Time <span class="start_validation">*</span></td>
                                    <td>Food</td>
                                    <td>Drink</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>
                                   <input type="hidden" name="common_filed" id="comm_1" value="{{ returnDays($business->id,2) }}">
                                     <input type="hidden" name="common_filed" value="@if(count($reverse_happy_hours)>0) {{count($reverse_happy_hours)-1}} @else 0 @endif" id="getcounter1">
                                     <input type="hidden" name="" id="counter_cout1" value="@if(count($reverse_happy_hours)>0) {{count($reverse_happy_hours)}} @else 1 @endif">
                                </td></tr>
                                @if(count($reverse_happy_hours)>0)
                                @php $x=0;@endphp
                                @foreach($reverse_happy_hours as $reverse_hours)
                                <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days1" onchange="selectonchange1(this.value, this.id)" name="days[]" id="days1_{{$x}}"  style="width: 200px">
                                    <option value="">Selected Days</option>
                                    @foreach(daysList() as $days)
                                    <option value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                    <div class="selecteddays" id="selectddays1_{{$x}}">
                                    @php $reverse_dayss = explode(',',$reverse_hours->days); @endphp
                                    @foreach($reverse_dayss as $rev_day)
                                    <button type='button' class='daysblock' id="{{$rev_day}}_{{$x}}" value="{{$rev_day}}" onclick='removeddays1(this.value,"{{$x}}")'> <span class='crossx'>X</span>{{$rev_day}}</button>
                                    @endforeach
                                </div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]" id="start_0"  value="{{date('H:i A',strtotime($reverse_hours->start_time))}}" class="form-control timepicker" placeholder="Start Time" data-validation="required" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]" id="end_0" value="{{date('H:i A',strtotime($reverse_hours->end_time))}}" class="form-control timepicker" placeholder="End Time" data-validation="required"/>
                                    </td>
                                    <td class="col-sm-3">
                                        <textarea class="form-control" name="food[]" id="food_0" placeholder="Food" data-validation="required">{{$reverse_hours->food}}</textarea>
                                    </td>
                                    <td class="col-sm-3"> <textarea class="form-control" name="drink[]" id="drink_0" placeholder="Drink" data-validation="required">{{$reverse_hours->drink}}</textarea>
                                     <input type="hidden" name="srt_day[]" id="str_days1_{{$x}}" value="{{$reverse_hours->days}}">


                                    </td>
                                     @if($x!=0)
                                    <td><input type="button" class="ibtnDel_rev btn btn-md btn-danger "  value="Delete"></td>
                                    @endif
                                </tr>
                                @php $x++;@endphp
                                @endforeach
                                @else
                                 <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days1" onchange="selectonchange1(this.value, this.id)" name="days[]" id="days1_0"  style="width: 200px">
                                    <option value="">Selected Days</option>
                                    @foreach(daysList() as $days)
                                    <option value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                    <div class="selecteddays" id="selectddays1_0"></div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]" class="form-control timepicker" placeholder="Start Time" data-validation="required" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]"   class="form-control timepicker" placeholder="End Time" data-validation="required"/>
                                    </td>
                                    <td class="col-sm-3">
                                        <textarea class="form-control" name="food[]" placeholder="Food" data-validation="required"></textarea>
                                    </td>
                                    <td class="col-sm-3"> <textarea class="form-control"  name="drink[]" placeholder="Drink" data-validation="required"></textarea></a>
                                     <input type="hidden" name="srt_day[]" id="str_days1_0">
                                   <!--   <input type="text" name="common_filed1" id="comm_1">
                                     <input type="text" name="common_filed1" value="0" id="getcounter1">  -->

                                    </td>
                                </tr>

                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: left;">
                                        <input type="button" class="btn btn-lg btn-block " id="revers_addrow" value="Add Row" />
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                     <div class="approveRight approveRight22 boxs">
                                <ul>
                                    <li><button type="submit" class="Btns" id="d1">Save For Future</button></li>
                                    <li><button type="submit" class="Btns" id="d2">Save and Next</button></li>
                                    <li><input type="hidden" name="button_type" id="rev_button_type"></li>
                                </ul>

                            </div>
                  </form>

                </div>

                <div id="menu3" class="tab-pane fade">


                    <div class="profileDeet padding-Top boxs">
                        <h2 class="profilee"><span>Brunch Menu Upload</span></h2>
                        <form id="BRUNCH_MENUE" method="post" enctype="multiple/form-data">
                            @csrf
                                     <div class="subcriptionAll subcriptionAlltech">

                                <div class="row ">
                                    <div class="col-sm-6">

                                        <div class="form-group inputDnD">
                                            <label class="sr-only" for="inputFile">File Upload</label>
                                            <input type="file" name="image" id="fileimage4" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag and drop a file">
                                        </div>
                                        <p><strong>Note</strong> : No PDFs, Please only upload .jpeg, .png</p>
                                            <!-- <button type="button" class="btnCssa" onclick="document.getElementById('inputFile').click()">Upload</button> -->
                                    </div>
                                    <div class="col-sm-6" style="margin-top:8px">
                                        <div class="form-group">
                                            <input type="hidden" name="business_id" value="{{$business->id}}">
                                            <input type="hidden" name="type" value="4">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                                        </div>
                                    </div>
                                </div>
                                <ul class="btnSub">
                                    <li><button class="Btns" type="submit"><span id="btn4">Save</span></button>
                                        <!-- <a href="javascrit:void(0)" class="Btns">Save</a> -->
                                    </li>
                                    <li><a href="javascript:void(0)" class="Btns" onclick="ResetMenueForm()">Reset</a></li>
                                </ul>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Last Uploaded Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="brunch_menue_result">
                                @if(count($brunch_menues)>0)
                                @php $sn=1;@endphp
                                @foreach($brunch_menues as $brunch_menue)
                                <tr id="row2_{{$brunch_menue->id}}">
                                    <td>{{$sn++}}</td>
                                    <td>{{$brunch_menue->title}}</td>
                                    <td><a href="{{$brunch_menue->image}}" target="_blank"><img src="{{$brunch_menue->image}}" height="40" width="40"></a></td>
                                    <td>{{$brunch_menue->updated_at}}</td>
                                    <td><a href="javascript:void(0)" onclick="deleteMenue('{{$brunch_menue->id}}')"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                     <form id="SaveBrunchDetail" method="post">
                 @csrf
                        <div class="sliderComonAt boxs">

                            <div class="sliderLeftAt boxs">
                                <h2 class="heading">Brunch Details</h2>

                            </div>

                        </div>

                      <div class="tabSlide boxs">
                    <div class="">
                     <table id="BrunchTbl" class=" table brunch_table">
                            <thead>
                                <tr>
                                    <td>Days <span class="start_validation">*</span></td>
                                    <td>Start Time <span class="start_validation">*</span></td>
                                    <td>End Time <span class="start_validation">*</span></td>
                                    <td>Food</td>
                                    <td>Drink</td>
                                </tr>
                            </thead>
                            <tbody>
                                 <tr><td>
                                   <input type="hidden" name="common_filed" id="comm_2" value="{{ returnDays($business->id,3) }}">
                                     <input type="hidden" name="common_filed" value="@if(count($brunch_happy_hours)>0) {{count($brunch_happy_hours)-1}} @else 0 @endif" id="getcounter2">
                                     <input type="hidden" name="" id="counter_cout2" value="@if(count($brunch_happy_hours)>0) {{count($brunch_happy_hours)}} @else 1 @endif">
                                </td></tr>
                                @if(count($brunch_happy_hours)>0)
                                @php $x=0;@endphp
                                @foreach($brunch_happy_hours as $brunch_hours)
                                 @php $brunchFilterArray = explode(',',$brunch_hours->brunch_filter) @endphp
                                 <tr id="remove_brunch_row_{{$x}}">
                                 <td colspan="5" class="allcol"><div><h2 class="heading">Quick Filters</h2> <span class="start_validation">*</span></div><div>
                                   @if(count($brunch_filters)>0)
                                    @foreach($brunch_filters as $brunch_filter)
                                    <label><input type="checkbox" class="brunchFilter_{{$x}}" onchange="brunchFilters(this.value,'{{$x}}')" class="quickFilter" value="{{$brunch_filter->name}}" @if(in_array($brunch_filter->name,$brunchFilterArray)) checked @endif>{{ucwords($brunch_filter->name)}}</label>
                                    @endforeach
                                    @endif
                                    <input type="hidden" name="brunch_filter[]" id="brunch_days_{{$x}}" value="{{$brunch_hours->brunch_filter}}">
                                     </div></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days2" onchange="selectonchange2(this.value, this.id)" data-validation="required"  name="days[]" id="days2_{{$x}}"  style="width: 200px">
                                    <option value="">Select Days</option>
                                    @foreach(daysList() as $days)
                                    <option  value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                    <div class="selecteddays" id="selectddays2_{{$x}}">
                                    @php $brunch_dayss = explode(',',$brunch_hours->days); @endphp
                                    @foreach($brunch_dayss as $br_days)
                                    <button type='button' class='daysblock' id="{{$br_days}}_{{$x}}" value="{{$br_days}}" onclick='removeddays2(this.value,"{{$x}}")'> <span class='crossx'>X</span>{{$br_days}}</button>
                                    @endforeach
                                </div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]"  value="{{date('H:i A',strtotime($brunch_hours->start_time))}}" class="form-control timepicker" placeholder="Start Time" data-validation="required" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]"  value="{{date('H:i A',strtotime($brunch_hours->end_time))}}" class="form-control timepicker" placeholder="End Time" data-validation="required"/>
                                    </td>
                                    <td class="col-sm-3">
                                        <textarea class="form-control" name="food[]" placeholder="Food" data-validation="required">{{$brunch_hours->food}}</textarea>
                                    </td>
                                    <td class="col-sm-3"> <textarea class="form-control" name="drink[]" placeholder="Drink" data-validation="required">{{$brunch_hours->drink}}</textarea>
                                     <input type="hidden" name="srt_day[]" id="str_days2_{{$x}}" value="{{$brunch_hours->days}}">


                                    </td>
                                     @if($x!=0)
                                    <td><input type="button" class="ibtnDel_brunch btn btn-md btn-danger " onclick="delBrunchRow('{{$x}}')"  value="Delete"></td>
                                    @endif
                                </tr>
                                @php $x++;@endphp
                                @endforeach
                                @else
                                 <tr id="brunch_remove_row_0">
                                 <td colspan="5" class="allcol"><div><h2 class="heading">Quick Filters</h2> <span class="start_validation">*</span></div><div>
                                   @if(count($brunch_filters)>0)
                                    @foreach($brunch_filters as $brunch_filter)
                                    <label><input type="checkbox" class="brunchFilter_0" onchange="brunchFilters(this.value,0)" class="brunchFilter" value="{{$brunch_filter->name}}">{{ucwords($brunch_filter->name)}}</label>
                                    @endforeach
                                    @endif
                                    <input type="hidden" name="brunch_filter[]" id="brunch_days_0">
                                     </div></td>
                                </tr>
                                 <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days2" onchange="selectonchange2(this.value, this.id)" name="days[]" id="days2_0" data-validation="required" style="width: 200px">
                                    <option value="">Select Days</option>
                                    @foreach(daysList() as $days)
                                    <option value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                    <div class="selecteddays" id="selectddays2_0"></div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]" class="form-control timepicker" placeholder="Start Time" data-validation="required" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]"   class="form-control timepicker" placeholder="End Time" data-validation="required"/>
                                    </td>
                                    <td class="col-sm-3">
                                        <textarea class="form-control" name="food[]" placeholder="Food" data-validation="required"></textarea>
                                    </td>
                                    <td class="col-sm-3"> <textarea class="form-control"  name="drink[]" placeholder="Drink" data-validation="required"></textarea></a>
                                     <input type="hidden" name="srt_day[]" id="str_days2_0">
                                    <!--  <input type="hidden" name="common_filed1" id="comm_2">
                                     <input type="hidden" name="common_filed1" value="0" id="getcounter2">  -->

                                    </td>
                                </tr>

                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: left;">
                                        <input type="button" class="btn btn-lg btn-block " id="brunch_addrow" value="Add Row" />
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                      <div class="approveRight approveRight22 boxs">
                                <ul>
                                    <li><button type="submit" class="Btns" id="e1">Save For Future</button></li>
                                    <li><button type="submit" class="Btns" id="e2">Save and Next</button></li>
                                    <li><input type="hidden" name="button_type" id="brunch_button_type"></li>
                                </ul>

                            </div>
                  </form>
                </div>

                <div id="menu4" class="tab-pane fade">
                 <form method="post" id="SaveMusicDetail">
                  @csrf
                        <div class="sliderComonAt boxs">
                            <div class="sliderLeftAt boxs">
                                <h2 class="heading">Live Music Details</h2>

                            </div>

                        </div>
                          <div class="tabSlide boxs">
                    <div class="">
                     <table id="MusicTbl" class=" table music_table">
                            <thead>
                                <tr>
                                    <td>Days <span class="start_validation">*</span></td>
                                    <td>Start Time <span class="start_validation">*</span></td>
                                    <td>End Time <span class="start_validation">*</span></td>
                                    <td>Description</td>

                                </tr>
                            </thead>
                            <tbody>
                                 <tr><td>
                                   <input type="hidden" name="common_filed" id="comm_3" value="{{ returnDays($business->id,4) }}">
                                     <input type="hidden" name="common_filed" value="@if(count($music_happy_hours)>0) {{count($music_happy_hours)-1}} @else 0 @endif" id="getcounter3">
                                     <input type="hidden" name="" id="counter_cout3" value="@if(count($music_happy_hours)>0) {{count($music_happy_hours)}} @else 1 @endif">
                                </td></tr>
                                @if(count($music_happy_hours)>0)
                                @php $x=0;@endphp
                                @foreach($music_happy_hours as $music_hours)
                                <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days3" onchange="selectonchange3(this.value, this.id)" data-validation="required" name="days[]" id="days3_{{$x}}"  style="width: 200px">
                                    <option value="">Select Day</option>
                                    @foreach(daysList() as $days)
                                    <option value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                     <div class="selecteddays" id="selectddays3_{{$x}}">
                                    @php $music_dayss = explode(',',$music_hours->days); @endphp
                                    @foreach($music_dayss as $mu_day)
                                    <button type='button' class='daysblock' id="{{$mu_day}}_{{$x}}" value="{{$mu_day}}" onclick='removeddays3(this.value,"{{$x}}")'> <span class='crossx'>X</span>{{$mu_day}}</button>
                                    @endforeach
                                </div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]"  value="{{date('H:i A',strtotime($music_hours->start_time))}}" class="form-control timepicker" placeholder="Start Time" data-validation="required" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]"  value="{{date('H:i A',strtotime($music_hours->end_time))}}" class="form-control timepicker" placeholder="End Time" data-validation="required"/>
                                    </td>
                                    <td class="col-sm-3"> <textarea class="form-control" name="description[]" placeholder="Description" data-validation="required">{{$music_hours->description}}</textarea>
                                     <input type="hidden" name="srt_day[]" id="str_days3_{{$x}}" value="{{$music_hours->days}}">


                                    </td>
                                     @if($x!=0)
                                    <td><input type="button" class="ibtnDel_music btn btn-md btn-danger "  value="Delete"></td>
                                    @endif
                                </tr>
                                @php $x++;@endphp
                                @endforeach
                                @else
                                 <tr>
                                    <td class="col-sm-2">
                                    <select class="form-control days3" onchange="selectonchange3(this.value, this.id)" name="days[]" id="days3_0" data-validation="required" style="width: 200px">
                                    <option value="">Select Days</option>
                                    @foreach(daysList() as $days)
                                    <option value="{{$days}}">{{$days}}</option>
                                    @endforeach
                                    </select>
                                     <div class="selecteddays" id="selectddays3_0"></div>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="hidden" name="business_id" value="{{$business->id}}">
                                        <input type="text" name="start_time[]" class="form-control timepicker" placeholder="Start Time" data-validation="required" />
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" name="end_time[]"   class="form-control timepicker" placeholder="End Time" data-validation="required"/>
                                    </td>

                                    <td class="col-sm-3"> <textarea class="form-control"  name="description[]" placeholder="Description" data-validation="required"></textarea></a>
                                     <input type="hidden" name="srt_day[]" id="str_days3_0">
                                   <!--   <input type="hidden" name="common_filed1" id="comm_3">
                                     <input type="hidden" name="common_filed1" value="0" id="getcounter3">  -->

                                    </td>
                                </tr>

                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: left;">
                                        <input type="button" class="btn btn-lg btn-block " id="music_addrow" value="Add Row" />
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                      <div class="approveRight approveRight22 boxs">
                                <ul>
                                    <li><button type="submit" class="Btns" id="f1">Save For Future</button></li>
                                    <li><button type="submit" class="Btns" id="f2">Save and Next</button></li>
                                    <li><input type="hidden" name="button_type" id="music_button_type"></li>
                                </ul>

                            </div>
                    </form>




                </div>


                <div id="menu6" class="tab-pane fade">
                    <form method="post" id="SaveAmentitiesCategory" enctype="multipart/form-data">
                        @csrf
                        <div class="sliderComonAt boxs">

                            <div class="sliderLeftAt boxs">
                                <div class="imgUploaded boxs">
                                    <div class="grid-x grid-padding-x">
                                        <div class="boxs padding-Top">
                                            <div class="newDrag">

                                             <div class="dropzone"></div>
                                    </div>

                                            <!-- <h4>
                                                <label for="upload_imgs" class="buttons holloww"><i
                                                        class="fa fa-plus"></i></label>
                                                <input type="hidden" name="business_id" value="{{$business->id}}">
                                                <input class="show-for-sr" type="file" id="gallery-photo-add"
                                                    name="image[]" multiple="multiple" />
                                                </p>
                                                <div class="quote-imgs-thumbs quote-imgs-thumbs--hidden gallery"
                                                    id="gallery" aria-live="polite"></div>

                                                <p>

                                            </h4>
 -->


                                        </div>
                                    </div>
                                    <p class="padding-Top " >Please add images in the following priority from most to least: 1. Drinks 2.Bar 3. Music 4. Building in/out 5 Food 6. Logo</p>

                                </div>

                            </div>

                        </div>
                        <div>
                            <div class="AllAmentities AmentitiesCheckBox boxs">
                                <div class="slideRightAt boxs" style="width:100%;">
                                            <ul>
                                        @if(count($amentities_image)>0)
                                        @foreach($amentities_image as $amentities_img)
                                        <li id="delete_img_{{$amentities_img->id}}">
                                            <span onclick="RemoveImg('{{$amentities_img->id}}')">&times;</span>
                                            <a href="{{$amentities_img->image}}" target="_blank"><img src="{{$amentities_img->image}}" height="100" width="100"></a>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <h2 class="heading boxs">Amenities</h2>

                                <input type="hidden" name="business_id" value="{{$business->id}}">
                                @if(count($amentities)>0)
                                @php $amentities_arr = explode(',',$business->amenities);@endphp
                                @foreach($amentities as $amentitie)
                                <label>
                                    <input type="checkbox" class="radio" value="{{$amentitie->name}}" name="amentitie[]" @if(in_array($amentitie->name,$amentities_arr)) checked @endif/>
                                  <!--   <span class="dummyImg"><img src="{{$amentitie->image}}" alt="{{ucwords($amentitie->name)}}"></span> --><span style="color:{{$amentitie->color_code}}">{{ucwords($amentitie->name)}}<span></label>
                                @endforeach
                                @endif
                            </div>

                        </div>
                        @php $known_arr = explode(',',$business->know_for);@endphp
                        <div class="AllAmentities AmentitiesCheckBox boxs">
                            <h2 class="heading">Known For</h2>
                            <input type="hidden" name="business_id" value="{{$business->id}}">
                                @php $known_arr = explode(',',$business->know_for);@endphp
                                @foreach( knownFor() as $known_for)
                                <label>
                                    <input type="checkbox" class="radio" value="{{$known_for}}" name="know_for[]" @if(in_array($known_for,$known_arr)) checked @endif/>
                                   <span>{{ucwords($known_for)}}<span></label>
                                @endforeach
                        </div>
                    <div class="AllAmentities AmentitiesCheckBox boxs">
                    <h2 class="heading">Other Known</h2>
                    <input type="text" name="other_known" class="form-control" value="{{$business->other_known}}">
                  </div>

                    <div class="AllAmentities AmentitiesCheckBox boxs">
                    <h2 class="heading">Notes</h2>
                    <textarea class="form-control" placeholder="Write a Comments" name="notes">{{$business->notes}}</textarea>
                  </div>
            <br>
             <div class="slideRightAt" >
                <button type="submit" class="Btns" style="margin-top:20px">Review</button>
            </div>
            </form>
                </div>

        </div>
        <span id="snackbar"></span>
        <!--delete category-->
  <div class="modal fade modalBlock" id="deleteModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
 <form action="{{route('techadmin.deleteSavedBusiness')}}" method="post">
 @csrf
 <div class="modalContent">
     <h2><i class="fa fa-question-circle"></i></h2>
     <p>Are you sure you want to delete this business ?</p>
       <div class="form-group">
       <textarea name="comment" class="form-control" placeholder="Enter Comment"></textarea>
       <input type="hidden" name="id" id="id">
       </div>
     <ul>
         <li><button type="submit" class="Btns">Yes</button></li>
         <li><a href="javascript:void(0)" data-dismiss="modal" class="cancelAll">Cancel</a></li>
     </ul>
 </div>
  </form>
        </div>

      </div>

    </div>
  </div>
 <!--end of delete-->

</section>
@endsection
@push('script')
<link href="{{asset('assets/tech/css/select2.min.css')}}" rel="stylesheet" media="all">
<script src="{{asset('assets/tech/js/select2.min.js')}}"></script>
<script src="{{asset('assets/tech/js/custom-ajax.js')}}"></script>
<script src="{{asset('assets/tech/js/custom-ajax1.js')}}"></script>
<script src="{{asset('assets/tech/js/custom-ajax2.js')}}"></script>
<script src="{{asset('assets/tech/js/custom-ajax3.js')}}"></script>
<script>
$(document).ready(function() {
  var arr = "{{$tab_data}}";
  //alert(arr);

         var x  = arr.replace(/&quot;/g,'"');
         //alert(x);
         var y = JSON.parse(x);
         // alert(y);
         // var str = "" + y + "";
         // var res = str.split(",");
         // alert(res);
         var res = [];

            for(var i in y) {
                res.push(y[i]);
            }
           // alert(res);
$("#demoTabs").tabs({
disabled: res
});
});
</script>
<script>
function readUrl(input) {
if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = e => {
      let imgData = e.target.result;
      let imgName = input.files[0].name;
      input.setAttribute("data-title", imgName);
      console.log(e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }

}
</script>
<script>
 $("#b1").click(function(){
    $("#button_type").val(1);
    });
 $("#b2").click(function(){
    $("#button_type").val(2);
    });

 $("#c1").click(function(){
    $("#hh_button_type").val(1);
    });
 $("#c2").click(function(){
    $("#hh_button_type").val(2);
    });

 $("#d1").click(function(){
    $("#rev_button_type").val(1);
    });
 $("#d2").click(function(){
    $("#rev_button_type").val(2);
    });

  $("#e1").click(function(){
    $("#brunch_button_type").val(1);
    });
 $("#e2").click(function(){
    $("#brunch_button_type").val(2);
    });

  $("#f1").click(function(){
    $("#music_button_type").val(1);
    });
 $("#f2").click(function(){
    $("#music_button_type").val(2);
    });

</script>
<script>
//Happy hours
$('input[type=radio][name=happy_status]').change(function() {
 var status = this.value;
 if(status==1){
 $("#second1").show();
  $("#demoTabs").tabs("enable",1);
 }else{
$("#second1").hide();
 }
});
$(document).ready(function(){
 if($("input[type=radio][name='happy_status']:checked").val()==0){
 $("#second1").hide();
}
});
//Reverse happy hours
$('input[type=radio][name=reverse_status]').change(function() {
 var status = this.value;
 if(status==1){
 $("#third1").show();
  $("#demoTabs").tabs("enable", 2);
 }else{
$("#third1").hide();
 }
});
$(document).ready(function(){
 if($("input[type=radio][name='reverse_status']:checked").val()==0){
 $("#third1").hide();
}
});
//Brunch
$('input[type=radio][name=brunch_status]').change(function() {
 var status = this.value;
 if(status==1){
 $("#fourth1").show();
  $("#demoTabs").tabs("enable", 3);
 }else{
$("#fourth1").hide();
 }
});
$(document).ready(function(){
 if($("input[type=radio][name='brunch_status']:checked").val()==0){
 $("#fourth1").hide();
}
});
//Live music
$('input[type=radio][name=music_status]').change(function() {
 var status = this.value;
 if(status==1){
 $("#fifth1").show();
  $("#demoTabs").tabs("enable", 4);
 }else{
$("#fifth1").hide();
 }
});
$(document).ready(function(){
 if($("input[type=radio][name='music_status']:checked").val()==0){
 $("#fifth1").hide();
}
});

</script>
<script>

</script>
<script>
$("#category_id").select2({
 placeholder: "Please select category"
});

</script>
<script>
    //basic menue
    $(document).ready(function() {
        $('#memuForm').on('submit', function(event) {
            event.preventDefault();
           // $('#test').pleaseWait();
           $("#btn1").html('Please wait..');
            $.ajax({
                url: "{{ route('techadmin.saveBasicMenue') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#btn1").html('Save');
                if(data.class_name==1){
                    $('#memuForm')[0].reset();
                    $("#fileimage").attr('data-title','Drag and drop a file');
                    getMenueAjax(data.business_id, 1, 'menue_result');
                  }
                  showmsg(data.message);
                }
            })
        });

    });
    //HH menue
    $(document).ready(function() {
        $('#HhMenueForm').on('submit', function(event) {
            // alert();
            event.preventDefault();
            $("#btn2").html('Please wait..');
            $.ajax({
                url: "{{ route('techadmin.saveBasicMenue') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // alert(data);
                $("#btn2").html('Save');
                if(data.class_name==1){
                $('#HhMenueForm')[0].reset();
                $("#imagefile2").attr('data-title','Drag and drop a file');
                getMenueAjax(data.business_id, 2, 'hh_menue_result');
                }
               showmsg(data.message);
                }
            })
        });

    });

    //REVERSE_MENUE
    $(document).ready(function() {
        $('#REVERSE_MENUE').on('submit', function(event) {
            event.preventDefault();
            $("#btn3").html('Please wait..');
            $.ajax({
                url: "{{ route('techadmin.saveBasicMenue') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                $("#btn3").html('Save');
                if(data.class_name==1){
                $('#REVERSE_MENUE')[0].reset();
                $("#fileimage3").attr('data-title','Drag and drop a file');
                getMenueAjax(data.business_id, 3, 'reverse_menue_result');
                }
                showmsg(data.message);
                }
            })
        });
    });
    //BRUNCH_MENUE
    $(document).ready(function() {
        $('#BRUNCH_MENUE').on('submit', function(event) {
            event.preventDefault();
            $("#btn4").html('Please wait..');
            $.ajax({
                url: "{{ route('techadmin.saveBasicMenue') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                $("#btn4").html('Save');
                if(data.class_name==1){
                $('#BRUNCH_MENUE')[0].reset();
                $("#fileimage4").attr('data-title','Drag and drop a file');
                getMenueAjax(data.business_id, 4, 'brunch_menue_result');
                }
                showmsg(data.message);
                }
            })
        });
    });
    //get menue list
    function getMenueAjax(business_id, type, id) {
        $.ajax({
            'url': "{{route('techadmin.getMenueAjax')}}",
            'type': 'POST',
            'data': {
                "_token": "{{ csrf_token() }}",
                "business_id": business_id,
                'type': type,
            },
            'success': function(res) {
                //alert(res);
                $("#" + id).html(res);
            },
            'error': function(request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    }

    //delete menue
    function deleteMenue(menue_id) {
        //alert(menue_id);return false;
        $.ajax({
            'url': "{{route('techadmin.deleteAjaxMenue')}}",
            'type': 'POST',
            'data': {
                "_token": "{{ csrf_token() }}",
                "menue_id": menue_id,
            },
            'success': function(res) {
                // alert(res);
                //$("#menue_result").html(res);
                $("#row1_" + menue_id).remove();
                $("#row2_" + menue_id).remove();
                $("#row_" + menue_id).remove();
            },
            'error': function(request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    }

</script>
<script>
    //save basic detail tab 1
    $(document).ready(function() {
        $('#SaveBasicDetails').on('submit', function(event) {

           // alert();
            event.preventDefault();
            $.ajax({
                'url': "{{route('techadmin.SaveBasicDetails')}}",
                'type': 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                'success': function(data) {
            if(data.error_code==2 && data.button_type==2){
                if($("input[type=radio][name='happy_status']:checked").val()==1){
                    $("#demoTabs").tabs("enable", 1);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").addClass("active");
                    $("#menu1").addClass("show active");
                }else if($("input[type=radio][name='reverse_status']:checked").val()==1){
                    $("#demoTabs").tabs("enable", 2);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#third").addClass("active");
                    $("#menu2").addClass("show active");
                  //  alert('rev');
                }else if($("input[type=radio][name='brunch_status']:checked").val()==1)  {
                    $("#demoTabs").tabs("enable", 3);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#fourth").addClass("active");
                    $("#menu3").addClass("show active");
                  //  alert('ok');
                } else if($("input[type=radio][name='music_status']:checked").val()==1) {
                    $("#demoTabs").tabs("enable", 4);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").addClass("active");
                    $("#menu4").addClass("show active");
                }else{
                    $("#demoTabs").tabs("enable", 5);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").removeClass("active");
                    $("#menu4").removeClass("show active");
                    $("#six").addClass("active");
                    $("#menu6").addClass("show active");
                }

                 }else if(data.error_code==1 && data.button_type==2){
                   showmsg(data.message);
                 }else if(data.button_type==1){
                  window.location = "{{route('techadmin.saved-bussiness')}}";
                 }

                },
                'error': function(request, error) {
                    alert("Request: " + JSON.stringify(request));
                }
            });
        });
    });
    //ssave tab2 detail
    $(document).ready(function() {
        $('#saveHappyDetail').on('submit', function(event) {
             filterArr();
            event.preventDefault();
            $.ajax({
                'url': "{{route('techadmin.saveHappyDetail')}}",
                'type': 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                'success': function(data) {
                  //console.log(data);return false;
                 // alert($("input[type=radio][name='reverse_status']:checked").val());
               if(data.error_code==2 && data.button_type==2){
                if($("input[type=radio][name='reverse_status']:checked").val()==1){
                    $("#demoTabs").tabs("enable", 2);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").addClass("active");
                    $("#menu2").addClass("show active");

                }else if($("input[type=radio][name='brunch_status']:checked").val()==1)  {
                    $("#demoTabs").tabs("enable", 3);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#fourth").addClass("active");
                    $("#menu3").addClass("show active");
                   // alert('brunch');
                } else if($("input[type=radio][name='music_status']:checked").val()==1) {
                    $("#demoTabs").tabs("enable", 4);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").addClass("active");
                    $("#menu4").addClass("show active");
                   // alert('music');
                }else{
                    $("#demoTabs").tabs("enable", 5);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").removeClass("active");
                    $("#menu4").removeClass("show active");
                    $("#six").addClass("active");
                    $("#menu6").addClass("show active");
                    //alert();
                }
               }else if(data.error_code==1 && data.button_type==2){
                   showmsg(data.message);
                 }else if(data.button_type==1){
                  window.location = "{{route('techadmin.saved-bussiness')}}";
                 }

                },
                'error': function(request, error) {
                    alert("Request: " + JSON.stringify(request));
                }
            });
        });
    });
    //save reverse happy hours
    $(document).ready(function() {
        $('#saveReverseHappy').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                'url': "{{route('techadmin.saveReverseHappy')}}",
                'type': 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                'success': function(data) {
                   // alert(data);return false;
                    //showmsg(data.message);
                   if(data.error_code==2 && data.button_type==2){
                    if($("input[type=radio][name='brunch_status']:checked").val()==1)  {
                    $("#demoTabs").tabs("enable", 3);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").addClass("active");
                    $("#menu3").addClass("show active");

                } else if($("input[type=radio][name='music_status']:checked").val()==1) {
                    $("#demoTabs").tabs("enable", 4);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").addClass("active");
                    $("#menu4").addClass("show active");
                    //alert('music');
                }else{
                    $("#demoTabs").tabs("enable", 5);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").removeClass("active");
                    $("#menu4").removeClass("show active");
                    $("#six").addClass("active");
                    $("#menu6").addClass("show active");
                   // alert();
                }
                 }else if(data.error_code==1 && data.button_type==2){
                   showmsg(data.message);
                 }else if(data.button_type==1){
                  window.location = "{{route('techadmin.saved-bussiness')}}";
                 }

                },
                'error': function(request, error) {
                    alert("Request: " + JSON.stringify(request));
                }
            });
        });
    });
    //SaveBrunchDetail
    $(document).ready(function() {
        $('#SaveBrunchDetail').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                'url': "{{route('techadmin.SaveBrunchDetail')}}",
                'type': 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                'success': function(data) {
                if(data.error_code==2 && data.button_type==2){
                 if($("input[type=radio][name='music_status']:checked").val()==1) {
                    $("#demoTabs").tabs("enable", 4);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").addClass("active");
                    $("#menu4").addClass("show active");
                    //alert('music');
                }else{
                    $("#demoTabs").tabs("enable", 5);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").removeClass("active");
                    $("#menu4").removeClass("show active");
                    $("#six").addClass("active");
                    $("#menu6").addClass("show active");
                   // alert();
                }
                 }else if(data.error_code==1 && data.button_type==2){
                   showmsg(data.message);
                 }else if(data.button_type==1){
                  window.location = "{{route('techadmin.saved-bussiness')}}";
                 }

                },
                'error': function(request, error) {
                    alert("Request: " + JSON.stringify(request));
                }
            });
        });
    });
    //SaveMusicDetail
    $(document).ready(function() {
        $('#SaveMusicDetail').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                'url': "{{route('techadmin.SaveMusicDetail')}}",
                'type': 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                'success': function(data) {
                    //  alert(data);
                    //showmsg(data.message);
                if(data.error_code==2 && data.button_type==2){
                   $("#demoTabs").tabs("enable",5);
                    $("#first").removeClass("active");
                    $("#home").removeClass("show active");
                    $("#second").removeClass("active");
                    $("#menu1").removeClass("show active");
                    $("#third").removeClass("active");
                    $("#menu2").removeClass("show active");
                    $("#fourth").removeClass("active");
                    $("#menu3").removeClass("show active");
                    $("#fifth").removeClass("active");
                    $("#menu4").removeClass("show active");
                    $("#six").addClass("active");
                    $("#menu6").addClass("show active");

                }else if(data.error_code==1 && data.button_type==2){
                   showmsg(data.message);
                 }else if(data.button_type==1){
                  window.location = "{{route('techadmin.saved-bussiness')}}";
                 }
                },
                'error': function(request, error) {
                    alert("Request: " + JSON.stringify(request));
                }
            });
        });
    });
    //SaveAmentitiesCategory
    $(document).ready(function() {
        $('#SaveAmentitiesCategory').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                'url': "{{route('techadmin.SaveAmentitiesCategory')}}",
                'type': 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                'success': function(data) {
                    // alert('move to review page');
                    window.location.href = "{{route('techadmin.businessReview',base64_encode($business->id))}}";

                },
                'error': function(request, error) {
                    alert("Request: " + JSON.stringify(request));
                }
            });
        });
    });

</script>
<script>
    //var rowIdx = "{{count($branches)}}";
    var get_count_dynamic = $("#get_branch_count").val();
    var count = get_count_dynamic.replace(/\s+/g, '');
    $('.add').click(function() {
  // alert(count);
        $('.optionBox').append(' <div class="profileDeet padding-Top boxs" id="rem2_'+count+'"><h2 class="profilee"><span>Branch ' + count + '</span></h2><span class="Btns removeSS"  onclick="removeRows('+count+')">Remove<i class="fa fa-minus"></i></span><div class="row padding-Top"><div class="col-sm-12"><lable>Search Address <span class="start_validation">*</span></lable><input type="text" placeholder="Search Address" class="form-control username" id="searchMapInput_'+count+'"/></div><p><strong>Note</strong>:- Please only select from the Pop Up Menu.  Do not type or copy paste address.</p> <div class="col-sm-8 marginTopp"><div class="form-group"><label>Google place Id <span class="start_validation">*</span><span class ="newAdd"><a href="https://developers.google.com/maps/documentation/javascript/examples/places-placeid-geocoder" target="_blank">(Click here to find out the Google Place ID)</a></span></label><input type="text" name="google_id[]" class="form-control" data-validation="required" data-validation-error-msg="Please enter google id"></div></div><div class="col-sm-4"><div class="form-group"><label>Branch Email <span class="start_validation">*</span></label><input type="text" name="email[]" class="form-control" data-validation="required email" data-validation-error-msg="Please enter email address"></div></div><div class="col-sm-4"><div class="form-group"><label> Address <span class="start_validation">*</span></label><input type="text" name="address[]" id="address_'+count+'" class="form-control" data-validation="required" data-validation-error-msg="Please enter address"></div></div><div class="col-sm-4"><div class="form-group"><label>City <span class="start_validation">*</span></label><input type="text" name="city[]" id="city_'+count+'" class="form-control" data-validation="required" data-validation-error-msg="Please enter city"></div></div><div class="col-sm-4"><div class="form-group"><label>State <span class="start_validation">*</span></label><input type="text" name="state[]" id="state_'+count+'" class="form-control" data-validation="required" data-validation-error-msg="Please enter state"></div></div><div class="col-sm-4"><div class="form-group"><label>Zipcode <span class="start_validation">*</span></label><input type="text" name="zipcode[]" id="zipcode_'+count+'" class="form-control" data-validation="required" data-validation-error-msg="Please enter zipcode"><input type="hidden" name="lat[]" id="lat_'+count+'"/><input type="hidden" name="long[]" id="long_'+count+'"></div></div></div>');
        //rowIdx++;
        count++;
    });
    // function renumberRows() {
    //   $(".optionBox > div").each(function(i, v) {
    //   //  alert(i);
    //     $(this).find(".rownumber").val(i + 1);
    //   });
    // }
    function removeRows(id) {
        //alert(id);
        $("#rem2_"+id).remove();
        $("#rem1_"+id).remove();
        count--;
    }
    //delete branch
    // function deleteBranch(id){
    //  $("#rem_"+id).remove();
    // }

</script>
<script>
    function showmsg(msg) {
        //alert(msg);
        var x = document.getElementById("snackbar");
        x.className = "show";
        $("#snackbar").html(msg);
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 5000);
    }

</script>
<script>
    //$.validate({
      //  form: '#SaveBasicDetails1',
        //validateHiddenInputs: true,
        //onSuccess: function($form) {
//
    //        $('#smt').hide();
  //          $('#buttonreplacement').show();
      //  }

    //});
    // $.validate({
    //     form: '#SaveMusicDetail',
    //     validateHiddenInputs: true,
    //     onSuccess: function($form) {

    //         $('#smt').hide();
    //         $('#buttonreplacement').show();
    //     }

    // });
    // $.validate({
    //     form: '#SaveBrunchDetail',
    //     validateHiddenInputs: true,
    //     onSuccess: function($form) {

    //         $('#smt').hide();
    //         $('#buttonreplacement').show();
    //     }

    // });

    // $.validate({
    //     form: '#saveReverseHappy',
    //     validateHiddenInputs: true,
    //     onSuccess: function($form) {

    //         $('#smt').hide();
    //         $('#buttonreplacement').show();
    //     }

    // });
    // $.validate({
    //     form: '#saveHappyDetail',
    //     validateHiddenInputs: true,
    //     onSuccess: function($form) {

    //         $('#smt').hide();
    //         $('#buttonreplacement').show();
    //     }

    // });


</script>

<script>
    function RemoveImg(id) {
        $.ajax({
            'url': "{{route('techadmin.removeImage')}}",
            'type': 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            'success': function(data) {
                $("#delete_img_" + id).remove();

            },
            'error': function(request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    }
    //Disabling autoDiscover
    Dropzone.autoDiscover = false;
    $(function() {
        //Dropzone class
        var myDropzone = new Dropzone(".dropzone", {
            url: "{{route('techadmin.uploadImages',$business->id)}}",
            paramName: "file",
            maxFilesize: 2,
            maxFiles: 10,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
           // acceptedFiles: ".jpeg,.jpg,.png,.gif",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
//     init: function() {
//      this.on("removedfile", function(file) {
//          // alert("Delete this file?"+file.name);
//           $.ajax({
//                route: "{{route('techadmin.removeDropZoneImg')}}",
//                type: "POST",
//                data: {
//                  "_token": "{{ csrf_token() }}",
//                 'file_name': file.name,
//                  'business_id' : "{{$business->id}}",
//                }
//           });
//      });
// }
        });
    });

</script>
<script>
    //add rating
    // $('input:radio[name=rating1]').click(function() {
    //     var val = $('input:radio[name=rating1]:checked').val();
      function YelpRating(){
         var val = $("#yelp_rating").val();
        $.ajax({
            'url': "{{route('techadmin.addRating')}}",
            'type': 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                rating: val,
                'business_id': "{{$business->id}}",
                'type': 1,
            },
            'success': function(data) {
                showmsg('Yelp Rating added successfully.');
            },
            'error': function(request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    //});
   }


      function GoogleRating(){
    //$('input:radio[name=rating]').click(function() {
       //  val = $('input:radio[name=rating]:checked').val();
       var val = $("#google_rating").val();
        $.ajax({
            'url': "{{route('techadmin.addRating')}}",
            'type': 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                rating: val,
                'business_id': "{{$business->id}}",
                'type': 2,
            },
            'success': function(data) {
                showmsg('Google Rating added successfully.');
            },
            'error': function(request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    }
   // });

</script>
<script>
 $('input[type="radio"]').change(function(){
    $(this).removeClass('valid');
   // alert(this.className);
    $('.' + this.className).prop('checked', this.checked);
});

//reset
function ResetMenueForm(){
    $("#fileimage").attr('data-title','Drag and drop a file');
    $("#imagefile2").attr('data-title','Drag and drop a file');
    $("#fileimage3").attr('data-title','Drag and drop a file');
    $("#fileimage4").attr('data-title','Drag and drop a file');
    $('#memuForm')[0].reset();
    $('#HhMenueForm')[0].reset();
    $('#REVERSE_MENUE')[0].reset();
    $('#BRUNCH_MENUE')[0].reset();
}
</script>
<script>
$(document).ready(function(){

 $(document).on('keydown', '.username', function() {

  var id = this.id;
  var splitid = id.split('_');
  var index1 = splitid[1];
  $("#"+id).removeClass('valid');
 // alert(id);
   initMap(index1);
 });
  });
function initMap(index1) {
    var input = document.getElementById('searchMapInput_'+index1);
    var inputvalue = document.getElementById('searchMapInput_'+index1).value;
    //alert(index1);
      //var input = id;
    //searchMapInput_0
    if(inputvalue.length > 5) {
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
               // alert(place.long_name);
                var address = place.formatted_address;
                var  value = address.split(",");
                count=value.length;
                country=value[count-1];
                state=value[count-2];
                city=value[count-3];
                var z=state.split(" ");
                for (var i = 0; i < place.address_components.length; i++) {
              for (var j = 0; j < place.address_components[i].types.length; j++) {
               // alert(place.address_components[i].types[j] );
                if (place.address_components[i].types[j] == "locality") { //city
                    document.getElementById('city_'+index1).value = place.address_components[i].long_name;
                 //alert(place.address_components[i].long_name);
                 }
                 if (place.address_components[i].types[j] == "administrative_area_level_1") { //state
                 //alert(place.address_components[i].long_name);
                  document.getElementById('state_'+index1).value = place.address_components[i].long_name;

                }
                 if (place.address_components[i].types[j] == "postal_code") { //code
                 //alert(place.address_components[i].long_name);
                 document.getElementById('zipcode_'+index1).value = place.address_components[i].long_name;

                }
              }
          }
            //alert(z[3]);
            document.getElementById('address_'+index1).value = place.formatted_address;
            document.getElementById('lat_'+index1).value = place.geometry.location.lat();
            //document.getElementById('country_'+index1).value = country;
          //  alert(country);return false;
            //document.getElementById('state_'+index1).value = state;
            //document.getElementById('city_'+index1).value = city;
           // $("#lat_0").val('kkk');
            document.getElementById('long_'+index1).value = place.geometry.location.lng();
        });
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVjRNkX_aKX-TJEOrmXL3sRcnbfBBViiM&libraries=places&callback=initMap"></script>
<script>
 $(function() {
$('.timepicker').timepicker({
   interval: 30,
    minTime: '09:00 am',
    maxTime: '01:30 am',
    dynamic: false,
    scrollbar: true,
});
});

function filterArr(){
  var check_val = $("input[name='filters']:checked").map(function() {
                return this.value;
            }).get().join(', ');

    $("#filter_str").val(check_val);
}

//delete
$('#deleteModal').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id = button.data('id');
var modal = $(this);
modal.find('.modal-body #id').val(id);
})
</script>
<script>
 //add more row
$(document).ready(function () {
    var counter = $("#counter_cout").val();
    var counter =counter.replace(/\s+/g, '');
    valuesupdateall();

   // var counter = 1;

    $("#addrow").on("click", function () {
      //  alert(counter);
        var newRow = $("<tr class ='trAll'>");
        var newRow1 = $("<tr class='trAll1' id='remove_row_"+counter+"'>");
        var cols = "";
        var cols1 = "";
        // total_rows = $("#myTable tr").length;
         var rowCount = $("#myTable td").closest("tr").length;
         if(rowCount>16){
            alert("you can not insert more than 7 rows");
            return false;
         }

        $("#getcounter").val(counter);
        cols1 = '<td colspan="6" class="allcol"><div><h2 class="heading">Quick Filters</h2> <span class="start_validation">*</span></div><div>@if(count($filter)>0)@foreach($filter as $filters) <label><input type="checkbox" class="quickFilter_'+counter+'"  value="{{$filters->name}}">{{ucwords($filters->name)}}</label> @endforeach @endif  </div><input type="hidden"  id="quick_days_'+counter+'"  name="quick_filter[]"/></td>';
        cols += '<td><select class="form-control days"  name="days[]" data-validation="required" id="days_'+counter+'" onchange="selectonchange(this.value, this.id)"><option value="">Select Days</option><option value="Mon">Mon</option><option value="Tue">Tue</option><option value="Wed">Wed</option><option value="Thu">Thu</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select><div class="selecteddays" id="selectddays_'+counter+'"></div></td>';
        cols += '<td><input type="text" class="form-control timepicker" autocomplete="off"  name="start_time[]" data-validation="required" id="start_time_'+counter+'" placeholder="Start Time" /></td>';
        cols += '<td><input type="text" class="form-control timepicker"  autocomplete="off"  name="end_time[]" data-validation="required" id="end_time_'+counter+'" placeholder="End Time" /></td>';
        cols += '<td><textarea class="form-control" placeholder="Food" name="food[]" data-validation="required" /></textarea></td>';
        cols += '<td><textarea class="form-control" placeholder="Drink" name="drink[]" data-validation="required"/></textarea><input type="hidden" name="srt_day[]" id="tt_'+counter+'"/></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete" onclick="delRow('+counter+')"/></td>';
        newRow.append(cols);
        newRow1.append(cols1);
        $(".order-list").append(newRow1);
        $(".order-list").append(newRow);
     // alert(counter);
       var getCounter = $("#getcounter").val();
        valuesupdateall();
        $('.quickFilter_'+getCounter).change(function(){
          var value = $('.quickFilter_'+getCounter+':checked').map(function(){return this.value}).get();
        // alert("#quick_days_"+getCounter+'');
          $("#quick_days_"+getCounter).val(value);
        });

        $('.timepicker').timepicker({
               interval: 30,
                minTime: '09:00 am',
                maxTime: '01:30 am',
               dynamic: false,
               scrollbar: true,
            });


        counter++;
    });

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();

        valuesupdateall();
       // counter--;

    });
});

//brunch add more rows
$(document).ready(function () {
    var counter2 = $("#counter_cout2").val();
    var counter2 =counter2.replace(/\s+/g, '');
    valuesupdateall2();

    $("#brunch_addrow").on("click", function () {
        var brunch_newRow = $("<tr>");
        var brunch_newRow1 = $("<tr class='trAll1' id='remove_brunch_row_"+counter2+"'>");
        var brunch_cols = "";
        var brunch_cols1 = "";
        total_rows = $("#BrunchTbl tr").length;
         var rowCount = $("#BrunchTbl td").closest("tr").length;
         if(rowCount>16){
            alert("you can not insert more than 7 rows");
            return false;
         }
        $("#getcounter2").val(counter2);
         brunch_cols1 = '<td colspan="6" class="allcol"><div><h2 class="heading">Quick Filters</h2> <span class="start_validation">*</span></div><div>@if(count($brunch_filters)>0)@foreach($brunch_filters as $brunch_filter) <label><input type="checkbox" class="brunchFilter_'+counter2+'"  value="{{$brunch_filter->name}}">{{ucwords($brunch_filter->name)}}</label> @endforeach @endif  </div><input type="hidden"  id="brunch_days_'+counter2+'"  name="brunch_filter[]"/></td>';
        brunch_cols += '<td><select class="form-control days2"  name="days[]" onchange="selectonchange2(this.value, this.id)" data-validation="required" id="days2_'+counter2+'"><option value="">Select Days</option><option value="Mon">Mon</option><option value="Tue">Tue</option><option value="Wed">Wed</option><option value="Thu">Thu</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select><div class="selecteddays" id="selectddays2_'+counter2+'"></div></td>';
        brunch_cols += '<td><input type="text" class="form-control timepicker"  autocomplete="off"  name="start_time[]" data-validation="required" timepicker" id="start_time2_'+counter2+'" placeholder="Start Time" /></td>';
        brunch_cols += '<td><input type="text" class="form-control timepicker"  autocomplete="off"  name="end_time[]" data-validation="required" id="end_time2_'+counter2+'" placeholder="End Time" /></td>';
        brunch_cols += '<td><textarea class="form-control" placeholder="Food" name="food[]" data-validation="required" /></textarea></td>';
        brunch_cols += '<td><textarea class="form-control" placeholder="Drink" name="drink[]" data-validation="required"/></textarea><input type="hidden" name="srt_day[]" id="str_days2_'+counter2+'"/></td>';
        brunch_cols += '<td><input type="button" class="ibtnDel_brunch btn btn-md btn-danger" onclick="delBrunchRow('+counter2+')"  value="Delete"></td>';
        brunch_newRow.append(brunch_cols);
        brunch_newRow1.append(brunch_cols1);
        $(".brunch_table").append(brunch_newRow1);
        $(".brunch_table").append(brunch_newRow);

          valuesupdateall2();
          var getCounter = $("#getcounter2").val();
          $('.brunchFilter_'+getCounter).change(function(){
          var value = $('.brunchFilter_'+getCounter+':checked').map(function(){return this.value}).get();
          $("#brunch_days_"+getCounter).val(value);
        });
          $('.timepicker').timepicker({
               interval: 30,
                minTime: '09:00 am',
                maxTime: '01:30 am',
               dynamic: false,
               scrollbar: true,
            });

   counter2++;
    });


    $("table.brunch_table").on("click", ".ibtnDel_brunch", function (event) {
        $(this).closest("tr").remove();
         valuesupdateall2();

   });


});

function delRow(id){
    $("#remove_row_"+id).remove();
}
function delBrunchRow(id){
    $("#remove_brunch_row_"+id).remove();
}
</script>
<script>
function QuickFilters(val,id){
 var value = $('.quickFilter_'+id+':checked').map(function(){return this.value}).get();
  $("#quick_days_"+id).val(value);
}

function brunchFilters(val,id){
 var value = $('.brunchFilter_'+id+':checked').map(function(){return this.value}).get();
// alert(value);
  $("#brunch_days_"+id).val(value);
}

$(document).ready(function(){
$(document).on('change', '.username', function() {
   // alert();
  var id = this.id;
  var splitid = id.split('_');
  var index1 = splitid[1];
  $("#lat_"+index1).val("");
  $("#long_"+index1).val("");
   setTimeout( function(){
    var lat = $("#lat_"+index1).val();
    var long = $("#long_"+index1).val();
   if((lat=='' || lat=='0.000000') || (long=='' || long=='0.000000')){
   $("#searchMapInput_"+index1).val(" ");
    alert('Please select the address from the List View.');
   }
}  , 2000 );
});
 });
</script>
@endpush
