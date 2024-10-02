@extends('layout.app')
@section('content')
<br><br>
<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel" style="padding:20px">
            <div class="showback">
                <h4><b>NOTIFICATIONS</b></h4>
            </div>
            <hr>
            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th width="10%">Identifiant</th>
                        <th width="20%">Message</th>
                        {{-- <th>N° ( Assurance / Taxe<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Visite / Mission)</th> --}}
                        <th width="40%">N° Assurance / Taxe de circulation / Visite Technique / Mission</th>
                        <th width="15%">Type</th>
                        <th width="15%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Notifications as $Notification)
                    <tr>
                        <td class="text-center">{{$Notification->id}}</td>
                        <td class="text-center">{{$Notification->message}}</td>
                        <td class="text-center">{{$Notification->vehicules}}</td>
                        <td class="text-center">{{$Notification->type}}</td>
                        <td class="text-center">
                            <button class="btn btn-theme02">
                                <span>
                                    @if($Notification->type == 'mission')
                                        <a style="color: #fff" <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire Livraison") {?> href="mission" <?php }?> >
                                            Voir Détails
                                        </a>
                                    @endif
                                    @if($Notification->type == 'assurance')
                                        <a style="color: #fff" <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire Parc") {?> href="assurance" <?php }?> >
                                            Voir Détails
                                        </a>
                                    @endif
                                    @if($Notification->type == 'taxe')
                                        <a style="color: #fff" <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire Parc") {?> href="assurance" <?php }?> >
                                            Voir Détails
                                        </a>
                                    @endif
                                    @if($Notification->type == 'visite')
                                        <a style="color: #fff" <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire Parc") {?> href="assurance" <?php }?> >
                                            Voir Détails
                                        </a>
                                    @endif
                                </span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
@endsection
