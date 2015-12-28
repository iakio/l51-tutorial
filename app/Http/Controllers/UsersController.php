<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Flash;
use Log;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index', 'edit', 'update', 'destroy']]);
        $this->middleware('correct_user', ['only' => ['edit', 'update']]);
        $this->middleware('admin', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users/index')->with("users", User::paginate(30));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->paginate(30);
        return view('users/show')->with([
            "user" => $user,
            "microposts" => $microposts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users/edit')->with("user", $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validators = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,'.$id,
            'password' => 'required|confirmed|min:6',
        ];
        $attributes = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];

        $this->validate($request, $validators);
        if ($user->update($attributes)) {
            Flash::success("Profile updated");
            return redirect(action('UsersController@show', $user->id));
        }
        return view('users/edit')->with("user", $user);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        Flash::success('User destroyed.');
        return redirect('users');
    }

    public function following($id)
    {
        $user = User::findOrFail($id);
        return view('users/show_follow')
            ->with([
                'title' => 'Following',
                'user' => $user,
                'users' => $user->followed_users()->paginate()
            ]);
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        return view('users/show_follow')
            ->with([
                'title' => 'Followers',
                'user' => $user,
                'users' => $user->followers()->paginate()
            ]);
    }

    public function follow($id)
    {
        $user = User::findOrFail($id);
        \Auth::user()->follow($user);
        return redirect(action('UsersController@show', ['id' => $user]));
    }

    public function unfollow($id)
    {
        $user = User::findOrFail($id);
        \Auth::user()->unfollow($user);
        return redirect(action('UsersController@show', ['id' => $user]));
    }
}
