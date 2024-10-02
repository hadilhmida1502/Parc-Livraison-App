@extends('layout.app')
@section('content')
<style>
    .alert{
        background: #e5f7f5;
        padding: 20px 40px;
        min-width: 420px;
        right: 0px;
        top: 10px;
        overflow: hidden;
        border-radius: 4px;
        border-left: 15px solid #94ded7;
    }
    .alert .msg{
        padding: 0 20px;
        font-size: 18px;
        color: #4ecdc4;
    }
</style>

<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addMissionModal">Ajouter</button>
                <h4><b>GESTION DES MISSIONS</b></h4>
            </div>
            <hr>
            <?php if(count($Missions) > 0){ ?>

                @if (Session::has('mission_message'))
                <div class="alert show">
                    <span class="msg">{{ Session::get('mission_message') }}</span>
                    <span aria-hidden="true" type="button" class="close" data-dismiss="alert" aria-label="Close">X</span>
                </div>
                @endif

            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        {{-- <th width="5%">ID</th> --}}
                        <th width="10%">N° Mission</th>
                        <th width="10%">Date Mission</th>
                        <th width="10%">Réf Cmd</th>
                        <th width="9%">Véhicule</th>
                        <th width="9%">Conducteur</th>
                        <th width="8%">Statut</th>
                        <th width="12%">Kilomètrage</th>
                        <th width="32%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Missions as $Mission)
                    <tr>
                        {{-- <td class="text-center">{{$Mission->id}}</td> --}}
                        <td class="text-center">{{$Mission['num_mission']}}</td>
                        <td class="text-center">{{$Mission->date_mission}}</td>
                        <td class="text-center">{{$Mission->ref_cmd}}</td>
                        <td class="text-center">{{$Mission->veh_mission}}</td>
                        <td class="text-center">{{$Mission->cond_mission}}</td>

                        <td class="text-center">
                            @if($Mission->status==1)
                                <span class="label label-success">Réalisée</span>
                            @elseif($Mission->status==0)
                                <span class="label label-danger">Annulée</span>
                            @else
                                <span class="label label-warning">En Cours</span>
                            @endif
                        </td>

                        {{-- @if($Mission->status==1)
                        <td class="text-center">Réalisée</td>
                        @elseif ($Mission->status==0)
                        <td class="text-center">Annulée</td>
                        @else
                        <td class="text-center">En Cours</td>
                        @endif --}}
                        <td class="text-center">{{$Mission->kms}} kilométres</td>

                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown">Statut
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a onclick="modifykm({{$Mission->id}})" >Réalisée</a></li>
                                    <li><a href="{{url('/updateMissionStatus/'.$Mission->id.'/'.'Annulée')}}">Annulée</a></li>
                                </ul>
                            </div>
                            <button type="button" idMission="{{$Mission->id}}" class="btn btn-theme04 ">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                            <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editMissionModal" onclick="modifyfunction({{$Mission->id}})">
                                <i class="fa fa-pencil-square-o"></i>
                            </button>
                            <a href="{{ url('print_pdf_invoice/'.$Mission['id']) }}">
                                <button type="button" class="btn btn-primary">
                                    <i style="font-size:16px" class="fa fa-file-pdf-o"></i>
                                    <span> Générer Bon de Livraison</span>
                                </button>
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            <?php } ?>
        </div>
    </div>
</div>

