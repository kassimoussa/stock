@php
use App\Models\Direction;
@endphp
@extends('2.sih.layout', ['page' => 'Modification Fiche d\'Acquisition', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row ">
        <div class="d-flex justify-content-between mt-3 mb-3"  >
            <h3 class="over-title ">FICHE D'ACQUISITION </h3>
            <a href="/acquisition" class="btn  btn-primary  fw-bold">RETOURNER</a>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger"  >
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success"  >
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('fail'))
                <div class="alert alert-danger"  >
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{ url('/acquisition/update' , $acquisition) }}" role="form" method="post" class="form"  >
                @csrf
                @method("PUT")

                <div class="card  mb-3" >
                    <h4 class="card-header text-center">Demandeur</h4>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold ">Nom</span>
                            <label class="form-control">{{ $acquisition->nom_demandeur }} </label>
                        </div>
                        @php
                            $dir = Direction::where('sigle', $acquisition->dir_demandeur)
                                ->get()
                                ->first();
                        @endphp
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Direction</span>
        
                            <label class="form-control">{{ $dir->nom }} </label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Service</span>
                            <label class="form-control">{{ $acquisition->service_demandeur }} </label>
                        </div>  
                    </div>
                </div>
                <div class="card mb-3">
                    <h4 class="card-header text-center">Materiel et Description
                    </h4>
                    <div class="card-body">
                        <div class="col mb-2">
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
                                    $quantitediv = ' ';
                                    $modeldiv = ' ';
                                    $procediv = ' ';
                                    $ramdiv = ' ';
                                    $stockdiv = ' ';
                                    $sediv = ' ';
                                } elseif ($acquisition->nom_mat == 'PC Portable') {
                                    $pcp = 'checked';
                                    $pcb = $ai = $imp = $fax = $log = $autre = ' disabled ';
                                    $nomdiv = 'hidden';
                                    $descdiv = 'hidden';
                                    $modeldiv = ' ';
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
                                    $modeldiv = ' ';
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
                                    $modeldiv = ' ';
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
                                    $modeldiv = ' ';
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
                                    $modeldiv = ' ';
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
                                    $modeldiv = ' ';
                                    $procediv = 'hidden';
                                    $ramdiv = 'hidden';
                                    $stockdiv = 'hidden';
                                    $sediv = 'hidden';
                                    $disabled = ' ';
                                }
                            @endphp
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nom_mat" id="pcb" value="PC Bureau"
                                    {{ $pcb }}>
                                <label class="form-check-label" for="pcb">PC Bureau</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nom_mat" id="pcp" value="PC Portable"
                                    {{ $pcp }}>
                                <label class="form-check-label" for="pcp">PC Portable</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nom_mat" id="ai"
                                    value="Accessoires informatiques" {{ $ai }}>
                                <label class="form-check-label" for="ai">Accessoires informatiques</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nom_mat" id="imp" value="Imprimante"
                                    {{ $imp }}>
                                <label class="form-check-label" for="imp">Imprimante</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nom_mat" id="fax" value="Fax"
                                    {{ $fax }}>
                                <label class="form-check-label" for="fax">Fax</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nom_mat" id="log" value="Logiciel"
                                    {{ $log }}>
                                <label class="form-check-label" for="log">Logiciel</label>
                            </div>
                            <div class="form-check form-check-inline mb-2">
                                <input class="form-check-input" type="radio" name="nom_mat" id="autre" {{ $autre }}>
                                <label class="form-check-label" for="autre">Autre</label>
                            </div>
                        </div>

                        <div class="mb-1 mt-2 row" id="quant"  >
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Quantité</span>
                                <input type="text" class="form-control" name="quantite" value="{{ $acquisition->quantite }}">
                            </div>
                        </div>

                        <div class="mb-1 mt-2 row" id="inputautre" {{ $nomdiv }}> 
                        <div class="input-group ">
                            <span class="input-group-text txt fw-bold ">Nom</span>
                            <input type="text" class="form-control" name="nom_mat"
                                    placeholder="Taper le nom du materiel" id="nom_mat_input" value="{{ $acquisition->nom_mat }}">
                        </div> 
                        </div>
                        <div class="mb-1 row" id="desc" {{ $descdiv }}>
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Description</span>
                                <input type="text" class="form-control" name="description_mat" value="{{ $acquisition->description_mat }}">
                            </div>  
                        </div>
                        <div class="mb-1 row" id="marque"  >
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Marque</span>
                                <input type="text" class="form-control" name="marque_mat" value="{{ $acquisition->marque_mat }}">
                            </div>  
                        </div>
                        <div class="mb-1 row" id="model" {{ $modeldiv }}>
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Model</span>
                                <input type="text" class="form-control" name="model_mat" value="{{ $acquisition->model_mat }}">
                            </div>  
                        </div>
                        <div class="mb-1 row" id="processeur" {{ $procediv }}>
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Processeur</span>
                                <input type="text" class="form-control" name="processeur_mat" value="{{ $acquisition->processeur_mat }}">
                            </div>  
                        </div>
                        <div class="mb-1 row" id="ram" {{ $ramdiv }}>
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Mémoire</span>
                                <input type="text" class="form-control" name="ram_mat" value="{{ $acquisition->ram_mat }}">
                            </div>  
                        </div>
                        <div class="mb-1 row" id="stockage" {{ $stockdiv }}>
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Stockage</span>
                                <input type="text" class="form-control" name="stockage_mat" value="{{ $acquisition->stockage_mat }}">
                            </div>  
                        </div>
                        <div class="mb-1 row" id="os" {{ $sediv }}>
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">S.E</span>
                                <input type="text" class="form-control" name="os_mat"  value="{{ $acquisition->os_mat }}">
                            </div>  
                        </div> 
                    </div>
                    <div class="row mt-3 mb-3 text-center" >
                    <div class="col-md-12 form-group">
                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifier</button>
                        <button type="reset" class="btn btn-outline-danger fw-bold">Annuler</button>
                    </div>
                </div>
                </div>
                
            </form>
        </div>
    </div>
    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

        .btn-primary {
            color: white;
        }

        .card-header {
            background: #4F81BD;
            color: white;
        }
        .input-group-text {
            width: 133px;
        }

    </style>
    <script>
        $(function() {
            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == "autre") {
                    $("#nom_mat_input").removeAttr('disabled');
                    $("#desc").show();
                    $("#inputautre").show();
                    $("#marque").show();
                    $("#processeur").hide();
                    $("#ram").hide();
                    $("#stockage").hide();
                    $("#os").hide();
                }
                if (($(this).attr('id') == "pcp") || ($(this).attr('id') == "pcb")) {
                    $("#nom_mat_input").prop('disabled', true); 
                    $("#marque").show();
                    $("#processeur").show();
                    $("#ram").show();
                    $("#stockage").show();
                    $("#os").show();
                    $("#inputautre").hide();
                    $("#desc").hide();
                }
                if (($(this).attr('id') == "ai") || ($(this).attr('id') == "imp") || ($(this).attr('id') ==
                        "fax") || ($(this).attr('id') == "log")) {
                    $("#nom_mat_input").prop('disabled', true); 
                    $("#desc").show();
                    $("#marque").show();
                    $("#processeur").hide();
                    $("#ram").hide();
                    $("#stockage").hide();
                    $("#os").hide();
                    $("#inputautre").hide();
                }

            });
        });
    </script>
    <script>
        $('#direction').change(function() {

            var directionID = $(this).val();

            if (directionID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getServices') }}?dir_id=" + directionID,
                    success: function(res) {

                        if (res) {

                            $("#serv").empty();
                            $("#serv").append('<option>Select Service</option>');
                            $.each(res, function(key, value) {
                                $("#serv").append('<option value="' + value + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#serv").empty();
                        }
                    }
                });
            } else {

                $("#serv").empty();
            }
        });
    </script>
@endsection
