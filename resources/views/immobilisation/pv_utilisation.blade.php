@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    
    <div class="content">
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-8">
                <div class="card card-default card-profile">

                    <!-- Account Settings -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2 class="mb-5">
                                <a href="" class="text-dark"> Faire demande de pv d'utilisation</a>
                            </h2>
                        </div>

                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('insert_pv_utilisation') }}"">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="email">Immobilisation récéptionner :</label>
                                    <select name="reception" id="" class="form-control" required>
                                        @foreach($pv_reception as $pv)
                                        <option value="{{ $pv->id }}">
                                            {{ $pv->id }} , {{ $pv->id_type_ammortissement }}
                                        </option>
                                        @endforeach 
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Département :</label>
                                    <select name="module" id="" class="form-control" required>
                                        @foreach($listeModules as $module)
                                        <option value="{{ $module->id }}">
                                            {{ $module->type }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Date</label>
                                    <input type="date" class="form-control" name="dates" required>
                                </div>


                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2">Faire demande</button>
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