<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>MonPark</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="assets/img/logo1.png" rel="icon">
    <link href="assets/img/logo2.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo"><img style="width: 100%;" src="assets/img/logo2.png"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    @if (Route::has('login'))
                    <li><a class="nav-link scrollto active" href="#hero">Accueil</a></li>
                    <li><a class="nav-link scrollto" href="#about">A Propos</a></li>
                    <li><a class="nav-link scrollto" href="#features">Services</a></li>
                    <li><a class="nav-link scrollto" href="#team">Equipe</a></li>
                    <li>
                        @auth
                            <a class="getstarted scrollto" href="{{ url('/dashboard') }}">Tableau de Bord</a>
                            @else
                                <li><a class="getstarted scrollto" href="{{ route('login') }}">Se Connecter</a></li>
                            @if (Route::has('register'))
                                <li><a class="getstarted scrollto" href="{{ route('register') }}">S'Inscrire</a></li>
                            @endif
                        @endauth
                    </li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Tout ce dont vous avez besoin dans un seul logiciel</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">MonPark, est un logiciel de gestion de parcs automobiles et de livraisons</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Commencer</span>
                            <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="row gx-0">
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>Qui Sommes-Nous ?</h3>
                            <h2>Avec MonPark, vous pouvez gérer tout concernant votre parc automobile sans difficulté</h2>
                            <p>
                                La gestion de parcs devient un jeu d'enfant avec MonPark. <br>
                                Vous pouvez surveiller votre parc en quelques clics.
                                {{-- Gérez tout grâce à un système administratif convivial. --}}
                            </p>
                            <div class="text-center text-lg-start">
                                <a href="#features" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Lire Plus</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="assets/img/about.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section> <br>

        <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Services</h2>
                <p>Nos services offerts</p>
            </header>
            <div class="row">
                <div class="col-lg-6">
                    <img src="assets/img/features.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                    <div class="row align-self-center gy-4">
                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Gestion des Véhicules</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Gestion des Conducteurs</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Gestion des Entretiens</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Gestion des Commandes</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Gestion des Assurances, Taxes et Visites</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Gestion des Missions</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feature Icons -->
            <div class="row feature-icons" data-aos="fade-up">
                <h3>Nos Caractéristiques Parlent de Nous</h3>
                <div class="row">
                    <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="assets/img/features-2.jpg" class="img-fluid p-4" alt="">
                    </div>
                    <div class="col-xl-8 d-flex content">
                        <div class="row align-self-center gy-4">
                            <div class="col-md-6 icon-box" data-aos="fade-up">
                                <i class="ri-line-chart-line"></i>
                                <div>
                                    <h4>Contraintes de performance</h4>
                                    <p>Accès rapide et facile aux informations.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="ri-stack-line"></i>
                                <div>
                                    <h4>Temps réel</h4>
                                    <p>
                                        Envoi des notifications en temps réel.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="ri-brush-4-line"></i>
                                <div>
                                    <h4>Confidentialité</h4>
                                    <p>La garantie de la confidentialité de données des utilisateurs.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="ri-magic-line"></i>
                                <div>
                                    <h4>Ponctualité</h4>
                                    <p>Livraisons dans le temps.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                <i class="ri-command-line"></i>
                                <div>
                                    <h4>Convivialité</h4>
                                    <p>Facilité d'utilisation : interfaces simples, ergonomiques et adaptées aux responsables.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                                <i class="ri-radar-line"></i>
                                <div>
                                    <h4>Besoins de sécurité</h4>
                                    <p>Sécurité des utilisateurs assurée : la nécessité de procéder à leur authentification.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Equipe</h2>
                <p>Notre équipe de travail</p>
            </header>
            <div class="row gy-4">
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <div class="member">
                        <div class="member-img">
                            <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Gestionnaire Parc</h4>
                            <span>Gestion de :</span>
                            <p>Véhicules / Entretiens / Asuurances / Taxes de circulation / Visites techniques</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="member">
                        <div class="member-img">
                            <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Administrateur</h4>
                            <span>Gestion de totales fontionnalités</span>
                            <p><b>+</b> Gestion des utilisateurs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="member">
                        <div class="member-img">
                            <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Gestionnaire Livraison</h4>
                            <span>Gestion de :</span>
                            <p>Conducteurs / Commandes / Missions</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>

        <!-- ======= Values Section ======= -->
    <section id="values" class="values">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <p>Véhicules & Conducteurs</p>
            </header>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="box"><br>
                        <img src="assets/img/vehicle.jpg" class="img-fluid" alt="">
                        <h3>Nos "Véhicules"</h3>
                        <p><b>{{ $véhicules }}</b> Véhicules</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="box">
                        <img src="assets/img/driver.jpg" class="img-fluid" alt="">
                        <h3>Nos "Conducteurs"</h3>
                        <p><b>{{ $conducteurs }}</b> Conducteurs</p>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-newsletter"></div>
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="/" class="logo d-flex align-items-center"><img src="assets/img/logo3.png" alt=""></a>
                        <br>
                        <strong style="text-decoration: underline;">Bonne Gestion</strong> Pour <b><strong style="text-decoration: underline;">Bonnes Livraisons</strong></b>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Liens Utiles</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#hero">Accueil</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#about">A Propos</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#features">Services</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#team">Equipe</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Nos Services</h4>
                        <ul>
                            <li style="color: #008A81;"><i class="bi bi-chevron-right"></i>Gestion Véhicules</li>
                            <li style="color: #008A81;"><i class="bi bi-chevron-right"></i>Gestion Conducteurs</li>
                            <li style="color: #008A81;"><i class="bi bi-chevron-right"></i>Gestion Commandes</li>
                            <li style="color: #008A81;"><i class="bi bi-chevron-right"></i>Gestion Missions</li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contactez Nous</h4>
                        <p>Bâtiment Gommrasi 4ème étage,<br> Avenue Salem Bchir<br>
                            Monastir 5000, Tunisie <br><br>
                            <strong>Téléphone:</strong> +216 50 658 586<br>
                            <strong>E-mail:</strong> info@e-solutions.com<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>MonPark</span></strong>. Tous les droits sont réservés
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>
</html>
