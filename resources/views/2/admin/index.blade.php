@extends('2.layout', ['page' => 'Administration', 'pageSlug' => 'admin'])
@section('content')
<br> <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-user fa-stack-1x dore"></i>
                    </span>
                    <h2 class="StepTitle card-title">Utilisateurs</h2>
                    <p class="cl-effect-1">
                        <a href="/admin/showuser">
                            liste des Utilisateurs
                        </a>
                    </p>
                </div>
            </div> 
        </div>
        <div class="col-sm-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-plus-square fa-stack-1x dore"></i>
                    </span>
                    <h2 class="card-title">Directions</h2>

                    <p class="cl-effect-1">
                        <a href="/admin/showdirections">
                             Liste des Directions 
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-square fa-stack-2x blciel"></i>
                        <i class="fa fa-plus-circle fa-stack-1x dore"></i>
                    </span>
                    <h2 class="card-title">Services</h2>

                    <p class="cl-effect-1">
                        <a href="/admin/showservices">
                            Liste des Services 
                        </a>
                    </p>
                </div>
            </div>
        </div>
        

    </div>
@endsection