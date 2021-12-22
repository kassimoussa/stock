@extends('2.layout', ['page' => 'Modification Fiche d\'Acquisition', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row ">
        <div class="d-flex justify-content-between mt-3 mb-3" style="width: 80%">
            <h3 class="over-title ">FICHE D'ACQUISITION </h3>
            <a href="/acquisition" class="btn  btn-primary  fw-bold">RETOURNER</a>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger" style="width: 80%">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success" style="width: 80%">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('fail'))
                <div class="alert alert-danger" style="width: 80%">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{ url('/acquisition/update' , $acquisition) }}" role="form" method="post" class="form" style="width: 82%">
                @csrf
                @method("PUT")

                <div class="card  mb-3" >
                    <h4 class="card-header text-center">Demandeur</h4>
                    <div class="card-body">
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Nom: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nom_demandeur" value="{{ $acquisition->nom_demandeur }}">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Direction: </label>
                            <div class="col-sm-10">
                                <select class="form-select js-select2" name="dir_demandeur" id="direction">
                                    @foreach ($directions as $direction)
                                    @if ($direction['sigle'] == old('document') or $direction['sigle'] == $acquisition->dir_demandeur)
                                        <option value="{{ $direction['sigle'] }}" selected>{{ $direction['nom'] }}
                                        </option>
                                    @else
                                        <option value="{{ $direction['sigle'] }}">{{ $direction['nom'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Service: </label>
                            <div class="col-sm-10">
                                <select name="service_demandeur" id="serv" class="form-select js-select2">
                                    <option value="{{ $acquisition->service_demandeur }}">{{ $acquisition->service_demandeur }}</option>
                                </select>
                            </div>
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
                        <div class="mb-1 mt-2 row" id="inputautre" {{ $nomdiv }}>
                            <label class="col-sm-2 col-form-label ">Nom: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nom_mat"
                                    placeholder="Taper le nom du materiel" id="nom_mat_input" value="{{ $acquisition->nom_mat }}">
                            </div>
                        </div>
                        <div class="mb-1 row" id="desc" {{ $descdiv }}>
                            <label class="col-sm-2 col-form-label">Description: </label>
                            
                            <div class="col-sm-10">
                                <textarea name="description_mat" id="" class="form-control" cols="30" rows="2">{{ $acquisition->description_mat }}</textarea>
                            </div>
                        </div>
                        <div class="mb-1 row" id="marque" >
                            <label class="col-sm-2 col-form-label">Marque: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="marque_mat" value="{{ $acquisition->marque_mat }}">
                            </div>
                        </div>
                        <div class="mb-1 row" id="processeur" {{ $procediv }}>
                            <label class="col-sm-2 col-form-label">Processeur: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="processeur_mat" value="{{ $acquisition->processeur_mat }}">
                            </div>
                        </div>
                        <div class="mb-1 row" id="ram" {{ $ramdiv }}>
                            <label class="col-sm-2 col-form-label">Mémoire: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="ram_mat" value="{{ $acquisition->ram_mat }}">
                            </div>
                        </div>
                        <div class="mb-1 row" id="stockage" {{ $stockdiv }}>
                            <label class="col-sm-2 col-form-label">Stockage: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="stockage_mat" value="{{ $acquisition->stockage_mat }}">
                            </div>
                        </div>
                        <div class="mb-1 row" id="os" {{ $sediv }}>
                            <label class="col-sm-2 col-form-label">S.E: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="os_mat" value="{{ $acquisition->os_mat }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-5 text-center" >
                    <div class="col-md-12 form-group">
                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifier</button>
                        <button type="reset" class="btn btn-default fw-bold">Annuler</button>
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
