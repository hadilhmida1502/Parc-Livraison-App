<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Mission;
use App\Models\Vehicle;
use App\Models\Commande;
use App\Models\Assurance;
use App\Models\Conducteur;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Produit;
use App\Models\Prog_entretien;

class MissionController extends Controller
{
    // set Mission page view
	public function mission() {
        $Véhicules = Vehicle::where('etat_vehicle','!=','En Panne')->get();
        $Conducteurs = Conducteur::where('etat_conducteur','!=','En Congé')->get();
        $Commandes = Commande::where('status_cmd','!=','Affectée')->orWhereNull('status_cmd')->get();
        $Missions = Mission::all();
        $NotificationsAssurances = Notifications::all();
		return view('pages.mission',compact('Véhicules','Conducteurs','Commandes','Missions','NotificationsAssurances'));
	}

    public function updateMissionStatus($id,$status){
        $Mission = Mission::find($id);
        $Mission->status = 0;
        $Mission->save();
        session()->flash('mission_message','Statut de la Mission mis à jour avec succès !');
        return back();
    }

    public function changeStatus(Request $request) {
        $user = Mission::find($request->id);
        $user->status = 1;
        $user->kms = $request->km;
        $user->save();
        //return response()->json(['success' => 'Status Changed Successfully']);
        $km_actuel = $request->km;
        $veh_miss = Mission::where('id',$request->id)->value('veh_mission'); //véhicule mission
        $km_ancien = Vehicle::where('matricule',$veh_miss)->value('kilometrage'); //prend km du véhicule
        Vehicle::where('matricule',$veh_miss)->update([
            'kilometrage'=>$user->kms,
        ]);

        /* Prog_entretien::where('immatriculation',$veh_miss)->update([
            'km_ent'=>$user->kms,
        ]); */

        $progs_ent = Prog_entretien::where('immatriculation',$veh_miss)->get();
        //return count($progs_ent);
        $msg ="";
        foreach($progs_ent as $prog_ent)
        {
            $km_ent = $prog_ent->km_ent; //km dernier entretien
            $repeter = $prog_ent->Prepete_number; //répéter toutes
            $rappel = $prog_ent->Prappel_number; //rappel avant

            $diff = $km_actuel - $km_ent;
            $diff1 = $repeter - $diff;

            if($diff >= $repeter)
            {
                Prog_entretien::where('id',$prog_ent->id)->update([
                'status_prog'=>"C'est le temps",
                ]);
                $msg .= "Vous avez un entretien '".$prog_ent->type_entretien."' : Véhicule '".$prog_ent->immatriculation."'\n";
            }
            elseif($diff < $repeter && $diff1 >= $rappel)
            {
                Prog_entretien::where('id',$prog_ent->id)->update([
                    'status_prog'=>"Pas Encore",
                    ]);
                $msg .= "Un entretien est proche '".$prog_ent->type_entretien."' : Véhicule '".$prog_ent->immatriculation."'\n";
            }
        }
        return  $msg;
    }

    // handle insert a new Mission ajax request
	public function store_mission(Request $request) {
		$MissionData = ['num_mission' => $request->num_missionadd, 'date_mission' => $request->date_missionadd,
                    'debut_mission' => $request->debut_missionadd, 'fin_mission' => $request->fin_missionadd,
                    'veh_mission' => $request->veh_missionadd, 'cond_mission' => $request->cond_missionadd,
                    'ref_cmd' => $request->ref_cmdadd, 'nature_cmd' => $request->nature_cmdadd,
                    'poids_cmd' => $request->poids_cmdadd,
                    'destinataire_cmd' => $request->destinataire_cmdadd, 'tel_dest' => $request->tel_destadd,
                    'email_dest' => $request->email_destadd, 'ville_cmd' => $request->ville_cmdadd, 'adr_cmd' => $request->adr_cmdadd, 'idcmd' => $request->idcmd
                    ];

        $commandes = Commande::find($request->idcmd);
        $commandes->status_cmd = "Affectée";
        $commandes->save();

		Mission::create($MissionData);

		return back();
	}

    // handle edit an Mission ajax request
	public function edit_mission(Request $request) {
		$id = $request->id;
		$Mission = Mission::find($id);
		return response()->json($Mission);
	}

    // handle update an Mission ajax request
	public function update_mission(Request $request) {
        $Mission = Mission::find($request->mission_id);

        $MissionData = ['num_mission' => $request->num_mission, 'date_mission' => $request->date_mission,
                    'debut_mission' => $request->debut_mission, 'fin_mission' => $request->fin_mission,
                    'veh_mission' => $request->veh_mission, 'cond_mission' => $request->cond_mission,
                    'ref_cmd' => $request->ref_cmd, 'nature_cmd' => $request->nature_cmd,
                    'poids_cmd' => $request->poids_cmd,
                    'destinataire_cmd' => $request->destinataire_cmd, 'tel_dest' => $request->tel_dest,
                    'email_dest' => $request->email_dest, 'ville_cmd' => $request->ville_cmd, 'adr_cmd' => $request->adr_cmd
                    ];

		$Mission->update($MissionData);
		return back();
	}

