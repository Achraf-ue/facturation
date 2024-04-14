@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title">Factures</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Factures</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">liste factures</a></li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('Ajouter_facture_echeances')}}" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Type" name="Type">
                                        <option value="0">Type </option>
                                        <option value="Client">Client</option>
                                        <option value="Fourniseur">Fourniseur</option>
                                    </select>
                                </div>
                            </div>
                            <div id="Type_select" class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" name="client">
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Numéro de commande valide</label>
                                    <div class="col-sm-10">
                                       <input required class="form-control" type="text" placeholder="Numéro de commande valide" autocomplete="off" id="n_commande"  name="n_bon_commande">
                                    </div>
                                </div>
                                <div id="hide_n_commande">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">bon de commande</label>
                                    <div class="col-sm-10">
                                       <input required class="form-control" type="file"  name="bon_pdf_commande">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Numéro facture</label>
                                    <div class="col-sm-10">
                                       <input required class="form-control" type="text" placeholder="Numéro facture" autocomplete="off"  name="n_facture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Remarque</label>
                                    <div class="col-sm-10">
                                       <textarea   class="form-control" type="text" placeholder="Avance payment" autocomplete="off"  name="remarque_facture"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Taxation</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="taxation">
                                            <option value="tva"selected>TVA</option>
                                            <option value="exonore" >EXONORE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date facture</label>
                                    <div class="col-sm-10">
                                       <input required class="form-control" autocomplete="off" type="text" placeholder="Date facture" id="datepicker"   name="date_facture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date echeance</label>
                                    <div class="col-sm-10">
                                       <input required class="form-control" autocomplete="off" type="text" placeholder="Date echeance facture" id="datepicker-1"   name="date_echeance">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mantant</label>
                                    <div class="col-sm-10">
                                       <input required class="form-control" type="number" value="0.00" step="any" autocomplete="off" type="" placeholder="Mantant"  name="mantant">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Devis</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="devis">
                                            <option value="dh"selected>DH</option>
                                            <option value="euro" >EURO</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Facture</label>
                                    <div class="col-sm-10">
                                       <input required class="form-control" type="file"  name="facture_pdf">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="status", id="Statu_facture">
                                            <option value="En cours"selected>En cours</option>
                                            <option value="Payé" >Payé</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                
                                <div id="Payement_select" style="display: none">
                                <div  class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mode de payements</label>
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
                                           <input class="form-control" type="text" value="0" placeholder="Némero"  name="n_file">
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
                                        <label for="example-text-input" class="col-sm-2 col-form-label">justif de payment</label>
                                        <div class="col-sm-10">
                                           <input class="form-control" type="file"  name="payement_file">
                                        </div>
                                    </div> 
                                </div>
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter facture</button>
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