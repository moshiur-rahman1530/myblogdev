<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ReplayComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Events\MyEvent;
use DB;

class CommentController extends Controller
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
        $this->validate($request, ['comment'=>'required']);
        $comment = new Comment();
        $comment->blog_id = $request->id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $result= $comment->save();
        event(new MyEvent($request->comment));
        // Toastr::success('success', 'The comment create successfully;');
        // return redirect()->back();
        if ($result==true) {
            return 1;
          } else {
            return 0;
          }
    }

    public function getAllComments($id)
    {
        // dd($id);
        $bid = (int) $id;
        // $result = Comment::all()->with('users');
        $result = Comment::with('user','replies.userdata','nestedreplies.userdata')->where('blog_id',$id)->get();
        // dd($result->toArray());

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
