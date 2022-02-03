@extends('2.sih.layout', ['page' => 'La liste des directions', 'pageSlug' => 'admin'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="over-title ">La liste des directions </h3>

            <a href="newdir" class="btn  btn-primary  fw-bold">Nouvelle Direction</a>

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
                    <th scope="col">sigle</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @foreach ($directions as $key => $direction)
                        <tr>
                            <td>{{ $directions->firstItem() + $key }}</td>
                            <td>{{ $direction->nom }}</td>
                            <td>{{ $direction->sigle }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/admin/dirshow', $direction) }}" class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Show Direction">
                                    <i class="fas fa-search"></i>
                                </a>
                                <a href="{{ url('/admin/diredit', $direction) }}" class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Edit Direction">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/admin/dirdelete', $direction) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn " data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Delete Direction"
                                        onclick="confirm('Etes vous sûr de supprimer la direction ?.') ? this.parentElement.submit() : ''">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $directions->links() }}
        </div>
    </div>

@endsection
