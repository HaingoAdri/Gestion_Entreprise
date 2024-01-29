@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Liste des proces verbal d'utilisation avec besoin de validation </h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Module</th>
                            <th>Pv Récéption</th>
                            <th>Quantite</th>
                            <th>Etat</th>
                            <th>Article</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                        <tr id="tbody-age">
                            <th></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><select name="etats" id="" class=form-control>
                                <option value="1">Neuf</option>
                            </select></td>
                            <td></td>
                            <td><textarea name="description" placeholder="Description de l'article" class="form-control"></textarea></td>
                            <td>
                            <a href="#"><button type="button" class="btn btn-primary">Valider</button></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection