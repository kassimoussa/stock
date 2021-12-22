@extends('4.layout', ['page' => 'Accueil', 'pageSlug' => 'index'])
@section('content')
    <div class="row">
        
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
        
    </div>
@endsection
