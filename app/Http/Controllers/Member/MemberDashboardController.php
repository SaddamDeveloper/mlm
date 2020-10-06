<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Member;
use App\Tree;
use App\CommissionHistory;
use App\Wallet;
use Hash;
use Auth;
use Carbon\Carbon;
use Session;
use App\Rewards;
use App\AdminWalletHistory;
use App\AdminTdsesHistory;
use App\ManualLock;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Fund;
use App\TotalFund;
use App\FundHistory;
use Intervention\Image\Facades\Image;
use File;
use App\FundRequest;
use App\ImportantNotice;
use App\PaymentRequest;
class MemberDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member')->except(['addNewMember', 'searchSponsorID', 'loginIDCheck']);
    }
    public function index()
    {
        $user_info = Auth::guard('member')->user();
        $direct_member = Tree::where('registered_by', $user_info->id)->count();
        $tree = Tree::where('user_id', $user_info->id)->first();
        $total_left = $tree->total_left_count;
        $total_right = $tree->total_right_count;
        $left_active = $tree->total_activate_left;
        $right_active = $tree->total_activate_right;
        $pair_matching = $tree->activate_pair;
        $notice = ImportantNotice::where('status', 1)->orderBy('created_at', 'DESC')->limit(10)->get();
        $total_income = CommissionHistory::where('user_id', $user_info->id)->sum('amount');
        $available_fund = TotalFund::where('user_id', $user_info->id)->first();
        return view('member.dashboard', compact('user_info', 'direct_member', 'total_left', 'total_right', 'left_active', 'right_active', 'pair_matching', 'notice', 'total_income', 'available_fund'));
    }

    public function addNewMemberForm()
    {
        return view('member.registration.member_registration_form');
    }

    public function addNewMember(Request $request)
    {
        $this->validate($request, [
            'search_sponsor_id'     => 'required',
            'f_name'                => 'required',
            'l_name'                => 'required',
            'leg'                   => 'required',
            // 'mobile'                => 'required|numeric|min:10',
            // 'email'                 => 'unique:members|required|email',
            // 'dob'                   => 'required',
            // 'pan'                   => 'unique:members|required',
            // 'aadhar'                => 'unique:members|required',
            // 'bank'                  => 'required',
            // 'ifsc'                  => 'required',
            // 'confirm_ifsc'          => 'required|same:ifsc',
            // 'account_no'            => 'required',
            // 'confirm_account'       => 'required|same:account_no',
            // 'confirm_ifsc'          => 'required|same:ifsc',
            'login_id'              => 'required|unique:members',
            'password'              => 'required|confirmed|min:6'
        ]);
        $sponsor_member_data = Member::where('login_id', $request->input('search_sponsor_id'))->first();
        if(empty($sponsor_member_data)){
            return redirect()->back();
        }
        $sponsorID          = $sponsor_member_data->sponsorID;
        $leg                = $request->input('leg');
        $f_name             = $request->input('f_name');
        $m_name             = $request->input('m_name');
        $l_name             = $request->input('l_name');
        $fullName           = $f_name . " " . $m_name ." ". $l_name;
        $email              = $request->input('email');
        $mobile             = $request->input('mobile');
        $dob                = $request->input('dob');
        $pan                = $request->input('pan');
        $aadhar             = $request->input('aadhar');
        $address            = $request->input('address');
        // Bank
        $bank               = $request->input('bank');
        $ifsc               = $request->input('ifsc');
        $account_no         = $request->input('account_no');
        // Credentials
        $login_id           = $request->get('login_id');
        $password           = $request->get('password');
        $sleep = 0;
        $member_data = Member::where('sponsorID', $sponsorID)->lockForUpdate()->first();
        if(!empty($leg)){
            try {
                for ($i=0; $i <2; $i++){
                    $chk_lock = ManualLock::where('id', 1)->lockForUpdate()->first();
                    if ($chk_lock->joining == 1) {
                        $i = 2;
                        $chk_lock->joining = 2;
                        $chk_lock->save();
                        $member_data = Member::where('sponsorID', $sponsorID)->lockForUpdate()->first();
                        if($member_data){
                            $tree_data = Tree::where('user_id', $member_data->id)->lockForUpdate()->first();
                            if($tree_data){
                                if($leg == 1){
                                    $a = $this->memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password);
                                    if ($a) {
                                        $token = rand(111111,999999);
                                        $chk_lock = ManualLock::find(1);
                                        $chk_lock->joining = 1;
                                        $chk_lock->save();
                                            return redirect()->route('member.thank_you',['token'=>encrypt($token)]);
                                    } else {
                                        $chk_lock = ManualLock::find(1);
                                        $chk_lock->joining = 1;
                                        $chk_lock->save();
                                        return redirect()->back()->with("error", "Please try again after sometime!");
                                    }
                                    
                                }else if($leg == 2){
                                    $b = $this->memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password);
                                    if ($b) {
                                        $token = rand(111111,999999);
                                        $chk_lock = ManualLock::find(1);
                                        $chk_lock->joining = 1;
                                        $chk_lock->save();
                                        return redirect()->route('member.thank_you',['token'=>encrypt($token)]);
                                    } else {
                                        $chk_lock = ManualLock::find(1);
                                        $chk_lock->joining = 1;
                                        $chk_lock->save();
                                        return redirect()->back()->with("error", "Please try again after sometime!");
                                    }
                                }
                            }else{
                                $chk_lock = ManualLock::find(1);
                                $chk_lock->joining = 1;
                                $chk_lock->save();
                                return back()->with('error', 'Inavlid SponsorID!');
                            }
                        }else{
                            $chk_lock = ManualLock::find(1);
                            $chk_lock->joining = 1;
                            $chk_lock->save();
                            return back()->with('error', 'SponsorID is invalid');
                        }
                    }else {
                        $sleep++;
                        sleep(1);
                    }
                }
            } catch (\Exception $e) {
                $chk_lock = ManualLock::find(1);
                $chk_lock->joining = 1;
                $chk_lock->save();
                return back()->with('error', 'Please Try After Sometime');
            }
            
            if ($sleep == 2) {
                $chk_lock = ManualLock::find(1);
                $chk_lock->joining = 1;
                $chk_lock->save();
                return back()->with('error', 'Please Try After Sometime');
            }
           
        }else{
            return back()->with('error', 'Select Leg!');
        }
    }

    public function searchSponsorID(Request $request){
        if($request->ajax()){
            $sponsorID = $request->get('query');
            if(!empty($sponsorID)) {
                $member_data = Member::where('login_id', $sponsorID)->first();
                if($member_data) {
                    $tree_data = Tree::where('user_id', $member_data->id)->first();
                    if($tree_data){
                            $html = '
                            <label for="gender"> Name</label>
                            <input type="text" value="'.$member_data->full_name.'" class="form-control" readonly placeholder="Name">
                            <label for="gender">Mobile</label>
                            <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                            <label for="gender">DOB</label>
                            <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>';
                            echo $html;
                        }else{
                        return 1;
                    }

                }else{
                    return 1;
                }
            }else {
                return 1;
            }
        }else{
            return 9;
        }
    }

    public function loginIDCheck(Request $request)
    {
        if($request->ajax()){
            $login_id = $request->get('query');
            if(!empty($login_id)) {
                $member_data = DB::table('members')->where('login_id', $login_id)->count();
                if($member_data > 0){
                    echo 1;
                }else{
                    echo 2;
                }
            }
        }
    }

    function memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password){
        try {
            DB::transaction(function () use($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password) {
                DB::raw('SET GLOBAL TRANSACTION ISOLATION LEVEL READ COMMITTED');
                $member_registration = new Member;
                $member_registration->login_id = $login_id;
                $member_registration->password = Hash::make($password);
                $member_registration->full_name = $fullName;
                $member_registration->dob = $dob;
                $member_registration->email = $email;
                $member_registration->mobile = $mobile;
                $member_registration->pan = $pan;
                $member_registration->aadhar = $aadhar;
                $member_registration->address = $address;
                $member_registration->bank_name = $bank;
                $member_registration->ac_holder_name = $fullName;
                $member_registration->ifsc = $ifsc;
                $member_registration->account_no = $account_no;
                $member_registration->save();
                $member_insert = $member_registration->id;
                $generatedID = $this->memberIDGeneration($fullName, $member_insert);
                $member_update = DB::table('members')
                ->where('id', $member_insert)
                ->update([
                    'sponsorID' =>  $generatedID,
                ]);
                $this->sendSms($fullName, $mobile, $login_id, $password);
                $sponsor = Member::where('sponsorID', $sponsorID)->lockForUpdate()->first();
                //Fetch Tree Data Using User ID
                $sponsor_tree = DB::table('trees')
                    ->where('user_id', $sponsor->id)
                    ->lockForUpdate()->first();
                
                $registerdBY = Auth::guard('member')->user()->id;
                $tree_insert = null;      
                // Checking Direct Referral
                if($leg == 1){
                    // Direct Referaal
                    if (empty($sponsor_tree->left_id)) {

                        $lag = "L";
                        $insert_id = DB::select("call directJoin(?,?,?,?)",array($sponsor_tree->id,$lag, $member_insert, $registerdBY));
                        $tree_insert = $insert_id[0]->InsertedIds;
                        $status = $insert_id[0]->sts;
                        if($status == FALSE){
                            $tree_insert = $this->extremeLeg($leg, $member_insert, $sponsor_tree->id, $registerdBY);
                        }
                        // $tree_insert = DB::table('trees')
                        // ->insertGetId([
                        //     'user_id' => $member_insert,
                        //     'parent_id' => $sponsor_tree->id,
                        //     'parent_leg' => 'L',
                        //     'registered_by' => Auth::guard('member')->user()->id,
                        //     'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                        // ]);

                        // $sponsor_tree_update = Tree::where('id', $sponsor_tree->id)->lockForUpdate()->first();
                        // $sponsor_tree_update->left_id = $tree_insert;
                        // $sponsor_tree_update->save();
                        
                    }else{
                        //Go to Extreme Left
                        $tree_insert = $this->extremeLeg($leg, $member_insert, $sponsor_tree->id, $registerdBY);
                    }
                }else if($leg == 2){
                    if (empty($sponsor_tree->right_id)) {
                        // Direct Referaal
                        $lag = "R";
                        $insert_id = DB::select("call directJoin(?,?,?,?)",array($sponsor_tree->id,$lag, $member_insert, $registerdBY));
                        $tree_insert = $insert_id[0]->InsertedIds;
                        $status = $insert_id[0]->sts;
                        if($status == FALSE){
                            $tree_insert = $this->extremeLeg($leg, $member_insert, $sponsor_tree->id, $registerdBY);
                        }
                        // $tree_insert = DB::table('trees')
                        // ->insertGetId([
                        //     'user_id' => $member_insert,
                        //     'parent_id' => $sponsor_tree->id,
                        //     'registered_by' => Auth::guard('member')->user()->id,
                        //     'parent_leg' => 'R',
                        //     'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                        // ]);
                        // $sponsor_tree_update = Tree::where('id', $sponsor_tree->id)->lockForUpdate()->first();
                        // $sponsor_tree_update->left_id = $tree_insert;
                        // $sponsor_tree_update->save();
                        
                    }else{
                        //Go to Extreme Right
                        $tree_insert = $this->extremeLeg($leg, $member_insert, $sponsor_tree->id, $registerdBY);
                    }
                }

                //Insert Data in the Wallet for the first Time
                $wallet_insert = DB::table('wallets')
                    ->insertGetId([
                        'user_id' => $member_insert,
                        'amount' => 0,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);

                // Fetch All Parent of Current Registered node
                $parrents = DB::select( DB::raw("SELECT * FROM (
                    SELECT @pv:=(
                        SELECT parent_id FROM trees WHERE id = @pv
                        ) AS lv FROM trees
                        JOIN
                        (SELECT @pv:=:start_node) tmp
                    ) a
                    WHERE lv IS NOT NULL AND lv != 0 LIMIT 1000 FOR UPDATE")
                    , array(
                      'start_node' => $tree_insert,
                    )
                    );
                    $this->treePair($parrents, $member_insert);
                    
                });
            return true;
            
        }catch (\Exception $e) {
           return false;
        }
    }
    public function extremeLeg($leg, $member_insert, $sponsor_tree_ID, $registerdBY){
        if($leg == 1){
            //    Left
                $leg = 'L';
            
                $insert_id =DB::select("call TreeInsertAndUpdate(?,?,?,?)",array($member_insert,$sponsor_tree_ID,$leg,$registerdBY));
                $id = $insert_id[0]->InsertedIds;
                // $left_iteration = DB::select( DB::raw("SELECT * FROM (
                //     SELECT @pv:=(
                //         SELECT left_id FROM trees WHERE id = @pv
                //         ) AS tv FROM trees
                //         JOIN
                //         (SELECT @pv:=:start_node) tmp
                //     ) a
                //     WHERE tv IS NOT NULL AND tv != 0 LIMIT 1000 FOR UPDATE") 
                //     , array(
                //     'start_node' => $sponsor_tree_ID,
                //     )
                // );
                // $expected = [];
                // foreach($left_iteration as $k=>$v){
                //     $expected[$k]=end($v);
                // }
                // $extreme_left = end($expected);
                // $tree_insert = DB::table('trees')
                // ->insertGetId([
                //     'user_id' => $member_insert,
                //     'parent_id' => $extreme_left,
                //     'parent_leg' => 'L',
                //     'registered_by' => $registerdBY,
                //     'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                // ]);

                // $tree_update = Tree::where('user_id', $extreme_left)->lockForUpdate()->first();
                // $tree_update->left_id = $tree_insert;
                // $tree_update->updated_at = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();
                // $tree_update->save();
                
                return $id;

        }else if($leg == 2){
            // Right
            $inserted_ids = null;
            $leg = 'R';
            $insert_id = DB::select('call TreeInsertAndUpdate(?,?,?,?)',array($member_insert,$sponsor_tree_ID,$leg,$registerdBY));
            $id = $insert_id[0]->InsertedIds;
                // $right_iteration = DB::select( DB::raw("SELECT * FROM (
                //         SELECT @pv:=(
                //             SELECT right_id FROM trees WHERE id = @pv
                //             ) AS tv FROM trees
                //             JOIN
                //             (SELECT @pv:=:start_node) tmp
                //         ) a
                //         WHERE tv IS NOT NULL AND tv != 0 LIMIT 1000 FOR UPDATE")
                //         , array(
                //         'start_node' => $sponsor_tree_ID
                //         )
                //         );

                // $expected = [];
                // foreach($right_iteration as $k=>$v){
                //     $expected[$k]=end($v);
                // }
                // $extreme_right = end($expected);
                // $tree_insert = DB::table('trees')
                // ->insertGetId([
                //     'user_id' => $member_insert,
                //     'parent_id' => $extreme_right,
                //     'parent_leg' => 'R',
                //     'registered_by' => $registerdBY,
                //     'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                // ]);

                // $tree_update = Tree::where('user_id', $extreme_right)->lockForUpdate()->first();
                // $tree_update->right_id = $tree_insert;
                // $tree_update->updated_at = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();
                // $tree_update->save();

                return $id;
        }
    }
    public function thankYou($token){
        try {
            $token = decrypt($token);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        if($token){
            $success = 'Registration Successfull';
            return view('member.registration.finish_page', compact('success'));
        }
    }

    function memberIDGeneration($fullName, $id){
        $splitName = explode(' ', trim($fullName), 3); 
        $first_name = trim($splitName[0]);
        $last_name = trim($splitName[2]);

        $title_id = $first_name[0].$last_name[0];
        $l_id = 6 - strlen((string)$id);
        $generatedID = $title_id ;
        for ($i=0; $i < $l_id; $i++) { 
            $generatedID .= "0";
        }
        $generatedID .= $id;
        return $generatedID;
    }

    function treePair($parents, $member_insert){
        $child = $member_insert;
        for($i=0; $i < count($parents) ; $i++) {
            $parent = $parents[$i]->lv; 
            //**************Fetch parrent details***************************
            $fetch_parent = DB::table('trees')
                ->where('id',$parent)
                ->first();
            //***************check child node is in left or right*******************
            if ($fetch_parent->left_id == $child){
                //Check Left count already had previous value + 1
                $update_left_count = DB::table('trees')
                ->where('id', $parent)
                ->update([
                    'left_count' => DB::raw("`left_count`+".(1)),
                    'total_left_count' => DB::raw("`total_left_count`+".(1)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
            }else{
                //Check Right count already had previous value
                $update_right_count = DB::table('trees')
                ->where('id', $parent)
                ->update([
                    'right_count' => DB::raw("`right_count`+".(1)),
                    'total_right_count' => DB::raw("`total_right_count`+".(1)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
            }   
            
            //Fetch Pair Match
            $pair_match = DB::table('trees')
                ->select('left_count', 'right_count', 'status')
                ->where('id',$parent)->lockForUpdate()
                ->first();
            // Check member is activated or not
            if($pair_match->status == 1){
                //Check 1:1 Check
                if($pair_match->right_count > 0 && $pair_match->left_count  > 0){
                    // $this->creditCommisionOneIsToOne($parent,1, 1);
                    $total_pair_update = DB::table('trees')
                    ->where('id', $parent)
                    ->update([
                        'total_pair' => DB::raw("`total_pair`+".(1)),
                    ]);
                     //Pair checking
                    $total_pair_count =  DB::table('trees')
                    ->select('total_pair')
                    ->where('id',$parent)
                    ->first();
                    // $this->rewardsChecking($total_pair_count, $parent);
                }
            }
            $child = $parent;
        }
    }

    function creditCommisionOneIsToOne($parent,$left, $right){
                //Insert Comission Data
                $update_left_right_count = DB::table('trees')
                ->where('id', $parent)
                ->update([
                    'left_count' => DB::raw("`left_count`-".($left)),
                    'right_count' => DB::raw("`right_count`-".($right)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
                //Fetch User with Node ID
                $fetch_tree = DB::table('trees')
                ->where('id',$parent)->lockForUpdate()
                ->first();        
                
                // Member Commission Logic
                // Admin Commission Fetch
                $adminCommissionFetch = DB::table('admin_commissions')->first();
                $adminCommission = (200 * $adminCommissionFetch->commission)/100;
                $earning2 = 200 - $adminCommission;
                

                // Admin Wallet Insert
                $admin_wallet_insert = DB::table('admin_wallets') 
                    ->where('role', '1')
                    ->update([
                        'amount' => DB::raw("`amount`+".($adminCommission)),
                    ]);

                // Fetch Admin Wallet 
                $fetch_admin_wallet =  DB::table('admin_wallets')->first();
                //Admin Wallet History
                $admin_wallet_history_insert = new AdminWalletHistory;
                $admin_wallet_history_insert->transaction_type = '1';
                $admin_wallet_history_insert->amount = $adminCommission;
                $admin_wallet_history_insert->total_amount = $fetch_admin_wallet->amount;
                $admin_wallet_history_insert->comment = $adminCommission.' income is generated! ';
                $admin_wallet_history_insert->save();

                // TDS Commission Fetch
                $tdsCommissionFetch = DB::table('admin_tds')->first();
                $tdsCommission = (200 * $tdsCommissionFetch->tds)/100;
                $earning = $earning2 - $tdsCommission;
                // Admin TDS Insert
                $admin_tds_insert = DB::table('admin_tdses') 
                ->where('role', '1')
                ->update([
                    'tds' => DB::raw("`tds`+".($tdsCommission)),
                ]);
                // Admin TDS History
                // Fetch Admin Wallet 
                $fetch_admin_tdes =  DB::table('admin_tdses')->first();
                //Admin Wallet History
                $admin_tdses_history_insert = new AdminTdsesHistory;
                $admin_tdses_history_insert->transaction_type = '1';
                $admin_tdses_history_insert->amount = $tdsCommission;
                $admin_tdses_history_insert->total_amount = $fetch_admin_tdes->tds;
                $admin_tdses_history_insert->comment = $tdsCommission.' income is generated! ';
                $admin_tdses_history_insert->save();

                // Wallet Insert
                $wallet_insert = DB::table('wallets') 
                    ->where('user_id', $fetch_tree->user_id)
                    ->update([
                        'amount' => DB::raw("`amount`+".($earning)),
                    ]);

                //Fetch Wallet
                $fetch_wallet = DB::table('wallets')->where('user_id', $fetch_tree->user_id)->first();
                
                $credit_commision = DB::table('commission_histories')
                    ->insertGetId([
                        'user_id' => $fetch_tree->user_id,
                        'pair_number' => ($fetch_tree->total_pair+1),
                        'amount' => $earning,
                        'comment' => $earning.' income of pair number '.($fetch_tree->total_pair+1).' is generated! ',
                        'status' => 1,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                        ]);

                $credit_commision_to_wallet = DB::table('wallet_histories')
                    ->insertGetId([
                        'wallet_id' =>  $fetch_wallet->id,
                        'user_id'   => $fetch_tree->user_id,
                        'transaction_type'  =>  1,
                        'amount' => $earning,
                        'total_amount'  => $fetch_wallet->amount,
                        'comment'   => $earning.' income of pair number'.($fetch_tree->total_pair+1).' is generated! ',
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                    ]);
    }

    public function memberDownlineListForm(){
        return view('member.downline');
    }
    
    public function memberGetDownlineList(){

        return datatables()->of(DB::select(DB::raw("SELECT * FROM (SELECT * FROM trees
            ORDER BY user_id) items_sorted,
           (SELECT @iv := :user_id) initialisation
           WHERE find_in_set(parent_id, @iv)
           AND length(@iv := concat(@iv, ',', id))"),
            array(
                'user_id' => Auth::guard('member')->user()->id,
                )))
            ->addIndexColumn()
            ->addColumn('sponsorID', function($row){
                $user_id = $row->user_id;
                if(!empty($user_id)){
                    $member_id =  DB::table('trees')
                        ->select('members.login_id as login_id')
                        ->join('members', 'members.id', '=', 'trees.user_id')
                        ->where('trees.user_id', $row->user_id)
                        ->value('members.login_id');
                }
                return $member_id;
            })
            ->addColumn('parent', function($row){
                $parents = $row->parent_id;
                if (!empty($parents)) {
                    $parent_details =  DB::table('trees')
                    ->select('members.full_name as u_name','members.id as u_id', 'members.login_id as login_id')
                    ->join('members','members.id','=','trees.user_id')
                    ->where('trees.id',$row->parent_id)
                    ->first();
                   $parent = $parent_details->login_id;
                   if ($row->user_id == $parent_details->u_id) {
                        $parent .=" (Self)";
                    }else{
                        $parent .=" (".$parent_details->u_name.")";
                   }
                   return $parent;
                }
            })
            ->addColumn('member_name', function($row){
                $member_name = null;
                if (!empty($row->user_id)) {
                    $member_details =  DB::table('members')
                    ->select('full_name','id')
                    ->where('id',$row->user_id)
                   ->first();
                   $member_name =$member_details->full_name;
                }
                return $member_name;
            })
            ->addColumn('left_member', function($row){
                $lft_members = $row->left_id;
                if (!empty($lft_members)) {
                    $lft_details =  DB::table('trees')
                   ->select('members.full_name as u_name','members.id as u_id', 'members.login_id as login_id')
                   ->join('members','members.id','=','trees.user_id')
                   ->where('trees.id',$lft_members)
                   ->first();
                    $lft_member = $lft_details->login_id;
                   if ($row->user_id == $lft_details->u_id) {
                        $lft_member.=" (Self)";
                   }else{
                        $lft_member.=" (".$lft_details->u_name.")";
                   }
                   return $lft_member;
                }
            })
            ->addColumn('right_member', function($row){
                $rht_members = $row->right_id;
               
                if (!empty($rht_members)) {
                    $rht_details =  DB::table('trees')
                    ->select('members.full_name as u_name','members.id as u_id', 'members.login_id as login_id')
                   ->join('members','members.id','=','trees.user_id')
                   ->where('trees.id',$rht_members)
                   ->first();
                    $rht_member = $rht_details->login_id;
                   if ($row->user_id == $rht_details->u_id) {
                        $rht_member.=" (Self)";
                    }else{
                        $rht_member.=" (".$rht_details->u_name.")";
                   }
                    return $rht_member;
                }
            })
            ->addColumn('add_by', function($row){
                $add_by = $row->registered_by;
                if (!empty($add_by)) {
                    if (substr($add_by, -1) == "A") {
                    $add_by = "ADMIN";
                }elseif($row->user_id == $add_by){
                    $add_by = "SELF";
                  }else{
                      $user_details =  DB::table('members')
                        ->select('full_name','id', 'login_id')
                        ->where('id',$add_by)
                        ->first();
                        $add_by = $user_details->login_id;
                        $add_by.= "(".$user_details->full_name.")";
                    }
                }
                return $add_by;
            })
            ->addColumn('created_at', function($row){
                $created_at = Carbon::parse($row->created_at)->toDayDateTimeString();
                return $created_at;
            })
            ->rawColumns(['sponsorID','parent','member_name','left_member','right_member','add_by','created_at'])
            ->make(true);
    }

    public function memberTree($rank=null, $user_id=null){
        
        if (!empty($user_id)) {
            try{
                $user_id = decrypt($user_id);
            }catch(DecryptException $e) {
                abort(404);
            }
        }else{
            $user_id = Auth::guard('member')->user()->id;
        }
        if (empty($rank)) {
            $rank = 0;
        }

        $html=null;

        $root = Tree::where('user_id', $user_id)->first();
        // dd($root->member->package->adminPackage->package);
        $html .= '
        <div class="row">
        <div class="col-md-4">
        <table class="table">
            <tr>
                <th>Left Distributor</th>
                <th>Right Distributor</th>
            </tr>
            <tr>
                <td>'.$root->total_left_count.'</td>
                <td>'.$root->total_right_count.'</td>
            </tr>
        </table>
        </div>
        </div>
        ';
        if($root){
            $level_checking = $this->levelCheck($user_id);
            $html .= '<ul>
            <li>        
                <a href="#"><img src="'.asset($root->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$root->member->full_name.'<br> ('.$level_checking.')
                    <div class="info">
                        <h5>Name : '.$root->member->full_name.'</h5>
                        <h5>Sponsor ID : '.$root->member->login_id.'</h5>
                        <h5>Level : '.$level_checking.'</h5>
                    </div>
                </a>';
            $rank++;
            $first_level = Tree::where('parent_id',$root->id)->orderBy('parent_leg', 'ASC')->get();
         
            if ($first_level) {
                $html.="<ul>";
                if(empty($root->left_id)){
                    $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                }
                foreach ($first_level as $key => $first) {
                    $html.="<li>";
                    if ($root->left_id == $first->id) {
                        if(!empty($first->id)){
                            $level_checking = $this->levelCheck($first->user_id);
                            $first_level_node = Tree::where('user_id', $first->user_id)->first();
                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'"><img src="'.asset($first_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$first_level_node->member->full_name.'<br> ('.$level_checking.')
                                <div class="info">
                                    <h5>Name : '.$first_level_node->member->full_name.'</h5>
                                    <h5>Sponsor ID : '.$first_level_node->member->login_id.'</h5>
                                    <h5>Level : '.$level_checking.'</h5>
                                </div>  
                            </a>';
                        }
                    } else if($root->right_id == $first->id){
                        if(!empty($first->id)){
                            $level_checking = $this->levelCheck($first->user_id);
                            $first_level_node = Tree::where('user_id', $first->user_id)->first();
                            $html.='<a href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'"><img src="'.asset($first_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$first_level_node->member->full_name.'<br> ('.$level_checking.')
                                <div class="info">
                                    <h5>Name : '.$first_level_node->member->full_name.'</h5>
                                    <h5>Sponsor ID : '.$first_level_node->member->login_id.'</h5>
                                    <h5>Level : '.$level_checking.'</h5>
                                </div>  
                            </a>';
                        }
                    }

                    $second_level = Tree::where('parent_id',$first->id)->orderBy('parent_leg', 'ASC')->get();

                    if ($second_level) {
                        $html.="<ul>";
                        if(empty($first->left_id)){
                            $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                        }
                        foreach ($second_level as $key => $second) {
                            $html.="<li>";
                            if ($first->left_id == $second->id) {
                                if(!empty($second->id)){
                                    $level_checking = $this->levelCheck($second->user_id);
                                    $second_level_node = Tree::where('user_id', $second->user_id)->first();
                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'"><img src="'.asset($second_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$second_level_node->member->full_name.'<br> ('.$level_checking.')
                                                <div class="info">
                                                    <h5>Name : '.$second_level_node->member->full_name.'</h5>
                                                    <h5>Sponsor ID : '.$second_level_node->member->login_id.'</h5>
                                                    <h5>Level : '.$level_checking.'</h5>
                                                </div>  
                                            </a>';
                                }
                            } else if($first->right_id == $second->id){
                                if(!empty($second->id)){
                                    $level_checking = $this->levelCheck($second->user_id);
                                    $second_level_node =Tree::where('user_id', $second->user_id)->first();
                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'"><img src="'.asset($second_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$second_level_node->member->full_name.'<br> ('.$level_checking.')
                                        <div class="info">
                                            <h5>Name : '.$second_level_node->member->full_name.'</h5>
                                            <h5>Sponsor ID : '.$second_level_node->member->login_id.'</h5>
                                            <h5>Level : '.$level_checking.'</h5>
                                        </div>  
                                    </a>';
                                }
                            }

                            //THIRD LEVEL STARTS
                            $third_level = Tree::where('parent_id',$second->id)->orderBy('parent_leg', 'ASC')->get();
                            
                            if ($third_level) {
                                $html.="<ul>";
                                if(empty($second->left_id)){
                                    $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                                }
                                foreach ($third_level as $key => $third) {
                                    $html.="<li>";
                                    if ($second->left_id == $third->id) {
                                        if(!empty($third->id)){
                                            $level_checking = $this->levelCheck($third->user_id);
                                            $third_level_node = Tree::where('user_id', $third->user_id)->first();
                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'"><img src="'.asset($third_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$third_level_node->member->full_name.'<br> ('.$level_checking.')
                                                <div class="info">
                                                    <h5>Name : '.$third_level_node->member->full_name.'</h5>
                                                    <h5>Sponsor ID : '.$third_level_node->member->login_id.'</h5>
                                                    <h5>Level : '.$level_checking.'</h5>
                                                </div>  
                                            </a>';
                                        }
                                    } else if($second->right_id == $third->id){
                                        if(!empty($third->id)){
                                            $level_checking = $this->levelCheck($third->user_id);
                                            $third_level_node = Tree::where('user_id', $third->user_id)->first();
                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'"><img src="'.asset($third_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$third_level_node->member->full_name.'<br> ('.$level_checking.')
                                                <div class="info">
                                                    <h5>Name : '.$third_level_node->member->full_name.'</h5>
                                                    <h5>Sponsor ID : '.$third_level_node->member->login_id.'</h5>
                                                    <h5>Level : '.$level_checking.'</h5>
                                                </div>  
                                            </a>';
                                        }
                                    }
                                    //FOURTH LEVEL STARTS
                                    $fourth_level = Tree::where('parent_id',$third->id)->orderBy('parent_leg', 'ASC')->get();
                                    if ($fourth_level) {
                                        $html.="<ul>";
                                        if(empty($third->left_id)){
                                            $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                                        }
                                        $count = 1;
                                        foreach ($fourth_level as $key => $fourth) {
                                            $html.="<li>";
                                            if ($third->left_id == $fourth->id) {
                                                if(!empty($fourth->id)){
                                                    $level_checking = $this->levelCheck($fourth->user_id);
                                                    $fourth_level_node = Tree::where('user_id', $fourth->user_id)->first();
                                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'"><img src="'.asset($fourth_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$fourth_level_node->member->full_name.'<br> ('.$level_checking.')
                                                        <div class="info">
                                                            <h5>Name : '.$fourth_level_node->member->full_name.'</h5>
                                                            <h5>Sponsor ID : '.$fourth_level_node->member->login_id.'</h5>
                                                            <h5>Level : '.$level_checking.'</h5>
                                                        </div>  
                                                    </a>';
                                                }
                                            } else if($third->right_id == $fourth->id){
                                                if(!empty($fourth->id)){
                                                    $level_checking = $this->levelCheck($fourth->user_id);
                                                    $fourth_level_node = Tree::where('user_id', $fourth->user_id)->first();
                                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'"><img src="'.asset($fourth_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$fourth_level_node->member->full_name.'<br> ('.$level_checking.')
                                                    <div class="info">
                                                        <h5>Name : '.$fourth_level_node->member->full_name.'</h5>
                                                        <h5>Sponsor ID : '.$fourth_level_node->member->login_id.'</h5>
                                                        <h5>Level : '.$level_checking.'</h5>
                                                    </div>  
                                                </a>';
                                                }
                                            }

                                            // FIFTH LEVEL STARTS
                                            $fifth_level = Tree::where('parent_id',$fourth->id)->orderBy('parent_leg', 'ASC')->get();
                                            if ($fifth_level) {
                                                $html.="<ul>";
                                                if(empty($fourth->left_id)){
                                                    $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                                                }
                                                foreach ($fifth_level as $key => $fifth) {
                                                    $html.="<li>";
                                                    if ($fourth->left_id == $fifth->id) {
                                                        if(!empty($fifth->id)){
                                                            $level_checking = $this->levelCheck($fourth->user_id);
                                                            $fifth_level_node = Tree::where('user_id', $fifth->user_id)->first();
                                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'"><img src="'.asset($fifth_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$fifth_level_node->member->full_name.'<br> ('.$level_checking.')
                                                            <div class="info">
                                                            <h5>Name : '.$fifth_level_node->member->full_name.'</h5>
                                                            <h5>Sponsor ID : '.$fifth_level_node->member->login_id.'</h5>
                                                            <h5>Level : '.$level_checking.'</h5>
                                                            </div>  
                                                            </a>';
                                                        }
                                                    } 
                                                   
                                                     if($fourth->right_id == $fifth->id){
                                                         if(!empty($fourth->right_id)  && !empty($fifth->id)){
                                                            $level_checking = $this->levelCheck($fourth->user_id);
                                                            $fifth_level_node = Tree::where('user_id', $fifth->user_id)->first();
                                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'"><img src="'.asset($fifth_level_node->status == 1 ? 'admin/build/images/avatar.jpg' : 'admin/build/images/star.png' ).'">'.$fifth_level_node->member->full_name.'<br> ('.$level_checking.')
                                                            <div class="info">
                                                            <h5>Name : '.$fifth_level_node->member->full_name.'</h5>
                                                            <h5>Sponsor ID : '.$fifth_level_node->member->login_id.'</h5>
                                                            <h5>Level : '.$level_checking.'</h5>
                                                            </div>  
                                                            </a>';
                                                        }
                                                    }
                                                }
                                                if(empty($fourth->right_id)){
                                                    $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                                                }
                                                $html.="</ul>";
                                            }
                                            $html.="</li>";
                                            $count++;
                                        }
                                        if(empty($third->right_id)){
                                            $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                                        }
                                        $html.="</ul>";
                                    }
                                    $html.="</li>";
                                }
                                if(empty($second->right_id)){
                                    $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                                }
                                
                                $html.="</ul>";
                                /////THIRD LEVEL ENDS
                            }

                            $html.="</li>";
                        }
                        if(empty($first->right_id)){
                            $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                        }
                        $html.="</ul>";
                    }
                    /////////////////////Second End
                    $html.="</li>";
                }
                if(empty($root->right_id)){
                    $html.='<li><a href="#"><img src="'.asset('admin/build/images/none-avatar.jpg').'">Empty</a></li>';
                }
                $html.="</ul>";
            }

            $html.="
                </li>
            </ul>";
        }     
       
        return view('member.tree',compact('html'));
    }

    public function levelCheck($id){
        $total_pair = Tree::where('user_id', $id)->value('activate_pair');
        if($total_pair >= 24 && $total_pair <= 50){
            return "SILVER";
        }elseif ($total_pair >=50 && $total_pair <=200) {
            return "GOLD";
        }elseif ($total_pair >=200 && $total_pair <=500) {
            return "PEARL";
        }elseif ($total_pair >=500 && $total_pair <=1000) {
            return "RUBY";
        }elseif ($total_pair >=1000 && $total_pair <=1500) {
            return "EMERALD";
        }elseif ($total_pair >=1500 && $total_pair <=2500) {
            return "DIAMOND";
        }elseif ($total_pair >=2500 && $total_pair <=5000) {
            return "DOUBLE DIAMOND";
        }elseif ($total_pair >=5000 && $total_pair <=10000) {
            return "TRIPLE DIAMOND";
        }elseif ($total_pair >=10000 && $total_pair <=25000) {
            return  "CROWN LEADER";
        }elseif ($total_pair >=25000 && $total_pair <=50000) {
            return "CROWN AMBESSADOR";
        }else{
            return "FRESHER";
        }
    }

    public function memberCommissionListForm(){
        return view('member.commission');
    }

    public function memberWalletListForm(){
        $wallet = DB::table('wallets')
            ->where('user_id', Auth::guard('member')->user()->id)
            ->first();
        $amount = $wallet->amount;
        return view('member.wallet', compact('amount'));
    }

    public function ajaxGetCommissionList(){
        $query = DB::table('commission_histories')
        ->leftjoin('members', 'commission_histories.user_id', '=', 'members.id')
        ->select('commission_histories.*', 'members.full_name as user_name')
        ->where('members.id', Auth::guard('member')->user()->id);
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('amount', function($row){
                if($row->amount == '0.00'){
                    $amt = '<span class="label label-warning">'.number_format($row->amount, 2).'</span>';
                    return $amt;
                }else{
                    $amt = '<span class="label label-success">'.number_format($row->amount, 2).'</span>';
                    return $amt;
                }
                return $amt;
            })
            ->rawColumns(['amount'])
            ->make(true);
    }

    public function ajaxGetWalletHistory(){
        $query = DB::table('wallet_histories')
            ->orderBy('id','desc')
            ->where('user_id', Auth::guard('member')->user()->id);
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->make(true);
    }

    public function memberEpinListForm(){
        $total_fund = TotalFund::where('user_id', Auth::guard('member')->user()->id)->first();
        return view('member.epin', compact('total_fund'));
    }

    public function memberGetEpinList(){
        $query = FundHistory::where('user_id', Auth::guard('member')->user()->id)->orderBy('created_at', 'DESC');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->make(true);
    }
    
    public function memberFundHistoryForm(){
        $fund_history = FundHistory::where('user_id', Auth::guard('member')->user()->id)->first();
        return view('member.fund_history', compact('fund_history'));
    }
    public function memberGetFundHistory()
    {
        $query = DB::table('fund_histories')->where('user_id', Auth::guard('member')->user()->id);
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->make(true);
    }

    function sendSms($fullName, $mobile, $login_id, $password){
        $sms = "Congratulations $fullName!!!
        You are successfully registered with SSSDREAM LIFE E-COMMERCE PVT LTD
        Your User ID: $login_id
        Password: $password
        Website: http://sssdreamlife.net.in/";   

        $username="bibibobi";
        $api_password="9aea6n725bb8uegi3";
        $sender="BBBOBI";
        $domain="http://sms.webinfotech.co";
        $priority="11";// 11-Enterprise, 12- Scrub
        $method="GET";
        $message=$sms;

        $username=urlencode($username);
        $api_password=urlencode($api_password);
        $sender=urlencode($sender);
        $message=urlencode($message);

        $sms = urlencode($sms);

        $parameters="username=$username&api_password=$api_password&sender=$sender&to=$mobile&message=$message&priority=$priority";
        $url="$domain/pushsms.php?".$parameters;
        $ch = curl_init($url);

        if($method=="POST")
        {
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
        }
        else
        {
            $get_url=$url."?".$parameters;

            curl_setopt($ch, CURLOPT_POST,0);
            curl_setopt($ch, CURLOPT_URL, $get_url);
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
        curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
        $return_val = curl_exec($ch);
    }
    function paymentRequestMsg($name, $amount){
        $sms = "$name has requested a payment amount rs $amount. Please see the admin dashboard for the details. Thank you";   
        $mobile = '7086918960';
        $username="bibibobi";
        $api_password="9aea6n725bb8uegi3";
        $sender="BBBOBI";
        $domain="http://sms.webinfotech.co";
        $priority="11";// 11-Enterprise, 12- Scrub
        $method="GET";
        $message=$sms;

        $username=urlencode($username);
        $api_password=urlencode($api_password);
        $sender=urlencode($sender);
        $message=urlencode($message);

        $sms = urlencode($sms);

        $parameters="username=$username&api_password=$api_password&sender=$sender&to=$mobile&message=$message&priority=$priority";
        $url="$domain/pushsms.php?".$parameters;
        $ch = curl_init($url);

        if($method=="POST")
        {
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
        }
        else
        {
            $get_url=$url."?".$parameters;

            curl_setopt($ch, CURLOPT_POST,0);
            curl_setopt($ch, CURLOPT_URL, $get_url);
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
        curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
        $return_val = curl_exec($ch);
    }

    public function refreshMember($id)
    {
        try{
            $id = decrypt($id);
        }catch(DecryptException $e) {
            abort(404);
        }

        $refreshMember = DB::table('lock_table') 
        ->update([
            'joining' => $id,
        ]);

        return redirect()->back()->with('message','Refreshed Successfully!');
    }

    public function fundTransferFromWallet(Request $request)
    {
        $this->validate($request, [
            'fund_transfer'     => 'required'
        ]);
        $fund_transfer_amount = $request->input('fund_transfer');
        $fetch_wallet = Wallet::where('user_id', Auth::guard('member')->user()->id)->first();
        if($fetch_wallet->amount >= $fund_transfer_amount && $fetch_wallet->amount > 0){
              // Wallet Insert
            $wallet_update = DB::table('wallets') 
                    ->where('user_id', Auth::guard('member')->user()->id)
                    ->update([
                        'amount' => DB::raw("`amount`-".($fund_transfer_amount)),
                    ]);

            $update_wallet_history = DB::table('wallet_histories')
                ->insertGetId([
                    'wallet_id' =>  $fetch_wallet->id,
                    'user_id'   => Auth::guard('member')->user()->id,
                    'transaction_type'  =>  2,
                    'amount' => $fund_transfer_amount,
                    'total_amount'  => $fetch_wallet->amount,
                    'comment'   => $fund_transfer_amount.' Rs is debited from you wallet for transfering the fund! ',
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);

            $fetch_fund = Fund::where('alloted_to', Auth::guard('member')->user()->id)->first();
            $update_fund = DB::table('funds')
                ->insertGetId([
                    'fund' =>  $fund_transfer_amount,
                    'available_fund'   => ($fetch_fund->available_fund + $fund_transfer_amount) ,
                    'alloted_to'  =>  Auth::guard('member')->user()->id,
                    'alloted_date' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
                return redirect()->back()->with('message', 'Fund Transfered Successfully!');
        }else{
            return redirect()->back()->with('error', 'Insufficent Wallet Balane');
        }
    }

    public function profile(){
        $member = Member::findOrFail(Auth::guard('member')->user()->id);
        return view('member.profile', compact('member'));
    }
    public function changePasswordPage()
    {
        return view('member.change_password');
    }

    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        if (!(Hash::check($request->get('current-password'), Auth::guard('member')->user()->password))) {
            // The passwords matches
            return redirect()->back()->with('error','Your current password does not matches with the password you provided. Please try again.');
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }


        //Change Password
        $user = Auth::guard('member')->user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("message","Password changed successfully !");

    }
    public function accountUpdatePage()
    {
        $member = Member::findOrFail(Auth::guard('member')->user()->id);
        return view('member.account', compact('member'));
    }

    public function updateMember(Request $request)
    {   
        $this->validate($request, [
            'member_name'   => 'required',
            'mobile'        => 'required',
            'email'         => 'required|email',
            'ifsc'          => 'required',
            'account_no'    =>  'required',
        ]);
        
        $member = Member::find(Auth::guard('member')->user()->id);
        $member->full_name = $request->input('member_name');
        $member->mobile = $request->input('mobile');
        $member->email = $request->input('email');
        $member->dob = $request->input('dob');
        $member->pan = $request->input('pan');
        $member->aadhar = $request->input('aadhar');
        $member->address = $request->input('address');
        $member->bank_name = $request->input('bank');
        $member->ifsc = $request->input('ifsc');
        $member->account_no = $request->input('account_no');
        $image = null;
        if($request->hasfile('photo')){
            $this->validate($request, [
                'photo'         =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if($member->photo){
                //Delete
                $image_path_thumb = "/public/admin/production/images/thumb/".$member->photo;  
                $image_path_original = "/public/admin/production/images/".$member->photo;  
                if(File::exists($image_path_thumb)) {
                    File::delete($image_path_thumb);
                }
                if(File::exists($image_path_original)){
                    File::delete($image_path_original);
                }
            }
            $image_array = $request->file('photo');
            $image = $this->imageInsert($image_array, $request, 1);
            $member->photo = $image;
        }
        if($member->save()){
            return redirect()->back()->with('message', 'Account Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
    public function memberRequestForm()
    {
        return view('member.fund_request');
    }
    public function memberRequest(Request $request)
    {
        $this->validate($request, [
            'fund' => 'required|numeric',
            'utr'   => 'required'
        ]);
        
        $fund_request = new FundRequest;
        $fund_request->fund = $request->input('fund');
        $fund_request->utr = $request->input('utr');
        $image = null;
        if($request->hasfile('photo')){
            $this->validate($request, [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $image_array = $request->file('photo');
            $image = $this->ImageInsert($image_array, $request, 1);
        }
        $fund_request->attachment = $image;
        $fund_request->added_by = Auth::guard('member')->user()->full_name;
        if($fund_request->save()){
            return redirect()->back()->with('message', 'Successfully Requested!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong Please Try Again');
        }
    }
    public function fundRequestList()
    {
        return datatables()->of(FundRequest::orderBy('created_at', 'DESC')->get())
        ->make(true);
    }
    function imageInsert($image, Request $request, $flag){
        $destination = base_path().'/public/admin/production/images/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time()).$flag.".".$image_extension;
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);
        $thumb_path = base_path().'/public/admin/production/images/thumb/'.$image_name;
        Image::make($image)
        ->resize(300, 400)
        ->save($thumb_path);

        return $image_name;
    }
     public function getNotice($nId)
    {
        try{
            $id = decrypt($nId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $notice = ImportantNotice::findOrFail($id);
        return view('member.view_notice', compact('notice'));
    }
    public function memberGetRewardListForm()
    {
        return view('member.reward_history');
    }
    public function memberGetRewardList()
    {
        return datatables()->of(Rewards::orderBy('created_at', 'DESC')->get())
        ->make(true);
    }
    public function memberPaymentRequestForm()
    {
        $wallet_bal = Wallet::where('user_id', Auth::guard('member')->user()->id)->value('amount');
        return view('member.payment_request', compact('wallet_bal'));
    }
    public function ajaxGetPaymentRequest()
    {
        return datatables()->of(PaymentRequest::orderBy('created_at', 'DESC')->get())
        ->make(true);
    }
    public function paymentRequest(Request $request)
    {
        $this->validate($request, [
            'withdraw' => 'required|numeric'
        ]);
        $fetch_wallet = Wallet::where('user_id', Auth::guard('member')->user()->id)->first();
        if($fetch_wallet->amount > $request->input('withdraw') && $request->input('withdraw') >= 500){
            $wallet_update = DB::table('wallets') 
            ->where('user_id', Auth::guard('member')->user()->id)
            ->update([
                'amount' => DB::raw("`amount`-".($request->input('withdraw'))),
            ]);

        $update_wallet_history = DB::table('wallet_histories')
          ->insertGetId([
              'wallet_id' =>  $fetch_wallet->id,
              'user_id'   => Auth::guard('member')->user()->id,
              'transaction_type'  =>  2,
              'amount' =>$request->input('withdraw'),
              'total_amount'  => $fetch_wallet->amount,
              'comment'   =>$request->input('withdraw').' Rs is debited from you wallet for Withdraw! ',
              'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
          ]);
        
        $payment_requests = DB::table('payment_requests')
              ->insertGetId([
                  'amount' =>  $request->input('withdraw'),
                  'user_id'  =>  Auth::guard('member')->user()->id,
                  'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
              ]);
        if($payment_requests){
            $this->paymentRequestMsg(Auth::guard('member')->user()->full_name, $request->input('withdraw'));
        }
            return redirect()->back()->with('message', 'Payment Requested Successfully!');
        }else{
            return redirect()->back()->with('error', 'Insufficient Balance to withdraw!');
        }
    }
// *************************************************************************************************TEST*****************************************************
public function memberTestForm()
{
    return view('member.test.test');
}

public function memberTest(Request $request)
{
    $this->validate($request, [
        "search_sponsor_id" => 'required',
        'leg' => 'required',
        'how_many' => 'required'
    ]);

    $sponsorID = $request->input('search_sponsor_id');
    $leg = $request->input('leg');
    $how_many = $request->input('how_many');
    $faker = Faker::create();
    for ($i=0; $i <$how_many ; $i++) { 
        $f_name = $faker->name;
        $l_name = $faker->name;
        $mobile = rand(1111111111, 9999999999);
        $last_member = Member::orderBy('created_at', 'DESC')->count();

        $login_id = substr($f_name,2).$last_member;
        $password = Hash::make(123456);
        $email = $faker->email;
        $this->addNewMemberTest($sponsorID, $leg, $f_name, $l_name, $mobile, $login_id, $password, $email);
        echo $i."Done <br>";
    }
    return redirect()->back()->with('message','joined Successfully');
    
}

public function addNewMemberTest($sponsorID, $leg, $f_name, $l_name, $mobile, $login_id, $password, $email)
    {
        $sponsor_member_data = Member::where('login_id', $sponsorID)->lockForUpdate()->first();
        if(empty($sponsor_member_data)){
            return redirect()->back();
        }
        $sponsorID          = $sponsor_member_data->sponsorID;
        $leg                = $leg;
        $f_name             = $f_name;
        $m_name             = NULL;
        $l_name             = $l_name;
        $fullName           = $f_name . " " . $m_name ." ". $l_name;
        $email              = $email;
        $mobile             = $mobile;
        $dob                = NULL;
        $pan                = NULL;
        $aadhar             = NULL;
        $address            = NULL;
        // Bank
        $bank               = NULL;
        $ifsc               = NULL;
        $account_no         = NULL;
        // Credentials
        $login_id           = $login_id;
        $password           = $password;
        $sleep = 0;
        $member_data = Member::where('sponsorID', $sponsorID)->lockForUpdate()->first();
        if(!empty($leg)){
            try {
                for ($i=0; $i <2; $i++){
                    $chk_lock = ManualLock::where('id', 1)->lockForUpdate()->first();
                    if ($chk_lock->joining == 1) {
                        $i = 2;
                        $chk_lock->joining = 2;
                        $chk_lock->save();
                        $member_data = Member::where('sponsorID', $sponsorID)->lockForUpdate()->first();
                        if($member_data){
                            $tree_data = Tree::where('user_id', $member_data->id)->lockForUpdate()->first();
                            if($tree_data){
                                if($leg == 1){
                                    $a = $this->memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password);
                                    $token = rand(111111,999999);
                                    $chk_lock = ManualLock::find(1);
                                    $chk_lock->joining = 1;
                                    $chk_lock->save();
                                    if(Auth::guard('member')->check()){
                                        return redirect()->route('member.thank_you',['token'=>encrypt($token)]);
                                    }else{
                                        return redirect()->route('web.thanks',['token' =>encrypt($token)]);
                                    }
                                }else if($leg == 2){
                                    $b = $this->memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password);
                                    $token = rand(111111,999999);
                                    $chk_lock = ManualLock::find(1);
                                    $chk_lock->joining = 1;
                                    $chk_lock->save();
                                    if (Auth::guard('member')->check()) {
                                        return redirect()->route('member.thank_you',['token'=>encrypt($token)]);
                                    }else {
                                        return redirect()->route('web.thanks',['token' =>encrypt($token)]);
                                    }
                                }
                            }else{
                                $chk_lock = ManualLock::find(1);
                                $chk_lock->joining = 1;
                                $chk_lock->save();
                                return back()->with('error', 'Inavlid SponsorID!');
                            }
                        }else{
                            $chk_lock = ManualLock::find(1);
                            $chk_lock->joining = 1;
                            $chk_lock->save();
                            return back()->with('error', 'SponsorID is invalid');
                        }
                    }else {
                        $sleep++;
                        sleep(1);
                    }
                }
            } catch (\Exception $e) {
                $chk_lock = ManualLock::find(1);
                $chk_lock->joining = 1;
                $chk_lock->save();
                return back()->with('error', 'Please Try After Sometime');
            }
            
            if ($sleep == 2) {
                $chk_lock = ManualLock::find(1);
                $chk_lock->joining = 1;
                $chk_lock->save();
                return back()->with('error', 'Please Try After Sometime');
            }
           
        }else{
            return back()->with('error', 'Select Leg!');
        }
    }


}
