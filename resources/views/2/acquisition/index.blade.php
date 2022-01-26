@php
use App\Models\Livraison;
@endphp

@extends('2.layout', ['page' => 'Fiches d\'Acquisitions', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Fiches d'acquisiton </h3>
        </div>

        <div class="d-flex justify-content-start mb-2">
            <form action="" class="col-md-6">
                <div class="input-group  mb-3">
                    <button class="btn btn-dark" type="submit">Chercher</button>
                    <input type="text" class="form-control " name="search"
                        placeholder="Par numero de fiche, service, demandeur ou materiel" value="{{ $search }}">
                </div>
            </form>
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
                    <th scope="col">Demandeur</th>
                    <th scope="col">Service</th>
                    <th scope="col">Materiel</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Date de soumission</th>
                    <th scope="col" colspan="2">Status</th>
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
                                
                                $query = Livraison::where('fiche', 'acquisition')
                                    ->where('numero_fiche', $acquisition->id)
                                    ->first();
                                $status_dir = '';
                                $status_sih = '';
                                $status_dsi = '';
                                $btnhidden = '';
                                $titre = '';
                                $icon = '';
                                $btnshow = 'hidden';
                                
                                $btnlivreoutline = $btnlivretitle = $btnlivreclick = '';
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
                                    if ($query) {
                                        $btnlivraison = $btnlivreshow = '';
                                        if ($acquisition->livre == 'non') {
                                            $btnlivreoutline = 'danger';
                                            $btnlivretitle = 'Confirmer';
                                            $btnlivreclick = '';
                                        } else {
                                            $btnlivreoutline = 'success';
                                            $btnlivretitle = 'Oui';
                                            $btnlivreclick = 'disabled';
                                        };
                                    } else {
                                        $btnlivraison = $btnlivreshow = 'hidden';
                                        
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
                                <td>{{ $acquisition->nom_demandeur }}</td>
                                <td>{{ $acquisition->service_demandeur }}</td>
                                <td>{{ $acquisition->nom_mat }}</td>
                                <td>{{ $acquisition->quantite }}</td>
                                <td>{{ date('d/m/Y', strtotime($acquisition->date_submit)) }}</td>
                                <td style="background: {{ $status_sih }}">SIH</td>
                                <td style="background: {{ $status_dsi }}">DSI</td>
                                <td>
                                    <form action="{{ url('/acquisition/livre', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="button" class="btn btn-outline-{{ $btnlivreoutline }}"
                                            {{ $btnlivreshow }} {{ $btnlivreclick }}
                                            onclick="confirm('Clique sur oui si vous avez réçu le materiel ?') ? this.parentElement.submit() : ''">
                                            {{ $btnlivretitle }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ url('/acquisition/fiche', $acquisition) }}" class="btn btn-link"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir la fiche">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if ($query)
                                        <a href="{{ url('/livraison/show', $query->id) }}" class="btn btn-link"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Voir la fiche de livraison ">
                                            <i class="fas fa-truck fa-flip-horizontal"></i>
                                        </a>
                                    @endif

                                    {{-- <form action="{{ url('/acquisition/delete', $acquisition) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Supprimer la fiche"
                                            onclick="confirm('Etes vous sûr de supprimer la fiche ?') ? this.parentElement.submit() : ''">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <a href="{{ url('/acquisition/livraison', $acquisition) }}" class="btn btn-link"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
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
            <div class="d-flex justify-content-center">
                {{ $acquisitions->links() }}
            </div>
        </div>


    @endsection
