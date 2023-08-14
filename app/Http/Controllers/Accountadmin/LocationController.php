<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;
use App\State;
use App\Country;
use App\Timezone;
use App\LocationType;
use App\LocationTime;
use DB;
use Auth;

class LocationController extends Controller
{
    public function index()
    {
        $account   = Auth::user();
        $locations = DB::table('kbt_locations')
            ->leftjoin('kbt_location_types', 'kbt_locations.pk_location_types', 'kbt_location_types.pk_location_types')
            ->get();
        return view('accountadmin.locations.index', ['locations' => $locations, 'account' => $account]);
    }

    public function create()
    {
        $account       = Auth::user();
        $states        = State::all();
        $countries     = Country::all();
        $timezones     = Timezone::all();
        $locationTypes = LocationType::all();
        $session_id    = time() . rand(11111, 99999);

        //$date = date('Y-m-d'); //today date
        $date       = date('Y-m-d', strtotime("this week"));
        $weekOfdays = array();
        for ($i = 1; $i <= 7; $i++) {
            if ($i == 1) {
                $date = date('Y-m-d', strtotime($date));
            } else {
                $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
            }
            $weekOfdays[] = array('name' => date('l : Y-m-d', strtotime($date)), 'date' => $date);
        }


        return view('accountadmin.locations.add', ['session_id' => $session_id, 'weekOfdays' => $weekOfdays, 'locationTypes' => $locationTypes, 'states' => $states, 'countries' => $countries, 'account' => $account, 'timezones' => $timezones]);
    }

    public function edit($id)
    {
        $account       = Auth::user()->pk_account;
        $states        = State::all();
        $countries     = Country::all();
        $timezones     = Timezone::all();
        $locationTypes = LocationType::all();
        $getLocation   = DB::table('kbt_locations')
            ->join('kbt_location_types', 'kbt_locations.pk_location_types', 'kbt_location_types.pk_location_types')
            ->where('pk_locations', $id)
            ->first();

        //$date = date('Y-m-d'); //today date
        $date       = date('Y-m-d', strtotime("this week")); //today date
        $weekOfdays = array();
        for ($i = 1; $i <= 7; $i++) {
            if ($i == 1) {
                $date = date('Y-m-d', strtotime($date));
            } else {
                $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
            }
            $weekOfdays[] = array('name' => date('l : Y-m-d', strtotime($date)), 'date' => $date);
        }

        return view('accountadmin.locations.add', ['locationTypes' => $locationTypes, 'weekOfdays' => $weekOfdays, 'states' => $states, 'countries' => $countries, 'getLocation' => $getLocation, 'timezones' => $timezones]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required|max:20',
            'location_code' => 'required|max:10',
        ]);

        $get_session_id = $request->session_id;

        if (!empty($request->pk_locations)) {
            $location                          = Location::find($request->pk_locations);
            $location->pk_account              = $request->pk_account;
            $location->pk_location_types       = $request->location_types;
            $location->location_name           = $request->location_name;
            $location->location_code           = $request->location_code;
            $location->address                 = $request->address;
            $location->address_1               = $request->address_1;
            $location->city                    = $request->city;
            $location->zip                     = $request->zip;
            $location->pk_states               = $request->pk_states;
            $location->pk_country              = $request->pk_country;
            $location->country_name            = $request->country_name;
            $location->state_name              = $request->state_name;
            $location->pk_timezone             = $request->pk_timezone;
            $location->tax_rate                = $request->tax_rate;
            $location->Estimated_Delivery_Time = $request->Estimated_Delivery_Time;
            $location->active                  = $request->active;
            $location->lng                     = $request->lng;
            $location->lat                     = $request->lat;
            $location->save();
        } else {
            $location                          = new Location;
            $location->pk_account              = $request->pk_account;
            $location->pk_location_types       = $request->location_types;
            $location->location_name           = $request->location_name;
            $location->location_code           = $request->location_code;
            $location->address                 = $request->address;
            $location->address_1               = $request->address_1;
            $location->city                    = $request->city;
            $location->zip                     = $request->zip;
            $location->pk_states               = $request->pk_states;
            $location->pk_country              = $request->pk_country;
            $location->tax_rate                = $request->tax_rate;
            $location->Estimated_Delivery_Time = $request->Estimated_Delivery_Time;

            $location->country_name = $request->country_name;
            $location->state_name   = $request->state_name;
            $location->pk_timezone  = $request->pk_timezone;
            $location->lng          = $request->lng;
            $location->lat          = $request->lat;
            $location->save();
        }


        LocationTime::where('pk_locations', $get_session_id)->update(array('pk_locations' => $location->pk_locations));


        $get_day        = !empty($request->day) ? $request->day : array();
        $get_open_time  = !empty($request->open_time) ? $request->open_time : array();
        $get_close_time = !empty($request->close_time) ? $request->close_time : array();
        $get_all_day    = !empty($request->all_day) ? $request->all_day : array();
        $get_start      = !empty($request->start) ? $request->start : array();
        if (!empty($get_day)) {

            foreach ($get_day as $key => $day_val) {

                $time_update = LocationTime::where('day', $day_val)->where('pk_locations', $location->pk_locations)->first();

                if (!empty($get_close_time[$key])) {
                    $save_data                      = array();
                    $save_data['pk_locations']      = $location->pk_locations;
                    $save_data['day']               = $day_val;
                    $save_data['pk_location_types'] = $location->pk_location_types;
                    $save_data['open_time']         = !empty($get_open_time[$key]) ? date('H:i:s', strtotime($get_open_time[$key])) : null;;
                    $save_data['close_time'] = !empty($get_close_time[$key]) ? date('H:i:s', strtotime($get_close_time[$key])) : null;
                    $save_data['start']      = !empty($get_start[$key]) ? date('Y-m-d', strtotime($get_start[$key])) : null;
                    //$save_data['active'] = !empty($get_all_day[$key])?1:0;
                    $save_data['active']  = 1;
                    $save_data['all_day'] = !empty($get_all_day[$key]) ? 1 : 0;
                    if (isset($get_all_day[$key])) {

                        $save_data['open_time']  = '00:00:00';
                        $save_data['close_time'] = '23:59:59';
                    }
                    //echo '<pre>'; print_r($save_data); die;
                    if (empty($time_update)) {
                        LocationTime::create($save_data);
                    } else {
                        $time_update->update($save_data);
                    }
                }
            }
        }

        $message = DB::table('kbt_acknowledgments')->where('pk_account', auth()->user()->pk_account)->first();
        session()->flash('success', $message);
        return redirect('/accountadmin/locations');
    }


    public function delete(Request $request, $id)
    {
        DB::table('kbt_locations')->where('pk_locations', $id)->delete();
        DB::table('kbt_location_times')->where('pk_locations', $id)->delete();
        return redirect()->route('accountadmin.locations.index')
            ->with('message', 'Location deleted successfully');
    }

    public function back()
    {
        return redirect('/accountadmin/locations');
    }

}
