@extends('3.layout', ['page' => 'Fiches de livraison', 'pageSlug' => 'livraison'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-4 ">
            <h3 class="over-title ">Fiches de livraison  </h3>
            {{-- <a href="/livraison/newlivraison" class="btn  btn-primary  fw-bold">Nouvelle Livraison</a> --}}
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
            <table class="table tablesorter table-sm table-hover" id="">
                <thead class=" text-primary">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Nom de l'intervenant</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @if (!empty($livraisons) && $livraisons->count())
                    @php
                            $cnt = 1;
                        @endphp

                    @foreach ($livraisons as $key => $livraison)
                        <tr>
                            <td>{{ $livraison->id }}</td>
                            <td>{{ $livraison->nom_intervenant }}</td>
                            <td>{{ $livraison->direction }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/livraison/show', $livraison) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Voir la fiche {{ $livraison->id }}">
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
           
        </div>
    </div>

@endsection
