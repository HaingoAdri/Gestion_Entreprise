@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-8">
                <div class="card card-default card-profile">

                    <div class="card card-default">
                        <div class="card-header">
                            <h2 class="mb-5">Voir l'ammortissement</h2>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('voir_ammortissement') }}">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Annee</label>
                                            <input type="number" class="form-control" id="annee" name="annee">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Reference Immobilisation</label>
                                            <input type="text" class="form-control" id="reference" name="reference">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Voir</button>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection