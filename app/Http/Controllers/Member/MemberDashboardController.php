<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Member;
use App\Tree;
use App\CommissionHistory;
use App\Epin;
use App\Wallet;
use Hash;
use Auth;
use Carbon\Carbon;
use Session;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $my_commission = CommissionHistory::where('user_id', Auth::user()->id)->sum('amount');
        $total_pair_completed = Tree::where('user_id', Auth::user()->id)->value('total_pair');
        $epin_available = Epin::where('status', 2)->where('alloted_to', Auth::user()->id)->count();
        $epin_used = Epin::where('status', 1)->where('alloted_to', Auth::user()->id)->count();
        $my_wallet = Wallet::where('user_id', Auth::user()->id)->value('amount');

        $epin_list = Epin::with('member')->where('alloted_to', Auth::user()->id)->paginate(10);

        return view('member.dashboard', compact('my_commission', 'total_pair_completed', 'epin_available', 'epin_used', 'my_wallet', 'epin_list'));
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
            'email'                 => 'unique:members|required|email',
            'mobile'                => 'unique:members|required|numeric|min:10',
            'dob'                   => 'required',
            'pan'                   => 'unique:members|required',
            'aadhar'                => 'unique:members|required',
            'bank'                  => 'required',
            'ifsc'                  => 'required',
            'confirm_ifsc'          => 'required|same:ifsc',
            'account_no'            => 'required',
            'confirm_account'       => 'required|same:account_no',
            'confirm_ifsc'          => 'required|same:ifsc',
            'login_id'              => 'required|unique:members',
            'password'              => 'required|confirmed|min:6'
        ]);

        $sponsorID          = $request->get('search_sponsor_id');
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
        $member_data = Member::where('sponsorID', $sponsorID)->first();
        if(!empty($leg)){
            if($member_data){
                $member = Member::where('login_id', $login_id)->count();
                if($member < 1){
                    $mobile_count = Member::where('mobile', $mobile)->count();
                    if($mobile_count < 1){
                        $tree_data = Tree::where('user_id', $member_data->id)->first();
                        if($tree_data){
                            if(is_null($tree_data->left_id) && is_null($tree_data->right_id)){
                                $this->memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password);
                            }
                            else if(is_null($tree_data->left_id)){
                                $this->memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password);
                            }else if(is_null($tree_data->right_id)){
                                $this->memberRegister($sponsorID, $leg, $fullName, $email, $mobile, $dob, $pan, $aadhar, $address, $bank, $ifsc, $account_no, $login_id, $password);
                            }else{
                                return redirect()->back()->with('error', 'All lags are full! Try with another Sponsor ID!');
                            }
                        }else{
                            return back()->with('error', 'Inavlid SponsorID!');
                        }
                    }else{
                        return back()->with('error', 'Mobile No is already taken!');
                    }
                }else{
                    return back()->with('error', 'Username is already taken!');
                }
            }else{
                return back()->with('error', 'SponsorID is invalid');
            }
        }else{
            return back()->with('error', 'Select Leg!');
        }
    }

    public function searchSponsorID(Request $request){
        if($request->ajax()){
            $sponsorID = $request->get('query');
            if(!empty($sponsorID)) {
                $member_data = Member::where('sponsorID', $sponsorID)->first();
                if($member_data) {
                    $tree_data = Tree::where('user_id', $member_data->id)->first();
                    if($tree_data){
                        if(is_null($tree_data->left_id) && is_null($tree_data->right_id)){
                            $html = '
                            <label>
                                <font color="green">Yay! Both legs are empty</font>
                            </label><br>
                            <label for="gender"> Name</label>
                            <input type="text" value="'.$member_data->full_name.'" class="form-control" readonly placeholder="Name">
                            <label for="gender">Mobile</label>
                            <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                            <label for="gender">DOB</label>
                            <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                            <label class="control-label ">Select Leg*</label>
                              <div id="leg">
                                  <input type="radio" name="leg" value="1" id="left_lag" checked> Left &nbsp;
                                  <input type="radio" name="leg" value="2" id="right_lag"> Right
                              </div>';
                            echo $html;
                        }
                        else if(is_null($tree_data->left_id)){
                            $html = '
                            <label>
                                <font color="green">Left leg is empty!</font>
                            </label><br>
                            <label for="gender"> Name</label>
                            <input type="text" value="'.$member_data->full_name.'" class="form-control" readonly placeholder="Name">
                            <label for="gender">Mobile</label>
                            <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                            <label for="gender">DOB</label>
                            <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                            <label class="control-label ">Select Lag*</label>
                              <div id="leg">
                                  <input type="radio" name="leg" value="1" id="left_lag" checked> Left &nbsp;
                                  <input type="radio" name="leg" value="2" id="right_lag" disabled> Right
                              </div>';
                            return $html;
                        }
                        else if(is_null($tree_data->right_id)){
                            $html = '
                            <label>
                                <font color="green">Right leg is empty!</font>
                            </label><br>
                            <label for="gender"> Name</label>
                            <input type="text" value="'.$member_data->full_name.'" class="form-control" readonly placeholder="Name">
                            <label for="gender">Mobile</label>
                            <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                            <label for="gender">DOB</label>
                            <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                            <label class="control-label ">Select Lag*</label>
                              <div id="leg">
                                  <input type="radio" name="leg" value="1" id="left_lag" disabled> Left &nbsp;
                                  <input type="radio" name="leg" value="2" id="right_lag" checked> Right
                              </div>';
                            return $html;
                        }else{
                            return 5;
                        }
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

                //Fetch Member Data Using Sponsor ID
                $fetch_member = DB::table('members')
                    ->where('sponsorID', $sponsorID)
                    ->first();
                //Fetch Tree Data Using User ID
                $fetch_tree = DB::table('trees')
                    ->where('user_id', $fetch_member->id)
                    ->first();
                $tree_insert = DB::table('trees')
                ->insertGetId([
                    'user_id' => $member_insert,
                    'parent_id' => $fetch_tree->id,
                    'registered_by' => Auth::user()->id,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
                if($leg == 1){
                    $tree_update = DB::table('trees')
                        ->where('id', $fetch_tree->id)
                        ->update([
                            'left_id' => $tree_insert,
                            'parent_leg' => 'L',
                            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString() 
                        ]);
                        
                }else{
                    $tree_update = DB::table('trees')
                    ->where('id', $fetch_tree->id)
                    ->update([
                        'right_id' => $tree_insert ,
                        'parent_leg' => 'R',
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString() 
                        ]);
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
                    WHERE lv IS NOT NULL AND lv != 0 LIMIT 1000")
                    , array(
                      'start_node' => $tree_insert,
                    )
                );
                $a = $this->treePair($parrents, $member_insert);
            });
            $token = rand(111111,999999);
            Session::put('token', $token);
            Session::save();
            return redirect()->route('member.thank_you',['token'=>encrypt($token)]);
            
        }catch (\Exception $e) {
                return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }
    public function thankYou($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            abort(404);
        }
        
        if($token){
                $delete_previous_session = session()->forget('token');
                $success = 'Registration Successfull';
                return view('member.registration.finish_page', compact('success'));
        }else{
            abort(404);
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
                ->select('left_id', 'right_id')
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
            
            //Pair checking
            $total_pair_count =  DB::table('trees')
                ->select('total_pair')
                ->where('id',$parent)
                ->first();
            
            //Fetch Pair Match
            $pair_match = DB::table('trees')
                ->select('left_count', 'right_count')
                ->where('id',$parent)
                ->first();
            //Check 1:1 Check
            if($pair_match->right_count > 0 && $pair_match->left_count  > 0){
                $this->creditCommisionOneIsToOne($parent,1, 1);
                $total_pair_update = DB::table('trees')
                ->where('id', $parent)
                ->update([
                    'total_pair' => DB::raw("`total_pair`+".(1)),
                ]);
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
                ->where('id', $parent)
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
                
                // TDS Commission Fetch
                $tdsCommissionFetch = DB::table('admin_tds')->first();
                $tdsCommission = ($earning2 * $tdsCommissionFetch->tds)/100;
                $earning = $earning2 - $tdsCommission;
                // Admin TDS Insert
                $admin_tds_insert = DB::table('admin_tdses') 
                ->where('role', '1')
                ->update([
                    'tds' => DB::raw("`tds`+".($tdsCommission)),
                ]);
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
                'user_id' => Auth::user()->id,
                )))
            ->addIndexColumn()
            ->addColumn('sponsorID', function($row){
                $user_id = $row->user_id;
                if(!empty($user_id)){
                    $member_id =  DB::table('trees')
                        ->select('members.sponsorID as sponsorID')
                        ->join('members', 'members.id', '=', 'trees.user_id')
                        ->where('trees.user_id', $row->user_id)
                        ->value('members.sponsorID');
                }
                return $member_id;
            })
            ->addColumn('parent', function($row){
                $parents = $row->parent_id;
                if (!empty($parents)) {
                    $parent_details =  DB::table('trees')
                    ->select('members.full_name as u_name','members.id as u_id', 'members.sponsorID as sponsorID')
                    ->join('members','members.id','=','trees.user_id')
                    ->where('trees.id',$row->parent_id)
                    ->first();
                   $parent = $parent_details->sponsorID;
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
                   ->select('members.full_name as u_name','members.id as u_id', 'members.sponsorID as sponsorID')
                   ->join('members','members.id','=','trees.user_id')
                   ->where('tree.id',$lft_members)
                   ->first();
                    $lft_member = $lft_details->sponsorID;
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
                    ->select('members.full_name as u_name','members.id as u_id', 'members.sponsorID as sponsorID')
                   ->join('members','members.id','=','trees.user_id')
                   ->where('trees.id',$rht_members)
                   ->first();
                    $rht_member = $rht_details->sponsorID;
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
                        ->select('full_name','id', 'sponsorID')
                        ->where('id',$add_by)
                        ->first();
                        $add_by = $user_details->sponsorID;
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
            $user_id = Auth::user()->id;
        }
        if (empty($rank)) {
            $rank = 0;
        }

        $html=null;
        $root = DB::table('trees')
            ->select('trees.*', 'members.full_name', 'members.sponsorID')
            ->join('members', 'trees.user_id', '=', 'members.id')
            ->where('user_id', $user_id)
            ->first();
        if($root){
            $html = '<ul>
            <li>        
                <a href="#">'.$root->full_name.'
                    <div class="info">
                        <h5>Name : '.$root->full_name.'</h5>
                        <h5>Id : '.$root->sponsorID.'</h5>
                        <h5>Rank : '.$rank.'</h5>
                    </div>
                </a>';
            $rank++;
            $first_level = DB::table('trees')->where('parent_id',$root->id)->get();
            if ($first_level) {
                $html.="<ul>";
                if(empty($root->left_id)){
                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                }
                foreach ($first_level as $key => $first) {
                    $html.="<li>";
                    if ($root->left_id == $first->id) {
                        $first_level_node = DB::table('trees')
                        ->select('trees.*', 'members.full_name', 'members.sponsorID')
                        ->join('members', 'trees.user_id', '=', 'members.id')
                        ->where('trees.user_id', $first->id)
                        ->first();
                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'">'.$first_level_node->full_name.'
                            <div class="info">
                                <h5>Name : '.$first_level_node->full_name.'</h5>
                                <h5>Id : '.$first_level_node->sponsorID.'</h5>
                                <h5>Rank : '.$rank.'</h5>
                            </div>  
                        </a>';
                    } else if($root->right_id == $first->id){
                        $first_level_node = DB::table('trees')
                        ->select('trees.*', 'members.full_name', 'members.sponsorID')
                        ->join('members', 'trees.user_id', '=', 'members.id')
                        ->where('trees.user_id', $first->id)
                        ->first();
                        $html.='<a href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'">'.$first_level_node->full_name.'
                            <div class="info">
                                <h5>Name : '.$first_level_node->full_name.'</h5>
                                <h5>Id : '.$first_level_node->sponsorID.'</h5>
                                <h5>Rank : '.$rank.'</h5>
                            </div>  
                        </a>';
                    }

                    $second_level = DB::table('trees')->where('parent_id',$first->id)->orderBy('parent_leg', 'ASC')->get();


                    if ($second_level) {
                        $html.="<ul>";
                        if(empty($first->left_id)){
                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                        }
                        foreach ($second_level as $key => $second) {
                            $html.="<li>";
                            if ($first->left_id == $second->id) {
                                $second_level_node = DB::table('trees')
                                ->select('trees.*', 'members.full_name', 'members.sponsorID')
                                ->join('members', 'trees.user_id', '=', 'members.id')
                                ->where('trees.user_id', $second->id)
                                ->first();
                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'">'.$second_level_node->full_name.'
                                            <div class="info">
                                                <h5>Name : '.$second_level_node->full_name.'</h5>
                                                <h5>Id : '.$second_level_node->sponsorID.'</h5>
                                                <h5>Rank : '.$rank.'</h5>
                                            </div>  
                                        </a>';
                            } else if($first->right_id == $second->id){
                                $second_level_node = DB::table('trees')
                                ->select('trees.*', 'members.full_name', 'members.sponsorID')
                                ->join('members', 'trees.user_id', '=', 'members.id')
                                ->where('trees.user_id', $second->id)
                                ->first();
                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'">'.$second_level_node->full_name.'
                                    <div class="info">
                                        <h5>Name : '.$second_level_node->full_name.'</h5>
                                        <h5>Id : '.$second_level_node->sponsorID.'</h5>
                                        <h5>Rank : '.$rank.'</h5>
                                    </div>  
                                </a>';
                            }

                            //THIRD LEVEL STARTS
                            $third_level = DB::table('trees')->where('parent_id',$second->id)->orderBy('parent_leg', 'ASC')->get();

                           
                            
                            if ($third_level) {
                                $html.="<ul>";
                                if(empty($second->left_id)){
                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                }
                                foreach ($third_level as $key => $third) {
                                    $html.="<li>";
                                    if ($second->left_id == $third->id) {
                                        $third_level_node = DB::table('trees')
                                        ->select('trees.*', 'members.full_name', 'members.sponsorID')
                                        ->join('members', 'trees.user_id', '=', 'members.id')
                                        ->where('trees.user_id', $third->id)
                                        ->first();
                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'">'.$third_level_node->full_name.'
                                            <div class="info">
                                                <h5>Name : '.$third_level_node->full_name.'</h5>
                                                <h5>Id : '.$third_level_node->sponsorID.'</h5>
                                                <h5>Rank : '.$rank.'</h5>
                                            </div>  
                                        </a>';
                                    } else if($second->right_id == $third->id){
                                        $third_level_node = DB::table('trees')
                                        ->select('trees.*', 'members.name', 'members.sposnorID')
                                        ->join('members', 'trees.user_id', '=', 'members.id')
                                        ->where('trees.user_id', $third->id)
                                        ->first();
                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'">'.$third_level_node->full_name.'
                                            <div class="info">
                                                <h5>Name : '.$third_level_node->full_name.'</h5>
                                                <h5>Id : '.$third_level_node->sponsorID.'</h5>
                                                <h5>Rank : '.$rank.'</h5>
                                            </div>  
                                        </a>';
                                    }
                                    //FOURTH LEVEL STARTS
                                    $fourth_level = DB::table('trees')->where('parent_id',$third->id)->orderBy('parent_leg', 'ASC')->get();
                                    if ($fourth_level) {
                                        $html.="<ul>";
                                        if(empty($third->left_id)){
                                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                        }
                                        foreach ($fourth_level as $key => $fourth) {
                                            $html.="<li>";
                                            if ($third->left_id == $fourth->id) {
                                                $fourth_level_node = DB::table('trees')
                                                ->select('trees.*', 'members.name', 'members.sponsorID')
                                                ->join('members', 'trees.user_id', '=', 'members.id')
                                                ->where('trees.user_id', $fourth->id)
                                                ->first();
                                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'">'.$fourth_level_node->name.'
                                                    <div class="info">
                                                        <h5>Name : '.$fourth_level_node->full_name.'</h5>
                                                        <h5>Id : '.$fourth_level_node->sponsorID.'</h5>
                                                        <h5>Rank : '.$rank.'</h5>
                                                    </div>  
                                                </a>';
                                            } else if($third->right_id == $fourth->id){
                                                $fourth_level_node = DB::table('trees')
                                                ->select('trees.*', 'members.full_name', 'members.sponsorID')
                                                ->join('members', 'trees.user_id', '=', 'members.id')
                                                ->where('trees.user_id', $fourth->id)
                                                ->first();
                                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'">'.$fourth_level_node->full_name.'
                                                <div class="info">
                                                    <h5>Name : '.$fourth_level_node->full_name.'</h5>
                                                    <h5>Id : '.$fourth_level_node->sponsorID.'</h5>
                                                    <h5>Rank : '.$rank.'</h5>
                                                </div>  
                                            </a>';
                                            }

                                            // FIFTH LEVEL STARTS
                                            $fifth_level = DB::table('trees')->where('parent_id',$fourth->id)->orderBy('parent_leg', 'ASC')->get();
                                            if ($fifth_level) {
                                                $html.="<ul>";
                                                if(empty($fourth->left_id)){
                                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                                }
                                                foreach ($fifth_level as $key => $fifth) {
                                                    $html.="<li>";
                                                    if ($fourth->left_id == $fifth->id) {
                                                        $fifth_level_node = DB::table('trees')
                                                        ->select('trees.*', 'members.full_name', 'members.sponsorID')
                                                        ->join('members', 'trees.user_id', '=', 'members.id')
                                                        ->where('trees.user_id', $fifth->id)
                                                        ->first();
                                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'">'.$fifth_level_node->full_name.'
                                                            <div class="info">
                                                                <h5>Name : '.$fifth_level_node->full_name.'</h5>
                                                                <h5>Id : '.$fifth_level_node->sponsorID.'</h5>
                                                                <h5>Rank : '.$rank.'</h5>
                                                            </div>  
                                                        </a>';
                                                    } else if($fourth->right_id == $fifth->id){
                                                        $fifth_level_node = DB::table('trees')
                                                        ->select('trees.*', 'members.full_name', 'members.sponsorID')
                                                        ->join('members', 'trees.user_id', '=', 'members.id')
                                                        ->where('trees.user_id', $fifth->id)
                                                        ->first();
                                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'">'.$fifth_level_node->full_name.'
                                                        <div class="info">
                                                            <h5>Name : '.$fifth_level_node->full_name.'</h5>
                                                            <h5>Id : '.$fifth_level_node->sponsorID.'</h5>
                                                            <h5>Rank : '.$rank.'</h5>
                                                        </div>  
                                                    </a>';
                                                    }
                                                }
                                                if(empty($fourth->right_id)){
                                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                                }
                                                $html.="</ul>";
                                            }
                                            $html.="</li>";
                                        }
                                        if(empty($third->right_id)){
                                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                        }
                                        $html.="</ul>";
                                    }
                                    $html.="</li>";
                                }
                                if(empty($second->right_id)){
                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                }
                                
                                $html.="</ul>";
                                /////THIRD LEVEL ENDS
                            }

                            $html.="</li>";
                        }
                        if(empty($first->right_id)){
                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                        }
                        $html.="</ul>";
                    }
                    /////////////////////Second End
                    $html.="</li>";
                }
                if(empty($root->right_id)){
                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                }
                $html.="</ul>";
            }

            $html.="
                </li>
            </ul>";
        }     
       
        return view('member.tree',compact('html'));
    }

    public function memberCommissionListForm(){
        return view('member.commission');
    }

    public function memberWalletListForm(){
        $wallet = DB::table('wallets')
            ->where('user_id', Auth::user()->id)
            ->first();
        $amount = $wallet->amount;
        return view('member.wallet', compact('amount'));
    }

    public function ajaxGetCommissionList(){
        $query = DB::table('commission_histories')
        ->leftjoin('members', 'commission_histories.user_id', '=', 'members.id')
        ->select('commission_histories.*', 'members.full_name as user_name')
        ->where('members.id', Auth::user()->id);
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
            ->where('user_id', Auth::user()->id);
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->make(true);
    }

    public function memberEpinListForm(){
        return view('member.epin');
    }

    public function memberGetEpinList(){
        $query = DB::table('epins')
                ->leftjoin('members', 'epins.alloted_to', '=', 'members.id')
                ->select('epins.*', 'members.full_name as name')
                ->where('members.id', Auth::user()->id);
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
}
