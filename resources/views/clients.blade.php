@extends('template')
@section('content')
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Gestion des clients</h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Page</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <button type="button" class="btn btn-primary mx-4" data-toggle="modal"
                data-target=".bd-example-modal-lg">Ajouter un
                client</button>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mx-auto text-dark">Informations Personnelles</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-validation">
                                <form class="form-valide" action="/client" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-form-label " for="val-username">Nom & Prénoms<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase" id="val-username"
                                                    name="nom_prenoms" placeholder="nom et prénoms" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-form-label " for="val-username">Téléphone<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase" id="val-username"
                                                    name="tel" placeholder="52747455" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label class="col-form-label" for="val-skill">Genre <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <select class="form-control" id="val-skill" name="genre">
                                                    @foreach (['M', 'F'] as $genreValue)
                                                        <option value="{{ $genreValue }}">{{ $genreValue }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-form-label" for="val-email">Date de naissance<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="date" class="form-control text-capitalize" id="val-email"
                                                    name="anniv" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label class="col-form-label" for="val-password">Profession <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-capitalize" id="val-password"
                                                    name="profession" placeholder="Entrer la profession" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label class="col-form-label" for="val-password">Zone de résidence <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-capitalize" id="val-password"
                                                    name="residence" placeholder="Entrer la zone" required>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>

                                    <div class="form-group my-2">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nom et Prénoms</th>
                                        <th>Tel</th>
                                        <th>Profession</th>
                                        <th>Zone de résidence</th>
                                        <th>Sexe</th>
                                        <th>Anniversaire</th>
                                        <th>Détails</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td class="text-capitalize"> {{ $client->nom_prenoms }} </td>
                                            <td>{{ $client->tel }}</td>
                                            <td class="text-capitalize">{{ $client->profession }}</td>
                                            <td class="text-capitalize">{{ $client->residence }}</td>
                                            <td>{{ $client->genre }}</td>
                                            <td class="text-capitalize">
                                                {{ \Carbon\Carbon::parse($client->anniv)->locale('fr_FR')->isoFormat('DD MMMM YYYY') }}
                                                --
                                                @php
                                                    $anniversaire = \Carbon\Carbon::parse($client->anniv);
                                                    $dateActuelle = \Carbon\Carbon::now();
                                                    $prochainAnniversaire = $anniversaire
                                                        ->copy()
                                                        ->year($dateActuelle->year);
                                                    if ($prochainAnniversaire->lt($dateActuelle)) {
                                                        $prochainAnniversaire->addYear();
                                                    }
                                                    $joursRestants = $dateActuelle->diffInDays($prochainAnniversaire);
                                                @endphp
                                                {{ $joursRestants  }} jours
                                            </td>
                                            <td>
                                                <ul class="py-0  d-flex justify-content-center ">

                                                    <li class="py-0 mr-4"><a href="javascript:void()" data-toggle="modal"
                                                            data-target=".bd-example-modal-l{{ $client->id }}"
                                                            class="text-primary "><i
                                                                class="fa fa-pencil color-muted mx-2"></i>Edit</a></li>

                                                    <li class="py-0"><a href="delete-client/{{ $client->id }}"
                                                            class="text-danger"><i
                                                                class="fa fa-trash color-muted mx-2"></i>Delete</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="footer">
                    <p>2018 © Admin Board. - <a href="#">example.com</a></p>
                </div>
            </div>
        </div>

        @foreach ($clients as $client)
            <div class="modal fade bd-example-modal-l{{ $client->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h3 class="mx-auto text-dark">Informations Personnelles</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-validation">
                                <form class="form-valide" action="/update-client/{{ $client->id }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-form-label " for="val-username">Nom & Prénoms<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase"
                                                    id="val-username" name="nom_prenoms"
                                                    value="{{ $client->nom_prenoms }}" placeholder="nom et prénoms"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-form-label " for="val-username">Téléphone<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase"
                                                    id="val-username" name="tel" value="{{ $client->tel }}"
                                                    placeholder="52747455" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label class="col-form-label" for="val-skill">Genre <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <select class="form-control" id="val-skill" name="genre">
                                                    @foreach (['M', 'F'] as $genreValue)
                                                        <option value="{{ $genreValue }}"
                                                            {{ $client->genre == $genreValue ? 'selected' : ' ' }}>
                                                            {{ $genreValue }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-form-label" for="val-email">Date de naissance<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="date" class="form-control text-capitalize" id="val-email"
                                                    name="anniv" value="{{ $client->anniv }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label class="col-form-label" for="val-password">Profession <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-capitalize"
                                                    id="val-password" name="profession"
                                                    value="{{ $client->profession }}" placeholder="Entrer la profession"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label class="col-form-label" for="val-password">Zone de résidence <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-capitalize"
                                                    id="val-password" name="residence" value="{{ $client->residence }}"
                                                    placeholder="Entrer la zone" required>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>

                                    <div class="form-group my-2">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>
@endsection
