<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Carte de fidélité</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="{{asset('assets/images/logosb.jpg')}}">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{ asset('assets/css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/chartist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/lib/weather-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/lib/menubar/sidebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/lib/data-table/buttons.bootstrap.min.css') }}" rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    
</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="">
                            <img src="assets/images/logosb.jpg" alt="" style="width: 60px; height:60px;" />
                            <span>App SB</span></a>
                    </div>

                    <li class="label">Main</li>
                    <li> <a href="/"> <i class="ti-home"></i>Dashboard</a></li>


                    <li class="label">Clients</li>
                    <li><a href="/clients"><i class="ti-user"></i> Gestion des clients</a></li>

                    <li class="label">Cartes</li>
                    <li><a href="/cartes"><i class="ti-layout-grid2-alt"></i> Gestion des cartes</a></li>

                    <li class="label">Commandes</li>
                    <li><a href="/commandes"><i class="ti-panel"></i> Gestion des commandes</a></li>

                    <li class="label">Produits</li>
                    <li><a href="/produits"><i class="ti-panel"></i> Gestion des produits</a></li>

                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row py-2">
                <div class="col-lg-12 ">
                    <div class="float-left d-flex">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>

                        @if (session()->has('success'))
                            <div class="alert alert-success mx-3">{{ session()->get('success') }}</div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger  mx-3">{{ session()->get('error') }}</div>
                        @endif

                    </div>

                    <div class="float-right d-flex">
                        <div class="alert alert-primary  mx-3 text-center">{{ Auth::user()->email }}</div>
                        <ul class="d-flex">
                            <li class="mx-2">
                                <a href="#" data-toggle="modal" data-target="#change_password_modal">
                                    <i class="ti-settings"></i>
                                    <span>Password</span>
                                </a>
                            </li>

                            <li class="mx-2">
                                <a href="/logout" class="text-danger">
                                    <i class="ti-power-off"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Change password  Modal -->
    <div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Changement de mot de passe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/change">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="mot_de_passe_actuel">Mot de passe actuel</label>
                            <input type="password" required class="form-control" id="mot_de_passe_actuel"
                                placeholder="Mot de passe actuel" name="mot_de_passe_actuel">
                            <small class="form-text text-muted">Ceci est obligatoire pour modifer votre mot de
                                passe</small>
                        </div>
                        <div class="form-group">
                            <label for="nouveau_mot_de_passe">Nouveau mot de passe</label>
                            <input type="password" required class="form-control" id="nouveau_mot_de_passe"
                                placeholder="Nouveau mot de passe" name="nouveau_mot_de_passe">
                        </div>
                        <div class="form-group">
                            <label for="confirmer_le_nouveau_mot_de_passe">Confirmer le mot de passe</label>
                            <input type="password" required class="form-control"
                                id="confirmer_le_nouveau_mot_de_passe" placeholder="Confirmer le mot de passe"
                                name="confirmer_le_nouveau_mot_de_passe">
                        </div>
                        <div class="d-flex" style="justify-content: flex-end">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                @yield('content')

            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.nanoscroller.min.js') }}"></script>
    <!-- nano scroller -->
    <script src="{{ asset('assets/js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ asset('assets/js/lib/preloader/pace.min.js') }}"></script>
    <!-- sidebar -->

    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- bootstrap -->

    <script src="{{ asset('assets/js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/calendar-2/pignose.init.js') }}"></script>


    <script src="{{ asset('assets/js/lib/weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/weather/weather-init.js') }}"></script>
    <script src="{{ asset('assets/js/lib/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/circle-progress/circle-progress-init.js') }}"></script>
    <script src="{{ asset('assets/js/lib/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/sparklinechart/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/sparklinechart/sparkline.init.js') }}"></script>
    <script src="{{ asset('assets/js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/owl-carousel/owl.carousel-init.js') }}"></script>

    <!-- scripit init-->
    <script src="{{ asset('assets/js/dashboard2.js') }}"></script>

    <!-- scripit init-->
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/datatables-init.js') }}"></script>

    
<script src="assets/js/multiselect-dropdown.js" ></script>
    
</body>

</html>
