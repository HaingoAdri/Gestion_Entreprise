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
                                    <th>#</th>
                                     <!-- <th>Entretients </th> -->
                                    <th>Identifiant </th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Lieu</th>
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
            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
            @foreach($entretients as $entretient)
            <div class="modal fade" id="modal-add-contact{{ $entretient->id_e }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('inserer_Vita_Entretient') }}">
                                        
                                        <div class="modal-header px-4">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Passer entretient pour le numero {{ $entretient->aa }} : </h5>
                                        </div>
                                        <div class="modal-body px-4">

                                            
                                        
                                            <input type="number" class="form-control" name="etats" value ="12"  hidden>
                                            <div class="form-group row mb-6">
                                                <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Dates:</label>
                                                <div class="col-sm-8 col-lg-10">
                                                    <div class="custom-file mb-1">
                                                        <input type="date" class="form-control" name="dates" placeholder="Dates" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-6">
                                                <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Salaire brut:</label>
                                                <div class="col-sm-8 col-lg-10">
                                                    <div class="custom-file mb-1">
                                                        <input type="number" class="form-control" name="salaire_brut" placeholder="Salaire brut" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-6">
                                                <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Salaire net:</label>
                                                <div class="col-sm-8 col-lg-10">
                                                    <div class="custom-file mb-1">
                                                        <input type="number" class="form-control" name="salaire_net" placeholder="Salaire net" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <input type="number" class="form-control" name="qcm_afaka" value ="{{ $entretient->aa }}"  hidden>
                                
                                            <input type="number" class="form-control" id="description" name="entretients" value="{{ $entretient->id_e }}" hidden>
                                            
                                        </div>
                                        <div class="modal-footer px-4">
                                            
                                            <button type="submit" class="btn btn-primary btn-pill">Entretient fini</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            @endforeach
        </div>
        </div>          
</div>


@endsection