{{-- add new mission modal start --}}
<div class="modal fade" id="addMissionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nouvelle Mission</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('store_mission')}}" method="POST" id="add_mission_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--N° Mission & Date Mission-->
                    <!--N° Mission-->
                    <div class="col-lg-6">
                        <label for="num_missionadd">N° Mission</label>
                        <input type="text" name="num_missionadd" id="num_missionadd" class="form-control"  placeholder="Numéro..." required>
                    </div>
                    <!--Date Mission-->
                    <div class="col-lg-6">
                        <label for="date_missionadd">Date Mission</label>
                        <input type="date" name="date_missionadd" id="date_missionadd" class="form-control" ="selectVehConchangeondRef()" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Durée Mission-->
                    <div class="col-lg-6">
                        <label for="debut_missionadd">Début Mission</label>
                        <input type="time" name="debut_missionadd" id="debut_missionadd" class="form-control" onchange="selectVehCondRef()" placeholder="Durée..." required>
                    </div>
                    <!---->
                    <div class="col-lg-6">
                        <label for="fin_missionadd">Fin Mission</label>
                        <input type="time" name="fin_missionadd" id="fin_missionadd" class="form-control" onchange="selectVehCondRef()" placeholder="Durée..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Véhicule & Conducteur-->
                    <!--Véhicule-->
                    <div class="col-lg-6">
                        <label for="veh_missionadd">Véhicule</label>
                        <select type="text" name="veh_missionadd" id="veh_missionadd" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner Véhicule...</option>
                            @foreach ($Véhicules as $Véhicule)
                                <option idVéhicule="{{$Véhicule->id}}">{{$Véhicule->matricule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--Conducteur-->
                    <div class="col-lg-6">
                        <label for="cond_missionadd">Conducteur</label>
                        <select onchange="selectcond(this)" type="text" name="cond_missionadd" id="cond_missionadd" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner Conducteur...</option>
                            @foreach ($Conducteurs as $Conducteur)
                                <option idConducteur="{{$Conducteur->id}}">{{$Conducteur->nom_conducteur}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="idcondc" id="idcondc">
                    <div class="col-lg-12"><br></div>

                    <!--Réf Commande-->
                    <div class="col-lg-6">
                        <label for="ref_cmdadd">Réf Commande</label>
                        <select type="text" name="ref_cmdadd" id="ref_cmdadd" onchange="changeCommande()" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner Référence...</option>
                            @foreach ($Commandes as $Commande)
                                <option idCommande="{{$Commande->id}}">{{$Commande->réf_cmd}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="idcmd" id="idcmd2">
                    <!--Nature Commande-->
                    <div class="col-lg-6">
                        <label for="nature_cmdadd">Nature Commande</label>
                        <input type="text" name="nature_cmdadd" id="nature_cmdadd" class="form-control" placeholder="Nature..." readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Poids Commande & Nom Destinataire-->
                    <!--Poids Commande-->
                    <div class="col-lg-6">
                        <label for="poids_cmdadd">Poids Commande</label>
                        <input type="text" name="poids_cmdadd" id="poids_cmdadd" class="form-control" placeholder="Poids..." readonly required>
                    </div>
                    <!--Nom Destinataire-->
                    <div class="col-lg-6">
                        <label for="destinataire_cmdadd">Nom et Prénom Destinataire</label>
                        <input type="text" name="destinataire_cmdadd" id="destinataire_cmdadd" class="form-control" placeholder="Nom & Prénom..." readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Tél Destinataire & Email Destinataire-->
                    <!--Tél Destinataire-->
                    <div class="col-lg-6">
                        <label for="tel_destadd">Tél Destinataire</label>
                        <input type="text" name="tel_destadd" id="tel_destadd" class="form-control" placeholder="Téléphone..." readonly required>
                    </div>
                    <!--Email Destinataire-->
                    <div class="col-lg-6">
                        <label for="email_destadd">E-mail Destinataire</label>
                        <input type="email" name="email_destadd" id="email_destadd" class="form-control" placeholder="E-mail..." readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Ville Commande & Adresse Commande-->
                    <!--Ville Commande-->
                    <div class="col-lg-6">
                        <label for="ville_cmdadd">Ville Destinataire</label>
                        <input type="text" name="ville_cmdadd" id="ville_cmdadd" class="form-control" placeholder="Ville..." readonly required>
                    </div>
                    <!--Adresse Commande-->
                    <div class="col-lg-6">
                        <label for="adr_cmdadd">Adresse Destinataire</label>
                        <input type="text" name="adr_cmdadd" id="adr_cmdadd" class="form-control" placeholder="Adresse..." readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="add_mission_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new mission modal end --}}

{{-- edit mission modal start --}}
<div class="modal fade" id="editMissionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Mission</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('update_mission')}}" method="POST" id="edit_mission_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mission_id" id="mission_id">
                <div class="modal-body">
                    <!--N° Mission & Date Mission-->
                    <!--N° Mission-->
                    <div class="col-lg-6">
                        <label for="num_mission">N° Mission</label>
                        <input type="text" name="num_mission" id="num_mission" class="form-control"  placeholder="Numéro..."  required>
                    </div>
                    <!--Date Mission-->
                    <div class="col-lg-6">
                        <label for="date_mission">Date Mission</label>
                        <input type="date" name="date_mission" id="date_mission" class="form-control" onchange="updateVehCondRef()" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Durée Mission-->
                    <div class="col-lg-6">
                        <label for="debut_mission">Début Mission</label>
                        <input type="time" name="debut_mission" id="debut_mission" class="form-control" onchange="updateVehCondRef()" placeholder="Durée..." required>
                    </div>
                    <!---->
                    <div class="col-lg-6">
                        <label for="fin_mission">Fin Mission</label>
                        <input type="time" name="fin_mission" id="fin_mission" class="form-control" onchange="updateVehCondRef()" placeholder="Durée..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Véhicule & Conducteur-->
                    <!--Véhicule-->
                    <div class="col-lg-6">
                        <label for="veh_mission">Véhicule</label>
                        <select type="text" name="veh_mission" id="veh_mission" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner conducteur...</option>
                            @foreach ($Véhicules as $Véhicule)
                                <option idVéhicule="{{$Véhicule->id}}">{{$Véhicule->matricule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--Conducteur-->
                    <div class="col-lg-6">
                        <label for="cond_mission">Conducteur</label>
                        <select type="text" name="cond_mission" id="cond_mission" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner conducteur...</option>
                            @foreach ($Conducteurs as $Conducteur)
                                <option idConducteur="{{$Conducteur->id}}">{{$Conducteur->nom_conducteur}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Réf Commande & Nature Commande-->
                    <!--Réf Commande-->
                    <div class="col-lg-6">
                        <label for="ref_cmd">Réf Commande</label>
                        <select type="text" name="ref_cmd" id="ref_cmd" class="form-control" onchange="updateCommande()" required>
                            <option value="1" disabled selected>Sélectionner Référence...</option>
                            @foreach ($Commandes as $Commande)
                                <option idCommande="{{$Commande->id}}">{{$Commande->réf_cmd}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="idcmd2" id="idcmd266">
                    <!--Nature Commande-->
                    <div class="col-lg-6">
                        <label for="nature_cmd">Nature Commande</label>
                        <input type="text" name="nature_cmd" id="nature_cmd" class="form-control" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Poids Commande & Nom Destinataire-->
                    <!--Poids Commande-->
                    <div class="col-lg-6">
                        <label for="poids_cmd">Poids Commande</label>
                        <input type="text" name="poids_cmd" id="poids_cmd" class="form-control" readonly required>
                    </div>
                    <!--Nom Destinataire-->
                    <div class="col-lg-6">
                        <label for="destinataire_cmd">Nom et Prénom Destinataire</label>
                        <input type="text" name="destinataire_cmd" id="destinataire_cmd" class="form-control" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Tél Destinataire & Email Destinataire-->
                    <!--Tél Destinataire-->
                    <div class="col-lg-6">
                        <label for="tel_dest">Tél Destinataire</label>
                        <input type="text" name="tel_dest" id="tel_dest" class="form-control" readonly required>
                    </div>
                    <!--Email Destinataire-->
                    <div class="col-lg-6">
                        <label for="email_dest">E-mail Destinataire</label>
                        <input type="email" name="email_dest" id="email_dest" class="form-control" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Ville Commande & Adresse Commande-->
                    <!--Ville Commande-->
                    <div class="col-lg-6">
                        <label for="ville_cmd">Ville Destinataire</label>
                        <input type="text" name="ville_cmd" id="ville_cmd" class="form-control" readonly required>
                    </div>
                    <!--Adresse Commande-->
                    <div class="col-lg-6">
                        <label for="adr_cmd">Adresse Destinataire</label>
                        <input type="text" name="adr_cmd" id="adr_cmd" class="form-control" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_mission_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit mission modal end --}}

<script>
    //edit mission ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit_mission') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#mission_id").val(id);
                $("#num_mission").val(response.num_mission);
                $("#date_mission").val(response.date_mission);
                $("#debut_mission").val(response.debut_mission);
                $("#fin_mission").val(response.fin_mission);
                $("#veh_mission").val(response.veh_mission);
                $("#cond_mission").val(response.cond_mission);
                $("#ref_cmd").val(response.ref_cmd);
                $("#nature_cmd").val(response.nature_cmd);
                $("#poids_cmd").val(response.poids_cmd);
                $("#destinataire_cmd").val(response.destinataire_cmd);
                $("#tel_dest").val(response.tel_dest);
                $("#email_dest").val(response.email_dest);
                $("#ville_cmd").val(response.ville_cmd);
                $("#adr_cmd").val(response.adr_cmd);
            }
        });
    }

    //delete mission ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idMission');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f0ad4e',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete_mission') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Mission Supprimée.',
                                'success'
                            )
                        }
                    });
                    $(this).closest('tr').remove();
                }
            })
        });
    });
