@php
use App\Models\Livraison;
@endphp
@extends('2.layout', ['page' => 'Fiches d\'Intervention', 'pageSlug' => 'intervention'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Fiches d'intervention </h3>
        </div>

        <div class="d-flex justify-content-start mb-2">
            <form action="" class="col-md-6">
                <div class="input-group  mb-3">
                    <button class="btn btn-dark" type="submit">Chercher</button>
                    <input type="text" class="form-control " name="search" placeholder="Par numero de fiche ou materiel"
                        value="{{ $search }}">
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
                    <th scope="col">Nom demandeur</th>
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
                                    $status_dir_txt = '';
                                    $status_sih = '';
                                    $status_sih_txt = '';
                                    $status_din = '';
                                    $status_din_txt = '';
                                    $btnedit = '';
                                    
                                    if ($intervention->status_dir == 'approuve') {
                                        $status_dir = "bg-success ";
                                        $status_dir_txt = 'Intervention approuvée par la direction';
                                        $btnedit = 'disabled';
                                    } elseif ($intervention->status_dir == 'attente') {
                                        $status_dir = "bg-warning ";
                                        $status_dir_txt = 'Intervention mise en attente par la direction';
                                    } elseif ($intervention->status_dir == 'rejete') {
                                        $status_dir = "bg-danger text-white";
                                        $status_dir_txt = 'Intervention réjetée par la direction';
                                    } elseif ($intervention->status_dir == null) {
                                        $status_dir = "bg-white";
                                    }
                                    
                                    if ($intervention->status_sih == 'approuve') {
                                        $status_sih = "bg-success ";
                                        $status_sih_txt = 'Intervention approuvée par le service IT HelpDesk';
                                    } elseif ($intervention->status_sih == 'attente') {
                                        $status_sih = "bg-warning ";
                                        $status_sih_txt = 'Intervention mise en attente par le service IT HelpDesk';
                                    } elseif ($intervention->status_sih == 'rejete') {
                                        $status_sih = "bg-danger text-white";
                                        $status_sih_txt = 'Intervention réjetée par le service IT HelpDesk';
                                    } elseif ($intervention->status_sih == null) {
                                        $status_sih = "bg-white";
                                        $devishidden = 'hidden';
                                    }
                                    if ($intervention->status_din == 'approuve') {
                                        $status_din = "bg-success ";
                                        $status_din_txt = 'Intervention approuvée par la Division Infrastructure Numérique';
                                        $btnedit = 'disabled';
                                        $btnlivraison = ' ';
                                    } elseif ($intervention->status_din == 'attente') {
                                        $status_din = "bg-warning ";
                                        $status_din_txt = 'Intervention mise en attente par la Division Infrastructure Numérique';
                                    } elseif ($intervention->status_din == 'rejete') {
                                        $status_din = "bg-danger text-white";
                                        $status_din_txt = 'Intervention réjetée par la Division Infrastructure Numérique';
                                    } elseif ($intervention->status_din == null) {
                                        $status_din = "bg-white";
                                    }
                                @endphp
                                <td>{{ $intervention->id }}</td>
                                <td>{{ $intervention->nom_demandeur }}</td>
                                <td>{{ $intervention->service_demandeur }}</td>
                                <td>{{ $intervention->materiel }}</td>
                                <td class="{{ $status_sih }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ $status_sih_txt }} ">SIH</td>
                                <td class="{{ $status_dir }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ $status_dir_txt }} ">{{ $intervention->dir_demandeur }}</td>
                                <td class="{{ $status_din }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ $status_din_txt }} ">DIN</td>
                                <td>{{ date('d/m/Y', strtotime($intervention->date_intervention)) }}</td>
                                <td class="td-actions ">
                                    <a href="{{ url('/intervention/fiche', $intervention) }}" class="btn "
                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Voir la fiche">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('/intervention/edit', $intervention) }}"
                                        class="btn  {{ $btnedit }}" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Modifier la fiche">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @php
                                        $query = Livraison::where('fiche', 'intervention')
                                            ->where('numero_fiche', $intervention->id)
                                            ->first();
                                        
                                    @endphp
                                    @if ($query)
                                        <a href="{{ url('/livraison/show', $query->id) }}" class="btn "
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Voir la fiche de livraison ">
                                            <i class="fas fa-truck-loading"></i>
                                        </a>
                                    @endif
                                    {{-- <form action="{{ url('/intervention/delete', $intervention) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                        data-bs-placement="top"  title="Supprimer la fiche"
                                        onclick="confirm('Etes vous sûr de supprimer la fiche ?') ? this.parentElement.submit() : ''">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form> --}}
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
