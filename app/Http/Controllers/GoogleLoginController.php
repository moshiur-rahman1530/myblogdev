<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{

    public function privacypolicy(Type $var = null)
    {
        return view('homecomponent.piracy');
    }
   // login with google
   public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle(){
        $user = Socialite::driver('google')->stateless()->user();
        // dd($user);
        $findUser = User::where('google_id',$user->id)->first();
        $checkEmail = User::where('email',$user->email)->first();

        // $checkEmail = User::where('email',$user->email)->where('google_id',null)->first();
        if(!$findUser && $checkEmail){

            User::where('email',$user->email)->update(['google_id'=>$user->id]);

            Auth::login($checkEmail);
            return redirect('/home');
        }

        else if($findUser){
            Auth::login($findUser);
            return redirect('/home');
        }else{
            $new_user = new User();
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->google_id = $user->id;
            $new_user->image = $user->avatar;
            $new_user->password = bcrypt('123456');
            $new_user->save();
            Auth::login($new_user);
            return redirect('/home');
        }
    }

        //login with facebook
        public function facebookRedirect(){
            return Socialite::driver('facebook')->redirect();
        }
    
        public function loginWithFacebook(){

            $user = Socialite::driver('facebook')->stateless()->user();
            // dd($user);
            $findUser = User::where('facebook_id',$user->id)->first();

            $checkEmail = User::where('email',$user->email)->first();

            // $checkEmail = User::where('email',$user->email)->where('google_id',null)->first();
            if(!$findUser && $checkEmail){

                User::where('email',$user->email)->update(['facebook_id'=>$user->id]);

                Auth::login($checkEmail);
                return redirect('/home');
            }
            else if($findUser){
                Auth::login($findUser);
                return redirect('/home');
            }else{
                $new_user = new User();
                $new_user->name = $user->name;
                $new_user->email = $user->email;
                $new_user->facebook_id = $user->id;
                $new_user->image = $user->avatar;
                $new_user->password = bcrypt('123456');
                $new_user->save();
                Auth::login($new_user);
                return redirect('/home');
            }
        }

         // login with github
    public function githubRedirect(){
        return Socialite::driver('github')->redirect();
    }

    public function loginWithGithub(){
        $user = Socialite::driver('github')->stateless()->user();
        // dd($user);
        $findUser = User::where('github_id',$user->id)->first();
        $checkEmail = User::where('email',$user->email)->first();

        // $checkEmail = User::where('email',$user->email)->where('google_id',null)->first();
        if(!$findUser && $checkEmail){

            User::where('email',$user->email)->update(['github_id'=>$user->id]);

            Auth::login($checkEmail);
            return redirect('/home');
        }
        else if($findUser){
            Auth::login($findUser);
            return redirect('/home');
        }else{
            $new_user = new User();
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->github_id = $user->id;
            $new_user->image = $user->avatar;
            $new_user->password = bcrypt('123456');
            $new_user->save();
            Auth::login($new_user);
            return redirect('/home');
        }
    }
}