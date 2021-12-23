@extends('4.layout', ['page' => 'Fiches d\'Intervention', 'pageSlug' => 'intervention'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Fiches d'intervention  </h3>
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
                    <th scope="col">Intervenant</th>
                    <th scope="col">Demandeur</th>
                    <th scope="col">Materiel</th>
                    <th scope="col">Status</th>
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
                            <td>{{ $intervention->id }}</td>
                            <td>{{ $intervention->nom_intervenant }}</td>
                            <td>{{ $intervention->nom_demandeur }}</td>
                            <td>{{ $intervention->materiel }}</td>
                            <td>
                                @php
                                    if($intervention->status_direction == null){
                                       
                                    }
                                @endphp
                                <p>Direction: {{ $intervention->status_direction }}</p>
                                <p>SIH: {{ $intervention->status_service }}</p>
                                <p>DIN: {{ $intervention->status_division }}</p>
                            </td>
                            <td>{{ date('d/m/Y', strtotime($intervention->date_intervention)) }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/intervention/fiche', $intervention) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Voir la fiche">
                                    <i class="fas fa-eye"></i>
                                </a>
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
            {{ $interventions->links() }}
        </div>
    </div>

@endsection
