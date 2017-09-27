<?php

namespace App\Http\Controllers;

use App\User;
use App\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function showProfile($id)
    {
        return view('profile', [
            'info' => Info::find($id)
        ]);
    }

    public function updateProfile(Request $request, $id) {
        $user = Auth::user();

        if($id == $user->info->id) {
            $info = Info::find($id);

            $user->name = $request->name;
            $user->save();

            $info->age = $request->age;
            $info->country = $request->country;
            $info->city = $request->city;
            $info->height = $request->height;
            $info->weight = $request->weight;
            $info->zodiac = $request->zodiac;
            $info->hair_color = $request->hair_color;
            $info->body_type = $request->body_type;
            $info->eyes_color = $request->eyes_color;
            $info->skin_color = $request->skin_color;
            $info->marital_status = $request->marital_status;
            $info->children = $request->childrens;
            $info->attitude_to_alcohol = $request->attitude_to_alcohol;
            $info->attitude_to_smoking = $request->attitude_to_smoking;
            $info->religious_views = $request->religious_views;
            $info->about_me = $request->about_me;
            $info->my_desire = $request->my_desire;
            $info->education = $request->education;
            $info->job = $request->job;
            $info->position = $request->position;
            $info->i_live = $request->i_live;
            $info->my_priorities = $request->my_priorities;
            $info->hobby = $request->hobby;
            $info->love_too = $request->love_too;
            $info->save();

            return redirect()->route('profile', ['id' => $id]);
        }

        return view('welcome');
    }

    public function findWord(Request $request) {
        $word = $request->get('word');
        $column = $request->get('category');

        /* Send as JSON */
        header("Content-Type: application/json", true);

        /* Return JSON */
        if($word != '') {
            echo json_encode(['response' => DB::select("select `$column` FROM `personal_info` WHERE `$column` LIKE '$word%' LIMIT 10")]);
        }
    }

    public function findByName(Request $request) {
        $name = $request->name;

        /* Send as JSON */
//        header("Content-Type: application/json", true);

        /* Return JSON */
        /*if($name != '') {
            echo json_encode(['response' => DB::select("select personal_info.id, `name`, `age`, `country`, `city`
                                                        FROM `users`
                                                        INNER JOIN `personal_info` ON users.id = personal_info.user_id 
                                                        WHERE users.name LIKE '$name%' ")->paginate(2)]);
        }*/

        /*$users = DB::select("select personal_info.id, `name`, `age`, `country`, `city`
                                                        FROM `users`
                                                        INNER JOIN `personal_info` ON users.id = personal_info.user_id 
                                                        WHERE users.name LIKE '$name%' ")->paginate(2);*/

        $users = User::where('name', 'like', "$name%")->paginate(1);

        $fl = (!Auth::check()) ? "col-sm-6 col-md-4" : "col-md-6 col-lg-4";

        foreach($users as $user) {
            echo "<div class=\"" . $fl . "\">" .
                "   <a href=\"/profile/" . $user->info->id . "\" class=\"single\">" .
                "    <img src=\"/images/s1.jpg\" alt=\"\">" .
                "       <span class=\"online\"></span>" .
                "       <object><a href=\"#\" class=\"star\"><i class=\"fa fa-star\" aria-hidden=\"true\"></i></a></object>" .
                "                            <div class=\"people-info\">" .
                "                                <div class=\"people-about\">" .
                "                                    <p class=\"name\">" . $user->name . ", <span class=\"age\">23</span></p>" .
                "                                    <p class=\"address\">" . $user->info->city . ", " . $user->info->country . "</p>" .
                "                                </div>" .
                "                                <object><a href=\"#\" class=\"get-chat\">Get Chat</a></object>" .
                "                            </div>" .
                "                            <div class=\"people-options\">" .
                "                            </div>" .
                "                        </a>" .
                "                    </div>";
        }

        echo "</div><div class=\"pagination\">";

//        $users->setPath('search');

        echo $users->render();

        echo '</div>';
    }

    public function findByOther(Request $request) {
        $name = $request->name;
        $status = $request->status;
        $position = $request->position;
        $height = $request->height;
        $age = $request->age;
        $weight = $request->weight;
        $hair = $request->hair;
        $eyes = $request->eye;
        $skin = $request->skin;

        /* Send as JSON */
//        header("Content-Type: application/json", true);

        /* Return JSON */
        /*if($name != '' || $status != '' || $position != '' || $height != '' || $age != '' ||
            $weight != '' || $hair != '' || $eyes != '' || $skin != '') {
            echo json_encode(['response' => DB::select("select `name`, `age`, `country`, `city`
                                                        FROM `users`
                                                        INNER JOIN `personal_info` ON users.id = personal_info.user_id 
                                                        WHERE users.name LIKE '$name%' 
                                                        AND personal_info.marital_status = '$status'
                                                        AND personal_info.position = '$position'
                                                        AND personal_info.height = '$height'
                                                        AND personal_info.age = '$age'
                                                        AND personal_info.weight = '$weight'
                                                        AND personal_info.hair = '$hair'
                                                        AND personal_info.eyes = '$eyes'
                                                        AND personal_info.skin = '$skin'")->paginate(1)]);
        }*/

        $users = DB::table('users')
                        ->join('personal_info', 'personal_info.user_id', '=', 'users.id')
                        ->select('users.name', 'age', 'personal_info.id', 'personal_info.city', 'personal_info.country')
                        ->where('users.name', 'like', "$name%")
                        ->where('personal_info.marital_status', '=', "$status")
                        ->where('personal_info.position', '=', "$position")
                        ->where('personal_info.height', '=', "$height")
                        ->where('personal_info.age', '=', "$age")
                        ->where('personal_info.weight', '=', "$weight")
                        ->where('personal_info.hair_color', '=', "$hair")
                        ->where('personal_info.eyes_color', '=', "$eyes")
                        ->where('personal_info.skin_color', '=', "$skin")
                        ->paginate(1);

        $fl = (Auth::check()) ? "col-sm-6 col-md-4" : "col-md-6 col-lg-4";

        foreach($users as $user) {
            echo "<div class=\"" . (Auth::check()) ? "col-sm-6 col-md-4" : "col-md-6 col-lg-4" . "\">" .
                "   <a href=\"/profile/" . $user->id . "\" class=\"single\">" .
                "    <img src=\"/images/s1.jpg\" alt=\"\">" .
                "       <span class=\"online\"></span>" .
                "       <object><a href=\"#\" class=\"star\"><i class=\"fa fa-star\" aria-hidden=\"true\"></i></a></object>" .
                "                            <div class=\"people-info\">" .
                "                                <div class=\"people-about\">" .
                "                                    <p class=\"name\">" . $user->name . ", <span class=\"age\">23</span></p>" .
                "                                    <p class=\"address\">" . $user->city . ", " . $user->country . "</p>" .
                "                                </div>" .
                "                                <object><a href=\"#\" class=\"get-chat\">Get Chat</a></object>" .
                "                            </div>" .
                "                            <div class=\"people-options\">" .
                "                            </div>" .
                "                        </a>" .
                "                    </div>";
        }

        echo "</div><div class=\"pagination\">";

//        $users->setPath('search');

        echo $users->render();

        echo '</div>';
    }
}