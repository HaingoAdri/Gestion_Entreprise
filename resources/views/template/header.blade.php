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

  <title>Gestion_Entreprise</title>
    
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
  <link href="{{ asset('plugins/fullcalendar/core-4.3.1/main.min.css') }}" rel='stylesheet' />
  <link href="{{ asset('plugins/fullcalendar/daygrid-4.3.0/main.min.css') }}" rel='stylesheet' />
  <link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <!-- FAVICON -->
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />

  <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>

  <script defer>
    function ajoutTaux() {
        console.log("Atooooooooooooo");
        var typeSelect = document.querySelector('select[name="ammortissement"]');
        var selectedValue = typeSelect.value;   
        console.log("value: " + selectedValue);

        if( selectedValue == 10) {
            var kilosDiv = document.getElementById("taux");
            kilosDiv.style.display = "block";
        }
    }
</script>

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
                @if(session("administrateur_rh")!=null && session("administrateur_rh")->module->id != 1)
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    @if(session("administrateur_rh")->module->id == 5)
                    <li class="active">
                        <a class="sidenav-item-link" href="{{ route('index_pointage') }}">
                            <i class="mdi mdi-briefcase-account-outline"></i>
                            <span class="nav-text">Pointages</span>
                        </a>
                    </li>
                    @endif

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#annonce"
                        aria-expanded="false" aria-controls="annonce">
                            <i class="mdi mdi-bell-ring"></i>
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

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#achat" aria-expanded="false" aria-controls="achat">
                            <i class="mdi mdi-playlist-plus"></i>
                            <span class="nav-text">Besoin Achat</span> <b class="caret"></b>
                        </a>
                        
                        <ul  class="collapse"  id="achat" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                            
                                <li><a class="sidenav-item-link" href="{{ route('besoinAchat') }}">
                                    <span class="nav-text">Ajout Nouveau Besoin</span>
                                </a></li>
                                @if(session("administrateur_rh")->module->id == 8)
                                    <li><a class="sidenav-item-link" href="{{ route('listeBesoinAchatNonValide') }}">
                                        <span class="nav-text">Liste Besoin Non valide</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeDemandeProformat') }}">
                                        <span class="nav-text">Listes demandes en attente proformat</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeBonCommandeEnAttente') }}">
                                        <span class="nav-text">Bon commande en attente</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeBonCommandeApasser') }}">
                                        <span class="nav-text">Bon commande valider</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeBonCommandeEnCours') }}">
                                        <span class="nav-text">Bon commande en cours</span>
                                    </a></li>
                                @endif
                                @if(session("administrateur_rh")->module->id == 7)
                                    <li><a class="sidenav-item-link" href="{{ route('listeBonCommandeEnAttente') }}">
                                        <span class="nav-text">Bon commande a valider</span>
                                    </a></li>
                                @endif
                            </div>
                        </ul>
                        <a class="sidenav-item-link" href="{{ route('demande_pv_utilisation') }}">
                            <i class="mdi mdi-book-plus"></i>
                            <span class="nav-text">Demande d'utilisation</span></b>
                        </a>
                    </li>

                    <li>
                      <a class="sidenav-item-link" href="{{ route('ajout_Conge') }}">
                          <i class="mdi mdi-calendar-check"></i>
                          <span class="nav-text">Conge et absence</span>
                      </a>
                    </li>

                    @if(session("administrateur_rh")->module->id == 7)

                    <li>
                        <a class="sidenav-item-link" href="{{ route('caisse') }}">
                            <i class="mdi mdi-credit-card-plus"></i>
                            <span class="nav-text">Caisse</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidenav-item-link" href="{{ route('listeCompte') }}">
                            <i class="mdi mdi-book-open-page-variant"></i>
                            <span class="nav-text">Compte</span>
                        </a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#magasin"
                        aria-expanded="false" aria-controls="magasin">
                            <i class="mdi mdi-home-map-marker"></i>
                            <span class="nav-text">Magasin</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="magasin" data-parent="#sidebar-menu">
                            <div class="sub-menu">

                                <li><a class="sidenav-item-link" href="{{ route('magasin') }}">
                                    <span class="nav-text">Magasin</span>
                                </a></li>

                                <li><a class="sidenav-item-link" href="{{ route('voirCaisseMagasin') }}">
                                    <span class="nav-text">Caisse Par Magasin</span>
                                </a></li>
                    
                            </div>
                        </ul>
                    </li>

                    <li>
                        <a class="sidenav-item-link" href="{{ route('tresorier') }}">
                            <i class="mdi mdi-wallet"></i>
                            <span class="nav-text">Tresorier</span>
                        </a>
                    </li>
                    @endif

                    @if(session("administrateur_rh")->module->id == 10)
                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#categorie" aria-expanded="false" aria-controls="achat">
                            <i class="mdi mdi-truck-fast"></i>
                            <span class="nav-text">Sous Categorie</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="categorie" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                    <li><a class="sidenav-item-link" href="{{ route('listeCategorie') }}">
                                        <span class="nav-text">Liste Categorie</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeDescriptionParCategorie') }}">
                                        <span class="nav-text">Description Categorie</span>
                                    </a></li>
                            </div>
                        </ul>
                    </li>

                    <li>
                      <a class="sidenav-item-link" href="{{ route('ajout_livreur_immobilisation') }}">
                          <i class="mdi mdi-account-group-outline"></i>
                          <span class="nav-text">Livreur</span>
                      </a>
                    </li>
                    
                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#immobilier" aria-expanded="false" aria-controls="achat">
                            <i class="mdi mdi-truck-fast"></i>
                            <span class="nav-text">Immobilisation</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="immobilier" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                               
                                    <li><a class="sidenav-item-link" href="{{ route('listeTypeImmobilisation') }}">
                                        <span class="nav-text">Type Immobilisation</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('ajout_etat_immobilisation') }}">
                                        <span class="nav-text">Etat Immobilisation</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('ajout_lieu_immobilisation') }}">
                                        <span class="nav-text">Lieu Immobilisation</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('show_list_bon_commande') }}">
                                        <span class="nav-text">Proces Verbal de reception Immobilisation</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeBonCommandeImmobilisationTerminer') }}">
                                        <span class="nav-text">Liste des bon de commandes terminer</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('pv_utilisation_validation') }}">
                                        <span class="nav-text">Proces Verbal validation</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('listeBonCommandeImmobilisationTerminer') }}">
                                        <span class="nav-text">Inventaire</span>
                                    </a></li>
                            </div>
                        </ul>
                    </li>
                    @endif

                    @if(session("administrateur_rh")->module->id == 8 || session("administrateur_rh")->module->id == 9)
                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#reception_livraison" aria-expanded="false" aria-controls="achat">
                            <i class="mdi mdi-truck-fast"></i>
                            <span class="nav-text">Reception et livraison</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="reception_livraison" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                               
                                    <li><a class="sidenav-item-link" href="{{ route('bon_de_livraison_form') }}">
                                        <span class="nav-text">Bon de livraison</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('bon_de_reception_form') }}">
                                        <span class="nav-text">Bon de reception</span>
                                    </a></li>
                            </div>
                        </ul>
                    </li>
                    @endif

                    @if(session("administrateur_rh")->module->id == 9)
                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#stock" aria-expanded="false" aria-controls="stock">
                            <i class="mdi mdi-playlist-plus"></i>
                            <span class="nav-text">Gestion de stock</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="stock" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                @if(session("administrateur_rh")->module->id == 9)
                                    <li><a class="sidenav-item-link" href="{{ route('entre_manuelle') }}">
                                        <span class="nav-text">Entrer de stock</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('liste_explication') }}">
                                        <span class="nav-text">Explication</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('histporique_liste') }}">
                                        <!-- voir stock historique et stock actuel  -->
                                        <span class="nav-text">Voir historique</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('sortie_stock') }}">
                                        <!-- sortie de stock, details sortie stock  -->
                                        <span class="nav-text">Sortie de stock</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('liste_vente') }}">
                                        <!-- liste des vents selon le produits, avec prix ttc et prix ht  -->
                                        <span class="nav-text">Voir vente</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('liste_stock_departement') }}">
                                        <!-- sortie de stock pour dispacther dans chaque departement  -->
                                        <span class="nav-text">Voir stock departement</span>
                                    </a></li>
                                @endif
                            </div>
                        </ul>
                    </li>
                    @endif

                    @if(session("administrateur_rh")->module->id == 8)
                    <li>
                      <a class="sidenav-item-link" href="{{ route('listeFournisseur') }}">
                          <i class="mdi mdi-account-group-outline"></i>
                          <span class="nav-text">Fournisseur</span>
                      </a>
                    </li>
                    @endif

                    @if(session("administrateur_rh")->module->id == 2)
                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#personnel"
                        aria-expanded="false" aria-controls="personnel">
                            <i class="mdi mdi-briefcase-account-outline"></i>
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
                    @endif
                    
                </ul>
                @else
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <li class="section-title"> Menu </li>
                        @if(session("profil") == 5)
                            @if(session("employer") != 'null')
                            <li>
                                <a class="sidenav-item-link" href="{{ route('ajout_Conge') }}">
                                    <i class="mdi mdi-calendar-check"></i>
                                    <span class="nav-text">Conge et absence</span>
                                </a>
                            </li>

                            <li  class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#achat" aria-expanded="false" aria-controls="achat">
                                    <i class="mdi mdi-playlist-plus"></i>
                                    <span class="nav-text">Besoin Achat</span> <b class="caret"></b>
                                </a>
                                <ul  class="collapse"  id="achat" data-parent="#sidebar-menu">
                                    <div class="sub-menu">
                                    
                                        <li><a class="sidenav-item-link" href="{{ route('besoinAchat') }}">
                                            <span class="nav-text">Ajout Nouveau Besoin</span>
                                        </a></li>
                            
                                    </div>
                                </ul>
                            </li>

                            @endif
                            <li  class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#annonce"
                                aria-expanded="false" aria-controls="annonce">
                                    <i class="mdi mdi-bell-ring"></i>
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
                          
                        @elseif( session("profil") == 20 &&  session("administrateur_rh")->module->id == 1)
                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#besoin"aria-expanded="false" aria-controls="besoin">
                                <i class="mdi mdi-playlist-plus"></i>
                                <span class="nav-text">Besoins des services</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="besoin" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('ajout_besoin') }}">
                                        <span class="nav-text">Ajouter un besoin service</span>
                                    </a></li>

                                    <li><a class="sidenav-item-link" href="{{ route('besoinAchat') }}">
                                        <span class="nav-text">Ajouter un besoin Achat</span>
                                    </a></li>
                        
                                </div>
                            </ul>
                        </li>

                        <li>
                          <a class="sidenav-item-link" href="{{ route('listeBonCommandeEnAttente') }}">
                              <i class="mdi mdi-playlist-plus"></i>
                              <span class="nav-text">Bon de commande a valider</span>
                          </a>
                        </li>

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#contrat"
                            aria-expanded="false" aria-controls="contrat">
                                <i class="mdi mdi-book-open-page-variant"></i>
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

                        <li>
                          <a class="sidenav-item-link" href="{{ route('accueil_Conge') }}">
                              <i class="mdi mdi-calendar-check"></i>
                              <span class="nav-text">Conge et Absence</span>
                          </a>
                        </li>
                        
                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#personnel"
                            aria-expanded="false" aria-controls="personnel">
                                <i class="mdi mdi-briefcase-account-outline"></i>
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

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#qcm"
                            aria-expanded="false" aria-controls="qcm">
                                <i class="mdi mdi-format-list-checks"></i>
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
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#paie"
                            aria-expanded="false" aria-controls="paie">
                                <i class="mdi mdi-credit-card"></i>
                                <span class="nav-text">Paie</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="paie" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                
                                    <li><a class="sidenav-item-link" href="{{ route('voir_fiche_de_paie') }}">
                                            <span class="nav-text">Fiche de Paie</span>
                                    </a></li>
                                    <li><a class="sidenav-item-link" href="{{ route('voir_etat_de_paie') }}">
                                        <span class="nav-text">Voir Etat de Paie</span>
                                    </a></li>
                                </div>
                            </ul>
                        </li>

                        <li  class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#service"
                            aria-expanded="false" aria-controls="service">
                                <i class="mdi mdi-room-service"></i>
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
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#listes"
                            aria-expanded="false" aria-controls="listes">
                                <i class="mdi mdi-shape-square-plus"></i>
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
                                    <li><a class="sidenav-item-link" href="{{ route('liste_entretient') }}">
                                        <span class="nav-text">Passer entretient</span>
                                    </a></li>
                                </div>
                            </ul>
                        </li>
                        @endif

                    </li>
                </ul>
                @endif
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

              <span class="page-title">Accueil</span>

              <div class="navbar-right" style="margin-rigth: 30px;">

                <ul class="nav navbar-nav">

                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="{{ asset('images/user/user-xs-01.jpg') }}" class="user-image rounded-circle" alt="User Image" />
                      @if(Session::get('profil') == 20)
                      <span class="d-none d-lg-inline-block">{{ Session::get('administrateur_rh')->prenom }}</span>
                      @else
                      <span class="d-none d-lg-inline-block">{{ Session::get('client')->prenom }}</span>
                      @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" style="width: 300px;">
                      <li>
                        <a class="dropdown-link-item" href="user-profile.html">
                          <i class="mdi mdi-account-outline"></i>
                          @if(Session::get('profil') == 20)
                          <span class="nav-text">{{ Session::get('administrateur_rh')->prenom }} {{ Session::get('administrateur_rh')->nom }}</span>
                          @else
                          <span class="nav-text">{{ Session::get('client')->prenom }} {{ Session::get('client')->nom }}</span>
                          @endif
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
                    &copy; <span id="copy-year"></span> Copyright | Layah-ETU-1947💜 Rota-ETU-2068💜 Haingo-2069💜</a>.
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
    <script src="{{ asset('plugins/fullcalendar/core-4.3.1/main.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/daygrid-4.3.0/main.min.js') }}"></script>
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