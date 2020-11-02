<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

        protected $guard = 'member';
        protected $table = 'members';
        protected $primary_key = "id";
        protected $fillable = [
            'login_id', 'sponsorID', 'full_name', 'dob', 'email', 'mobile', 'pan', 'aadhar', 'address', 'bank_name', 'ac_holder_name', 'ifsc', 'account_no', 'status'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        public function tree()
        {
            return $this->hasOne('App\Tree', 'id');
        }

        public function package()
        {
            return $this->hasOne('App\Package', 'id');
        }

        public function wallet()
        {
            return $this->hasOne('App\Wallet');
        }
}
