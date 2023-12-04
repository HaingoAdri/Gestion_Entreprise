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
                            <h2 class="mb-5">Création de bon de récéption</h2>

                        </div>

                        <div class="card-body">

                            <form>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Lieu</label>
                                            <input type="text" class="form-control" id="lieu" name="lieu">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Numéro de bon de commande</label>
                                    <input type="text" class="form-control" id="numero">
                                </div>

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Créer</button>
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