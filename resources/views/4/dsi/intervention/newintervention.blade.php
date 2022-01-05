@extends('4.layout', ['page' => 'Nouvelle Intervention', 'pageSlug' => 'intervention'])
@section('content')

    <div class="row mt-3">
        <h3 class="fw-bold mt-3">FICHE D'INTERVENTION</h3>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('fail'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="addintervention" role="form" method="post" class="form">
                @csrf

                <div class="card col mb-3">
                    <h4 class="card-header text-center">Technicien</h4>
                    <div class="card-body">
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Nom Intervenant: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nom_intervenant">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Diagnostique: </label>
                            <div class="col-sm-10">
                                <textarea name="diagnostique" id="" class="form-control" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col mb-3">
                    <h4 class="card-header text-center">Demandeur</h4>
                    <div class="card-body">
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Nom Demandeur: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nom_demandeur">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Service du demandeur: </label>
                            <div class="col-sm-10">
                                <select class="form-select" name="service_demandeur">
                                    <option value="" disabled selected>Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service['nom'] }}">{{ $service['nom'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Materiel: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="materiel">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Model: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="model">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Date d'acquisition: </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="date_acquisition">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Commentaire: </label>
                            <div class="col-sm-10">
                                <textarea name="commentaire" id="" class="form-control" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-5">
                    <div class="col-md-12 form-group">
                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                        <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                        <input type="text" name="date_intervention" value="{{ date('Y-m-d H:i:s') }}" hidden>
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
