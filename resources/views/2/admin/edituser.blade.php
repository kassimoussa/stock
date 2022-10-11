@extends('2.layout', ['page' => 'Modif Utilisateu', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
    <div class=" ">

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

        <div class="card" style="width: 100%;">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Modif Utilisateur</h3>
                <a href="/admin/showuser" class="btn btn-primary  fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/updateuser', $user) }}" role="form" method="post" class="form-card">
                    @csrf
                    @method('PUT')
                    <div class="row ">

                        <div class="">
                            <div class="input-group mb-3">
                                <span class="input-group-text txt fw-bold ">Nom</span>
                                <input type="text" class="form-control" name="name" placeholder=" Entrer votre nom "
                                    value="{{ $user->name }}" required>
                                <span class="text-danger">
                            </div>
                            <span class="text-danger mb-1">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="">
                            <div class="input-group mb-3">
                                <span class="input-group-text txt fw-bold ">Email</span>
                                <input type="email" class="form-control" name="email" placeholder="Entrer votre email"
                                    value="{{ $user->email }}">
                            </div>
                            <span class="text-danger mb-1">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="">
                            <div class="input-group mb-3">
                                <span class="input-group-text txt fw-bold ">Password</span>
                                <input type="password" class="form-control" name="password" id="passwd"
                                    placeholder="Entrer votre mot de passe" value="{{ $user->password }}">
                                <button class="input-group-text" type="button" > 
                                    <i class="bi bi-eye-slash " id="togglePassword"></i> </button>
                            </div>
                            <span class="text-danger mb-1">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                    <div class="row" style="text-align: center; margin-top: 2%;">
                        <div class=" form-group">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifier</button>
                            <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>

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

        .txt {
            width: 17%;
        }
    </style>

    <script>
       const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#passwd");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });
    </script>
@endsection
