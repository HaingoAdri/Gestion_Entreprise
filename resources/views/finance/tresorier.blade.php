@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        @if(session('erreur'))
        <div class="row mb-4 btn btn-danger" style="width: 100%;">{{ session('erreur') }}</div>
        @endif
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Tresorier</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Faire un mouvement
                </button>
            </div>

            <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Compte</th>
                                        <th>Nom</th>
                                        <th>Argents</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeCompte as $compte)
                                    <tr>
                                        <td>{{ $compte->idCompte }}</td>
                                        <td>{{ $compte->nom }}</td>
                                        <td>{{ $compte->reste }}Ar</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <p>Total: {{ $total }}Ar ou <div id="resultat"></div>Ariary</p>
                        </div>
                    </div>
                </div>
        </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('mouvementArgent') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Faire un nouvement d'argent</h5>
                    </div>
                    <div class="modal-body px-4">                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Date</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="date" class="form-control"  name="date" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Compte</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="idCompte" placeholder="Numero de compte" required>
                                </div>
                            </div>
                        </div>   

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Type</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <select name="type" class="form-control" required>
                                        <option value="">Type de Mouvement</option>
                                        <option value="5">Entre</option>
                                        <option value="1">Sortie</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Montant</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="montant" value="0" placeholder="Montant de l'argent" required>
                                </div>
                            </div>
                        </div>  
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Explication</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="explication" placeholder="La cause du mouvement" required>
                                </div>
                            </div>
                        </div>  

                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Suivant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<script defer>
    function maFonctionJS(montant) {
        setTimeout(function () {
            document.getElementById("resultat").innerText = montant;
        }); 
    }

    window.onload = function () {
        var montant = <?php echo $total; ?>;
        montant = changeNumberToLetter(Number(montant));
        maFonctionJS(montant);
    };

    function changeNumberToLetter(nombre) {
        var units = ['', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf'];
        var tens = ['', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante', 'Quatre-vingt', 'Quatre-vingt'];
        
        var exceptions = {
            10: 'Dix', 11: 'Onze', 12: 'Douze', 13: 'Treize', 14: 'Quatorze', 15: 'Quinze', 16: 'Seize', 70: 'Soixante-dix', 80: 'Quatre-vingts', 81: 'Quatre-vingt-un', 91: 'Quatre-vingt-onze'
        };

        var montant = '';

        if (nombre === 0) {
            return 'Zéro';
        }

        if (exceptions[nombre]) {
            return exceptions[nombre];
        }

        if (nombre >= 1e6) {
            var millions = Math.floor(nombre / 1e6);
            montant += convertNumber(millions) + ' million ';
            nombre %= 1e6;
        }

        if (nombre >= 1e3) {
            var thousands = Math.floor(nombre / 1e3);
            montant += convertNumber(thousands) + ' mille ';
            nombre %= 1e3;
        }

        if (nombre > 0) {
            montant += convertNumber(nombre);
        }

        return montant.trim();

        function convertNumber(number) {
            var spelledOut = '';

            if (number >= 100) {
                var hundreds = Math.floor(number / 100);
                spelledOut += units[hundreds] + ' cent ';
                number %= 100;
            }

            if (number >= 10 && number <= 19) {
                spelledOut += exceptions[number];
            } else {
                var tensDigit = Math.floor(number / 10);
                spelledOut += tens[tensDigit] + ' ';
                var quotient = Math.floor(number / 10);
                number %= 10; 
                
                if (number > 0) {
                    if(quotient == 7 || quotient == 9) {
                        spelledOut += exceptions[number + 10];
                    }
                    else
                        spelledOut += units[number];
                }
            }

            return spelledOut.trim();
        }

    }

</script>

@endsection