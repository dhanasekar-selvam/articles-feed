<?php

namespace App\Http\Controllers;

use App\blocked;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\post;
use Session;
use DB;
use App\liked;

use Hash;

class DashboardController extends BaseController
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


        //  $posts = post::all()->where('name', '!=', $blockedarticle->articlename);
        //dd($posts);
        $login_type = filter_var($name, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'mobile_number';
        if ($login_type == 'email')  $user = DB::table('users')->where('email', $name)->first();
        else $user = DB::table('users')->where('mobile_number', $name)->first();

        Session::put('mobile', $user->mobile_number);
        Session::put('article', $user->article);
        Session::put('name', $user->first_name);
        Session::put('id', $user->id);


        return view('dashboard.view', compact(['posts']));
    }

    // public function Index()
    // {
    //     return view('dashboard/view');
    // }

    public function create()
    {
        $posts = new post();

        return view('dashboard.add', compact(['posts']));
    }

    public function logout()
    {
        Session::flush(); // removes all session data.

        return redirect(route('user.index'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'description' => 'required',
            'catagory' => 'required',

        ]);



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

        // Session::put('username', $post->name);

        ////////////////////////
        $post->save();

        return redirect(route('dashboard.list'));
    }

    public function edit()
    {
        $name = Session::get('username');

        //$posts = DB::table('post')->where('name', $name)->first();


        //$post = post::find($name); // getting a record using primary key 

        $posts = post::all()->where('username', $name);
        //dd($posts);



        return view('dashboard.edit', compact(['posts']));
    }





    public function view()
    {
        $name = Session::get('username');

        //$posts = DB::table('post')->where('name', $name)->first();


        //$post = post::find($name); // getting a record using primary key 

        $posts = post::all()->where('username', $name);
        // dd($posts);



        return view('dashboard.view', compact(['posts']));
    }

    public function like(Request $request)
    {
        $name = Session::get('username');

        $posts = liked::all()->where('likedby', $name);


        return view('dashboard.liked', compact(['posts']));
    }
}
