@extends('2.layout', ['page' => 'Profile', 'pageSlug' => 'profile'])
@section('content')
<br>
<div class="d-flex justify-content-start">
    <div class="card" style="width: 60%;">
        <h3 class="card-header fw-bold">Profile</h3>

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
            <form action="changeprofile" role="form" method="post" class="form-card">
                @csrf
                @method('PUT')

                <div class="row mb-2">

                    <div class="  mb-2 ">
                        <div class="form-group control-label">
                            <label class="control-label">Nom </label>
                            <input type="text" class="form-control" name="name" placeholder="" value="{{ $user->name }}"
                                required>
                        </div>
                    </div>
                    <div class=" mb-2">
                        <div class="form-group control-label">
                            <label class="control-label">Email </label>
                            <input type="text" class="form-control" name="email" placeholder=""
                                value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="  mb-2">
                        <div class="form-group control-label">
                            <label class="control-label">Password </label>
                            <input type="password" class="form-control" name="password" placeholder=""
                                value="{{ $user->password }}" required>
                        </div>
                    </div>
                </div>


                <div class="row" style="text-align: center; margin-top: 2%;">
                    <div class=" form-group">
                        <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifer</button>
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
