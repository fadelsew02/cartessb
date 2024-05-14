@extends('template')
@section('content')
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Gestion des Produits</h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Page</a></li>
                        <li class="breadcrumb-item active">Produits</li>
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
                produit</button>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mx-auto text-dark">Informations Personnelles</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-validation">
                                <form class="form-valide" action="/produit" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label class="col-form-label " for="val-username">Libellé<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase" id="val-username"
                                                    name="libelle" placeholder="Pané" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label class="col-form-label " for="val-username">Prix<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase" id="val-username"
                                                    name="prix" placeholder="1500" required>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>

                                    <div class="form-group my-2">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
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
                                        <th>Pos</th>
                                        <th>Libellé</th>
                                        <th>Prix(fcfa)</th>
                                        <th>Détails</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produits as $key => $produit)
                                        <tr>
                                            <td> {{$key}} </td>
                                            <td class="text-capitalize"> {{ $produit->libelle }} </td>
                                            <td>{{ $produit->prix }}</td>
                                            <td>
                                                <ul class="py-0  d-flex justify-content-center ">

                                                    <li class="py-0 mr-4"><a href="javascript:void()" data-toggle="modal"
                                                            data-target=".bd-example-modal-l{{ $produit->id }}"
                                                            class="text-primary "><i
                                                                class="fa fa-pencil color-muted mx-2"></i>Edit</a></li>

                                                    <li class="py-0"><a href="delete-produit/{{ $produit->id }}"
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

        @foreach ($produits as $produit)
            <div class="modal fade bd-example-modal-l{{ $produit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h3 class="mx-auto text-dark">Informations Personnelles</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-validation">
                                <form class="form-valide" action="/update-produit/{{ $produit->id }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-form-label " for="val-username">Libellé<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase" id="val-username"
                                                    name="libelle" value="{{ $produit->libelle }}"
                                                    placeholder="Pané" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-form-label " for="val-username">Prix<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase"
                                                    id="val-username" name="prix" value="{{ $produit->prix }}"
                                                    placeholder="1500" required>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group my-2">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Modifier</button>
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
