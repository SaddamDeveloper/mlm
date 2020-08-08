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
                            if($package_name == 1){
                                $pk = 1;
                                if($funds->amount > 1099){
                                    $fund = DB::table('total_funds')
                                        ->where('user_id', Auth::user()->id)
                                        ->update([
                                            'amount' => ($funds->amount - 1099),
                                        ]);
                                        $fund_history = new FundHistory;
                                        $fund_history->amount = "1099";
                                        $fund_history->user_id = Auth::user()->id;
                                        $fund_history->comment = "Rs 1099 Fund has been debited";
                                        $fund_history->status = "2";
                                        $fund_history->save();
                                        // Update Tree 
                                        if($package->save()){
                                            $trees = Tree::where('user_id', $members->id)->first();
                                            $updateTree = DB::table('trees')
                                            ->where('user_id', $trees->user_id)
                                            ->update([
                                                'status' => '1'
                                                ]);
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
                                            $this->treePair($parrents, $members->id, $pk);
                                        }else {
                                            throw new \Exception('Exception message');
                                        }
                                }else {
                                    throw new \Exception('Exception message');
                                }            
                            }elseif ($package_name == 2) {
                                $pk = 2;
                                if($funds->amount > 2199){
                                    $fund = DB::table('total_funds')
                                        ->where('user_id', Auth::user()->id)
                                        ->update([
                                            'amount' => ($funds->amount - 2199),
                                        ]);

                                        $fund_history = new FundHistory;
                                        $fund_history->amount = "1099";
                                        $fund_history->user_id = Auth::user()->id;
                                        $fund_history->comment = "Rs 1099 Fund has been debited";
                                        $fund_history->status = "2";
                                        $fund_history->save();
                                    if($package->save()){
                                        $members = Member::where('login_id', $member_id)->first();
                                        $trees = Tree::where('user_id', $members->id)->first();
                                        $updateTree = DB::table('trees')
                                        ->where('user_id', $trees->user_id)
                                        ->update([
                                            'status' => '1'
                                            ]);
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
                                        $this->treePair($parrents, $members->id, $pk);
                                    }else {
                                        throw new \Exception('Exception message');
                                    }
                                }else{
                                    throw new \Exception('Exception message');
                                }
                            }elseif ($package_name == 3) {
                                $pk = 3;
                                if($funds->amount > 2500){
                                    $fund = DB::table('total_funds')
                                        ->where('user_id', Auth::user()->id)
                                        ->update([
                                            'amount' => ($funds->amount - 2500),
                                        ]);

                                        $fund_history = new FundHistory;
                                        $fund_history->amount = "1099";
                                        $fund_history->user_id = Auth::user()->id;
                                        $fund_history->comment = "Rs 1099 Fund has been debited";
                                        $fund_history->status = "2";
                                        $fund_history->save();
                                    if($package->save()){
                                        $members = Member::where('login_id', $member_id)->first();
                                        $trees = Tree::where('user_id', $members->id)->first();
                                        $updateTree = DB::table('trees')
                                        ->where('user_id', $trees->user_id)
                                        ->update([
                                            'status' => '1'
                                            ]);
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
                                            $this->treePair($parrents, $members->id, $pk);
                                    }else {
                                        throw new \Exception('Exception message');
                                    }
                                }else{
                                    throw new \Exception('Exception message');
                                }
                            }elseif ($package_name == 4) {
                                $pk = 4;
                                if($funds->amount > 5500){
                                    $fund = DB::table('total_funds')
                                        ->where('user_id', Auth::user()->id)
                                        ->update([
                                            'amount' => ($funds->amount - 5500),
                                        ]);

                                        $fund_history = new FundHistory;
                                        $fund_history->amount = "1099";
                                        $fund_history->user_id = Auth::user()->id;
                                        $fund_history->comment = "Rs 1099 Fund has been debited";
                                        $fund_history->status = "2";
                                        $fund_history->save();
                                    if($package->save()){
                                        $members = Member::where('login_id', $member_id)->first();
                                        $trees = Tree::where('user_id', $members->id)->first();
                                        $updateTree = DB::table('trees')
                                        ->where('user_id', $trees->user_id)
                                        ->update([
                                            'status' => '1'
                                            ]);
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
                                            $this->treePair($parrents, $members->id, $pk);
                                    }else {
                                        throw new \Exception('Exception message');
                                    }
                                }else{
                                    throw new \Exception('Exception message');
                                }
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
    function treePair($parents, $member_insert, $pk){
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
                    'activate_left' => DB::raw("`activate_left`+".($pk)),
                    'total_activate_left' => DB::raw("`total_activate_left`+".($pk)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
            }else{
                //Check Right count already had previous value
                $update_right_count = DB::table('trees')
                ->where('id', $parent)
                ->update([
                    'activate_right' => DB::raw("`activate_right`+".($pk)),
                    'total_activate_right' => DB::raw("`total_activate_right`+".($pk)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
            }   
            
            //Fetch Pair Match
            $pair_match = DB::table('trees')
                ->select('activate_left', 'activate_right', 'status')
                ->where('id',$parent)->lockForUpdate()
                ->first();
            // Check member is activated or not

            if($pair_match->status == 1){
                //Check 1:1 Check
                if($pair_match->activate_right > 0 && $pair_match->activate_left  > 0){
                    $a = $this->creditCommisionOneIsToOne($parent,$pk);
                    $total_pair_update = DB::table('trees')
                    ->where('id', $parent)
                    ->update([
                        'activate_pair' => DB::raw("`activate_pair`+".($pk)),
                    ]);
                   
                     //Pair checking
                    $total_pair_count =  DB::table('trees')
                        ->select('activate_pair')
                        ->where('id',$parent)
                        ->first();
                    // $this->rewardsChecking($total_pair_count, $parent);
                }
            }else{
                return redirect()->back()->with('error', 'You aint activated! You cannot activate other');
            }
            $child = $parent;
        }
        return true;
    }
    function creditCommisionOneIsToOne($parent,$pk){
        //Insert Comission Data
        $update_left_right_count = DB::table('trees')
            ->where('id', $parent)
            ->update([
                'activate_left' => DB::raw("`activate_left`-".($pk)),
                'activate_right' => DB::raw("`activate_right`-".($pk)),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
        //Fetch User with Node ID
        $fetch_tree = DB::table('trees')
            ->where('id',$parent)->lockForUpdate()
            ->first();        
        
        // Member Commission Logic
        for ($i=0; $i < $pk ; $i++) { 
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
                    'pair_number' => ($fetch_tree->activate_pair+1),
                    'amount' => $earning,
                    'comment' => $earning.' income of pair number '.($fetch_tree->activate_pair+1).' is generated! ',
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
                        'comment'   => $earning.' income of pair number'.($fetch_tree->activate_pair+1).' is generated! ',
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                    ]);
        }
    return true;
}
    // public function fundDeduct($funds, $package_name)
    // {
    //     if($package_name == 1){
    //         if($funds->available_fund > 1099){
    //             $fund = DB::table('funds')
    //                 ->where('alloted_to', Auth::user()->id)
    //                 ->update([
    //                     'fund' => ($funds->available_fund - 1099),
    //                     'available_fund' => ($funds->available_fund - 1099)
    //                 ]);
    //         }else {
    //             return redirect()->back()->with('error', 'Insufficient Funds!');
    //         }            
    //     }elseif ($package_name == 2) {
    //         $fund = DB::table('funds')
    //             ->where('alloted_to', Auth::user()->id)
    //             ->update([
    //                 'fund' => ($funds->available_fund - 2199),
    //                 'available_fund' => ($funds->available_fund - 2199)
    //             ]);
    //     }elseif ($package_name == 3) {
    //         $fund = DB::table('funds')
    //         ->where('alloted_to', Auth::user()->id)
    //         ->update([
    //             'fund' => ($funds->available_fund - 2500),
    //             'available_fund' => ($funds->available_fund - 2500)
    //         ]);
    //     }

    //     return 1;
    // }
}
