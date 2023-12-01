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
    <header>
        <h1>MONO </h1>
        <span><strong>Demandeur :</strong> {{ Session::get('administrateur_rh')->prenom }} {{ Session::get('administrateur_rh')->nom }}</span>
        <span><strong>Adresse :</strong> Lot B IV 12 Akorondrano </span>
        <span><strong>Email :</strong> {{ Session::get('administrateur_rh')->email }} </span>
        <span><strong>Numéro de téléphone :</strong> +261 34 12 345 67 </span>
        <br>
        <p><strong>Date : </strong> {{ $date }} </p>

    </header>
    <center><h1> DEMANDE DE PROFORMA </h1></center>
    <center><h4> Pour  {{ $nom }} </h4></center>

    <br>

    <span>Veuillez s'il-vous-plaît nous joindre les prix pour les produits mentionnés dans le tableau ci-dessous :</span>
    
    <br>
    <content>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Article</th>
                    <th scope="col">Quantites</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listeBesoinNonValide as $besoin)
                    <tr id="tbody-age">
                        <th scope="row">{{ $besoin->idArticle }}</th>
                        <td>{{ $besoin->article->article }}</td>
                        <td>{{ $besoin->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>  

    </content>
</body>
</html>
