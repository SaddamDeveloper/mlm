<?php

namespace App\Http\Controllers\Admin\Reward;

use App\Http\Controllers\Controller;
use App\Member;
use App\Rewards;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index(){
        return view('admin.reward.index');
    }

    public function list(){
        $query = Rewards::orderBy('created_at', 'DESC');
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->addColumn('name', function($row){
            $member = Member::find($row->user_id);
            return $member->full_name;
        })
        ->rawColumns(['name'])
        ->make(true);
    }
}
