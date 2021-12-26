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

        $primary-color: #00005c; // Change color here. C'mon, try it! 
        $text-color: mix(#000, $primary-color, 64%);

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
            margin-right: 20px;
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

        /* .table,
        .td,
        .th {
            border: 0px solid black;
        } */

        th,
        td {
            text-align: left;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            font-size: 18px;
        }

        .tt,
        th {
            font-size: 20px;
            font-weight: bold;
        }


        .card-title2 {
            background: #212529;
            color: white;
            text-align: center;
        }

    </style>
</head>

<body>
    <div>
        <img src="{{ url('/dtlogo.png') }}" alt="">
        <h2>DJIBOUTI TELECOM S.A.</h2>
        <h3>DIRECTION DES SYSTEMES D'INFORMATION </h3>
        <h5>Tél: (253)21 32 10 01</h5>
        <h5>Fax: (253)21 35 17 23</h5>
        <h5>BP: 2105 - 3, Bd G. Pompidou - Djibouti - République de Djibouti</h5>
    </div>
    <br>
    <div class="title">
        <h2>FICHE D'ACQUISITION DES MATERIELS INFORMATIQUES </h2>
    </div>
    <div class="card">
        <div class="card-title">
            <h2>Technicien </h2>
        </div>

        <div class="container">
            <table>
                <tbody>
                    <tr>
                        <td class="tt">Intervenant &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="tc"> {{ $intervention->nom_intervenant }}</td>
                    </tr>
                    <tr>
                        <td class="tt">Diagnostique &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="tc"> {{ $intervention->diagnostique }}</td>
                    </tr>
                    <tr>
                        <td class="tt">Date d'intervention &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="tc">  {{ date('d/m/Y', strtotime($intervention->date_intervention)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="info">
        <div class="card">
            <div class="card-title">
                <h2>Informations </h2>
            </div>
            <table class='table'>
                <tr>
                    <td class="td" colspan="">
                        <div class="card-title2">
                            <h2>Sur le materiel </h2>
                        </div>
                    </td>
                    <td class="td" colspan="">
                        <div class="card-title2">
                            <h2>Sur le demandeur </h2>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="td" colspan="1">
                        <div class="container">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="tt">Materiel &nbsp;</td>
                                        <td class="tc"> {{ $intervention->materiel }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tt">Model &nbsp;</td>
                                        <td class="tc"> {{ $intervention->model }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tt">Réf patrimoine &nbsp;</td>
                                        <td class="tc"> {{ $intervention->ref_patrimoine }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tt">Date d'acquisition &nbsp;</td>
                                        <td class="tc">
                                            {{ date('d/m/Y', strtotime($intervention->date_acquisition)) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td class="td" colspan="1">
                        <div class="container">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="tt">Propriétaire &nbsp;</td>
                                        <td class="tc"> {{ $intervention->nom_demandeur }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tt">Direction &nbsp;</td>
                                        <td class="tc"> {{ $intervention->dir_demandeur }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tt">Service &nbsp;</td>
                                        <td class="tc"> {{ $intervention->service_demandeur }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <br><br>
    <div class="card sih">
        <div class="card-title">
            <h2>SIH </h2>
        </div>
        <div class="container flex">
            <div class="row left">
                <label for=""><b> Suggestion : </b></label>
                <label for=""> {{ $intervention->suggestion }}</label>
            </div>
            <div class="right">
                <label for=""><b> Date : </b></label>
                <label for=""> Le {{ date('d/m/Y', strtotime($intervention->date_sih)) }}</label>
            </div>

        </div>
    </div>
    <br>

    <div class="card">
        <div class="card-title">
            <h2>Direction demandeur </h2>
        </div>
        <div class="container flex">
            <div class="row left">
                <label for=""><b> Commentaire : </b></label>
                <label for=""> {{ $intervention->commentaire }}</label>
            </div>
            <div class="right">
                <label for=""><b> Date : </b></label>
                <label for=""> Le {{ date('d/m/Y', strtotime($intervention->date_dir)) }}</label>
            </div>

        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-title">
            <h2>DIN </h2>
        </div>
        <div class="container flex">
            <div class="row left">
                <label for=""><b> Avis : </b></label>
                <label for=""> {{ $intervention->avis }}</label>
            </div>
            <div class="right">
                <label for=""><b> Date : </b></label>
                <label for=""> Le {{ date('d/m/Y', strtotime($intervention->date_din)) }}</label>
            </div>

        </div>
    </div>


</body>

</html>
