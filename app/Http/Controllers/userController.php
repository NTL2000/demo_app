<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Relation;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show profile user
        if(Auth::check()){
            $current_user=auth()->user()->id;
            $check_follow=Relation::where([
                ['user_id', '=', $current_user],
                ['following_user_id', '=', $id]
            ])->count();
            $user=User::where('id','=',$id)->get();
            return view('profile',compact('check_follow','user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    // Follow user from profile
    public function followUser($id){
        $relation=new Relation();
        $relation->user_id=Auth::user()->id;
        $relation->following_user_id=$id;
        $relation->save();
    }
    // Unfollow user from profile
    public function unFollowUser($id){
        $current_user=auth()->user()->id;
        $result=Relation::where([
            ['user_id', '=', $current_user],
            ['following_user_id', '=', $id]
        ])->delete();
    }
}
