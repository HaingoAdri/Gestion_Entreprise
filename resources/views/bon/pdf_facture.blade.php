<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Mono - Responsive Admin & Dashboard Template</title>
    
  <!-- theme meta -->
  <meta name="theme-name" content="mono" />

  <!-- GOOGLE FONTS -->
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/facture.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

  <style>
        span{
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }   
   
    </style>

</head>
<body>

<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->
        
        <div class="card card-default" style="padding:1rem;">

            <div class="card-body px-3 px-md-8">

                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="invoice-container">
                                    <div class="invoice-header">

                                        <div class="card-title">
                                            <center><h2>FACTURE</h2></center>
                                        </div>

                                        <div class="row gutters">

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <a href="index.html" class="invoice-logo">
                                                    MONO
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <address class="text-right">
                                                    mono_th@yahoo.fr.<br>
                                                    0324525225
                                                </address>
                                            </div>
                                        </div>

                                        <div class="row gutters">
                                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                                <div class="invoice-details">
                                                    <address>
                                                        Alex Maxwell<br>
                                                        Livraison, Antananarivo
                                                    </address>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                                <div class="invoice-details">
                                                    <div class="invoice-num">
                                                        <div>{{ $bonCommande->nom }} - #{{ $bonCommande->id }}</div>
                                                        <div>{{ $bonCommande->date }}</div>
                                                    </div>
                                                </div>													
                                            </div>
                                        </div>
                                        <!-- Row end -->
                                    </div>
                                    <div class="invoice-body">
                                        <!-- Row start -->
                                        <div class="row gutters">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table custom-table m-0">
                                                        <thead>
                                                            <th>Article</th>
                                                            <th>Quantite</th>
                                                            <th>TVA</th>
                                                            <th>Prix HT</th>
                                                            <th>Prix AT</th>
                                                            <th>Fournisseur</th>
                                                        </thead>
                                                        <tbody>

                                                            @for($i=0; $i<count($listeProformat)-1; $i++)
                                                            <tr id="tbody-age">
                                                                <td>
                                                                    {{ $listeProformat[$i]->idArticle }}
                                                                    <p class="m-0 text-muted">
                                                                        {{ $listeProformat[$i]->getArticle() }}
                                                                    </p>
                                                                </td>
                                                                <td>{{ $listeProformat[$i]->quantite }}</td>
                                                                <td>{{ $listeProformat[$i]->TVA }}</td>
                                                                <td>{{ $listeProformat[$i]->prixHT }} Ar</td>
                                                                <td>{{ $listeProformat[$i]->prixAT }} Ar</td>
                                                                <td>{{ $listeProformat[$i]->getNomFournisseur() }}</td>
                                                            </tr>
                                                            @endfor

                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td colspan="2">
                                                                    <p>
                                                                        Total Prix Hors Taxe<br>
                                                                        Total Prix TTC<br>
                                                                        Total<br>
                                                                    </p>
                                                                    <h5 class="text-success"><strong>Grand Total</strong></h5>
                                                                </td>			
                                                                <td>
                                                                    <p>
                                                                        {{ $listeProformat[count($listeProformat)-1]->prixHT }} Ar<br>
                                                                        {{ $listeProformat[count($listeProformat)-1]->prixAT }} Ar<br>
                                                                        {{ $listeProformat[count($listeProformat)-1]->prixAT }} Ar<br>
                                                                    </p>
                                                                    <h5 class="text-success"><strong><span id="resultat"></span> Ariary</strong></h5>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Row end -->
                                    </div>
                                    <div class="invoice-footer">
                                        Thank you for your Business.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>

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
