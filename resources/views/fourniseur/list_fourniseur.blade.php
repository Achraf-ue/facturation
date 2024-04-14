@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title">Fourniseur</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Fournisuer</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">liste fourniseur</a></li>
                            <li class="breadcrumb-item active">Vue</li>
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
                                        <th>ICE</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>


                                <tbody class="factures_Div">
                                    @foreach ($fourniseurs as $fourniseur)
                                    <tr>
                                        <td>{{$fourniseur->id}}</td>
                                        <td>{{$fourniseur->nom}}</td>
                                        <td>{{$fourniseur->adress}}</td>
                                        <td>{{$fourniseur->telephone}}</td>
                                        <td>{{$fourniseur->ICE}}</td>
                                        <td>
                                        <a href="{{route('Modifier_fourniseur',$fourniseur->id)}}"><button type="button" class="btn btn-success waves-effect waves-light">Modifier</button></a>  
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