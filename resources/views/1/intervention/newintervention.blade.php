@extends('1.layout', ['page' => 'Nouvelle Intervention', 'pageSlug' => 'intervention'])
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
                        <div class="form-group control-label">
                            <label class="control-label">Nom Intervenant <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nom_intervenant" required>
                        </div>
                        <div class="form-group control-label">
                            <label class="control-label">Diagnostique <span class="text-danger">*</span></label>
                            <textarea name="diagnostique" id="" class="form-control" cols="30" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card col mb-3">
                    <h4 class="card-header text-center">Informations </h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card ">
                                    <h4 class="card-header ch2 text-center">Sur le materiel</h4>
                                    <div class="card-body">
                                        <div class="form-group control-label">
                                            <label class="control-label">Materiel <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="materiel" required>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Model <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="model" required>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Réf patrimoine <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="ref_patrimoine" required>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Date d'acquisition </label>
                                            <input type="date" class="form-control" name="date_acquisition">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card ">
                                    <h4 class="card-header ch2 text-center">Sur le demandeur</h4>
                                    <div class="card-body">
                                        <div class="form-group control-label">
                                            <label class="control-label">Propriétaire <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom_demandeur" required>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Direction ou Département <span class="text-danger">
                                                    *</span></label>
                                            <select class="form-select js-select2" name="dir_demandeur" id="direction" required>
                                                <option value="" disabled selected>Select Direction</option>
                                                @foreach ($directions as $direction)
                                                    <option value="{{ $direction['sigle'] }}">{{ $direction['nom'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Centre ou Service <span
                                                    class="text-danger">*</span></label>
                                            <select name="service_demandeur" id="serv" class="form-select js-select2"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="text-align: center; margin-top: 2%;">
                            <div class="col-md-12 form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                                <button type="reset" class="btn btn-default fw-bold">Annuler</button>
                                <input type="text" name="date_intervention" value="{{ date('Y-m-d H:i:s') }}" hidden>
                            </div>
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

        .ch2 {
            background: #12151A;
            color: white;
        }

    </style>

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
