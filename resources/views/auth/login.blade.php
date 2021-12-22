<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Login</title>

    <style>
        body{
            background: url(bgHome.gif) center center fixed #ffffff no-repeat;
	background-size: cover;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight:300;
	text-align: center;
	text-decoration: none;
	margin: 0 0 0 0;
        }
        .card-header{
            background: white;
        }
        
        .icon{
            width: 7%;
            background-color: #002565;
            color: gold;
        }
        .icon:hover{
            width: 7%;
            background-color: gold;
            color: #002565;
        }
        .btn{
            background-color: #002565;
            color: gold;
        }
        .btn:hover{
            background-color: gold;
            color: #002565;
        }
    </style>
</head>

<body>
    <div class="container" >
        <h1 class="mt-3 fw-bold text-center" style="color: #002565 ">Gestion des Stock</h1>
            <div class=" d-flex justify-content-center align-content-center " style="margin-top: 10%;" >
                <div class="col-sm-6">
                    {{-- <h4 class="fw-bold">Connexion</h4>
                    <hr> --}}
                    @if ($message = Session::get('fail'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center ">
                        <img src="{{ asset('dtlogo.png') }}" alt="">
                    </div>
                    <div class="card-body">
                       <form action="{{ route('check') }}" method="POST">
                        @csrf

                        <div class="input-group mb-2">
                            <span class="input-group-text fw-bold icon"><i class="fas fa-at" ></i></span>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Taper votre email">
                            <span  class="invalid-feedback">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text fw-bold icon"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Taper votre mot de passe">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label for="email" class="h5">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Taper votre email">
                            <span  class="invalid-feedback">@error('email') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="h5" >Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Taper votre mot de passe">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>

                        </div> --}}
                        <div class="form-group mb-2 d-grid">
                            <button type="submit" class="btn   fw-bold">SE CONNECTER</button>
                        </div>
                        <div class="d-flex justify-content-between">
                         <a href="register" >Ajouter un utilisateur</a>   
                         <a href="forgot" >Mot de passe ouoblié ?</a> 
                        </div>
                        
                    </form> 
                    </div>
                    
                </div>
                    
                </div>
            </div>
    </div>
</body>

</html>
