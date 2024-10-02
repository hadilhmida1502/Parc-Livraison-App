@extends('layout.app')
@section('content')

<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addVehicleModal">Ajouter</button>
                <h4><b>GESTION DES VEHICULES</b></h4>
            </div>

            <hr>
            <?php if(count($Vehicles) > 0){ ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th width="10%">Matricule</th>
                        <th width="10%">Type</th>
                        <th width="15%">Marque</th>
                        <th width="20%">Date mise en Circulation</th>
                        <th width="15%">Kilomètrage totale</th>
                        <th width="10%">Etat</th>
                        <th class="text-center" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Vehicles as $Vehicle)
                    <tr>
                        <td class="text-center">{{$Vehicle->matricule}}</td>
                        <td class="text-center">{{$Vehicle->type_vehicle}}</td>
                        <td class="text-center">{{$Vehicle->marque}}</td>
                        <td class="text-center">{{$Vehicle->mise_en_circulation}}</td>
                        <td class="text-center">{{$Vehicle->kilometrage}}</td>
                        {{-- <td class="text-center">{{$Vehicle->etat_vehicle}}</td> --}}
                        <td class="text-center">
                            @if($Vehicle->etat_vehicle=="En Bonne Etat")
                                <span class="label label-success">{{$Vehicle->etat_vehicle}}</span>
                            @elseif($Vehicle->etat_vehicle=="En Panne")
                                <span class="label label-danger">{{$Vehicle->etat_vehicle}}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editVehicleModal" onclick="modifyfunction({{$Vehicle->id}})">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Modifier</span>
                            </button>
                            <button type="button" idVehicle="{{$Vehicle->id}}" class="btn btn-theme04 ">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Supprimer</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <?php } ?>
        </div><br>
    </div>
</div>

{{-- add new vehicle modal start --}}
<div class="modal fade" id="addVehicleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nouveau Véhicule</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('store_Vehicle')}}" method="POST" id="add_vehicle_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--Matricule & Marque-->
                    <!--Matricule-->
                    <div class="col-lg-6">
                        <label for="matriculeadd">Matricule</label>
                        <input type="text" name="matriculeadd" class="form-control" id="matriculeadd" placeholder="Matricule..." required>
                    </div>
                    <!--Marque-->
                    <div class="col-lg-6">
                        <label for="marqueadd">Marque</label>
                        <select type="text" name="marqueadd" class="form-control" id="marqueadd" placeholder="Marque..." required>
                            <option value="1" disabled selected>Sélectionner marque...</option>
                            <option value="Citroën Berlingo">Citroën Berlingo</option>
                            <option value="Peugeot Partner">Peugeot Partner</option>
                            <option value="Nissan Atleon">Nissan Atleon</option>
                            <option value="Iveco">Iveco</option>
                            <option value="Isuzu">Isuzu</option>
                            <option value="Fourgon Citroën Jumper">Fourgon Citroën Jumper</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Type & Poids-->
                    <!--Type-->
                    <div class="col-lg-6">
                        <label for="type_vehicleadd">Type</label>
                        <select type="text" name="type_vehicleadd" class="form-control" id="type_vehicleadd" required>
                            <option value="1" disabled selected>Sélectionner type...</option>
                            <option value="Voiture">Voiture</option>
                            <option value="Camion">Camion</option>
                            <option value="Camionnette">Camionnette</option>
                        </select>
                    </div>
                    <!--Poids-->
                    <div class="col-lg-6">
                        <label for="poidsadd">Poids (Kg)</label>
                        <input type="number" name="poidsadd" class="form-control" id="poidsadd" placeholder="Poids..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--carburant & Mise en circulation-->
                    <!--Carburant-->
                    <div class="col-lg-6">
                        <label for="carburantadd">Carburant</label>
                        <select type="text" name="carburantadd" class="form-control" id="carburantadd" required>
                            <option value="1" disabled selected>Sélectionner carburant...</option>
                            <option value="Essence Super">Essence Super</option>
                            <option value="Essence sans plomb">Essence sans plomb</option>
                            <option value="Gas-oil">Gas-oil</option>
                            <option value="GPL">GPL</option>
                            <option value="Essence Normal">Essence Normal</option>
                        </select>
                    </div>
                    <!--Mise en circulation-->
                    <div class="col-lg-6">
                        <label for="mise_en_circulationadd">Mise en circulation</label>
                        <input type="date" name="mise_en_circulationadd" class="form-control" id="mise_en_circulationadd" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Kilometrage & Etat-->
                    <!--Kilometrage-->
                    <div class="col-lg-6">
                        <label for="kilometrageadd">Kilométrage (Km)</label>
                        <input min="1" type="number" name="kilometrageadd" class="form-control" id="kilometrageadd" placeholder="Kilométrage..." >
                    </div>
                    <!--Etat-->
                    <div class="col-lg-6">
                        <label for="etat_vehicleadd">Etat véhicule</label>
                        <select type="text" name="etat_vehicleadd" class="form-control" id="etat_vehicleadd" required>
                            <option value="1" disabled selected>Sélectionner état...</option>
                            <option value="En Bonne Etat">En Bonne Etat</option>
                            <option value="En Panne">En Panne</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="add_vehicle_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new vehicle modal end --}}

