@extends('layout.app')
@section('content')
<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addAssuranceModal">Ajouter</button>
                <h4><b>GESTION DES ASSURANCES / TAXES / VISITES</b></h4>
            </div>
            <hr>
            <?php if(count($Assurances) > 0){ ?>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="16%">Matricule Véhicule</th>
                            <th width="20%">Expiration Assurance</th>
                            <th width="20%">Expiration Taxe</th>
                            <th width="20%">Prochaine Visite</th>
                            <th class="text-center" width="24%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Assurances as $Assurance)
                            <tr>
                                <td class="text-center">{{$Assurance->vehicule}}</td>
                                <td class="text-center">{{$Assurance->exp_ass}}</td>
                                <td class="text-center">{{$Assurance->exp_taxe}}</td>
                                <td class="text-center">{{$Assurance->proch_vt}}</td>
                                <td class="text-center">
                                    <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editAssuranceModal" onclick="modifyfunction({{$Assurance->id}})">
                                        <i class="fa fa-pencil-square-o"></i>
                                        <span>Modifier</span>
                                    </button>
                                    <button type="button" idAssurance="{{$Assurance->id}}" class="btn btn-theme04 ">
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

{{-- add new assurance modal start --}}
<div class="modal fade" id="addAssuranceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ajouter Assurance / Taxe / Visite</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <!--ajouté pour la décomposition en 3 tableaux-->
            <div class="panel-heading">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#assurance">Assurance</a></li>
                    <li><a data-toggle="tab" href="#taxe" class="contact-map">Taxe Circulation</a></li>
                    <li><a data-toggle="tab" href="#visite">Visite Technique</a></li>
                </ul>
            </div>

            <form action="{{route('store_assurance')}}" method="POST" id="add_assurance_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">

                        <!-- ******************** Assurance ******************** -->
                        <div id="assurance" class="tab-pane active">
                            <!--Date Assurance & Expiration Assurance-->
                            <!--Date Assurance-->
                            <div class="col-lg-6">
                                <label for="date_assadd">Date Assurance</label>
                                <input type="date" name="date_assadd" class="form-control" id="date_assadd">
                            </div>

                            <!--Expiration Assurance-->
                            <div class="col-lg-6">
                                <label for="exp_assadd">Expiration Assurance</label>
                                <input type="date" name="exp_assadd" class="form-control" id="exp_assadd" >
                            </div>
                            <div class="col-lg-12"><br></div>

                            <!--Rappel & Véhicule-->
                            <!--Rappel-->
                            <div class="col-lg-6">
                                <label for="rappel_assadd">Rappel Avant (jours)</label>
                                <input min="1" type="number" name="rappel_assadd" id="rappel_assadd" class="form-control" placeholder="Rappel...">
                            </div>
                            <!--Véhicule-->
                            <div class="col-lg-6">
                                <label for="vehiculeadd">Véhicule</label>
                                <select type="text" name="vehiculeadd" id="vehiculeadd" class="form-control">
                                    <option value="1" disabled selected>Sélectionner Véhicule...</option>
                                    @foreach ($Véhicules as $Véhicule)
                                        <option idVéhicule="{{$Véhicule->id}}">{{$Véhicule->matricule}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12"><br></div>

                        </div><!-- /assurance -->

                        <!-- ******************** Taxe ******************** -->
                        <div id="taxe" class="tab-pane">
                            <!--Date Taxe & Expiration Taxe-->
                            <!--Date Taxe-->
                            <div class="col-lg-6">
                                <label for="date_taxeadd">Date Taxe Circulation</label>
                                <input type="date" name="date_taxeadd" class="form-control" id="date_taxeadd">
                            </div>
                            <!--Expiration Taxe-->
                            <div class="col-lg-6">
                                <label for="exp_taxeadd">Expiration Taxe Circulation</label>
                                <input type="date" name="exp_taxeadd" class="form-control" id="exp_taxeadd">
                            </div>
                            <div class="col-lg-12"><br></div>

                            <!--Rappel-->
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-6">
                                <label for="rappel_taxeadd">Rappel Avant (jours)</label>
                                <input min="1" type="number" name="rappel_taxeadd" id="rappel_taxeadd" class="form-control" placeholder="Rappel...">
                            </div>
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-12"><br></div>
                        </div><!-- /taxe -->

                        <!-- ******************** Visite ******************** -->
                        <div id="visite" class="tab-pane">
                            <!--Dernière Visite & Prochaine Visite-->
                            <!--Dernière Visite-->
                            <div class="col-lg-6">
                                <label for="der_vtadd">Dernière Visite Technique</label>
                                <input type="date" name="der_vtadd" class="form-control" id="der_vtadd">
                            </div>
                            <!--Prochaine Visite-->
                            <div class="col-lg-6">
                                <label for="proch_vtadd">Prochaine Visite Technique</label>
                                <input type="date" name="proch_vtadd" class="form-control" id="proch_vtadd">
                            </div>
                            <div class="col-lg-12"><br></div>

                            <!--Rappel-->
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-6">
                                <label for="rappel_vtadd">Rappel Avant (jours)</label>
                                <input min="1" type="number" name="rappel_vtadd" id="rappel_vtadd" class="form-control" placeholder="Rappel...">
                            </div>
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-12"><br></div>
                        </div><!-- /visite -->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="add_assurance_btn" style="background: #4ECDC4">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new assurance modal end --}}

