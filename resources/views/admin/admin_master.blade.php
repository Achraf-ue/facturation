<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Gestion Tresererie</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

            <!--Chartist Chart CSS -->
            <link rel="stylesheet" href="{{ asset('backend/assets/plugins/chartist/css/chartist.min.css')}}">
            <!-- Sweet Alert -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />


            


            <!-- DataTables -->
            <link href="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
            <!--Select 2-->
            <link href="{{ asset('backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
            <!--Daterangebicker css-->
            <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker.css')}}">
            <!-- Responsive datatable examples -->
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
            <link href="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/css/switchery.css')}}" rel="stylesheet" type="text/css"/>

        <style>
            .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
            .select2-search input:active{x
                color: green;
            }
            .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: 170px !important;
            display:inline-block;
            margin-right:50px;
            border-color:#BD362F;
           }
           .select2-container--default .select2-results__option--highlighted[aria-selected]{
               background-color:#FEC918;
           }
           #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  text-align: center;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #04AA6D;
  color: white;
}
#customers td {
   height: 20px;
  text-align: center;
  background-color: #04AA6D;
  color: black;
}
#customers tr{
   width: 50px;
}
.th-1{
    width: 200px;
}
        </style>
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300);
        html {
        height:90%;
        }
    
        .global {
            background-color:rgba(0,0,0,0.5);position:fixed; top:0;left:0;z-index:9999;width:100vw;height:100vh;display:none;
        }
        .global .back { position:absolute;top:50%;left:50%;transform:translate(-50%);}
        .back {
            margin:1em auto;
            font-family:"Roboto";
        }
        .back span {
            font-size:3em;
            color:#F2C640;
            background:#262B37;
            display:table-cell;
            box-shadow:inset 0 0 5px rgba(0,0,0,0.3), 0 5px 0 #ccc;
            padding: 0 15px;
            line-height: 100px;
            animation:jumb 2s infinite;
        }
        @keyframes jumb {
            0% {
                transform:translateY(0px)
            }
            50% {
                transform:translateY(-30px);
                box-shadow:0 15px 0 rgb(242, 198, 64);
            }
            100% {
                transform:translateY(0px)	
            }
        }
        .back span:nth-child(1) {
            animation-delay:.1s;
        }
        .back span:nth-child(2) {
            animation-delay:.2s;	
        }
        .back span:nth-child(3) {
            animation-delay:.1s;
        }
        .back span:nth-child(4) {
            animation-delay:.2s;	
        }
        .back span:nth-child(5) {
            animation-delay:.1s;
        }
        .back span:nth-child(6) {
            animation-delay:.2s;	
        }
        .back span:nth-child(7) {
            animation-delay:.1s;
        }
    .back span:nth-child(8) {
            animation-delay:.2s;
        }
    .back span:nth-child(9) {
            animation-delay:.1s;
        }
    .back span:nth-child(10) {
            animation-delay:.2s;
        }
    .back span:nth-child(11) {
            animation-delay:.1s;
        }
        </style>
    </head>

    <body>
        <div id="global" class="global">
            <span id="Loaders" class="back">
                <span>F</span>
                <span>I</span>
                <span>R</span>
                <span>I</span>
                <span>N</span>
                <span>F</span>
                <span>O</span>
            </span>
        </div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
             @include('admin.body.header');
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.body.sidebar');
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            @yield('admin')

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="{{ asset('backend/assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/metisMenu.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ asset('backend/assets/js/waves.min.js')}}"></script>
        <!-- Début -->  
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>




        <script src="{{ asset('backend/assets/jquery.table2excel.js')}}"></script>

        <!-- Fin --> 
        <!-- Datatable --> 
          <!-- Required datatable js -->
          <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
          <!-- Buttons examples -->
          <script src="{{ asset('backend/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/jszip.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/pdfmake.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/vfs_fonts.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.print.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
          <!-- Responsive examples -->
          <script src="{{ asset('backend/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
          <script src="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
  
          <!-- Datatable init js -->
          <script src="{{ asset('backend/assets/pages/datatables.init.js')}}"></script>       
        <!-- fin datatable -->
        <!--Chartist Chart-->
        <script src="{{ asset('backend/assets/plugins/chartist/js/chartist.min.js')}}"></script>
        <script src="{{ asset('backend/assets/plugins/chartist/js/chartist-plugin-tooltip.min.js')}}"></script>

        <!-- peity JS -->
        <script src="{{ asset('backend/assets/plugins/peity-chart/jquery.peity.min.js')}}"></script>

        <script src="{{ asset('backend/assets/pages/dashboard.js')}}"></script>
        <!--{{ asset('backend/')}}-->
        <!-- App js -->
        <script src="{{ asset('backend/assets/js/app.js')}}"></script>
         <!-- Sweet-Alert  --> 
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         <!--Select 2-->
         <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js')}}"></script>
         <!--Toast-->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
         <style> #toast-container > .toast-error { background-color:   #BD362F; } </style>
        <style> #toast-container > .toast-success { background-color: green; } </style>
        <!--daterangebicer-->
        <script src="{{asset('backend/assets/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('backend/assets/plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('backend/assets/plugins/daterangepicker.js')}}"></script>
        <script src="{{asset('backend/assets/plugins/switchery.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
         }
         @endif 
        </script>
        
    </body>