{{-- edit vehicle modal start --}}
<div class="modal fade" id="editVehicleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Véhicule</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('update_Vehicle')}}" method="POST" id="edit_vehicle_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="veh_id" id="veh_id">
                <div class="modal-body">
                    <!--Matricule & Marque-->
                    <!--Matricule-->
                    <div class="col-lg-6">
                        <label for="matricule">Matricule</label>
                        <input type="text" name="matricule" id="matricule" class="form-control" required readonly>
                    </div>
                    <!--Marque-->
                    <div class="col-lg-6">
                        <label for="marque">Marque</label>
                        <select type="text" name="marque" class="form-control" id="marque" required readonly>
                            <option value="1" disabled selected>Sélectionner marque...</option>
                            <option value="Citroën Berlingo">Citroën Berlingo</option>
                            <option value="Peugeot Partner">Peugeot Partner</option>
                            <option value="Nissan Atleon">Nissan Atleon</option>
                            <option value="Iveco">Iveco</option>
                            <option value="Isuzu">Isuzu</option>
                            <option value="Fourgon Citroën Jumper">Fourgon Citroën Jumper</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Type & Poids-->
                    <!--Type-->
                    <div class="col-lg-6">
                        <label for="type_vehicle">Type</label>
                        <select type="text" name="type_vehicle" class="form-control" id="type_vehicle" required readonly>
                            <option value="1" disabled selected>Sélectionner type...</option>
                            <option value="Voiture">Voiture</option>
                            <option value="Camion">Camion</option>
                            <option value="Camionnette">Camionnette</option>
                        </select>
                    </div>
                    <!--Poids-->
                    <div class="col-lg-6">
                        <label for="poids">Poids (Kg)</label>
                        <input type="number" name="poids" class="form-control" id="poids" required readonly>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--carburant & Mise en circulation-->
                    <!--Carburant-->
                    <div class="col-lg-6">
                        <label for="carburant">Carburant</label>
                        <select type="text" name="carburant" class="form-control" id="carburant" required>
                            <option value="1" disabled selected>Sélectionner carburant...</option>
                            <option value="Essence Super">Essence Super</option>
                            <option value="Essence sans plomb">Essence sans plomb</option>
                            <option value="Gas-oil">Gas-oil</option>
                            <option value="GPL">GPL</option>
                            <option value="Essence Normal">Essence Normal</option>
                        </select>
                    </div>
                    <!--Mise en circulation-->
                    <div class="col-lg-6">
                        <label for="mise_en_circulation">Mise en circulation</label>
                        <input type="date" name="mise_en_circulation" class="form-control" id="mise_en_circulation" required readonly>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Kilometrage & Etat-->
                    <!--Kilometrage-->
                    <div class="col-lg-6">
                        <label for="kilometrage">Kilométrage (Km)</label>
                        <input type="number" name="kilometrage" class="form-control" id="kilometrage" >
                    </div>
                    <!--Etat-->
                    <div class="col-lg-6">
                        <label for="etat_vehicle">Etat véhicule</label>
                        <select type="text" name="etat_vehicle" class="form-control" id="etat_vehicle" required>
                            <option value="1" disabled selected>Sélectionner état...</option>
                            <option value="En Bonne Etat">En Bonne Etat</option>
                            <option value="En Panne">En Panne</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_vehicle_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit vehicle modal end --}}

<script>
    //edit vehicle ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit_Vehicle') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#veh_id").val(id);
                $("#matricule").val(response.matricule);
                $("#marque").val(response.marque);
                $("#type_vehicle").val(response.type_vehicle);
                $("#poids").val(response.poids);
                $("#carburant").val(response.carburant);
                $("#mise_en_circulation").val(response.mise_en_circulation);
                $("#kilometrage").val(response.kilometrage);
                $("#etat_vehicle").val(response.etat_vehicle);
            }
        });
    }

    //delete vehicle ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idVehicle');
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
                        url: '{{ route('delete_Vehicle') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Véhicule Supprimé.',
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
@endsection
