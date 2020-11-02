<?php

namespace App\Http\Controllers\Admin\Wallet;

use App\Http\Controllers\Controller;
use App\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(){
        $wallets = Wallet::whereStatus(1)->where('amount', '>=', '500')->get();
        return view('admin.wallet.payable', compact('wallets'));
    }

}
