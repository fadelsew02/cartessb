@extends('template')
@section('content')
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Gestion des cartes</h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Page</a></li>
                        <li class="breadcrumb-item active">Cartes</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <button type="button" class="btn btn-primary mx-4" data-toggle="modal" data-target=".bd-example-modal-lg">Enregistrer
                une carte</button>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mx-auto text-dark">Gérer la carte</h3>
                            
                        </div>
                        <div class="modal-body">
                            <div class="form-validation">
                                <form class="form-valide" action="/carte" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-form-label " for="val-username">N° carte<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="text" class="form-control text-uppercase" id="num"
                                                    name="num" placeholder="124563" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label class="col-form-label" for="val-skill">Client<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <select class="form-control" id="idclient" name="idclient">

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label class="col-form-label" for="val-email">Nbre d'achat<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div>
                                                <input type="number" class="form-control text-capitalize" id="nbreAchat"
                                                    name="nbreAchat" readonly>
                                            </div>
                                        </div>

                                        <script>
                                            $(document).ready(function() {
                                                $(document).on('change', '#num', function() {
                                                    var num = $(this).val();

                                                    $.ajax({
                                                        type: 'get',
                                                        url: '{!! URL::to('recupCarte') !!}',
                                                        data: {
                                                            'num': num,
                                                        },
                                                        success: function(data) {
                                                            console.log('success');
                                                            console.log(data);
                                                            var carte = data[0].carte;
                                                            var clients = data[1].clients;

                                                            console.log(carte, clients);
                                                            $('#idclient').empty();

                                                            if (carte == null) {
                                                                $('#idclient').append(
                                                                    '<option value="">Sélectionnez un client</option>');
                                                                $.each(clients, function(index, client) {
                                                                    $('#idclient').append('<option value="' + client.id +
                                                                        '">' + client.nom_prenoms + '</option>');

                                                                });

                                                                $('#nbreAchat').val(0);
                                                            } else {
                                                                $.each(clients, function(index, client) {
                                                                    if (client.id == carte.idclient) {
                                                                        $('#idclient').append('<option value="' + client
                                                                            .id +
                                                                            '">' + client.nom_prenoms + '</option>');
                                                                    }
                                                                });

                                                                $('#nbreAchat').val(carte.nbreAchat);
                                                            }
                                                        },
                                                        error: function() {
                                                            // Gérer l'erreur ici
                                                        }
                                                    });
                                                });
                                            });
                                        </script>

                                    </div>
                                    <hr>

                                    <div class="form-group my-2">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Enregister</button>
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
                                        <th>N° de carte</th>
                                        <th>Nom & Prénoms</th>
                                        <th>Date d'expiration</th>
                                        <th>Nbre d'achat</th>
                                        <th>Validité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartes as $carte)
                                        <tr>
                                            <td>{{ $carte->num }}</td>
                                            <td>{{ $carte->client->nom_prenoms }}</td>
                                            <td class="text-capitalize" >
                                                @php
                                                    
                                                    $dateActuelle = \Carbon\Carbon::now();
                                                    $expire = $carte->created_at->addMonths(5);
                                                @endphp
                                                {{ $expire->locale('fr_FR')->isoFormat('DD MMMM YYYY HH:mm') }}
                                            </td>
                                            <td> {{$carte->nbreAchat}} </td>
                                            <td class=" {{($expire->diff($dateActuelle)->invert == 1 && $carte->nbreAchat <= 9) ? 'text-success' : 'text-danger'}} "> {{($expire->diff($dateActuelle)->invert == 1 && $carte->nbreAchat <= 9) ? 'Valide' : 'Expirée'}} </td>
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
