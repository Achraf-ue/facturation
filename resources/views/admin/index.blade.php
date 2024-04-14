@extends('admin.admin_master')
@section('admin')
<div class="content-page">
  <!-- Start content -->
  <div class="content">
      <div class="container-fluid">
          <div class="page-title-box">
              <div class="row align-items-center">
                  
                  <div class="col-sm-6">
                      <h4 class="page-title">FIRINFO</h4>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item active">GESTION TRESERERIE</li>
                      </ol>

                  </div>
                  <div class="col-sm-6">
                  </div>
              </div>
          </div>
          <!-- end row -->
          
          <div class="row">
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/01.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">Factures</h5>
                              <h4 class="font-500">{{$Facture_Count}}</h4>
                              
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/01.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">F. CLIENTS</h5>
                              <h4 class="font-500">{{$Facture_client}}</h4>
                              
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/01.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">F. FOURNISEURS</h5>
                              <h4 class="font-500">{{$Facture_fourniseur}}</h4>
                              
                          </div>
                      </div>
                  </div>
              </div>

              
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/02.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                                F . En cours</h5>
                              <h4 class="font-500">{{$Facture_En_Cours}}</h4>
                          </div>

                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/03.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">F . Payé</h5>
                              <h4 class="font-500">{{$Facture_Payé}}</h4>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div class="card-body">
                          <div class="mb-4">
                              <div class="float-left mini-stat-img mr-4">
                                  <img src="{{ asset('backend/assets/images/services-icon/03.png')}}" alt="" >
                              </div>
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">F . Payé validé</h5>
                              <h4 class="font-500">{{$Facture_Payé_v}}</h4>
                          </div>
                      </div>
                  </div>
              </div>
              
          </div>                       
                        <div class="card-body">
                        <h1 style="text-align: center;">Arrivé echeance</h1>

                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Generate_Facture" name="client">
                                <option value="0">Generate Option</option>
                                <option value="Pdf">Pdf</option>
                                <option value="Excel" >Excel</option>
                            </select>
                            <br>
                            <br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap factures_Div" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
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
                                    if($date >= $date_echeance_puls_seven_days && $facture_echeance->status != "Payé" ) {
                                        echo "style='background-color:red'";
                                    } 
                                    
                                    if($facture_echeance->date_facture == $facture_echeance->date_echeance){
                                        echo "style='background-color:red'";
                                    }
