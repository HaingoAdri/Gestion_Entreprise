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
                    <a class="nav-link" href="{{ route('liste_demande') }}">Demandes de Conges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('liste_valider') }}">Confirmation Depart</a>
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
                    @if( count($demandes_valider) > 0)
                        @foreach($demandes_valider as $demande)
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
                                                <i class="mdi mdi-plus mr-1"></i> depart
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
                                        <form action="{{ route('insertion_confirmation_depart') }}">

                                            <div class="modal-header px-4">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation Depart pour: {{ $demande->employer->client->nom }} {{ $demande->employer->client->prenom }}</h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body px-4">
                                                <input type="hidden" class="form-control" name="idconge" value="{{ $demande->id }}" placeholder="Date"/>

                                                <div class="form-group">
                                                    <label for="firstName">Depart</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text py-1">
                                                            <i class="mdi mdi-calendar-range"></i>
                                                        </span>
                                                        </div>
                                                        <input type="datetime-local" class="form-control" name="depart" value="" placeholder="Date"/>
                                                    </div>
                                                </div>
                    
                                                <div class="form-group mb-0">
                                                    <label for="firstName">Commentaires</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="commentaires"></textarea>
                                                </div>

                                            </div>

                                            <div class="modal-footer border-top-0 px-4 pt-0">
                                                <button type="submit" class="btn btn-primary btn-pill m-0">Depart</button>
                                            </div>
                                        </form>
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