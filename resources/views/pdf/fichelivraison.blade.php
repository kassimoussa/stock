@php
use App\Models\Direction;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche</title>

    <style>
        body {
            max-width: 900px;
            margin: auto;
        }

        .card {
            /* Add shadows to create the "card" effect */
            transition: 0.3s;
            border: 2cm;
            padding-bottom: 5px;

        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        /* Add some padding inside the card container */
        .container {
            margin-top: auto;
            margin-left: 10px;
            margin-bottom: 20px;
        }

        .title {
            color: navy;
            text-align: center;
        }

        .date {
            text-align: right;
        }

        .card-title {
            background: #4F81BD;
            color: white;
            text-align: center;
        }

        .row {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .row label {
            display: inline-block;
            padding: 5px;
        }

        .sign{
            justify-content: space-around;
        }

        .container-radio {
            display: inline-block;
            position: relative;
            padding-left: 5px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 19px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;

        }

        label {
            font-size: 18px;
        }

        .input-group {
            display: flex;
            align-content: stretch;
            margin-bottom: 2px;
        }

        .input-group>input {
            flex: 1 0 auto;
        }

        .right {
            float: right;
        }
        .left{
            float: left;
        }

        .flex {
            padding-bottom: 10px;
        }

        img {
            float: left;
            margin-right: 8px;
            width: 170px;
            height: 190px;
        }

        .col {
            margin-bottom: 5px;
        }

        .table,
        .td,
        .th {
            border: 1px solid black;
        }

        th {
            text-align: left;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            font-size: 18px;
        }

        .tt,
        th {
            font-size: 18px;
            font-weight: bold;
        }
        .bold{
            font-weight: bold;
        }
        

    </style>
</head>

<body>
    <div>
        <div>
            <img src="{{ url('/dtlogo.png') }}" alt="">
            <h2>DJIBOUTI TELECOM S.A.</h2>
            <h3>DIRECTION DES SYSTEMES D'INFORMATION </h3>
            <h4>Tél: (253)21 32 10 01</h4>
            <h4>Fax: (253)21 35 17 23</h4>
            <h4>BP: 2105 - 3, Bd G. Pompidou - Djibouti - République de Djibouti</h4>
        </div>
        <br>
        <br>
        <div class="date">
            <h4 class="bold">Djibouti le {{ date('d/m/Y') }} </h4>
        </div>

        <br>
        <div class="title">
            <h2>FICHE DE LIVRAISON </h2>
        </div>

        <div class="card">
            <div class="card-title">
                <h2>Departement </h2>
            </div>

            <div class="container">

                
                <div class="col mb-2">
                    <table>
                        <tbody>
                            <tr>
                                <td class="tt">Intervenant </td>
                                <td class="tc"> {{ $livraison->nom_intervenant }}</td>
                            </tr>
                            <tr>
                                <td class="tt">Demandeur </td>
                                <td class="tc"> {{ $livraison->nom_demandeur }}</td>
                            </tr>
                            @php
                                $dir = Direction::where('sigle', $livraison->direction)
                                    ->get()
                                    ->first();
                            @endphp
                            <tr>
                                <td class="tt">Direction</td>
                                <td class="tc"> {{ $dir->nom }}</td>
                            </tr>
                            <tr>
                                <td class="tt">Service</td>
                                <td class="tc"> {{ $livraison->service }}</td>
                            </tr>
                            
                            <tr>
                                <td class="tt">Date de livraision &nbsp;</td>
                                <td class="tc"> {{ date('d/m/Y', strtotime($livraison->date_livraison)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card  mb-3">
        <h2 class="card-title">Materiels Livrés</h2>
        <div class="container">
            <div class="col mb-2">
                <table class="table">
                    <thead class="thead">
                        <th class="th tt">Nom du materile</th>
                        <th class="th tt">Quantité</th>
                        <th class="th tt">Observation</th>
                    </thead>
                    <tbody>
                        @foreach ($materiels as $key => $materiel)
                            <tr>
                                <td class="td">{{ $materiel->nom_materiel . " / " . $materiel->description_mat . " / " . $materiel->marque_mat }}</td>
                                <td class="td">{{ $materiel->quantite }}</td>
                                <td class="td">{{ $materiel->observation }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="sign">
        <h4 class="bold left">Signature du livreur</h4>
        <h4 class="bold right">Signature du receveur</h4>
    </div>


</body>

</html>
