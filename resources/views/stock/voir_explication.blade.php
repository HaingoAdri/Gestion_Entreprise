@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    
    <div class="content">
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-12">
                <div class="card card-default card-profile">

                    <!-- Account Settings -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2 class="mb-5">
                                <a href="{{ route('liste_explication')}}" class="text-danger" >Voir explication</a>
                            </h2>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Motif</th>
                                        <th>Article</th>
                                        <th>Quantite</th>
                                        <th>Reception</th>
                                        <th>Departement</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listExplication as $explique)
                                    <tr>
                                        <td>
                                            {{ $explique->dates }}
                                        </td>
                                        <td>
                                            {{ $explique->motif }}
                                        </td>
                                        <td>
                                            {{ $explique->article }}
                                        </td>
                                        <td>
                                            {{ $explique->quantite }}
                                        </td>
                                        <td>
                                            {{ $explique->reception }}
                                        </td>
                                        <td>
                                            {{ $explique->module }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection