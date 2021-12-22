@extends('2.sih.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')
<br><br>
    <div class="d-flex justify-content-start">
        <div class="col-md-12">
           <div class="card" >
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Nouveau Matériel</h3>
                <a href="{{ url('/stocks') }}" class="btn btn-primary fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
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
                <form action="store" role="form" method="post" class="form-card">
                    @csrf
                    <div class="row ">
                        <div class="form-group mb-2">
                            <label for="materiel" class="h5">Matériel</label>
                            <input type="text" class="form-control" name="materiel" placeholder="Taper le nom du materiel"
                                value="{{ old('materiel') }}">
                            <span class="text-danger">@error('materiel') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="quantite" class="h5">Quantité</label>
                            <input type="text" class="form-control" name="quantite" placeholder="taper la quantité"
                                value="{{ old('quantite') }}">
                            <span class="text-danger">@error('quantite') {{ $message }} @enderror</span>
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
        

    </div>

    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

        .btn-primary {
            color: white;
        }

        

    </style>

@endsection
