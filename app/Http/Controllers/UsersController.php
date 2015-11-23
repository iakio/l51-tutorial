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
        $this->middleware('auth', ['only' => ['index', 'edit', 'update']]);
        $this->middleware('correct_user', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users/index')->with("users", User::all());
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
        return view('users/show')->with("user", $user);
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
}
