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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Liste Facatures</a></li>
                        </ol>

                    </div>
                    </div>
                </div>
            </div>
            
            <!-- end row -->

            <div class="row">
                
                <div class="col-12"><div class="col-sm-12">
                </div>
                
                <div class="card">
                <input class="form-check-input" type="checkbox">
                <form  action="{{route('export_file_zip_r')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                    <div style="text-align: center" class="card-body">
                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" name="type" id="Type">
                            <option value="">Tous</option>
                            <option value="Client">Client</option>
                            <option value="Fourniseur" >Fourniseur</option>
                        </select>
                        <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" name="nom_complet" id="Type_select" >
                            <option value="">choisir --</option>
                        </select>

                            <select style="width:150px;display:inline-block;margin-right:5px;"  class="form-control" name="status_facture" id="Status">
                                <option value="">Status</option>
                                <option value="En cours" >En cours </option>
                                <option value="Payé" >Payé</option>
                            </select>
                            
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="N_Facture" id="N_Facture">
                                <option value="">Factures</option>
                                @foreach ($facture_echeances as $facture_echeance)
                                <option value="{{$facture_echeance->id}}" >{{$facture_echeance->n_facture}}</option>
                                @endforeach
                            </select>
                            <br>
                            <br>    
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="b_command" id="b_command">
                                <option value="">bon command</option>
                                @foreach ($facture_echeances as $facture_echeance)
                                <option value="{{$facture_echeance->n_bon_commande}}" >{{$facture_echeance->n_bon_commande}}</option>
                                @endforeach
                            </select>

                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="m_payment" id="m_payment">
                            <option value="">Mode payment</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Lettre de change">Lettre de change</option>
                                <option value="Vairement">Vairement</option>
                                <option value="Espece">Espece</option>
                            </select>



                            
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="devis" id="devis">
                            <option value="">Devis</option>
                                <option value="dh">DH</option>
                                <option value="euro">EURO</option>
                            </select>

                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" name="n_payment" id="n_payment">
                                <option value="">N.Payement</option>
                                @foreach ($facture_echeances as $facture_echeance)
                                <option value="{{$facture_echeance->Nemero_payement}}" >{{$facture_echeance->Nemero_payement}}</option>
                                @endforeach
                            </select>


                            <input type="text" class="form-control form-control-default date-ranger" id="Range_1" name="date_ranger" style="width:190px;display:inline-block;margin-right:5px;">
                 
                            
                            <div class="float-right d-none d-md-block">
                                <a id="Cherche_Facture" ><button type="button" class="btn btn-success waves-effect waves-light">Cherche</button></a>
                            </div>
                            
                            </br>
                            </br>
                            </br>   
                            <button class="btn btn-info waves-effect waves-light"><a style="color:white;" href="{{route('factures_echeances')}}">actualisé</a> </button>
                        
                            <button type="submit" class="btn btn-danger waves-effect waves-light">export file to zip</button>
                        </form>
                    </div>
            </div>
                    <div class="card">
                        
                        <div class="card-body">
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Generate_Facture" name="client">
                                <option value="0">Generate Option</option>
                                <option value="Pdf">Pdf</option>
                                <option value="Excel" >Excel</option>
                            </select>
                            <br>
                            <br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap factures_Div" name="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="noExl">
                                    <tr class="noExl">
                                        <th>Id</th>
                                        <th>Raison sociale</th>
                                        <th>N facture</th>
                                        <th>Date facture</th>
                                        <th>Date echeance</th>
                                        <th>Crédit</th>
                                        <th>Début</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($facture_echeances as $facture_echeance)
                                    <?php $date = Carbon\Carbon::parse(date('Y-m-d H:i:s'))->locale('fr_FR'); ?>
                                    <?php $date_echeance = Carbon\Carbon::parse($facture_echeance->date_echeance)->locale('fr_FR'); ?>
                                    <?php $date_echeance_puls_seven_days = Carbon\Carbon::parse($facture_echeance->date_echeance)->addDays(7)->locale('fr_FR'); ?>

                                    <tr <?php   
                                    if($date >= $date_echeance_puls_seven_days && $facture_echeance->status != "Payé") {
                                        echo "style='background-color:red'";
                                    }    
                                    ?>>
                                        <td >{{$facture_echeance->id }}</td>
                                        <td>{{$facture_echeance->nom_complet .' / '.$facture_echeance->type}}</td>
                                        <td >{{$facture_echeance->n_facture }}</td>
                                        <td>{{$date_echeance->format('Y - m - d')}}</td>
                                        <?php $date = Carbon\Carbon::parse($facture_echeance->date_echeance)->locale('fr_FR'); ?>
                                        <td>{{$date->format('Y - m - d')}}</td>
                                        @if ($facture_echeance->type == "Client"  || $facture_echeance->type == "Personne_physique" )
                                        <td>{{$facture_echeance->mantant}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        @if ($facture_echeance->type == "Fourniseur")
                                        <td>{{$facture_echeance->mantant}}</td>  
                                        @else
                                        <td></td>  
                                        @endif
                                        @if ($facture_echeance->status == "Payé")
                                        <td><span class="badge badge-success">{{$facture_echeance->status}}
                                        @if($facture_echeance->v_banque == 1)
                                        / B
                                        @endif


                                        </span></td>
                                        @else
                                        <td><span class="badge badge-danger">{{$facture_echeance->status}}</span></td>
                                        @endif

                                                                                
                                        <td> 
                                        <a class="nav-link dropdown-toggle arrow-none remplir_action_class" id="dLabel4" data-id="{{$facture_echeance->id}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                         <i  data-toggle="tooltip" data-placement="top" title="Archive detaille" class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                                </a>
                                        <div class="dropdown-menu dropdown-menu-right remplir_action" aria-labelledby="dLabel4">
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach
                            </table>

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