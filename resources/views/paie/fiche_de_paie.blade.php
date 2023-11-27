@extends("template.header")

@section("contenu")
<div class="content-wrapper">
  <div class="content">
    <div class="card card-default" style="padding:1rem;">

      <div class="card-body px-3 px-md-5">

        <div class="card-title">
            <center><h2>FICHE DE PAIE</h2></center>
            <center><h4>ARRETE AU {{ $dateFin->format('d/m/y') }}</h4></center>
        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
            <p><strong>Nom et Prénoms : </strong>{{ $employe->client->nom }} {{ $employe->client->prenom }}</p>
                <p><strong>Matricule : </strong>{{ $employe->id_emp }}</p>
                <p><strong>Fonction : </strong>{{ $besoin->poste->type }}</p>
                <p><strong>N° CNaPS : </strong>{{ $employe->CNAPS->id }}</p>
                <p><strong>Date d'embauche : </strong>{{ $historique_embauche->date }}</p>
                <p><strong>Ancienneté : </strong>{{ $anciennete->date }} a {{ $dateFin->format('Y-m-d') }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Classification : </strong>{{ $besoin->service->type }}</p>
                <p><strong>Salaire de base : </strong>{{ $salaire->brut }}</p>
                <p><strong>Taux journaliers : </strong>{{ $taux_journaliers }}</p>
                <p><strong>Taux horaires : </strong>{{ $taux_horaires }}</p>
                <p><strong>Indice : </strong>{{ $indice }}</p>
            </div>
        </div>

      </div>

      <div class="card-body">
        <table class="table">
            <thead style="align-items: center;">
                <th class="col-6">Désignations</th>
                <th class="col-2">Nombre</th>
                <th class="col-2">Taux</th>
                <th class="col-2">Montant</th>
            </thead>
            <tbody>
                <tr>
                    <td>Salaire du {{ $dateDebut->format('d/m/y') }} au {{ $dateFin->format('d/m/y') }}</td>				
                    <td>{{ $presences["heures"] }}h pendant {{ $presences["presence_jours"] }}jrs</td>	
                    <td>{{ $taux_horaires }}</td>
                    <td>{{ number_format($presences["prix"], 3) }}</td>
                </tr>
                <tr>
                    <td>Absences déductibles</td>				
                    <td>0</td>	
                    <td>{{ $taux_horaires }}</td>
                    <td>{{ number_format(0, 3) }}</td>
                </tr>
                <tr>
                    <td>Primes de rendement</td>				
                    <td>{{ $prime["rendement"]->nombre }}</td>	
                    <td>{{ number_format($prime["rendement"]->montant, 3) }}</td>
                    <td>{{ number_format($prime["rendement"]->montant, 3) }}</td>
                </tr>
                <tr>
                    <td>Primes d'ancienneté</td>				
                    <td>{{ $prime["anciennete"]->nombre }}</td>	
                    <td>{{ number_format($prime["anciennete"]->montant, 3) }}</td>
                    <td>{{ number_format($prime["anciennete"]->montant, 3) }}</td>
                </tr>
                <tr>
                    <td>Heures supplémentaires majorées de 30%</td>				
                    <td>{{ $heures_sup_jours["heures"][0] }} h</td>	
                    <td>{{ number_format($majoration["30"], 3) }}</td>
                    <td>{{ number_format($heures_sup_jours["taux"][0], 3) }}</td>
                </tr>
                <tr>
                    <td>Heures supplémentaires majorées de 40%</td>				
                    <td>{{ $heures_sup_jours["heures"][1] }} h</td>	
                    <td>{{ number_format($majoration["40"], 3) }}</td>
                    <td>{{ number_format($heures_sup_jours["taux"][1], 3) }}</td>
                </tr>
                @for($i = 0; $i <count($majoration_nuit)-1; $i++)
                <tr>
                    <td>Majoration pour heures de nuit majorées de {{ $majoration_nuit[$i]["majoration"] }}%</td>				
                    <td>{{ $majoration_nuit[$i]["heures"] }} h</td>	
                    <td>{{ number_format($majoration_nuit[$i]["prix_majoration"], 3) }}</td>
                    <td>{{ number_format($majoration_nuit[$i]["prix"], 3) }}</td>
                </tr>	
                @endfor
                <tr>
                    <td>Primes diverses</td>				
                    <td>{{ $prime["divers"]->nombre }}</td>	
                    <td>{{ number_format($prime["divers"]->montant, 3) }}</td>
                    <td>{{ number_format($prime["divers"]->montant, 3) }}</td>
                </tr>
                <tr>
                    <td>Rappels sur période antérieure</td>				
                    <td>0</td>	
                    <td>0</td>
                    <td>{{ number_format(0, 3) }}</td>
                <tr>
                    <td>Droits de congés</td>				
                    <td>{{ $conges["heures"] }} h</td>	
                    <td>{{ $taux_horaires }}</td>
                    <td>{{ number_format($conges["prix"], 3) }}</td>
                </tr>
                <tr>
                    <td>Droits de préavis</td>				
                    <td>0</td>	
                    <td>{{ $taux_horaires }}</td>
                    <td>{{ number_format(0, 3) }}</td>
                <tr>
                    <td>Indemnités de licenciement</td>				
                    <td>0</td>	
                    <td>{{ $taux_horaires }}</td>
                    <td>{{ number_format(0, 3) }}</td>
                <tr>
                    <td></td>				
                    <td></td>	
                    <td><strong>Salaire Brut</strong></td>
                    <td><strong>{{ number_format($salaire_brut, 3) }}</strong></td>
                </tr>
        
            </tbody>
        
        </table>

        <table class="table">
          <thead style="align-items: center;">
            <th class="col-6"></th>
            <th class="col-2"></th>
            <th class="col-2"></th>
          </thead>
          <tbody>
            <tr>
                <td>Retenue CNaPS 1%</td>	
                <td></td>	
                <td></td>	
                <td>20,000.00</td>
            </tr>
            <tr>
                <td>Retenue Sanitaire</td>				
                <td></td>	
                <td></td>	
                <td>40,834.09</td>
            </tr>
            <tr>
                <td>Tranche IRSA INF {{ $liste_tranche[1]->debut }}</td>				
                <td></td>	
                <td>{{ $liste_tranche[0]->majoration }}%</td>	
                <td>{{ number_format($liste_Tranche_IRSA[0], 3) }}</td>
            </tr>
            @for($i=1; $i<count($liste_Tranche_IRSA)-2; $i++)
            <tr>
                <td>Tranche IRSA DE {{ $liste_tranche[$i]->debut }} à {{ $liste_tranche[$i]->fin }}</td>				
                <td></td>	
                <td>{{ $liste_tranche[$i]->majoration }}%</td>	
                <td>{{ number_format($liste_Tranche_IRSA[$i], 3) }}</td>
            </tr>
            @endfor
            <tr>
                <td>Tranche IRSA SUP {{ $liste_tranche[count($liste_tranche)-2]->fin }}</td>				
                <td></td>	
                <td>{{ $liste_tranche[count($liste_tranche)-1]->majoration }}%</td>	
                <td>{{ number_format($liste_Tranche_IRSA[count($liste_Tranche_IRSA)-2], 3) }}</td>
            </tr>
            <tr>
                <td></td>				
                <td></td>	
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>TOTAL IRSA</strong></td>				
                <td></td>	
                <td></td>	
                <td>{{ number_format($liste_Tranche_IRSA[count($liste_Tranche_IRSA)-1]["somme"], 3) }}</td>
            </tr>
            <tr>
                <td></td>				
                <td></td>	
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td></td>				
                <td></td>	
                <td><strong>Total des retenues</strong></td>
                <td><strong>{{ number_format($total_retenu, 3) }}</strong></td>
            </tr>

            <tr>
                <td></td>				
                <td></td>	
                <td><strong>Autres indemnités</strong></td>
                <td><strong>0</strong></td>
            </tr>

            <tr>
                <td></td>				
                <td></td>	
                <td><strong>Net à payer</strong></td>
                <td><strong>{{ number_format($net_a_payer, 3) }} Ar</strong></td>
            </tr>
    
          </tbody>
    
        </table>

        <p><strong>Avantages en nature : </strong>{{ $avantage_en_nature }}</p>
        <p><strong>Deduction IRSA: </strong></p>
        <p><strong>Montant imposable : </strong> {{ number_format($montant_imposable, 3) }}</p>

        <br>

        <p><strong>Mode de paiement: </strong> <strong style="color:blueviolet"> Virement / Chèque</strong></p>

        <div class="row">
          <div class="col-md-6">
            <center><p><strong>L'employeur</strong></p></center>
          </div>
          <div class="col-md-6">
            <center><p><strong>L'employé(e)</strong></p></center>
          </div>
        </div>
      </div>
        <div class="modal-footer border-top-0 px-4 pt-0">
            <a href="{{ route('voir_fiche_de_paie') }}"><button type="button" class="btn btn-primary">Retour</button></a>
        </div>
    </div>
  </div>
</div>
@endsection