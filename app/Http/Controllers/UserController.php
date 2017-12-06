<?php

namespace App\Http\Controllers;

use App\User;
use App\Info;
use App\Message;
use App\Photo;
use App\Favorite;
use App\Dialog;
use File;
use App\Events\NewFavoriteAdded;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DateTime;

class UserController extends Controller
{
    //
    public function showProfile($id)
    {
        if(Auth::check()) {
            $user = Auth::user();

            /*$q1 = DB::table('messages')->select('receiver AS id')->where('user_id', $user->id)->groupBy('id');
            $q2 = DB::table('messages')->select('user_id AS id')->where('receiver', $user->id)->union($q1)->groupBy('id')->get();

            $list_dialogs = [];
            foreach($q2 as $dialog) {
                $list_dialogs[] = Message::where([
                    ['user_id', '=', $user->id],
                    ['receiver', '=', $dialog->id]
                ])->orWhere([
                    ['user_id', '=', $dialog->id],
                    ['receiver', '=', $user->id]
                ])->orderBy('created_at', 'desc')->first();
            }*/

            //
            // $list_dialogs = DB::select("SELECT * FROM `dialogs` WHERE `talkers` LIKE '1 %'");
            $list_dialogs = Dialog::where('talkers', 'like', "$user->id %")->orWhere('talkers', 'like', "% $user->id")->get();
//            $last_msgs = [];
            /*foreach($list_dialogs as $dialog) {
                $last_msgs[] = $dialog->lastMsg();
            }*/
//            $list_dialogs = $a->lastMsg;

        } else {
            $list_dialogs = null;
        }

        return view('profile', [
            'info' => Info::find($id),
            'list_dialogs' => $list_dialogs,
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
            $info->hobby = $request->input('input-saver');
            $info->love_too = $request->input('input-saver-love');
            $info->save();

            return redirect()->route('profile', ['id' => $id]);
        }

        return view('welcome');
    }

    // find personal info likes
    public function findWord(Request $request) {
        $word = $request->get('word');
        $column = $request->get('category');

        /* Send as JSON */
        header("Content-Type: application/json", true);

        /* Return JSON */
        if($word != '') {
            echo json_encode(['response' => DB::select("select `$column` FROM `personal_info` WHERE `$column` LIKE '$word%' GROUP BY `$column` LIMIT 10")]);
        }
    }

    public function findByName(Request $request) {
        $name = $request->name;

        $users = User::where('name', 'like', "$name%")->paginate(9);

        foreach($users as $user) {
            $fl = (!Auth::check()) ? "col-sm-6 col-md-4" : "col-md-6 col-lg-4";

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

        if($users->count()) {
            echo "</div><div class=\"pagination\">";

            echo $users->render();

            echo '</div>';
        }
    }

    public function findByOther(Request $request) {
        $name = $request->name;
        $status = $request->status;
        $children = $request->children;
        $hair = $request->hair;
        $eyes = $request->eye;
        $min_age = new DateTime();
        $min_age->modify('-' . $request->min_age . ' year');
//        echo $min_age->format('Y-m-d');
        $max_age = new DateTime();
        $max_age->modify('-' . $request->max_age . ' year');
//        echo $max_age->format('Y-m-d');
        $male = (Auth::user()->info->male == 'woman') ? 'man' : 'woman';
//        echo "min height: $request->min_height, max height: $request->max_height";

        $users = DB::table('users')
            ->join('personal_info', 'personal_info.user_id', '=', 'users.id')
            ->select('users.name', 'age', 'personal_info.id', 'personal_info.city', 'personal_info.country')
            ->where('users.name', 'like', "$name%")
            ->where('personal_info.male', '=', $male)
            ->where('personal_info.marital_status', '=', "$status")
            ->where('personal_info.children', '=', "$children")
//            ->whereBetween('personal_info.height', [$request->min_height, $request->max_height])
            ->whereBetween('personal_info.age', [$max_age, $min_age])
            ->whereBetween('personal_info.weight', [$request->min_weight, $request->max_weight])
//            ->where('personal_info.hair_color', '=', "$hair")
//            ->where('personal_info.eyes_color', '=', "$eyes")
            ->paginate(9);


        foreach($users as $user) {
            $fl = (Auth::check()) ? "col-sm-6 col-md-4" : "col-md-6 col-lg-4";

            echo "<div class=\"" . $fl . "\">" .
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

        if($users->count()) {
            echo "</div><div class=\"pagination\">";

            echo $users->render();

            echo '</div>';
        }
    }

    public function quickFind(Request $request) {

        $users = DB::table('users')
            ->join('personal_info', 'personal_info.user_id', '=', 'users.id')
            ->select('users.name', 'age', 'personal_info.id', 'personal_info.city', 'personal_info.country')
            ->where('users.name', 'like', "$request->name%")
            ->where('personal_info.marital_status', '=', "$request->status")
            ->where('personal_info.children', '=', "$request->children")
            ->take(8)->get();


        $userSpreaderForRow = "^--^";

	    foreach($users as $user) {

		    echo '<div class="single">' .
		         '<img src="' . '/images/s1.jpg' . '" alt="">' .
		         '<span class="online"></span>' .
		         '<div class="people-info">' .
		         '<div class="people-about">' .
		         '<p class="name">' . $user->name . ', <span class="age">00</span></p>' .
		         '<p class="address">' . $user->country . ', ' . $user->city . '</p>' .
		         '</div>' .
		         '<a href="#" class="get-chat">Get Chat</a>' .
		         '</div>' .
		         '<div class="people-options">' .
		         '<ul class="options-list">' .
		         '<li><a href="/profile/' . $user->id . '" class="show-user-profile">Show profile</a></li>' .
		         '</ul>' .
		         '</div>'.
		         '</div>'
		         . $userSpreaderForRow;

	    }

    }

    public function changeAvatar(Request $request) {
        $user = Auth::user();

         $this->validate($request, [
             'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
         ]);

         if($user->avatar() != 'default_ava.jpg') {
             File::delete('images/avatars/' . $user->avatar());
         }

        $image = $request->file('input_img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/avatars/' . $name);
        Image::make($image->getRealPath())->resize(400, 350, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath);
        Photo::updateOrCreate(
            ['user_id' => $user->id, 'type' => 'avatar'],
            ['name' => $name]
        );

        return redirect('profile/' . $user->info->id);
    }

    public function uploadGallery(Request $request) {
        $this->validate($request, [
            'gallery.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $images = $request->file('gallery');
        foreach($images as $image) {
            $filename  = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('/images/upload_gallery/' . $filename);
            Image::make($image->getRealPath())->resize(350, 350, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
            Photo::create([
                'user_id' => Auth::user()->id,
                'type' => 'gallery',
                'name' => $filename
            ]);
        }

        echo '+';

    }

    public function deleteGallery($photo) {
        $user = Auth::user();

        $del_photo = Photo::where('user_id', $user->id)->where('name', $photo)->first();
        if($del_photo) {
            $del_photo->delete();
            echo '+';
        } else {
            echo '-';
        }

    }

    public function showFavorites() {
        $user = Auth::user();

        $q1 = DB::table('messages')->select('receiver AS id')->where('user_id', $user->id)->groupBy('id');
        $q2 = DB::table('messages')->select('user_id AS id')->where('receiver', $user->id)->union($q1)->groupBy('id')->get();

        $list_dialogs = [];
        foreach($q2 as $dialog) {
            $list_dialogs[] = Message::where([
                ['user_id', '=', $user->id],
                ['receiver', '=', $dialog->id]
            ])->orWhere([
                ['user_id', '=', $dialog->id],
                ['receiver', '=', $user->id]
            ])->orderBy('created_at', 'desc')->first();
        }

        $favorite_users = Favorite::where('user_id', $user->id)->paginate(1);

        return view('favorites', [
            'list_dialogs' => $list_dialogs,
            'users' => $favorite_users
        ]);
    }

    public function addFavorite(Request $request) {
        $user = Auth::user();

        Favorite::create([
            'user_id' => $user->id,
            'favorite_id' => $request->user
        ]);

        event(
            new NewFavoriteAdded($user, $request->user)
        );

        /* Send as JSON */
        header("Content-Type: application/json", true);

        echo json_encode(['response' => $user->id]);
    }
}