</html>

<div id="Modal_Retard_Detaille" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Retard Detailles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="Modal_Facture_Detaille" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Facture Detailles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body-facture">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function(){
      $('#Status').select2();
      $('#N_Facture').select2();
      $('#b_command').select2();
      $('#n_payment').select2();
      $('#m_payment').select2();
      $('#devis').select2();
      $('#Pointage_Matricule').select2();
      $('#banque').select2();
      $('#banque_1').select2();
      $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#datepicker-1" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $(document).on('click','#Cherche_Facture', function(){
       var Filter_1  = $("#Status").val();
       var Filter_2  = $("#N_Facture").val();
       var N_bon_Command =  $("#b_command").val();
       var Filter_client = Filter_fourniseur  = $("#Type_select").val();
       var Type_Facture     = $("#Type").val(); 
       var Nom_complet = "";
       if(Filter_client     != '')
            Nom_complet = Filter_client
       if(Filter_fourniseur != '')
            Nom_complet = Filter_fourniseur

        var N_Payment     = $("#n_payment").val(); 
        var M_Payment     = $("#m_payment").val();
        var devis     = $("#devis").val();

       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);
       $("#Generate_Facture").prop("selectedIndex", 0).val();
        $.ajax({
                     url: "{{ route('Facture_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Filter_2:Filter_2,Nom_complet:Nom_complet,Type_Facture:Type_Facture,N_bon_Command:N_bon_Command,N_Payment:N_Payment,M_Payment:M_Payment,devis:devis}, beforeSend:function(){
                      $("#global").show();
                 },
                     success: function(response){
                        console.log(response);
                        //toastr.success("Bien Recherche");
                        $("#global").hide();
                         $(".factures_Div").html(response);
                     }
                 });
      });
      /*Fin filter factures*/
      //Generate pdf
      $(document).on('change','#Generate_Facture', function(){
       var Filter_1  = $("#Status").val();
       var Filter_2  = $("#N_Facture").val();
       var Filter_client = Filter_fourniseur  = $("#Type_select").val();
       var Type_Facture     = $("#Type").val(); 
       var Generate_Facture = $("#Generate_Facture").val();
       var Nom_complet = " ";
       if(Filter_client     != 'Tous')     Nom_complet = Filter_client
       if(Filter_fourniseur != 'Tous')     Nom_complet = Filter_fourniseur
       //salert(Nom_complet);
       var Filter_3  = $("#Range_1").val();
       var Date_debut = Filter_3.slice(0,10);
       var Date_fin = Filter_3.slice(13,23);

       if(Generate_Facture != 'Pdf'){
        $("#datatable").table2excel({

    // exclude CSS class

    exclude:".noExl",

    name:"Worksheet Name",

    filename:"SomeFile",//do not include extension

    fileext:".xls" // file extension
  });



    }
        $.ajax({
                     url: "{{ route('Generate.Pdf') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Filter_1:Filter_1,Date_debut:Date_debut,Date_fin:Date_fin,Filter_2:Filter_2,Nom_complet:Nom_complet,Type_Facture:Type_Facture,Generate_Facture:Generate_Facture}, beforeSend:function(){
                 },
                     success: function(response){
                        console.log(response);
                        $("#global").hide();
                        //alert(response);
                        //window.location.href = response;
                        if(response == ' ')
                        toastr.error("Pas disponible");
                        else
                        window.open(response,'_blank');
                     }
                 });
      });
      //Fin generate pdf
      //Facture cheque 
      $(document).on('change','#Payement', function(){
       var Payement  = $("#Payement").val();
       //alert(Payement);
       if(Payement == 'Cheque' || Payement == 'Lettre de change' || Payement == 'Vairement'  )
       $("#Payement_div").show();
       else
       if(Payement == 'Espece' )
       $("#Payement_div").hide();
      });
      //Fin facture cheque 
      //Statu_facture
      $(document).on('change','#Statu_facture', function(){
       var Statu_facture  = $("#Statu_facture").val();
       if(Statu_facture  == 'En cours')
       {
        $("#Payement_select").hide();
       }
       else
       if(Statu_facture == 'Payé' )
       {
        $("#Payement_select").show();
       }
       

       
      });
      /**/
      $('.Type').select2();
      $(document).on('change','#Type', function(){
       var Filter_1  = $("#Type").val();
       var Filter_1  = $("#Type").val();
       $.ajax({
        url: "{{ route('client_remplir_select') }}",
        type: 'get',
        data: {
         "_token": "{{ csrf_token() }}", 
         Filter_1:Filter_1}, beforeSend:function(){
        },
        success: function(response){
            //toastr.success("Bien Recherche");
            $("#Type_select").html(response);
        }
        });
       //alert(Filter_1);
       /*if(Filter_1 == 'Client')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Client</label>
       <div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;"
        class="form-control" id="Type_1" name="nom_complet"><option value="Client 1">Client 1 </option><option value="Client 2">Client 2</option><option value="Client 3">Client 3</option><option value="Client 4">Client 4</option><option value="Client 10">Client 11</option></select></div>');
       if(Filter_1 == 'Fourniseur')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Fourniseur</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control Type" id="Type_1"  name="nom_complet"><option value="Fourniseur 1">Fourniseur 1 </option><option value="Fourniseur 2">Fourniseur 2</option><option value="Fourniseur 3">Fourniseur 3</option><option value="Fourniseur 4">Fourniseur 4</option></select></div>');
       if(Filter_1 == 'Personne_physique')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label">Personne physique</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1"  name="nom_complet"><option value="Personne physique 1">Personne physique 1 </option><option value="Personne physique 2">Personne physique 2</option><option value="Personne physique 3">Personne physique 3</option><option value="Personne physique 4">Personne physique 4</option></select></div>');
       else
       if(Filter_1 == '0')
       $("#Type_select").html('<label for="example-text-input" class="col-sm-2 col-form-label"></label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1"  name="nom_complet"></select></div>');
       */
       $('#Type_1').select2();
      });





      $( "#hide_n_commande" ).hide();
      $(document).on('keyup','#n_commande', function(){
        var input  = $("#n_commande").val();
        $("#hide_n_commande" ).show();
        $("#n_commande").css("background-color", "#F39C12");
         if('' == input){
            $("#n_commande").css("background-color", "#F4D03F");
            $( "#hide_n_commande" ).hide();
         }

      });









      
      /**/
      /*Rangebicker*/
      var start =moment().subtract(2,'year');
      var end = moment().add(0,'year');
      function cb(start, end) {$('#Range_1 span').html('Achraf');}//start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
      $('#Range_1').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            applyLabel: 'Appliquer',
            customRangeLabel: 'Personnalisée',
        },
        
        startDate: start,
        endDate: end,
        ranges: {
           'Aujourd_hui': [moment(), moment()],
           'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
       }, cb);
      //cb(start, end);
    /*Fin rangebicker*/
    //
   
     
    //
    //Modal facture
    $(document).on('click','.view_detaiile_facture', function(){
            var Id_facture  = $(this).attr("data-id");
            
        if(Id_facture != 0)
       {
        $.ajax({
                     url: "{{ route('Facture.Modal') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_facture:Id_facture}, beforeSend:function(){
                 },
                     success: function(response){
                        //toastr.success("Bien Recherche");
                        $('.modal-body-facture').html(response); //This 
                        $('#Modal_Facture_Detaille').modal('show'); 
                     }
                 });
        }
        });
    //Fin modal facture
    //Print facture en eframe
    $(document).on('click','.print_facture', function(){
            var Id_facture  = $(this).attr("data-id");
            var myIframe = document.getElementById(Id_facture).contentWindow;
            myIframe.focus();
            myIframe.print();
            return false;   
    });
    //Fin print facture en eframe

    $(document).on('click','.print_payement', function(){
            var Id_facture  = $(this).attr("data-id");
            console.log('test ');
            console.log(Id_facture);
            var myIframe = document.getElementById(Id_facture).contentWindow;
            myIframe.focus();
            myIframe.print();
            return false;
    });
    //Fin print facture en eframe


    
    $(document).on('click','.print_bon_commande', function(){
            var Id_facture  = $(this).attr("data-id");
            var myIframe = document.getElementById(Id_facture).contentWindow;
            myIframe.focus();
            myIframe.print();
            return false;
    });
        //etat de raprochement 
    $(document).on('click','#filter_banque', function(){
        var banque  = $("#banque").val();
        var Filter_3  = $("#Range_1").val();
        var Date_debut = Filter_3.slice(0,10);
        var Date_fin = Filter_3.slice(13,23);

        $.ajax({
                     url: "{{ route('Banque_Filter') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      banque:banque,Date_debut:Date_debut,Date_fin:Date_fin}, beforeSend:function(){
                      $("#global").show();
                 },
                     success: function(response){
                        console.log(response);
                        $("#global").hide();
                        $(".filter_banque").html(response);
                     }
                 });









    })
    //fin etat de raprochement 


