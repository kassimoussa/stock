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

        .table,
        .td,
        .th {
            border: 1px solid black;
        }

        th,
        td {
            text-align: left;
        }

        .table {
            border-collapse: collapse;
        }

        td {
            font-size: 18px;
        }

        .tt,
        th {
            font-size: 20px;
            font-weight: bold;
        }

        .radio:checked {
                background-color: mix(#fff, $primary-color, 84%);

                &:before {
                    box-shadow: inset 0 0 0 0.4375em $primary-color;
                }
            
        }

    </style>
</head>

<body>
    <div>
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
                <h2>DEMANDEUR </h2>
            </div>

            <div class="container">
                <table>
                    <tbody>
                        <tr>
                            <td class="tt">Nom et Prénom &nbsp;</td>
                            <td class="tc"> {{ $acquisition->nom_demandeur }}</td>
                        </tr>
                        @php
                            $dir = Direction::where('sigle', $acquisition->dir_demandeur)
                                ->get()
                                ->first();
                            
                        @endphp
                        <tr>
                            <td class="tt">Direction</td>
                            <td class="tc"> {{ $dir->nom }}</td>
                        </tr>
                        <tr>
                            <td class="tt">Service</td>
                            <td class="tc"> {{ $acquisition->service_demandeur }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-title">
            <h2>Materiel et Description</h2>
        </div>
        @php
            $pcb = ' ';
            $pcp = ' ';
            $ai = ' ';
            $imp = ' ';
            $fax = ' ';
            $log = ' ';
            $autre = ' ';
            
            if ($acquisition->nom_mat == 'PC Bureau') {
                $pcb = 'checked';
                $pcp = $ai = $imp = $fax = $log = $autre = ' disabled ';
                $nomdiv = 'hidden';
                $descdiv = 'hidden';
                $procediv = ' ';
                $ramdiv = ' ';
                $stockdiv = ' ';
                $sediv = ' ';
            } elseif ($acquisition->nom_mat == 'PC Portable') {
                $pcp = 'checked';
                $pcb = $ai = $imp = $fax = $log = $autre = ' disabled ';
                $nomdiv = 'hidden';
                $descdiv = 'hidden';
                $procediv = ' ';
                $ramdiv = ' ';
                $stockdiv = ' ';
                $sediv = ' ';
                $disabled = ' ';
            } elseif ($acquisition->nom_mat == 'Accessoires informatiques') {
                $ai = 'checked';
                $pcb = $pcp = $imp = $fax = $log = $autre = ' disabled ';
                $nomdiv = 'hidden';
                $descdiv = ' ';
                $procediv = 'hidden';
                $ramdiv = 'hidden';
                $stockdiv = 'hidden';
                $sediv = 'hidden';
                $disabled = ' ';
            } elseif ($acquisition->nom_mat == 'Imprimante') {
                $imp = 'checked';
                $pcb = $pcp = $ai = $fax = $log = $autre = ' disabled ';
                $nomdiv = 'hidden';
                $descdiv = ' ';
                $procediv = 'hidden';
                $ramdiv = 'hidden';
                $stockdiv = 'hidden';
                $sediv = 'hidden';
                $disabled = ' ';
            } elseif ($acquisition->nom_mat == 'Fax') {
                $fax = 'checked';
                $pcb = $pcp = $imp = $ai = $log = $autre = ' disabled ';
                $nomdiv = 'hidden';
                $descdiv = '';
                $procediv = 'hidden';
                $ramdiv = 'hidden';
                $stockdiv = 'hidden';
                $sediv = 'hidden';
                $disabled = ' ';
            } elseif ($acquisition->nom_mat == 'Logiciel') {
                $log = 'checked';
                $pcb = $pcp = $imp = $fax = $ai = $autre = ' disabled ';
                $nomdiv = 'hidden';
                $descdiv = '';
                $procediv = 'hidden';
                $ramdiv = 'hidden';
                $stockdiv = 'hidden';
                $sediv = 'hidden';
                $disabled = ' ';
            } else {
                $autre = 'checked';
                $pcb = $pcp = $imp = $fax = $log = $ai = ' disabled ';
                $nomdiv = ' ';
                $descdiv = '';
                $procediv = 'hidden';
                $ramdiv = 'hidden';
                $stockdiv = 'hidden';
                $sediv = 'hidden';
                $disabled = ' ';
            }
        @endphp

        <div class="container">
            <label class="container-radio">
                <input type="radio" name="radio" class="radio" {{ $pcb }}> PC Bureau
                <span class="checkmark"></span>
            </label>
            <label class="container-radio">
                <input type="radio" name="radio" class="radio" {{ $pcp }}> PC Portable
                <span class="checkmark"></span>
            </label>
            <label class="container-radio">
                <input type="radio" name="radio" class="radio" {{ $ai }}> Accessoires informatiques
                <span class="checkmark"></span>
            </label>
            <label class="container-radio">
                <input type="radio" name="radio" class="radio" {{ $imp }}> Imprimante
                <span class="checkmark"></span>
            </label>
            <label class="container-radio">
                <input type="radio" name="radio" class="radio" {{ $fax }}> Fax
                <span class="checkmark"></span>
            </label>
            <label class="container-radio">
                <input type="radio" name="radio" class="radio" {{ $log }}> Logiciel
                <span class="checkmark"></span>
            </label>
            <label class="container-radio">
                <input type="radio" name="radio" class="radio" {{ $autre }}> Autre
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="container">
            <table>
                <tbody>
                    <tr>
                        <td class="tt">Quantité &nbsp;</td>
                        <td class="tc"> {{ $acquisition->quantite }}</td>
                    </tr>
                    <tr>
                        <td class="tt" {{ $nomdiv }}>Nom &nbsp;</td>
                        <td class="tc" {{ $nomdiv }}> {{ $acquisition->nom_mat }}</td>
                    </tr>
                    <tr>
                        <td class="tt" {{ $descdiv }}>Description &nbsp;</td>
                        <td class="tc" {{ $descdiv }}> {{ $acquisition->description_mat }}</td>
                    </tr>
                    <tr>
                        <td class="tt">Marque &nbsp;</td>
                        <td class="tc"> {{ $acquisition->marque_mat }}</td>
                    </tr>
                    <tr>
                        <td class="tt">Model &nbsp;</td>
                        <td class="tc"> {{ $acquisition->model_mat }}</td>
                    </tr>
                    <tr>
                        <td class="tt" {{ $procediv }}>Processeur &nbsp;</td>
                        <td class="tc" {{ $procediv }}> {{ $acquisition->processeur_mat }}</td>
                    </tr>
                    <tr>
                        <td class="tt" {{ $ramdiv }}>Mémoire &nbsp;</td>
                        <td class="tc" {{ $ramdiv }}> {{ $acquisition->ram_mat }}</td>
                    </tr>
                    <tr>
                        <td class="tt" {{ $ramdiv }}>Stockage</td>
                        <td class="tc" {{ $ramdiv }}> {{ $acquisition->stockage_mat }}</td>
                    </tr>
                    <tr>
                        <td class="tt" {{ $sediv }}>S.E</td>
                        <td class="tc" {{ $sediv }}> {{ $acquisition->os_mat }}</td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="col" {{ $nomdiv }}>
                <label class="input-group-lbl"><b style="margin-right: 5%">Nom :</b> {{ $acquisition->nom_mat }}
                </label> <br>
            </div>

            <div class="col" {{ $descdiv }}>
                <label class="input-group-lbl"><b style="margin-right: 2%">Description :</b>
                    {{ $acquisition->description_mat }} </label> <br>
            </div>
            <div class="col">
                <label class="input-group-lbl"><b style="margin-right: 4%">Marque :</b>
                    {{ $acquisition->marque_mat }} </label> <br>
            </div>
            <div class="col" {{ $procediv }}>
                <label class="input-group-lbl"><b style="margin-right: 3%">Processeur :</b>
                    {{ $acquisition->processeur_mat }} </label> <br>
            </div>
            <div class="col" {{ $ramdiv }}>
                <label class="input-group-lbl"><b style="margin-right: 4%">Mémoire :</b> {{ $acquisition->ram_mat }}
                </label> <br>
            </div>
            <div class="col" {{ $stockdiv }}>
                <label class="input-group-lbl"><b style="margin-right: 4%">Stockage :</b>
                    {{ $acquisition->stockage_mat }} </label> <br>
            </div>
            <div class="col" {{ $sediv }}>
                <label class="input-group-lbl"><b style="margin-right: 6%">S.E :</b> {{ $acquisition->os_mat }}
                </label> <br>
            </div> --}}

        </div>
    </div>

    @if ($acquisition->dir_demandeur != 'DSI')
        <div class="card">
            <div class="card-title">
                <h2>Visa Directeur ou Chef de département demandeur </h2>
            </div>

            <div class="container flex">
                <div class="row left">
                    <label for=""><b> Date : </b></label>
                    <label for=""> Le {{ date('d/m/Y', strtotime($acquisition->date_dir)) }}</label>
                </div>
                <div class="right">
                    <label class="container-radio">
                        <input type="checkbox" checked> Le Directeur de la {{ $acquisition->dir_demandeur }}
                        <span class="checkmark"></span>
                    </label>
                </div>

            </div>
        </div>
    @endif
        
    <br>
    <br>
    
    <div class="card">
        <div class="card-title">
            <h2>Visa DSI </h2>
        </div>

        <div class="container flex">
            <div class="row left">
                <label for=""><b> Date : </b></label>
                <label for="">Le {{ date('d/m/Y', strtotime($acquisition->date_dsi)) }} </label>
            </div>
            <div class="right">
                <label class="container-radio">
                    <input type="checkbox" checked> Le Directeur de la DSI
                    <span class="checkmark"></span>
                </label>
            </div>

        </div>
    </div>
    </div>

</body>

</html>
