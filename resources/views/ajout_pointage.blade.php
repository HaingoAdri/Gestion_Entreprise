@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default border-0 bg-transparent">
            <div class="card-header align-items-center p-0">
                <h2>Faire un pointage</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                    <i class="mdi mdi-plus mr-1"></i> Un nouveau pointage
                </button>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="mb-5">
                    <h5 class="text-dark mb-3">Liste des pointages</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Etat</th>
                                <th scope="col">Pointeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listes_pointages as $pointage)
                            <tr>
                                <td scope="row">{{ $pointage->employer->id_emp}}</td>
                                <td>{{ $pointage->employer->client->nom}} {{ $pointage->employer->client->prenom}}</td>
                                <td>{{ $pointage->date}}</td>
                                <td>{{ $pointage->etat}}</td>
                                <td>{{ $pointage->securite}}</td>
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
                    <form action="{{ route('insert_pointage') }}">
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un nouveau pointage</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body px-4">

                            <div class="form-group">
                                <label for="firstName">Employer</label>
                                <select name="employer" class="form-control">
                                    @foreach($listes_employer as $employer)
                                        <option value="{{$employer->id_emp}}"> {{ $employer->id_emp}} {{ $employer->client->nom}} {{ $employer->client->prenom}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="firstName">Date</label>
                                <input type="date" class="form-control" name="pointage_date">
                            </div>

                            <div class="form-group" >
                                <label for="firstName">Type de pointage</label>
                                <select name="type_de_pointage" class="form-control">
                                    <option value="50">Arrive</option>
                                    <option value="100">Sortie</option>
                                </select>
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
