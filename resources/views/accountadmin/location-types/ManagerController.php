<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use App\Mail\ChnagePassword;
use App\Manager;
use App\TechAdmin;
use App\Business;
use DB;
use Session;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function index(Request $request) { 
      $managers = Manager::orderBy('id','desc')->get();
      //echo "<pre>";print_r($managers->toArray());die;
      return view('admin.managers.managers',compact('managers'));
    }

    public function add(){
      return view('admin.managers.add');
    }

    public function storeManager(Request $request){
      //print_r($request->toArray());die;
      $managerId =  $this->generateManagerId(strtoupper(substr($request->first_name.' '.$request->last_name,0,7)));
   //   $password= rand(100000, 999999);
      $password = $request->password;
      $manager = Manager::create([
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'manager_no' => $managerId,
               'email' =>$request->email,
               'mobile' => $request->mobile,
               'password'=>bcrypt($password),
               'gender' => $request->gender,
                'dob' => date('Y-m-d',strtotime($request->dob)),
               'address' => $request->address,
               'remarks' => $request->remarks,
               'verified_status' => (!empty($request->verified_status))?1:0,
               ]);
      $data = array('name'=>$request->first_name.' '.$request->last_name,'password'=>$password,'type'=>0,'email'=>$request->email);
     // $data = array('name'=>$request->first_name.' '.$request->last_name,'password'=>$unq_no);
      Mail::to($request->email)->send(new WelcomeMail($data));
      Session::flash('success_msg', $managerId);
      return redirect()->back();
    }

    public function checkEmail(Request $request){
      $checkemail = Manager::where('email',trim($request->email))->first();
      if($checkemail){
        return 1 ;
      }else{
        return 0;
      }
    }

    public function chnageStatus(Request $request){

     $update = Manager::where('id',$request->id)->update(['status'=>($request->status==1)?0:1]);
     if($update) {
     Session()->flash('success', 'Status Successfully changed !');
     return redirect()->back();
     } else {
      Session()->flash('warning', 'Status not changed !');
     return redirect()->back();
  
     }
    }

    public function details($id){
      $manager = Manager::where('id',$id)->first();
      $techadmins = TechAdmin::where('manager_id',$id)->orderBy('id','DESC')->get();
      $total_approved = Business::where(['approved_id'=>$id,'approved_by'=>2,'status'=>2])->count();
      $total_today_approved = Business::where(['approved_id'=>$id,'approved_by'=>2,'status'=>2])->whereDate('approved_at', Carbon::today())->count();
      $total_week_approved = Business::where(['approved_id'=>$id,'approved_by'=>2,'status'=>2])->whereBetween('approved_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
      return view('admin.managers.details',compact('manager','techadmins','total_approved','total_today_approved','total_week_approved'));
    }

    public function changePassword($id){
      return view('admin.managers.change-password',compact('id'));
    }

    public function updatePassword(Request $request){
     // $manager = Manager::where('id',$request->id)->first();
      if($request->password!=$request->confirm_password){
              Session()->flash('warning', 'Password must be equal to confim password!');
              return redirect()->back();
           }
             
            //update query
            $userId = $request->id;

            $user = Manager::find($userId);

            $user->password = Hash::make($request->password);
            $user->save();
            //print_r($user);die;
            //redirect
            $data = array('name'=>$user->first_name.' '.$user->last_name,'password'=>$request->password,'type'=>0,'email'=>$user->email);
            Mail::to($user->email)->send(new ChnagePassword($data));
            Session()->flash('success', 'Password successfully Changes!');
            return redirect()->back();
    }

    public function edit($id){
      $manager = Manager::where('id',$id)->first();
      return view('admin.managers.edit',compact('manager'));
    }

    public function updateManager(Request $request){
      //echo "<pre>";print_r($request->toArray());die;
       $manager = Manager::where('id',$request->id)->update([
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' =>$request->email,
               'mobile' => $request->mobile,
               'gender' => $request->gender,
               'dob' => date('Y-m-d',strtotime($request->dob)),
               'address' => $request->address,
               'remarks' => $request->remarks,
               'verified_status' => (!empty($request->verified_status))?1:0,
               ]);
      Session::flash('success','updated successfully.');
      return redirect()->back();
    }

 //get reports
  public function getReports(Request $request){
    $type = $request->type;
    $manager_id = $request->manager_id;
    if($type==2){
     $total = Business::where(['updated_by'=>$manager_id,'updated_type'=>2])->count();
     $total_today = Business::where(['updated_by'=>$manager_id,'updated_type'=>2])->whereDate('submitted_at', Carbon::today())->count();
     $total_week = Business::where(['updated_by'=>$manager_id,'updated_type'=>2])->whereBetween('submitted_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
     $return_type = "Updated";
    }elseif ($type==1) {
    $total = Business::where(['rejected_id'=>$manager_id,'rejected_by'=>2,'status'=>4])->count();
    $total_today = Business::where(['rejected_id'=>$manager_id,'rejected_by'=>2,'status'=>4])->whereDate('rejected_at', Carbon::today())->count();
    $total_week = Business::where(['rejected_id'=>$manager_id,'rejected_by'=>2,'status'=>4])->whereBetween('rejected_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $return_type = "Rejected";
    }else{
      $total = Business::where(['approved_id'=>$manager_id,'approved_by'=>2,'status'=>2])->count();
      $total_today = Business::where(['approved_id'=>$manager_id,'approved_by'=>2,'status'=>2])->whereDate('approved_at', Carbon::today())->count();
      $total_week = Business::where(['approved_id'=>$manager_id,'approved_by'=>2,'status'=>2])->whereBetween('approved_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
      $return_type = "Approved";
    }
    $json_arr = ['total'=>$total,'total_today'=>$total_today,'total_week'=>$total_week,'type'=>$return_type];
    return json_encode($json_arr);
  }  
  public function generateManagerId($name){
    $chars = "0123456789";
    $res = "";
    for ($i = 0; $i < 2; $i++) {
        $res .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    $chars1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $res1 = "";
    for ($j = 0; $j < 2; $j++) {
        $res1 .= $chars1[mt_rand(0, strlen($chars1)-1)];
    }
    $str = $name.$res.$res1;
    $return_str = str_replace(' ', '', $str);
    return $return_str;
}

   

    public function deleteManager(Request $request) {
     $delete = Manager::where('id',$request->id)->delete();
    if($delete) {
     Session()->flash('success', 'Successfully deleted !');
     return redirect()->back();
     } else {
      Session()->flash('warning', 'Not deleted !');
     return redirect()->back();
  
     }
  }
 

}
