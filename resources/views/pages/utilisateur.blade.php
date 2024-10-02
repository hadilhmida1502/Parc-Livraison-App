@extends('layout.app')
@section('content')

<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addUtilisateurModal">Ajouter</button>
                <h4><b>GESTION DES UTILISATEURS</b></h4>
            </div>

            <hr>
            <?php if(count($Utilisateurs) > 0){ ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th width="9%">Avatar</th>
                        <th width="15%">Nom & Prénom</th>
                        <th width="16%">Rôle</th>
                        <th width="15%">Téléphone</th>
                        <th class="text-center" width="20%">E-mail</th>
                        <th class="text-center" width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Utilisateurs as $Utilisateur)
                    <tr>
                        <td class="text-center"><img src="storage/images/{{$Utilisateur->avatar}}" width="50" class="img-thumbnail rounded-circle"></td>
                        <td class="text-center">{{$Utilisateur->name}}</td>
                        <td class="text-center">{{$Utilisateur->role}}</td>
                        <td class="text-center">{{$Utilisateur->phone}}</td>
                        <td class="text-center">{{$Utilisateur->email}}</td>
                        <td class="text-center">
                            <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editUtilisateurModal" onclick="modifyfunction({{$Utilisateur->id}})">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Modifier</span>
                            </button>
                            <button type="button" idUtilisateur="{{$Utilisateur->id}}" class="btn btn-theme04 ">
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

{{-- add new user modal start --}}
<div class="modal fade" id="addUtilisateurModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nouveau Utilisateur</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('store_user')}}" method="POST" id="add_utilisateur_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <!--role-->
                    <div class="col-lg-6">
                        <label for="roleadd">Rôle</label>
                        <select type="text" name="roleadd" class="form-control" id="roleadd" placeholder="Rôle..." required>
                            <option value="1" disabled selected>Sélectionner rôle...</option>
                            <option value="Administrateur">Administrateur</option>
                            <option value="Gestionnaire parc">Gestionnaire parc</option>
                            <option value="Gestionnaire livraison">Gestionnaire livraison</option>
                        </select>
                    </div>
                    <!--Nom-->
                    <div class="col-lg-6">
                        <label for="nameadd">Nom & Prénom</label>
                        <input type="text" name="nameadd" id="nameadd" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Email-->
                    <div class="col-lg-6">
                        <label for="emailadd">E-mail</label>
                        <input type="email" name="emailadd" id="emailadd" class="form-control" required>
                    </div>
                    <!--Mot de passe-->
                    <div class="col-lg-6">
                        <label for="passwordadd">Mot de passe</label>
                        <input type="password" name="passwordadd" id="passwordadd" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Phone & Ville-->
                    <!--Phone-->
                    <div class="col-lg-6">
                        <label for="phoneadd">Téléphone (+216)</label>
                        <input type="text" name="phoneadd" class="form-control" id="phoneadd" required>
                    </div>
                    <!--Ville-->
                    <div class="col-lg-6">
                        <label for="villeadd">Ville</label>
                        <input type="text" name="villeadd" id="villeadd" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Address & Zip Code-->
                    <!--Address-->
                    <div class="col-lg-6">
                        <label for="addressadd">Adresse</label>
                        <input type="text" name="addressadd" class="form-control" id="addressadd" required>
                    </div>
                    <!--Zip Code-->
                    <div class="col-lg-6">
                        <label for="zipcodeadd">Code postal</label>
                        <input type="text" name="zipcodeadd" id="zipcodeadd" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Avatar-->
                    <div class="col-lg-12">
                        <label for="avataradd">Selectionner Avatar</label>
                        <input type="file" name="avataradd" id="avataradd" class="form-control" >
                    </div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_utilisateur_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new user modal end --}}

{{-- edit user modal start --}}
<div class="modal fade" id="editUtilisateurModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Utilisateur</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('update_user')}}" method="POST" id="edit_utilisateur_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">

                    <!--role-->
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <label for="role">Rôle</label>
                        <select type="text" name="role" class="form-control" id="role" required>
                            <option value="1" disabled selected>Sélectionner rôle...</option>
                            <option value="Administrateur">Administrateur</option>
                            <option value="Gestionnaire parc">Gestionnaire parc</option>
                            <option value="Gestionnaire livraison">Gestionnaire livraison</option>
                        </select>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-12"><br></div>
                    <!--Nom-->
                    <div class="col-lg-6">
                        <label for="name">Nom & Prénom</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <!--Email-->
                    <div class="col-lg-6">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    {{-- <!--Mot de passe-->
                    <div class="col-lg-6">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div> --}}

                    <!--Phone & Ville-->
                    <!--Phone-->
                    <div class="col-lg-6">
                        <label for="phone">Téléphone (+216)</label>
                        <input type="text" name="phone" class="form-control" id="phone" required>
                    </div>
                    <!--Ville-->
                    <div class="col-lg-6">
                        <label for="ville">Ville</label>
                        <input type="text" name="ville" id="ville" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Address & Zip Code-->
                    <!--Address-->
                    <div class="col-lg-6">
                        <label for="address">Adresse</label>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>
                    <!--Zip Code-->
                    <div class="col-lg-6">
                        <label for="zipcode">Code postal</label>
                        <input type="text" name="zipcode" id="zipcode" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Avatar-->
                    <div class="col-lg-12">
                        <label for="avatar">Selectionner Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control" >
                    </div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_utilisateur_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit user modal end --}}

<script>
    //edit user ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit_user') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#user_id").val(id);
                $("#name").val(response.name);
                $("#role").val(response.role);
                $("#email").val(response.email);
                $("#password").val(response.password);
                $("#phone").val(response.phone);
                $("#ville").val(response.ville);
                $("#address").val(response.address);
                $("#zipcode").val(response.zipcode);
                $("#avatar").html(
                    `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
                $("#Utilisateur_id").val(response.id);
                $("#Utilisateur_avatar").val(response.avatar);
            }
        });
    }

    // delete user ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idUtilisateur');
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
                        url: '{{ route('delete_user') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Utilisateur Supprimé.',
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
