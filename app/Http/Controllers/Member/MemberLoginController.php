<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class MemberLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:member')->except('logout');
    }

    public function showMemberLoginForm(){
        return view('member.index', ['url' => 'member']);
    }

    public function memberLogin(Request $request){
        $this->validate($request, [
            'login_id'   => 'required',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('member')->attempt(['login_id' => $request->login_id, 'password' => $request->password])) {

            return redirect()->intended('/member/dashboard');
        }
        return back()->withInput($request->only('login_id', 'remember'))->with('login_error','Login ID or password is incorrect');
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route('member.login');
    }
}
