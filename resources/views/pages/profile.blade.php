@extends('layout.app')
@section('content')
<div class="row mt">

    <div class="col-lg-12">
        <div class="row content-panel">
            <div class="col-md-4 profile-text mt mb centered">
                <div class="right-divider hidden-sm hidden-xs">
                    <br>
                    <?php if(Auth::user()->role == "Administrateur") {?>
                    <h4>Hmida Hadil</h4>
                    <br>
                    <h6>Responsable</h6>
                    <?php } ?>

                    <?php if(Auth::user()->role == "Gestionnaire parc") {?>
                        <h4>Amor Latifa</h4>
                        <br>
                        <h6>Responsable</h6>
                    <?php } ?>

                    <?php if(Auth::user()->role == "Gestionnaire livraison") {?>
                        <h4>Hmida Fathi</h4>
                        <br>
                        <h6>Responsable</h6>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 profile-text">
                <?php if(Auth::user()->role == "Administrateur") {?>
                    <h3>Administrateur</h3> <br>
                    <h6>" Possède un Accès Total à toutes les Fonctionnalités de l'Application "</h6>
                    <p>
                        + Gestion de Utilisateurs.<br>
                        + Gestion de véhicules : Entretiens / Assurances<br>&nbsp; &nbsp; Taxes de citculation / Visites Techniques.<br>
                        + Gestion de Livraisons : Conducteurs / Commandes / Missions.<br>
                    </p>
                <?php } ?>

                <?php if(Auth::user()->role == "Gestionnaire parc") {?>
                    <h3>Gestionnaire Parc</h3> <br>
                    <h6>" Possède un Accès à certaines Fonctionnalités de l'Application "</h6>
                    <p>
                        + Gestion de Véhicules / Entretiens / Assurances<br>&nbsp; &nbsp; Taxes de circulation / Visites Techniques.<br>
                    </p>
                <?php } ?>

                <?php if(Auth::user()->role == "Gestionnaire livraison") {?>
                    <h3>Gestionnaire Livraison</h3> <br>
                    <h6>" Possède un Accès à certaines Fonctionnalités de l'Application "</h6>
                    <p>
                        + Gestion de Conducteurs / Commandes / Missions.<br>
                    </p>
                <?php } ?>

            </div>
            <div class="col-md-4 centered">
                <div class="profile-pic">

                    <?php if(!Auth::user()->image){ ?>
                        <?php if(Auth::user()->role == "Administrateur") {?>
                            <p><img src="template/img/team-1.jpg" class="img-circle"></p>
                        <?php } ?>

                        <?php if(Auth::user()->role == "Gestionnaire parc") {?>
                            <p><img src="template/img/team-2.jpg" class="img-circle"></p>
                        <?php } ?>

                        <?php if(Auth::user()->role == "Gestionnaire livraison") {?>
                            <p><img src="template/img/team-3.jpg" class="img-circle"></p>
                        <?php } ?>

                    <?php }

                    else { ?>
                        <p><img src="/uploads/profile/{{Auth::user()->image}}" class="img-circle"></p>
                    <?php } ?>

                        <p>
                            <a href="profile">
                                <button class="btn btn-theme02"><i class="fa fa-check"></i>&nbsp; Voir</button>
                            </a>
                        </p>
                </div>
            </div>
        </div>
    </div>
    <!--************************************************************************-->

    <div class="col-lg-6 col-lg-offset-3 mt">
        <div class="row content-panel">
            <div class="tab-content">
                <div class="row">
                    <form role="form" class="form-horizontal" action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-8 col-lg-offset-2 detailed">
                            <h4 class="mb">Informations Personnelles</h4>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nom & Prénom</label>
                                <div class="col-lg-6">
                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Ville</label>
                                <div class="col-lg-6">
                                    <input type="text" name="ville" class="form-control" value="{{ Auth::user()->ville }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Code postal</label>
                                <div class="col-lg-6">
                                    <input type="text" name="zipcode" class="form-control" value="{{ Auth::user()->zipcode }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-lg-2 control-label">Avatar</label>
                                <div class="col-lg-7">
                                    <input type="file" name="image" class="form-control"> <br>
                                    <img name="image" src="{{ asset('storage/images/'.Auth::user()->image) }}" class="w-75" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-lg-offset-2 detailed mt">
                            <h4 class="mb">Coordonnées</h4>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Adresse</label>
                                <div class="col-lg-6">
                                    <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Téléphone</label>
                                <div class="col-lg-6">
                                    <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" readonly value="{{ Auth::user()->email }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-theme" type="submit">Editer</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
