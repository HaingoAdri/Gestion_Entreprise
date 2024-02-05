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
                                <a class="text-dark"> Faire pv radiation</a> / <a href="{{ route('show_pv_radiation') }}" class="text-dark"> Liste de pv radiation</a> 
                            </h2>
                        </div>

                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('insert_pv_radiation') }}">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="email">Immobilisation récéptionner :</label>
                                    <select name="immobilisation" id="" class="form-control" required>
                                        @foreach($immobilisation as $pv)
                                        <option value="{{ $pv->id_immobilisation }}">
                                            {{ $pv->id_immobilisation }}
                                        </option>
                                        @endforeach 
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Cause</label>
                                    <input type="text" class="form-control" name="cause" required>
                                </div>

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2">Eradier l'immobilisation</button>
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