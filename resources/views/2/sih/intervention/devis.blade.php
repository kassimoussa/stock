@extends('2.sih.layout', ['page' => 'Ajout devis', 'pageSlug' => 'intervention'])
@section('content')

    <div class="row mt-3">
        <h3 class="fw-bold mt-3">Ajout de devis</h3>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
            <form action="{{ route('adddevis') }}" role="form" method="post" class="form"
                enctype="multipart/form-data">
                @csrf
                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Devis</h4>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">Fournisseur</span>
                            <input type="text" class="form-control" name="fournisseur">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text txt fw-bold ">N° de devis</span>
                            <input type="text" class="form-control" name="numero_devis">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 form-group ">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                                <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                                <input type="text" name="fiche_intervention" value="{{ $intervention->id }}" hidden>
                            </div>
                        </div>
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

        .btn-primary {
            color: white;
        }

        .card-header {
            background: #4F81BD;
            color: white;
        }

        .txt {
            width: 133px;
        }

    </style>

@endsection
