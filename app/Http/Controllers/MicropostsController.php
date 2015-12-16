<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreMicropostRequest;
use App\Http\Controllers\Controller;
use App\Micropost;
use Flash;
use Illuminate\Support\Facades\Auth;

class MicropostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['store', 'destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMicropostRequest $request)
    {
        $request->user()->microposts()->save(new Micropost($request->all()));
        Flash::success("Micropost created");
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var Micropost $micropost */
        $micropost = Auth::user()->microposts()->find($id);
        if ($micropost) {
            $micropost->delete();
        }
        return redirect('/');
    }
}