</script>
<script>
    function selectcond(e){
        $("#idcondc").val($("#cond_missionadd option:selected").attr('idConducteur'));
    }
    function changeCommande(params) {
        var idcmd = $("#ref_cmdadd option:selected").attr('idCommande');
        $("#idcmd2").val(idcmd);
        $.ajax({
            url: '{{ route('get_commande') }}',
            method: 'get',
            data: {
                id: idcmd
            },
            success: function(response) {
                $("#ref_cmdadd").val(response.réf_cmd);
                $("#nature_cmdadd").val(response.nature);
                $("#poids_cmdadd").val(response.poids_cmnd);
                $("#destinataire_cmdadd").val(response.destinataire);
                $("#tel_destadd").val(response.tél_dest);
                $("#email_destadd").val(response.mail_dest);
                $("#ville_cmdadd").val(response.ville_cmnd);
                $("#adr_cmdadd").val(response.adr_cmnd);
            }
        });
    }

    function updateCommande(params) {
        var idcmd = $("#ref_cmd option:selected").attr('idCommande');
        $("#idcmd266").val(idcmd);
        $.ajax({
            url: '{{ route('get_commande') }}',
            method: 'get',
            data: {
                id: idcmd
            },
            success: function(response) {
                $("#ref_cmd").val(response.réf_cmd);
                $("#nature_cmd").val(response.nature);
                $("#poids_cmd").val(response.poids_cmnd);
                $("#destinataire_cmd").val(response.destinataire);
                $("#tel_dest").val(response.tél_dest);
                $("#email_dest").val(response.mail_dest);
                $("#ville_cmd").val(response.ville_cmnd);
                $("#adr_cmd").val(response.adr_cmnd);
            }
        });
    }

    function selectVehCondRef(selected) {
        var numero= $("#num_missionadd").val();
        var date= $("#date_missionadd").val();
        var date_debut = $("#debut_missionadd").val();
        var date_fin = $("#fin_missionadd").val();

        $.ajax({
            url: '{{ route('get_vehicle') }}',
            method: 'get',
            data: {
                date:date,date_debut:date_debut,date_fin:date_fin
            },
            success: function(response) {
                $("#veh_missionadd").html(response);
            }
        });

        $.ajax({
            url: '{{ route('get_driver') }}',
            method: 'get',
            data: {
                date:date,date_debut:date_debut,date_fin:date_fin
            },
            success: function(response) {
                $("#cond_missionadd").html(response);
            }
        });
    }

    function updateVehCondRef(selected) {
        var numero= $("#num_mission").val();
        var date= $("#date_mission").val();
        var date_debut = $("#debut_mission").val();
        var date_fin = $("#fin_mission").val();

        $.ajax({
            url: '{{ route('get_vehicle') }}',
            method: 'get',
            data: {
                date:date,date_debut:date_debut,date_fin:date_fin
            },
            success: function(response) {
                $("#veh_mission").html(response);
            }
        });

        $.ajax({
            url: '{{ route('get_driver') }}',
            method: 'get',
            data: {
                date:date,date_debut:date_debut,date_fin:date_fin
            },
            success: function(response) {
                $("#cond_mission").html(response);
            }
        });
    }
</script>

<script>
    function modifykm(p)
    {
        var id = p ;
        var km = prompt("Entrez le nombre des kilomètres");
        $.ajax({
            url: '{{ route('changeStatus') }}',
            method: 'get',
            data: {
                km:km,id:id
            },
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    }
</script>

@endsection
