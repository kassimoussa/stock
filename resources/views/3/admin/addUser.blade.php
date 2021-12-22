@extends('3.layout', ['page' => 'Nouveau Utilisateur', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
    <div class="d-flex justify-content-start">
        <div class="card" >
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Nouveau Utilisateur</h3>
                <a href="showuser" class="btn btn-primary fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
            </div>

            <div class="card-body">
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
                <form action="adduser" role="form" method="post" class="form-card">
                    @csrf
                    <div class="row ">
                        <div class="form-group mb-2">
                            <label for="name" class="h4">Level</label>
                            <select name="level" class="form-control">
                                <option value="1">1 - Technicien</option>
                                <option value="2">2 - Chef de service</option>
                                <option value="3">3 - Chef de division</option>
                                <option value="4">4 - Directeur</option>
                            </select>
                            <span class="text-danger">@error('level') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group control-label mb-2">
                            <label class="control-label">Direction </label>
                            <select class="form-select" name="direction" >
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction['sigle'] }}">{{ $direction['nom'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group control-label mb-2">
                            <label class="control-label">Nom </label>
                            <input type="text" class="form-control" name="name" placeholder=" Entrer votre nom " value="{{ old('email') }}"
                                required>
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email" class="h5">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Entrer votre email"
                                value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="password" class="h5">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe"
                                value="{{ old('password') }}">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="row" style="text-align: center; margin-top: 2%;">
                        <div class=" form-group">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Ajouter</button>
                            <button type="reset" class="btn btn-default fw-bold">Annuler</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

    </style>

@endsection
