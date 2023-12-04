@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Meilleurs proformat pour l'ID du demande {{ $idDemande }} </h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Faire le bon de commande
                </button>
            </div>

            <div class="card-body">
                <div class="accordion accordion-shadow" id="accordionShadow">
                    <div class="card">

                        <div class="card-header" id="heading">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse"
                                aria-expanded="true" aria-controls="collapse">
                                Liste de(s) meilleur(s) proformat(s): 
                                </button>
                            </h2>
                        </div>
                        <div id="collapse" class="collapse show" aria-labelledby="heading" data-parent="#accordionShadow">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Article</th>
                                            <th>Article</th>
                                            <th>Quantite</th>
                                            <th>TVA</th>
                                            <th>Prix HT</th>
                                            <th>Prix AT</th>
                                            <th>Fournisseur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i=0; $i<count($listeProformat)-1; $i++)
                                        <tr id="tbody-age">
                                            <th>{{ $listeProformat[$i]->idArticle }}</th>
                                            <td>{{ $listeProformat[$i]->getArticle() }}</td>
                                            <td>{{ $listeProformat[$i]->quantite }}</td>
                                            <td>{{ $listeProformat[$i]->TVA }}</td>
                                            <td>{{ $listeProformat[$i]->prixHT }} Ar</td>
                                            <td>{{ $listeProformat[$i]->prixAT }} Ar</td>
                                            <td>{{ $listeProformat[$i]->getNomFournisseur() }}</td>
                                        </tr>
                                        @endfor
                                        <tr>
                                            <th>Prix Hors Taxe: {{ $listeProformat[count($listeProformat)-1]->prixHT }}</th>
                                            <th>TTC: {{ $listeProformat[count($listeProformat)-1]->prixAT }}</th>
                                            <th>Le montant a payé est de: <div id="resultat"></div></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('detailsProformat', ['idDemande' => $idDemande]) }}"><button type="button" class="btn btn-primary">Retour</button></a>
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
        var montant = <?php echo $listeProformat[count($listeProformat)-1]->prixAT; ?>;
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