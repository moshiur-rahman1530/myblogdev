<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function SubscribeStore(Request $request)
    {
            $request->validate([
                'email' => 'required|email',
            ]);
   
    
            $email = $request->email;

            $checkEmail = Subscribe::where('email','=',$email)->first();
           
         
            if(!$checkEmail){
                $result = Subscribe::create(['email'=>$request->email]);
                $body = [
                    'email'=>$request->get('email')
                ];
        
                // if($result==true){
                //     Mail::to('moshiurmanderpur@gmail.com')->send(new SubscribeMail($body));
                //     Mail::to($email)->send(new SubscribeMail($body));
 
                // }
                return 1;
            }else{
               
                return 0;
               
            }  
    
    }


   

    public function sendmail()
    {
        $allSubs = Subscribe::get();

        foreach ($allSubs as  $value) {
            $details = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp'
                ];
            
                \Mail::to($value->email)->send(new \App\Mail\MySubscribeMail($details));
            
                
        }

       
    }
}

