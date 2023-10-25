@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->
        <div class="card card-default card-profile">

        <div class="card-footer card-profile-footer">
            <ul class="nav nav-border-top justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accueil_Conge') }}">Types de conges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('liste_demande') }}">Demandes de Conges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('liste_valider') }}">Confirmation Depart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('liste_retour') }}">Confirmation Fin</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3"></div>
            <div class="col-lg-6" >
                <!-- Notification -->
                <div class="card card-default" data-scroll-height="530">
                    <div class="card-header">
                        <h2 class="mb-5">Demandes</h2>
                    </div>

                <div class="card-body slim-scroll">
                    <ul class="list-group">
                    @if( count($demandes_en_attente) > 0)
                        @foreach($demandes_en_attente as $demande)
                            <li class="list-group-item">
                                <div class="media media-sm mb-0">
                                <div class="media-sm-wrapper">
                                    <h6>{{ $demande->id }}<h6>
                                </div>
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <span class="title">{{ $demande->employer->client->nom }} {{ $demande->employer->client->prenom }}</span>
                                            <p>{{ $demande->type_conge->nom }} : {{ $demande->raison }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                                                <i class="mdi mdi-plus mr-1"></i> action
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </li>

                            <!-- Add Event Action  -->
                            <div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header justify-content-end border-bottom-0"> 
                                    
                                    <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>

                                <div style="margin:2rem;">
                                    <center><h2>{{ $demande->type_conge->nom }}: {{ $demande->type_conge->politique }}</h2></center>

                                    <br>
                                    <div class="contact-info px-4">
                                        <p>{{ $demande->employer->client->nom }} {{ $demande->employer->client->prenom }} demande un conge pour la raison suivante: {{ $demande->raison }}</p>
                                    </div>
                                    <br>
                                    
                                </div>
                                <div class="card-header align-items-left px-3 px-md-5">
                                    <div class="text-left"> <!-- Change text-right to text-left -->
                                        <a href="{{ route('changeStatut', ['id' => $demande->id, 'statut' => 21 ]) }}"><button type="button" class="btn btn-primary"> 
                                            Valider
                                        </button></a>
                                        <a href="{{ route('changeStatut', ['id' => $demande->id, 'statut' => 41 ]) }}"><button type="button" class="btn btn-primary"> 
                                            Refuser
                                        </button></a>
                                    </div>

                                </div>
                            </div>

                        @endforeach
                    @endif
                    </ul>

                </div>
                 
            </div>
        <div class="col-lg-3"></div>
    </div>
          
</div>
@endsection