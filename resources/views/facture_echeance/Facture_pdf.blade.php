<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        td,th {border: 1px solid;}
        h1{
            text-align: center;
            color: red;
        }
    </style>
    <h1 style="font-family: Arial, Helvetica; color: black">Etat de facture</h1>
    <h2>Operation : {{ $range }}</h2>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    ">
        <thead style="background-color: #839192; height: 20px;px">
        <tr style="">
            <th>Banque</th>
            <th>Nom complet</th>
            <th>N facture</th> 
            <th>Date facture</th>
            <th>Date payement</th>
            <th>Crédit</th>
            <th>Débit</th>
            <th>Status / v-b</th>
            <th>payment / numéro</th>
        </tr>
        </thead>


        <tbody class="factures_Div">
        @foreach ($Factures as $facture_echeance)
        <tr>
            <td>{{$facture_echeance->banque}}</td>
            <td>{{$facture_echeance->nom_complet}} - {{$facture_echeance->type}}</td>
            <td>{{$facture_echeance->n_facture}}</td>
            <?php $date = Carbon\Carbon::parse($facture_echeance->date_facture)->locale('fr_FR'); ?>
            <td>{{$facture_echeance->date_facture}}</td>
            <?php $date = Carbon\Carbon::parse($facture_echeance->date_payement)->locale('fr_FR'); ?>
            <td>{{$date->format('Y-m-d')}}</td>

            @if ($facture_echeance->type == "Client")
            <td>{{ $facture_echeance->mantant }}</td>
            @else
            <td></td>
            @endif
            @if ($facture_echeance->type == "Fourniseur")
            <td>{{$facture_echeance->mantant}}</td>  
            @else
            <td></td>  
            @endif

            @if ($facture_echeance->status == "payé")

            @if ($facture_echeance->v_banque == 1)
            <td><span class="badge badge-success">{{$facture_echeance->status}} - ok</span></td>
            @else
            <td><span class="badge badge-success">{{$facture_echeance->status}} - en cours</span></td>
            @endif
            @else
            @if ($facture_echeance->v_banque == 1)
            <td><span class="badge badge-success">{{$facture_echeance->status}} - Ok</span></td>
            @else
            <td><span class="badge badge-success">{{$facture_echeance->status}}</span></td>
            @endif


            @endif

            <td>{{$facture_echeance->Payement}} - {{$facture_echeance->Nemero_payement}}</td>

            </tr>@endforeach        
        
        </tbody>
    </table>
    <h2 style="color: green;">Totale crédit :  {{ $Credit }}.00</h2>
    <h2 style="color: red;">Totale Débit :  {{ $Début }}.00 </h2>
    <h2>Totale :  {{ $Credit - $Début }}.00</h2>

</body>
</html>