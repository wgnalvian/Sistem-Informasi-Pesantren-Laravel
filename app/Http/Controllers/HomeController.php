<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
       
        $profile = Profile::find(Auth::id());

        if (!$profile) {

            Profile::create([
                'user_id' => Auth::id()
            ]);
            $profile = Profile::find(Auth::id());
        }

        return view('dashboard', ['title' => 'Dashboard']);
    }
}
