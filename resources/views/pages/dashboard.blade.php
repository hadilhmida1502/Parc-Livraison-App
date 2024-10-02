@extends('layout.app')
@section('content')
<div class="row">
    <script src="template/lib/chart-master/Chart.js"></script>
    <div class="col-lg-9 main-chart">
        <div class="border-head">
            <h3><i class="fa fa-angle-right"></i>&nbsp;TABLEAU DE BORD</h3>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                    <div class="grey-header">
                        <h4>VEHICULES TOTAUX</h4>
                    </div>
                    <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="{{ url('/vehicle') }}" <?php } ?> ><img src="template/img/vehicle.jpg" class="img-circle" height="120" width="120"></a>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 goleft">
                            <p>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="{{ url('/vehicle') }}" <?php } ?> >Voir<br/>Détails:</a>
                            </p>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <h2 style="line-height:0.5;">{{ $véhicules }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn" style="background: #444c57">
                    <div class="darkblue-header">
                        <h4 style="color: #fff">UTILISATEURS TOTAUX</h4>
                        <a <?php if(Auth::user()->role == "Administrateur") {?> href="{{ url('/utilisateur') }}" <?php } ?> ><h1 class="mt"><i class="fa fa-user fa-3x"></i></h1></a>
                    </div>
                    <footer>
                        <div class="centered">
                            <h5><i class="fa fa-group"></i>
                                {{ $users }} Utilisateurs
                            </h5>
                        </div>
                    </footer>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn" style="background: #4ECDC4">
                    <div class="darkblue-header" style="background: #43b1a9">
                        <h4 style="color: #FFFFFF">CONDUCTEURS TOTAUX</h4>
                    </div>
                    <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{ url('/employee') }}" <?php } ?> ><img src="template/img/conducteur.jpg" class="img-circle" height="120" width="120"></a>
                    <footer>
                        <div class="pull-left">
                            <h5>
                                <a style="color: #fff" <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{ url('/employee') }}" <?php } ?> >Voir<br/> Détails:</a>
                            </h5>
                        </div>
                        <div class="pull-right">
                            <div class="col-sm-6 col-xs-6">
                                <h1 style="line-height:0.5; color: #333"><b>{{ $conducteurs }}</b></h1>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb"><br>
                <div class="product-panel-2 pn"style="background: #4ECDC4"><br>
                    <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="{{ url('/prog_entretien') }}" <?php } ?> ><img src="template/img/entretien.jpg" width="120" height="120" class="img-circle"></a>
                    <h4 class="mt" style="color: #fff">PROGRAMMES ENTRETIENS</h4>
                    <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="{{ url('/prog_entretien') }}" <?php } ?> >
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Voir Détails : &nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-small btn-theme04">{{ $entretiens }}</button>
                        </p>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb"><br>
                <div class="grey-panel pn donut-chart" style="background: #4fc1e9;">
                    <div class="grey-header" style="background: #44A3C6;">
                        <h4 style="color: #fff">COMMANDES TOTALES</h4>
                    </div>
                    <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{ url('/commande') }}" <?php } ?> ><img src="template/img/commande.jpg" class="img-circle" height="120" width="120"></a>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 goleft">
                            <p>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{ url('/commande') }}" <?php } ?> >Voir<br/>Détails:</a>
                            </p>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <h2 style="line-height:0.5; color: #fff">{{ $commandes }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 mb"><br>
                <div class="product-panel-2 pn"><br>
                    <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{ url('/mission') }}" <?php } ?> ><img src="template/img/mission.jpg" width="120" height="120" class="img-circle"></a>
                    <h4 class="mt">Missions Totales</h4>
                    <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{ url('/mission') }}" <?php } ?> >
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Voir Détails : &nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-small btn-theme04">{{ $missions }}</button>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ****************************************** RIGHT SIDEBAR CONTENT ****************************************** -->
    <div class="col-lg-3 ds">
        <div class="donut-main">
            <h4>Missions RÉALISÉES</h4>
            <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{ url('/mission') }}" <?php } ?> >
                <canvas id="newchart" height="130" width="130"></canvas>
            </a>
            <script>
                var doughnutData = [{
                    value: 75,
                    color: "#4ECDC4"
                },
                {
                    value: 25,
                    color: "#fdfdfd"
                }];
                var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
            </script>
        </div>

        <h4 class="centered mt">LES RESPONSABLES</h4>
        <!-- First Member -->
        <div class="desc">
            <div class="thumb">
                <a <?php if(Auth::user()->role == "Administrateur") {?> href="{{route('profile')}}" <?php } ?> ><img class="img-circle" src="template/img/team-1.jpg" width="35px" height="35px"></a>
            </div>
            <div class="details"><br>
                <p>
                    <a href="dashboard">Hmida Hadil</a>
                </p>
                <h4><muted>Administrateur</muted></h4><br>
            </div>
        </div>

        <!-- Second Member -->
        <div class="desc">
            <div class="thumb">
                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="{{route('profile')}}" <?php } ?> ><img class="img-circle" src="template/img/team-2.jpg" width="35px" height="35px"></a>
            </div>
            <div class="details"><br>
                <p>
                    <a href="dashboard">Amor Latifa</a>
                </p>
                <h4><muted>Gestionnaire de Parc</muted></h4><br>
            </div>
        </div>

        <!-- Third Member -->
        <div class="desc">
            <div class="thumb">
                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="{{route('profile')}}" <?php } ?> ><img class="img-circle" src="template/img/team-3.jpg" width="35px" height="35px"></a>
            </div>
            <div class="details"><br>
                <p>
                    <a href="pages.profile">Amor Oumayma</a>
                </p>
                <h4><muted>Gestionnaire de Livraison</muted></h4><br>
            </div>
        </div>

    </div>
</div>

<script src="template/lib/jquery.sparkline.js"></script>
<script src="template/lib/sparkline-chart.js"></script>

<?php if(Auth::user()->role == "Administrateur") {?>
    <script type="text/javascript">
        $(document).ready(function() {
            var unique_id = $.gritter.add({
                title: 'Bienvenue sur MonPark!',
                text: 'Survolez-moi pour activer le bouton Fermer. Vous pouvez masquer la barre latérale gauche en cliquant sur le bouton à côté du logo.',
                image: 'template/img/team-1.jpg',
                sticky: false,
                time: 8000,
                class_name: 'my-sticky-class'
            });
            return false;
        });
    </script>
<?php } ?>

<?php if(Auth::user()->role == "Gestionnaire parc") {?>
    <script type="text/javascript">
        $(document).ready(function() {
            var unique_id = $.gritter.add({
                title: 'Bienvenue sur MonPark!',
                text: 'Survolez-moi pour activer le bouton Fermer. Vous pouvez masquer la barre latérale gauche en cliquant sur le bouton à côté du logo.',
                image: 'template/img/team-2.jpg',
                sticky: false,
                time: 8000,
                class_name: 'my-sticky-class'
            });
            return false;
        });
    </script>
<?php } ?>

<?php if(Auth::user()->role == "Gestionnaire livraison") {?>
    <script type="text/javascript">
        $(document).ready(function() {
            var unique_id = $.gritter.add({
                title: 'Bienvenue sur MonPark!',
                text: 'Survolez-moi pour activer le bouton Fermer. Vous pouvez masquer la barre latérale gauche en cliquant sur le bouton à côté du logo.',
                image: 'template/img/team-3.jpg',
                sticky: false,
                time: 8000,
                class_name: 'my-sticky-class'
            });
            return false;
        });
    </script>
<?php } ?>

@endsection
