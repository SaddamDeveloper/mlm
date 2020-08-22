<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fund;
use Auth;
use App\Member;
use App\Package;
use App\AdminPackage;
use DB;
use App\Tree;
use Carbon\Carbon;
use App\AdminWalletHistory;
use App\AdminTdsesHistory;
use App\TotalFund;
use App\FundHistory;
class MemberActivationController extends Controller
{
    public function memberActivatePageDetails()
    {
        return view('member.activate_details');
    }

    public function memberAddActivation()
    {
        $member = Member::where('id', Auth::user()->id)->first();
        $fund = TotalFund::where('user_id', Auth::user()->id)->first();
        $package = AdminPackage::orderBy('created_at', 'ASC')->get();
        return view('member.activation', compact('member', 'fund', 'package'));
    }

    public function addPackage(Request $request){
        $this->validate($request, [
            'member_id'=> 'required',
            'package'=> 'required'
        ]);
        $member_id = $request->input('member_id');
        $package_name = $request->input('package');
        $member = Member::where('login_id', $member_id);
        if($member->count() > 0 ){
            
            $members = $member->first();
            $package = Package::where('login_id', $member_id)->count();
                if($package < 1){
                    try {
                        DB::transaction(function () use($package_name, $member_id, $members) {
                            $package = new Package;
                            $package->package_name = $package_name;
                            $package->login_id = $member_id;
                            $package->added_by = Auth::user()->full_name;
                            $funds = TotalFund::where('user_id', Auth::user()->id)->first();
                            $total_bv = 0;
                            if($package_name == 1){
                                $total_bv = 1;
                                $p_price = AdminPackage::where('id',1)->first();
                            }elseif ($package_name == 2) {
                                $total_bv = 2;
                                $p_price = AdminPackage::where('id',2)->first();
                            }elseif ($package_name == 3){
                                $total_bv = 3;
                                $p_price = AdminPackage::where('id',3)->first();
                            }elseif ($package_name == 4){
                                $total_bv = 4;
                                $p_price = AdminPackage::where('id',4)->first();
                            }

                            if($funds->amount >= $p_price->price && $total_bv > 0){
                                $fund = DB::table('total_funds')
                                ->where('user_id', Auth::user()->id)
                                ->update([
                                    'amount' => ($funds->amount - $p_price->price),
                                ]);
                                $fund_history = new FundHistory;
                                $fund_history->amount = $p_price->price;
                                $fund_history->user_id = Auth::user()->id;
                                $fund_history->comment = "Rs $p_price->price Fund has been debited";
                                $fund_history->status = "2";
                                $fund_history->save();
                                
                                if($package->save()){
                                    $trees = Tree::where('user_id', $members->id)->first();
                                    $parrents = DB::select( DB::raw("SELECT * FROM (
                                        SELECT @pv:=(
                                            SELECT parent_id FROM trees WHERE id = @pv 
                                            ) AS lv FROM trees
                                            JOIN
                                            (SELECT @pv:=:start_node) tmp
                                        ) a
                                        WHERE lv IS NOT NULL AND lv != 0 LIMIT 1000 FOR UPDATE")
                                        , array(
                                            'start_node' => $trees->id,
                                            )
                                        );
                                    $chield = $trees->id;
                                    if (!empty($parrents)) {
                                        
                                        foreach ($parrents as $key => $value) {
                                            $parent = Tree::where('id', $value->lv)->first();
                                            if ($parent->status == '1') {
                                                if ($parent->left_id == $chield) {
                                                    //Check Left count already had previous value + 1
                                                        $update_left_count = DB::table('trees')
                                                        ->where('id', $value->lv)
                                                        ->update([
                                                            'activate_left' => DB::raw("`activate_left`+".($total_bv)),
                                                            'total_activate_left' => DB::raw("`total_activate_left`+".($total_bv)),
                                                            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                                                        ]);
                                                        $lesser_bv = ($parent->activate_left+$total_bv) >= $parent->activate_right ? $parent->activate_right : ($parent->activate_left+$total_bv);
                                                        if ($lesser_bv > 0) {
                                                            $update_left_count = DB::table('trees')
                                                            ->where('id', $value->lv)
                                                            ->update([
                                                                'activate_left' => DB::raw("`activate_left`-".($lesser_bv)),
                                                                'activate_right' => DB::raw("`activate_right`-".($lesser_bv)),
                                                                'activate_pair' => DB::raw("`activate_pair`+".($lesser_bv)),
                                                                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                                                            ]);
                                                            $this->creditCommisionOneIsToOne($parent->user_id, $lesser_bv);
                                                        }

                                                } else if($parent->right_id == $chield){
                                                    //Check Left count already had previous value + 1
                                                    $update_right_count = DB::table('trees')
                                                    ->where('id', $value->lv)
                                                    ->update([
                                                        'activate_right' => DB::raw("`activate_right`+".($total_bv)),
                                                        'total_activate_right' => DB::raw("`total_activate_right`+".($total_bv)),
                                                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                                                    ]);
                                                    $lesser_bv = ($parent->activate_right+$total_bv) >= $parent->activate_left ? $parent->activate_left : ($parent->activate_right+$total_bv);
                                                    if ($lesser_bv > 0) {
                                                        $update_right_count = DB::table('trees')
                                                        ->where('id', $value->lv)
                                                        ->update([
                                                            'activate_right' => DB::raw("`activate_right`-".($lesser_bv)),
                                                            'activate_left' => DB::raw("`activate_left`-".($lesser_bv)),
                                                            'activate_pair' => DB::raw("`activate_pair`+".($lesser_bv)),
                                                            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                                                        ]);
                                                        $this->creditCommisionOneIsToOne($parent->user_id, $lesser_bv);
                                                        $total_pair_count =  DB::table('trees')
                                                            ->select('activate_pair')
                                                            ->where('id',$parent->user_id)
                                                            ->first();
                                                        $this->rewardsChecking($parent->user_id, $total_pair_count);
                                                    }

                                                }
                                            }
                                            $chield = $value->lv;
                                        }
                                        $updateTree = DB::table('trees')
                                            ->where('user_id', $trees->user_id)
                                            ->update([
                                                'status' => '1'
                                            ]);
                                    }
                                }else {
                                    throw new \Exception('Exception message');
                                }

                            }else {
                                throw new \Exception('Exception message');
                            }
                        });
                        return redirect()->back()->with('message', ' Member successfully activated!');
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
                    }
                }else { 
                    return redirect()->back()->with('error', 'You are already activated to the package');
                }
        }else{
            return redirect()->back()->with('error','Member Not Found!');
        }
    }

