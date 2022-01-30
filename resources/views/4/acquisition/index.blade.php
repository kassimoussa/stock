@extends('4.layout', ['page' => 'Fiches d\'Acquisitions', 'pageSlug' => 'acquisition'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-5">
            <h3 class="over-title ">Fiches d'acquisiton  </h3>

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
                    <th scope="col">Service</th>
                    <th scope="col">Materiel</th>
                    <th scope="col">Date de soumission</th>
                    <th scope="col" colspan="2">Status</th>
                    <th scope="col">Livraison</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody class=" text-center">
                    @if (!empty($acquisitions) && $acquisitions->count())
                    @php
                            $cnt = 1;
                        @endphp

                    @foreach ($acquisitions as $key => $acquisition)
                    @php
                    $status_dir = '';
                    $status_sih = '';
                    $status_dsi = '';
                    $status_dir_txt = '';
                    $status_sih_txt = '';
                    $status_dsi_txt = '';
                    $btnhidden = '';
                    $bg = '';
                    $status = "$acquisition->livre";
                        if($acquisition->status_dir == 'approuve'){ $status_dir = "bg-success "; }
                        elseif($acquisition->status_dir == 'attente'){ $status_dir = "bg-warning "; }
                        elseif($acquisition->status_dir == 'rejete'){ $status_dir = "bg-danger text-white"; }
                        elseif($acquisition->status_dir == null){ $status_dir = "bg-white"; }

                        if($acquisition->status_sih == 'approuve'){ 
                            $status_sih = "bg-success ";
                            $status_sih_txt = 'Acquisition approuvée par le service IT HelpDesk';
                            $btnhidden = 'hidden'; }
                        elseif($acquisition->status_sih == 'attente'){ 
                            $status_sih = "bg-warning ";
                            $status_sih_txt = 'Acquisition mise en attente par le service IT HelpDesk';
                         }
                        elseif($acquisition->status_sih == 'rejete'){ 
                            $status_sih = "bg-danger text-white";
                            $status_sih_txt = 'Acquisition rejetée par le service IT HelpDesk';
                         }
                        elseif($acquisition->status_sih == null){ 
                            $status_sih = "bg-white";
                            $status_sih_txt = 'Acquisition pas encore vue par le service IT HelpDesk';
                         }
                        
                        if($acquisition->status_dsi == 'approuve'){ 
                            $status_dsi = "bg-success "; 
                            $status_dsi_txt = 'Acquisition approuvée par la DSI';
                            $btnhidden = 'hidden';
                         }
                        elseif($acquisition->status_dsi == 'attente'){ 
                            $status_dsi = "bg-warning ";
                            $status_dsi_txt = 'Acquisition mise en attente par la DSI';
                         }
                        elseif($acquisition->status_dsi == 'rejete'){ 
                            $status_dsi = "bg-danger text-white";
                            $status_dsi_txt = 'Acquisition rejetée par la DSI';
                         }
                        elseif($acquisition->status_dsi == null){ 
                            $status_dsi = "bg-white";
                            $status_dsi_txt = 'Acquisition pas encore vue par la DSI';
                         }

                        if($acquisition->livre == 'oui'){ $bg = 'success';}
                        elseif($acquisition->livre == 'non'){ $bg = 'danger'; }
                    @endphp
                        <tr>
                            <td>{{ $acquisition->id }}</td>
                            <td>{{ $acquisition->service_demandeur }}</td>
                            <td>{{ $acquisition->nom_mat }}</td>
                            <td>{{ date('d/m/Y à H:i:s', strtotime($acquisition->date_submit)) }}</td>
                            <td class="{{ $status_sih }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="{{ $status_sih_txt }}">SIH</td>
                            <td class="{{ $status_dsi }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="{{$status_dsi_txt  }}">DSI</td>
                            <td class="bg-{{ $bg }} text-white">{{ $status }}</td>
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
