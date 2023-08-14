<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VaseType;
use Auth;
use DB;

class VasetypeController extends Controller
{
    public function index()
    {
        $account   = Auth::user()->pk_account;
        $VaseTypes = VaseType::where('pk_account', $account)->get();
        return view('accountadmin.vase-type.index', ['VaseTypes' => $VaseTypes]);
    }


    public function create()
    {
        $pk_account = Auth::user()->pk_account;
        return view('accountadmin.vase-type.add', ['pk_account' => $pk_account]);
    }


    public function edit($id)
    {
        $pk_account = Auth::user()->pk_account;
        $VaseType   = DB::table('kbt_vase_type')->where('pk_account', $pk_account)->where('pk_vase_type', $id)->first();
        return view('accountadmin.vase-type.add', ['pk_account' => $pk_account, 'VaseType' => $VaseType]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vase_type' => 'required|max:30'
        ]);
        if (!empty($request->pk_vase_type)) {
            $Vasetype              = VaseType::find($request->pk_vase_type);
            $Vasetype->pk_account  = $request->pk_account;
            $Vasetype->vase_type   = $request->vase_type;
            $Vasetype->description = $request->description;
            $Vasetype->active      = $request->active;
            $Vasetype->save();
        } else {
            $Vasetype              = new VaseType;
            $Vasetype->pk_account  = $request->pk_account;
            $Vasetype->vase_type   = $request->vase_type;
            $Vasetype->description = $request->description;
            $Vasetype->save();
        }
        return redirect('/accountadmin/vase-types');
    }

    public function delete($id)
    {
        $pk_account = Auth::user()->pk_account;
        DB::table('kbt_vase_type')->where('pk_account', $pk_account)->where('pk_vase_type', $id)->delete();
        return redirect()->route('accountadmin.vase-types.index')
            ->with('message', 'products-categories deleted successfully');
    }

    public function back()
    {
        return redirect('/accountadmin/vase-types');
    }

}
