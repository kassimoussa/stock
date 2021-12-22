@extends('3.layout', ['page' => 'Modif Direction', 'pageSlug' => 'admin'])
@section('content')
    <br><br>
    <div class="d-flex justify-content-start mb-5">
        <div class="card" style="width: 100%;">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Modif Direction</h3>
                <a href="{{ url('/showdirections')  }}" class="btn btn-primary  fw-bold"> <i class="fas fa-arrow-left"></i> RETOURNER</a>
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
                <form action="{{ url('/updatedir', $direction) }}" role="form" method="post" class="form-card">
                    @csrf
                    @method('PUT')
                    <div class="row ">

                        <div class=" mb-2 ">
                            <div class="form-group control-label">
                                <label class="control-label">Nom </label>
                                <input type="text" class="form-control" name="nom" placeholder=" Nom de la direction" value="{{ $direction->nom }}"
                                    required>
                            </div>
                        </div>
                        <div class=" mb-2">
                            <div class="form-group control-label">
                                <label class="control-label">Sigle </label>
                                <input type="text" class="form-control" name="sigle" placeholder="Sigle de la direction"
                                    value="{{ $direction->sigle }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align: center; margin-top: 2%;">
                        <div class=" form-group">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifier</button>
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
