@extends('2.sih.layout', ['page' => 'Fiches de livraison', 'pageSlug' => 'livraison'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-4 ">
            <h3 class="over-title ">Fiches de livraison  </h3>
            {{-- <a href="/livraison/newlivraison" class="btn  btn-primary  fw-bold">Nouvelle Livraison</a> --}}
        </div>


        <div class="d-flex justify-content-start mb-2">
            <form action="" class="col-md-6">
                <div class="input-group  mb-3">
                    <button class="btn btn-dark" type="submit">Chercher</button>
                    <input type="text" class="form-control " name="search"
                        placeholder="Par numero de fiche, direction, service ou materiel" value="{{ $search }}">
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
            <table class="table   border-dark table-sm table-hover " id="">
                <thead class="table-dark text-primary  ">
                    <th scope="col">N° Fiche</th>
                    <th scope="col">Intervenant</th>
                    <th scope="col">Demandeur</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Service</th>
                    <th scope="col">Fiche</th>
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
                            <td>{{ $livraison->nom_demandeur }}</td>
                            <td>{{ $livraison->direction }}</td>
                            <td>{{ $livraison->service }}</td>
                            <td>
                                @php
                                    $fiche = $livraison->fiche; 
                                @endphp
                                <a href="{{ url('/'.$fiche.'/fiche', $livraison->numero_fiche) }}" class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Voir la fiche d' {{ $fiche }} associée">{{ ucfirst($fiche) }}
                            </a></td>
                            <td class="td-actions ">
                                <a href="{{ url('/livraison/show', $livraison) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Voir la fiche ">
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
