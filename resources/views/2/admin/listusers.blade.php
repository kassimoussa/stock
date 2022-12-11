@extends('2.layout', ['page' => 'Liste des utilisateurs', 'pageSlug' => 'admin'])
@section('content')
    <div class="row  py-3 px-3">

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

        <div class="d-flex justify-content-between mb-5">
            <h3 class="over-title mb-2">La liste des utilisateurs </h3>

            <a href="/admin/createuser" class="btn  btn-outline-dark  fw-bold">Nouvelle Utilisateur</a>

        </div>

        {{-- <div class="d-flex justify-content-start mb-2">
            <form action="" class="col-md-6">
                <div class="input-group  mb-3">
                    <button class="btn btn-dark" type="submit">Chercher</button>
                    <input type="text" class="form-control " name="search"
                        placeholder="Par nom, direction ou service " value="{{ $search }}">
                </div>
            </form>
        </div> --}}



        {{-- <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Nouveau Utilisateur</h3>
                <a href="showuser" class="btn btn-primary fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
            </div>

            <div class="card-body">
                <form action="adduser" role="form" method="post" class="form-card">
                    @csrf
                    <div class="row "> 

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Nom</span>
                            <input type="text" class="form-control" name="name" placeholder=" Entrer votre nom "
                                value="{{ old('email') }}" required>
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Email</span>
                            <input type="email" class="form-control" name="email" placeholder="Entrer votre email"
                                value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Password</span>
                            <input type="password" class="form-control" name="password"
                                placeholder="Entrer votre mot de passe" value="{{ old('password') }}">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="row" style="text-align: center; margin-top: 2%;">
                        <div class=" form-group">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Ajouter</button>
                            <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>

                        </div>
                    </div>
                </form>
            </div>
        </div> --}}

        <div>
            <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
                <thead class="bg-dark text-white text-center">
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody class="text-center">
                    @php
                        $cnt = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/admin/edituser', $user) }}" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if (session('level') == 2)
                                    <form action="{{ url('/admin/deleteuser', $user) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn " data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Delete User"
                                            onclick="confirm('Etes vous sûr de supprimer le user ?.') ? this.parentElement.submit() : ''">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @php
                            $cnt = $cnt + 1;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
