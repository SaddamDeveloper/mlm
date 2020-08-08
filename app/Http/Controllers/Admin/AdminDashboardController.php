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
use App\Member;
use App\Tree;
use App\TotalFund;
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

    public function ajaxGetFundList()
    {    
        $query = DB::table('funds')
                ->leftjoin('members', 'funds.alloted_to', '=', 'members.id')
                // ->leftjoin('members', 'epin.used_by', '=', 'members.id')
                ->select('funds.*', 'members.full_name as alloted_to');
                // ->select('epin.*', 'members.name AS used_by');
                // return $query;
            return datatables()->of($query->get())
            ->addIndexColumn()
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
                $member_data = DB::table('members')->where('login_id', $member_id)->first();
                if($member_data) {
                    $html = '
                    <label for="name">Name</label>
                    <input type="text" value="'.$member_data->full_name.'" class="form-control" readonly placeholder="Name">
                    <label for="gender">Mobile</label>
                    <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                    <label for="gender">DOB</label>
                    <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                    <label for="name">How much fund you are allocating?</label>
                    <input type="text" class="form-control" name="fund"  placeholder="How much fund you are allocating?"><br>
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
            'fund' => 'required',
        ]);
        
        $fund = $request->input('fund');
        $member_id = $request->input('searchMember');
        $member_data_fetch = DB::table('members')->where('login_id', $member_id)->first();

        $total_fund_insert_check = DB::table('total_funds')->where('user_id', $member_data_fetch->id)->first();
        if($total_fund_insert_check){
              // Wallet Insert
              $wallet_insert = DB::table('total_funds') 
              ->where('user_id', $member_data_fetch->id)
              ->update([
                  'amount' => DB::raw("`amount`+".($fund)),
              ]);
        }else{
            $total_fund_insert = DB::table('total_funds')
                    ->insert([
                        'user_id'           =>  $member_data_fetch->id,
                        'status'            => 1,
                        'created_at'        => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            // Wallet Insert
            $wallet_insert = DB::table('total_funds') 
                ->where('user_id', $member_data_fetch->id)
                ->update([
                    'amount' => DB::raw("`amount`+".($fund)),
            ]);
        }
        $fetch_fund = TotalFund::where('user_id', $member_data_fetch->id)->first();
        $fund_insert = DB::table('funds')
            ->insert([
                'fund'                  =>  $fetch_fund->amount,
                'available_fund'        => 0,
                'alloted_to'            => $member_data_fetch->id,
                'alloted_date'          => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'created_at'            => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
        $fetch_fund_two = TotalFund::where('user_id', $member_data_fetch->id)->first();
        $fund_update = DB::table('funds') 
            ->where('alloted_to', $member_data_fetch->id)
            ->update([
                'available_fund' => DB::raw("`available_fund`+".($fetch_fund_two->amount)),
            ]);
        return redirect()->back()->with('message', ''.$fund.' Fund is transfered successfully to '.$member_data_fetch->full_name.'');
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

    public function memberList(){
        return view('admin.member_list');
    }

    public function ajaxGetMemberList(){
        $query = Member::orderBy('id','desc');
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->addColumn('left', function($row){
            $tree = Tree::where('user_id', $row->id)->first();
            if($tree->left_id){
                 $left = '<span class="label label-success">YES</span>';
                 return $left;
            }else{
                 $left = '<span class="label label-danger">NO</span>';
                 return $left;
            }
            return $left;
         })
          ->addColumn('right', function($row){
             $tree = Tree::where('user_id', $row->id)->first();
             if($tree->right_id){
                  $right = '<span class="label label-success">YES</span>';
                  return $right;
             }else{
                  $right = '<span class="label label-danger">NO</span>';
                  return $right;
             }
             return $right;
          })
          ->addColumn('action', function($row){
            $btn = '
            <a href="'.route('admin.member_view', ['id' => encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
            <a href="'.route('admin.member_edit', ['id' => encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>              
            <a href="'.route('admin.member_downline', ['id' => encrypt($row->id)]).'" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-code-fork"></i></a>              
            <a href="'.route('admin.member.tree', ['rank' => 0, 'user_id' => encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-tree"></i></a>              
            ';

            if($row->status == '1'){
                 $btn .= '<a href="'.route('admin.member_status', ['id' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i></a>';
                 return $btn;
             }else{
                 $btn .='<a href="'.route('admin.member_status', ['id' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>';
                 return $btn;
             }
          return $btn;
     })
     ->rawColumns(['left', 'right','action', 'registered_by'])
     ->make(true);
    }

    public function memberStatus($memberId, $statusId){
        try {
            $id = decrypt($memberId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
   
        $status_member = DB::table('members')
            ->where('id', $id)
            ->update([
                'status' => $sId,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
   
        if($sId == 1){
            return redirect()->back()->with('message', 'Activated Successfully!');
        }else{
            return redirect()->back()->with('message', 'Deactivated Successfully');
        }
   
    }
   
    public function memberView($vId){
        try {
             $id = decrypt($vId);
         }catch(DecryptException $e) {
             return redirect()->back();
         }
   
        $fetch_member_data = DB::table('members')->where('id', $id)->first();
        return view('admin.member_details', compact('fetch_member_data'));
    }
   
    public function memberEdit($vId){
        try {
             $id = decrypt($vId);
         }catch(DecryptException $e) {
             return redirect()->back();
         }
   
        $fetch_member_data = DB::table('members')->where('id', $id)->first();
        return view('admin.member_edit', compact('fetch_member_data'));
    }

    public function memberDownline($vId){
        try {
                $id = decrypt($vId);
            }catch(DecryptException $e) {
                return redirect()->back();
            }
    
        $fetch_member_data = DB::table('members')->where('id', $id)->first();
        return view('admin.member_downline', compact('fetch_member_data'));
    }

    public function memberDownlineList($mId){
        try {
            $id = decrypt($mId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
    
        return datatables()->of(DB::select(DB::raw("SELECT * FROM (SELECT * FROM trees
        ORDER BY user_id) items_sorted,
       (SELECT @iv := :user_id) initialisation
       WHERE find_in_set(parent_id, @iv)
       AND length(@iv := concat(@iv, ',', id))"),
        array(
           'user_id' => $id,
           )))
        ->addIndexColumn()
        ->addColumn('parent', function($row){
            $parent = $row->parent_id;
            if (!empty($parent)) {
               $parent_details =  DB::table('trees')
               ->select('members.full_name as u_name','members.id as u_id')
               ->join('members','members.id','=','trees.user_id')
               ->where('trees.id',$row->parent_id)
               ->first();
               if ($row->user_id == $parent_details->u_id) {
                    $parent.=" (Self)";
                }else{
                    $parent.=" (".$parent_details->u_name.")";
               }
            }
            return $parent;
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
            $lft_member = $row->left_id;
            if (!empty($lft_member)) {
                $lft_details =  DB::table('trees')
               ->select('members.full_name as u_name','members.id as u_id')
               ->join('members','members.id','=','trees.user_id')
               ->where('trees.id',$lft_member)
               ->first();
               if ($row->user_id == $lft_details->u_id) {
                    $lft_member.=" (Self)";
                }else{
                    $lft_member.=" (".$lft_details->u_name.")";
               }
            }
            return $lft_member;
        })
        ->addColumn('right_member', function($row){
            $rht_member = $row->right_id;
           
            if (!empty($rht_member)) {
                $rht_details =  DB::table('trees')
                ->select('members.full_name as u_name','members.id as u_id')
               ->join('members','members.id','=','trees.user_id')
               ->where('trees.id',$rht_member)
               ->first();
               if ($row->user_id == $rht_details->u_id) {
                    $rht_member.=" (Self)";
                }else{
                    $rht_member.=" (".$rht_details->u_name.")";
                }
            }else{
                $rht_member='';
            }
            return $rht_member;
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
                    ->select('full_name','id')
                    ->where('id',$add_by)
                    ->first();
                    $add_by.=$add_by." (".$user_details->full_name.")";
                }
            }
            return $add_by;
        })
        ->addColumn('created_at', function($row){
            $created_at = Carbon::parse($row->created_at)->toDayDateTimeString();
            return $created_at;
        })
        ->rawColumns(['parent','member_name','left_member','right_member','add_by','created_at'])
        ->make(true);
    }

    public function memberTree($rank=null, $user_id=null){
        if (!empty($user_id)) {
            try{
                $user_id = decrypt($user_id);
            }catch(DecryptException $e) {
                abort(404);
            }
        }
        
        if (empty($rank)) {
            $rank = 0;
        }
    
        $html=null;
        $root = Tree::where('user_id', $user_id)->first();
        $html .= '
        <div class="row">
        <div class="col-md-4">
        <table class="table">
            <tr>
                <th>Left Distributor</th>
                <th>Right Distributor</th>
                <th>Total Distributor</th>
            </tr>
            <tr>
                <td>'.$root->total_left_count.'</td>
                <td>'.$root->total_right_count.'</td>
                <td>'.$root->total_pair.'</td>
            </tr>
        </table>
        </div>
        </div>
        ';

        if($root){
            $level_checking = $this->levelCheck($user_id);
            $html .= '<ul>
            <li>        
                <a href="#"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$root->member->full_name.'<br> ('.$level_checking.')
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
                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$first_level_node->member->full_name.'<br> ('.$level_checking.')
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
                            $html.='<a href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$first_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$second_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$second_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$third_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$third_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$fourth_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                                    $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$fourth_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$fifth_level_node->member->full_name.'<br> ('.$level_checking.')
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
                                                            $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'"><img src="'.asset('admin/build/images/avatar.jpg').'">'.$fifth_level_node->member->full_name.'<br> ('.$level_checking.')
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
       
        return view('admin.tree',compact('html'));
    }

    public function levelCheck($id){
        $total_pair = Tree::where('user_id', $id)->value('total_pair');
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

    public function memberCommissionHistory(){
        return view('admin.commission_history');
    }
    public function memberCommissionHistoryList(){
        $query = DB::table('commission_histories')
            ->leftjoin('members', 'commission_histories.user_id', '=', 'members.id')
            ->select('commission_histories.*', 'members.full_name as user_name', 'members.login_id as login_id');
            return datatables()->of($query->get())
                ->addIndexColumn()
                ->addColumn('amount', function($row){
                    if($row->amount == 900){
                        $amt = '<span class="label label-success">'.$row->amount.'</span>';
                        return $amt;
                    }else{
                        $amt = '<span class="label label-warning">'.$row->amount.'</span>';
                        return $amt;
                    }
                    return $amt;
                })
                ->rawColumns(['amount'])
                ->make(true);
    }
    public function memberWallet(){
        return view('admin.wallet');
    }
    public function memberWalletList(){
        $query = DB::table('wallets')
            ->leftjoin('members', 'wallets.user_id', '=', 'members.id')
            ->select('wallets.*', 'members.full_name as user_name', 'members.login_id as login_id');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('admin.wallet_history', ['id' => encrypt($row->user_id)]).'" class="btn btn-primary" target="_blank"><i class="fa fa-th-list" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    public function memberWalletHistory($hId){
        try {
            $id = decrypt($hId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        
        return view('admin.wallet_history', compact('id'));
    }
    public function memberAjaxWalletHistory($pId){
        try {
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
    
        $query = DB::table('wallet_histories')
            ->leftjoin('members', 'wallet_histories.user_id', '=', 'members.id')
            ->select('wallet_histories.*', 'members.full_name as user_name', 'members.login_id as login_id')
            ->where('wallet_histories.user_id', $id);
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->make(true);
    
    }
}
