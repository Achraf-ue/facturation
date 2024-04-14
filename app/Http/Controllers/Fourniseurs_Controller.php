<?php
namespace App\Http\Controllers;
use App\Models\fourniseur;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Fourniseurs_Controller extends Controller
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
    public function Ajouter_fourniseur(Request $request)
    {
       $data = new fourniseur();
       $data->nom = $request->nom;
       $data->adress = $request->address;
       $data->telephone = $request->telephone;
       $data->ICE = $request->ICE;
       $existeFourniseur   = fourniseur::where('nom','=',$data->nom)->count();

        $notification = array('message' => ' le fourniseur : '.$data->nom.' déja existe ', 'alert-type' => 'error');
        if(0 == $existeFourniseur){
          $notification = array('message' => 'Bien ajouter', 'alert-type' => 'success');
          $data->save();
        }
       
       $fourniseurs = fourniseur::all();
       return redirect()->route('list_fourniseur',compact('fourniseurs'))->with($notification);
    }
    public function Modifier_fourniseur(Request $request)
    {
        $data = [];
        $id = $request->fourniseur_id;
        $data = fourniseur::find($id);
        $data->nom = $request->nom;
        $data->adress = $request->address;
        $data->telephone = $request->telephone;
        $data->ICE = $request->ICE;
        $data->save();
        $fourniseurs = fourniseur::all();
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('list_fourniseur',compact('fourniseurs'))->with($notification);
    }
}
