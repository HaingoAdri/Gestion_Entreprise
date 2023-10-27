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
                        <h2>Entretient</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        <form method="POST" action="{{ route('inserer_entretient') }}">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Inserer entretient</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="firstName">Dates</label>
                                    <input type="date" class="form-control" name="dates" placeholder="Dates" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Heure</label>
                                    <input type="time" class="form-control" name="heure" placeholder="Heure" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Lieu</label>
                                    <input type="text" class="form-control" name="lieu" required>
                                </div>

                                <div class="form-group">
                                <label for="lastName">Qcm reussi</label>
                                    <select name="afaka_qcm" class="form-control" required>
                                        @foreach($afaka_qcm as $afaka)
                                        <option value="{{ $afaka->id_as }}">{{ $afaka->id_as }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div style="display: flex; margin-left: 160px;">
                                
                                <div class="modal-footer border-top-0 px-4 pt-0">
                                    <button type="submit" name="type" value="2" class="btn btn-primary btn-pill m-0">Ajouter</button>    
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('liste_entretient') }}"  class="btn btn-primary btn-pill m-0">Listes des entretients</a>
                               
                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
        </div>
        </div>          
</div>


@endsection
