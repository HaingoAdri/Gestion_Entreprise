@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Ajout Proche</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        <form method="POST" action="{{ route('ajout_proche') }}">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter Un Membre de la famille</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="firstName">Nom</label>
                                    <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Prenom</label>
                                    <input type="text" class="form-control" name="prenom" placeholder="Prenom" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Date de Naissance</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>

                                <div class="form-group">
                                <label for="lastName">Genre</label>
                                    <select name="idGenre" class="form-control" required>
                                        <option value="1">Homme</option>
                                        <option value="2">Femme</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="lastName">Membre</label>
                                    <select name="idEtat" class="form-control" required>
                                        <option value="1">Pere</option>
                                        <option value="2">Mere</option>
                                        <option value="3">Conjoint</option>
                                        <option value="4">Enfant</option>
                                    </select>
                                </div>

                            </div>
                            <div style="display: flex; margin-left: 160px;">
                                <div class="modal-footer border-top-0 px-4 pt-0">
                                    <button type="submit" name="type" value="1"  class="btn btn-primary btn-pill m-0">Ajouter Autre</button>
                                </div>
                                <div class="modal-footer border-top-0 px-4 pt-0">
                                    <button type="submit" name="type" value="2" class="btn btn-primary btn-pill m-0">Suivant</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
        </div>

    </div>
          
</div>


@endsection
