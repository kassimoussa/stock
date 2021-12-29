@php
use App\Models\Livraison;
@endphp
@extends('2.sih.layout', ['page' => 'Fiches d\'Intervention', 'pageSlug' => 'intervention'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Fiches d'intervention </h3>
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
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('fail'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div>
            <table class="table tablesorter table-sm table-hover" id="">
                <thead class=" text-primary">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Demandeur</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Service</th>
                    <th scope="col">Materiel</th>
                    <th scope="col" colspan="3">Status</th>
                    <th scope="col">Date d'intervention</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @if (!empty($interventions) && $interventions->count())
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach ($interventions as $key => $intervention)
                            <tr>
                                @php
                                    $status_dir = '';
                                    $status_sih = '';
                                    $status_din = '';
                                    $btnhidden = '';
                                    $devishidden = '';
                                    $btnlivraison = 'hidden';
                                    
                                    if ($intervention->status_dir == 'approuve') {
                                        $status_dir = '#089415';
                                    } elseif ($intervention->status_dir == 'attente') {
                                        $status_dir = '#efaa2d';
                                    } elseif ($intervention->status_dir == 'rejete') {
                                        $status_dir = '#FF0000';
                                    } elseif ($intervention->status_dir == null) {
                                        $status_dir = '#FFFFFF';
                                    }
                                    
                                    if ($intervention->status_sih == 'approuve') {
                                        $status_sih = '#089415';
                                        $btnhidden = 'hidden';
                                    } elseif ($intervention->status_sih == 'attente') {
                                        $status_sih = '#efaa2d';
                                    } elseif ($intervention->status_sih == 'rejete') {
                                        $status_sih = '#FF0000';
                                    } elseif ($intervention->status_sih == null) {
                                        $status_sih = '#FFFFFF';
                                        $devishidden = 'hidden';
                                    }
                                    
                                    if ($intervention->status_din == 'approuve') {
                                        $status_din = '#089415';
                                        $btnhidden = 'hidden';
                                        $btnlivraison = ' ';
                                    } elseif ($intervention->status_din == 'attente') {
                                        $status_din = '#efaa2d';
                                    } elseif ($intervention->status_din == 'rejete') {
                                        $status_din = '#FF0000';
                                    } elseif ($intervention->status_din == null) {
                                        $status_din = '#FFFFFF';
                                    }
                                @endphp
                                <td>{{ $intervention->id }}</td>
                                <td>{{ $intervention->nom_demandeur }}</td>
                                <td>{{ $intervention->dir_demandeur }}</td>
                                <td>{{ $intervention->service_demandeur }}</td>
                                <td>{{ $intervention->materiel }}</td>
                                <td style="background: {{ $status_sih }}">SIH</td>
                                <td style="background: {{ $status_dir }}">{{ $intervention->dir_demandeur }}</td>
                                <td style="background: {{ $status_din }}">DIN</td>
                                <td>{{ date('d/m/Y', strtotime($intervention->date_intervention)) }}</td>
                                <td class="td-actions ">
                                    <a href="{{ url('/intervention/fiche', $intervention) }}" class="btn btn-link"
                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Voir la fiche">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('/intervention/edit', $intervention) }}" class="btn btn-link"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" {{ $btnhidden }}
                                        title="Modifier la fiche">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- <a href="{{ url('/intervention/devis', $intervention) }}" class="btn btn-link"
                                        data-bs-toggle="tooltip" data-bs-placement="top" {{ $devishidden }}
                                        title="Ajout un devis">
                                        <i class="fas fa-plus"></i>
                                    </a> --}}
                                    <form action="{{ url('/intervention/delete', $intervention) }}" method="post"
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
                                        $query = Livraison::where('fiche', 'intervention')
                                            ->where('numero_fiche', $intervention->id)
                                            ->first();
                                        
                                    @endphp
                                    @if ($query)
                                        <a href="{{ url('/livraison/show', $query->id) }}" class="btn btn-link"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Voir la fiche de livraison ">
                                            <i class="fas fa-truck-loading"></i>
                                        </a>
                                    @else
                                        <a href="{{ url('/intervention/livraison', $intervention) }}"
                                            class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
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
            {{ $interventions->links() }}
        </div>
    </div>

@endsection
