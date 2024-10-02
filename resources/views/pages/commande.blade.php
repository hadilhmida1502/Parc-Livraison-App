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
                <button style="float: right" type="button" class="btn btn-default" data-toggle="modal" data-target="#addCommandeModal">Ajouter</button>
                <h4><b>GESTION DES COMMANDES</b></h4>
            </div>
            <hr>
            <?php if(count($Commandes) > 0){ ?>

                @if (Session::has('order_message'))
                <div class="alert show">
                    <span class="msg">{{ Session::get('order_message') }}</span>
                    <span aria-hidden="true" type="button" class="close" data-dismiss="alert" aria-label="Close">X</span>
                </div>
                @endif

            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th width="20%">Réf Commande</th>
                        <th width="20%">Nature Commande</th>
                        <th width="12%">Poids (Kg)</th>
                        <th width="18%">Statut</th>
                        <th width="30%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Commandes as $Commande)
                    <tr>
                        <td class="text-center">{{$Commande->réf_cmd}}</td>
                        <td class="text-center">{{$Commande->nature}}</td>
                        <td class="text-center">{{$Commande->poids_cmnd}}</td>
                        {{-- <td class="text-center">{{$Commande->status_cmd}}</td> --}}
                        <td class="text-center">
                            @if($Commande->status_cmd=="Livrée")
                                <span class="label label-success">{{$Commande->status_cmd}}</span>
                            @elseif($Commande->status_cmd=="Annulée")
                                <span class="label label-danger">{{$Commande->status_cmd}}</span>
                            @else
                                <span class="label label-warning">{{$Commande->status_cmd}}</span> {{-- Affectée --}}
                            @endif
                        </td>

                        <td class="text-center">
                            <button type="button" idCommande="{{$Commande->id}}" class="btn btn-theme04">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Supprimer</span>
                            </button>
                            <button type="reset" class="btn btn-theme02" data-toggle="modal" data-target="#editCommandeModal" onclick="modifyfunction({{$Commande->id}})">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Modifier</span>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown">Statut
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{url('/updateOrderStatus/'.$Commande->id.'/'.'Livrée')}}">Livrée</a></li>
                                    <li><a href="{{url('/updateOrderStatus/'.$Commande->id.'/'.'Annulée')}}">Annulée</a></li>
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

{{-- add new commande modal start --}}
<div class="modal fade" id="addCommandeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nouvelle Commande</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('store_commande')}}" method="POST" id="add_commande_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--Réf Commande & Nature Commande-->
                    <!--Réf Commande-->
                    <div class="col-lg-6">
                        <label for="réf_cmdadd">Réf Commande</label>
                        <input type="text" name="réf_cmdadd" id="réf_cmdadd" class="form-control" placeholder="Référence..." required>
                    </div>
                    <!--Nature Commande-->
                    <div class="col-lg-6">
                        <label for="natureadd">Nature Commande</label>
                        <input type="text" name="natureadd" id="natureadd" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Produit & Quantité & Prix Commande-->
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <span id="result"></span>
                            <table class="table table-bordered table-striped" id="user_table">
                                <thead>
                                    <tr>
                                        <th width="30%">Produit</th>
                                        <th width="20%">Prix (TND)</th>
                                        <th width="15%">Quantité</th>
                                        <th width="20%">Total (TND)</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dynamic"></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan=3>Total Général (TND)</th>
                                        <th colspan=3><center id="Ttotal">0.00</center></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" id="Gtotal_test" name="Gtotal_test">
                        </div>
                    </div>

                    <!--Poids Commande & Nom Destinataire-->
                    <!--Poids Commande-->
                    <div class="col-lg-6">
                        <label for="poids_cmndadd">Poids Commande (Kg)</label>
                        <input type="text" name="poids_cmndadd" id="poids_cmndadd" class="form-control" placeholder="Poids..." required>
                    </div>
                    <!--Nom Destinataire-->
                    <div class="col-lg-6">
                        <label for="destinataireadd">Nom et Prénom Destinataire</label>
                        <input type="text" name="destinataireadd" id="destinataireadd" class="form-control" placeholder="Nom & Prénom..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Tél Destinataire & Email Destinataire-->
                    <!--Tél Destinataire-->
                    <div class="col-lg-6">
                        <label for="tél_destadd">Téléphone Destinataire</label>
                        <input type="text" name="tél_destadd" id="tél_destadd" class="form-control" placeholder="Téléphone..." required>
                    </div>
                    <!--Email Destinataire-->
                    <div class="col-lg-6">
                        <label for="mail_destadd">E-mail Destinataire</label>
                        <input type="email" name="mail_destadd" id="mail_destadd" class="form-control" placeholder="E-mail..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Ville Commande & Adresse Commande-->
                    <!--Ville Commande-->
                    <div class="col-lg-6">
                        <label for="ville_cmndadd">Ville Destinataire</label>
                        <input type="text" name="ville_cmndadd" id="ville_cmndadd" class="form-control" placeholder="Ville..." required>
                    </div>
                    <!--Adresse Commande-->
                    <div class="col-lg-6">
                        <label for="adr_cmndadd">Adresse Destinataire</label>
                        <input type="text" name="adr_cmndadd" id="adr_cmndadd" class="form-control" placeholder="Adresse..." required>
                    </div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="add_commande_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- add new Commande modal end --}}

