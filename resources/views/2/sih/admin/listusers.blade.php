@extends('2.sih.layout', ['page' => 'Liste des utilisateurs', 'pageSlug' => 'admin'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between ">
            <h3 class="over-title mb-2">La liste des utilisateurs </h3>

            <a href="newuser" class="btn  btn-primary  fw-bold">Nouvelle Utilisateur</a>

        </div>

        <div class="d-flex justify-content-start mb-2">
            <form action="" class="col-md-6">
                <div class="input-group  mb-3">
                    <button class="btn btn-dark" type="submit">Chercher</button>
                    <input type="text" class="form-control " name="search"
                        placeholder="Par nom, direction ou service " value="{{ $search }}">
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
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Service</th>
                    <th scope="col">Level</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->direction }}</td>
                            <td>{{ $user->service }}</td>
                            <td>{{ $user->level }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/admin/useredit', $user) }}" class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/admin/userdelete', $user) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn " data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Delete User"
                                        onclick="confirm('Etes vous sûr de supprimer le user ?.') ? this.parentElement.submit() : ''">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>

@endsection
