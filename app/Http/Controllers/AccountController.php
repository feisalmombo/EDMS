<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
	public function change_password()
	{
		return view('account.change_password');
	}

	public function process_change_password(ChangePasswordRequest $request)
	{

		$name = Session::get('name');
		$password = $request->input('old_password');
		$new_password = $request->input('password');

		$user_credential = User::checkLogin($name, $password);

		if( ! $user_credential){

			
			flash()->error('You forgot old password.');
			return redirect('/account/change_password');
		}else{
			$user_credential = User::whereName($name)->first();

			$user_credential->password = Hash::make($new_password);

			$user_credential->save();

			flash()->success('You have been successfull change your password.');

			return redirect('/home');
		}

	}
}
