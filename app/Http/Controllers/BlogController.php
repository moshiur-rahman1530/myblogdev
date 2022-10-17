<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Topic;
use App\Models\Tag;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use File;

class BlogController extends Controller
{
    public function BlogPage()
    {
        $topics = Topic::all();
        $tags = Tag::all();
        return view('admin.Blogs',['topics'=>$topics, 'tags'=>$tags]);
    }

    public function ShowAllBlog()
    {
        $result = Blog::all();
        return $result;
    }

    
    public function storeBlog(Request $request)
    {
    // dd($request->all());
       $content = $request->blog_description;
       $dom = new \DomDocument();
       $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $imageFile = $dom->getElementsByTagName('img');
 
       foreach($imageFile as $item => $image){
           $data = $image->getAttribute('src');
           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);
           $imgeData = base64_decode($data);
           $image_name= "/uploads/" . time().$item.'.png';
           $path = public_path() . $image_name;
           file_put_contents($path, $imgeData);
           
           $image->removeAttribute('src');
           $image->setAttribute('src', $image_name);
        }
 
       $content = $dom->saveHTML();


          $site_blog = $request->file('blog_main_img');
          $site_blogSaveAsName = time() . Auth::id() . "-blog_main_img." . $site_blog->getClientOriginalExtension();
            $all_blog_upload_path = 'uploads/';
            $all_blog_url = $all_blog_upload_path . $site_blogSaveAsName;
            $success = $site_blog->move($all_blog_upload_path, $site_blogSaveAsName);

            $allImagesUpload = Image::create(['name'=>$site_blogSaveAsName, 'img_name'=>$all_blog_upload_path, 'path'=>$all_blog_url]);
            $authid = Auth::user()->id;

       $result = Blog::create([
            'blog_name' => $request->blog_name,
            'blog_author' => $authid,
            'status' => $request->status,
            'blog_description' => $content,
            'topic_name' => $request->BlogTopic,
            'tag_name' => $request->blogTagName,
            'blog_main_img' => $all_blog_url
       ]);


       $allSubs = Subscribe::get();

       foreach ($allSubs as  $value) {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
            ];
        
            \Mail::to($value->email)->send(new \App\Mail\MySubscribeMail($details));
        }

    // $input = $request->all();
    // $result =Blog::create($input);
     
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }

    }

   
    public function BlogsStatus(Request $request)
    {
        $id = $request->id;
        $data = Blog::where('id',$id)->first();
        if ($data->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $result = Blog::where('id',$id)->update(['status'=>$status]);
          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
    }

   
    public function BlogsDetails(Request $request)
    {
        $id = $request->id;
        $data = json_encode(Blog::where('id',$id)->first());
        return $data;
    }

    public function updateBlog(Request $request)
    {

        // dd($request->all());
        $id = $request->id;
        $name = $request->name;
        $updateblogTagName = $request->updateblogTagName;
        $status = $request->status;
        $UpdateBlogTopic = $request->UpdateBlogTopic;

        $authid= Auth::user()->id;

        $data = Blog::where('id',$id)->first();

       $content = $request->description;
       $dom = new \DomDocument();
       @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $imageFile = $dom->getElementsByTagName('img');
 
       foreach($imageFile as $item => $image){
           $data = $image->getAttribute('src');
           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);
           $imgeData = base64_decode($data);
           $image_name= "/uploads/" . time().$item.'.png';
           $path = public_path() . $image_name;
           file_put_contents($path, $imgeData);
           
           $image->removeAttribute('src');
           $image->setAttribute('src', $image_name);
        }
 
       $content = $dom->saveHTML();

       if($request->hasFile('UpdateBlogImg')){
          $site_blog = $request->file('UpdateBlogImg');
          $site_blogSaveAsName = time() . Auth::id() . "-blog_main_img." . $site_blog->getClientOriginalExtension();
            $all_blog_upload_path = 'uploads/';
            
            $all_blog_url = $all_blog_upload_path . $site_blogSaveAsName;
            $success = $site_blog->move($all_blog_upload_path, $site_blogSaveAsName);

            global $old_image;
            $blogsImg = Blog::where('id','=',$id)->first();
            $old_image = $blogsImg->blog_main_img;
           
                if (File::exists($old_image)) { 
                    unlink($old_image);
                }


            $allImagesUpload = Image::create(['name'=>$site_blogSaveAsName, 'img_name'=>$all_blog_upload_path, 'path'=>$all_blog_url]);
            $authid = Auth::user()->id;

        }else{
            $findUbcat = Blog::where('id','=',$id)->first();
            $all_blog_url =$findUbcat->blog_main_img;
        }

        
        if($data){
            $result= Blog::where('id','=',$id)->update([
                'blog_name' => $name,
                'blog_author' => $authid,
                'status' => $status,
                'blog_description' => $content,
                'topic_name' => $UpdateBlogTopic,
                'tag_name' => $updateblogTagName,
                'blog_main_img' => $all_blog_url
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $Blog
     * @return \Illuminate\Http\Response
     */
    public function BlogDelete(Request $request)
    {
        $id = $request->id;
    
        $result = Blog::where('id','=',$id)->delete();
        if ($result==true) {
        return 1;
        } else {
        return 0;
        }
    }
}
