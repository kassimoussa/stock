<div class="card mat">
                <div class="card-title2">
                    <h2>Sur le materiel </h2>
                </div>

                <div class="container">
                    <table>
                        <tbody>
                            <tr>
                                <td class="tt">Materiel &nbsp;</td>
                                <td class="tc"> {{ $intervention->materiel }}</td>
                            </tr>
                            <tr>
                                <td class="tt">Model &nbsp;</td>
                                <td class="tc"> {{ $intervention->model }}</td>
                            </tr>
                            <tr>
                                <td class="tt">Réf patrimoine &nbsp;</td>
                                <td class="tc"> {{ $intervention->ref_patrimoine }}</td>
                            </tr>
                            <tr>
                                <td class="tt">Date d'acquisition &nbsp;</td>
                                <td class="tc">
                                    {{ date('d/m/Y', strtotime($intervention->date_acquisition)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card proprio">
                <div class="card-title2">
                    <h2>Sur le demandeur </h2>
                </div>

                <div class="container">
                    <table>
                        <tbody>
                            <tr>
                                <td class="tt">Propriétaire &nbsp;</td>
                                <td class="tc"> {{ $intervention->nom_demandeur }}</td>
                            </tr>
                            <tr>
                                <td class="tt">Direction &nbsp;</td>
                                <td class="tc"> {{ $intervention->dir_demandeur }}</td>
                            </tr>
                            <tr>
                                <td class="tt">Service &nbsp;</td>
                                <td class="tc"> {{ $intervention->service_demandeur }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>