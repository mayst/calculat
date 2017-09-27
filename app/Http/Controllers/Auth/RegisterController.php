<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Info;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*$pass = str_random(8);
        $name = $data['name'];
        $email = $data['email'];*/

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'user',
            'password' => bcrypt($data['password'])
        ]);

        Info::create([
            'id' => $this->generate_id(),
            'user_id' => $user->id,
            'male' => 'man'
        ]);

//        Mail::to($data['email'])->send(new UserRegistration($user));

        return $user;
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
