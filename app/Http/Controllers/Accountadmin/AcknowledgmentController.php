<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Acknowledgment;
use App\Http\Requests\AcknowledgmentsRequest;
use App\Page;
use Auth;
use DB;

class AcknowledgmentController extends Controller
{

  public function index()
  {
    $acknowledgments = Acknowledgment::with('createdBy:pk_users,first_name,last_name', 'updatedBy:pk_users,first_name,last_name')->get();

    return view('accountadmin.acknowledgments.index', ['acknowledgments' => $acknowledgments]);
  }


  public function create()
  {
    return view('accountadmin.acknowledgments.form');
  }


  public function edit($id)
  {
    $Acknowledgment = Acknowledgment::findOrFail($id);
    return view('accountadmin.acknowledgments.form', ['Acknowledgment' => $Acknowledgment]);
  }

  public function store(AcknowledgmentsRequest $request)
  {
    $checkQuery = Acknowledgment::query();
    $checkQuery = $checkQuery->where('message_code', $request->message_code);
    if ($request->pk_acknowledgmentsd) {
      $checkQuery = $checkQuery->where('pk_acknowledgments', '!=', $request->pk_acknowledgments);
    }
    $checkQuery = $checkQuery->count();

    if ($checkQuery) {
      return redirect()->back()->withInput()->with(['message' => "Duplicate message code not allowed.", "messageType" => "danger"]);
    }

    if ($request->pk_acknowledgments) {
      $item = Acknowledgment::where('pk_acknowledgments', $request->pk_acknowledgments)->update($request->validated() + ["updated_by" => Auth::user()->pk_account]);
      $message = "Data has been updated successfully.";
    } else {
      $item = Acknowledgment::create($request->validated() + ["created_by" => Auth::user()->pk_account]);
      $message = "Data has been created successfully.";
    }
    if (!$item) {
      return redirect()->back()->withInput()->with(['message' => "Something went wrong.", "messageType" => "danger"]);
    }

    return $this->back()->with(['message' => $message, "messageType" => "success"]);
  }

  public function delete($id)
  {
    if (Acknowledgment::where('pk_acknowledgments', $id)->delete()) {
      return $this->back()->with(['message' => "Data has been deleted successfully.", "messageType" => "success"]);
    }
    redirect()->back()->withInput()->with(['message' => "Something went wrong.", "messageType" => "danger"]);
  }

  public function back()
  {
    return redirect('/accountadmin/acknowledgments');
  }
}
