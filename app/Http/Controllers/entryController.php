<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Models\Entry;
use App\Models\User;
use App\Models\Comment;
use App\Models\Relation;
use Illuminate\Support\Facades\Auth;

class entryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check())
        {
            // get all entry and entry owner name(eon) ,relation between eon-current user(<->) 
            // select entry.*,user.name from entry inner join user on entry.user_id=user.id 
            $Entries = Entry::with('User','Comment', 'Comment.User')->latest()->paginate(10);
            return view('home',compact('Entries'));
        }
        else{
            //list latest entries which are posted by the following users
            $Entries = $this->getFeed(Auth::user());
            return view('home',compact('Entries'));
        }
    }

    /**
     * Get feed for the provided user
     * that means, only show the posts from the users that the current user follows.
     *
     * @param User $user                            The user that you're trying get the feed to
     * @return \Illuminate\Database\Query\Builder   The latest posts
     */
    private function getFeed(User $user) 
    {
        // $userIds = $user->Following()->get("following_user_id");
        // $userIds[] = $user->id;
        // return Entry::with('User','Comment', 'Comment.User')->whereIn('user_id', $userIds)->latest()->paginate(10);
        $user_id=$user->id;
        return Entry::with('User','Comment', 'Comment.User')
        ->whereIn('user_id',function ($query) use ($user_id) {
            $query->select('r.following_user_id')
            ->from('relations as r')
            ->Where('r.user_id',$user_id);
        })
        ->orWhere('user_id',$user_id)
        ->latest()->paginate(10);
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
        if($request->exists('image_name')){
            $this->validate($request,[
                'image_name'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
            ]);
            $image = $request->file('image_name');
            $name = $request->file('image_name')->getClientOriginalName();
            $image_name = $request->file('image_name')->getRealPath();
            Cloudder::upload($image_name, null);
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            //save to uploads directory
            $image->move(public_path("uploads"), $name);
            //Save images
            $this->saveEntry($request, $image_url,$name);
        }
        else{
            $this->saveEntry($request, null,null);
        }
        return redirect()->back()->with('status', 'Post Successfully');
    }
    //save entry to db
    private function saveEntry(Request $request, $image_url,$image_name)
    {
        $Entry = new Entry();
        $Entry->user_id=auth()->user()->id;
        $Entry->title=$request->title;
        $Entry->body=$request->body;
        $Entry->image_name = $image_name;
        $Entry->image_url = $image_url;
        $Entry->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //list latest entries which are posted by the following users
        // $Entries = $this->getFeed(Auth::user());
        // return view('following',compact('Entries'));
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
}
