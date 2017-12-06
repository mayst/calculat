<?php

namespace App\Http\Controllers;

use App\User;
use App\Info;
use App\Status;
use Illuminate\Http\Request;
use App\Mail\UserRegistration;
use App\Mail\SendContact;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function sent(Request $request) {
        $info = $request->input('info');

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password'))
        ]);

        Info::create([
            'id' => $info['id'],
            'user_id' => $user->id,
            'male' => $info['male'],
            'age' => $info['age'],
            'country' => $info['country'],
            'city' => $info['city'],
            'height' => $info['height'],
            'weight' => $info['weight'],
            'zodiac' => $info['zodiac'],
            'hair_color' => $info['hair_color'],
            'body_type' => $info['body_type'],
            'eyes_color' => $info['eyes_color'],
            'skin_color' => $info['skin_color'],
            'marital_status' => $info['marital_status'],
            'children' => $info['children'],
            'attitude_to_alcohol' => $info['attitude_to_alcohol'],
            'attitude_to_smoking' => $info['attitude_to_smoking'],
            'religious_views' => $info['religious_views'],
            'my_priorities' => $info['my_priorities']
        ]);

        Status::create([
            'user_id' => $user->id
        ]);

        Mail::to($request->input('email'))->send(new UserRegistration($user, $request->input('password'), $info['id']));

        return redirect('/lock/admin/users/' . $user->id . '/edit');
    }

    public function sendContact(Request $request) {
        $name = $request->name;
        $viber = $request->viber;
        $email = $request->email;
        $msg = $request->msg;

        Mail::to('info@dovedating.com')->send(new SendContact($name, $viber, $email, $msg));

        return redirect('/');
    }
}
