<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Topic;
use App\Models\Tag;
use App\Models\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.layouts.app');
    }


    public function userindex()
    {
        $data = Settings::first();
        $topics = Topic::where('status',1)->get();
        $tags = Tag::where('status',1)->get();
        $blogs = Blog::where('status',1)->paginate(10);
        return view('home',['data'=>$data, 'topics'=>$topics, 'tags'=>$tags, 'blogs'=>$blogs]);
    }
    public function postById($id)
    {
        $data = Settings::first();
        $topics = Topic::where('status',1)->get();
        $tags = Tag::where('status',1)->get();
        if($id){
            $blogs = Blog::where('status',1)->where('topic_name',$id)->paginate(10);
        }else{
             $blogs = Blog::where('status',1)->paginate(10);
        }
       
        return view('homecomponent.blogbyid',['data'=>$data, 'topics'=>$topics, 'tags'=>$tags, 'blogs'=>$blogs]);
    }
    public function postByTag(Request $request)
    // public function postByTag($id)
    {
        $data = Settings::first();
        $topics = Topic::where('status',1)->get();
        $tags = Tag::where('status',1)->get();
       
        if($request->id){
            $blogs = Blog::where('status',1)->whereJsonContains('tag_name',[$request->id])->paginate(10);
          
            
        }else{
             $blogs = Blog::where('status',1)->paginate(10);
        }
       
        return view('homecomponent.blogbyid',['data'=>$data, 'topics'=>$topics, 'tags'=>$tags, 'blogs'=>$blogs]);
    }

    public function showBlogDetails($id, $title)
    {
        $data = Settings::first();
        $topics = Topic::where('status',1)->get();
        $tags = Tag::where('status',1)->get();
        $blogDetails = Blog::with('comments','users','likes')->where('id',$id)->first();
        // dd(count($blogDetails->comments));
        return view('homecomponent.singleBlog', ['data'=>$data, 'topics'=>$topics, 'tags'=>$tags,'blogDetails'=>$blogDetails]);
    }
    public function Aboutus()
    {
        $data = Settings::first();
        $topics = Topic::where('status',1)->get();
        $tags = Tag::where('status',1)->get();
        // dd(count($blogDetails->comments));
        return view('homecomponent.about', ['data'=>$data, 'topics'=>$topics, 'tags'=>$tags]);
    }
}
