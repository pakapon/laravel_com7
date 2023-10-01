<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cache;

class SocialAuthController extends Controller
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }
    
    public function handleProviderCallback($service)
    {
        $user = Socialite::driver($service)->user();
    }
}
