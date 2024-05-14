@extends('template')
@section('content')
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Enregistrement d'une commande</h1>
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
        <div class="row justify-content-center">
            <div class="card col-lg-8 " id="com">
                <div class="form-validation">
                    <form class="form-valide" action="/commande" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label " for="val-username">N° carte<span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" class="form-control text-uppercase" id="num" name="num"
                                        value="Nan" placeholder="124563" required>
                                </div>
                                <span class="text-danger" id="no-valide"></span>
                            </div>

                            <div class="col-lg-6 ">
                                <label class="col-form-label" for="val-skill">Client<span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select class="form-control" id="idclient" name="idclient">
                                        <option value="5">Anonyme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label class="col-form-label" for="val-email">Nbre d'achat<span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="number" class="form-control text-capitalize" id="nbreAchat"
                                        name="nbreAchat" value="0" readonly>
                                </div>
                                <span class="text-success" id="reduc"></span>
                                <span class="text-danger" id="notif"></span>
                            </div>

                            <div class="col-lg-12">
                                <label class="col-form-label" for="val-email">Produits commandés<span
                                        class="text-danger">*</span>
                                </label>
                                <div>
                                    <select name="produits[]" id="produits" multiple
                                        onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))"
                                        multiselect-search="true" multiselect-hide-x = "true"
                                        class="form-control  form-select select-field">
                                        @foreach ($produits as $produit)
                                            <option value="{{ $produit->id }}"> {{ $produit->libelle }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label class="col-form-label" for="val-email">Qtes<span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" class="form-control text-capitalize" id="qtes" name="qtes"
                                        placeholder="1 2 3">
                                </div>
                                {{-- <span class="text-success" id="reduc"></span> --}}
                                <span class="text-danger" id="att"></span>
                            </div>

                            <div class="col-lg-6">
                                <label class="col-form-label" for="val-email">Montant de la commande<span
                                        class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" class="form-control text-capitalize" id="montantAchat"
                                        value="0" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="col-form-label" for="val-email">Montant à Payer<span
                                        class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" class="form-control text-capitalize" id="montantPayer"
                                        value="0" name="montant" required readonly>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $(document).on('change', '#num', function() {
                                        var num = $(this).val();

                                        $.ajax({
                                            type: 'get',
                                            url: '{!! URL::to('recup') !!}',
                                            data: {
                                                'num': num,
                                            },
                                            success: function(data) {
                                                console.log('success');
                                                console.log(data);
                                                var carte = data[0].carte;
                                                var clients = data[1].clients;

                                                console.log(carte, clients);


                                                if (carte == null) {
                                                    $('#no-valide').html(`Cette carte n'est pas enregistrée!!!`);
                                                    $('#num').val('Nan');
                                                    $('#nbreAchat').val(0);
                                                } else {
                                                    $('#idclient').empty();
                                                    $.each(clients, function(index, client) {
                                                        if (client.id == carte.idclient) {
                                                            $('#idclient').append('<option value="' + client
                                                                .id +
                                                                '">' + client.nom_prenoms + '</option>');
                                                        }
                                                    });
                                                    var pourcentage = [0, 0, 0, 0.2, 0.3, 0, 0, 0, 0.2, 0.3];
                                                    $('#nbreAchat').val(carte.nbreAchat);
                                                    var quota = pourcentage[carte.nbreAchat] * 100;
                                                    $('#reduc').html(quota + `% de réduction sur cette commande. <br>`);
                                                    if (carte.nbreAchat == 9) {
                                                        $('#notif').html(
                                                            `Dernière commande possible avec cette carte!!!`);
                                                    }
                                                }
                                            },
                                            error: function() {
                                                // Gérer l'erreur ici
                                            }
                                        });
                                    });
                                    $(document).on('change', '#qtes', function() {
                                        $.ajax({
                                            type: 'get',
                                            url: '{!! URL::to('qtes') !!}',
                                            data: {
                                                'produits': $('#produits').val(),
                                                'qtes': $('#qtes').val(),
                                            },
                                            success: function(data) {
                                                console.log('success');
                                                console.log(data);
                                                if (data == 0) {
                                                    $('#att').html(
                                                        `Pas autant de produits que de quantité!!!`);
                                                        $('#montantAchat').val(data);
                                                    var nbreAchat = $('#nbreAchat').val(0);
                                                    $('#montantPayer').val(0);
                                                } else {
                                                    $('#att').html(
                                                        ``);
                                                    $('#montantAchat').val(data);
                                                    var nbreAchat = $('#nbreAchat').val();
                                                    var pourcentage = [0, 0, 0, 0.2, 0.3, 0, 0, 0, 0.2, 0.3];
                                                    $('#montantPayer').val(parseInt($('#montantAchat').val()) - $(
                                                        '#montantAchat').val() * pourcentage[nbreAchat]);
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
                                <button type="submit" class="btn btn-primary">Enregister la commande</button>
                                <a href="/commandes" class="btn btn-danger">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
