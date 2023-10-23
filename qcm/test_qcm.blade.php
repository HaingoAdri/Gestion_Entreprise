@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content"><!-- For Components documentaion -->
        

        <div class="row">
       
            <div class="col-xl-12">
                <!-- Horizontal Validation -->
                <div class="card-body">
                @foreach($listesd as $l)
                        <div class="card-header">
                            <h3>Description du qcm: {{ $l->description }}</h3>
                            <h3>Qcm: {{ $l->id_qcm }}</h3>
                            <a href=" {{ route('afaka', ['idqcm'=>$l->id_qcm]) }} ">Voir</a>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse" id="collapse-horizontal-validation"></div>
            <form action="{{ route('result_Qcm') }}">
                @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Reponse</th>
                        </tr>
                    </thead>
                    <tbody id="line-container-experience">
                        
                        @for($i=0; $i<count($listeQuestions); $i++)
                        
                                <tr id="tbody-experience">
                                    <td>{{ $listeQuestions[$i]->questions }}</td>
                                <td>
                                    @foreach($listeVrai[$i] as $vrai)              
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="marina[]" value="{{ $vrai->reponse }}" id="flexCheckDefault" onchange="toggleCheckboxes(this)">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $vrai->reponse }}
                                        </label>
                                    </div>
                                    @endforeach
                                        
                                    @foreach($listeFaux[$i] as $faux)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name = "diso[]" value="{{ $faux->reponse_f }}" id="flexCheckDefault" onchange="toggleCheckboxes(this)">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            {{ $faux->reponse_f }}
                                        </label>
                                    </div>
                                    @endforeach
                                    
                                        <input class="form-check-input" type="text" name = "qcm[]" value="{{ $listeQuestions[$i]->id_qcm }}" id="flexCheckChecked" hidden>
                                        <input class="form-check-input" type="text" name = "question[]" value="{{ $listeQuestions[$i]->id_q }}" id="flexCheckChecked" hidden>
                                </td>
                            </tr>
                            @endfor
                        
                    </tbody>
                </table>
                <input type="submit" class="btn btn-primary" value="Valider">
                
            </form>
            
            </div>
    </div>
          
</div>
@endsection
<script>
    function toggleCheckboxes(checkbox) {
        var checkboxes = checkbox.parentElement.parentElement.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function (cb) {
            if (cb !== checkbox) {
                cb.disabled = checkbox.checked;
            }
        });
    }

</script>