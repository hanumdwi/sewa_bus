@extends('layouts.app')

@section('head')
    <!-- Slick -->
    <link rel="stylesheet" href="{{ url('/vendors/slick/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/vendors/slick/slick-theme.css') }}" type="text/css">

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">

    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">

    <!-- Css -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">

    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')
@if(\Session::has('kasir') || \Session::has('admin'))
<div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-0">Table Sewa Paket Wisata</h6>
                </div>
                <div class="table-responsive">
                <center>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                Tambah Data Sewa Paket
                    </button>
                    </center>
                        <!-- modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal1Label">Tambah Data Sewa Paket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="sewa_paketstore" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama User :</label>
                                    <select name="ID_PENGGUNA" class="form-control" id="ID_PENGGUNA">
                                        @foreach($pengguna as $png)
                                       
                                        <option value="{{$png->ID_PENGGUNA}}">{{$png->NAMA_PENGGUNA}}</option>
                                       
                                        @endforeach                 
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama Customer :</label>
                                    <select name="ID_CUSTOMER" class="form-control" id="ID_CUSTOMER">
                                        @foreach($customer as $cus)
                                       
                                        <option value="{{$cus->ID_CUSTOMER}}">{{$cus->NAMA_CUSTOMER}}</option>
                                       
                                        @endforeach                 
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama Paket :</label>
                                    <select name="ID_PAKET" class="form-control" id="ID_PAKET">
                                        @foreach($paket_wisata as $pw)
                                       
                                        <option value="{{$pw->ID_PAKET}}">{{$pw->NAMA_PAKET}}</option>
                                       
                                        @endforeach                 
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="TGL_SEWA" class="col-form-label">Start Date :</label>
                                    <input type="date" class="form-control" id="TGL_SEWA_PAKET" name="TGL_SEWA_PAKET">
                                    </div>
                                <div class="form-group">
                                    <label for="TGL_AKHIR_SEWA">End Date :</label>
                                    <input type="date" class="form-control create-event-datepicker" id="TGL_AKHIR_SEW_PAKET" name="TGL_AKHIR_SEWA_PAKET">
                                    </div>
                                <div class="form-group">
                                    <label for="JAM_SEWA" class="col-form-label">Start Time :</label>
                                    <input type="time" class="form-control" id="JAM_SEWA_PAKET" name="JAM_SEWA_PAKET">
                                    </div>
                                <div class="form-group">
                                    <label for="JAM_AKHIR_SEWA" class="col-form-label">End Time :</label>
                                    <input type="time" class="form-control" id="JAM_AKHIR_SEWA_PAKET" name="JAM_AKHIR_SEWA_PAKET">
                                    </div>
                                <!-- <div class="form-group">
                                <div class="form-group">
                                    <label for="DP_PAKET" class="col-form-label">DP Sewa :</label>
                                    <input type="DP_PAKET" class="form-control" id="DP_PAKET" name="DP_PAKET">
                                    </div>
                                <div class="form-group">
                                    <label for="HARGA_SEWA_PAKET" class="col-form-label">Harga Sewa Paket :</label>
                                    <input type="HARGA_SEWA_PAKET" class="form-control" id="HARGA_SEWA_PAKET" name="HARGA_SEWA_PAKET">
                                    </div>
                                    </div> -->
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="berhasil">Add</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>


                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Id Sewa Paket Wisata</th>
                            <th>Nama User</th>
                            <th>Nama Customer</th>
                            <th>Nama Paket</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>End Date</th>
                            <th>End Time</th>
                            <!-- <th>DP Sewa</th>
                            <th>Harga Sewa</th> -->
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($sewa_paket_wisata as $spw)
                                   
                                    <!-- <tr class="table-light"> -->
                                    <td>{{ $spw -> ID_SEWA_PAKET }}</td>
                                    <td>{{ $spw -> NAMA_PENGGUNA }}</td>
                                    <td>{{ $spw -> NAMA_CUSTOMER }}</td>
                                    <td>{{ $spw -> NAMA_PAKET }}</td>
                                    <td>{{ $spw -> TGL_SEWA_PAKET }}</td>
                                    <td>{{ $spw -> JAM_SEWA_PAKET }}</td>
                                    <td>{{ $spw -> TGL_AKHIR_SEWA_PAKET }}</td>
                                    <td>{{ $spw -> JAM_AKHIR_SEWA_PAKET }}</td>
                                    <!-- <td>{{ $spw -> DP_PAKET }}</td>
                                    <td>{{ $spw -> HARGA_SEWA_PAKET }}</td> -->
                                    <td>
                                    <a href="sewa_paket_detail/{{$spw -> ID_SEWA_PAKET}}">
                                    <button type="button" class="btn btn-outline-success btn-sm btn-floating" title="Edit" data-toggle="modal" data-target="#exampleModal12">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-floating ml-2" title="Delete" data-toggle="modal" data-target="#exampleModal13">
                                        <i class="ti-trash"></i>
                                    </button>
                                    <a href="invoicepaket/{{$spw -> ID_SEWA_PAKET}}">
                                    <button type="button" class="btn btn-outline-warning btn-sm btn-floating ml-2" title="Print Invoice" data-toggle="modal" data-target="#exampleModal14">
                                        <i class="ti-printer"></i>
                                    </button>
                                    </a>
                                        <!-- modal -->
                                            <div class="modal fade" id="exampleModal13" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModal13Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal13Label">Delete Data Sewa Paket Wisata</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i class="ti-close"></i>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            <p>Are you sure to Delete this Data?</p>
                                                        </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="sewa_paketdestroy/{{$spw -> ID_SEWA_PAKET}}">
                                                        <button type="button" class="btn btn-primary" id="delete">Delete</button>
                                                        </a>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                    </tr>
                                    @endforeach
                                    <!-- </tr> -->
                                    </tbody>
                                    <tfoot>
                        <tr>
                            <th>Id Sewa Bus</th>
                            <th>Nama User</th>
                            <th>Nama Customer</th>
                            <th>Nama Paket</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>End Date</th>
                            <th>End Time</th>
                            <!-- <th>DP Sewa</th>
                            <th>Harga Sewa</th> -->
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                    </table>
                </div>
                
        </div>
    </div>

@endif
@endsection

@section('script')
<script>
    $(document).ready(function (){
    $('#myTable').DataTable();
});

    

        console.log('x : ')
            const x = document.getElementsByClassName('post0');
            for(let i=0;i<x.length;i++){
                x[i].addEventListener('click',function(){
                    x[i].submit();
                });
            }

            function modal(id){
                const y=document.getElementById(id);
                $("#tampil").modal();
            }

            function tampil(id){
             const y=document.getElementById(id);
            }

</script>
    <!-- Sweet alert -->
    <script src="{{ url('assets/js/examples/sweet-alert.js') }}"></script>

    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>

     <!-- DataTable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
    <script src="{{ url('assets/js/examples/datatable.js') }}"></script>

    <!-- Javascript -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>

    <script>  
    toastr.options = {
        timeOut: 3000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 200,
        hideDuration: 200
    };

toastr.success('Successfully completed');
    </script>


@endsection