<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    
    public function MenuPage()
    {
        return view('admin.ManageMenu');
    }

    public function ShowAllMenu()
    {
        $result = Menu::all();
        return $result;
    }

    
    public function storeMenu(Request $request)
    {
      $menu_name = $request->input('MenuName');
      $location = $request->input('MenuLocation');
      $menu_url = $request->input('MenuUrl');
      $status = $request->input('status');
      $result = Menu::create(['menu_name'=>$menu_name, 'menu_url'=>$menu_url, "location"=>$location, 'status'=>$status]);
     
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }

    }

   
    public function MenusStatus(Request $request)
    {
        $id = $request->id;
        $data = Menu::where('id',$id)->first();
        if ($data->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $result = Menu::where('id',$id)->update(['status'=>$status]);
          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
    }

   
    public function MenusDetails(Request $request)
    {
        $id = $request->id;
        $data = json_encode(Menu::where('id',$id)->first());
        return $data;
    }

    public function updateMenu(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $url = $request->url;
        $location = $request->location;
        $status = $request->status;

        $data = Menu::where('id',$id)->first();
        if($name==null){
            $name=$data->menu_name;
        }
        if($url==null){
            $url=$data->menu_url;
        }
        if($status==null){
            $status=$data->status;
        }
        if($location==null){
            $location=$data->location;
        }

        if($data){
            $result= Menu::where('id','=',$id)->update([
                'menu_name'=>$name,
                'menu_url'=>$url,
                'location'=>$location,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function MenuDelete(Request $request)
    {
        $id = $request->id;
    
        $result = Menu::where('id','=',$id)->delete();
        if ($result==true) {
        return 1;
        } else {
        return 0;
        }
    }
}
