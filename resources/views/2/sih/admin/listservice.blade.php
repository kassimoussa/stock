@php
use App\Models\Direction;
@endphp
@extends('2.sih.layout', ['page' => 'La liste des services', 'pageSlug' => 'admin'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="over-title ">La liste des services </h3>

            <a href="newservice" class="btn  btn-primary  fw-bold">Nouveau Service</a>

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
                                <a href="{{ url('/admin/serviceedit', $service) }}" class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Edit Service">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/admin/servicedelete', $service) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn " data-bs-toggle="tooltip"
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
