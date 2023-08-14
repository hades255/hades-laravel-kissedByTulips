<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\admin\investigator\InvestigatorRequest;
use App\Http\Requests\admin\investigator\PasswordRequest;

class InvestigatorController extends Controller
{

  public function index(){  //listing for all investigator roles user
    $investigators = User::where('role',3)->get();
    return view('admin.investigator.index',['investigators'=>$investigators]);
  }

  public function view(){ //return view for add new investigator
    return view('admin.investigator.add');
  }

  public function store(InvestigatorRequest $request){  //update & store for admin investigator
    $data = [
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'email'      => $request->email,
        'phone'      => $request->phone,
        'password'   => isset($request->password) ? Hash::make('12345678'):'',
        'role'       => 3,
    ];
    User::updateOrCreate([
        'id' => $request->id
    ], $data);
    session()->flash('success', 'Hi Admin , Investigator Record Added Sucessfully!');
    return redirect()->route('admin.investigator.index');
  }

  public function edit($id){ //find exist investigator user and return data in form
    $investigator  = User::find($id);
    return view('admin.investigator.add',['investigator'=>$investigator]);
  }

  public function delete($id){ //delete investigator user from table
    User::find($id)->delete();
    return redirect()->route('admin.investigator.index');
  }

  public function investigatorResetPassword($id){ //show reset password form for hr
    $user_id = isset($id) ? $id : '';
    return view('admin.investigator.reset-password',compact('user_id'));
  }

  public function investigatorResetUpdate(PasswordRequest $request){ //update password for hr
    $user = User::find($request->user_id);
    $user->update([
        'password' => Hash::make($request->password),
    ]);
    session()->flash('success', 'Hi Admin , Investigator Password Reset Sucessfully!');
    return redirect()->route('admin.investigator.index');
  }

}
