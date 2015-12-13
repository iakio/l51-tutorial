<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreMicropostRequest;
use App\Http\Controllers\Controller;
use App\Micropost;
use Flash;

class MicropostsController extends Controller
{

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
        //
    }
}