{{-- edit assurance modal start --}}
<div class="modal fade" id="editAssuranceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Assurance / Taxe / Visite</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <!--ajouté pour la décomposition en 3 tableaux-->
            <div class="panel-heading">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#assurance2">Assurance</a></li>
                    <li><a data-toggle="tab" href="#taxe2" class="contact-map">Taxe Circulation</a></li>
                    <li><a data-toggle="tab" href="#visite2">Visite Technique</a></li>
                </ul>
            </div>

            <form action="{{route('update_assurance')}}" method="POST" id="edit_assurance_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ass_id" id="ass_id">
                <div class="modal-body">

                    <div class="tab-content">

                        <!-- ******************** Assurance ******************** -->
                        <div id="assurance2" class="tab-pane active">
                            <!--Date Assurance & Expiration Assurance-->
                            <!--Date Assurance-->
                            <div class="col-lg-6">
                                <label for="date_ass">Date Assurance</label>
                                <input type="date" name="date_ass" class="form-control" id="date_ass">
                            </div>
                            <!--Expiration Assurance-->
                            <div class="col-lg-6">
                                <label for="exp_ass">Expiration Assurance</label>
                                <input type="date" name="exp_ass" class="form-control" id="exp_ass">
                            </div>
                            <div class="col-lg-12"><br></div>

                            <!--Rappel & Véhicule-->
                            <!--Rappel-->
                            <div class="col-lg-6">
                                <label for="rappel_ass">Rappel Avant (jours)</label>
                                <input min="1" type="number" name="rappel_ass" id="rappel_ass" class="form-control">
                            </div>
                            <!--Véhicule-->
                            <div class="col-lg-6">
                                <label for="vehicule">Véhicule</label>
                                <input type="text" name="vehicule" id="vehicule" class="form-control" readonly>
                            </div>
                            <div class="col-lg-12"><br></div>

                        </div><!-- /assurance -->

                        <!-- ******************** Taxe ******************** -->
                        <div id="taxe2" class="tab-pane">
                            <!--Date Taxe & Expiration Taxe-->
                            <!--Date Taxe-->
                            <div class="col-lg-6">
                                <label for="date_taxe">Date Taxe Circulation</label>
                                <input type="date" name="date_taxe" class="form-control" id="date_taxe">
                            </div>
                            <!--Expiration Taxe-->
                            <div class="col-lg-6">
                                <label for="exp_taxe">Expiration Taxe Circulation</label>
                                <input type="date" name="exp_taxe" class="form-control" id="exp_taxe">
                            </div>
                            <div class="col-lg-12"><br></div>

                            <!--Rappel-->
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-6">
                                <label for="rappel_taxe">Rappel Avant (jours)</label>
                                <input min="1" type="number" name="rappel_taxe" id="rappel_taxe" class="form-control">
                            </div>
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-12"><br></div>
                        </div><!-- /taxe -->

                        <!-- ******************** Visite ******************** -->
                        <div id="visite2" class="tab-pane">
                            <!--Dernière Visite & Prochaine Visite-->
                            <!--Dernière Visite-->
                            <div class="col-lg-6">
                                <label for="der_vt">Dernière Visite Technique</label>
                                <input type="date" name="der_vt" class="form-control" id="der_vt">
                            </div>
                            <!--Prochaine Visite-->
                            <div class="col-lg-6">
                                <label for="proch_vt">Prochaine Visite Technique</label>
                                <input type="date" name="proch_vt" class="form-control" id="proch_vt">
                            </div>
                            <div class="col-lg-12"><br></div>

                            <!--Rappel-->
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-6">
                                <label for="rappel_vt">Rappel Avant (jours)</label>
                                <input min="1" type="number" name="rappel_vt" id="rappel_vt" class="form-control">
                            </div>
                            <div class="col-lg-3">&nbsp;</div>
                            <div class="col-lg-12"><br></div>
                        </div><!-- /visite -->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success" id="edit_assurance_btn" style="background: #4ECDC4">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit assurance modal end --}}

<script>
    //edit assurance ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit_assurance') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#ass_id").val(id);
                $("#date_ass").val(response.date_ass);
                $("#exp_ass").val(response.exp_ass);
                $("#rappel_ass").val(response.rappel_ass);
                $("#vehicule").val(response.vehicule);

                $("#date_taxe").val(response.date_taxe);
                $("#exp_taxe").val(response.exp_taxe);
                $("#rappel_taxe").val(response.rappel_taxe);

                $("#der_vt").val(response.der_vt);
                $("#proch_vt").val(response.proch_vt);
                $("#rappel_vt").val(response.rappel_vt);
            }
        });
    }

    // delete assurance ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idAssurance');
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
                        url: '{{ route('delete_assurance') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Supprimés avec succès.',
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
