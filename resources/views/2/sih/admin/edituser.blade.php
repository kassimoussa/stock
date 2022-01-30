@extends('2.sih.layout', ['page' => 'Modif Utilisateu', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
    <div class="d-flex justify-content-start mb-5">
        <div class="card" style="width: 100%;">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Modif Utilisateur</h3>
                <a href="/admin/showuser" class="btn btn-primary  fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
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


            <div class="card-body">
                <form action="{{ url('/admin/updateuser', $user) }}" role="form" method="post" class="form-card">
                    @csrf
                    @method('PUT')
                    <div class="row ">
                        @php
                            $disa = '';
                            if($user->level == '3' || $user->level == '4') {
                                $disa = 'disabled';
                            }
                        @endphp

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Level</span>  
                            <select name="level" class="form-control" disabled>
                                <option value="1" @if ($user->level == '1') {{ 'selected' }} @endif>1</option>
                                <option value="2" @if ($user->level == '2') {{ 'selected' }} @endif>2</option>
                                <option value="3" @if ($user->level == '3') {{ 'selected' }} @endif>3</option>
                                <option value="4" @if ($user->level == '4') {{ 'selected' }} @endif>4</option>
                            </select>
                            <span class="text-danger">@error('level') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Direction</span>  
                            <select class="form-select" name="direction" id="direction">
                                @foreach ($directions as $direction)
                                    @if ($direction['sigle'] == old('document') or $direction['sigle'] == $user->direction)
                                        <option value="{{ $direction['sigle'] }}" selected>{{ $direction['nom'] }}
                                        </option>
                                    @else
                                        <option value="{{ $direction['sigle'] }}">{{ $direction['nom'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Service</span>   
                            <select name="service" id="serv" class="form-select js-select2 " {{ $disa }}>
                                <option value="{{ $user->service }}" >
                                    {{ $user->service }}</option>
                            </select>
                            <span class="text-danger">@error('service') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Nom</span>  
                            <input type="text" class="form-control" name="name" placeholder=" Entrer votre nom "
                                value="{{ $user->name }}" required>
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Email</span> 
                            <input type="email" class="form-control" name="email" placeholder="Entrer votre email"
                                value="{{ $user->email }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Password</span> 
                            <input type="password" class="form-control" name="password"
                                placeholder="Entrer votre mot de passe" value="{{ $user->password }}">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
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

        .btn-primary { 
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
        $('#direction').change(function() {

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
