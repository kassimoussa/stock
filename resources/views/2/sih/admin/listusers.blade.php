@extends('2.sih.layout', ['page' => 'Liste des utilisateurs', 'pageSlug' => 'admin'])
@section('content')

    <div class="row  py-3 px-3">
        <div class="d-flex justify-content-between ">
            <h3 class="over-title mb-2">La liste des users </h3>

            <a href="newuser" class="btn  btn-primary  fw-bold">New User</a>

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
                                <a href="{{ url('/admin/useredit', $user) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/admin/userdelete', $user) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-link" data-bs-toggle="tooltip"
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
