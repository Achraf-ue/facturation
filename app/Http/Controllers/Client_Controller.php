<?php
namespace App\Http\Controllers;
use App\Models\client;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Client_Controller extends Controller
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
    public function Ajouter_client(Request $request)
    {
       $data = new client();
       $data->nom = $request->nom;
       $data->adress = $request->address;
       $data->telephone = $request->telephone;
       $data->ICE = $request->ICE;
       
       $existeClient   = client::where('nom','=',$data->nom)->count();
       $notification = array('message' => ' le client : '.$data->nom.' déja existe ', 'alert-type' => 'error');
       if(0 == $existeClient){
         $notification = array('message' => 'Bien ajouter', 'alert-type' => 'success');
         $data->save();
       }
      
      $clients = client::all();
      return redirect()->route('list_client',compact('clients'))->with($notification);
    }
    public function Modifier_client(Request $request)
    {
        $data = [];
        $id = $request->client_id;
        $data = client::find($id);
        $data->nom = $request->nom;
        $data->adress = $request->address;
        $data->telephone = $request->telephone;
        $data->ICE = $request->ICE;
        $data->save();
        $clients = client::all();
        $notification = array('message' => 'Bien modifier', 'alert-type' => 'success');
        return redirect()->route('list_client',compact('clients'))->with($notification);
    }
}
