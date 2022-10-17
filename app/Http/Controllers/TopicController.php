<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Topics');
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
        $menu_name = $request->input('TopicName');
        $menu_icon = $request->input('TopicIcon');
        $status = $request->input('status');
        $result = Topic::create(['topic_name'=>$menu_name,'topic_icon'=>$menu_icon, 'status'=>$status]);
        
        if ($result==true) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $result = Topic::all();
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = json_encode(Topic::where('id',$id)->first());
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $icon = $request->icon;
        $status = $request->status;

        $data = Topic::where('id',$id)->first();
        if($name==null){
            $name=$data->topic_name;
        }
        if($icon==null){
            $name=$data->topic_icon;
        }
        
        if($status==null){
            $status=$data->status;
        }
        
        if($data){
            $result= Topic::where('id','=',$id)->update([
                'topic_name'=>$name,
                'topic_icon'=>$icon,
                'status'=>$status,
            ]);
            if($result==true){
                return 1;
              }
              else{
               return 0;
              }
        }else{
            return 0;
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $data = Topic::where('id',$id)->first();
        if ($data->status == 1) {
          $status = 0;
        } else {
          $status = 1;
        }
        $result = Topic::where('id',$id)->update(['status'=>$status]);
            if ($result==true) {
              return 1;
            } else {
              return 0;
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        $result = Topic::where('id','=',$id)->delete();
        if ($result==true) {
        return 1;
        } else {
        return 0;
        }
    }
}
