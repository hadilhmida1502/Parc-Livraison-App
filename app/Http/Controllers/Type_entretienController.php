<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type_entretien;

class Type_entretienController extends Controller
{
    // set type entretien page view
	public function type_entretien() {
        $Type_Entretiens = Type_entretien::all();
		return view('pages.type_entretien',compact('Type_Entretiens'));
	}

    // handle insert a new type entretien ajax request
	public function store_type_entretien(Request $request) {
		$Type_EntretienData = ['description' => $request->descriptionadd,
                                'Trepete_number' => $request->Trepete_numberadd,'Trappel_number' => $request->Trappel_numberadd
                                ];
        Type_entretien::create($Type_EntretienData);
		return back();
	}

    // handle edit type entretien ajax request
	public function edit_type_entretien(Request $request) {
		$id = $request->id;
		$Type_Entretien = Type_entretien::find($id);
		return response()->json($Type_Entretien);
	}

    // handle update type entretien ajax request
	public function update_type_entretien(Request $request) {
        $Type_Entretien = Type_entretien::find($request->type_id);
        $Type_EntretienData = ['description' => $request->description,
                                'Trepete_number' => $request->Trepete_number,'Trappel_number' => $request->Trappel_number
                                ];
		$Type_Entretien->update($Type_EntretienData);
		return back();
	}

    // handle delete type entretien ajax request
	public function delete_type_entretien(Request $request) {
		$id = $request->id;
        Type_entretien::destroy($id);
    }
}
