@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title">Form Elements</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Form Elements</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('modifier_facture_echeances')}}" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="id" value="{{$facture_echeance->id}}">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Type" name="Type">
                                        <option value="0">Type </option>
                                        <option value="Client" {{($facture_echeance->type == 'Client' ? "selected":"" )}}>Client</option>
                                        <option value="Fourniseur"{{($facture_echeance->type == 'Fourniseur' ? "selected":"" )}}>Fourniseur</option>
                                    </select>
                                </div>
                            </div>
                            <div id="Type_select" class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label"> {{ $facture_echeance->type }}</label>
                                <div class="col-sm-10">

                                    <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" name="n_complet">
                                    @if ($facture_echeance->type == "Client")
                                    @foreach ($clients as $client)
                                    <option value="{{$client->nom}}" {{($client->nom == $facture_echeance->nom_complet ? "selected" : "" )}}> {{ $client->nom }} </option>
                                    @endforeach
                                    @endif

                                    @if ($facture_echeance->type == "Fourniseur")
                                    @foreach ($fourniseurs as $fourniseur)
                                    <option value="{{$fourniseur->nom}}" {{($fourniseur->nom == $facture_echeance->nom_complet ? "selected" : "" )}}> {{ $fourniseur->nom }} </option>
                                    @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Numéro facture</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Numéro facture" value="{{$facture_echeance->n_facture}}"  name="n_facture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date facture</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="date" placeholder="Date facture" value="{{$facture_echeance->date_facture}}"  name="date_facture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Remarque</label>
                                    <div class="col-sm-10">
                                       <textarea   class="form-control" type="text" placeholder="Remarque" autocomplete="off"  name="remarque_facture">{{$facture_echeance->remarque}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mantant</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" placeholder="Mantant" value="{{$facture_echeance->mantant}}"  name="mantant">
                                    </div>
                                </div>


                                @if ($facture_echeance->status == "En cours")
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="status", id="Statu_facture">
                                            <option value="En cours" {{($facture_echeance->status == 'En cours' ? "selected":"" )}}>En cours</option>
                                            <option value="Payé" {{($facture_echeance->status == 'Payé' ? "selected":"" )}}  >Payé</option>
                                        </select>
                                    </div>
                                </div>
                                @endif

                                <div id="Payement_select" style="display: none">
                                <div  class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Payements</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="payement" id="Payement">
                                            <option value="0">Type</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Lettre de change">Lettre de change</option>
                                            <option value="Vairement">Vairement</option>
                                            <option value="Espece">Espece</option>
                                        </select>
                                    </div>
                                </div></div>
                                <div id="Payement_div" style="display: none">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Némero</label>
                                        <div class="col-sm-10">
                                           <input class="form-control" type="text" placeholder="Némero"  name="n_file">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                <label for="example-text-input" style="color:red;" class="col-sm-2 col-form-label">Banque</label>
                                <div class="col-sm-10">
                                <select style="width:150px;display:inline-block;margin-right:5px;border: 2px solid blue;" class="form-control" name="banque" id="banque_1">
                                @foreach ($banques as $banque)
                                <option value="{{$banque->nom}}" >{{$banque->nom}}</option>
                                @endforeach
                            </select>

                                </div>
                            </div>
                                    <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Justif Payment</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="file"  name="facture_pdf">
                                    </div>
                                </div>
                                </div>
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Modifier facture</button>
                                <br>
                                <br>
                                <br>
                                <div class="form-group row">
                                <object data="your_url_to_pdf"type="application/pdf">
                                    <iframe style="height:500px;width:750px;"  src="{{asset($facture_echeance->facture_pdf)}}"></iframe>
                                </object>
                                </div>
                            </div>
                        </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


        </div>
        <!-- container-fluid -->

    </div>
    <!-- content -->

</div>
@endsection