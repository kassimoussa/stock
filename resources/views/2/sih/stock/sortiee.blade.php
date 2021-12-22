@extends('2.sih.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')

    <div class="row mt-3">
        <h3 class="fw-bold mt-3">Gestion des stocks</h3>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
            <form action="{{ url('/stocks/retrait', $stock) }}" role="form" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="card col-md-10 mb-3">
                    <h4 class="card-header text-center">Sortie de stock</h4>
                    <div class="card-body">
                        <div class="mb-2 row">
                            <label class="col-sm-3 col-form-label">Materiel: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="materiel" value="{{ $stock->materiel }}" disabled>
                            </div>
                           {{--  <label class="col-sm-9 col-form-label">{{ $stock->materiel }} </label> --}}
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-3 col-form-label">Quantité: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="quantite" placeholder="Quantité disponible: {{ $stock->quantite }}">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-3 col-form-label">N° Fiche d'intervention: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fiche_intervention" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-5">
                    <div class="col-md-12 form-group">
                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                        <button type="reset" class="btn btn-default fw-bold">Annuler</button>
                        <input type="text" name="date_sortie" value="{{ date('Y-m-d H:i:s') }}" hidden>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="col-md-6">
            <h3>Dernières Rentrées pour {{ $stock->materiel }}</h3>
            <table class="table table-bordered border-dark " id="">
                <thead class="  table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Date</th>
                </thead>
                <tbody>
                    @if (!empty($rentrees) && $rentrees->count())
                    @php
                            $cnt = 1;
                        @endphp

                    @foreach ($rentrees as $key => $rentree)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $rentree->quantite }}</td>
                            <td>{{ date('d/m/Y à H:i:s', strtotime($rentree->date_rentree)) }}</td>
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
           
        </div>
        <div class="col-md-6">
            <h3>Dernières Sorties pour {{ $stock->materiel }}</h3>
            <table class="table table-bordered border-dark " id="">
                <thead class="  table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Date</th>
                </thead>
                <tbody>
                    @if (!empty($sorties) && $sorties->count())
                    @php
                            $cnt = 1;
                        @endphp

                    @foreach ($sorties as $key => $sortie)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $sortie->quantite }}</td>
                            <td>{{ $sortie->fiche_intervention }}</td>
                            <td>{{ date('d/m/Y à H:i:s', strtotime($sortie->date_sortie)) }}</td>
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
           
        </div>
    </div>
    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

        .btn-primary {
            color: white;
        }

        .card-header {
            background: #4F81BD;
            color: white;
        }

    </style>
@endsection
