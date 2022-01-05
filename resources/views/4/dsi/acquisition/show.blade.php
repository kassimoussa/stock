@php
use App\Models\Direction;
@endphp
@extends('4.dsi.layout', ['page' => 'Fiche Acquisition', 'pageSlug' => 'acquisition'])
@section('content')
    <br>
    <div class="container ">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="over-title ">FICHE D'ACQUISITION </h3>
            {{-- <a href="/acquisition" class="btn  btn-primary  fw-bold">RETOURNER</a> --}}
            @if ($acquisition->sign_rep_demandeur == 1 && $acquisition->sign_dir_dsi == 1)
                <a href="{{ url('/generate-pdf', $acquisition) }}"
                    class="btn  btn-primary  fw-bold text-white">IMPRIMER</a>
            @endif
        </div>

        <div class="card  mb-3">
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

        <div class="card  mb-3">
            <h4 class="card-header text-center">Materiel et Description
            </h4>
            <div class="card-body">
                <div class="col mb-2 d-flex justify-content-between">
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
                <div class="input-group mb-2" >
                    <span class="input-group-text fw-bold">Quantité</span>
                    <label class="form-control">{{ $acquisition->quantite }} </label>
                </div>
                <div class="input-group mb-2" {{ $nomdiv }}>
                    <span class="input-group-text fw-bold">Nom</span>
                    <label class="form-control">{{ $acquisition->nom_mat }} </label>
                </div>

                <div class="input-group mb-2" {{ $descdiv }}>
                    <span class="input-group-text fw-bold">Description</span>
                    <label class="form-control">{{ $acquisition->description_mat }} </label>
                </div>

                <div class="input-group mb-2">
                    <span class="input-group-text fw-bold">Marque</span>
                    <label class="form-control">{{ $acquisition->marque_mat }} </label>
                </div>

                <div class="input-group mb-2">
                    <span class="input-group-text fw-bold">Model</span>
                    <label class="form-control">{{ $acquisition->model_mat }} </label>
                </div>

                <div class="input-group mb-2" {{ $procediv }}>
                    <span class="input-group-text fw-bold">Processeur</span>
                    <label class="form-control">{{ $acquisition->processeur_mat }} </label>
                </div>

                <div class="input-group mb-2" {{ $ramdiv }}>
                    <span class="input-group-text fw-bold">Mémoire</span>
                    <label class="form-control">{{ $acquisition->ram_mat }} </label>
                </div>

                <div class="input-group mb-2" {{ $stockdiv }}>
                    <span class="input-group-text fw-bold">Stockage</span>
                    <label class="form-control">{{ $acquisition->stockage_mat }} </label>
                </div>

                <div class="input-group mb-2" {{ $sediv }}>
                    <span class="input-group-text fw-bold">S.E</span>
                    <label class="form-control">{{ $acquisition->os_mat }} </label>
                </div>
            </div>
            <div class="col">
                <div class="card ">
                    <h4 class="card-header bg-dark ch2 text-center">Devis</h4>
                    <div class="card-body">
                        <div class="col mb-2">
                            <table class="table   table-bordered" id="">
                                <thead class="table-dark ">
                                    <th scope="col">N° devis</th>
                                    <th scope="col">Fournisseur</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    @php
                                        $hidevis = '';
                                        if($acquisition->status_sih == 'approuve'){
                                            $hidevis = 'hidden';
                                        }
                                        @endphp
                                    @if (!empty($devis) && $devis->count())
                                        @php
                                            $cnt = 1;
                                            $modaln = 'vdir' . $cnt;
                                        @endphp
                                        @foreach ($devis as $key => $devi)

                                            <tr>
                                                <td>{{ $devi->numero_devis }}</td>
                                                <td>{{ $devi->fournisseur }}</td>
                                                <td class="td-actions ">
                                                    <a href="#" class="btn btn-transparent btn-xs" data-bs-toggle="modal"
                                                        data-bs-target="#{{ $modaln }}" >
                                                        <i class="fas fa-eye " data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Voir le devis"></i>
                                                    </a>
                                                    <a href="{{ url('/intervention/download', $devi) }}"
                                                        class="btn btn-transparent btn-xs" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Télécharger le devis">
                                                        <i class="fas fa-download "></i>
                                                    </a>
                                                    <form action="{{ url('/devis/delete', $devi) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button {{$hidevis}} type="button" class="btn btn-transparent btn-xs" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"  title="Supprimer le devis"
                                                            onclick="confirm('Etes vous sûr de supprimer le devis ?') ? this.parentElement.submit() : ''">
                                                            <i class="fas fa-trash "></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="{{ $modaln }}" tabindex="-1"
                                                aria-labelledby="voirtoutrTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn btn-primary fw-bold"
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
                                    @else
                                    <tr>
                                        <td colspan="10"><h3> Il n'y a pas de devis pour cette fiche.</h3></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button {{$hidevis}} type="button" name="add_devis" class="btn btn-dark fw-bold" data-bs-toggle="modal"
                        data-bs-target="#newdevis">Ajouter</button>

                        <div class="modal fade" id="newdevis" tabindex="-1"
                        aria-labelledby="voirtoutrTitle" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h3>Nouveau devis </h3>
                                    <button type="button" class="btn btn-primary fw-bold"
                                        data-bs-dismiss="modal">Fermer</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('adddevis')}}" role="form" method="post" class="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card col-md-12 mb-3">
                                            <h4 class="card-header text-center">Devis</h4>
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
                        
                                                <div class="row mb-3">
                                                    <div class="col-md-12 form-group ">
                                                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Ajouter</button>
                                                        <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                                                        <input type="text" name="fiche" value="acquisition" hidden>
                                                        <input type="text" name="numero_fiche" value="{{ $acquisition->id }}" hidden>
                                                    </div>
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
        </div>

        @php
            if ($acquisition->dir_demandeur == 'DSI') {
                $divdsi = 'hidden';
            } else {
                $divdsi = ' ';
            }
        @endphp

        <div class="card  mb-3" {{ $divdsi }}>
            <h4 class="card-header text-center">Visa {{ $acquisition->dir_demandeur }}</h4>
            <div class="card-body">
                @if ($acquisition->status_dir == 'approuve')
                    <div class="d-flex justify-content-between">
                        <div class="col-md-4 ">
                            <label class="">Date :
                                {{ date('d/m/Y', strtotime($acquisition->date_dir)) }} </label>
                        </div>

                        <div class="form-check col-md-4">
                            <span class="fw-bold">Le Directeur de la {{ $acquisition->dir_demandeur }} </span>
                            <input class="form-check-input" type="checkbox" value="true" checked disabled>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <h3 class="fw-bold"> Le Directeur de la {{ $acquisition->dir_demandeur }} n'a pas encore
                            approuvé la fiche d'acquisition </h3>
                    </div>
                @endif

            </div>
        </div>
        <div class="card  mb-3" style="width: 100%;">
            <h4 class="card-header text-center">Visa SIH</h4>
            <div class="card-body">
                @php
                    $approuve = $attente = $rejete = $sugg = $button = $date = ' ';
                    
                    if ($acquisition->status_sih == 'approuve') {
                        $approuve = 'checked';
                        $date = '';
                        $button = 'hidden';
                        $attente = $rejete = $sugg = ' disabled ';
                    } elseif ($acquisition->status_sih == 'attente') {
                        $attente = 'checked';
                        $attente = $approuve = ' disabled ';
                        $date = 'hidden';
                    } elseif ($acquisition->status_sih == 'rejete') {
                        $rejete = 'checked';
                        $approuve = $rejete = ' disabled ';
                        $date = 'hidden';
                    }
                @endphp
                <div class="col-md-12 mb-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_sih" id="Approuver" value="approuve"
                            {{ $approuve }}>
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
                <div {{ $date }}>
                    <div class="d-flex justify-content-between">
                        <div class=" ">
                            <label class="">Date :
                                {{ date('d/m/Y', strtotime($acquisition->date_sih)) }} </label>
                        </div>

                        <div class="form-check ">
                            <span class="fw-bold">Le Chef du SIH </span>
                            <input class="form-check-input" type="checkbox" value="true" checked disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card  mb-3">
            <h4 class="card-header text-center">Visa DSI</h4>
            <div class="card-body">
                @php
                    $approuve = $attente = $rejete = $sugg = $button = $date = ' ';
                    
                    if ($acquisition->status_dsi == 'approuve') {
                        $approuve = 'checked';
                        $date = '';
                        $button = 'hidden';
                        $attente = $rejete = $sugg = ' disabled ';
                    } elseif ($acquisition->status_dsi == 'attente') {
                        $attente = 'checked';
                        /* $attente = $approuve = ' disabled '; */
                        $date = 'hidden';
                    } elseif ($acquisition->status_dsi == 'rejete') {
                        $rejete = 'checked';
                        /* $approuve = $rejete = ' disabled '; */
                        $date = 'hidden';
                    }
                @endphp
                @if ($acquisition->status_dsi == null)

                    <form action="{{ url('/acquisition/dsivalide', $acquisition) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12 mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dsi" id="Approuver"
                                    value="approuve" {{ $approuve }}>
                                <label class="form-check-label" for="Approuver">Approuver</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dsi" id="attente" value="attente"
                                    {{ $attente }}>
                                <label class="form-check-label" for="attente">En attente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dsi" id="rejete" value="rejete"
                                    {{ $rejete }}>
                                <label class="form-check-label" for="rejete">Rejeter</label>
                            </div>
                        </div>
                        <div class="row" style=" margin-top: 2%;" {{ $button }}>
                            <div class="col-md-12 form-group ">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                                <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                                <input type="text" name="date_dsi" value="{{ date('Y-m-d H:i:s') }}" hidden>
                            </div>
                    </form>

                @else

                    <form action="{{ url('/acquisition/dsivalide', $acquisition) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12 mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dsi" id="Approuver"
                                    value="approuve" {{ $approuve }}>
                                <label class="form-check-label" for="Approuver">Approuver</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dsi" id="attente" value="attente"
                                    {{ $attente }}>
                                <label class="form-check-label" for="attente">En attente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_dsi" id="rejete" value="rejete"
                                    {{ $rejete }}>
                                <label class="form-check-label" for="rejete">Rejeter</label>
                            </div>
                        </div>
                        <div {{ $date }}>
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <label class="">Date :
                                        {{ date('d/m/Y', strtotime($acquisition->date_dsi)) }} </label>
                                </div>

                                <div class="form-check ">
                                    <span class="fw-bold">Le Directeur de la DSI </span>
                                    <input class="form-check-input" type="checkbox" value="true" checked disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row" style=" margin-top: 2%;" {{ $button }}>
                            <div class="col-md-12 form-group ">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                                <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                                <input type="text" name="date_dsi" value="{{ date('Y-m-d H:i:s') }}" hidden>
                            </div>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
    <style>
        .card-header {
            background: #4F81BD;
            color: white;
        }

        .input-group-text {
            width: 13%;
        }

    </style>
@endsection
