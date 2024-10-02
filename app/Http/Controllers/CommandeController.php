<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    // set Commande page view
	public function commande() {
        $Commandes = Commande::all();
		return view('pages.commande',compact('Commandes'));
	}

    public function updateOrderStatus($id,$status_cmd){
        $Commande = Commande::find($id);
        $Commande->status_cmd = $status_cmd;
        $Commande->save();
        session()->flash('order_message','Statut de la Commande mis à jour avec succès !');
        return back();
    }

    // handle insert a new Commande ajax request
	public function store_commande(Request $request) {
        $CommandeData = ['réf_cmd' => $request->réf_cmdadd, 'nature' => $request->natureadd,
                    'poids_cmnd' => $request->poids_cmndadd,
                    'destinataire' => $request->destinataireadd, 'tél_dest' => $request->tél_destadd,
                    'mail_dest' => $request->mail_destadd,
                    'ville_cmnd' => $request->ville_cmndadd, 'adr_cmnd' => $request->adr_cmndadd,
                    ];

        $Commande= Commande::create($CommandeData);

        $produit_test = $request->produit_test;
        $prix_test = $request->prix_test;
        $quantité_test = $request->quantité_test;
        $total_test = $request->total_test;
        $Gtotal_test = $request->Gtotal_test;
        for($count = 0; $count < count($produit_test); $count++){
            $data = array(
                'produit_test' => $produit_test[$count],
                'prix_test'  => $prix_test[$count],
                'quantité_test'  => $quantité_test[$count],
                'total_test'  => $total_test[$count],
                'Gtotal_test'  => $Gtotal_test[$count],
                'commande_id'  => $Commande->id
            );
            $insert_data[] = $data;
            }
        Produit::insert($insert_data);

		return back();
	}

    // handle edit an Commande ajax request
	public function edit_commande(Request $request) {
		$id = $request->id;
		$Commande = Commande::find($id);
		return response()->json($Commande);
	}

    // handle update an Commande ajax request
	public function update_commande(Request $request) {
        $Commande = Commande::find($request->commande_id);

        $CommandeData = ['réf_cmd' => $request->réf_cmd, 'nature' => $request->nature,
                    'poids_cmnd' => $request->poids_cmnd,
                    'destinataire' => $request->destinataire, 'tél_dest' => $request->tél_dest,
                    'mail_dest' => $request->mail_dest,
                    'ville_cmnd' => $request->ville_cmnd, 'adr_cmnd' => $request->adr_cmnd,
                    ];
		$Commande->update($CommandeData);
		return back();
	}

	// handle delete an Commande ajax request
	public function delete_commande(Request $request) {
		$id = $request->id;
        Commande::destroy($id);
    }
}
