@extends('template')
@section('content')
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Gestion des commandes</h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Page</a></li>
                        <li class="breadcrumb-item active">Commandes</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <a href="/creer-commande" class="btn btn-primary mx-4">Créer
                une commande</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>N° de carte</th>
                                        <th>Nom & Prénoms</th>
                                        <th>Montant</th>
                                        <th>Achat n°</th>
                                        <th>Produits</th>
                                        <th>Qtes</th>
                                        <th>Date d'achat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commandes as $commande)
                                        <tr>
                                            <td>{{ $commande->carte->num }}</td>
                                            <td>{{ $commande->carte->client->nom_prenoms }}</td>
                                            <td> {{ $commande->montant }} </td>
                                            <td> {{ $commande->carte->num != 'Nan' ? $commande->id : 'Nan' }} </td>
                                            <td>
                                                @foreach (json_decode($commande->produits) ?? [] as $key => $prod)
                                                    @foreach ($produits as $produit)
                                                        @if ($produit->id == $prod)
                                                            <span class="alert alert-primary  mx-2">
                                                                {{ $produit->libelle }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach (json_decode($commande->qte) ?? [] as $key => $q)
                                                    <span class="alert alert-primary  mx-2">
                                                        {{ $q }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="text-capitalize">
                                                {{ $commande->created_at->locale('fr_FR')->isoFormat('DD MMMM YYYY HH:mm') }}
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
    </section>
@endsection
