<?php
namespace App\Http\Controllers;
use App\Models\facture_echeance;
use App\Models\Notification;
use App\Models\client;
use App\Models\fourniseur;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Facture_Echeance_Controller extends Controller
{
    private $now;
    private $now_time;
    private $Time;
    public function __construct()
    {
        $this->now       = Carbon::now()->addHour()->format('Y-m-d');
        $this->now_time  = Carbon::now()->addHour();
        $this->Time      = Carbon::now()->addHour()->format('H:m:s');
        
    }
    public function Ajouter_facture(Request $request)
    {
        //dd($request->devis);
       /*$request->validate([
        'n_facture'=>'required'
       ]);*/

       $data = new facture_echeance();
       $data->type = $request->Type;
       $data->nom_complet = $request->nom_complet;
       $data->n_facture = $request->n_facture;
       $data->taxation = $request->taxation;
       $data->date_facture = $request->date_facture;
       $data->date_echeance = $request->date_echeance;
       $data->n_bon_commande = $request->n_bon_commande;
       $data->remarque = $request->remarque_facture;
       $data->banque = $request->banque;
       $data->devis = $request->devis;

       if($data->date_facture > $request->date_echeance){
        $notification = array('message' => 'date echeance not valide', 'alert-type' => 'error');
        return redirect()->route('Ajouter_facture')->with($notification);
       }

       $data->mantant = $request->mantant;
       $data->status = $request->status;
       $data->Payement = $request->payement;
       $data->Nemero_payement = $request->n_file;
       
       //$data->facture_pdf = $request->facture_pdf;
            
            $facture_pdf = $request->file('facture_pdf');
            
            $facture_gen = hexdec(uniqid());
            $facture_ext  = strtolower($facture_pdf->getClientOriginalExtension()); 
            if($facture_ext == 'pdf' || $facture_ext == 'jpg'){

              $facture_name = 'Facture-'.$data->type.'-'.$data->nom_complet.'-'.$data->n_bon_commande.'-'.$data->date_facture.'.'.$facture_ext;
              $Up_Location = 'Backend/Factures/Pdf/';
              $Last_facture = $Up_Location.$facture_name;
              $facture_pdf->move($Up_Location,$facture_name);
              $data->facture_pdf = $Last_facture;
            }
            else
            {

                $facture_echeances = facture_echeance::all();
                $notification = array('message' => 'extention pas valide', 'alert-type' => 'error');
                return redirect()->route('factures_echeances',compact('facture_echeances'))->with($notification);
            }
            //add file of order 

            $facture_pdf = $request->file('bon_pdf_commande');
            
            $facture_gen = hexdec(uniqid());
            $facture_ext  = strtolower($facture_pdf->getClientOriginalExtension()); 
            if($facture_ext == 'pdf' || $facture_ext == 'jpg')
            {
                $facture_name = 'bon_command-'.$data->type.'-'.$data->nom_complet.'-'.$data->n_bon_commande.'-'.$data->date_facture.'.'.$facture_ext;
                $Up_Location = 'Backend/bon_commande/Pdf/';
            $Last_facture = $Up_Location.$facture_name;
            $facture_pdf->move($Up_Location,$facture_name);
            $data->fichie_bon_commande = $Last_facture;
            }
            else
            {

                $facture_echeances = facture_echeance::all();
                $notification = array('message' => 'extention pas valide', 'alert-type' => 'error');
                return redirect()->route('factures_echeances',compact('facture_echeances'))->with($notification);
            }

            //



            $file_pdf = $request->file('payement_file');
            if($file_pdf != null)
            {
            $facture_gen = hexdec(uniqid());
            $facture_ext  = strtolower($facture_pdf->getClientOriginalExtension()); 
            if($facture_ext == 'pdf' || $facture_ext == 'jpg')
            {
                $facture_name = 'mode_payment-'.$data->type.'-'.$data->nom_complet.'-'.$data->n_bon_commande.'-'.$data->date_facture.'.'.$facture_ext;
                $Up_Location = 'Backend/Factures/Pdf/';
            $Last_facture = $Up_Location.$facture_name;
            $file_pdf->move($Up_Location,$facture_name);
            $data->file_payement = $Last_facture;
            }
            else
            {

                $facture_echeances = facture_echeance::all();
                $notification = array('message' => 'extention pas valide', 'alert-type' => 'error');
                return redirect()->route('factures_echeances',compact('facture_echeances'))->with($notification);
            }
            }
            else
            $data->file_payement = 'lien';
       $Facture_with_nemero = DB::table('facture_echeances')
       ->where('n_facture','=',$data->n_facture)
       ->first();

       $Facture_with_n_bon_command = DB::table('facture_echeances')
       ->where('n_bon_commande','=',$data->n_bon_commande)
       ->first();
       if($Facture_with_nemero == null && $Facture_with_n_bon_command == null)
       {
        if($request->status == 'Payé'){
            $data->date_payement = $this->now_time;
        }
        

        $data->save();
        if($request->status == 'En cours')
        {
            $Factures = DB::table('facture_echeances')->where('n_facture','=',$data->n_facture)->first();
            $data_notification  = new Notification();
            $data_notification->Lire_notification = '0';
            $data_notification->Titre = 'Facture de reference : '.$Factures->n_facture.'';
            $data_notification->Notifiaction = 'Facture '.$Factures->type.' '.$Factures->nom_complet.' et de mantant facture '.$Factures->mantant.' est de status en cours';
            $data_notification->id_fature = $Factures->id;
            $data_notification->save();
        }

       }
       else{
        
        $facture_echeances = facture_echeance::all();
        $notification = array('message' => 'bon command ou nemero facture est daja exist', 'alert-type' => 'error');
        return redirect()->route('factures_echeances',compact('facture_echeances'))->with($notification);

       }
       
       $facture_echeances = facture_echeance::all();
       return view('facture_echeance.facture',compact('facture_echeances'));
    }
    public function Modifier_facture(Request $request)
    {
        $data = [];
        $id = $request->id;
        $data = facture_echeance::find($id);
        $data->type = $request->Type;
        //dd($request);
        //dd($request);
        //dd($request->n_complet);
        $data->nom_complet = $request->n_complet;
        $data->date_payement = $this->now_time;
        $data->n_facture = $request->n_facture;
        $data->date_facture = $request->date_facture;
        $data->mantant = $request->mantant;
        $data->status = $request->status;
        $data->Payement = $request->payement;
        $data->Nemero_payement = $request->n_file;

        /*if(empty($data->Nemero_payement)){   
            $notification = array('message' => 'némero de payment not valide ', 'alert-type' => 'error');
            return redirect()->route('Modifier_facture', $id)->with($notification);
        }*/

        $Facture_with_nemero_payement = DB::table('facture_echeances')
        ->where('Nemero_payement','=',$data->Nemero_payement)
        ->first();


        if(null !== $Facture_with_nemero_payement  && 'Payé' == $data->status ){   
                $notification = array('message' => 'némero de payment deja existe', 'alert-type' => 'error');
                return redirect()->route('Modifier_facture', $id)->with($notification);
        }

        $data->remarque = $request->remarque_facture;
        $data->banque = $request->banque;

            

        $facture_pdf = $request->file('facture_pdf');
        if($facture_pdf != null)
            {
            $facture_gen = hexdec(uniqid());
            $facture_ext  = strtolower($facture_pdf->getClientOriginalExtension()); 
            $facture_name = $facture_gen.'.'.$facture_ext;
            $Up_Location = 'Backend/Payement/Pdf/';
            $Last_facture = $Up_Location.$facture_name;
            $facture_pdf->move($Up_Location,$facture_name);
            $data->file_payement = $Last_facture;
            }
            else
            $data->file_payement = 'lien';





        if($data->status == 'Payé')
        {
            $data_notification = [];
            $data_notification = Notification::where('id_fature',$id)->first();
            if($data_notification != null){
             $data_notification->Lire_notification = '1';
             $data_notification->save();
            }

        }
        //$data->facture_pdf = $request->facture_pdf;
        $data->save();
        $facture_echeances = facture_echeance::all();
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('factures_echeances',compact('facture_echeances'))->with($notification);
    }
    //Cherche_Facture
    public function Facture_Filter(Request $request)
    {
        if($request->ajax())
        {
            $Filter_1    = $_GET['Filter_1'];
            $Filter_2    = $_GET['Filter_2'];
            $Date_fin    = $_GET['Date_fin'];
            $Date_debut  = $_GET['Date_debut'];
            $Nom_complet = $_GET['Nom_complet'];
            $Type_Facture = $_GET['Type_Facture'];
            $N_bon_Command = $_GET['N_bon_Command'];
            $N_Payment = $_GET['N_Payment'];
            $M_Payment = $_GET['M_Payment'];
            $devis = $_GET['devis'];

            $output ='<thead>
            <tr>
                <th>Id</th>
                <th>Raison sociale</th>
                <th>N facture</th>
                <th>Date facture</th>
                <th>Crédit</th>
                <th>Début</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';
            $Factures =  DB::table('facture_echeances')
            ->where('type','like','%'.$Type_Facture.'%')
            ->where('nom_complet','like','%'.$Nom_complet.'%')
          ->where('status','like','%'.$Filter_1.'%')
           ->where('id','like','%'.$Filter_2.'%')
             ->where('n_bon_commande','like','%'.$N_bon_Command.'%')
          // ->where('Nemero_payement','like','%'.$N_Payment.'%')
          ->where('Payement','like','%'.$M_Payment.'%')
            ->where('devis','like','%'.$devis.'%')
            ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
            ->get();

            //return response($Filter_2. '/'.$Type_Facture);

            $Credit = 0;
            if('Client' == $Type_Facture || '' == $Type_Facture){
                $Credit   =  DB::table('facture_echeances')
                ->where('nom_complet','like','%'.$Nom_complet.'%')
                ->where('Type','like','%Client%')
                ->where('status','like','%'.$Filter_1.'%')
                ->where('id','like','%'.$Filter_2.'%')
                ->where('n_bon_commande','like','%'.$N_bon_Command.'%')
                ->where('Nemero_payement','like','%'.$N_Payment.'%')
                ->where('Payement','like','%'.$M_Payment.'%')
                ->where('devis','like','%'.$devis.'%')
                ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
                ->sum('mantant');
            }

            $Début = 0;
            if('Fourniseur' == $Type_Facture || '' == $Type_Facture){
                $Début    =  DB::table('facture_echeances')
                ->where('nom_complet','like','%'.$Nom_complet.'%')
                ->where('Type','like','%Fourniseur%')
                ->where('status','like','%'.$Filter_1.'%')
                ->where('id','like','%'.$Filter_2.'%')
                ->where('n_bon_commande','like','%'.$N_bon_Command.'%')
                ->where('Nemero_payement','like','%'.$N_Payment.'%')
                ->where('Payement','like','%'.$M_Payment.'%')
                ->where('devis','like','%'.$devis.'%')
                ->whereBetween('date_facture',[$Date_debut ,$Date_fin])->sum('mantant');
            }

            foreach($Factures as $Facture)
            {
                $date = Carbon::parse($Facture->date_facture)->locale('fr_FR');
                $output .='<tr><td>'.$Facture->id.'</td><td>'.$Facture->nom_complet.'</td><td>'.$Facture->n_facture.'</td><td>'.$Facture->date_facture.'</td>';
                if($Facture->type == 'Client' || $Facture->type == 'Personne_physique' )
                $output .= '<td>'.$Facture->mantant.'</td>';
                else
                $output .= '<td></td>';
                if($Facture->type == 'Fourniseur')
                $output .= '<td>'.$Facture->mantant.'</td>';
                else
                $output .= '<td></td>';
                if($Facture->status == 'Payé'){
                    $output .= '<td><span class="badge badge-success">'.$Facture->status.'';
                  if($Facture->v_banque == 1){
                    $output .= ' /B';  
                   }
                $output .= '</span></td><td>';
                }
                else
                $output .= '<td><span class="badge badge-danger">'.$Facture->status.'</span></td><td>';

                $output.= '                                        <a class="nav-link dropdown-toggle arrow-none remplir_action_class" id="dLabel4" data-id="'.$Facture->id.'" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i  data-toggle="tooltip" data-placement="top" title="Archive detaille" class="fas fa-ellipsis-v font-20 text-muted"></i>
                                       </a>
               <div class="dropdown-menu dropdown-menu-right remplir_action" aria-labelledby="dLabel4">
               </div>';
                
               $output .= '</td></tr>';
            }
            $output .='<tr><td></td><td></td><td>Totale :</td><td></td><td>'.number_format($Credit,2,',',' ').'</td><td>'.number_format($Début,2,',',' ').'</td><td></td><td></td></tr>';
            return response($output);
        }
    }
    public function Facture_Modal(Request $request)
    {
        if($request->ajax())
        {
        $output = $Id_Facture = $_GET['Id_facture'];
        //$facture = DB::table('facture_echeances')->where('id','=',$Id_Facture)->pluck('facture_pdf')->first();
        $Facture = DB::table('facture_echeances')->where('id','=',$Id_Facture)->first();
        $output = '<h1 style="text-align: center;">Etat de facture  <a href="'.route('Etat.Facture.Pdf',$Facture->id).'"><button type="button"    class="btn btn-info waves-effect waves-light"><i class="mdi mdi-file-pdf"></i></button></a></h1>
                        <table style="width: 500px; margin-left:auto; 
                margin-right:auto; margin-bottom:20px;" id="customers">
                <tr>
                    <th colspan="2" class="th-1">Facture '.$Facture->n_facture.'</th>
                </tr>
                <tr>
                    <td class="th-1">Facture ID</td>
                    <td>'.$Facture->id.'</td>
                </tr>
                <tr>
                    <td class="th-1">Banqaue</td>
                    <td>'.$Facture->banque.'</td>
                </tr>
                <tr>
                    <td class="th-1">Type</td>
                    <td>'.$Facture->type.'</td>
                </tr>
                <tr>
                    <td class="th-1">Nom complet</td>
                    <td>'.$Facture->nom_complet.'</td>
                </tr>
                <tr>
                    <td class="th-1">Némero bon de commande</td>
                    <td>'.$Facture->n_bon_commande.'</td>
                </tr>
                <tr>
                    <td class="th-1">N facture</td>
                    <td>'.$Facture->n_facture.'</td>
                </tr>
                <tr>
                    <td class="th-1">Date facure</td>';
                    $date = Carbon::parse($Facture->date_facture)->locale('fr_FR');
                    $output .= '<td>'.$Facture->date_facture.'  '.$date->dayName.'</td>
                </tr>
                <tr>
                <td class="th-1">TAX</td>
                <td>'.$Facture->taxation.'</td>
                </tr>
                <tr>
                    <td class="th-1">Remarque</td>
                    <td style="height:100px">'.$Facture->remarque.'</td>
                </tr>
                <tr>
                    <td class="th-1">Date payement</td>
                    <td>'.$Facture->date_payement.'</td>
                </tr>
                <tr>
                    <td class="th-1">Mantant</td>
                    <td>'.$Facture->mantant.' '.$Facture->devis.'</td>
                </tr>
                <tr>
                    <td class="th-1">Status</td>
                    <td>'.$Facture->status.'</td>
                </tr>';


                if(0 != $Facture->Payement){
                                    $output .= '<tr>
                    <td class="th-1">Moyenne paiement</td>
                    <td>'.$Facture->Payement.'</td>
                </tr>
                <tr>
                    <td class="th-1">Némero de '.$Facture->Payement.'</td>
                    <td>'.$Facture->Nemero_payement.'</td>
                </tr>';
                if(0 != $Facture->v_banque){
                    $output .='<tr>
                    <td style="background-color: red;" class="th-1">validé par banque</td>
                    <td style="background-color: red;">Ok</td>
                    </tr>';
                }
                }



                $output .= '</table>';
        return response($output);
        }
    }
    public function Generate_Pdf()
    {
            $Filter_1    = $_GET['Filter_1'];
            $Filter_2    = $_GET['Filter_2'];
            $Date_fin    = $_GET['Date_fin'];
            $Date_debut  = $_GET['Date_debut'];
            $Nom_complet = $_GET['Nom_complet'];
            $Type_Facture = $_GET['Type_Facture'];
            $Generate_Facture = $_GET['Generate_Facture'];
            
            $output ='';
            $Factures =  DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->get();
            $Credit   =  round(DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('Type','like','%Client%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->sum('mantant'), 3);
            $Début    =  round(DB::table('facture_echeances')->where('type','like','%'.$Type_Facture.'%')->where('nom_complet','like','%'.$Nom_complet.'%')->where('Type','like','%Fourniseur%')->where('status','like','%'.$Filter_1.'%')->where('id','like','%'.$Filter_2.'%')->whereBetween('date_facture',[$Date_debut ,$Date_fin])->sum('mantant'), 3);
            

        $fileName = ' ';
        if($Generate_Facture == 'Pdf')
        {
            $range = $Date_debut.' - '.$Date_fin;
            $data = 'Laravel Sanctum';
            $pdf = PDF::loadView('facture_echeance.Facture_pdf',compact('Factures','Credit','Début', 'range'));
            $path = public_path('pdf/');
            $fileName =  time().'.'. 'pdf' ;
            $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        $fileName = 'http://localhost/Gestion_Facturationok/public/pdf/'.$fileName;
        }
        return response($fileName);
    }
    public function Etat_Facture_Pdf($id)
    {
        $Facture = facture_echeance::find($id);
        $pdf = PDF::loadView('facture_echeance.Etat_facture', compact('Facture'));
        $Nom =  'Etat_Facture_'.$Facture->n_facture.'_'.$Facture->nom_complet.'.pdf';
        return $pdf->download($Nom);
    }

    public function client_remplir_select2(Request $request)
    {
        $Filter_1    = $_GET['Filter_1'];
        $output ='<label for="example-text-input" class="col-sm-2 col-form-label">Fournisseur</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1" name="nom_complet"><option value=""></option>';
        $selectDatas = fourniseur::all();
        if($Filter_1 == 'Client'){
            $output ='<label for="example-text-input" class="col-sm-2 col-form-label">Client</label><div class="col-sm-10"><select style="width:150px;display:inline-block;margin-right:5px;" class="form-control" id="Type_1" name="nom_complet"><option value=""></option>';
            $selectDatas = client::all();
        }

        foreach($selectDatas as $selectData){
            $output .= '<option value="'.$selectData->nom.'">'.$selectData->nom.'</option>';
         }
        $output = $output.' </select></div>';

        return response($output);
    }
    
    public function export_file_zip(Request $request){

        $N_Facture = $request->N_Facture ?? '';
        $status_facture = $request->status_facture ?? '';
        $nom_complet = $request->nom_complet ?? '';
        $type = $request->type ?? '';
        $date_ranger = $request->date_ranger ?? '';
        $b_command = $request->b_command ?? '';
        $n_payment = $request->n_payment ?? '';
        $m_payment = $request->m_payment ?? '';


        //dd(substr($date_ranger , 0, 10), substr($date_ranger , 13, 23));
        //var Date_debut = Filter_3.slice(0,10);
        //var Date_fin = Filter_3.slice(13,23);
        //dd($date_ranger);



        $date = new \DateTime();
        $zip_file = 'export_file-'.$date->format('Y-m-d_H_i_s').'.zip'; // Name of our archive to download
        //dd($zip_file);
        //dd($zip_file);
        // Name of our archive to download

    // Initializing PHP class
    $zip = new \ZipArchive();
    $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
    
    //$facture_echeances = facture_echeance::all();
    
    $facture_echeances =  DB::table('facture_echeances')
    ->where('type','like','%'.$type.'%')
    ->where('nom_complet','like','%'.$nom_complet.'%')
    ->where('status','like','%'.$status_facture.'%')
    ->where('id','like','%'.$N_Facture.'%')
    ->where('n_bon_commande','like','%'.$b_command.'%')
    ->where('Nemero_payement','like','%'.$n_payment.'%')
    ->where('Payement','like','%'.$m_payment.'%')
    ->whereBetween('date_facture',[substr($date_ranger , 0, 10) ,substr($date_ranger , 13, 23)])
    ->get();
    
    if(0 != count($facture_echeances)){
            foreach($facture_echeances as $facture_echeance){
        $this->addFileToZipWithDirectory($facture_echeance->facture_pdf, $zip, 'Facture');
        $this->addFileToZipWithDirectory($facture_echeance->fichie_bon_commande, $zip, 'bon de commande');
        $this->addFileToZipWithDirectory($facture_echeance->file_payement, $zip, 'Mode de payments');
    }
    $zip->close();

    // We return the file immediately after download
    return response()->download($zip_file);


    }

    $notification = array('message' => 'pas trouvé des factures', 'alert-type' => 'error');
    return redirect()->route('factures_echeances')->with($notification);
    

    }

    private function addFileToZipWithDirectory($file, $zip, $targetDirectory)
    {
        if($file != 'lien'){
          $relativePath = $targetDirectory . '/' . basename($file);
          $zip->addFile($file, $relativePath);
        }

    }

        public function Valide_Banque(Request $request)
    {
        if($request->ajax())
        {
            $id    = $_GET['Id_facture'];
            $data = [];
            $data = facture_echeance::find($id);
            $data->v_banque = 1;
            $data->save();
         return response($id);
        }
    }

    //filter par banque et date
    public function Banque_Filter(Request $request)
    {
        if($request->ajax())
        {
            $banque    = $_GET['banque'];
            $Date_debut    = $_GET['Date_debut'];
            $Date_fin    = $_GET['Date_fin'];

            $output ='
            <table id="datatable" class="table table-bordered dt-responsive nowrap factures_Div" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>Id</th>
                <th>Raison sociale</th>
                <th>Date facture</th>
                <th>Date echeance</th>
                <th>Crédit</th>
                <th>Début</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';


            $Factures =  DB::table('facture_echeances')
            ->where('banque','like','%'.$banque.'%')
            ->where('v_banque','=','1')
            ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
            ->get();
            
                $Credit   =  DB::table('facture_echeances')
                ->where('Type','like','%Client%')
                ->where('banque','=',$banque)
                ->where('v_banque','=','1')
                ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
                ->sum('mantant');

                $Début    =  DB::table('facture_echeances')
                ->where('Type','like','%Fourniseur%')
                ->where('banque','=',$banque)
                ->where('v_banque','=','1')
                ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
                ->sum('mantant');

                $sum = $Credit - $Début;

                if($banque == "Banques"){

                    $Factures =  DB::table('facture_echeances')
                    ->where('v_banque','=','1')
                    ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
                    ->get();
                    
                    $Début = DB::table('facture_echeances')
                    ->where('Type','like','%Fourniseur%')
                    ->where('v_banque','=',1)
                    ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
                    ->sum('mantant');

                    $Credit = DB::table('facture_echeances')
                    ->where('Type','like','%Client%')
                    ->where('v_banque','=',1)
                    ->whereBetween('date_facture',[$Date_debut ,$Date_fin])
                    ->sum('mantant');

                        $sum = $Credit - $Début;
                
                }
            //return response($output);

            //return response($Filter_2. '/'.$Type_Facture);
            
            foreach($Factures as $Facture)
            {
                $date = Carbon::parse($Facture->date_facture)->locale('fr_FR');
                $output .='<tr><td>'.$Facture->id.'</td><td>'.$Facture->nom_complet.'</td><td>'.$Facture->date_facture.'</td><td>'.$Facture->date_echeance	.'</td>';
                if($Facture->type == 'Client' || $Facture->type == 'Personne_physique' )    
                $output .= '<td>'.$Facture->mantant.'</td>';
                else
                $output .= '<td></td>';
                if($Facture->type == 'Fourniseur')
                $output .= '<td>'.$Facture->mantant.'</td>';
                else
                $output .= '<td></td>';
                if($Facture->status == 'Payé')
                $output .= '<td><span class="badge badge-success">'.$Facture->status.'</span></td><td>';
                else
                $output .= '<td><span class="badge badge-danger">'.$Facture->status.'</span></td><td>';
                if($Facture->status == "En cours")
                $output .=    '<a href="'.route('Modifier_facture',$Facture->id).'"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a> '; 
                $output .= '<a data-toggle="tooltip" data-placement="top" title="Detailles" class="view_detaiile_facture" data-id="'.$Facture->id.'" ><button type="button" id="Button_View"   class="btn btn-secondary waves-effect waves-light"><i class="ti-eye"></i></button></a>
                <a data-toggle="tooltip" data-placement="top" title="Facture" class="print_facture" data-id="'.$Facture->id.'"><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="mdi mdi-download"></i></button></a>
                <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="'.$Facture->id.'" class="myFrame"  src="'.asset($Facture->facture_pdf).'"></iframe></object>';

                $output .='<a data-toggle="tooltip" data-placement="top" title="bon commande" class="print_bon_commande" data-id="'.$Facture->n_bon_commande.'" ><button type="button" id="Button_View"   class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-bookmark-outline"></i></button></a>
                <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="'.$Facture->n_bon_commande.'" class="myFrame"  src="'.asset($Facture->fichie_bon_commande).'"></iframe></object>';


                if($Facture->status == 'Payé'){
                    $output .=  '<a data-toggle="tooltip" data-placement="top" title="Mode de payment" class="print_payement" data-id="'.$Facture->status.'" ><button type="button" id="Button_View"   class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-square-inc-cash"></i></button></a>   
                    <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="'.$Facture->status.'" class="myFrame" src="'.asset($Facture->file_payement).'"></iframe></object>';
                }

                if($Facture->v_banque == 0 && $Facture->status == 'Payé'){
                    $output .=  '<div id="'.$Facture->id.'"> <a class="v_bancque" data-toggle="tooltip" data-placement="top" title="Valide par banque "   data-toggle="tooltip" data-placement="top" title="Tooltip on top"  data-id="'.$Facture->id.'" ><button type="button" id="v_bancque"   class="btn btn-success waves-effect waves-light"><i class="mdi mdi-currency-usd    "></i></button></a>   </div>
                    ';
                }
                
               $output .= '</td></tr>';
            }
            $output .='<tr><td></td><td></td><td></td><td>Totale :</td><td>'.number_format($Credit,2,',',' ').'</td><td>'.number_format($Début,2,',',' ').'</td><td>'.number_format($sum,2,',',' ').'</td><td></td></tr>';
            return response($output);
        }
    }
    //fin filter

    public function Remplire_Action(Request $request)
    {
        if($request->ajax())
        {
            $id    = $_GET['Id_facture'];
            $output ='';
            $Facture = facture_echeance::find($id);
            
            if($Facture->status == "En cours")
                $output .=    '<a href="'.route('Modifier_facture',$Facture->id).'"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a> '; 
                $output .= '<a data-toggle="tooltip" data-placement="top" title="Detailles" class="view_detaiile_facture" data-id="'.$Facture->id.'" ><button type="button" id="Button_View"   class="btn btn-secondary waves-effect waves-light"><i class="ti-eye"></i></button></a>
                <a data-toggle="tooltip" data-placement="top" title="Facture" class="print_facture" data-id="'.$Facture->id.'"><button type="button" id="Button_View"   class="btn btn-info waves-effect waves-light"><i class="mdi mdi-download"></i></button></a>
                <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="'.$Facture->id.'" class="myFrame"  src="'.asset($Facture->facture_pdf).'"></iframe></object>';

                $output .='<a data-toggle="tooltip" data-placement="top" title=" bon commande" class="print_bon_commande" data-id="'.$Facture->n_bon_commande.'" ><button type="button" id="Button_View"   class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-bookmark-outline"></i></button></a>
                <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="'.$Facture->n_bon_commande.'" class="myFrame"  src="'.asset($Facture->fichie_bon_commande).'"></iframe></object>';


                if($Facture->status == 'Payé'){
                    $output .=  '<a data-toggle="tooltip" data-placement="top" title="Mode de payment" class="print_payement" data-id="'.$Facture->status.'" ><button type="button" id="Button_View"   class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-square-inc-cash"></i></button></a>   
                    <object style="display: none" data="your_url_to_pdf" type="application/pdf"><iframe style="height: 500px;width:750px" id="'.$Facture->status.'" class="myFrame" src="'.asset($Facture->file_payement).'"></iframe></object>';
                }
                


                if($Facture->v_banque == 0 && $Facture->status == 'Payé'){
                    $output .=  '<div id="'.$Facture->id.'"> <a class="v_bancque" data-toggle="tooltip" data-placement="top" title="Valide par banque "   data-toggle="tooltip" data-placement="top" title="Tooltip on top"  data-id="'.$Facture->id.'" ><button type="button" id="v_bancque"   class="btn btn-success waves-effect waves-light"><i class="mdi mdi-currency-usd    "></i></button></a>   </div>';
                }

                if($Facture->v_banque == 0){
                    $output .=  '<a  class="delete_facture" data-id="'.$Facture->id.'" data-toggle="tooltip" data-placement="top" title="Supprimer"   data-toggle="tooltip" data-placement="top" title="Tooltip on top"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-delete-circle"></i></button></a>';
                }
              
            return response($output);
        }
    }

    public function Supprimer_facture(Request $request){
        if($request->ajax())
        {
        $id = $_GET['Id_facture'];
        facture_echeance::where('id',$id)->delete();
        Notification::where('id_fature', $id)->delete();
        return response('test');
        }
    }


}
