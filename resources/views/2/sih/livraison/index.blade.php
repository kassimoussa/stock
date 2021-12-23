@extends('2.sih.layout', ['page' => 'Fiches de livraison', 'pageSlug' => 'livraison'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-4 ">
            <h3 class="over-title ">Fiches de livraison  </h3>
            <a href="/livraison/newlivraison" class="btn  btn-primary  fw-bold">Nouvelle Livraison</a>
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
                    <th scope="col">Nom de l'intervenant</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Service</th>
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
                            <td>{{ $livraison->service }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/livraison/show', $livraison) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Voir la fiche {{ $livraison->id }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ url('/livraison/delete', $livraison) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Supprimer la fiche"
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
           
        </div>
    </div>

@endsection
