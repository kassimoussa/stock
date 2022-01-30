@extends('2.sih.layout', ['page' => 'Nouvelle Acquisition', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row mt-3">
        <h3 class="fw-bold mt-3">FICHE D'ACQUISITION</h3>
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
            <form action="addacquisition" role="form" method="post" class="form" enctype="multipart/form-data">
                @csrf

                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Demandeur</h4>
                    <div class="card-body">
                        <div class="mb-1 row"  >
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Nom</span>
                                <input type="text" class="form-control" name="nom_demandeur">
                            </div>
                        </div> 
                        <div class="mb-1 row"  >
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Service</span>
                                <select class="form-select js-select2" name="service_demandeur" id="services">
                                    <option value="" disabled selected>Select service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service['nom'] }}">{{ $service['nom'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Materiel et Description
                    </h4>
                    <div class="card-body">
                        <div class="after-add-more ">
                            <div class="col mb-2 d-flex justify-content-between">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nom_mat" id="pcb" value="PC Bureau">
                                    <label class="form-check-label" for="pcb">PC Bureau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nom_mat" id="pcp"
                                        value="PC Portable">
                                    <label class="form-check-label" for="pcp">PC Portable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nom_mat" id="ai"
                                        value="Accessoires informatiques">
                                    <label class="form-check-label" for="ai">Accessoires informatiques</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nom_mat" id="imp" value="Imprimante">
                                    <label class="form-check-label" for="imp">Imprimante</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nom_mat" id="fax" value="Fax">
                                    <label class="form-check-label" for="fax">Fax</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nom_mat" id="log" value="Logiciel">
                                    <label class="form-check-label" for="log">Logiciel</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="nom_mat" id="autre">
                                    <label class="form-check-label" for="autre">Autre</label>
                                </div>
                            </div>
                            
                            <div class="mb-1 mt-2 row" id="quant" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">Quantité</span>
                                    <input type="text" class="form-control" id="quantite" name="quantite">
                                </div>
                            </div>

                            <div class="mb-1 mt-2 row" id="inputautre" style="display:none"> 
                            <div class="input-group ">
                                <span class="input-group-text txt fw-bold ">Nom</span>
                                <input type="text" class="form-control" name="nom_mat"
                                        placeholder="Taper le nom du materiel" id="nom_mat_input" disabled>
                            </div> 
                            </div>
                            <div class="mb-1 row" id="desc" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">Description</span>
                                    <input type="text" class="form-control" name="description_mat"  > 
                                </div>  
                            </div>
                            <div class="mb-1 row" id="marque" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">Marque</span>
                                    <input type="text" class="form-control" id="marque_mat" name="marque_mat">
                                </div>  
                            </div>
                            <div class="mb-1 row" id="model" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">Model</span>
                                    <input type="text" class="form-control" id="model_mat" name="model_mat">
                                </div>  
                            </div>
                            <div class="mb-1 row" id="processeur" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">Processeur</span>
                                    <input type="text" class="form-control" id="processeur_mat" name="processeur_mat">
                                </div>  
                            </div>
                            <div class="mb-1 row" id="ram" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">Mémoire</span>
                                    <input type="text" class="form-control" id="ram_mat" name="ram_mat">
                                </div>  
                            </div>
                            <div class="mb-1 row" id="stockage" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">Stockage</span>
                                    <input type="text" class="form-control" id="stockage_mat" name="stockage_mat">
                                </div>  
                            </div>
                            <div class="mb-1 row" id="os" style="display:none">
                                <div class="input-group ">
                                    <span class="input-group-text txt fw-bold ">S.E</span>
                                    <input type="text" class="form-control" id="os_mat" name="os_mat">
                                </div>  
                            </div>

                            <div class="p-3">
                                <div class="card  mb-3">
                                  <h4 class="card-header bg-dark text-center">Devis</h4>
                                  <div class="card-body">
                                      <div class="input-group mb-3">
                                          <span class="input-group-text txt fw-bold ">Fournisseur</span>
                                          <input type="text" class="form-control" name="fournisseur">
                                      </div>
                                      <div class="input-group mb-3">
                                          <span class="input-group-text txt fw-bold ">N° de devis</span>
                                          <input type="text" class="form-control" name="numero_devis">
                                      </div>
                                      <div class="mb-3">
                                          <input class="form-control" type="file" name="file" id="formFile">
                                        </div>
                                  </div>
                              </div>  
                              </div>
                        </div> 
                        <div class="row mt-3 mb-3">
                    <div class="col-md-12 form-group text-center">
                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                        <button type="reset" class="btn btn-outline-danger fw-bold">Annuler</button>
                        <input type="text" name="date_submit" value="{{ date('Y-m-d H:i:s') }}" hidden>
                        <input type="text" class="form-control" name="id" value="{{ time() }}" hidden>
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
        .input-group-text {
            width: 133px;
        }

    </style>
    <script>
        var pc = <?php echo $pc ?>;
        console.log(pc.id);
        $(function() {
            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == "autre") {
                    $("#nom_mat_input").removeAttr('disabled');
                    $("#quant").show();
                    $("#desc").show();
                    $("#inputautre").show();
                    $("#marque").show();document.getElementById('marque_mat').value = " ";
                    $("#model").show();document.getElementById('model_mat').value = " ";
                    $("#processeur").hide();
                    $("#ram").hide();
                    $("#stockage").hide();
                    $("#os").hide();
                }
                if (($(this).attr('id') == "pcp") || ($(this).attr('id') == "pcb")) {
                    $("#nom_mat_input").prop('disabled', true);
                    $("#quant").show();
                    $("#marque").show(); document.getElementById('marque_mat').value = pc.marque_mat;
                    $("#model").show();document.getElementById('model_mat').value = pc.model_mat;
                    $("#processeur").show();document.getElementById('processeur_mat').value = pc.processeur_mat;
                    $("#ram").show();document.getElementById('ram_mat').value = pc.ram_mat;
                    $("#stockage").show();document.getElementById('stockage_mat').value = pc.stockage_mat;
                    $("#os").show();document.getElementById('os_mat').value = pc.os_mat;
                    $("#inputautre").hide();
                    $("#desc").hide();
                }
                if (($(this).attr('id') == "ai") || ($(this).attr('id') == "imp") || ($(this).attr('id') ==
                        "fax") || ($(this).attr('id') == "log")) {
                    $("#nom_mat_input").prop('disabled', true);
                    $("#quant").show();
                    $("#desc").show();
                    $("#marque").show();document.getElementById('marque_mat').value = " ";
                    $("#model").show();document.getElementById('model_mat').value = " ";
                    $("#processeur").hide();
                    $("#ram").hide();
                    $("#stockage").hide();
                    $("#os").hide();
                    $("#inputautre").hide();
                }

            });
        });
    </script>
     
@endsection
