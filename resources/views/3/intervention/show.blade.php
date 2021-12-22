@extends('3.layout', ['page' => 'Fiche Intervention', 'pageSlug' => 'intervention'])
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
                            <div class="col-lg-6">
                                <div class="card ">
                                    <h4 class="card-header ch2 text-center">Devis</h4>
                                    <div class="card-body">
                                        <div class="col mb-2">
                                            @if (!empty($devis) && $devis->count())
                                            <table class="table tablesorter  table-bordered" id="">
                                                <thead class="table-dark ">
                                                    <th scope="col">N° devis</th>
                                                    <th scope="col">Fournisseur</th>
                                                    <th scope="col">Actions</th>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $cnt = 1;
                                                        $modaln = 'vdir' . $cnt;
                                                    @endphp
                                                    @foreach ($devis as $key => $devi)

                                                        <tr>
                                                            <td>{{ $devi->numero_devis }}</td>
                                                            <td>{{ $devi->fournisseur }}</td>
                                                            <td class="td-actions ">
                                                                <a href="#" class="btn btn-link" data-bs-toggle="modal"
                                                                    data-bs-target="#{{ $modaln }}">
                                                                    <i class="fas fa-eye" data-bs-toggle="tooltip"
                                                                        data-bs-placement="left"
                                                                        title="Voir le devis"></i>
                                                                </a>
                                                                <a href="{{ url('/intervention/download', $devi) }}"
                                                                    class="btn btn-link" data-bs-toggle="tooltip"
                                                                    data-bs-placement="bottom" title="Télécharger le devis">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="{{ $modaln }}" tabindex="-1"
                                                            aria-labelledby="voirtoutrTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button"
                                                                            class="btn btn-primary fw-bold"
                                                                            data-bs-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <iframe height="900px" width="1000px"
                                                                            src="{{ asset($devi->path) }}"
                                                                            frameborder="0"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $cnt = $cnt + 1;
                                                            $modaln = 'vdir' . $cnt;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <div class="alert alert-dark">
                                                <h3 class="fw-bold"> Il n'y a pas de devis pour cette fiche  </h3>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card  mb-3">
                    <h4 class="card-header text-center">SIH</h4>
                    <div class="card-body">
                        @php
                            $approuve = $attente = $rejete = $comm = $button = ' ';
                            
                            if ($intervention->status_sih == 'approuve') {
                                $approuve = 'checked';
                                $button = 'hidden';
                                $attente = $rejete = ' disabled ';
                                $comm = ' readonly';
                            } elseif ($intervention->status_sih == 'attente') {
                                $attente = 'checked';
                                $approuve = $rejete = ' disabled ';
                            } elseif ($intervention->status_sih == 'rejete') {
                                $rejete = 'checked';
                                $approuve = $attente = ' disabled ';
                            }
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check form-check-inline text-center">
                                <input class="form-check-input" type="radio" name="status_sih" id="Approuver"
                                    value="approuve" {{ $approuve }}>
                                <label class="form-check-label" for="Approuver">Approuver</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_sih" id="attente" value="attente"
                                    {{ $attente }}>
                                <label class="form-check-label" for="attente">En attente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_sih" id="rejete" value="rejete"
                                    {{ $rejete }}>
                                <label class="form-check-label" for="rejete">Rejeter</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Suggestion</span>
                            <textarea name="suggestion" id="" class="form-control" cols="30" rows="2"
                                {{ $comm }}>{{ $intervention->suggestion }}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Date</span>
                            <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_sih)) }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card  mb-3">
                    <h4 class="card-header text-center">Direction Demandeuse</h4>
                    <div class="card-body">
                        @php
                            $approuve = $attente = $rejete = $button = ' ';
                            
                            if ($intervention->status_dir == 'approuve') {
                                $approuve = 'checked';
                                $attente = $rejete = ' disabled ';
                            } elseif ($intervention->status_dir == 'attente') {
                                $attente = 'checked';
                                $approuve = $rejete = ' disabled ';
                            } elseif ($intervention->status_dir == 'rejete') {
                                $rejete = 'checked';
                                $approuve = $attente = ' disabled ';
                            }
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check form-check-inline text-center">
                                <input class="form-check-input" type="radio" name="status_dir" id="Approuver"
                                    value="approuve" {{ $approuve }}>
                                <label class="form-check-label" for="Approuver">Approuver</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dir" id="attente" value="attente"
                                    {{ $attente }}>
                                <label class="form-check-label" for="attente">En attente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dir" id="rejete" value="rejete"
                                    {{ $rejete }}>
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
                            <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_dir)) }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card  mb-3">
                    <h4 class="card-header text-center">DIN</h4>
                    <div class="card-body">
                        @php
                            $approuve = $attente = $rejete = $avis = $button = $date = ' ';
                            
                            if ($intervention->status_din == 'approuve') {
                                $approuve = 'checked';
                                $button = 'hidden';
                                $attente = $rejete = $avis = ' disabled ';
                            } elseif ($intervention->status_din == 'attente') {
                                $date = 'hidden ';
                                $attente = 'checked'; /* $approuve = $rejete =  ' disabled ' */
                            } elseif ($intervention->status_din == 'rejete') {
                                $date = 'hidden ';
                                $rejete = 'checked'; /* $approuve = $attente =  ' disabled ' */
                            }
                        @endphp
                        @if ($intervention->status_din == null)
                            <form action="{{ url('/intervention/dinvalide', $intervention) }}" role="form" method="post"
                                class="form">
                                @csrf
                                @method("PUT")
                                <div class="col-md-12 ">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input" type="radio" name="status_din" id="Approuver"
                                            value="approuve" {{ $approuve }}>
                                        <label class="form-check-label" for="Approuver">Approuver</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_din" id="attente"
                                            value="attente" {{ $attente }}>
                                        <label class="form-check-label" for="attente">En attente</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_din" id="rejete"
                                            value="rejete" {{ $rejete }}>
                                        <label class="form-check-label" for="rejete">Rejeter</label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text fw-bold">Avis</span>
                                    <textarea name="avis" id="" class="form-control" cols="30"
                                        rows="2">{{ $intervention->avis }}</textarea>
                                </div>
                                <div class="row" style="text-align: center; margin-top: 2%;">
                                    <div class="col-md-12 form-group ">
                                        <button type="submit" name="submit"
                                            class="btn btn-primary fw-bold">Soumettre</button>
                                        <button type="reset" class="btn btn-default fw-bold">Annuler</button>
                                        <input type="text" name="date_din" value="{{ date('Y-m-d H:i:s') }}" hidden>
                                    </div>
                                </div>
                            @else
                                <form action="{{ url('/intervention/dinvalide', $intervention) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-12">
                                        <div class="form-check form-check-inline text-center">
                                            <input class="form-check-input" type="radio" name="status_din" id="Approuver"
                                                value="approuve" {{ $approuve }}>
                                            <label class="form-check-label" for="Approuver">Approuver</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_din" id="attente"
                                                value="attente" {{ $attente }}>
                                            <label class="form-check-label" for="attente">En attente</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_din" id="rejete"
                                                value="rejete" {{ $rejete }}>
                                            <label class="form-check-label" for="rejete">Rejeter</label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fw-bold">Avis</span>
                                        <textarea name="avis" id="" class="form-control" cols="30"
                                            rows="2">{{ $intervention->avis }}</textarea>
                                    </div>
                                    <div {{ $date }}>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fw-bold">Date</span>
                                            <label
                                                class="form-control">{{ date('d/m/Y', strtotime($intervention->date_din)) }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row" style=" margin-top: 2%;" {{ $button }}>
                                        <div class="col-md-12 form-group ">
                                            <button type="submit" name="submit"
                                                class="btn btn-primary fw-bold">Soumettre</button>
                                            <button type="reset" class="btn btn-default fw-bold">Annuler</button>
                                            <input type="text" name="date_din" value="{{ date('Y-m-d H:i:s') }}" hidden>
                                        </div>
                                    </div>
                                </form>
                        @endif
                    </div>
                </div>
            </div>



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
