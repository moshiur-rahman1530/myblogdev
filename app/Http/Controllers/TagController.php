<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
   
    public function index()
    {
        return view('admin.Tag');
    }

    
    public function store(Request $request)
    {
        $tag_name = $request->input('TagName');
        $status = $request->input('status');
        $result = Tag::create(['tag_name'=>$tag_name, 'status'=>$status]);
        
        if ($result==true) {
            return 1;
        } else {
            return 0;
        }
    }

    public function show()
    {
        $result = Tag::all();
        return $result;
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = json_encode(Tag::where('id',$id)->first());
        return $data;
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $status = $request->status;

        $data = Tag::where('id',$id)->first();
        if($name==null){
            $name=$data->tag_name;
        }
        
        if($status==null){
            $status=$data->status;
        }
        
        if($data){
            $result= Tag::where('id','=',$id)->update([
                'tag_name'=>$name,
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
        $data = Tag::where('id',$id)->first();
        if ($data->status == 1) {
          $status = 0;
        } else {
          $status = 1;
        }
        $result = Tag::where('id',$id)->update(['status'=>$status]);
            if ($result==true) {
              return 1;
            } else {
              return 0;
            }
    }

  
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        $result = Tag::where('id','=',$id)->delete();
        if ($result==true) {
        return 1;
        } else {
        return 0;
        }
    }
}
