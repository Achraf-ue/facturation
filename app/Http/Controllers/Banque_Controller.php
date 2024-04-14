<?php
namespace App\Http\Controllers;
use App\Models\banque;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Banque_Controller extends Controller
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
    public function Ajouter_banque(Request $request)
    {
       $data = new banque();
       $data->nom = $request->nom;
       $data->adress = $request->address;
       $data->telephone = $request->telephone;
       
       $data->nCompte = $request->nCompte;

       $image_banque = $request->file('image_banque');
       if($image_banque != null)
           {
           $facture_gen = hexdec(uniqid());
           $facture_ext  = strtolower($image_banque->getClientOriginalExtension()); 
           $facture_name = $facture_gen.'.'.$facture_ext;
           $Up_Location = 'Backend/banque/images/';
           $Last_facture = $Up_Location.$facture_name;
           $image_banque->move($Up_Location,$facture_name);
           $data->image = $Last_facture;
           }
           else
           $data->file_payement = 'lien';





       $existeClient   = banque::where('nom','=',$data->nom)->count();
       $notification = array('message' => ' la banque : '.$data->nom.' déja existe ', 'alert-type' => 'error');
       if(0 == $existeClient){
         $notification = array('message' => 'Bien ajouter', 'alert-type' => 'success');
         $data->save();
       }
      
      $banques = banque::all();
      return redirect()->route('list_banque',compact('banques'))->with($notification);
    }
    public function Modifier_banque(Request $request)
    {
        $data = [];
        $id = $request->banque_id;
        $data = banque::find($id);
        $data->nom = $request->nom;
        $data->adress = $request->address;
        $data->telephone = $request->telephone;
        $data->nCompte = $request->nCompte;
        //dd($request);
        $image_banque = $request->file('banque_image');
        if($image_banque != null)
        {
        $facture_gen = hexdec(uniqid());
        $facture_ext  = strtolower($image_banque->getClientOriginalExtension()); 
        $facture_name = $facture_gen.'.'.$facture_ext;
        $Up_Location = 'Backend/banque/images/';
        $Last_facture = $Up_Location.$facture_name;
        $image_banque->move($Up_Location,$facture_name);
        $data->image = $Last_facture;
        }
        $data->save();
        $banques = banque::all();
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('list_banque',compact('banques'))->with($notification);
    }
}
