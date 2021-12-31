<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Relation;
use App\Models\Entry;
use App\Models\Comment;
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
        $user_id=Auth::user()->id;
        //get all user following 
        $followingUser=User::whereIn('id', function ($query) use ($user_id) {
            $query->select('r.following_user_id')
            ->from('relations as r')
            ->Where('r.user_id',$user_id);
        })->get();

        // get all follower
        $followerUser=User::whereIn('id', function ($query) use ($user_id) {
            $query->select('r.user_id')
            ->from('relations as r')
            ->Where('r.following_user_id',$user_id);
        })->get();

        //get all user not follow
        $notFollowUser=User::whereNotIn('id', function ($query) use ($user_id) {
            $query->select('r.following_user_id')
            ->from('relations as r')
            ->Where('r.user_id',$user_id);
        })
        ->whereNotIn('id', function ($query) use ($user_id) {
            $query->select('r.user_id')
            ->from('relations as r')
            ->Where('r.following_user_id',$user_id);
        })
        ->Where('id','!=',$user_id)
        ->get();
        // print_r($followingUser);
        return view("friends",compact("followingUser",'notFollowUser','followerUser'));
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

            $Entries=Entry::with('User','Comment', 'Comment.User')
            ->where('user_id', $id)
            ->latest()->paginate(10);

            return view('profile',compact('check_follow','user','Entries'));
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
