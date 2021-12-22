@extends('4.layout', ['page' => 'Fiche Intervention', 'pageSlug' => 'intervention'])
@section('content')
    <br>
    <div class="container ">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="over-title ">FICHE D'INTERVENTION </h3>
            <a href="/intervention" class="btn  btn-primary  fw-bold">RETOURNER</a>
        </div>

        <div class="card  mb-3">
            <h4 class="card-header text-center">Technicien</h4>

            <div class="card-body">
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold ">Nom</span>
                    <label class="form-control">{{ $intervention->nom_intervenant }} </label>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Diagnostique</span>
                    <label class="form-control">{{ $intervention->diagnostique }} </label>
                </div>
            </div>
        </div>

        <div class="card  mb-3">
            <h4 class="card-header text-center">Demandeur</h4>

            <div class="card-body">
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold ">Nom</span>
                    <label class="form-control">{{ $intervention->nom_intervenant }} </label>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Service</span>
                    <label class="form-control">{{ $intervention->service_demandeur }} </label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Materiel</span>
                    <label class="form-control">{{ $intervention->materiel }} </label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Model</span>
                    <label class="form-control">{{ $intervention->model }} </label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Date d'acquisition</span>
                    <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_acquisition)) }} </label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text fw-bold">Commentaire</span>
                    <label class="form-control">{{ $intervention->commentaire }} </label>
                </div>
            </div>
        </div>

        <div class="card  mb-3">
            <h4 class="card-header text-center">Chef du SIH</h4>

            <div class="card-body">
                <form action="{{ url('/intervention/suggestion', $intervention) }}" role="form" method="post"
                    class="form">
                    @csrf
                    @method("PUT")

                    @if ($intervention->suggestion == null)
                    <div class="input-group mb-3">
                        <span class="input-group-text fw-bold">Suggestion</span>
                        <textarea name="suggestion" class="form-control" cols="30" rows="2"></textarea>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-12 form-group text-center">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                            <input type="text" name="date_suggestion" value="{{ date('Y-m-d H:i:s') }}" hidden>
                        </div>
                    </div>
                    @else
                    <div class="input-group mb-3">
                        <span class="input-group-text fw-bold">Suggestion</span>
                        <label class="form-control">{{ $intervention->suggestion }} </label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text fw-bold">Date</span>
                        <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_suggestion)) }} </label>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="card  mb-3">
            <h4 class="card-header text-center">Directeur</h4>

            <div class="card-body">
                @if ($intervention->avis != null)
                    <div class="input-group mb-3">
                        <span class="input-group-text fw-bold">avis</span>
                        <label class="form-control">{{ $intervention->avis }} </label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text fw-bold">Date</span>
                        <label class="form-control">{{ date('d/m/Y', strtotime($intervention->date_avis)) }} </label>
                    </div>
                @else
                <div class="alert alert-danger">
                    <h3 class="fw-bold"> Le directeur n'a pas encore vu cette fiche</h3>
                </div>   
                @endif
            </div>
        </div>

    </div>
    <style>
        .card-header {
            background: #4F81BD;
            color: white;
        }

        .input-group-text {
            width: 13%;
        }

    </style>
@endsection
