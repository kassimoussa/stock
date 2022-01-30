@extends('4.dsi.layout', ['page' => 'Fiches d\'Acquisitions', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-5">
            <h3 class="over-title ">Liste des acquisitons </h3>
            <a href="/acquisition/newacquis" class="btn  btn-primary  fw-bold">Nouvelle Acquisition</a>
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
                <thead class="table-dark text-primary text-center">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Service</th>
                    <th scope="col">Materiel</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Date de soumission</th>
                    <th scope="col">Status</th>
                    <th scope="col">Livraison</th>
                    <th scope="col" colspan="4">Actions</th>
                </thead>
                <tbody class=" text-center">
                    @if (!empty($acquisitions) && $acquisitions->count())
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach ($acquisitions as $key => $acquisition)
                            @php 
                                $status_dsi = '';
                                $status_dsi_bg = '';
                                $status_dsi_txt = '';
                                $btnhidden = '';
                                $titre = '';
                                $icon = '';
                                $btnshow = 'hidden';
                                $btntitle = '';
                                $btnclick = '';
                                $btnlivraison = 'hidden';
                                $bg = '';
                                $status = "$acquisition->livre";
                                
                                
                                
                                if ($acquisition->status_dsi == 'approuve') {
                                    $status_dsi = '#089415';
                                    $status_dsi_bg = 'success';
                                    $btnhidden = 'hidden';
                                    $btnshow = ''; 
                                    $icon = 'fas fa-check-circle';
                                    $status_dsi_txt = "Acquisation approuvée ";
                                } elseif ($acquisition->status_dsi == 'attente') {
                                    $status_dsi = '#efaa2d';
                                    $status_dsi_bg = 'warning';
                                    $status_dsi_txt = "Acquisation mise en attente ";
                                    $icon = "fas fa-minus-circle";
                                } elseif ($acquisition->status_dsi == 'rejete') {
                                    $status_dsi = '#FF0000';
                                    $status_dsi_bg = 'danger';
                                    $status_dsi_txt = "Acquisation réjetée ";
                                    $icon = "fas fa-times-circle";
                                } elseif ($acquisition->status_dsi == null) {
                                    $status_dsi = '#FFFFFF';
                                    $status_dsi_bg = 'white';
                                    $status_dsi_txt = "Nouvelle Acquisation";
                                    $icon = "fas fa-circle";
                                }
                                 
                                if ($acquisition->livre == 'oui') {
                                    $bg = 'success';
                                } elseif ($acquisition->livre == 'non') {
                                    $bg = 'danger';
                                }
                                
                            @endphp
                            <tr>
                                <td>{{ $acquisition->id }}</td>
                                <td>{{ $acquisition->dir_demandeur }}</td>
                                <td>{{ $acquisition->service_demandeur }}</td>
                                <td>{{ $acquisition->nom_mat }}</td>
                                <td>{{ $acquisition->quantite }}</td>
                                <td>{{ date('d/m/Y à H:i:s', strtotime($acquisition->date_submit)) }}</td> 
                                <td class="bg-{{ $status_dsi_bg }} " data-bs-toggle="tooltip" 
                                data-bs-placement="bottom" title="{{ $status_dsi_txt }}"><i class="{{ $icon }}"></i></td>
                                <td class="bg-{{ $bg }} text-white" data-bs-toggle="tooltip" 
                                data-bs-placement="bottom" title="">{{ ucfirst($status) }}</td>
                                <td>
                                    <a href="{{ url('/acquisition/fiche', $acquisition) }}" class="btn  "
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir la fiche">
                                        <i class="fas fa-eye"></i>
                                    </a>{{-- <a href="{{ url('/acquisition/edit', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Modifier la fiche" {{ $btnhidden }}>
                                    <i class="fas fa-edit"></i>
                                </a> --}}

                                    {{-- <form action="{{ url('/acquisition/delete', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Supprimer la fiche"
                                            onclick="confirm('Etes vous sûr de supprimer la fiche ?') ? this.parentElement.submit() : ''">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form> --}}
                                    {{-- <a href="{{ url('/acquisition/livraison', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Générer une fiche de livraison " {{ $btnlivraison }}>
                                    <i class="fas fa-truck"></i>
                                </a> --}}
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
