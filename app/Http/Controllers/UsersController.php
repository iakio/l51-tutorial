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
        return view('users.index')->with("users", User::paginate(30));
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $microposts = $user->microposts()->paginate(30);
        return view('users.show')->with([
            "user" => $user,
            "microposts" => $microposts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with("user", $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validators = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,'.$user->id,
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
        return view('users.edit')->with("user", $user);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Flash::success('User destroyed.');
        return redirect(action('UsersController@index'));
    }

    public function following(User $user)
    {
        return view('users.show_follow')
            ->with([
                'title' => 'Following',
                'user' => $user,
                'users' => $user->followed_users()->paginate()
            ]);
    }

    public function followers(User $user)
    {
        return view('users.show_follow')
            ->with([
                'title' => 'Followers',
                'user' => $user,
                'users' => $user->followers()->paginate()
            ]);
    }

    public function follow(User $user)
    {
        \Auth::user()->follow($user);
        return redirect(action('UsersController@show', ['user' => $user]));
    }

    public function unfollow(User $user)
    {
        \Auth::user()->unfollow($user);
        return redirect(action('UsersController@show', ['user' => $user]));
    }
}
