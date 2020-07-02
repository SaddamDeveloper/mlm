<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\AdminCommission;
use App\AdminTds;
use App\AdminWallet;
use App\AdminTdses;
class AdminDashboardController extends Controller
{
    public function index()
    {
        $total_members = DB::table('members')->count();
        $total_member_wallet_balance = DB::table('wallets')->sum('amount');

        $latest_members = DB::table('members')
            ->orderBy('id','desc')
            ->limit(10)
            ->get();

        $admin_wallet_bal = AdminWallet::value('amount');
        $admin_tds = AdminTdses::value('tds');
        return view('admin.dashboard', compact('total_members', 'total_member_wallet_balance', 'latest_members', 'admin_wallet_bal', 'admin_tds'));
    }

    // EPIN CONTROLL
    public function memEpinList(){
        return view('admin.epin');
    }

    public function memAddEpinForm(){
        return view('admin.add_epin_form');
    }

    public function memAddGenerateEpin(Request $request){
        $validatedData = $request->validate([
            'epin' => 'required',
        ]); 

       for ($i=0; $i < $request->input('epin'); $i++) { 
            $epin_insert = DB::table('epins')
                ->insertGetId([
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
    
            if($epin_insert){
                
                $epin = $this->randomNum($epin_insert);
                $epin_insert = DB::table('epins')
                    ->where('id', '=', $epin_insert)
                    ->update([
                        'epin' => $epin,
                    ]);
            }
       } 
        return redirect()->back()->with('message','Epin Generated Successfully');
    }

    public function ajaxGetEpinList()
    {    
        $query = DB::table('epins')
                ->leftjoin('members', 'epins.alloted_to', '=', 'members.id')
                // ->leftjoin('members', 'epin.used_by', '=', 'members.id')
                ->select('epins.*', 'members.full_name as alloted_to');
                // ->select('epin.*', 'members.name AS used_by');
                // return $query;
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('used_by', function($row){
                $used_by = DB::table('members')
                    ->select('epins.*', 'members.full_name as used_by')
                    ->join('epins','members.id', '=', 'epins.used_by')
                    ->where('members.id', $row->used_by)
                    ->first();
                if($used_by){
                    return $used_by->used_by;
                }
            })
            ->rawColumns(['used_by'])
            ->make(true);
    }

    function randomNum($epin_insert){
           // Available alpha caracters
           $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

           // generate a pin based on 2 * 7 digits + a random character
           $string = $characters[rand(0, strlen($characters) - 1)] . $characters[rand(0, strlen($characters)- 1)] ;

           $id_length = strlen((string)$epin_insert);
           $length = 6 - $id_length;
           $from_num = NULL;
           $to_num = NULL;
           $random_num = NULL;
           for ($i=0; $i < $length; $i++) { 
               $from_num .="1";
               $to_num .= "9";
           }
           if (!empty($from_num) && !empty($to_num)) {
               $random_num = rand($from_num, $to_num);
           }

           $epin = $string . $random_num . $epin_insert;
           return $epin;
    }

    // EPIN ALLOT
    public function memAllotEpinForm(){
        return view('admin.allot_epin_form');
    }

    public function searchMemberID(Request $request){
        if($request->ajax()){
            $member_id = $request->get('query');
            if (!empty($member_id)) {
                $member_data = DB::table('members')->where('sponsorID', $member_id)->first();
                if($member_data) {
                    $html = '
                    <label for="name">Name</label>
                    <input type="text" value="'.$member_data->full_name.'" class="form-control" readonly placeholder="Name">
                    <label for="gender">Mobile</label>
                    <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                    <label for="gender">DOB</label>
                    <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                    <label for="name">How many EPIN you will be alloted?</label>
                    <input type="text" class="form-control" name="epin"  placeholder="How many EPIN you will be alloted?"><br>
                    ';
                    echo $html;
                }
                else{
                    return 5;
                }
            }  
            else{
                return 1;
            }
        }
        else{
            return 9;
        }
    }

    public function memAllotEpin(Request $request){
        $validatedData = $request->validate([
            'epin' => 'required',
        ]);
        
        $epin_total = $request->input('epin');
        $member_id = $request->input('searchMember');
        $member_data_fetch = DB::table('members')->where('sponsorID', $member_id)->first();

        //Check used EPIN
        $epin_count = DB::table('epins')->whereNull('alloted_to')->where('status', 2)->count();
        if($epin_count < $epin_total){
            return redirect()->back()->with('error', ''.$epin_total.' EPIN is not available. Please generate more EPIN to allot.');
        }
        $epin_fetch = DB::table('epins')->whereNull('alloted_to')->where('status', 2)->limit($epin_total)->orderBy('id', 'ASC')->get();
        foreach ($epin_fetch as $epin) {
            $epin_alloted_to = DB::table('epins')
                ->where('id', $epin->id)
                ->update([
                    'alloted_to' => $member_data_fetch->id,
                    'alloted_date' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        }
        return redirect()->back()->with('message', ''.$epin_total.' EPIN is alloted successfully to '.$member_data_fetch->full_name.'');
    }

    public function epinRequestsLists()
    {
        return datatables()->of(EpinRequest::orderBy('created_at', 'DESC')->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            if($row->status == '1'){
                $action = '<a href="'.route('admin.epin_req_status', ['sId' => encrypt($row->id), 'status'=> encrypt(2)]).'" class="btn btn-success">Solve</a>';
            }else{
                $action = '<a href="#" class="btn btn-danger" disabled>Solved</a>';
            }
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function epinRequestStatus($aId, $statusId)
    {
        try {
            $id = decrypt($aId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $update = EpinRequest::where('id', $id)->update(array('status' => $sId));
        if($update){
            return redirect()->back()->with('message','Updated Successfully');
        }else {
            return redirect()->back()->with('error', 'Something Went Wrong Please Try Again');
        }
    }

    public function adminCommission()
    {
        $admin = AdminCommission::first();
        return view('admin.commission', compact('admin'));
    }

    public function storeCommission(Request $request)
    {
        $this->validate($request, [
            'commission'   => 'required|numeric'
        ]);

        $adminCommission = DB::table('admin_commissions')
            ->update([
                'commission' => $request->input('commission'),
            ]);

        return redirect()->back()->with('message','Inserted Successfully');
    }
    
    public function adminTds()
    {
        $tds = AdminTds::first();
        return view('admin.tds', compact('tds'));
    }

    public function storeTds(Request $request)
    {
        $this->validate($request, [
            'tds'   => 'required|numeric'
        ]);

        $adminTds = DB::table('admin_tds')
            ->update([
                'tds' => $request->input('tds'),
            ]);

        return redirect()->back()->with('message','Inserted Successfully');
    }
}
