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
                        <h2>Etat de Paie</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        <form method="POST" action="{{ route('etat_de_paie') }}">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Voir Etat de Paie</h5>
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
                            @if (session('erreur'))
                            <div class="alert alert-danger" role="alert">
                            <p>{{ session('erreur') }}</p>
                            </div>
                            @endif
                            <div class="modal-footer border-top-0 px-4 pt-0">
                                <button type="submit" class="btn btn-primary">Voir</button>
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
