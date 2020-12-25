@extends('layouts.app')

@section('head')
    <!-- Slick -->
    <link rel="stylesheet" href="{{ url('/vendors/slick/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/vendors/slick/slick-theme.css') }}" type="text/css">

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">

    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
@endsection

@section('content')

<div class="page-header">
        <div class="page-title">
            <h3>Tambah Data User</h3>
        </div>
    </div>

        <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
     
        <form action="/penggunastore" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <label for="nama" class="col-form-label">Nama :</label>
                                        </div>
                                        <div class="col-lg-6">
                                        <label for="username" class="col-form-label">Username :</label>
                                        
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6"><input type="text" class="form-control" id="nama" name="nama"></div>
                                        <div class="col-lg-6"><input type="text" class="form-control" id="username" name="username"></div>
                                    
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <label for="email" class="col-form-label">Email :</label>
                                        </div>
                                        <div class="col-lg-6">
                                        <label for="telephone" class="col-form-label">Telephone :</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6"><input type="email" class="form-control" id="email" name="email"></div>
                                        <div class="col-lg-6"><input type="telephone" class="form-control" id="telephone" name="telephone"></div>
                                    
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <label for="alamat" class="col-form-label">Alamat :</label>
                                        </div>
                                        <div class="col-lg-6">
                                        <label for="password" class="col-form-label">Password :</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6"><textarea type="alamat" class="form-control" id="alamat" name="alamat"></textarea></div>
                                        <div class="col-lg-6"><input type="password" class="form-control" id="password" name="password"></div>
                                    
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <label for="JOB_STATUS" class="col-form-label">Job Status :</label>
                                        </div>
                                        <div class="col-lg-6">
                                        <label>Pilih Foto :</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <select name="JOB_STATUS" class="form-control" id="JOB_STATUS">
                                                <option selected="selected">--Pilih Job Status--</option>
                                                <option>Admin</option>
                                                <option>Kasir</option>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6"><input type="file" name="file" class="form-control"></div>
                                    </div>
                                    </div>
                                    <div><label>&nbsp;</label></div>
                                    <button type="submit" class="btn btn-primary" id="add">Add</button>
                                
                        </form>




                    </div>
                        </div>

                        </div>
                    </div>
                    



@endsection