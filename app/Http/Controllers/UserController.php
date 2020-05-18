<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;
use Session;
use DB;
use App\liked;
use App\unliked;
use App\blocked;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index(Request $request)
    {

        $query = User::query();

        $query->when(isset($request->search), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . trim($request->search) . '%');
        });

        $users = $query->paginate(100);
        $users->appends(request()->query());

        return view('welcome', compact(['users']));
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
        if ($login_type == 'email') {
            $check = DB::table('users')->where('email', $request->login)->pluck('email');
            if ($check->isEmpty()) {
                return redirect(route('user.index'))
                    ->withErrors([
                        'login' => 'Account not found.',
                    ]);
            }
            $password = DB::table('users')->where('email', $request->login)->pluck('password');

            if ($password[0] == $request->password) {
                Session::put('username', $request->login);
                return redirect(route('dashboard.list'));
            } else {
                return redirect(route('user.index'))
                    ->withErrors([
                        'login' => 'Invalid Username/Password.',
                    ]);
            }
        }

        if ($login_type == 'mobile_number') {
            $check = DB::table('users')->where('mobile_number', $request->login)->pluck('mobile_number');
            if ($check->isEmpty()) {
                return redirect(route('user.index'))
                    ->withErrors([
                        'login' => 'Account not found.',
                    ]);
            }
            $password = DB::table('users')->where('mobile_number', $request->login)->pluck('password');

            if ($password[0] == $request->password) {
                Session::put('username', $request->login);
                return redirect(route('dashboard.list'));
            } else {
                return redirect(route('user.index'))
                    ->withErrors([
                        'login' => 'Invalid Username/Password.',
                    ]);
            }
        }



        // if (Auth::attempt($request->only($login_type, 'password'))) {
        //     return redirect()->intended($this->redirectPath());
        // }

        // return redirect(route('dashboard.list'))
        //     ->withErrors([
        //         'login' => 'These credentials do not match our records.',
        //     ]);
    }






    public function create()
    {
        $user = new User();

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
            $user = new User();
        } else {
            // editing  existing record
            $user = User::find($request->id); // fetch a single record from db 
        }


        //DB table col name///==/// HTML form input name/////////
        $user->first_name         = $request->first_name;
        $user->last_name         = $request->last_name;
        $user->dob = $request->dob;
        $user->mobile_number        = $request->mobile_number;
        $user->email        = $request->email;
        $user->password        = $request->password;
        $user->article  = $request->articles;


        ////////////////////////
        $user->save();

        return redirect(route('user.index'));
    }

    public function edit(Request $request)
    {
        $id = $request->idd;



        $users = User::all()->where('id', $id);



        return view('register.edit', compact(['users']));
    }

    public function like(Request $request)
    {
        $id = $request->id;
        $postt = DB::table('post')->where('id', $id)->first();
        $articlename = $postt->name;
        $again = DB::table('liked')->where('articlename', $articlename)->first();
        // $idd = $again->id;
        $likedby = Session::get('username');


        if (empty($again->id)) {
            // new recornd
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

        Session::put('liked', 'liked');
        return redirect(route('dashboard.list'));
    }
    public function dislike(Request $request)
    {
        $id = $request->id;
        $postt = DB::table('post')->where('id', $id)->first();
        $articlename = $postt->name;
        $again = DB::table('disliked')->where('articlename', $articlename)->first();
        // $idd = $again->id;
        $dislikedby = Session::get('username');

        if (empty($again->id)) {
            // new recornd
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
        Session::put('dislike', 'disliked');


        return redirect(route('dashboard.list'));
    }
    public function block(Request $request)
    {
        $id = $request->id;
        $postt = DB::table('post')->where('id', $id)->first();
        $articlename = $postt->name;
        $again = DB::table('blocked')->where('articlename', $articlename)->first();
        // $idd = $again->id;
        $blockedby = Session::get('username');


        // Session::put('blockedarticle', $again->articlename);


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


        return redirect(route('dashboard.list'));
    }
}
