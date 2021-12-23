@php
use App\Models\Direction;
@endphp
@extends('2.sih.layout', ['page' => 'La liste des services', 'pageSlug' => 'admin'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between ">
            <h3 class="over-title mb-2">La liste des services </h3>

            <a href="newservice" class="btn  btn-primary  fw-bold">New Services</a>

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
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @foreach ($services as $key => $service)
                    @php
                        $directions = Direction::where('sigle', $service->direction)->first();
                    @endphp
                        <tr>
                            <td>{{ $services->firstItem() + $key }}</td>
                            <td>{{ $service->nom }}</td>
                            <td> {{ $directions->nom }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/serviceedit', $service) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Edit Service">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/servicedelete', $service) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Delete Direction"
                                        onclick="confirm('Etes vous sûr de supprimer le service?') ? this.parentElement.submit() : ''">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $services->links() }}
        </div>
    </div>

@endsection
