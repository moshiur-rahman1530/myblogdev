<?php

namespace App\Http\Controllers;

use App\Models\ReplayComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Events\MyEvent;
use DB;

class ReplayCommentController extends Controller
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
        $this->validate($request, ['message' => 'required|max:1000']);
        $commentReply = new ReplayComment();
        $commentReply->comment_id = $request->id;
        $commentReply->user_id = Auth::id();
        $commentReply->message = $request->message;
        $commentReply->save();
        event(new MyEvent($request->message));
        // Success message
        Toastr::success('success', 'The comment replied successfully ;)');
        return redirect()->back();
    }

    public function supReplay(Request $request)
    {
        $this->validate($request, ['message' => 'required|max:1000']);
        $commentReply = new ReplayComment();
        $commentReply->comment_id = $request->id;
        $commentReply->parent_id = $request->pid;
        $commentReply->user_id = Auth::id();
        $commentReply->message = $request->message;
        $commentReply->save();
        event(new MyEvent($request->message));
        // Success message
        Toastr::success('success', 'The comment replied successfully ;)');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReplayComment  $replayComment
     * @return \Illuminate\Http\Response
     */
    public function show(ReplayComment $replayComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReplayComment  $replayComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReplayComment $replayComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReplayComment  $replayComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReplayComment $replayComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReplayComment  $replayComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReplayComment $replayComment)
    {
        //
    }
}
