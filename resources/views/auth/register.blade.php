<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Register </title>
</head>

<body>
    <div class="container ">
        <h1 class="mt-3 fw-bold text-center" style="color: #002565 ">Gestion des Stock</h1>
            <div class=" d-flex justify-content-center align-content-center mt-5"  >
                <div class="col-sm-6">
                    <h4 class="fw-bold">Inscription</h4>
                <hr>
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
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <div class="row ">
                        <div class="form-group mb-1 col-md-6">
                            <label for="name" class="control-label h5">Level</label>
                            <select name="level" class="form-control ">
                                <option value=""disabled selected>Selectionner le niveau</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <span class="text-danger">@error('level') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group control-label mb-1 col-md-6">
                            <label class="control-label h5">Direction </label>
                            <select class="form-select" name="direction" >
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction['sigle'] }}">{{ $direction['nom'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group control-label mb-1">
                            <label class="control-label h5">Nom </label>
                            <input type="text" class="form-control" name="name" placeholder=" Entrer votre nom " value="{{ old('email') }}"
                                required>
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="email" class="control-label h5">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Entrer votre email"
                                value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="password" class="control-label h5">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe"
                                value="{{ old('password') }}">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group mb-1 d-grid">
                        <button type="submit" class="btn  btn-primary fw-bold">Ajouter</button>
                    </div>
                    <a href="/">Se connecter </a>
                </form>
            </div>
        </div>


    </div>
    <div class="text-center">
        <h5>

        </h5>
    </div>
</body>

</html>
