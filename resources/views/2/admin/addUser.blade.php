@extends('2.layout', ['page' => 'Nouveau Utilisateur', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
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

   
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Nouveau Utilisateur</h3>
                <a href="showuser" class="btn btn-primary fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
            </div>



            <div class="card-body">
                <form action="/admin/storeuser" role="form" method="post" class="form-card">
                    @csrf
                    <div class="row "> 
                        <div class="input-group mb-1">
                            <span class="input-group-text txt fw-bold ">Nom</span>
                            <input type="text" class="form-control" name="name" placeholder=" Entrer votre nom "
                                value="{{ old('email') }}" required>
                        </div>
                        <span class="text-danger mb-1">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group mb-1">
                            <span class="input-group-text txt fw-bold ">Email</span>
                            <input type="email" class="form-control" name="email" placeholder="Entrer votre email"
                                value="{{ old('email') }}">
                        </div>
                        <span class="text-danger mb-1">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group mb-1">
                            <span class="input-group-text txt fw-bold ">Password</span>
                            <input type="password" class="form-control" name="password"
                                placeholder="Entrer votre mot de passe" value="{{ old('password') }}">
                            
                        </div>
                        <span class="text-danger mb-1">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="row" style="text-align: center; margin-top: 2%;">
                        <div class=" form-group">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Ajouter</button>
                            <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>


    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

      /*   .btn-primary {
            background: #f7f7f7;
            color: black;
        }

        .card-header {
            background: #4F81BD;
            color: white;
        } */

        .txt {
            width: 17%;
        }
    </style> 
@endsection
