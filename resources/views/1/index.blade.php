@extends('1.layout', ['page' => 'Accueil', 'pageSlug' => 'index'])
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

        @if (session('service') == 'IT HelpDesk')
            <div class="col-sm-4 mt-4">
                <div class="card border-primary rounded text-center bg-white">
                    <div class="card-body">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-square fa-stack-2x blciel"> </i>
                            <i class="fas fa-tools fa-stack-1x dore"> </i>
                        </span>
                        <h2 class="card-title">Intervention </h2>

                        <p class="cl-effect-1">
                            <a href="/intervention">
                                Fiche d'intervention
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
        @endif


    </div>
@endsection
