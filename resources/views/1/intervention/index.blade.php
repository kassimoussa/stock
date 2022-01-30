@php
use App\Models\Livraison;
@endphp
@extends('1.layout', ['page' => 'Fiches d\'Intervention', 'pageSlug' => 'intervention'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Fiches d'intervention </h3>
            <a href="/intervention/newintervention" class="btn  btn-primary  fw-bold">Nouvelle Intervention</a>
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

        <div>
            <table class="table   border-dark table-sm table-hover " id="">
                <thead class="table-dark text-primary text- ">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Demandeur</th>
                    <th scope="col">Direction</th>
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
                                    $status_dir_txt = '';
                                    $status_sih_txt = '';
                                    $status_din_txt = '';
                                    $btnhidden = '';
                                    $btnlivraison = 'hidden';
                                    
                                    if ($intervention->status_dir == 'approuve') {
                                        $status_dir = "bg-success ";
                                        $status_dir_txt = 'Intervention approuvée par la direction demandeuse';
                                    } elseif ($intervention->status_dir == 'attente') {
                                        $status_dir = "bg-warning ";
                                        $status_dir_txt = 'Intervention mise en attente par la direction demandeuse';
                                    } elseif ($intervention->status_dir == 'rejete') {
                                        $status_dir = "bg-danger text-white";
                                        $status_dir_txt = 'Intervention arejetée par la direction demandeuse';
                                    } elseif ($intervention->status_dir == null) {
                                        $status_dir = "bg-white";
                                        $status_dir_txt = 'Intervention pas encore vue par la direction demandeuse';
                                    }
                                    
                                    if ($intervention->status_sih == 'approuve') {
                                        $status_sih = "bg-success ";
                                        $status_sih_txt = 'Intervention approuvée par le sih';
                                        $btnhidden = 'hidden';
                                    } elseif ($intervention->status_sih == 'attente') {
                                        $status_sih = "bg-warning ";
                                        $status_sih_txt = 'Intervention mise en attente par le sih';
                                    } elseif ($intervention->status_sih == 'rejete') {
                                        $status_sih = "bg-danger text-white";
                                        $status_sih_txt = 'Intervention arejetée par le sih';
                                    } elseif ($intervention->status_sih == null) {
                                        $status_sih = "bg-white";
                                        $status_sih_txt = 'Intervention pas encore vue par le sih';
                                    }
                                    
                                    if ($intervention->status_din == 'approuve') {
                                        $status_din = "bg-success ";
                                        $status_din_txt = 'Intervention approuvée par le DIN';
                                        $btnhidden = 'hidden';
                                        $btnlivraison = ' ';
                                    } elseif ($intervention->status_din == 'attente') {
                                        $status_din = "bg-warning ";
                                        $status_din_txt = 'Intervention mise en attente par le DIN';
                                    } elseif ($intervention->status_din == 'rejete') {
                                        $status_din = "bg-danger text-white";
                                        $status_din_txt = 'Intervention arejetée par le DIN';
                                    } elseif ($intervention->status_din == null) {
                                        $status_din = "bg-white";
                                        $status_din_txt = 'Intervention pas encore vue par le DIN';
                                    }
                                @endphp
                                <td>{{ $intervention->id }}</td>
                                <td>{{ $intervention->nom_demandeur }}</td>
                                <td>{{ $intervention->dir_demandeur }}</td>
                                <td>{{ $intervention->materiel }}</td>
                                <td class="{{ $status_sih }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ $status_sih_txt }} ">SIH</td>
                                <td class="{{ $status_dir }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ $status_dir_txt }} ">{{ $intervention->dir_demandeur }}</td>
                                <td class="{{ $status_din }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ $status_din_txt }} ">DIN</td>
                                <td>{{ date('d/m/Y', strtotime($intervention->date_intervention)) }}</td>
                                <td class="td-actions ">
                                    <a href="{{ url('/intervention/fiche', $intervention) }}" class="btn  "
                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Voir la fiche">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @php
                                        $query = Livraison::where('fiche', 'intervention')
                                            ->where('numero_fiche', $intervention->id)
                                            ->first();
                                        
                                    @endphp
                                    @if ($query)
                                        <a href="{{ url('/livraison/show', $query->id) }}" class="btn  "
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Voir la fiche de livraison ">
                                            <i class="fas fa-truck-loading"></i>
                                        </a>
                                    @else
                                        <a href="{{ url('/intervention/livraison', $intervention) }}"
                                            class="btn  " data-bs-toggle="tooltip" data-bs-placement="bottom"
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
