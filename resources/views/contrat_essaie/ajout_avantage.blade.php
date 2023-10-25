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
                        <h2>Avanatage en Nature</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        <form method="POST" action="{{ route('inserer_avantage') }}">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter Un Avanatage pour le nouveau Employe</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="lastName">Genre</label>
                                    <select name="idAvantage" class="form-control" required>
                                        <option value="">Avantage</option>
                                        @foreach($Liste_avantage_nature as $avantage)
                                            <option value="{{ $avantage->id }}">{{ $avantage->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex; margin-left: 150px;">
                                <div class="modal-footer border-top-0 px-4 pt-0">
                                    <button type="submit" name="type" value="1"  class="btn btn-primary btn-pill m-0">Ajouter Autre</button>
                                </div>
                                <div class="modal-footer border-top-0 px-4 pt-0">
                                    <button type="submit" name="type" value="2" class="btn btn-primary btn-pill m-0">Terminer</button>
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