?>>
    <td >{{$facture_echeance->id }}</td>
    <td>{{$facture_echeance->nom_complet .' / '.$facture_echeance->type}}</td>
    <td>{{$facture_echeance->n_facture}}</td>
    <td>{{$date_echeance->format('Y - m - d')}}</td>
    
    <?php $date = Carbon\Carbon::parse($facture_echeance->date_echeance)->locale('fr_FR'); ?>
    <td>{{$date->format('Y - m - d')}}</td>
    @if ($facture_echeance->type == "Client"  || $facture_echeance->type == "Personne_physique" )
    <td>{{$facture_echeance->mantant}}  </td>
    @else
    <td></td>
    @endif
    @if ($facture_echeance->type == "Fourniseur")
    <td>{{$facture_echeance->mantant}}</td>  
    @else
    <td></td>  
    @endif
    @if ($facture_echeance->status == "Payé")
    <td><span class="badge badge-success">{{$facture_echeance->status}}</span></td>
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

                    <!-- totale facture en cours  -->
                    
            <h2>Mantant par euro</h2>
                        <div class="row">
                        <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #909497" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                               Totale crédit client</h5>
                              <h4 class="font-500">{{$creditEuro_enCours}}</h4>
                      </div>
                  </div>
              </div>

              
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #16A085" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                            Totale début fournisuer</h5>
                              <h4 class="font-500">{{$debutEuro_enCours}}</h4>
                      </div>
                  </div>
              </div>

              <div  class="col-xl-3 col-md-6">
                  <div  class="card mini-stat bg-primary text-white">
                      <div style="background-color: #DC7633" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                                totale globale</h5>
                              <h4 class="font-500">{{$sum_g_euro_enCours}}</h4>
                      </div>
                  </div>
              </div>
            </div>

            <!-- par dh -->
            <h2>Mantant par dh</h2>
            <div class="row">
                        <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #909497" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                               Totale crédit client</h5>
                              <h4 class="font-500">{{$creditDh_enCours}}</h4>
                      </div>
                  </div>
            </div>

              
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #16A085" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                            Totale début fournisuer</h5>
                              <h4 class="font-500">{{$debutDh_enCours}}</h4>
                      </div>
                  </div>
              </div>

              <div  class="col-xl-3 col-md-6">
                  <div  class="card mini-stat bg-primary text-white">
                      <div style="background-color: #DC7633" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                                totale globale</h5>
                              <h4 class="font-500">{{$sum_g_dh_enCours}}</h4>
                      </div>
                  </div>
              </div>
            </div>

                    <!-- fin totale facture en cours  -->
                    <div class="card-body">
                            <h1 style="text-align: center;">Paiement validé par banque</h1>
                            <h3 style="color:red;">Liste Banques</h3>
                            <select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="banque">
                                <option value="Banques">Banques</option>
                                @foreach ($banques as $banque)
                                <option value="{{$banque->nom}}" >{{$banque->nom}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control form-control-default date-ranger" id="Range_1" name="date_ranger" style="width:190px;display:inline-block;margin-right:5px;">
                            <button class="btn btn-info waves-effect waves-light"><a style="color:white;" id="filter_banque">Filter</a> </button>
                            <button class="btn btn-info waves-effect waves-light"><a style="color:white;" href="{{route('index')}}">actualisé</a> </button>

                            <br>
                            <br>
                            <div class='filter_banque'>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap factures_Div" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
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
                                    @foreach ($facture_echeances_valide as $facture_echeance)

                                    <?php $date = Carbon\Carbon::parse(date('Y-m-d H:i:s'))->locale('fr_FR'); ?>
                                    <?php $date_facture = Carbon\Carbon::parse($facture_echeance->date_facture)->locale('fr_FR'); ?>
                                    <?php $date_echeance = Carbon\Carbon::parse($facture_echeance->date_echeance)->locale('fr_FR'); ?>
                                    <?php $date_finale = $date  ->diff($date_echeance);  ?>

                                    
                                    <tr <?php  
                                    if($facture_echeance->status != 'Payé'   &&   $date_finale->format('%a') < 7 ) {
                                        echo "style='background-color:red'";
                                    }   
                                    ?>>
                                        <td >{{$facture_echeance->id }}</td>
                                        <td>{{$facture_echeance->nom_complet .' / '.$facture_echeance->type}}</td>
                                        <td>{{$facture_echeance->n_facture}}</td>
                                        <td>{{$date_facture->format('Y - m - d')}}</td>
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
                        <h2>Mantant par dh</h2>
            <div class="row">
                        <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #909497" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                               Totale crédit client</h5>
                              <h4 class="font-500">{{$creditDh}}</h4>
                      </div>
                  </div>
            </div>

              
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #16A085" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                            Totale début fournisuer</h5>
                              <h4 class="font-500">{{$debutDh}}</h4>
                      </div>
                  </div>
              </div>

              <div  class="col-xl-3 col-md-6">
                  <div  class="card mini-stat bg-primary text-white">
                      <div style="background-color: #DC7633" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                                totale globale</h5>
                              <h4 class="font-500">{{$sum_g_dh}}</h4>
                      </div>
                  </div>
              </div>
            </div>


            <h2>Mantant par euro</h2>
                        <div class="row">
                        <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #909497" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                               Totale crédit client</h5>
                              <h4 class="font-500">{{$creditEuro}}</h4>
                      </div>
                  </div>
              </div>

              
              <div class="col-xl-3 col-md-6">
                  <div class="card mini-stat bg-primary text-white">
                      <div style="background-color: #16A085" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                            Totale début fournisuer</h5>
                              <h4 class="font-500">{{$debutEuro}}</h4>
                      </div>
                  </div>
              </div>

              <div  class="col-xl-3 col-md-6">
                  <div  class="card mini-stat bg-primary text-white">
                      <div style="background-color: #DC7633" class="card-body">
                              <h5 class="font-16 text-uppercase mt-0 text-white-50">
                                totale globale</h5>
                              <h4 class="font-500">{{$sum_g_euro}}</h4>
                      </div>
                  </div>
              </div>
            </div>
          <!-- end row -->

          <!--<div class="row">
              <div class="col-xl-9">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="mt-0 header-title mb-5">Monthly Earning</h4>
                          <div class="row">
                              <div class="col-lg-7">
                                  <div>
                                      <div id="ct-donut" class="ct-chart earning ct-golden-section"></div>
                                  </div>
                              </div>
                              <div class="col-lg-5">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="text-center">
                                              <p class="text-muted mb-4">This month</p>
                                              <h4>$34,252</h4>
                                              <p class="text-muted mb-5">It will be as simple as in fact it will be occidental.</p>
                                              <span class="peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">4/5</span>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="text-center">
                                              <p class="text-muted mb-4">Last month</p>
                                              <h4>$36,253</h4>
                                              <p class="text-muted mb-5">It will be as simple as in fact it will be occidental.</p>
                                              <span class="peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">3/5</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                       </div>
                  </div>
                  
              </div>

             
          </div>-->
          <!-- end row -->
           <!-- end row -->
         
          <!-- end row -->

          
          <!-- end row -->
      </div>
      <!-- container-fluid -->

  </div>
  <!-- content -->
</div>
@endsection
