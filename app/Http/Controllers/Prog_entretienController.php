<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Prog_entretien;
use App\Models\Type_entretien;

class Prog_entretienController extends Controller
{
    // set programme entretien page view
	public function prog_entretien() {
        $Véhicules = Vehicle::all();
        $Entretiens = Type_entretien::all();
        $Programmes = Prog_entretien::all();

		return view('pages.prog_entretien',compact('Véhicules','Entretiens','Programmes'));
	}

    /* public function updateProgStatus($id,$status_prog){
        $programme = Prog_entretien::find($id);
        $programme->status_prog = $status_prog;
        $programme = Mission::find($status_prog->id); //ajouté
        $programme->kms = $programme->km; //ajouté
        $programme->save();

        $veh_miss = Mission::where('id',$programme->id)->value('veh_mission'); //véhicule mission

        Prog_entretien::where('immatriculation',$veh_miss)->update([
            'km_ent'=>$programme->kms,
        ]);

        session()->flash('order_message','Statut mis à jour avec succès !');
        return back();
    } */
    public function updateProgStatus($id,$status_prog){

        $programme = Prog_entretien::find($id);
        $veh = $programme->immatriculation;
        $kmmm =  Vehicle::where('matricule',$veh)->value("kilometrage");

        $programme->status_prog = "C'est Fait";
        $programme->km_ent = $kmmm;

        $programme->save();
        session()->flash('order_message','Statut mis à jour avec succès !');
        return back();
    }

    // handle insert a new vehicle ajax request
	public function store_prog_entretien(Request $request) {
		$EntretienData =['immatriculation' => $request->immatriculationadd, 'type_entretien' => $request->type_entretienadd,
                        'Prepete_number' => $request->Prepete_numberadd, 'Prappel_number' => $request->Prappel_numberadd,
                        'km_ent' => $request->km_entadd
                        ];

        Prog_entretien::create($EntretienData);
		return back();
	}

    // handle edit programme entretien ajax request
	public function edit_prog_entretien(Request $request) {
		$id = $request->id;
		$Entretien = Prog_entretien::find($id);
		return response()->json($Entretien);
	}

    // handle update programme entretien ajax request
	public function update_prog_entretien(Request $request) {
        $Entretien = Prog_entretien::find($request->ent_id);
        $EntretienData =['immatriculation' => $request->immatriculation, 'type_entretien' => $request->type_entretien,
                        'Prepete_number' => $request->Prepete_number, 'Prappel_number' => $request->Prappel_number,
                        'km_ent' => $request->km_ent
                        ];

		$Entretien->update($EntretienData);
		return back();
	}

	// handle delete programme entretien ajax request
	public function delete_prog_entretien(Request $request) {
		$id = $request->id;
        Prog_entretien::destroy($id);
    }

    public function get_entretien(Request $request)
    {
        $Type_entretien = Type_entretien::where('id',$request->id)->first();
        return $Type_entretien ;
    }
}
