@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">

            <div class="card-body px-3 px-md-5">

                <div class="card-title">
                    <center><h2>ETAT DE PAIE</h2></center>
                    <center><h4>DU {{ $dateDebut }} AU {{ $dateFin }}</h4></center>
                </div>

                <br>

                <div class="card-body">
                    <table class="table">
                        <thead style="align-items: center;">
                            <th>Date</th>
                            <th class="col-1">Nbr</th>
                            <th>N° Matricule</th>
                            <th>N° CNAPS</th>
                            <th>Nom et Prenoms</th>
                            <th>Date d'embauche</th>
                            <th class="col-1">Absence</th>
                            <th>CAT</th>
                            <th>Fonction</th>
                            <th>Salaire de base</th>
                            <th>Retenues sur absences</th>
                        </thead>
                        <tbody>
                            @foreach($listesEtats as $etat)
                                <tr>
                                    <td>{{ $etat["dateFin"] }}</td>				
                                    <td>1</td>	
                                    <td>{{ $etat["employe"]->id_emp }}</td>
                                    <td>{{ $etat["employe"]->CNAPS->id }}</td>
                                    <td>{{ $etat["employe"]->client->nom }} {{ $etat["employe"]->client->prenom }}</td>
                                    <td>{{ $etat["historique_embauche"]->date }}</td>
                                    <td>{{ $etat["absences"]["heures"] }}</td>
                                    <td>{{ $etat["besoin"]->service->type }}</td>
                                    <td>{{ $etat["besoin"]->poste->type }}</td>
                                    <td>{{ $etat["salaire_base"] }}</td>
                                    <td>{{ number_format($etat["retenu_absence"], 3) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td style="color:#871F78 ;"><strong>TOTAL</strong></td>				
                                <td style="color:#871F78 ;"><strong></strong></td>	
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong>{{ $total["total_salaire_base"] }}</strong> Ar</td>
                                <td style="color:#871F78 ;"><strong>{{ $total["total_retenu_absence"] }}</strong> Ar</td>
                            </tr>
                        
                        </tbody>
                        
                    </table>

                    <br><br>

                    <table class="table">
                        <thead style="align-items: center;">
                            <th>Salaire de base du mois</th>
                            <th>HR Sup/Maj</th>
                            <th>Salaire Brut</th>
                            <th>CNAPS 1%</th>
                            <th>CNAPS 8%</th>
                            <th>OSTIE 1%</th>
                            <th>OSTIE 5%</th>
                            <th>Revenu Imposable</th>
                        </thead>
                        <tbody>
                            @foreach($listesEtats as $etat)
                                <tr>				
                                    <td>{{ number_format($etat["salaire_base_mois"], 3) }}</td>
                                    <td>{{ number_format($etat["heures_sup_jours"]["taux"][0], 3) }}</td>
                                    <td>{{ number_format($etat["salaire_brut"], 3) }}</td>
                                    <td>{{ number_format($etat["retenu_1%_CNAPS"], 3) }}</td>
                                    <td>{{ number_format($etat["retenu_1%_CNAPS"]*8, 3) }}</td>
                                    <td>{{ number_format($etat["retenu_sanitaire"], 3) }}</td>
                                    <td>{{ number_format($etat["retenu_sanitaire"]*5, 3) }}</td>
                                    <td>{{ number_format($etat["montant_imposable"], 3) }}</td>				
                                </tr>
                            @endforeach

                            <tr>				
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_salaire_base_mois"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_heure_sup_maj"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_salaire_brut"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_cnaps_1"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_cnaps_1"]*8, 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_ostie_1"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_ostie_1"]*5, 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_revenue_imposable"], 3) }} Ar</strong></td>				
                            </tr>
                        
                        </tbody>
                        
                    </table>

                    <br><br>

                    <table class="table">
                        <thead style="align-items: center;">
                            <th>Impôt dû</th>
                            <th>Enfant A Charge</th>
                            <th>Montant</th>
                            <th>IGR Net</th>
                            <th>TOTAL RETENUES </th>
                            <th>Salaire Net</th>
                            <th>Avance</th>
                            <th>Net A Payer</th>
                            <th>Net Du Mois </th>
                        </thead>
                        <tbody>
                            @foreach($listesEtats as $etat)
                                <tr>
                                    <td>{{ number_format($etat["impot"], 3) }}</td>	
                                    <td>{{ count($etat["liste_enfants"]) }}</td>
                                    <td>{{ number_format($etat["montant_enfant_charge"], 3) }}</td>
                                    <td>{{ number_format($etat["IGR_Net"], 3) }}</td>
                                    <td>{{ number_format($etat["total_retenues"], 3) }} Ar</td>
                                    <td>{{ number_format($etat["salaire_net"], 3) }} Ar</td>
                                    <td>{{ number_format($etat["avance"], 3) }} Ar</td>
                                    <td>{{ number_format($etat["net_a_payer"], 3) }} Ar</td>
                                    <td>{{ number_format($etat["net_a_payer"], 3) }} Ar</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_impot_du"], 3) }} Ar</strong></td>	
                                <td style="color:#871F78 ;"><strong></strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_montant_enfant"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_IGR_Net"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_total_retenues"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_salaire_net"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_avance"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_net_a_payer"], 3) }} Ar</strong></td>
                                <td style="color:#871F78 ;"><strong>{{ number_format($total["total_net_du_mois"], 3) }} Ar</strong></td>
                            </tr>
                        
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
