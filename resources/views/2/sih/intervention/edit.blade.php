@extends('2.sih.layout', ['page' => 'Nouvelle Intervention', 'pageSlug' => 'intervention'])
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
            <div class="alert alert-success alert-dismissible fade show " role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($message = Session::get('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <form action="{{ url('/intervention/editfiche', $intervention) }}" role="form" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="card col mb-3">
                    <h4 class="card-header text-center">Technicien</h4>
                    <div class="card-body">
                        <div class="input-group mb-2">
                            <span class="input-group-text txt fw-bold ">Nom</span> 
                            <input type="text" class="form-control" name="nom_intervenant"
                                value="{{ $intervention->nom_intervenant }}" required> 
                        </div>
                        <div class="input-group ">
                            <span class="input-group-text txt fw-bold ">Diagnostique</span>  
                            <textarea name="diagnostique" id="" class="form-control" cols="30" rows="2"
                                required> {{ $intervention->diagnostique }}</textarea> 
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
                                        <div class="form-group control-label mb-1">
                                            <label class="control-label">Libellé </label>
                                            <input type="text" class="form-control" name="materiel"
                                                value="{{ $intervention->materiel }}" required>
                                        </div>
                                        <div class="form-group control-label mb-1">
                                            <label class="control-label">Model  </label>
                                            <input type="text" class="form-control" name="model"
                                                value="{{ $intervention->model }}" required>
                                        </div>
                                        <div class="form-group control-label mb-1">
                                            <label class="control-label">Réf patrimoine  </label>
                                            <input type="text" class="form-control" name="ref_patrimoine"
                                                value="{{ $intervention->ref_patrimoine }}" required>
                                        </div>
                                        <div class="form-group control-label mb-1">
                                            <label class="control-label">Date d'acquisition </label>
                                            <input type="date" class="form-control" name="date_acquisition"
                                                value="{{  date('Y-m-d', strtotime($intervention->date_acquisition))  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card ">
                                    <h4 class="card-header ch2 text-center">Sur le demandeur</h4>
                                    <div class="card-body">
                                        <div class="form-group control-label mb-1">
                                            <label class="control-label">Nom  </label>
                                            <input type="text" class="form-control" name="nom_demandeur"
                                                value="{{ $intervention->nom_intervenant }}" required>
                                        </div>
                                        <div class="form-group control-label mb-1">
                                            <label class="control-label">Direction ou Département  </label>
                                            <select class="form-select js-select2" name="dir_demandeur" id="direction">
                                                @foreach ($directions as $direction)
                                                    @if ($direction['sigle'] == old('document') or $direction['sigle'] == $intervention->dir_demandeur)
                                                        <option value="{{ $direction['sigle'] }}" selected>
                                                            {{ $direction['nom'] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $direction['sigle'] }}">
                                                            {{ $direction['nom'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group control-label mb-1">
                                            <label class="control-label">Centre ou Service  </label>
                                            <select name="service_demandeur" id="serv" class="form-select js-select2">
                                                <option value="{{ $intervention->service_demandeur }}">
                                                    {{ $intervention->service_demandeur }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="text-align: center; margin-top: 2%;">
                            <div class="col-md-12 form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifier</button>
                                <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                                <input type="text" name="date_intervention"
                                    value="{{ $intervention->date_intervention }}" hidden>
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
        .input-group-text {
            width: 13%;
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
