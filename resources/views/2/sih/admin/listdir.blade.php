@extends('2.sih.layout', ['page' => 'La liste des directions', 'pageSlug' => 'admin'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between ">
            <h3 class="over-title mb-2">La liste des directions </h3>

            <a href="newdir" class="btn  btn-primary  fw-bold">New Direction</a>

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
            <table class="table tablesorter " id="">
                <thead class=" text-primary">
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
                                <a href="{{ url('/admin/dirshow', $direction) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Show Direction">
                                    <i class="fas fa-search"></i>
                                </a>
                                <a href="{{ url('/admin/diredit', $direction) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Edit Direction">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/admin/dirdelete', $direction) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
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
