<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class MemberDashboardController extends Controller
{
    public function index()
    {
        return view('member.dashboard');
    }

    public function addNewMemberForm()
    {
        return view('member.registration.member_registration_form');
    }

    public function addNewMember(Request $request)
    {

    }

    public function searchSponsorID(Request $request){
        if($request->ajax()){
            $sponsorID = $request->get('query');
            if(!empty($sponsorID)) {
                $member_data = DB::table('members')->where('sponsorID', $sponsorID)->first();
                if($member_data) {
                    $tree_data = DB::table('trees')->where('user_id', $member_data->id)->first();
                    if($tree_data){
                        if(is_null($tree_data->left_id) && is_null($tree_data->right_id)){
                            $html = '
                            <label>
                                <font color="green">Yay! Both lags are empty</font>
                            </label><br>
                            <label for="gender"> Name</label>
                            <input type="text" value="'.$member_data->full_name.'" class="form-control" readonly placeholder="Name">
                            <label for="gender">Mobile</label>
                            <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                            <label for="gender">DOB</label>
                            <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                            <label class="control-label ">Select Lag*</label>
                              <div id="lag">
                                  <input type="radio" name="lag" value="1" id="left_lag" checked> Left &nbsp;
                                  <input type="radio" name="lag" value="2" id="right_lag"> Right
                              </div>';
                            echo $html;
                        }
                        else if(is_null($tree_data->left_id)){
                            $html = '
                            <label>
                                <font color="green">Left lag is empty!</font>
                            </label><br>
                            <label for="gender"> Name</label>
                            <input type="text" value="'.$member_data->name.'" class="form-control" readonly placeholder="Name">
                            <label for="gender">Mobile</label>
                            <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                            <label for="gender">DOB</label>
                            <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                            <label class="control-label ">Select Lag*</label>
                              <div id="lag">
                                  <input type="radio" name="lag" value="1" id="left_lag" checked> Left &nbsp;
                                  <input type="radio" name="lag" value="2" id="right_lag" disabled> Right
                              </div>';
                            return $html;
                        }
                        else if(is_null($tree_data->right_id)){
                            $html = '
                            <label>
                                <font color="green">Right lag is empty!</font>
                            </label><br>
                            <label for="gender"> Name</label>
                            <input type="text" value="'.$member_data->name.'" class="form-control" readonly placeholder="Name">
                            <label for="gender">Mobile</label>
                            <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                            <label for="gender">DOB</label>
                            <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                            <label class="control-label ">Select Lag*</label>
                              <div id="lag">
                                  <input type="radio" name="lag" value="1" id="left_lag" disabled> Left &nbsp;
                                  <input type="radio" name="lag" value="2" id="right_lag" checked> Right
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
}