{{-- edit Commande modal start --}}
<div class="modal fade" id="editCommandeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modifier Commande</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{route('update_commande')}}" method="POST" id="edit_commande_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="commande_id" id="commande_id">
                <div class="modal-body">
                    <!--Réf Commande & Nature Commande-->
                    <!--Réf Commande-->
                    <div class="col-lg-6">
                        <label for="réf_cmd">Réf Commande</label>
                        <input type="text" name="réf_cmd" id="réf_cmd" class="form-control" readonly required>
                    </div>
                    <!--Nature Commande-->
                    <div class="col-lg-6">
                        <label for="nature">Nature Commande</label>
                        <input type="text" name="nature" id="nature" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Poids Commande & Nom Destinataire-->
                    <!--Poids Commande-->
                    <div class="col-lg-6">
                        <label for="poids_cmnd">Poids Commande (Kg)</label>
                        <input type="text" name="poids_cmnd" id="poids_cmnd" class="form-control" required>
                    </div>
                    <!--Nom Destinataire-->
                    <div class="col-lg-6">
                        <label for="destinataire">Nom et Prénom Destinataire</label>
                        <input type="text" name="destinataire" id="destinataire" class="form-control" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Tél Destinataire & Email Destinataire-->
                    <!--Tél Destinataire-->
                    <div class="col-lg-6">
                        <label for="tél_dest">Téléphone Destinataire</label>
                        <input type="text" name="tél_dest" id="tél_dest" class="form-control" readonly required>
                    </div>
                    <!--Email Destinataire-->
                    <div class="col-lg-6">
                        <label for="mail_dest">E-mail Destinataire</label>
                        <input type="email" name="mail_dest" id="mail_dest" class="form-control" readonly required>
                    </div>
                    <div class="col-lg-12"><br></div>

                    <!--Ville Commande & Adresse Commande-->
                    <!--Ville Commande-->
                    <div class="col-lg-6">
                        <label for="ville_cmnd">Ville Destinataire</label>
                        <input type="text" name="ville_cmnd" id="ville_cmnd" class="form-control" required>
                    </div>
                    <!--Adresse Commande-->
                    <div class="col-lg-6">
                        <label for="adr_cmnd">Adresse Destinataire</label>
                        <input type="text" name="adr_cmnd" id="adr_cmnd" class="form-control" required>
                    </div>
                    <div class="col-lg-12"><br></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-theme" id="edit_commande_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>{{-- edit Commande modal end --}}

<script>
    //edit commande ajax request
    function modifyfunction(id) {
        $.ajax({
            url: '{{ route('edit_commande') }}',
            method: 'get',
            data: {
            id: id,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#commande_id").val(id);
                $("#réf_cmd").val(response.réf_cmd);
                $("#nature").val(response.nature);
                $("#poids_cmnd").val(response.poids_cmnd);
                $("#destinataire").val(response.destinataire);
                $("#tél_dest").val(response.tél_dest);
                $("#mail_dest").val(response.mail_dest);
                $("#ville_cmnd").val(response.ville_cmnd);
                $("#adr_cmnd").val(response.adr_cmnd);
            }
        });
    }

    // delete commande ajax request
    $(function() {
        $(document).on('click', '.btn-theme04', function(e) {
            e.preventDefault();
            let id = $(this).attr('idCommande');
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
                        url: '{{ route('delete_commande') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Supprimé!',
                                'Commande Supprimée.',
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
    $(document).ready(function(){
        var count = 1;
        dynamic_field(count);

        function dynamic_field(number)
        {
            html = '<tr>';
            html += '<td><select type="text" onchange="priceFunc(this)" name="produit_test[]" class="selectClass form-control"><option value="1" disabled selected>Produit...</option><option value="produit 1" prix="50" >produit 1</option><option value="produit 2" prix="60">produit 2</option><option value="produit 3" prix="70">produit 3</option></select></td>';
            html += '<td><input type="text" name="prix_test[]" class="test form-control" readonly/></td>';
            /* html += '<td><input type="text" onchange="priceFunc(this)" name="produit_test[]" class="test form-control" placeholder="produit..."/></td>';
            html += '<td><input type="text" name="prix_test[]" class="test form-control" /></td>'; */

            html += '<td><input min="1" type="number" onchange="totalFunc(this)" name="quantité_test[]" class="form-control" /></td>';
            html += '<td><input type="text" name="total_test[]" class="totalClass form-control" readonly/></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Eliminer</button></td></tr>';
                $("#dynamic").append(html);
            }
            else
            {
                html += '<td><button style="float: center" type="button" name="add" id="add" class="btn btn-success">Ajouter</button></td></tr>';
                $("#dynamic").html(html);
            }
        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });
    });
</script>
<script>
    function priceFunc(params) {
        $(params).closest('td').closest('tr').find('.test').val($(params).closest('td').closest('tr').find('.selectClass option:selected').attr('prix'));
    }

    function totalFunc(params) {
        var prix = parseFloat($(params).closest('td').closest('tr').find('.test').val());
        var Q = parseInt($(params).val());
        $(params).closest('td').closest('tr').find('.totalClass').val(prix*Q);
        var total =0;
        $(".totalClass").each(function (params) {
            total = total + parseFloat($(this).val());
        })
        $("#Ttotal").text(total);
        $("#Gtotal_test").val(total);
    }
</script>

@endsection
