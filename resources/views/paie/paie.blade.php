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
                        <h2>Fiche de Paie</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        @if(!isset($fiche))
                        <form method="POST" action="{{ route('fiche_de_paie') }}">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Voir Fiche de Paie d'un Personnel</h5>
                            </div>
                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="lastName">Date Debut</label>
                                    <input type="date" class="form-control" name="dateDebut" required>
                                </div>
                            </div>
                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="lastName">Date Fin</label>
                                    <input type="date" id="dateInput" class="form-control" name="dateFin" required>
                                </div>
                            </div>
                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="lastName">Numero de matricule</label>
                                    <input type="text" class="form-control" name="idEmploye" placeholder="De l'Employe" required>
                                </div>
                            </div>
                            @if (session('erreur'))
                            <div class="alert alert-danger" role="alert">
                            <p>{{ session('erreur') }}</p>
                            </div>
                            @endif
                            <div class="modal-footer border-top-0 px-4 pt-0">
                                <button type="submit" class="btn btn-primary">Voir</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
        </div>

    </div>
          
</div>




@endsection
