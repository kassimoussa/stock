@extends('2.layout', ['page' => 'Fiches d\'Intervention', 'pageSlug' => 'intervention'])
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
                            $status_sih = '';
                            $status_din = '';
                            $btnhidden = '';

                                if($intervention->status_dir == 'approuve'){ $status_dir = '#089415'; }
                                elseif($intervention->status_dir == 'attente'){ $status_dir = '#efaa2d'; }
                                elseif($intervention->status_dir == 'rejete'){ $status_dir = '#FF0000'; }
                                elseif($intervention->status_dir == null){ $status_dir = '#FFFFFF'; }

                                if($intervention->status_sih == 'approuve'){ $status_sih = '#089415'; $btnhidden = 'hidden'; }
                                elseif($intervention->status_sih == 'attente'){ $status_sih = '#efaa2d'; }
                                elseif($intervention->status_sih == 'rejete'){ $status_sih = '#FF0000'; }
                                elseif($intervention->status_sih == null){ $status_sih = '#FFFFFF'; }
                                
                                if($intervention->status_din == 'approuve'){ $status_din = '#089415'; $btnhidden = 'hidden'; }
                                elseif($intervention->status_din == 'attente'){ $status_din = '#efaa2d'; }
                                elseif($intervention->status_din == 'rejete'){ $status_din = '#FF0000'; }
                                elseif($intervention->status_din == null){ $status_din = '#FFFFFF'; }
                            @endphp
                            <td>{{ $intervention->id }}</td>
                            <td>{{ $intervention->nom_demandeur }}</td>
                            <td>{{ $intervention->service_demandeur }}</td>
                            <td>{{ $intervention->materiel }}</td>
                            <td style="background: {{ $status_sih }}" >SIH</td>
                            <td style="background: {{ $status_dir }}">{{ $intervention->dir_demandeur }}</td>                            
                            <td style="background: {{ $status_din }}">DIN</td>
                            <td>{{ date('d/m/Y', strtotime($intervention->date_intervention)) }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/intervention/fiche', $intervention) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Voir la fiche">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url('/intervention/edit', $intervention) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom" {{ $btnhidden }}
                                    title="Modifier la fiche">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/intervention/delete', $intervention) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                        data-bs-placement="top"  title="Supprimer la fiche"
                                        onclick="confirm('Etes vous sûr de supprimer la fiche ?') ? this.parentElement.submit() : ''">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>                               
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