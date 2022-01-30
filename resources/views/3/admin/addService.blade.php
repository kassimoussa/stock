@extends('2.sih.layout', ['page' => 'Nouveau Service', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
    <div class="d-flex justify-content-start">
        <div class="card" style="width: 100%;">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Nouveau Service</h3>
                <a href="/admin/showservices" class="btn btn-primary  fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
            </div>

            <div class="card-body">
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
                <form action="addservice" role="form" method="post" class="form-card">
                    @csrf
                    <div class="row ">

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Nom</span>
                            <input type="text" class="form-control" name="nom" placeholder=" Nom du service" value="{{ old('nom') }}"
                                required>
                                <span class="text-danger">@error('nom') {{ $message }} @enderror</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Direction</span> 
                            <select class="form-select" name="direction" >
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction['sigle'] }}">{{ $direction['nom'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
                        </div>

                    </div>

                    <div class="row" style="text-align: center; margin-top: 2%;">
                        <div class=" form-group">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Ajouter</button>
                            <button type="reset" class="btn btn-outline-danger fw-bold">Annuler</button>

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
            width: 10%;
        }

    </style>

@endsection
