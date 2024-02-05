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
                            <h2 class="mb-5">Teminer la maintenance</h2>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('terminer_maintenance') }}">
                                <br>

                                <input type="hidden" name="id_maintenance" value="{{$id_maintenance}}">
                                <input type="hidden" name="id_immobilisation" value="{{$id_immobilisation}}">

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Date Fin</label>
                                            <input type="date" class="form-control" id="fin" name="fin">
                                        </div>
                                    </div>
                                </div>
           

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Valider</button>
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