@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-12">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Entretient</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>Entretients </th>
                                    <th>Date </th>
                                    <th>Heure</th>
                                    <th>Lieu</th>
                                    <th>Bouton</th>
                                </tr>
                            </thead>
                            <tbody id="line-container-age">
                                @foreach($entretients as $entretient)
                                <tr id="tbody-age">
                                    <td>{{ $entretient->id_e }}</td>
                                    <td>Numero : {{ $entretient->aa }} , celui qui a reussi le Qcm</td>
                                    <td>{{ $entretient->dates }}</td>
                                    <td>{{ $entretient->heures }}</td>
                                    <td>{{ $entretient->lieu }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact{{ $entretient->id_e }}">
                                            Faire l'entretient
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>       
                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
            <div class="modal fade" id="modal-add-contact{{ $entretient->id_e }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('ajouterQcm') }}">
                                        <div class="modal-header px-4">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter Entretient:</h5>
                                        </div>
                                        <div class="modal-body px-4">

                                            
                                            <div class="form-group row mb-6">
                                                <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Etats:</label>
                                                <div class="col-sm-8 col-lg-10">
                                                    <div class="custom-file mb-1">
                                                    <select name="" id="" class="form-control">
                                                        @foreach($etats as $etat)
                                                        <option value="{{ $etat->id_et }}">{{ $etat->nom_etats }}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="number" class="form-control" id="description" name="besoin" value="" hidden>
                                            
                                        </div>
                                        <div class="modal-footer px-4">
                                            
                                            <button type="submit" class="btn btn-primary btn-pill">Entretient fini</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
        </div>
        </div>          
</div>


@endsection
