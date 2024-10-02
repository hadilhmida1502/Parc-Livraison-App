<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConducteurController extends Controller {

	// set employee page view
	public function employee() {
        $Employees = Conducteur::all();
		return view('pages.employee',compact('Employees'));
	}

	// handle insert a new employee ajax request
	public function store(Request $request) {
		$file = $request->file('avatar_conducteuradd');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		$EmployeeData = ['nom_conducteur' => $request->nom_conducteuradd, 'etat_conducteur' => $request->etat_conducteuradd,
                    'date_naissance_conducteur' => $request->date_naissance_conducteuradd, 'date_embauche_conducteur' => $request->date_embauche_conducteuradd,
                    'type_permis' => $request->type_permisadd, 'num_permis_conducteur' => $request->num_permis_conducteuradd,
                    'ville_conducteur' => $request->ville_conducteuradd, 'code_postal_conducteur' => $request->code_postal_conducteuradd,
                    'email_conducteur' => $request->email_conducteuradd, 'tel_conducteur' => $request->tel_conducteuradd,
                    'avatar_conducteur' => $fileName
                    ];

		Conducteur::create($EmployeeData);
		return back();
	}

	// handle edit an employee ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$Employee = Conducteur::find($id);
		return response()->json($Employee);
	}

	// handle update an employee ajax request
	public function update(Request $request) {
        //dd($request->emp_id);
		$fileName = '';
		$Employee = Conducteur::find($request->emp_id);

		if ($request->hasFile('avatar_conducteur')) {
			$file = $request->file('avatar_conducteur');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($Employee->avatar_conducteur) {
				Storage::delete('public/images/' . $Employee->avatar_conducteur);
			}
		} else {
			$fileName = $Employee->avatar_conducteur;
		}

        $EmployeeData = ['nom_conducteur' => $request->nom_conducteur, 'etat_conducteur' => $request->etat_conducteur,
                    'date_naissance_conducteur' => $request->date_naissance_conducteur, 'date_embauche_conducteur' => $request->date_embauche_conducteur,
                    'type_permis' => $request->type_permis, 'num_permis_conducteur' => $request->num_permis_conducteur,
                    'ville_conducteur' => $request->ville_conducteur, 'code_postal_conducteur' => $request->code_postal_conducteur,
                    'email_conducteur' => $request->email_conducteur, 'tel_conducteur' => $request->tel_conducteur,
                    'avatar_conducteur' => $fileName
                    ];

		$Employee->update($EmployeeData);
		return back();
	}
// handle delete an employee ajax request
public function delete(Request $request) {
    $id = $request->id;
    $emp = Conducteur::find($id);

    if (Storage::delete('public/images/' . $emp->avatar_conducteur)) {
        Conducteur::destroy($id);
    }
}
}