/*    $(document).on('click','.v_bancque', function(){
        var Id_facture  = $(this).attr("data-id");
        $.ajax({
                     url: "{{ route('Valide_Banque') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_facture:Id_facture}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success('validé par banque');
                     }
                 });
      
                 $(this).parent().hide();  
      
                });*/

                
    });
    //dLabel4
    $(document).on('click','.remplir_action_class', function(){
             
       $(".remplir_action").html('');
       var Id_facture  = $(this).attr("data-id");       
        $.ajax({
                     url: "{{ route('Remplire_Action') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_facture:Id_facture}, beforeSend:function(){
                 },
                     success: function(response){
                        console.log(response);
                        
                        $(".remplir_action").html(response);
                     }
        });

    });



    $(document).on('click','.delete_facture', function(){
            var Id_facture  = $(this).attr("data-id");
        
    //href="'.route('Supprimer_facture', $Facture->id).'"
    swal({
          title: "vous etes sûr ?",
          text: "Vous ne pourrez pas récupérer ce fichier !",
          icon: "warning",
          buttons: [
            'cancel',
            'valider'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Succès',
              text: 'bien supprimer',
              icon: 'success'
            }).then(function() {
                $.ajax({
                     url: "{{ route('Supprimer_facture') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_facture:Id_facture}, beforeSend:function(){
                 },
                     success: function(response){

                        location.assign(location.href);
                     }
            });
            });
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
        
    });


    //validé par banque
    
   
    $(document).on('click','.v_bancque', function(){
            var Id_facture  = $(this).attr("data-id");
        
    swal({
          title: "vous etes sûr ?",
          text: "Vous ne pourrez pas récupérer ce fichier !",
          icon: "warning",
          buttons: [
            'cancel',
            'valider'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Succès',
              text: 'bien supprimer',
              icon: 'success'
            }).then(function() {
                $.ajax({
                     url: "{{ route('Valide_Banque') }}",
                     type: 'get',
                     data: {
                      "_token": "{{ csrf_token() }}", 
                      Id_facture:Id_facture}, beforeSend:function(){
                 },
                     success: function(response){
                        toastr.success('validé par banque');
                     }
                 });
      
                 $(".remplir_action").html('');  
            });
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
        
    });
    //fin validé par banque

</script>
