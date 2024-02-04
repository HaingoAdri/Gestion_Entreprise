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
                            <h2 class="mb-5">Faire la maintenance</h2>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('insert_maintenance') }}">
                                
                                <div class="row flex flex-column">
                                    <p><span><u>Reference immobilisation </u> n° <strong> {{ $id_immobilisation_reception }}</strong> </span></p>
                                </div>

                                <br>

                                <input type="hidden" name="immobilisation" value="{{$id_immobilisation_reception}}">

                                <div class="row mb-2">

                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label for="lastName">Type d'entretient</label>
                                            <select name="type_entretient" class="form-control">
                                            @if(count($listeTypeEntretien) > 0)
                                                @for($i=0; $i<count($listeTypeEntretien); $i++)
                                                    <option value="{{$listeTypeEntretien[$i]->id_type_entretien}}">{{$listeTypeEntretien[$i]->designation_type_entretien}}</option>
                                                @endfor
                                            @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-2">

                                    <div class="col-lg-6" id="designation">
                                        <label for="firstName">Designation</label>
                                        <input type="text" class="form-control" id="designation" name="designation">
                                    </div>

                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Date Debut</label>
                                            <input type="date" class="form-control" id="debut" name="debut">
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