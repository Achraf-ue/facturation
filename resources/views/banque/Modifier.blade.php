@extends('admin.admin_master')
@section('admin')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                    <div class="col-sm-6">
                        <h4 class="page-title">Client</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Client</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Modifier</a></li>
                    
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('modifier_banque_modifier')}}" enctype="multipart/form-data" >
                            @csrf
                            <input class="form-control" type="hidden" value="{{$banque->id}}"  name="banque_id">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" value="{{$banque->nom}}" placeholder="Nom client"  name="nom">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">address</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" value="{{$banque->adress}}" placeholder="address client"  name="address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">telephone</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" value="{{$banque->telephone}}" placeholder="telephone client"  name="telephone">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Numéro de compte</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" value="{{$banque->nCompte}}" placeholder="Numéro de compte"  name="nCompte">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="file"  name="banque_image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <td><img style="height:100px;width:100px;" src="{{asset($banque->image)}}" alt="Italian Trulli"></td>
                                </div>
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">modifier banque</button>
                            </div>
                        </div>

                            </form>
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