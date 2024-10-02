@extends('layout.app')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.11.4/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.11.4/datatables.min.js"></script>
<script src="js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addEmployeeModal">Ajouter</button>
                <h4 ><b>GESTION DES CONDUCTEURS</b></h4>
            </div>
            <hr>
            <?php if(count($Employees) > 0){ ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th width="6%">ID</th>
                        <th width="9%">Avatar</th>
                        <th width="15%">Nom & Prénom</th>
                        <th width="10%">Téléphone</th>
                        <th class="text-center" width="15%">E-mail</th>
                        <th width="15%">Date Embauche</th>
                        <th width="10%">Etat</th>
                        <th class="text-center" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Employees as $Employee)
                    <tr>
                        <td class="text-center">{{$Employee->id}}</td>
                        <td class="text-center"><img src="storage/images/{{$Employee->avatar_conducteur}}" width="50" class="img-thumbnail rounded-circle"></td>
                        <td class="text-center">{{$Employee->nom_conducteur}}</td>
                        <td class="text-center">{{$Employee->tel_conducteur}}</td>
                        <td class="text-center">{{$Employee->email_conducteur}}</td>
                        <td class="text-center">{{$Employee->date_embauche_conducteur}}</td>
                        {{-- <td class="text-center">{{$Employee->etat_conducteur}}</td> --}}
                        <td class="text-center">
                            @if($Employee->etat_conducteur=="Actif")
                                <span class="label label-success">{{$Employee->etat_conducteur}}</span>
                            @elseif($Employee->etat_conducteur=="En Congé")
                                <span class="label label-danger">{{$Employee->etat_conducteur}}</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editEmployeeModal" onclick="modifyfunction({{$Employee->id}})">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Modifier</span>
                            </button>
                            <button type="button" idEmployee="{{$Employee->id}}" class="btn btn-theme04 ">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Supprimer</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>

