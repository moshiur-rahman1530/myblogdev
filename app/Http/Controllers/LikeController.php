<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Events\LikeEvent;
use App\Models\Settings;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLikeDetails(Request $request, $id)
    // public function showLikeDetails(Request $request)
    {
        // $id =$request->id;
        $blogDetails = Blog::with('comments','users','likes')->where('id',$id)->first();
        // dd($blogDetails);
        return $blogDetails;
    }

    public function pressLike(Request $request)
    {
        $blog = Like::where(['blog_id'=>$request->id, 'user_id'=> Auth::user()->id])->first();
        if($blog){
            $blog->delete();
            $countLike = Like::all()->count();
            event(new LikeEvent($countLike));
            return 0;
        }else{
            Like::create(['blog_id'=>$request->id,'user_id'=>auth()->id()]);
            $countLike = Like::all()->count();
            event(new LikeEvent($countLike));
            return 1;
        }

        
       
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
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