	// handle delete an Mission ajax request
	public function delete_mission(Request $request) {
		$id = $request->id;
        Mission::destroy($id);
    }

    public function get_commande(Request $request)
    {
        $Commande = Commande::where('id',$request->id)->first();
        return $Commande ;
    }

    public function get_vehicle(Request $request){
        $mission =Mission:: where('date_mission',$request->date)->where('debut_mission','>',$request->date_debut)->where('debut_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('fin_mission','>',$request->date_debut)->where('fin_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','<',$request->date_debut)->where('fin_mission','>',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','>',$request->date_debut)->where('fin_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','>',$request->date_debut)->where('debut_mission','=',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('fin_mission','=',$request->date_debut)->where('fin_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','=',$request->date_debut)->where('fin_mission','=',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','=',$request->date_debut)->where('fin_mission','>',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','<',$request->date_debut)->where('fin_mission','=',$request->date_fin)
                            ->get();
        $ids = array();
        foreach ($mission as $missions){
            array_push($ids,$missions->veh_mission);
        }
        $assurances = Assurance:: where('exp_ass',$request->date)->orWhere('exp_taxe',$request->date)->orWhere('proch_vt',$request->date)
                                ->get();
        foreach ($assurances as $vehicl){
            array_push($ids,$vehicl->vehicule);
        }
        $vehicle = Vehicle:: whereNotIn('matricule', $ids)->where('etat_vehicle','!=','En Panne')->get();
        $select= '<option value="1" disabled selected>Sélectionner Véhicule...</option>';
        foreach ($vehicle as $vehicl){
            $select = $select .'<option idVéhicule="'.$vehicl->id.'">'.$vehicl->matricule.'</option>';
        }
        return $select;
    }

    public function get_driver(Request $request){
        $mission = Mission:: where('date_mission',$request->date)->where('debut_mission','>',$request->date_debut)->where('debut_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('fin_mission','>',$request->date_debut)->where('fin_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','<',$request->date_debut)->where('fin_mission','>',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','>',$request->date_debut)->where('fin_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','>',$request->date_debut)->where('debut_mission','=',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('fin_mission','=',$request->date_debut)->where('fin_mission','<',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','=',$request->date_debut)->where('fin_mission','=',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','=',$request->date_debut)->where('fin_mission','>',$request->date_fin)
                            ->orWhere('date_mission',$request->date)->where('debut_mission','<',$request->date_debut)->where('fin_mission','=',$request->date_fin)
                            ->get();
        $ids = array();
        foreach ($mission as $missions){
            array_push($ids,$missions->cond_mission);
        }
        $driver = Conducteur::whereNotIn('nom_conducteur', $ids)->where('etat_conducteur','!=','En Congé')->get();
        $select= '<option value="1" disabled selected>Sélectionner Conducteur...</option>';
        foreach ($driver as $driv){
            $select = $select .'<option idConducteur="'.$driv->id.'">'.$driv->nom_conducteur.'</option>';
        }
        return $select;
    }

    public function get_reference(Request $request){
        $mission =Mission:: where('num_mission','=',$request->numero)->get();
        $ids = array();
        foreach ($mission as $missions){
            array_push($ids,$missions->ref_cmd);
        }
        $commande = Commande::whereNotIn('réf_cmd', $ids)->get();
        $select= '<option value="1" disabled selected>Sélectionner Référence...</option>';
        foreach ($commande as $reference){
            $select = $select .'<option idCommande="'.$reference->id.'">'.$reference->réf_cmd.'</option>';
        }
        return $select;
    }

    public function printPDFInvoice($id)
    {
        $affect = Mission::where('id',$id)->first();
        $idcmd = Mission::where('id',$id)->value('idcmd');

        $affects = Produit::where('commande_id',$idcmd)->get();
        $output = '
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bon Livraison</title>
        <style>
            @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
            }
            .clearfix:after {
            content: "";
            display: table;
            clear: both;
            }
            a {
            color: #1D8A83;
            text-decoration: none;
            }
            body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
            }
            header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
            }
            #logo {
            float: left;
            margin-top: 8px;
            }
            #logo img {
            height: 70px;
            }
            #company {
            float: right;
            text-align: right;
            }
            #details {
            margin-bottom: 50px;
            }
            #client {
            padding-left: 6px;
            border-left: 6px solid #1D8A83;
            float: left;
            }
            #client .to {
            color: #777777;
            }
            h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
            }
            table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            }
            table th,
            table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
            }
            table th {
            white-space: nowrap;
            font-weight: normal;
            }
            table td {
            text-align: right;
            }
            table td h3{
            color: #4ECDC4;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
            }
            table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #4ECDC4;
            }
            table .desc {
            text-align: left;
            }
            table .unit {
            background: #DDDDDD;
            }
            table .qty {
            }
            table .total {
            background: #4ECDC4;
            color: #FFFFFF;
            }
            table td.unit,
            table td.qty,
            table td.total {
            font-size: 1.2em;
            }
            table tbody tr:last-child td {
            border: none;
            }
            table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
            }
            table tfoot tr:first-child td {
            border-top: none;
            }
            table tfoot tr:last-child td {
            color: #4ECDC4;
            font-size: 1.4em;
            border-top: 1px solid #4ECDC4;
            }
            table tfoot tr td:first-child {
            border: none;
            }
            #thanks{
            font-size: 2em;
            margin-bottom: 50px;
            }
            .notices{
            padding-left: 6px;
            border-left: 6px solid #1D8A83;
            }
            .notices .notice {
            font-size: 1.2em;
            }
            .bas {
            color: #777777;
            width: 100%;
            height: 30px;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
            }
        </styl>
    </head>
    <body>
    ';
    $output .= '
        <header class="clearfix">
            <div id="logo">
                <h1>MonPark</h1>
            </div>
            ';
            $output .= '
            <div id="company">
                <h2 class="name" style="color: #1D8A83;">Mission N°: '.$affect->num_mission.'</h2>
                <div>Date Mission: '.$affect->date_mission.'</div>
                <div style="font-size: 1.1em; color: #777777;">Début Mission: '.$affect->debut_mission.'</div>
                <div style="font-size: 1.1em; color: #777777;">Fin Mission: '.$affect->fin_mission.'</div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                    <h2 class="name">'.$affect->destinataire_cmd.'</h2>
                    <div class="address">'.$affect->tel_dest.'</div>
                    <div class="address">'.$affect->ville_cmd.' - '.$affect->adr_cmd.'</div>
                    <div class="email"><a href="mailto:">'.$affect->email_dest.'</a></div>
                </div>
                <div style="float:right;">
                    <h1 style="color: #4ECDC4; font-size: 2.4em; line-height: 1em; font-weight: normal; margin: 0  0 10px 0;">Réf. Cmd: '.$affect->ref_cmd.'</h1>
                    <div class="date">Transporteur : '.$affect->cond_mission.'</div>
                    <div class="date">Véhicule: '.$affect->veh_mission.'</div>
                    <div class="date">Poids commande: '.$affect->poids_cmd.' Kg</div>
                    <div class="date" style="font-size: 1.1em; color: #777777;">Moyen de paiement: COD</div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th width="15%" class="unit">Référence</th>
                        <th width="15%" class="desc">Produit</th>
                        <th width="25%" class="unit">Nature</th>
                        <th width="20%" class="desc">Prix unitaire (TND)</th>
                        <th width="10" class="unit">Quantité</th>
                        <th width="10%" class="total">Total (TND)</th>
                    </tr>
                </thead>
                ';

                $subTotal = 0;
                $grandTotal = 0;
                $frais = 7.000;
                $coupon_amount = 0.000;

                $output .= '<tbody>';
                foreach($affects as $affect1){
                    $subTotal = $subTotal + ($affect1->prix_test*$affect1->quantité_test);
                    $output .= ' <tr>
                                <td width="15%" class="unit" style="text-align: center;">'.$affect->ref_cmd.'</td>
                                <td width="15%" class="desc" style="text-align: center;">'.$affect1->produit_test.'</td>
                                <td width="25%" class="unit" style="text-align: center;">'.$affect->nature_cmd.'</td>
                                <td width="20%" class="desc" style="text-align: center;">'.$affect1->prix_test.',000</td>
                                <td width="10%" class="unit" style="text-align: center;">'.$affect1->quantité_test.'</td>
                                <td width="10%" class="total" style="text-align: center;">'.$affect1->prix_test*$affect1->quantité_test.',000</td>
                            </tr>';
                }
                $output .= '</tbody>
                ';

                $output .= '
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Total produits</td>
                        <td>'.$subTotal.',000 TND</td>
                    </tr>
                    ';

                    $output .='
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Frais de livraison</td>
                        <td>'.$frais.',000 TND</td>
                    </tr>
                    ';

                    $grandTotal = $grandTotal + $subTotal + $frais - $coupon_amount ;
                    $output .='
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">TOTAL</td>
                        <td>'.$grandTotal.',000 TND</td>
                    </tr>
                    ';

                    $output .='
                </tfoot>
            </table>
        </main>
        <br>
        <div class="bas">
            MonPark - Tunisie
            <br>
            Avenue Salem Bchir, Monastir 5000 - Tunisie Bâtiment Gommrasi 4ème étage -
            <a href="mailto:contact@monpark.com">contact@e-solutions.com</a>
            +216 50 658 586
        </div>
    </body>
</html>
        ';
        /* require_once 'dompdf/autoload.inc.php'; */
        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream();

        return view('invoice')->with(compact('affect'));
    }
}
