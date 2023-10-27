<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Mono - Responsive Admin & Dashboard Template</title>
    
  <!-- theme meta -->
  <meta name="theme-name" content="mono" />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <!-- FAVICON -->
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />

  <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
</head>


  <body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    
    <div id="toaster"></div>
    

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
      
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/index.html">
                <img src="{{ asset('images/logo.png') }}" alt="Mono">
                <span class="brand-name">MONO</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                
                    <li class="active">
                        <a class="sidenav-item-link" href="accueil.html">
                            <i class="mdi mdi-briefcase-account-outline"></i>
                            <span class="nav-text">Business Dashboard</span>
                        </a>
                    </li>
                
                    <li>
                        <a class="sidenav-item-link" href="analytics.html">
                            <i class="mdi mdi-chart-line"></i>
                            <span class="nav-text">Analytics Dashboard</span>
                        </a>
                    </li>
                
                    <li class="section-title"> Apps </li>

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#annonce"
                            aria-expanded="false" aria-controls="annonce">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">Annonce</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="annonce" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('liste_annonce') }}">
                                        <span class="nav-text">Liste des annonces</span>
                                    </a></li>
                        
                                </div>
                            </ul>
                        </li>

                        @if(session("profil") == 5 && session("employer") != 'null')
                          <li>
                            <a class="sidenav-item-link" href="{{ route('ajout_Conge') }}">
                                <i class="mdi mdi-calendar-check"></i>
                                <span class="nav-text">Conge et absence</span>
                            </a>
                          </li>
                        @elseif( session("profil") == 20 )
                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#service"
                            aria-expanded="false" aria-controls="service">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">Services / Postes</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="service" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('ajout_service') }}">
                                        <span class="nav-text">Ajouter une service</span>
                                    </a></li>

                                    <li><a class="sidenav-item-link" href="{{ route('ajout_poste') }}">
                                        <span class="nav-text">Ajouter un poste</span>
                                    </a></li>
                        
                                </div>
                            </ul>
                        </li>

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#besoin"aria-expanded="false" aria-controls="besoin">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">Besoins des services</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="besoin" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('ajout_besoin') }}">
                                        <span class="nav-text">Ajouter un besoin</span>
                                    </a></li>
                        
                                </div>
                            </ul>
                        </li>

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#contrat"
                            aria-expanded="false" aria-controls="contrat">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">Contrat</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="contrat" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('contrat_essaie') }}">
                                        <span class="nav-text">Contrat D'essaie</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('liste_contrat_renouveler') }}">
                                        <span class="nav-text">Contrat A renouveler</span>
                                    </a></li>
                        
                                </div>
                            </ul>
                        </li>
                        
                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#personnel"
                            aria-expanded="false" aria-controls="personnel">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">Personnel</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="personnel" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('recherche_un_personnel') }}">
                                        <span class="nav-text">Fiche de poste</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listes_personnels') }}">
                                        <span class="nav-text">Listes des personnels</span>
                                    </a></li>
                        
                                </div>
                            </ul>
                        </li>

                        <li>
                          <a class="sidenav-item-link" href="{{ route('accueil_Conge') }}">
                              <i class="mdi mdi-calendar-check"></i>
                              <span class="nav-text">Conge et Absence</span>
                          </a>
                        </li>

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#qcm"
                            aria-expanded="false" aria-controls="qcm">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">QCM</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="qcm" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('qcm_avoaka') }}">
                                        <span class="nav-text">Liste des annonces pour ajouter qcm</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeQcm')}}">
                                        <span class="nav-text">Liste Qcm</span>
                                    </a></li>

                                </div>
                            </ul>
                        </li>

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#listes"
                            aria-expanded="false" aria-controls="listes">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">Traiter Qcm</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="listes" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('afaka_Cv') }}">
                                        <span class="nav-text">Faire Qcm</span>
                                    </a></li>
                                </div>
                            </ul>
                        </li>



                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#entretient"
                            aria-expanded="false" aria-controls="entretient">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">Entretient</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="entretient" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('entretient') }}">
                                        <span class="nav-text">Ajouter entretient</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('entretient') }}">
                                        <span class="nav-text">Passer entretient</span>
                                    </a></li>
                                </div>
                            </ul>
                        </li>

                        @endif

                        <li>
                            <a class="sidenav-item-link" href="chat.html">
                                <i class="mdi mdi-wechat"></i>
                                <span class="nav-text">Chat</span>
                            </a>
                        </li>
                    </li>
                </ul>
            </div>
                  

            <div class="sidebar-footer">
              <div class="sidebar-footer-content">
                <ul class="d-flex">
                  <li>
                    <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i class="mdi mdi-settings"></i></a></li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="No chat messages"><i class="mdi mdi-chat-processing"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </aside>

        <!-- ====================================
        ——— PAGE WRAPPER
        ===================================== -->
        <div class="page-wrapper">

          <!-- Header -->
          <header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>

              <span class="page-title">dashboard</span>

              <div class="navbar-right ">

                <!-- search form -->
                <div class="search-form">
                  <form action="index.html" method="get">
                    <div class="input-group input-group-sm" id="input-group-search">
                      <input type="text" autocomplete="off" name="query" id="search-input" class="form-control" placeholder="Search..." />
                      <div class="input-group-append">
                        <button class="btn" type="button">/</button>
                      </div>
                    </div>
                  </form>
                  <ul class="dropdown-menu dropdown-menu-search">

                    <li class="nav-item">
                      <a class="nav-link" href="index.html">Morbi leo risus</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.html">Dapibus ac facilisis in</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.html">Porta ac consectetur ac</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.html">Vestibulum at eros</a>
                    </li>

                  </ul>

                </div>

                <ul class="nav navbar-nav">

                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="{{ asset('images/user/user-xs-01.jpg') }}" class="user-image rounded-circle" alt="User Image" />
                      <span class="d-none d-lg-inline-block">John Doe</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a class="dropdown-link-item" href="user-profile.html">
                          <i class="mdi mdi-account-outline"></i>
                          <span class="nav-text">My Profile</span>
                        </a>
                      </li>

                      <li class="dropdown-footer">
                        <a class="dropdown-link-item" href="{{ route('deconnexion') }}"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>

          </header>

            @yield('contenu');

            <!-- Footer -->
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                <p>
                    &copy; <span id="copy-year"></span> Copyright Mono Dashboard Bootstrap Template by <a class="text-primary" href="http://www.iamabdus.com/" target="_blank" >Abdus</a>.
                </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/simplebar/simplebar.min.js') }}"></script>

    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

    <script src="{{ asset('plugins/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery('input[name="dateRange"]').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
            });

            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                jQuery(this).val('');
            });
        });
    </script>
    
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
    <script src="{{ asset('plugins/toaster/toastr.min.js') }}"></script>
    <script src="{{ asset('js/mono.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

  </body>
</html>