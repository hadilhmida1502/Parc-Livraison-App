@extends('layout.app')
@section('content')
<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addEntretienModal">Ajouter</button>
                <h4 ><b>GESTION DES PROGRAMMES D'ENTRETIENS</b></h4>
            </div>

            <hr>
            <?php if(count($Programmes) > 0){ ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th width="7%">Véhicule</th>
                        <th width="18%">Type Entretien</th>
                        <th width="11%">Répéter Toutes</th>
                        <th width="10%">Rappel Avant</th>
                        <th width="20%">Kilomètrage dernier entretien</th>
                        <th width="9%">Statut</th>
                        <th class="text-center" width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Programmes as $Programme)
                    <tr>
                        <td class="text-center">{{$Programme->immatriculation}}</td>
                        <td class="text-center">{{$Programme->type_entretien}}</td>
                        <td class="text-center">"{{$Programme->Prepete_number}}" kilométres</td>
                        <td class="text-center">"{{$Programme->Prappel_number}}" kilométres</td>
                        <td class="text-center">"{{$Programme->km_ent}}" kilométres</td>

                        <td class="text-center">
                            @if($Programme->status_prog=="C'est Fait")
                                <span class="label label-success">{{$Programme->status_prog}}</span> {{-- comme mission --}}
                            @elseif($Programme->status_prog=="C'est le temps")
                                <span class="label label-danger">{{$Programme->status_prog}}</span>
                            @elseif($Programme->status_prog=="Pas Encore")
                                <span class="label label-warning">{{$Programme->status_prog}}</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <button type="button" idEntretien="{{$Programme->id}}" class="btn btn-theme04 ">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Supprimer</span>
                            </button>
                            <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editEntretienModal" onclick="modifyfunction({{$Programme->id}})">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Modifier</span>
                            </button>

                            <div class="btn-group">
                                <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown">Statut
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/updateProgStatus/'.$Programme->id.'/'."C'est Fait")}}">C'est Fait</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>

{{-- add new programme entretien modal start --}}
<div class="modal fade" id="addEntretienModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nouveau Programme Entretien</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('store_prog_entretien')}}" method="POST" id="add_entretien_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--Véhicule & Type Entretien-->
                    <!--Véhicule-->
                    <div class="col-lg-6">
                        <label for="immatriculationadd">Véhicule</label>
                        <select type="text" name="immatriculationadd" id="immatriculationadd" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner...</option>
                            @foreach ($Véhicules as $Véhicule)
                                <option idVéhicule="{{$Véhicule->id}}">{{$Véhicule->matricule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--Type Entretien-->
                    <div class="col-lg-6">
                        <label for="type_entretienadd">Type Entretien</label>
                        <select type="text" name="type_entretienadd" id="type_entretienadd" onchange="changeEntretien()" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner...</option>
                            @foreach ($Entretiens as $Entretien)
                                <option idtypeEntretien="{{$Entretien->id}}">{{$Entretien->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Répéter Toutes & Rappel Avant-->
                    <!--Répéter Toutes-->
                    <div class="col-lg-6">
                        <label for="Prepete_numberadd">Répéter Toutes</label>
                        <input type="number" min="1" name="Prepete_numberadd" id="Prepete_numberadd" class="form-control" placeholder="..." readonly required>
                    </div>
                    <!--Rappel Avant-->
                    <div class="col-lg-6">
                        <label for="Prappel_numberadd">Rappel Avant</label>
                        <input type="number" min="1" name="Prappel_numberadd" class="form-control" id="Prappel_numberadd" placeholder="..." readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--dernier kilomètrage-->
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <label for="km_entadd">Kilomètrage du dernier entretien</label>
                        <input type="number" min="1" name="km_entadd" class="form-control" id="km_entadd" placeholder="dernier kilomètrage" >
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="add_entretien_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new programme entretien modal end --}}

{{-- edit new programme entretien modal start --}}
<div class="modal fade" id="editEntretienModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Programme Entretien</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('update_prog_entretien')}}" method="POST" id="edit_entretien_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ent_id" id="ent_id">
                <div class="modal-body">
                    <!--Véhicule & Type Entretien-->
                    <!--Véhicule-->
                    <div class="col-lg-6">
                        <label for="immatriculation">Véhicule</label>
                        <select type="text" name="immatriculation" id="immatriculation" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner...</option>
                            @foreach ($Véhicules as $Véhicule)
                                <option idVéhicule="{{$Véhicule->id}}">{{$Véhicule->matricule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--Type Entretien-->
                    <div class="col-lg-6">
                        <label for="type_entretien">Type Entretien</label>
                        <select type="text" name="type_entretien" id="type_entretien" onchange="updateEntretien()" class="form-control" required>
                            <option value="1" disabled selected>Sélectionner...</option>
                            @foreach ($Entretiens as $Entretien)
                                <option idtypeEntretien="{{$Entretien->id}}">{{$Entretien->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Répéter Toutes & Rappel Avant-->
                    <!--Répéter Toutes-->
                    <div class="col-lg-6">
                        <label for="Prepete_number">Répéter Toutes</label>
                        <input type="number" min="1" name="Prepete_number" id="Prepete_number" class="form-control" readonly required>
                    </div>
                    <!--Rappel Avant-->
                    <div class="col-lg-6">
                        <label for="Prappel_number">Rappel Avant</label>
                        <input type="number" min="1" name="Prappel_number" class="form-control" id="Prappel_number" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--dernier kilomètrage-->
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <label for="km_ent">Kilomètrage du dernier entretien</label>
                        <input type="number" min="1" name="km_ent" class="form-control" id="km_ent" >
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_entretien_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit new programme entretien modal end --}}

<script>
    //edit prog_entretien ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit_prog_entretien') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#ent_id").val(id);
                $("#immatriculation").val(response.immatriculation);
                $("#type_entretien").val(response.type_entretien);
                $("#Prepete_number").val(response.Prepete_number);
                $("#Prappel_number").val(response.Prappel_number);
            }
        });
    }

    //delete prog_entretien ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idEntretien');
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
                        url: '{{ route('delete_prog_entretien') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Programme Entretien Supprimé.',
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
    function changeEntretien(params) {
        var idtype = $("#type_entretienadd option:selected").attr('idtypeEntretien');
        $.ajax({
            url: '{{ route('get_entretien') }}',
            method: 'get',
            data: {
                id: idtype
            },
            success: function(response) {
                $("#Prepete_numberadd").val(response.Trepete_number);
                $("#Prappel_numberadd").val(response.Trappel_number);
            }
        });
    }

    function updateEntretien(params) {
        var id_type = $("#type_entretien option:selected").attr('idtypeEntretien');
        $.ajax({
            url: '{{ route('get_entretien') }}',
            method: 'get',
            data: {
                id: id_type
            },
            success: function(response) {
                $("#Prepete_number").val(response.Trepete_number);
                $("#Prappel_number").val(response.Trappel_number);
            }
        });
    }
</script>
@endsection
