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
            <h3>Edit Armada</h3>
        </div>
    </div>

        <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
     
        <form action="/armadastore" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                               
                                                <div class="form-group">
                                                    <label for="nama" class="col-form-label">Category Armada :</label>
                                                    <select name="ID_CATEGORY" class="form-control" id="ID_CATEGORY">
                                                        @foreach($category_armada as $c)
                                                       
                                                        <option value="{{$c->ID_CATEGORY}}">{{$c->NAMA_CATEGORY}}</option>
                                                       
                                                        @endforeach                 
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="platnomor" class="col-form-label">Plat Nomor :</label>
                                                    <input type="platnomor" class="form-control" id="platnomor" name="platnomor">
                                                    </div>
                                                <div class="form-group">
                                                    <label for="kapasitas" class="col-form-label">Kapasitas :</label>
                                                    <input type="kapasitas" class="form-control" id="kapasitas" name="kapasitas">
                                                    </div>
                                                <div class="form-group">
                                                    <label for="fasilitas" class="col-form-label">Fasilitas :</label>
                                                    <input type="fasilitas" class="form-control" id="fasilitas" name="fasilitas">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pilih Foto</label>
                                                            <input type="file" name="file" class="form-control" required>
                                                    </div>
                                                    </div>
                                                    <div><label>&nbsp;</label></div>
                                                <button type="submit" class="btn btn-primary" id="edit">Add</button>
                                            </div>
                                            </form>




                    </div>
                        </div>

                        </div>
                    </div>
                    </div>



@endsection