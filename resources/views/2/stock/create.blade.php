@extends('2.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')
    <br><br>
    <div class="mb-5">

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

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="fw-bold">Nouveau Matériel</h3>
                <a href="{{ url('/stocks') }}" class="btn btn-primary fw-bold"> <i class="fas fa-arrow-left"></i>
                    RETOURNER</a>
            </div>

            <div class="card-body">
                <form action="/stocks/store" role="form" method="post" class="form-card">
                    @csrf
                    <div class="field_wrapper col mb-2">

                        <div class="input-group">
                            <a class="input-group-text icon add_button" onclick="addInput()">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            {{-- <input type="text" class="form-control" name="nom_materiel[]" placeholder="Nom du Materiel" > --}}
                            <input type="text" class="form-control" name="nom_materiel[]" placeholder="Nom du matériel"
                                required>
                            <input type="text" class="form-control" name="quantite[]" placeholder="Quantité"
                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                    <div class="row" style="text-align: center; margin-top: 2%;">
                        <div class=" form-group">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold">Ajouter</button>
                            <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        function addInput() {
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML =
                    "<div class='input-group'><a class='input-group-text icon remove_button' onclick='removeInput()'><i class='fa fa-minus' aria-hidden='true'></i></a><input type='text' class='form-control' name='nom_materiel[]'' placeholder='Nom du matériel' required ><input type='number' class='form-control' name='quantite[]' placeholder='Quantité' required ></div>"; //New input field html 
                var x = 1; //Initial field counter is 1

                //Once add button is clicked

                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }


                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        }
    </script>
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
