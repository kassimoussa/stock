@php
use App\Models\Livraison;
@endphp
@extends('2.sih.layout', ['page' => 'Fiches d\'Acquisitions', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Fiches d'acquisiton </h3>
            <a href="/acquisition/newacquis" class="btn  btn-primary  fw-bold">Nouvelle Acquisition</a>
        </div>

        <div class="d-flex justify-content-start mb-2">
            <form action="" class="col-md-6">
                <div class="input-group  mb-3">
                    <button class="btn btn-dark" type="submit">Chercher</button>
                    <input type="text" class="form-control " name="search"
                        placeholder="Par numero de fiche, direction, service ou materiel" value="{{ $search }}">
                </div>
            </form>
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

        <div id="div1">
            <table class="table   border-dark table-sm table-hover " id="">
                <thead class="table-dark text-primary text- ">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Service</th>
                    <th scope="col">Materiel</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Date</th>
                    <th scope="col" colspan="2" class="text-center">Status</th>
                    <th scope="col">Réçu</th>
                    <th scope="col">Livré</th>
                    <th scope="col" colspan="4">Actions</th>
                </thead>
                <tbody>
                    @if (!empty($acquisitions) && $acquisitions->count())
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach ($acquisitions as $key => $acquisition)
                            @php
                                $status_sih = '';
                                $status_dsi = '';
                                $status_sih_txt = '';
                                $status_dsi_txt = '';
                                $btnedit = '';
                                $titre = '';
                                $icon = '';
                                $btnshow = 'hidden';
                                $btnlivre = 'hidden';
                                $btnrecu = 'hidden';
                                $btnrecuoutline = $btnrecutitle = $btnrecuclick = '';
                                $btnlivrecolor = $btnlivretitle = $btnlivreclick = $btnlivretxt = '';
                                $btnrecushow = $btnlivreshow = $btnlivraison = 'hidden';
                                
                                if ($acquisition->status_sih == 'approuve') {
                                    $status_sih = 'bg-success '; /* $btnedit = 'hidden'; */
                                    $status_sih_txt = 'Acquisition approuvée par le SIH';
                                } elseif ($acquisition->status_sih == 'attente') {
                                    $status_sih = 'bg-warning ';
                                    $status_sih_txt = 'Acquisition mise en attente par le SIH';
                                } elseif ($acquisition->status_sih == 'rejete') {
                                    $status_sih = 'bg-danger ';
                                    $status_sih_txt = 'Acquisition rejetée par le SIH';
                                } elseif ($acquisition->status_sih == null) {
                                    $status_sih = 'bg-white ';
                                    $status_sih_txt = 'Acquisition pas encore vu par le SIH';
                                }
                                
                                if ($acquisition->status_dsi == 'approuve') {
                                    $status_dsi = 'bg-success ';
                                    $status_dsi_txt = 'Acquisition approuvée par la DSI';
                                    $btnedit = 'disabled';
                                    $btnshow = $btnrecushow = '';
                                    if ($acquisition->recu == 'non') {
                                        $btnrecuoutline = 'btn btn-outline-danger';
                                        $btnrecutitle = 'NON';
                                    } else {
                                        $btnrecutitle = 'OUI';
                                        $btnrecuoutline = 'btn btn-success';
                                        $btnrecuclick = '';
                                        $btnlivraison = '';
                                        if ($acquisition->livre == 'non') {
                                            $btnlivrecolor = 'bg-danger text-white';
                                            $btnlivretitle = 'NON';
                                            $btnlivretxt = "Les matériels acquis n'ont pas encore été livré";
            } else {
                $btnlivrecolor = 'bg-success ';
                $btnlivretitle = 'OUI';
                $btnlivretxt = 'Les matériels acquis ont été livré';
                $btnlivre = '';
            }
        }
    } elseif ($acquisition->status_dsi == 'attente') {
        $status_dsi = 'bg-warning ';
        $status_dsi_txt = 'Acquisition mise en attente par la DSI';
    } elseif ($acquisition->status_dsi == 'rejete') {
        $status_dsi = 'bg-danger ';
        $status_dsi_txt = 'Acquisition rejetée par la DSI';
    } elseif ($acquisition->status_dsi == null) {
        $status_dsi = 'bg-white ';
        $status_dsi_txt = 'Acquisition pas encore vu par la DSI';
                                }
                                
                            @endphp
                            <tr>
                                <td>{{ $acquisition->id }}</td>
                                <td>{{ $acquisition->dir_demandeur }}</td>
                                <td>{{ $acquisition->service_demandeur }}</td>
                                <td>{{ $acquisition->nom_mat }}</td>
                                <td>{{ $acquisition->quantite }}</td>
                                <td>{{ date('d/m/Y', strtotime($acquisition->date_submit)) }}</td>
                                <td class="{{ $status_sih }} " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ $status_sih_txt }}">SIH</td>
                                <td class="{{ $status_dsi }} " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ $status_dsi_txt }}">DSI</td>
                                <td>
                                    <form action="{{ url('/acquisition/recu', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="button" class="{{ $btnrecuoutline }}"
                                            style="display:block;width:100%;" {{ $btnrecushow }} {{ $btnrecuclick }}
                                            onclick="confirm('Clique sur oui si vous avez réçu le materiel ?') ? this.parentElement.submit() : ''">
                                            {{ $btnrecutitle }}
                                        </button>
                                    </form>
                                </td>
                                <td class="{{ $btnlivrecolor }} text-center align-middle" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ $btnlivretxt }}"> {{ $btnlivretitle }}</td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <button type="button" class="btn btn-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false" id="dropdownMenu2">
                                            <span class="badge rounded-pill bg-primary"><i class="fas fa-ellipsis-h"></i></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <a href="{{ url('/acquisition/fiche', $acquisition) }}"
                                                class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Voir la fiche">
                                                <i class="fas fa-eye"></i> Voir la fiche
                                            </a>
                                            <a href="{{ url('/acquisition/edit', $acquisition) }}"
                                                class="btn   {{ $btnedit }} dropdown-item" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Modifier la fiche">
                                                <i class="fas fa-edit"></i> Modifier la fiche
                                            </a>
                                            {{-- <form action="{{ url('/acquisition/change_status', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="button" class="btn btn-link dropdown-item" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ $titre }}" {{ $btnshow }}
                                            onclick="confirm('Vous étes sur le point de changé la visibilité de la fiche ?') ? this.parentElement.submit() : ''">
                                            <i class="fas fa-{{ $icon }}"></i>
                                        </button>
                                    </form> --}}

                                            <form action="{{ url('/acquisition/delete', $acquisition) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn dropdown-item" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Supprimer la fiche"
                                                    onclick="confirm('Etes vous sûr de supprimer la fiche ?') ? this.parentElement.submit() : ''">
                                                    <i class="fas fa-trash-alt"></i> Supprimer la fiche
                                                </button>
                                            </form>
                                            @php
                                                $query = Livraison::where('fiche', 'acquisition')
                                                    ->where('numero_fiche', $acquisition->id)
                                                    ->first();
                                                
                                            @endphp
                                            @if ($query)
                                                <a href="{{ url('/livraison/show', $query->id) }}" class="btn dropdown-item"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Voir la fiche de livraison ">
                                                    <i class="fas fa-truck-loading"></i> Voir la fiche de livraison
                                                </a>
                                            @else
                                                <a href="{{ url('/acquisition/livraison', $acquisition) }}"
                                                    class="btn dropdown-item" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Générer une fiche de livraison "
                                                    {{ $btnlivraison }}>
                                                    <i class="fas fa-truck"></i> Générer une fiche de livraison
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $cnt = $cnt + 1;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">There are no data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $acquisitions->links() }}
            </div>

        </div>


    @endsection
