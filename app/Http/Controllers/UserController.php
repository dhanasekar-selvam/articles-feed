<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Users;
use Session;
use App\post;

use App\liked;
use App\unliked;
use App\blocked;
use Hash;
use Auth;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index(Request $request)
    {
        return view('welcome');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'mobile_number';

        $request->merge([
            $login_type => $request->input('login')
        ]);


        // if ($login_type == 'email') {
        //     $check = Users::all()->where('email', $request->login)->pluck('email');
        //     if ($check->isEmpty()) {
        //         return redirect(route('user.index'))
        //             ->withErrors([
        //                 'login' => 'Account not found.',
        //             ]);
        //     }
        //     $password = Users::all()->where('email', $request->login)->pluck('password');

        //     $check = Hash::check($request->password, $password[0]);
        //     if ($check == "true") {
        //         Session::put('username', $request->login);
        //         return redirect(route('articles.list'));
        //     } else {
        //         return redirect(route('user.index'))
        //             ->withErrors([
        //                 'login' => 'Invalid Username/Password.',
        //             ]);
        //     }
        // }

        // if ($login_type == 'mobile_number') {
        //     $check = Users::all()->where('mobile_number', $request->login)->pluck('mobile_number');

        //     if ($check->isEmpty()) {
        //         return redirect(route('user.index'))
        //             ->withErrors([
        //                 'login' => 'Account not found.',
        //             ]);
        //     }
        //     $password = Users::all()->where('mobile_number', $request->login)->pluck('password');


        //     $check = Hash::check($request->password, $password[0]);
        //     if ($check == "true") {
        //         Session::put('username', $request->login);
        //         return redirect(route('articles.list'));
        //     } else {
        //         return redirect(route('user.index'))
        //             ->withErrors([
        //                 'login' => 'Invalid Username/Password.',
        //             ]);
        //     }
        // }




        if (Auth::attempt($request->only($login_type, 'password'))) {
            Session::put('username', $request->login);
            return redirect(route('articles.list'));
        }

        return redirect(route('user.index'))
            ->withErrors([
                'login' => 'These credentials do not match our records.',
            ]);
    }






    public function create()
    {
        $user = new Users();

        return view('register.signup', compact(['user']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:1|max:50',
            'mobile_number' => 'required|max:10',
            'email' => 'required',
            'dob' => 'required',
            'password' => 'required|confirmed|min:6',
            'articles' => 'required',

        ]);



        if (empty($request->id)) {
            // new recornd
            $user = new Users();
        } else {
            // editing  existing record
            $user = Users::find($request->id); // fetch a single record from db 
        }
        $hashedPassword = Hash::make($request->password);


        //DB table col name///==/// HTML form input name/////////
        $user->first_name         = $request->first_name;
        $user->last_name         = $request->last_name;
        $user->dob = $request->dob;
        $user->mobile_number        = $request->mobile_number;
        $user->email        = $request->email;
        $user->password        = $hashedPassword;
        $user->article  = $request->articles;


        ////////////////////////
        $user->save();

        return redirect(route('user.index'));
    }

    public function edit(Request $request)
    {
        $id = $request->idd;



        $users = Users::all()->where('id', $id);



        return view('register.edit', compact(['users']));
    }

    public function like(Request $request)
    {
        $id = $request->id;

        $postt = post::all()->where('id', $id)->first();

        $articlename = $postt->name;

        $again = liked::all()->where('articlename', $articlename)->first();

        $likedby = Session::get('username');


        if (empty($again->id)) {
            // new record
            $post = new liked();
            $postname = $postt->name;
        } else {
            // editing  existing record
            $post = liked::find($again->id);
            // fetch a single record from db 
            $postname = $post->articlename;
        }

        $post->articlename         = $postname;
        $post->likedby         = $likedby;
        $post->description = $postt->description;
        $post->catagory = $postt->catagory;
        $post->name = $postt->name;

        $post->save();

        // $user = Auth::user()->email;
        $unlikedarticle = unliked::all()->where('articlename', $articlename)->first();
        if (empty($unlikedarticle->id)) {
            Session::put('liked', 'You liked this post');
        } else {
            $del = unliked::find($unlikedarticle->id);
            $del->delete();
        }
        return redirect(route('articles.list'));
    }
    public function dislike(Request $request)
    {
        $id = $request->id;
        $postt = post::all()->where('id', $id)->first();

        $articlename = $postt->name;

        $again = unliked::all()->where('articlename', $articlename)->first();

        $dislikedby = Session::get('username');

        if (empty($again->id)) {
            // new record
            $post = new unliked();
            $postname = $postt->name;
        } else {
            // editing  existing record
            $post = unliked::find($again->id);
            // fetch a single record from db 
            $postname = $post->articlename;
        }

        $post->articlename         = $postname;
        $post->dislikedby         = $dislikedby;

        $post->save();

        $likedarticle = liked::all()->where('name', $articlename)->first();

        if (empty($likedarticle->id)) {
            return redirect(route('articles.list'));
        } else {
            $del = liked::find($likedarticle->id);
            $del->delete();
        }
        return redirect(route('articles.list'));
    }
    public function block(Request $request)
    {
        $id = $request->id;
        $postt = post::all()->where('id', $id)->first();
        $articlename = $postt->name;
        $again = blocked::all()->where('articlename', $articlename)->first();

        // $idd = $again->id;
        $blockedby = Session::get('username');


        if (empty($again->id)) {
            // new recornd
            $post = new blocked();
            $postname = $postt->name;
        } else {
            // editing  existing record
            $post = blocked::find($again->id);
            // fetch a single record from db 
            $postname = $post->articlename;
        }

        $post->articlename         = $postname;
        $post->blockedby         = $blockedby;

        $post->save();
        Session::put('block', 'blocked');


        return redirect(route('articles.list'));
    }
}
