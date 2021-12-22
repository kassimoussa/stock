@extends('2.sih.layout', ['page' => 'Accueil', 'pageSlug' => 'index'])
@section('content')
    <div class="row">
        <div class="col-sm-4 mt-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-warehouse fa-stack-1x dore"></i>
                    </span>
                    <h2 class="StepTitle card-title">Stock</h2>
                    <p class="cl-effect-1">
                        <a href="{{ url('/stocks') }}">
                            Voir le Stock
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-laptop fa-stack-1x dore"></i>
                    </span>
                    <h2 class="StepTitle card-title">Acqusition</h2>
                    <p class="cl-effect-1">
                        <a href="{{ url('/acquisition') }}">
                            Fiche d'acquisition
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4 mt-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-tools fa-stack-1x dore"></i>
                    </span>
                    <h2 class="StepTitle card-title">Intervention</h2>
                    <p class="cl-effect-1">
                        <a href="{{ url('/intervention') }}">
                            Fiches d'intervention
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4 mt-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-truck fa-stack-1x dore"></i>
                    </span>
                    <h2 class="card-title">Livraison</h2>

                    <p class="cl-effect-1">
                        <a href="/livraison">
                            Fiche de livraison
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-4 mt-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-truck fa-stack-1x dore"></i>
                    </span>
                    <h2 class="card-title">Administration</h2>

                    <p class="cl-effect-1">
                        <a href="/admin">
                            Admin
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
