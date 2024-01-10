@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
    <div class="col-md-12">
        <div class="card card-default card-profile">

            <!-- Account Settings -->
            <div class="card card-default">
                <div class="card-header">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold">Bon de Commande</h3>

                            <br>

                            <span style="display: block;"><strong>Entreprise : MONO</strong></span>
                            <span style="display: block;"><strong>Téléphone : 0324525225</strong></span>
                            <span style="display: block;"><strong>Email : mono_th@yahoo.fr</strong></span>
                        </div>
                    </div>

                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <span style="display: block;"><strong>Bon de Commande n° : </strong>{{ $bonCommande->id }}</span>
                            <span style="display: block;"><strong>Titre : </strong>{{ $bonCommande->nom }}</span>
                            <span style="display: block;"><strong>Date : </strong>{{ $bonCommande->date }}</span>
                            <span style="display: block;"><strong>Mode de payement : </strong>Par {{ $bonCommande->getModePayement() }} </span>
                            <span style="display: block;"><strong>Delai de livraison : </strong> Apres {{ $bonCommande->delaiLivarison }} jr(s)</span>
                        </div>
                        
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-secondary text-capitalize">Listes des commandes : </h5>
                        </div>
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-12">
                        <table class="table">
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
                            </tbody>
                        </table>  
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-12">
                            <span style="display: block;"><strong>Total Prix Hors Taxe : </strong> {{ $listeProformat[count($listeProformat)-1]->prixHT }} Ar </span>
                            <span style="display: block;"><strong>Total Prix TTC : </strong> {{ $listeProformat[count($listeProformat)-1]->prixAT }} Ar</span>
                            <span style="display: block;"><strong>Le montant a payé est de: </strong><span id="resultat"></span> Ariary</span>
                        </div>
                        
                    </div>
                </div>

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