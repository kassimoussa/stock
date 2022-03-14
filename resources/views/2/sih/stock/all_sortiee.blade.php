@extends('2.sih.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')

    <div class="row mt-3"> 

        <div class="d-flex justify-content-between mt-3 mb-4">
            <h3 class="over-title mb-2">Sortie des materiels <span class="text-bold" id="title"> </span>
            </h3>

            <form action="allsortieby" method="post">
                @csrf
                <select name="annee" id="list" onchange="this.form.submit()" class="  form-group float-end mb-2 ">
                    <option disabled="disabled">Choisir une année</option>
                    <option selected="true" value="ALL" @if ('ALL' == $annee) selected="selected" @endif>Tout
                    </option>
                    <option value="2021" @if ('2021' == $annee) selected="selected" @endif>2021 </option>
                    <option value="2022" @if ('2022' == $annee) selected="selected" @endif>2022 </option>
                    <option value="2023" @if ('2023' == $annee) selected="selected" @endif>2023 </option>
                    <option value="2024" @if ('2024' == $annee) selected="selected" @endif>2024 </option>

                </select>
            </form>

        </div> 
        <br>

        <div class="card mb-4 ccal ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="sortiees" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="#janvier" role="tab" aria-controls="janvier"
                            aria-selected="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[1] }}">Janvier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#fevrier" role="tab" aria-controls="fevrier"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[2] }}">Février</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#mars" role="tab" aria-controls="mars"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[3] }}">Mars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#avril" role="tab" aria-controls="avril"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[4] }}">Avril</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#mai" role="tab" aria-controls="mai"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[5] }}">Mai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#juin" role="tab" aria-controls="juin"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[6] }}">Juin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#juillet" role="tab" aria-controls="juillet"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[7] }}">Juillet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#aout" role="tab" aria-controls="aout"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[8] }}">Août</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#septembre" role="tab" aria-controls="septembre"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[9] }}">Septembre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#octobre" role="tab" aria-controls="octobre"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[10] }}">Octobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#novembre" role="tab" aria-controls="novembre"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[11] }}">Novembre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#decembre" role="tab" aria-controls="decembre"
                            aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Total = {{ $sorties[12] }}">Décembre</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="janvier" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($janvier) && $janvier->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($janvier as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="fevrier" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($fevrier) && $fevrier->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($fevrier as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="mars" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($mars) && $mars->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($mars as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="avril" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($avril) && $avril->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($avril as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="mai" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($mai) && $mai->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($mai as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="juin" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($juin) && $juin->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($juin as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="juillet" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($juillet) && $juillet->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($juillet as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="aout" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($aout) && $aout->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($aout as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="septembre" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($septembre) && $septembre->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($septembre as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="octobre" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($octobre) && $octobre->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($octobre as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane " id="novembre" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($novembre) && $novembre->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($novembre as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane " id="decembre" role="tabpanel">  
                        <div class=" ">  
                            <table class="table table-bordered border-dark table-sm table-hover" id="">
                                <thead class="  table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Marteriel</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Raison</th>
                                    <th scope="col">Date</th>
                                </thead>
                                <tbody>
                                    @if (!empty($decembre) && $decembre->count())
                                        @php
                                            $cnt = 1;
                                        @endphp
                
                                        @foreach ($decembre as $key => $sortie)
                                            <tr>
                                                <td>{{ $cnt }}</td>
                                                <td>{{ $sortie->materiel }}</td>
                                                <td>{{ $sortie->quantite }}</td>
                                                <td>
                                                    @if ($sortie->raison == 'livraison')
                                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir la fiche de livraison  ">
                                                            {{ ucfirst($sortie->raison) }}</i>
                                                        </a>
                                                    @else
                                                        {{ ucfirst($sortie->raison) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                                            </tr>
                                            @php
                                                $cnt = $cnt + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>


 
 
                </div>
            </div>
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

        .txt {
            width: 150px;
            background: lavender;
        }

        .iput {
            background: white !important;
        }

        .cbox {}

    </style>

<script>
    $('#sortiees a').on('click', function(e) {
        e.preventDefault()
        $(this).tab('show')
    }); 
</script>
@endsection
