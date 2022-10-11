@extends('1.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks' ])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Stock des materiels </h3>
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="/stocks/newmateriel" type="button" class="btn  btn-outline-dark fw-bold">Ajouter Materiel</a>
                <a href="/stocks/allrentree" type="button" class="btn  btn-outline-dark fw-bold">Rentrées</a>
                <a href="/stocks/allsortie" type="button" class="btn  btn-outline-dark fw-bold">Sorties</a>
              </div>
        </div>

        <div class="d-flex justify-content-start mb-2"> 
                <form action="" class="col-md-6">
                    <div class="input-group  mb-3">
                        <button class="btn btn-dark" type="submit">Chercher</button>
                        <input type="text" class="form-control " name="search" placeholder="Par matériel" value="{{ $search }}">
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
            <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
                <thead class="bg-dark text-white text-center">
                    <th scope="col">#</th>
                    <th scope="col">Materiels</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody class="text-center">
                    @if (!empty($stocks) && $stocks->count())
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach ($stocks as $key => $stock)
                            <tr>
                                <td>{{ $cnt }}</td>
                                <td>{{ $stock->materiel }}</td>
                                <td>{{ $stock->quantite }}</td>
                                <td class="td-actions ">
                                    <a href="{{ url('/stocks/rentree', $stock) }}" class="btn  "
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Rentrée de stock">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="{{ url('/stocks/sortie', $stock) }}" class="btn  " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Sortie de stock">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                    <form action="{{ url('/stocks/delete', $stock) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn  " data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Supprimer le materiel"
                                            onclick="confirm('Etes vous sûr de supprimer le materiel ?') ? this.parentElement.submit() : ''">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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

        </div>
    </div>

@endsection
