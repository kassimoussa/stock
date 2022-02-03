@extends('2.sih.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks' ])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-2">
            <h3 class="over-title ">Stock des materiels </h3>
            <a href="/stocks/newmateriel" class="btn  btn-primary  fw-bold">Ajouter Materiel</a>
        </div>

        <div class="d-flex justify-content-start mb-2">
            <div class="row">
                <form action="" class="">
                    <div class="input-group  mb-3">
                        <button class="btn btn-dark" type="submit">Chercher</button>
                        <input type="text" class="form-control " name="search" placeholder="Par matériel" value="{{ $search }}">
                    </div>
                </form>
            </div>
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
                <thead class="table-dark text-primary  ">
                    <th scope="col">#</th>
                    <th scope="col">Materiels</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
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
