@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default" style="padding:1rem;">

            <div class="card-body px-3 px-md-5">

                <div class="card-title">
                    <center><h2>ETAT DE PAIE</h2></center>
                    <center><h4>DU {{ $listes_employer[0]["dateDebut"]->format('d/m/y') }} AU {{ $listes_employer[0]["dateFin"]->format('d/m/y') }}</h4></center>
                </div>

                <br>

                <div class="card-body">
                    <table class="table">
                        <thead style="align-items: center;">
                            <th>Date</th>
                            <th>Nombre</th>
                            <th>N° Matricule</th>
                            <th>N° CNAPS</th>
                            <th>Nom et Prenoms</th>
                            <th>Date d'embauche</th>
                            <th>Absence du mois</th>
                            <th>CAT</th>
                            <th>Fonction</th>
                            <th>Salaire de base</th>
                            <th>Retenues sur absences</th>
                        </thead>
                        <tbody>
                            @foreach($listes_employer as $etat)
                                <tr>
                                    <td>{{ $etat["dateFin"]->format('d/m/y') }}</td>				
                                    <td>1</td>	
                                    <td>{{ $etat["employe"]->id_emp }}</td>
                                    <td>{{ $etat["employe"]->CNAPS->id }}</td>
                                    <td>{{ $etat["employe"]->client->nom }} {{ $etat["employe"]->client->prenom }}</td>
                                    <td>{{ $etat["historique_embauche"]->date }}</td>
                                    <td>{{ $etat["absences"]["heures"] }}</td>
                                    <td>{{ $etat["besoin"]->service->id }} | {{ $etat["besoin"]->service->type }}</td>
                                    <td>{{ $etat["besoin"]->poste->type }}</td>
                                    <td>{{ $etat["salaire"]->brut }}</td>
                                    <td>0</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                        
                    </table>

                    <br><br>

                    <table class="table">
                        <thead style="align-items: center;">
                            <th>Salaire de base du mois</th>
                            <th>Indemnite</th>
                            <th>Rappel</th>
                            <th>Autres</th>
                            <th>HR Sup/Maj</th>
                            <th>Salaire Brut</th>
                            <th>CNAPS 1%</th>
                            <th>CNAPS 8%</th>
                            <th>OSTIE 1%</th>
                            <th>OSTIE 5%</th>
                            <th>Revenu Imposable</th>
                        </thead>
                        <tbody>
                            @foreach($listes_employer as $etat)
                                <tr>				
                                    <td>{{ $etat["salaire"]->brut }}</td>	
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>{{ $etat["salaire"]->brut }}</td>
                                    <td>{{ $etat["retenu_1%_CNAPS"] }}</td>
                                    <td>{{ $etat["retenu_1%_CNAPS"]*8 }}</td>
                                    <td>{{ $etat["retenu_sanitaire"] }}</td>
                                    <td>{{ $etat["retenu_sanitaire"]*5 }}</td>
                                    <td>{{ number_format($etat["montant_imposable"], 3) }}</td>				
                                </tr>
                            @endforeach
                        
                        </tbody>
                        
                    </table>

                    <br><br>

                    <table class="table">
                        <thead style="align-items: center;">
                            <th>Impôt dû</th>
                            <th>Enfant A Charge</th>
                            <th>Montant</th>
                            <th>IGR Net</th>
                            <th>Autres Retenues</th>
                            <th>TOTAL RETENUES </th>
                            <th>Salaire Net</th>
                            <th>Avance</th>
                            <th>Net A Payer</th>
                            <th>AUTRES INDEMNITE </th>
                            <th>Net Du Mois </th>
                        </thead>
                        <tbody>
                            @foreach($listes_employer as $etat)
                                <tr>
                                    <td>{{ $etat["impot"] }}</td>	
                                    <td>{{ count($etat["liste_enfants"]) }}</td>
                                    <td>{{ $etat["montant_enfant_charge"] }}</td>
                                    <td>{{ $etat["IGR_Net"] }}</td>
                                    <td>0</td>
                                    <td>{{ number_format($etat["total_retenues"], 3) }} Ar</td>
                                    <td>{{ number_format($etat["salaire_net"], 3) }} Ar</td>
                                    <td>{{ number_format($etat["avance"], 3) }} Ar</td>
                                    <td>{{ number_format($etat["net_a_payer"], 3) }} Ar</td>
                                    <td>0</td>
                                    <td>{{ number_format($etat["net_a_payer"], 3) }} Ar</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                        
                    </table>

                </div>
            </div>

            <div class="modal-footer border-top-0 px-4 pt-0">
                <a href="{{ route('voir_etat_de_paie') }}"><button type="button" class="btn btn-primary">Retour</button></a>
            </div>

        </div>
    </div>
</div>
@endsection 
