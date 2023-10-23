@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content"><!-- For Components documentaion -->
        

        <div class="row">
       
            <div class="col-xl-6">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                @foreach($res as $r)
                    @foreach($reponse as $rs)
                                    
                        <div class="card-header">
                            <h2>Liste Reponse: {{ $r->id_question }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="collapse" id="collapse-horizontal-validation"></div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Question Vrai</th>
                                            <th>Question Faux</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-experience">
                                                <tr id="tbody-experience">
                                                    <td>{{ $r->reponse }}</td>
                                                    <td>{{ $rs->reponse_f }}</button></td>
                                                </tr>
                                                @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                      
                </div>
                
        </div>
            
    </div>
          
</div>
@endsection
