<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Facture_Echeance_Controller;
use App\Http\Controllers\Client_Controller;
use App\Http\Controllers\Fourniseurs_Controller;
use App\Http\Controllers\Banque_Controller;
use App\Models\facture_echeance;
use App\Models\fourniseur;
use App\Models\client;
use App\Models\banque;
use App\Models\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        //dd(\Auth::user()->type);
        $Facture_Count            = facture_echeance::all()->count();
        $Facture_En_Cours         = facture_echeance::where('status','=','En cours')->count();
        $Facture_Payé             = facture_echeance::where('status','=','Payé')->count();
        $Facture_Payé_v            = facture_echeance::where('status','=','Payé')->where('v_banque','=',1)->count();
        $Facture_client           = facture_echeance::where('type','=','client')->count();
        $Facture_fourniseur       = facture_echeance::where('type','=','Fourniseur')->count();
        $facture_echeances       = facture_echeance::where('status','=','En cours')->get();
        $facture_echeances_valide      = facture_echeance::where('v_banque','=','1')->get();



        $debutDh = round(DB::table('facture_echeances')
        ->where('Type','like','%Fourniseur%')
        ->where('v_banque','=',1)
        ->where('devis','=','dh')
        ->sum('mantant'), 3);
        $creditDh = round(DB::table('facture_echeances')
        ->where('Type','like','%Client%')
        ->where('devis','=','dh')
        ->where('v_banque','=',1)
        ->sum('mantant'), 3);

        $debutEuro = round(DB::table('facture_echeances')
        ->where('Type','like','%Fourniseur%')
        ->where('devis','=','euro')
        ->where('v_banque','=',1)
        ->sum('mantant'),3);
        $creditEuro = round(DB::table('facture_echeances')
        ->where('Type','like','%Client%')
        ->where('devis','=','euro')
        ->where('v_banque','=',1)
        ->sum('mantant'), 3);

        //avec status en cours 
        
        $debutDh_enCours = round(DB::table('facture_echeances')
        ->where('Type','like','%Fourniseur%')
        ->where('status', '=', 'En cours')
        ->where('devis','=','dh')
        ->sum('mantant'), 3);
        $creditDh_enCours = round(DB::table('facture_echeances')
        ->where('Type','like','%Client%')
        ->where('devis','=','dh')
        ->where('status', '=', 'En cours')
        ->sum('mantant'), 3);

        $debutEuro_enCours = round(DB::table('facture_echeances')
        ->where('Type','like','%Fourniseur%')
        ->where('devis','=','euro')
        ->where('status', '=', 'En cours')
        ->sum('mantant'),3);
        $creditEuro_enCours = round(DB::table('facture_echeances')
        ->where('Type','like','%Client%')
        ->where('devis','=','euro')
        ->where('status', '=', 'En cours')
        ->sum('mantant'), 3);
        // fin status en cours 





        $banques = banque::all();

        $sum_g_dh = round($creditDh - $debutDh, 3);
        //dd($creditDh, $debutDh ,$sum_g_dh);
        $sum_g_euro = $creditEuro - $debutEuro;

        $sum_g_dh_enCours = round($creditDh_enCours - $debutDh_enCours, 3);
        //dd($creditDh, $debutDh ,$sum_g_dh);
        $sum_g_euro_enCours = $creditEuro_enCours - $debutEuro_enCours;



        return view('admin.index',compact('Facture_Count','Facture_En_Cours','Facture_Payé','Facture_Payé_v', 'Facture_client', 'Facture_fourniseur', 'facture_echeances', 'facture_echeances_valide', 'debutDh','creditDh', 'sum_g_dh', 'debutEuro','creditEuro', 'sum_g_euro', 'banques' , 'debutDh_enCours','creditDh_enCours', 'sum_g_dh_enCours', 'debutEuro_enCours','creditEuro_enCours', 'sum_g_euro_enCours'));
    })->name('index');
    Route::get('/admin/logout',function(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    })->name('admin.logout');
    
    
    Route::controller(Facture_Echeance_Controller::class)->group(function () {
        Route::get('/facture_echeances/vue',function(){
            $facture_echeances = facture_echeance::paginate(10);
            $banques = banque::all();
            return view('facture_echeance.facture',compact('facture_echeances', 'banques'));
        })->name('factures_echeances');
        Route::get('/factures_echeances/Ajoute',function(){
            $banques = banque::all();
            return view('facture_echeance.Ajouter',compact('banques'))
            ;}
            )->name('Ajouter_facture');
        Route::post('/factures_echeances/Ajoute/Ajouter','Ajouter_facture')->name('Ajouter_facture_echeances');
        Route::get('/facture_echeances/Modifier/{id}',function($id){

            $facture_echeance = facture_echeance::find($id);
            $banques = banque::all();
            $clients = client::all();
            $fourniseurs = fourniseur::all();
            return view('facture_echeance.Modifier',compact('facture_echeance', 'banques', 'clients', 'fourniseurs'));})->name('Modifier_facture');
        Route::post('/facture_echeances/Modifier','Modifier_facture')->name('modifier_facture_echeances');
        Route::get('/facture/Filter','Facture_Filter')->name('Facture_Filter');
        Route::get('/Facture/Model','Facture_Modal')->name('Facture.Modal'); 
        Route::get('/facture/PDF','Generate_Pdf')->name('Generate.Pdf');
        Route::get('/facture/Etat/Pdf/{id}','Etat_Facture_Pdf')->name('Etat.Facture.Pdf');
        Route::get('/facture/list_select','client_remplir_select2')->name('client_remplir_select');
        Route::post('/facture/export_zip','export_file_zip')->name('export_file_zip_r');
        Route::get('/facture/valide/banque','Valide_Banque')->name('Valide_Banque');
        Route::get('/banque/Filter','Banque_Filter')->name('Banque_Filter');
        Route::get('/facture/Remplire_Action','Remplire_Action')->name('Remplire_Action');

        Route::get('/facture_echeances/Supprimer','Supprimer_facture')->name('Supprimer_facture');

    });

    
    Route::controller(Client_Controller::class)->group(function () {
        Route::get('/clients/vue',function(){
            $clients = client::all();
            return view('client.list_client',compact('clients'));
        })->name('list_client');
        Route::get('/client/Ajoute',function(){return view('client.Ajouter');})->name('Ajouter_client_vue');
        Route::post('/client/Ajoute/Ajouter','Ajouter_client')->name('Ajouter_client');
        Route::get('/client/Modifier/{id}',function($id){
            $client = client::find($id);
            return view('client.Modifier',compact('client'));
        })->name('Modifier_client');
        Route::post('/client/Modifier','Modifier_client')->name('modifier_client_modifier');
    });

    Route::controller(Fourniseurs_Controller::class)->group(function () {
        Route::get('/fourniseurs/vue',function(){
            $fourniseurs = fourniseur::all();
            return view('fourniseur.list_fourniseur',compact('fourniseurs'));
        })->name('list_fourniseur');
        Route::get('/fourniseur/Ajoute',function(){return view('fourniseur.Ajouter');})->name('Ajouter_fourniseur_vue');
        Route::post('/fourniseur/Ajoute/Ajouter','Ajouter_fourniseur')->name('Ajouter_fourniseur');
        Route::get('/fourniseur/Modifier/{id}',function($id){
            $fourniseur = fourniseur::find($id);
            return view('fourniseur.Modifier',compact('fourniseur'));
        })->name('Modifier_fourniseur');
        Route::post('/fourniseur/Modifier/modifier','Modifier_fourniseur')->name('modifier_fourniseur_modifier');
    });

    //banque
    Route::controller(Banque_Controller::class)->group(function () {
        Route::get('/banques/vue',function(){
            $banques = banque::all();
            return view('banque.list_banque',compact('banques'));
        })->name('list_banque');
        Route::get('/banque/Ajoute',function(){return view('banque.Ajouter');})->name('Ajouter_banque_vue');
        Route::post('/banque/Ajoute/Ajouter','Ajouter_banque')->name('Ajouter_banque');
        Route::get('/banque/Modifier/{id}',function($id){
            $banque = banque::find($id);
            return view('banque.Modifier',compact('banque'));
        })->name('Modifier_banque');
        Route::post('/banque/Modifier','Modifier_banque')->name('modifier_banque_modifier');
      });
});
