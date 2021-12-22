@php
use App\Models\Service;
@endphp
@extends('3.layout', ['page' => 'Direction', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
    <div class="d-flex justify-content-start mb-5">
        <div class="card" style="width: 100%;">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">{{ 'Listes des services de la ' . $direction->nom }}</h3>
                <a href="/admin/showdirections" class="btn btn-primary  fw-bold"> <i class="fas fa-arrow-left"></i>
                    RETOURNER</a>
            </div>


            <div class="card-body ">

                <table class="table  " id="">
                    <thead class=" text-primary">
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                    </thead>
                    <tbody>
                        @php
                            $cnt = 1;
                            $services = Service::where('direction', $direction->sigle)->get();
                        @endphp
                        @foreach ($services as $key => $service)

                            <tr>
                                <td>{{ $cnt }}</td>
                                <td>{{ $service->nom }}</td>
                            </tr>
                            @php
                                $cnt = $cnt + 1;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

    </style>

@endsection
