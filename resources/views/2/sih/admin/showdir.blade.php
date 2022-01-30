@php
use App\Models\Service;
@endphp
@extends('2.sih.layout', ['page' => 'Direction', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
    <div class="container ">
        <div class="d-flex justify-content-between mb-5">
            <h3 class="fw-bold">{{ $direction->nom }}</h3>
            <a href="/admin/showdirections" class="btn btn-primary  fw-bold"> <i class="fas fa-arrow-left"></i>
                RETOURNER</a>
        </div>

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


        <div class="card mb-4 ccal ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="#description" role="tab" aria-controls="description"
                            aria-selected="true">Les services de la direction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#history" role="tab" aria-controls="history"
                            aria-selected="false">Catalogue PC</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="description" role="tabpanel">
                        <div class="d-flex justify-content-end mb-2 mt-0">
                            <a href="#" onclick="myFunction()" id="editbtn" class="btn" data-bs-toggle="modal"
                                data-bs-target="#newservice" title="Ajouter un service ">
                                <i class="fas fa-plus" data-bs-toggle="tooltip" data-bs-placement="top"></i>
                            </a>
                        </div>

                        <div class=" ">
                            <table class="table   border-dark table-sm table-hover " id="">
                                <thead class="table-dark text-primary  ">
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                </thead>
                                <tbody class=" text-center">
                                    @php
                                        $cnt = 1;
                                        $services = Service::where('direction', $direction->sigle)->get();
                                    @endphp
                                    @foreach ($services as $key => $service)

                                        <tr>
                                            <td>{{ $cnt }}</td>
                                            <td>{{ $service->nom }}</td>
                                        </tr>
                                        @php
                                            $cnt = $cnt + 1;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="newservice" tabindex="-1" aria-labelledby="voirtoutrTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h3>Ajouter un service </h3>
                                    <button type="button" class="btn btn-primary fw-bold"
                                        data-bs-dismiss="modal">Fermer</button>
                                </div>
                                <div class="modal-body">
                                    <form action="/admin/addservice" role="form" method="post" class="form">
                                        @csrf
                                        <div class="card col-md-12 mb-3">
                                            <h4 class="card-header text-center">Nouveau service</h4>
                                            <div class="modal-body">
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3 ">
                                                            <span class="input-group-text txt fw-bold ">Nom </span>
                                                            <input type="text" class="form-control" name="nom"
                                                                placeholder="Nom du service " required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text txt fw-bold ">Direction</span>
                                                            <input type="text" class="form-control" name="direction"
                                                                placeholder="Direction " value="{{ $direction->sigle }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="text-align: center; margin-top: 2%;">
                                                        <div class=" form-group">
                                                            <button type="submit" name="submit"
                                                                class="btn btn-primary fw-bold">Ajouter</button>
                                                            <button type="reset"
                                                                class="btn btn-outline-danger  fw-bold">Annuler</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <div class="d-flex justify-content-end mb-2">
                            <button type="button" onclick="myFunction()" name="add_devis"
                                class="btn btn-dark fw-bold">Modifier</button>
                        </div>
                        <div>
                            <div class="col mb-2">
                                <form action=" " role="form" method="post" class="form">
                                    @method('PUT')
                                    @csrf
                                    <div class="row mb-2">


                                        <div class="col-md-6">
                                            <div class="input-group mb-3 ">
                                                <span class="input-group-text txt fw-bold ">Marque</span>
                                                <input type="text" id="marque_mat" class="form-control iput"
                                                    name="marque_mat" placeholder="Nom" value="{{ $pc->marque_mat }}"
                                                    disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3 ">
                                                <span class="input-group-text txt fw-bold ">Model</span>
                                                <input type="text" id="model_mat" class="form-control iput" name="model_mat"
                                                    placeholder="frequence" value="{{ $pc->model_mat }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3 ">
                                                <span class="input-group-text txt fw-bold ">Processeur</span>
                                                <input type="text" id="processeur_mat" class="form-control iput"
                                                    name="processeur_mat" placeholder="latitude "
                                                    value="{{ $pc->processeur_mat }}" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3 ">
                                                <span class="input-group-text txt fw-bold ">Mémoire (ram)</span>
                                                <input type="text" id="ram_mat" class="form-control iput" name="ram_mat"
                                                    placeholder="longitude" value="{{ $pc->ram_mat }}" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3 ">
                                                <span class="input-group-text txt fw-bold ">Stockage</span>
                                                <input type="text" id="stockage_mat" class="form-control iput"
                                                    name="stockage_mat" placeholder="longitude"
                                                    value="{{ $pc->stockage_mat }}" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3 ">
                                                <span class="input-group-text txt fw-bold ">OS</span>
                                                <input type="text" id="os_mat" class="form-control iput" name="os_mat"
                                                    placeholder="longitude" value="{{ $pc->os_mat }}" disabled required>
                                            </div>
                                        </div>
                                        <div class="row"
                                            style="text-align: center; margin-top: 2%; display: none;" id="sbmbtn">
                                            <div class=" form-group">
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary fw-bold">Modifier</button>
                                                <button type="reset" class="btn btn-outline-danger  fw-bold"
                                                    data-bs-dismiss="modal">Annuler</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        .txt {
            width: 150px;
            background: lavender;
        }

        .iput {
            background: white !important;
        }

        .cbox {}

    </style>
    <script>
        $('#bologna-list a').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
        });

        function myFunction() {
            var x = document.getElementById("sbmbtn");
            if (x.style.display === "none") {
                x.style.display = "block";
                $("#marque_mat").prop('disabled', false);
                $("#model_mat").prop('disabled', false);
                $("#processeur_mat").prop('disabled', false);
                $("#ram_mat").prop('disabled', false);
                $("#stockage_mat").prop('disabled', false);
                $("#os_mat").prop('disabled', false);

            } else {
                x.style.display = "none";
                $("#marque_mat").prop('disabled', true);
                $("#model_mat").prop('disabled', true);
                $("#processeur_mat").prop('disabled', true);
                $("#ram_mat").prop('disabled', true);
                $("#stockage_mat").prop('disabled', true);
                $("#os_mat").prop('disabled', true);

            }
        }
    </script>

@endsection
