@php
use App\Models\Direction;
@endphp 
@extends('1.layout', ['page' => 'Fiche Livraison', 'pageSlug' => 'livraison'])
@section('content')
    <br>
    <div class="container ">
        {{-- <div class="d-flex justify-content-between mb-3" style="width: 90%">
            <h3 class="fw-bold mt-3">FICHE DE LIVRAISON</h3>
            <a href="/acquisition" class="btn  btn-primary  fw-bold">RETOURNER</a>
            <a href="{{ url('/generate-livraison', $livraison) }}" class="btn  btn-primary  fw-bold text-white">IMPRIMER</a>
            
        </div> --}}
        <div class="d-flex justify-content-between mb-4 " style="width: 100%">
            <h3 class="over-title ">Fiches de livraison  </h3>
            <a href="{{ url('/generate-livraison', $livraison) }}" class="btn  btn-primary  fw-bold text-white">IMPRIMER</a>
        </div>

        <div class="card  mb-3" style="width: 100%;">
            <h4 class="card-header text-center">Informations</h4>

            <div class="card-body">
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold ">Intervenant </span>
                    <label class="form-control">{{ $livraison->nom_intervenant }} </label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Demandeur</span>

                    <label class="form-control">{{ $livraison->nom_demandeur }} </label>
                </div>
                @php
                $dir = Direction::where('sigle', $livraison->direction)->get()->first();
            @endphp
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Direction</span>

                    <label class="form-control">{{ $dir->nom }} </label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Service</span>
                    <label class="form-control">{{ $livraison->service }} </label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Date de livraison</span>
                    <label class="form-control">{{ date('d/m/Y', strtotime($livraison->date_livraison)) }} </label>
                </div>
            </div>
        </div>
        <div class="card  mb-3" style="width: 100%;">
            <h4 class="card-header text-center">Materiels Livrés
            </h4>
            <div class="card-body">
                <div class="col mb-2">
                    <table class="table tablesorter  table-bordered" id="">
                        <thead class="table-dark ">
                            <th scope="col">Nom du materile</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Observation</th>
                        </thead>
                        <tbody>
                            @foreach ($materiels as $key => $materiel)
                                <tr>
                                    <td>{{ $materiel->nom_materiel }}</td>
                                    <td>{{ $materiel->quantite }}</td>
                                    <td>{{ $materiel->observation }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>

    </div>
    <style>
        .card-header {
            background: #4F81BD;
            color: white;
        }

        .input-group-text {
            width: 17%;
        }

    </style>
@endsection
