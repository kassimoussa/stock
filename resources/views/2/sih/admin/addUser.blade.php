@extends('2.sih.layout', ['page' => 'Nouveau Utilisateur', 'pageSlug' => 'admin'])
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
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Level</span> 
                            <select name="level" class="form-control" id="level">
                                <option value="1">1 - Technicien</option>
                                <option value="2">2 - Chef de service</option>
                                <option value="3">3 - Chef de division</option>
                                <option value="4">4 - Directeur</option>
                            </select>
                            <span class="text-danger">@error('level') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Direction</span> 
                            <select class="form-select" name="direction" id="dir" >
                                <option value="" disabled selected>Select direction</option>
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction['sigle'] }}">{{ $direction['nom'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Service</span>  
                            <select name="service" id="serv" class="form-select  js-select2">
                                <option value="" disabled selected>Select service</option>
                            </select>
                            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Nom</span> 
                            <input type="text" class="form-control" name="name" placeholder=" Entrer votre nom " value="{{ old('email') }}"
                                required>
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
                            <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe"
                            value="{{ old('password') }}">
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
        </div>

    </div>

     <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

        .btn-primary {
            background: #f7f7f7;
            color: black;
        }

        .card-header {
            background: #4F81BD;
            color: white;
        }
        .txt {
            width: 17%;
        }

    </style>
    <script>
        $('#level').change(function() {

            var level = $(this).val();

            if (level == '4' || level == '3' ) {
                document.getElementById("serv").disabled = true; 
            } else {
                document.getElementById("serv").disabled = false; 
            }
        });
    </script>

<script>
    $('#dir').change(function() {

        var directionID = $(this).val();

        if (directionID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getServices') }}?dir_id=" + directionID,
                success: function(res) {

                    if (res) {

                        $("#serv").empty();
                        $("#serv").append('<option>Select Service</option>');
                        $.each(res, function(key, value) {
                            $("#serv").append('<option value="' + value + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#serv").empty();
                    }
                }
            });
        } else {

            $("#serv").empty();
        }
    });
</script>

@endsection
