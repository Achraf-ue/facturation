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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Ajouter</a></li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('Ajouter_client')}}" enctype="multipart/form-data" >
                            @csrf
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="Nom client"  name="nom">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">address</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="address client"  name="address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">telephone</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="telephone client"  name="telephone">
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">ICE</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" type="text" placeholder="ICE client"  name="ICE">
                                    </div>
                                </div>
                               
                                <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter client</button>
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