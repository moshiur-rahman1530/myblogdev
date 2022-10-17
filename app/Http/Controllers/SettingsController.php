<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSettingsPage()
    {
        return view('admin.settings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settingsUpdate(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'title_first_letter'=>'required',
            'title_remain_letter'=>'required',
            'title_sort_desc'=>'required',
            'hero_title'=>'required',
            'hero_designation'=>'required',
            'hero_sort_desc'=>'required',
    
        ]);

        

        $firstSetting = Settings::first();

        if (request()->hasFile('site_logo')){

          $site_logo = $request->file('site_logo');
          $site_logoSaveAsName = time() . Auth::id() . "-sitesite_logo." . $site_logo->getClientOriginalExtension();
        //   Storage::disk('backup_google')->putFileAs("",$request->file('site_logo'), $site_logoSaveAsName);
        //   $site_logoBackupDisk = Storage::disk('backup_google')->url($site_logoSaveAsName);
        //   $site_logoFilename = Storage::disk('backup_google')->getMetadata($site_logoSaveAsName);
        //   $site_logoFolderId = $site_logoFilename['path'];
        //   $allImagesUpload = Image::create(['name'=>$site_logoSaveAsName, 'img_name'=>$site_logoFolderId, 'path'=>$site_logoBackupDisk]);
            $all_logo_upload_path = 'images/';
            $all_logo_url = $all_logo_upload_path . $site_logoSaveAsName;
            $success = $site_logo->move($all_logo_upload_path, $site_logoSaveAsName);
            // $uploadedFile = copy($upload_path.$brandImageSaveAsName, $all_logo_upload_path.$brandImageSaveAsName);

            $allImagesUpload = Image::create(['name'=>$site_logoSaveAsName, 'img_name'=>$all_logo_upload_path, 'path'=>$all_logo_url]);


        }else{
        //   $site_logoBackupDisk= $firstSetting->site_logo;
          $all_logo_url= $firstSetting->site_logo;
        }

        if (request()->hasFile('hero_image')){

          $hero_image = $request->file('hero_image');
          $hero_imageSaveAsName = time() . Auth::id() . "-sitehero_image." . $hero_image->getClientOriginalExtension();
        //   Storage::disk('backup_google')->putFileAs("",$request->file('hero_image'), $hero_imageSaveAsName);
        //   $hero_imageBackupDisk = Storage::disk('backup_google')->url($hero_imageSaveAsName);
        //   $hero_imageFilename = Storage::disk('backup_google')->getMetadata($hero_imageSaveAsName);
        //   $hero_imageFolderId = $hero_imageFilename['path'];
        //   $allImagesUpload = Image::create(['name'=>$hero_imageSaveAsName, 'img_name'=>$hero_imageFolderId, 'path'=>$hero_imageBackupDisk]);

            $all_upload_path = 'images/';
            $hero_imageBackupDisk = $all_upload_path . $hero_imageSaveAsName;
            $success = $hero_image->move($all_upload_path, $hero_imageSaveAsName);
            $allImagesUpload = Image::create(['name'=>$hero_imageSaveAsName, 'img_name'=>$all_upload_path, 'path'=>$hero_imageBackupDisk]);


        }else{
          $hero_imageBackupDisk= $firstSetting->hero_image;
        }
        
        $result= Settings::first()->update([
            'title_first_letter'=>$request->title_first_letter,
            'title_remain_letter'=>$request->title_remain_letter,
            'hero_title'=>$request->hero_title,
            'title_sort_desc'=>$request->title_sort_desc,
            'site_logo'=>$all_logo_url,
            'hero_image'=>$hero_imageBackupDisk,
            'hero_sort_desc'=>$request->hero_sort_desc,
            'hero_designation'=>$request->hero_designation,
           
          ]);
  
  
          if($result){
              return 1;
          }
          else{
              return 0;
          }


    }
    
}