{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nouveau Conducteur</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('store')}}" method="POST" id="add_employee_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--Nom & Prénom-->
                    <!--Nom-->
                    <div class="col-lg-6">
                        <label for="nom_conducteuradd">Nom & Prénom</label>
                        <input type="text" name="nom_conducteuradd" class="form-control" id="nom_conducteuradd" placeholder="Nom..." required>
                    </div>
                    <!--Etat-->
                    <div class="col-lg-6">
                        <label for="etat_conducteuradd">Etat</label>
                        <select type="text" name="etat_conducteuradd" class="form-control" id="etat_conducteuradd" required>
                            <option value="1" disabled selected>Sélectionner état...</option>
                            <option value="Actif">Actif</option>
                            <option value="En Congé">En Congé</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Naissance & Embauche-->
                    <div class="col-lg-6">
                        <label for="date_naissance_conducteuradd">Date naissance</label>
                        <input type="date" name="date_naissance_conducteuradd" class="form-control" id="date_naissance_conducteuradd" required>
                    </div>
                    <!--Embauche-->
                    <div class="col-lg-6">
                        <label for="date_embauche_conducteuradd">Date embauche</label>
                        <input type="date" name="date_embauche_conducteuradd" class="form-control" id="date_embauche_conducteuradd" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <div class="col-lg-6">
                        <label for="type_permisadd">Catégorie permis</label>
                        <select type="text" name="type_permisadd" class="form-control" id="type_permisadd" required>
                            <option value="1" disabled selected>Sélectionner catégorie permis...</option>
                            <option value="Permis voiture">Permis B, B1, BE, C1E</option>
                            <option value="Permis transport de marchandises ou matériel">Permis C, C1, C1E</option>
                        </select>
                    </div>
                    <!--N° permis-->
                    <div class="col-lg-6">
                        <label for="num_permis_conducteuradd">N° Permis</label>
                        <input type="text" name="num_permis_conducteuradd" class="form-control" id="num_permis_conducteuradd" placeholder="Numéro Permis..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Ville & Code postal-->
                    <!--Ville-->
                    <div class="col-lg-6">
                        <label for="ville_conducteuradd">Ville</label>
                        <select type="text" name="ville_conducteuradd" class="selectClass form-control" id="ville_conducteuradd" onchange="codeFunc(this)" required>
                            <option value="1" disabled selected>Sélectionner ville...</option>
                            <option value="2" code_postal_conducteuradd="5025">Monastir</option>
                            <option value="3">Sousse</option>
                            <option value="4">Mahdia</option>
                            <option value="5">Tunis</option>
                            <option value="6">Bizerte</option>
                            <option value="7">Nabeul</option>
                            <option value="8">Zaghouan</option>
                            <option value="9">Ariana</option>
                            <option value="10">Sfax</option>
                            <option value="11">Ben Arous</option>
                            <option value="12">La Manouba</option>
                        </select>
                    </div>
                    <!--Code postal-->
                    <div class="col-lg-6">
                        <label for="code_postal_conducteuradd">Code postal</label>
                        <select type="text" name="code_postal_conducteuradd" class="form-control" id="code_postal_conducteuradd" required>
                            <option value="1" disabled selected>Sélectionner ville...</option>
                            <option value="2">50**</option>
                            <option value="3">40**</option>
                            <option value="4">51**</option>
                            <option value="5">20** / 10**</option>
                            <option value="6">70**</option>
                            <option value="7">80**</option>
                            <option value="8">11**</option>
                            <option value="9">20**</option>
                            <option value="10">30**</option>
                            <option value="11">20** / 11**</option>
                            <option value="12">20** / 11**</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Email & Tél-->
                    <!--Email-->
                    <div class="col-lg-6">
                        <label for="email_conducteuradd">E-mail</label>
                        <input type="email" name="email_conducteuradd" class="form-control" id="email_conducteuradd" placeholder="E-mail..." required>
                    </div>
                    <!--Tél-->
                    <div class="col-lg-6">
                        <label for="tel_conducteuradd">Téléphone (+216)</label>
                        <input type="tel" name="tel_conducteuradd" class="form-control" id="tel_conducteuradd" placeholder="Téléphone..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Avatar-->
                    <div class="col-lg-12">
                        <label for="avatar_conducteuradd">Selectionner Avatar</label>
                        <input type="file" name="avatar_conducteuradd" id="avatar_conducteuradd" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="add_employee_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Conducteur</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('update')}}" method="post" id="edit_employee_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="emp_id" id="emp_id">
                <div class="modal-body">
                    <!--Nom & Prénom-->
                    <!--Nom-->
                    <div class="col-lg-6">
                        <label for="nom_conducteur">Nom& Prénom</label>
                        <input type="text" name="nom_conducteur" id="nom_conducteur" class="form-control" readonly required>
                    </div>
                    <!--Etat-->
                    <div class="col-lg-6">
                        <label for="etat_conducteur">Etat</label>
                        <select type="text" name="etat_conducteur" class="form-control" id="etat_conducteur" required>
                            <option value="1" disabled selected>Sélectionner état...</option>
                            <option value="Actif">Actif</option>
                            <option value="En Congé">En Congé</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Naissance & Embauche-->
                    <div class="col-lg-6">
                        <label for="date_naissance_conducteur">Date naissance</label>
                        <input type="date" name="date_naissance_conducteur" class="form-control" id="date_naissance_conducteur" readonly required>
                    </div>
                    <!--Embauche-->
                    <div class="col-lg-6">
                        <label for="date_embauche_conducteur">Date embauche</label>
                        <input type="date" name="date_embauche_conducteur" class="form-control" id="date_embauche_conducteur" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Type permis-->
                    <div class="col-lg-6">
                        <label for="type_permis">Type permis</label>
                        <select type="text" name="type_permis" class="form-control" id="type_permis" readonly required>
                            <option value="1" disabled selected>Sélectionner type permis...</option>
                            <option value="Permis voiture">Permis B, B1, BE, C1E</option>
                            <option value="Permis transport de marchandises ou matériel">Permis C, C1, C1E</option>
                        </select>
                    </div>
                    <!--N° permis-->
                    <div class="col-lg-6">
                        <label for="num_permis_conducteur">N° Permis</label>
                        <input type="text" name="num_permis_conducteur" class="form-control" id="num_permis_conducteur" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Ville & Code postal-->
                    <!--Ville-->
                    <div class="col-lg-6">
                        <label for="ville_conducteur">Ville</label>
                        <select type="text" name="ville_conducteur" class="form-control" id="ville_conducteur" required>
                            <option value="1" disabled selected>Sélectionner ville...</option>
                            <option value="2">Monastir</option>
                            <option value="3">Sousse</option>
                            <option value="4">Mahdia</option>
                            <option value="5">Tunis</option>
                            <option value="6">Bizerte</option>
                            <option value="7">Nabeul</option>
                            <option value="8">Zaghouan</option>
                            <option value="9">Ariana</option>
                            <option value="10">Sfax</option>
                            <option value="11">Ben Arous</option>
                            <option value="12">La Manouba</option>
                        </select>
                    </div>
                    <!--Code postal-->
                    <div class="col-lg-6">
                        <label for="code_postal_conducteur">Code postal</label>
                        <select type="text" name="code_postal_conducteur" class="form-control" id="code_postal_conducteur" required>
                            <option value="1" disabled selected>Sélectionner ville...</option>
                            <option value="2">50**</option>
                            <option value="3">40**</option>
                            <option value="4">51**</option>
                            <option value="5">20** / 10**</option>
                            <option value="6">70**</option>
                            <option value="7">80**</option>
                            <option value="8">11**</option>
                            <option value="9">20**</option>
                            <option value="10">30**</option>
                            <option value="11">20** / 11**</option>
                            <option value="12">20** / 11**</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Email & Tél-->
                    <!--Email-->
                    <div class="col-lg-6">
                        <label for="email_conducteur">E-mail</label>
                        <input type="email" name="email_conducteur" class="form-control" id="email_conducteur" placeholder="E-mail..." required>
                    </div>
                    <!--Tél-->
                    <div class="col-lg-6">
                        <label for="tel_conducteur">Téléphone (+216)</label>
                        <input type="tel" name="tel_conducteur" class="form-control" id="tel_conducteur" placeholder="Téléphone..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Avatar-->
                    <div class="col-lg-12">
                        <label for="avatar_conducteur">Selectionner Avatar</label>
                        <input type="file" name="avatar_conducteur" class="form-control" id="avatar_conducteur" required>
                    </div>
                    <div class="col-lg-12"><br></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_employee_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit employee modal end --}}

<script>
    //edit employee ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#emp_id").val(id);
                $("#nom_conducteur").val(response.nom_conducteur);
                $("#etat_conducteur").val(response.etat_conducteur);
                $("#date_naissance_conducteur").val(response.date_naissance_conducteur);
                $("#date_embauche_conducteur").val(response.date_embauche_conducteur);
                $("#type_permis").val(response.type_permis);
                $("#num_permis_conducteur").val(response.num_permis_conducteur);
                $("#ville_conducteur").val(response.ville_conducteur);
                $("#code_postal_conducteur").val(response.code_postal_conducteur);
                $("#email_conducteur").val(response.email_conducteur);
                $("#tel_conducteur").val(response.tel_conducteur);
                $("#avatar_conducteur").html(
                    `<img src="storage/images/${response.avatar_conducteur}" width="100" class="img-fluid img-thumbnail">`);
                $("#Employee_id").val(response.id);
                $("#Employee_avatar_conducteur").val(response.avatar_conducteur)
            }
        });
    }

    // delete employee ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idEmployee');
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
                        url: '{{ route('delete') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Conducteur Supprimé.',
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
