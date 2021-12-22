@extends('2.layout', ['page' => 'Fiches d\'Acquisitions', 'pageSlug' => 'acquisition'])
@section('content')

<div class="row  py-3 px-3">
    <div class="d-flex justify-content-between mb-2">
        <h3 class="over-title ">Fiches d'acquisiton  </h3>

        <select name="option" id="list"  class=" col-md-2 form-group float-end mb-2 ">
            <option value="1" ><a href="">Nouvelles </a> </option>
            <option value="2" ><a href="">Validées par la Direction </a></option>
            <option value="3" ><a href="">Validées par la DSI </a></option>
        </select>
    </div>

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

    <div id="div1">
        <h4 class="fw-bold">Les Fiches d'Acquisition à valider par la {{ session('dir') }}</h4>
        <table class="table tablesorter " id="">
            <thead class=" text-primary">
                <th scope="col">N° Fiche</th>
                <th scope="col">Service</th>
                <th scope="col">Materiel</th>
                <th scope="col">Date de soumission</th>
            </thead>
            <tbody>
                @if (!empty($acquisitions1) && $acquisitions1->count())
                @php
                        $cnt = 1;
                    @endphp

                @foreach ($acquisitions1 as $key => $acquisition)
                    <tr>
                        <td>{{ $acquisition->id }}</td>
                        <td>{{ $acquisition->service_demandeur }}</td>
                        <td>{{ $acquisition->nom_mat }}</td>
                        <td>{{ date('d/m/Y à H:i:s', strtotime($acquisition->date_submit)) }}</td>
                        <td class="td-actions ">
                            <a href="{{ url('/acquisition/fiche', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Voir la fiche">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ url('/acquisition/edit', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Modifier la fiche">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @php
                    $cnt = $cnt +1;
                @endphp
                @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $acquisitions1->links() }}
    </div>
    <div id="div2" style="display:none">
        <h4 class="fw-bold">Les  Fiches d'acquisition validées par la {{ session('dir') }}</h4>
        <table class="table tablesorter " id="">
            <thead class=" text-primary">
                <th scope="col">N° Fiche</th>
                <th scope="col">Service</th>
                <th scope="col">Materiel</th>
                <th scope="col">Date de soumission</th>
            </thead>
            <tbody>
                @if (!empty($acquisitions2) && $acquisitions2->count())
                @php
                        $cnt = 1;
                    @endphp

                @foreach ($acquisitions2 as $key => $acquisition)
                    <tr>
                        <td>{{ $acquisition->id }}</td>
                        <td>{{ $acquisition->service_demandeur }}</td>
                        <td>{{ $acquisition->nom_mat }}</td>
                        <td>{{ date('d/m/Y à H:i:s', strtotime($acquisition->date_submit)) }}</td>
                        <td class="td-actions ">
                            <a href="{{ url('/acquisition/fiche', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Voir la fiche">
                                <i class="fas fa-eye"></i>
                            </a>
                            {{-- <a href="{{ url('/acquisition/edit', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Modifier la fiche">
                                <i class="fas fa-edit"></i>
                            </a> --}}
                        </td>
                    </tr>
                    @php
                    $cnt = $cnt +1;
                @endphp
                @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $acquisitions2->links() }}
    </div>

    <div id="div3" style="display:none">
        <h4 class="fw-bold">Les Fiches d'acquisition validées par la DSI</h4>
        <table class="table tablesorter " id="">
            <thead class=" text-primary">
                <th scope="col">N° Fiche</th>
                <th scope="col">Service</th>
                <th scope="col">Materiel</th>
                <th scope="col">Date de soumission</th>
            </thead>
            <tbody>
                @if (!empty($acquisitions3) && $acquisitions3->count())
                @php
                        $cnt = 1;
                    @endphp

                @foreach ($acquisitions3 as $key => $acquisition)
                    <tr>
                        <td>{{ $acquisition->id }}</td>
                        <td>{{ $acquisition->service_demandeur }}</td>
                        <td>{{ $acquisition->nom_mat }}</td>
                        <td>{{ date('d/m/Y à H:i:s', strtotime($acquisition->date_submit)) }}</td>
                        <td class="td-actions ">
                            <a href="{{ url('/acquisition/fiche', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Voir la fiche">
                                <i class="fas fa-eye"></i>
                            </a>
                            {{-- <a href="{{ url('/acquisition/edit', $acquisition) }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Modifier la fiche">
                                <i class="fas fa-edit"></i>
                            </a> --}}
                        </td>
                    </tr>
                    @php
                    $cnt = $cnt +1;
                @endphp
                @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $acquisitions3->links() }}
    </div>
</div>

<script>  
    $(document).ready(function(){
        $('#list').on('change', function() {
          if ( this.value == '1')
          {
            $("#div1").show();
            $("#div2").hide();
            $("#div3").hide();
          }
          if ( this.value == '2')
          {
            $("#div2").show();
            $("#div1").hide();
            $("#div3").hide();
          }
          if ( this.value == '3')
          {
            $("#div3").show();
            $("#div1").hide();
            $("#div2").hide();
          }
        });
    });
</script>

@endsection
