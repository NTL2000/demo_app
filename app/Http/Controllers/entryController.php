<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Models\Entry;
use App\Models\User;
use App\Models\Comment;
use App\Models\Relation;

class entryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all entry and entry owner name(eon) ,relation between eon-current user(<->) 
        // select entry.*,user.name from entry inner join user on entry.user_id=user.id 
        $Entries = Entry::with('User','Comment', 'Comment.User')->orderBy('id','desc')->paginate(10);
        return view('home',compact('Entries'));
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
        //
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
