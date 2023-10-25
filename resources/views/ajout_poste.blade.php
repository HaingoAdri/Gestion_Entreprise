@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default border-0 bg-transparent">
            <div class="card-header align-items-center p-0">
                <h2>Ajouter un poste</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                    <i class="mdi mdi-plus mr-1"></i> Un nouveau poste
                </button>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="mb-5">
                    <h5 class="text-dark mb-3">Liste des postes</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listePostes as $poste)
                            <tr>
                                <td scope="row">6</td>
                                <td>{{ $poste->type }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>

        <!-- Add Event Button  -->
        <div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('insert_poste') }}">
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un nouveau poste</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body px-4">

                            <div class="form-group">
                                <label for="firstName">Nom du poste</label>
                                <input type="text" class="form-control" name="poste_name" placeholder="ex: Chef de projet">
                            </div>
                        
                        </div>

                        <div class="modal-footer border-top-0 px-4 pt-0">
                            <button type="submit" class="btn btn-primary btn-pill m-0">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
