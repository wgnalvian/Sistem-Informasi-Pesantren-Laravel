<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Rules\isPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralController extends Controller
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

        return view('profile', ['data' => $profile]);
    }

    public function profileEdit()
    {

        $profile = Profile::find(Auth::id());

        return view('profile-edit', ['data' => $profile]);
    }

    public function handleProfileEdit(Request $request)
    {

        $profile = Profile::find(Auth::id());
        $user = User::find(Auth::id());

        $request->validate([
            'school_image' => 'image|mimes:jpeg,png,jpg,svg|max:1024',
            'user_image' => 'image|mimes:jpeg,png,jpg,svg|max:1024',
            'username' => 'required',
            'school_name' => 'required',
            'school_address' => 'required'
        ]);
        $disk = Storage::build([
            'driver' => 'local',
            'root' => '../public/images'
        ]);

        if ($request->file('school_image')) {

            $profile->school_image === 'default.jpg' ? false : $disk->delete("./$profile->school_image");
            $schoolImage = $disk->put('.', $request->file('school_image'));
            $schoolImage = explode('./', $schoolImage);
            $schoolImage = $schoolImage[1];
        } else {
            $schoolImage = $profile->school_image;
        }
        if ($request->file('user_image')) {

            $profile->user_image === 'default.jpg' ? false : $disk->delete("./$profile->user_image");
            $userImage = $disk->put('.', $request->file('user_image'));
            $userImage = explode('./', $userImage);
            $userImage = $userImage[1];
        } else {

            $userImage = $profile->user_image;
        }


        $profile->user_image = $userImage;
        $profile->school_image = $schoolImage;
        $profile->school_name = $request->school_name;
        $profile->school_address = $request->school_address;
        $profile->save();


        $user->name = $request->username;
        $user->save();

        Alert::success('Profile Successfully Edit', '');
        return redirect()->to('/profile');
    }

    public function changePassword()
    {

        return view('change-password');
    }

    public function handleChangePassword(Request $request)
    {

        $request->validate([
            'oldPassword' => 'required',
            'oldPassword' => new isPassword,
            'newPassword' => 'required',
        ]);



        if (Hash::check($request->oldPassword, Auth::user()->password)) {

            $hash = Hash::make($request->newPassword);
            $user = User::find(Auth::id());
            $user->password = $hash;
            $user->save();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Alert::success('Password Successfully Change', 'Please Login First');
            return redirect()->to('/login');
        }
    }
}
