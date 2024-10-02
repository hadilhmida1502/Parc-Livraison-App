<?php
use App\Models\Notifications;
use App\Models\Mission;
use App\Models\Assurance;

$NotificationsAssurances = Notifications::all();
$Matricules = Mission::all();
$Assurances = Assurance::all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>MonPark</title>
    <base href="{{ \URL::to('/dashbord') }}">
    <!-- Favicons -->
    <link href="template/img/logo1.png" rel="icon">
    <link href="template/img/logo2.png" rel="apple-touch-icon">
    <!-- Bootstrap core CSS -->
    <link href="template/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="template/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="template/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="template/lib/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="template/css/style.css" rel="stylesheet">
    <link href="template/css/style-responsive.css" rel="stylesheet">
    <script src="template/lib/chart-master/Chart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.11.4/datatables.min.css"/>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Basculer la Navigation"></div>
            </div>
            <!--logo-->
            <a href="/" class="logo"><b>Mon<span>Park</span></b></a>

            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li><p class="green">You have 4 pending tasks</p></li>
                            <li>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="/assurance" <?php }?> >
                                    <div class="task-info">
                                        <div class="desc">Visites en cours</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="/prog_entretien" <?php }?> >
                                    <div class="task-info">
                                        <div class="desc">Programmes entretiens</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                            <span class="sr-only">65% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="/commande" <?php }?> >
                                    <div class="task-info">
                                        <div class="desc">Commandes prêtes</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                            <span class="sr-only">35% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="/mission" <?php }?> >
                                    <div class="task-info">
                                        <div class="desc">Missions en cours</div>
                                        {{-- <div class="percent">50%</div> --}}
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                            <span class="sr-only">50% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external"><a href="/dashboard">Voir toutes les tâches</a></li>
                        </ul>
                    </li>
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle">
                            <i class="fa fa-user"></i>
                            <span class="badge bg-theme">3</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li><p class="green">Vous êtes 3 utilisateurs</p></li>
                            <li>
                                <a <?php if(Auth::user()->role == "Administrateur") {?> href="profile" <?php }?> >
                                    <span class="photo"><img alt="avatar" src="template/img/team-1.jpg"></span>
                                    <span class="subject">
                                        <span class="from">Hmida Hadil</span>
                                    </span>
                                    <span class="message">Administrateur.</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="profile" <?php }?> >
                                <span class="photo"><img alt="avatar" src="template/img/team-2.jpg"></span>
                                <span class="subject">
                                    <span class="from">Amor Latifa</span>
                                </span>
                                <span class="message">Gestionnaire Parc.</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="profile" <?php }?> >
                                    <span class="photo"><img alt="avatar" src="template/img/team-3.jpg"></span>
                                    <span class="subject">
                                        <span class="from">Amor Oumayma</span>
                                    </span>
                                    <span class="message">Gestionnaire Livraison.</span>
                                </a>
                            </li>
                            <?php if(Auth::user()->role == "Administrateur") {?>
                                <li><a href="utilisateur">Voir tous les utilisateurs</a></li>
                            <?php } ?>
                        </ul>
                    </li>

                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-warning" id="notif_assNbr">{{count($NotificationsAssurances)}}</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">Vous avez {{count($NotificationsAssurances)}} nouvelles notifs</p>
                            </li>
                            <div style="height: 50vh; overflow-y: scroll; scroll-snap-type: x mandatory;" id="notif_ass">
                                <div class="v-slider-bloc" style="height: 50vh; scroll-snap-align: center;">
                                @foreach ($NotificationsAssurances as $Notif)
                                    <li>
                                        @if($Notif->type == 'mission')
                                            <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?> href="mission" <?php }?> >
                                                <span class="label label-success">
                                                    <i class="fa fa-map-marker"></i>
                                                </span>
                                                {{$Notif->message}}
                                                <br><br>
                                                @foreach ($Matricules as $Mat)
                                                    <p class="small italic">{{$Mat->num_mission}} / {{$Mat->veh_mission}} </p>
                                                @endforeach
                                            </a>
                                        @endif

                                        @if($Notif->type == 'assurance')
                                            <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="assurance" <?php }?> >
                                                <span class="label label-warning">
                                                    <i class="fa fa-cogs"></i>
                                                </span>
                                                {{$Notif->message}}
                                                <br><br>
                                                @foreach ($Assurances as $Ass)
                                                    <p style="text-align: center" class="small italic">{{$Ass->vehicule}}</p>
                                                @endforeach
                                            </a>
                                        @endif

                                        @if($Notif->type == 'taxe')
                                            <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="assurance" <?php }?> >
                                                <span class="label label-warning">
                                                    <i class="fa fa-exclamation-triangle"></i>
                                                </span>
                                                {{$Notif->message}}
                                                <br><br>
                                                @foreach ($Assurances as $Ass)
                                                    <p style="text-align: center" class="small italic">{{$Ass->vehicule}}</p>
                                                @endforeach
                                            </a>
                                        @endif

                                        @if($Notif->type == 'visite')
                                            <a <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?> href="assurance" <?php }?> >
                                                <span class="label label-danger">
                                                    <i class="fa fa-ambulance"></i>
                                                </span>
                                                {{$Notif->message}}
                                                <br><br>
                                                @foreach ($Assurances as $Ass)
                                                    <p style="text-align: center" class="small italic">{{$Ass->vehicule}}</p>
                                                @endforeach
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                                </div>
                            </div>
                            <li><a href="notif_ass">Voir toutes les notifications</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <!--logout button-->
                    <li>
                    <form action="{{ route('logout') }}" method="POST" class="logout">
                        @csrf
                        <a style="color: white" class="logout" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Déconnexion') }}
                        </a>
                    </form>
                    </li>
                </ul>
            </div>
        </header>
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <?php if(Auth::user()->role == "Administrateur") {?>
                        <p class="centered"><a href="{{route('profile')}}"><img src="template/img/team-1.jpg" class="img-circle" width="80"></a></p>
                        <h5 class="centered">Administrateur</h5>
                    <?php } ?>

                    <?php if(Auth::user()->role == "Gestionnaire parc") {?>
                        <p class="centered"><a href="{{route('profile')}}"><img src="template/img/team-2.jpg" class="img-circle" width="80"></a></p>
                        <h5 class="centered">Gestionnaire de Parc</h5>
                    <?php } ?>

                    <?php if(Auth::user()->role == "Gestionnaire livraison") {?>
                        <p class="centered"><a href="{{route('profile')}}"><img src="template/img/team-3.jpg" class="img-circle" width="80"></a></p>
                        <h5 class="centered">Gestionnaire de Livraison</h5>
                    <?php } ?>

                    <li class="mt">
                        <a class="active" href="dashboard">
                            <i class="fa fa-dashboard"></i>
                            <span>TABLEAU DE BORD</span>
                        </a>
                    </li>

                    <?php if(Auth::user()->role == "Administrateur") {?>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-desktop"></i>
                            <span>ADMINISTRATION</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="/utilisateur">
                                    <i class="fa fa-user"></i>
                                    <span>Utilisateurs</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire parc") {?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-truck"></i>
                                <span>GESTION VEHICULES</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="/vehicle">
                                        <i class="fa fa-truck"></i>
                                        <span>Véhicules</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/type_entretien">
                                        <i class="fa fa-cogs"></i>
                                        <span>Types Entretiens</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/prog_entretien">
                                        <i class="fa fa-wrench"></i>
                                        <span>Progs ENTRETIENS</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/assurance">
                                        <i class="fa fa-thumb-tack"></i>
                                        <span>Assurance/Taxe/Visite</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if(Auth::user()->role == "Administrateur" || Auth::user()->role == "Gestionnaire livraison") {?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-shopping-cart"></i>
                                <span>GESTION LIVRAISONS</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="/employee">
                                        <i class="fa fa-group"></i>
                                        <span>Conducteurs</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/commande">
                                        <i class="fa fa-gift"></i>
                                        <span>Commandes</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/mission">
                                        <i class="fa fa-map-marker"></i>
                                        <span>Missions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>

                    <li class="sub-menu">
                        <a href="/notif_ass">
                            <i class="fa fa-bell-o"></i>
                            <span>NOTIFICATIONS</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>
    </section>

    <!-- js -->
    <script src="template/lib/chart-master/Chart.js"></script>
    <script src="template/lib/jquery/jquery.min.js"></script>
    <script src="template/lib/bootstrap/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="template/lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="template/lib/jquery.scrollTo.min.js"></script>
    <script src="template/lib/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="template/lib/jquery.sparkline.js"></script>
    <!--common script for all pages-->
    <script src="template/lib/common-scripts.js"></script>
    <script type="text/javascript" src="template/lib/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="template/lib/gritter-conf.js"></script>
    <!--script for this page-->
    <script src="template/lib/sparkline-chart.js"></script>
    <script src="template/lib/zabuto_calendar.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.11.4/datatables.min.js"></script>
    <script src="js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <section id="main-content" style="position: relative; padding-bottom: 58px; min-height: 100vh;">

        <section class="wrapper" >
            @yield('content')
        </section>

        <footer class="site-footer">
            <div class="text-center">
                <p>&copy; Copyright <strong>MonPark</strong>. Tous Les Droits Sont Réservés</p>
                <div class="credits">
                    Bonne Gestion pour Bonnes Livraisons
                </div>
                <a href="profile.html#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
    </section>
</body>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('d8a175dbfafcb6e670d2', {
            cluster: 'eu'
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            $("#notif_ass").append('<li><a href="#"><span class="label label-danger"><i class="fa fa-bolt"></i></span>'+ JSON.stringify(data.message) +'</a></li>');
            $("#notif_assNbr").text(parseInt($("#notif_assNbr").text())+1)
        });
    </script>
</html>
