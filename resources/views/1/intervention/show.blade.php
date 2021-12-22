@extends('1.layout', ['page' => 'Fiche Intervention', 'pageSlug' => 'intervention'])
@section('content')
    <br>
    <div class="row mt-3">
        <h3 class="fw-bold mt-3">FICHE D'INTERVENTION</h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="card  mb-3">
                    <h4 class="card-header text-center">Technicien</h4>
                    <div class="card-body">
                        <div class="form-group control-label">
                            <label class="control-label">Nom Intervenant <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nom_intervenant"
                                value="{{ $intervention->nom_intervenant }}" readonly>
                        </div>
                        <div class="form-group control-label">
                            <label class="control-label">Diagnostique <span class="text-danger">*</span></label>
                            <textarea name="diagnostique" id="" class="form-control" cols="30" rows="2"
                                readonly>{{ $intervention->diagnostique }}</textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="card mb-3">
                    <h4 class="card-header text-center">Informations </h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card ">
                                    <h4 class="card-header ch2 text-center">Sur le materiel</h4>
                                    <div class="card-body">
                                        <div class="form-group control-label">
                                            <label class="control-label">Materiel <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="materiel"
                                                value="{{ $intervention->materiel }}" readonly>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Model <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="model"
                                                value="{{ $intervention->model }}" readonly>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Réf patrimoine <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="ref_patrimoine"
                                                value="{{ $intervention->ref_patrimoine }}" readonly>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Date d'acquisition </label>
                                            <input type="text" class="form-control" name="date_acquisition"
                                                value="{{ date('d/m/Y', strtotime($intervention->date_acquisition)) }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card ">
                                    <h4 class="card-header ch2 text-center">Sur le demandeur</h4>
                                    <div class="card-body">
                                        <div class="form-group control-label">
                                            <label class="control-label">Propriétaire <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom_demandeur"
                                                value="{{ $intervention->nom_demandeur }}" readonly>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Direction ou Département <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="dir_demandeur"
                                                value="{{ $intervention->dir_demandeur }}" readonly>
                                        </div>
                                        <div class="form-group control-label">
                                            <label class="control-label">Centre ou Service <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="service_demandeur"
                                                value="{{ $intervention->service_demandeur }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($intervention->status_direction != null)
            <div class="col-lg-12">
                <div class="card  mb-3">
                    <h4 class="card-header text-center">Demandeur</h4>
                    <div class="card-body">
                        @php
                            $approuve = $attente = $rejete = $sugg = $button = ' ';
                            
                            if ($intervention->status_direction== 'approuve') {
                                $approuve = 'checked';
                                $button = 'hidden';
                                $attente = $rejete = $sugg = ' disabled ';
                            } elseif ($intervention->status_direction == 'attente') {
                                $attente = 'checked'; $approuve = $rejete =  ' disabled ' ;
                            } elseif ($intervention->status_direction == 'rejete') {
                                $rejete = 'checked'; $approuve = $attente =  ' disabled '; 
                            }
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_direction" id="Approuver" value="approuve" {{ $approuve }}>
                                <label class="form-check-label" for="Approuver">Approuver</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_direction" id="attente" value="attente" {{ $attente }}>
                                <label class="form-check-label" for="attente">En attente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_direction" id="rejete" value="rejete" {{ $rejete }}>
                                <label class="form-check-label" for="rejete">Rejeter</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Commentaire</span>
                            <textarea name="commentaire" id="" class="form-control" cols="30" rows="2"
                                readonly>{{ $intervention->commentaire }}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Date</span>
                            <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_dir_approbation)) }} </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($intervention->status_service != null)
            <div class="col-lg-12">
                <div class="card  mb-3">
                    <h4 class="card-header text-center">SIH</h4>
                    <div class="card-body">
                        @php
                            $approuve = $attente = $rejete = $sugg = $button = ' ';
                            
                            if ($intervention->status_service== 'approuve') {
                                $approuve = 'checked';
                                $button = 'hidden';
                                $attente = $rejete = $sugg = ' disabled ';
                            } elseif ($intervention->status_service == 'attente') {
                                $attente = 'checked'; $approuve = $rejete =  ' disabled ' ;
                            } elseif ($intervention->status_service == 'rejete') {
                                $rejete = 'checked';  $approuve = $attente =  ' disabled ' ;
                            }
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_service" id="Approuver" value="approuve" {{ $approuve }}>
                                <label class="form-check-label" for="Approuver">Approuver</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_service" id="attente" value="attente" {{ $attente }}>
                                <label class="form-check-label" for="attente">En attente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_service" id="rejete" value="rejete" {{ $rejete }}>
                                <label class="form-check-label" for="rejete">Rejeter</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Suggestion</span>
                            <textarea name="suggestion" id="" class="form-control" cols="30" rows="2"
                                readonly>{{ $intervention->suggestion }}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Date</span>
                            <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_ser_approbation)) }} </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($intervention->status_division != null)
            <div class="col-lg-12">
                <div class="card  mb-3">
                    <h4 class="card-header text-center">DIN</h4>
                    <div class="card-body">
                        @php
                            $approuve = $attente = $rejete = $sugg = $button = ' ';
                            
                            if ($intervention->status_division== 'approuve') {
                                $approuve = 'checked';
                                $button = 'hidden';
                                $attente = $rejete = $sugg = ' disabled ';
                            } elseif ($intervention->status_division == 'attente') {
                                $attente = 'checked'; /* $approuve = $rejete =  ' disabled ' */
                            } elseif ($intervention->status_division == 'rejete') {
                                $rejete = 'checked'; /* $approuve = $attente =  ' disabled ' */
                            }
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_division" id="Approuver" value="approuve" {{ $approuve }}>
                                <label class="form-check-label" for="Approuver">Approuver</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_division" id="attente" value="attente" {{ $attente }}>
                                <label class="form-check-label" for="attente">En attente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_division" id="rejete" value="rejete" {{ $rejete }}>
                                <label class="form-check-label" for="rejete">Rejeter</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Avis</span>
                            <textarea name="suggestion" id="" class="form-control" cols="30" rows="2"
                                readonly>{{ $intervention->avis }}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Date</span>
                            <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_div_approbation)) }} </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
    <style>
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
@endsection
