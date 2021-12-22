@extends('3.layout', ['page' => 'Fiches d\'Acquisitions', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Fiches d'acquisiton  </h3>
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
            <table class="table tablesorter " id="">
                <thead class=" text-primary">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Service</th>
                    <th scope="col">Materiel</th>
                    <th scope="col">Date de soumission</th>
                    <th scope="col" colspan="2">Status</th>
                    <th scope="col">Actions</th>
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

                        if($acquisition->status_dir == 'approuve'){ $status_dir = '#089415'; }
                        elseif($acquisition->status_dir == 'attente'){ $status_dir = '#efaa2d'; }
                        elseif($acquisition->status_dir == 'rejete'){ $status_dir = '#FF0000'; }
                        elseif($acquisition->status_dir == null){ $status_dir = '#FFFFFF'; }

                        if($acquisition->status_sih == 'approuve'){ $status_sih = '#089415'; $btnhidden = 'hidden'; }
                        elseif($acquisition->status_sih == 'attente'){ $status_sih = '#efaa2d'; }
                        elseif($acquisition->status_sih == 'rejete'){ $status_sih = '#FF0000'; }
                        elseif($acquisition->status_sih == null){ $status_sih = '#FFFFFF'; }
                        
                        if($acquisition->status_dsi == 'approuve'){ $status_dsi = '#089415'; $btnhidden = 'hidden'; }
                        elseif($acquisition->status_dsi == 'attente'){ $status_dsi = '#efaa2d'; }
                        elseif($acquisition->status_dsi == 'rejete'){ $status_dsi = '#FF0000'; }
                        elseif($acquisition->status_dsi == null){ $status_dsi = '#FFFFFF'; }
                    @endphp
                        <tr>
                            <td>{{ $acquisition->id }}</td>
                            <td>{{ $acquisition->service_demandeur }}</td>
                            <td>{{ $acquisition->nom_mat }}</td>
                            <td>{{ date('d/m/Y à H:i:s', strtotime($acquisition->date_submit)) }}</td>
                            <td style="background: {{ $status_sih }}" >SIH</td>
                            <td style="background: {{ $status_dsi }}">DSI</td>
                            <td class="td-actions ">
                                <a href="{{ url('/acquisition/fiche', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Voir la fiche">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- <a href="{{ url('/acquisition/edit', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Modifier la fiche" {{ $btnhidden }}>
                                    <i class="fas fa-edit"></i>
                                </a> --}}
                            </td>
                        </tr>
                        @php
                        $cnt = $cnt +1;
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
