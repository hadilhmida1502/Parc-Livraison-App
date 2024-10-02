<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
	public function profile() {
		return view('pages.profile');
	}

    public function update_profile(Request $request) {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->ville = $request->input('ville');
        $user->zipcode = $request->input('zipcode');
        $user->phone = $request->input('phone');

        if($request->hasfile('image'))
        {
            $destination = 'uploads/profile/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile/', $filename);
            $user->image = $filename;
        }

        $user->update();
        return redirect()->back()->with('status','Profile Updated');
	}

}
