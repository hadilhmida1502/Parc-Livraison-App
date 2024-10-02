@extends('layout.app')
@section('content')
<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addTypeModal">Ajouter</button>
                <h4><b>GESTION DES TYPES D'ENTRETIENS</b></h4>
            </div>

            <hr>
            <?php if(count($Type_Entretiens) > 0){ ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th width="30%">Description</th>
                        <th width="25%">Répéter Toutes</th>
                        <th width="25%">Rappel Avant</th>
                        <th class="text-center" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Type_Entretiens as $Type_Entretien)
                    <tr>
                        <td class="text-center">{{$Type_Entretien->description}}</td>
                        <td class="text-center">"{{$Type_Entretien->Trepete_number}}" kilométres</td>
                        <td class="text-center">"{{$Type_Entretien->Trappel_number}}" kilométres</td>
                        <td class="text-center">
                            <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editTypeModal" onclick="modifyfunction({{$Type_Entretien->id}})">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Modifier</span>
                            </button>
                            <button type="button" idType="{{$Type_Entretien->id}}" class="btn btn-theme04 ">
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

{{-- add new type entretien modal start --}}
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nouveau Type Entretien</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('store_type_entretien')}}" method="POST" id="add_type_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--Description-->
                    <div class="col-lg-12">
                        <label for="descriptionadd">Description</label>
                        <input type="text" name="descriptionadd" id="descriptionadd" class="form-control" placeholder="description..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Répéter Toutes & Ou Rappel Avant-->
                    <!--Répéter Toutes-->
                    <div class="col-lg-6">
                        <label for="Trepete_numberadd">Répéter Toutes (Km)</label>
                        <input type="number" min="1" name="Trepete_numberadd" id="Trepete_numberadd" class="form-control" placeholder="Nombres kilométres..." required>
                    </div>
                    <!--Rappel Avant-->
                    <div class="col-lg-6">
                        <label for="Trappel_numberadd">Rappel Avant (Km)</label>
                        <input type="number" min="1" name="Trappel_numberadd" id="Trappel_numberadd" class="form-control" placeholder="Nombres kilométres..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="add_user_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new type entretien modal end --}}

{{-- edit type entretien modal start --}}
<div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Type Entretien</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('update_type_entretien')}}" method="POST" id="edit_type_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type_id" id="type_id">
                <div class="modal-body">
                    <!--Description-->
                    <div class="col-lg-2">&nbsp;</div>
                    <div class="col-lg-8">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" readonly required>
                    </div>
                    <div class="col-lg-2">&nbsp;</div>
                    <div class="col-lg-12"><br></div>

                    <!--Répéter Toutes & Ou Rappel Avant-->
                    <!--Répéter Toutes-->
                    <div class="col-lg-6">
                        <label for="Trepete_number">Répéter Toutes (Km)</label>
                        <input type="number" min="1" name="Trepete_number" id="Trepete_number" class="form-control" required>
                    </div>
                    <!--Rappel Avant-->
                    <div class="col-lg-6">
                        <label for="Trappel_number">Rappel Avant (Km)</label>
                        <input type="number" min="1" name="Trappel_number" id="Trappel_number" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_type_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit type entretien modal end --}}

<script>
    //edit type entretien ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit_type_entretien') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#type_id").val(id);
                $("#description").val(response.description);
                $("#Trepete_number").val(response.Trepete_number);
                $("#Trappel_number").val(response.Trappel_number);
                $("#Entretien_id").val(response.id);
            }
        });
    }

    // delete type entretien ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idType');
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
                        url: '{{ route('delete_type_entretien') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Type Entretien Supprimé.',
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
