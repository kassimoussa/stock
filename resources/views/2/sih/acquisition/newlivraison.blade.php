@extends('2.sih.layout', ['page' => 'Nouvelle Livraison', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row mt-3">
        <h3 class="fw-bold mt-3">FICHE DE LIVRAISON</h3>
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
            <form action="/acquisition/addlivraison" role="form" method="post" class="form">
                @csrf
                @method('PUT')

                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Departement</h4>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Intervenant</span>
                            <input type="text" class="form-control" name="nom_intervenant">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Demandeur</span>
                            <input type="text" class="form-control" name="nom_demandeur" value="{{ $acquisition->nom_demandeur }}" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Direction</span>
                            <input type="text" class="form-control" name="direction" value="{{ $acquisition->dir_demandeur }}" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Service</span>
                            <input type="text" class="form-control" name="service" value="{{ $acquisition->service_demandeur }}" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Date de livraison</span>
                            <input type="date" class="form-control" name="date_livraison" id="">
                        </div>
                    </div>
                </div>

                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Materiels</h4>
                    <div class="card-body">
                        <div class="field_wrapper col mb-2">
                            <div class="input-group">
                                <div class="input-group mb-3">
                                    <span class="input-group-text txt fw-bold ">Materiel</span>
                                    <input type="text" class="form-control" name="nom_materiel" value="{{ $materiels->nom_mat }}" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text txt fw-bold ">Quantité</span>
                                    <input type="text" class="form-control" name="quantite" value="{{ $materiels->quantite }}" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text txt fw-bold ">Observation</span>
                                    <input type="text" class="form-control" name="observation" placeholder="Observation" >
                                </div>                                 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12 form-group">
                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                        <button type="reset" class="btn btn-outline-danger fw-bold">Annuler</button>
                        <input type="text" name="date_submit" value="{{ date('Y-m-d H:i:s') }}" hidden>
                        <input type="text" class="form-control" name="livraison_id" value="{{ time() }}" hidden>
                        <input type="text" class="form-control" name="fiche" value="acquisition" hidden>
                        <input type="text" class="form-control" name="numero_fiche" value="{{ $acquisition->id }}" hidden>
                        <input type="text" class="form-control" name="description_mat" value="{{ $acquisition->description_mat }}" hidden>
                        <input type="text" class="form-control" name="marque_mat" value="{{ $acquisition->marque_mat }}" hidden>
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
        .txt {
            width: 17%;
        }

    </style>
    <script>
        function addInput() {
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML =
                    "<div class='input-group'><a class='input-group-text icon remove_button' onclick='removeInput()'><i class='fa fa-minus' aria-hidden='true'></i></a><input type='text' class='form-control' name='nom_materiel[]' placeholder='Nom du Materiel' ><input type='number' class='form-control' name='quantite[]' placeholder='Quantité'  ><input type='text' class='form-control' name='observation[]' placeholder='Observation' ></div>"; //New input field html 
                var x = 1; //Initial field counter is 1

                //Once add button is clicked

                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }


                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        }
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
