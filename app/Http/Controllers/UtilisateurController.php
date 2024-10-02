<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Crypt;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller {

	// set utilisateur page view
	public function utilisateur() {
        $Utilisateurs = User::all();
		return view('pages.utilisateur',compact('Utilisateurs'));
	}

    // handle insert a new user ajax request
	public function store_user(Request $request) {
        $file = $request->file('avataradd');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		$UserData = ['name' => $request->nameadd,
                    'role' => $request->roleadd,
                    'email' => $request->emailadd,
                    'password' => Hash::make ($request->passwordadd),
                    'phone' => $request->phoneadd,
                    'ville' => $request->villeadd,
                    'address' => $request->addressadd,
                    'zipcode' => $request->zipcodeadd,
                    'avatar' => $fileName
                    ];

		User::create($UserData);
		return back();
	}

	// handle edit an utilisateur ajax request
	public function edit_user(Request $request) {
		$id = $request->id;
		$Utilisateur = User::find($id);
		return response()->json($Utilisateur);
	}

	// handle update an utilisateur ajax request
	public function update_user(Request $request) {
        $fileName = '';
		$Utilisateur = User::find($request->user_id);

        if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($Utilisateur->avatar) {
				Storage::delete('public/images/' . $Utilisateur->avatar);
			}
		} else {
			$fileName = $Utilisateur->avatar;
		}

        $UserData = ['name' => $request->name,
                    'role' => $request->role,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'ville' => $request->ville,
                    'address' => $request->address,
                    'zipcode' => $request->zipcode,
                    'avatar' => $fileName
                    ];
		$Utilisateur->update($UserData);
		return back();
	}

	// handle delete an utilisateur ajax request
	public function delete_user(Request $request) {
		$id = $request->id;
		$Utilisateur = User::find($id);
		if (Storage::delete('public/images/' . $Utilisateur->avatar)) {
			User::destroy($id);
		}
	}
}
