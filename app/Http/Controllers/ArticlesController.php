<?php

namespace App\Http\Controllers;

use App\blocked;
use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\post;
use Session;
use App\Users;
use Illuminate\Support\Facades\Auth;
use App\liked;
use App\unliked;
use Hash;

class ArticlesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function list()
    {

        $name = Session::get('username');


        $users = blocked::all();
        $user_names = [];

        foreach ($users as $user) {
            $user_names[$user->id] = $user->articlename;
        }

        $posts = post::select("*")->whereNotIn('name', array_values($user_names))->get();


        $login_type = filter_var($name, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'mobile_number';
        if ($login_type == 'email') $user = Users::all()->where('email', $name)->first();
        else $user = Users::all()->where('mobile_number', $name)->first();


        Session::put('mobile', $user->mobile_number);
        Session::put('article', $user->article);
        Session::put('name', $user->first_name);
        Session::put('id', $user->id);
        $user = Auth::user()->email;
        $likes = liked::all()->where('likedby', $user);
        $dislikes = unliked::all()->where('dislikedby', $user);


        return view('articles.view', compact(['posts', 'user', 'likes', 'dislikes']));
    }



    public function create()
    {
        $posts = new post();

        return view('articles.add', compact(['posts']));
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required',
            'catagory' => 'required',

        ]);
        $check = post::all()->where('name', $request->name)->first();

        if (empty($check)) {
            if (empty($request->id)) {
                // new recornd
                $post = new post();
            } else {
                // editing  existing record
                $post = post::find($request->id); // fetch a single record from db 
            }


            $name = Session::get('username');

            //DB table col name///==/// HTML form input name/////////
            $post->name         = $request->name;
            $post->description         = $request->description;
            $post->catagory = $request->catagory;
            $post->username = $name;


            $post->save();

            // $find = unliked::all()->where('dislikedby', $name)->first();
            // if (empty($find)) {
            $disliked = new unliked();
            //  } else {
            //     $disliked = unliked::find($request->name);
            //   }
            $disliked->articlename = $request->name;
            $disliked->dislikedby = $name;
            $disliked->save();
        } else {
            if ($check->name == $request->name) {


                throw ValidationException::withMessages(['field_name' => 'The article with this name is already posted']);
            }
        }




        return redirect(route('articles.list'));
    }

    public function edit()
    {
        $name = Session::get('username');
        $posts = post::all()->where('username', $name);
        return view('articles.editNext', compact(['posts']));
    }

    public function editNext($id)
    {
        $post = post::find($id);

        return view('articles.edit', compact(['post']));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'catagory' => 'required',

        ]);
        $post = post::find($request->id);
        $name = Auth::user()->email;

        $post->description         = $request->description;
        $post->catagory = $request->catagory;
        $post->username = $name;
        $post->save();
        return redirect(route('articles.list'));
    }

    public function view()
    {
        $name = Session::get('username');
        $posts = post::all()->where('username', $name);
        $user = Auth::user()->email;
        $likes = liked::all();
        $dislikes = unliked::all()->where('dislikedby', $user);

        return view('articles.view', compact(['posts', 'user', 'likes', 'dislikes']));
    }
    // public function like(Request $request)
    // {
    //     $name = Session::get('username');
    //     $posts = liked::all()->where('likedby', $name);
    //    return view('articles.liked', compact(['posts']));
    // }
    public function delete($id)
    {

        $post = post::find($id);
        $user = Auth::user()->email;
        $likedd = liked::all()->where('likedby', $user)->first();
        $unlikedd = unliked::all()->where('dislikedby', $user)->first();
        if (empty($likedd)) {
            $disliked = unliked::find($unlikedd->id);

            $disliked->delete();
        } else {
            $liked = liked::find($likedd->id);
            $liked->delete();
        }









        if (!empty($post->id)) {

            $post->delete();
        }

        return redirect(route('articles.edit'));
    }

    public function logout()
    {
        Session::flush(); // removes all session data.
        return redirect(route('user.index'));
    }
}
