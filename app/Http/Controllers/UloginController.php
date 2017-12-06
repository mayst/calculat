<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use App\Info;
use Illuminate\Http\Request;
use Redirect;

class UloginController extends Controller
{
    // Login user through social network.
    public function login(Request $request)
    {
        // Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, TRUE);

//        $network = $user['network'];

        // Find user in DB.
        $user = User::where('email', $user['email'])->first();

        // Check exist user.
        if (isset($user->id)) {

            // Check user status.
            if ($user->status) {

                // Make login user.
                Auth::loginUsingId($user->id, TRUE);
            }
            // Wrong status.
            else {
//                \Session::flash('flash_message_error', trans('interface.AccountNotActive'));
            }

            return Redirect::back();
        }

        // Make registration new user.
        else {

            // Create new user in DB.
            /*$newUser = User::create([
                'nik' => $user['nickname'],
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'avatar' => $user['photo'],
                'email' => $user['email'],
                'password' => Hash::make(),
                'role' => 'user',
                'status' => TRUE,
                'ip' => $request->ip()
            ]);*/

            $user = User::create([
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'email' => $user['email'],
                'role' => 'user',
                'password' => bcrypt(str_random(8))
            ]);

            Info::create([
                'id' => $this->generate_id(),
                'user_id' => $user->id,
                'male' => 'man',
                'age' => $user['bdate'],
                'country' => $user['country'],
                'city' => $user['city']
            ]);

            //        Mail::to($data['email'])->send(new UserRegistration($user));

            // Make login user.
            Auth::loginUsingId($user->id, TRUE);

//            \Session::flash('flash_message', trans('interface.ActivatedSuccess'));

            return redirect('/profile/' . Auth::user()->info->id);
        }
    }

    protected function generate_id()
    {
        do {
            $number = mt_rand(10000000, 99999999);
        }
        while(User::where('id', $number)->first());

        return $number;
    }
}