    public function distributorDetails(Request $request)
    {
        if($request->ajax()){
            $query = Package::orderBy('id','desc')->where('added_by', Auth::user()->full_name);
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('package_name', function($row){
                $package = AdminPackage::find($row->package_name);
                return $package->package_name;
            })
            ->rawColumns(['package_name'])
            ->make(true);
        }
    }
    
function creditCommisionOneIsToOne($user_id, $totalbv){   
        // Admin Commission Fetch
        $adminCommissionFetch = DB::table('admin_commissions')->first();
        $adminTdsFetch = DB::table('admin_tds')->first();
        $adminCommission = ((200 * $totalbv) * $adminCommissionFetch->commission)/100;   
        $tdsCommission = ((200 * $totalbv) * $adminTdsFetch->tds)/100;
        $earning =  (200 * $totalbv) - ($adminCommission + $tdsCommission);
        
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
        // Admin TDS Insert
        $admin_tds_insert = DB::table('admin_tdses')->where('role', '1')
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
            ->where('user_id', $user_id)
            ->update([
                'amount' => DB::raw("`amount`+".($earning)),
            ]);

        //Fetch Wallet
        $fetch_wallet = DB::table('wallets')->where('user_id', $user_id)->first();
        
        $credit_commision = DB::table('commission_histories')
                ->insertGetId([
                    'user_id' => $user_id,
                    'amount' => $earning,
                    'comment' => "Commission Rs. ".$earning.'  is credited',
                    'status' => 1,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                    ]);
        $credit_commision_to_wallet = DB::table('wallet_histories')
            ->insertGetId([
                'wallet_id' =>  $fetch_wallet->id,
                'user_id'   => $user_id,
                'transaction_type'  =>  1,
                'amount' => $earning,
                'total_amount'  => $fetch_wallet->amount,
                'comment'   => "Commission Rs. ".$earning.'  is credited',
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
    return true;
}

function rewardsChecking($user_id, $total_pair_count)
{
    if($total_pair_count->activate_pair == 10){
        $rewards = new Rewards;
        $rewards->user_id = $parent;
        $rewards->comment = "Congratulations! You are the winner of Casserol 2500 ml reward for 10 BV";
        $rewards->save();
    }

    if($total_pair_count->activate_pair == 15){
            $rewards = new Rewards;
            $rewards->user_id = $parent;
            $rewards->comment = "Congratulations! You are the winner of Pressure Cooker reward for 15 BV";
            $rewards->save();
    }

    if($total_pair_count->activate_pair == 30){
            $rewards = new Rewards;
            $rewards->user_id = $parent;
            $rewards->comment = "Congratulations! You are the winner of Home Theater reward for 30 BV";
            $rewards->save();
    }

    if($total_pair_count->activate_pair == 70){
            $rewards = new Rewards;
            $rewards->user_id = $parent;
            $rewards->comment = "Congratulations! You are the winner of Safari Suitcase reward for 70 BV";
            $rewards->save();
    }

    if($total_pair_count->activate_pair == 120){
            $rewards = new Rewards;
            $rewards->user_id = $parent;
            $rewards->comment = "Congratulations! You are the winner of 4G Tablet reward for 120 BV";
            $rewards->save();
    }

    if($total_pair_count->activate_pair == 200){
            $rewards = new Rewards;
            $rewards->user_id = $parent;
            $rewards->comment = "Congratulations! You are the winner of 20'' LED TV reward for 200 BV";
            $rewards->save();
    }

    if($total_pair_count->activate_pair == 300){
            $rewards = new Rewards;
            $rewards->user_id = $parent;
            $rewards->comment = "Congratulations! You are the winner of 32'' LED TV reward for 300 BV";
            $rewards->save();
    }

    if($total_pair_count->activate_pair == 500){
            $rewards = new Rewards;
            $rewards->user_id = $parent;
            $rewards->comment = "Congratulations! You are the winner of Voltas 1.5 ton AC reward for 500 BV";
            $rewards->save();
    }
}
}
