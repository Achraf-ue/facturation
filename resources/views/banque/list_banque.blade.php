@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title"></h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Banques</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">liste banque</a></li>
                        </ol>

                    </div>
                    </div>
                </div>
            </div>
            <!-- end row -->


                    <div class="card">
                        
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nom</th>
                                        <th>Adress</th> 
                                        <th>telephone</th>
                                        <th>Numéro de compte</th>
                                        <th>logo</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>


                                <tbody class="factures_Div">
                                    @foreach ($banques as $banque)
                                    <tr>
                                        <td>{{$banque->id}}</td>
                                        <td>{{$banque->nom}}</td>
                                        <td>{{$banque->adress}}</td>
                                        <td>{{$banque->telephone}}</td>
                                        <td>{{$banque->nCompte}}</td>
                                        <td><img style="height:100px;width:100px;" src="{{asset($banque->image)}}" alt="Italian Trulli"></td>
                                        <td>
                                        <a href="{{route('Modifier_banque',$banque->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a>  
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