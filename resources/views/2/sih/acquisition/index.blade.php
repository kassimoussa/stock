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
            <div class="row">
                <form action="" class="">
                    <div class="input-group  mb-3">
                        <button class="btn btn-dark" type="submit">Chercher</button>
                        <input type="text" class="form-control " name="search" placeholder="" value="{{ $search }}">
                    </div>
                </form>
            </div>
        </div>

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

        <div id="div1">
            <table class="table tablesorter table-sm table-hover" id="">
                <thead class=" text-primary">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Service</th>
                    <th scope="col">Materiel</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Date</th>
                    <th scope="col" colspan="2">Status</th>
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
                                $status_dir = '';
                                $status_sih = '';
                                $status_dsi = '';
                                $btnhidden = '';
                                $titre = '';
                                $icon = '';
                                $btnshow = 'hidden';
                                $btnlivre = 'hidden';
                                $btnrecu = 'hidden';
                                $btnrecuoutline = $btnrecutitle = $btnrecuclick = '';
                                $btnlivreoutline = $btnlivretitle = $btnlivreclick =  '';
                                $btnrecushow = $btnlivreshow = $btnlivraison = 'hidden';
                                
                                if ($acquisition->status_dir == 'approuve') {
                                    $status_dir = '#089415';
                                } elseif ($acquisition->status_dir == 'attente') {
                                    $status_dir = '#efaa2d';
                                    $btnhidden = '';
                                } elseif ($acquisition->status_dir == 'rejete') {
                                    $status_dir = '#FF0000';
                                } elseif ($acquisition->status_dir == null) {
                                    $status_dir = '#FFFFFF';
                                }
                                
                                if ($acquisition->status_sih == 'approuve') {
                                    $status_sih = '#089415'; /* $btnhidden = 'hidden'; */
                                } elseif ($acquisition->status_sih == 'attente') {
                                    $status_sih = '#efaa2d';
                                } elseif ($acquisition->status_sih == 'rejete') {
                                    $status_sih = '#FF0000';
                                } elseif ($acquisition->status_sih == null) {
                                    $status_sih = '#FFFFFF';
                                }
                                
                                if ($acquisition->status_dsi == 'approuve') {
                                    $status_dsi = '#089415';
                                    $btnhidden = 'hidden';
                                    $btnshow = $btnrecushow = '';
                                    if ($acquisition->recu == 'non') {
                                        $btnrecuoutline = 'danger';
                                        $btnrecutitle = 'Confirmer';
                                    } else {
                                        $btnrecutitle = 'OUI';
                                        $btnrecuoutline = 'success';
                                        $btnrecuclick = '';
                                        $btnlivraison = '';
                                    if($acquisition->livre == 'non'){
                                        $btnlivreoutline = 'danger';
                                        $btnlivretitle = 'Non';
                                    }else {
                                        $btnlivreoutline = 'success';
                                        $btnlivretitle = 'oui';
                                        $btnlivre = '';
                                    }
                                    }
                                } elseif ($acquisition->status_dsi == 'attente') {
                                    $status_dsi = '#efaa2d';
                                } elseif ($acquisition->status_dsi == 'rejete') {
                                    $status_dsi = '#FF0000';
                                } elseif ($acquisition->status_dsi == null) {
                                    $status_dsi = '#FFFFFF';
                                }
                                
                                if ($acquisition->status == '1') {
                                    $titre = 'Rendre la fiche invisible aux autres';
                                    $icon = 'times-circle';
                                } elseif ($acquisition->status == '0') {
                                    $titre = 'Rendre la fiche visible aux autres';
                                    $icon = 'check-circle';
                                }
                                
                            @endphp
                            <tr>
                                <td>{{ $acquisition->id }}</td>
                                <td>{{ $acquisition->dir_demandeur }}</td>
                                <td>{{ $acquisition->service_demandeur }}</td>
                                <td>{{ $acquisition->nom_mat }}</td>
                                <td>{{ $acquisition->quantite }}</td>
                                <td>{{ date('d/m/Y', strtotime($acquisition->date_submit)) }}</td>
                                <td style="background: {{ $status_sih }}">SIH</td>
                                <td style="background: {{ $status_dsi }}">DSI</td>
                                <td>
                                    <form action="{{ url('/acquisition/recu', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="button" class="btn btn-outline-{{ $btnrecuoutline }}" {{ $btnrecushow }}
                                            {{ $btnrecuclick }}
                                            onclick="confirm('Clique sur oui si vous avez réçu le materiel ?') ? this.parentElement.submit() : ''">
                                            {{ $btnrecutitle }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-{{ $btnlivreoutline }}"  disabled>
                                        {{ $btnlivretitle }}
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ url('/acquisition/fiche', $acquisition) }}" class="btn btn-link"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir la fiche">
                                        <i class="fas fa-eye"></i>
                                    </a>{{-- <a href="{{ url('/acquisition/edit', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Modifier la fiche" {{ $btnhidden }}>
                                    <i class="fas fa-edit"></i>
                                </a> 
                                    <form action="{{ url('/acquisition/change_status', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ $titre }}" {{ $btnshow }}
                                            onclick="confirm('Vous étes sur le point de changé la visibilité de la fiche ?') ? this.parentElement.submit() : ''">
                                            <i class="fas fa-{{ $icon }}"></i>
                                        </button>
                                    </form>--}}

                                    <form action="{{ url('/acquisition/delete', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Supprimer la fiche"
                                            onclick="confirm('Etes vous sûr de supprimer la fiche ?') ? this.parentElement.submit() : ''">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @php
                                        $query = Livraison::where('fiche', 'acquisition')
                                            ->where('numero_fiche', $acquisition->id)
                                            ->first();

                                    @endphp
                                    @if ($query)
                                        <a href="{{ url('/livraison/show', $query->id) }}"
                                            class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Voir la fiche de livraison " >
                                            <i class="fas fa-truck-loading"></i>
                                        </a>
                                    @else
                                    <a href="{{ url('/acquisition/livraison', $acquisition) }}" class="btn btn-link"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Générer une fiche de livraison " {{ $btnlivraison }}>
                                        <i class="fas fa-truck"></i>
                                    </a>
                                    @endif
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
            {{ $acquisitions->links() }}
        </div>


    @endsection
