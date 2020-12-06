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
                    <h6 class="card-title mb-0">Table Armada</h6>
                </div>
                <div class="table-responsive">
                <center>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                Tambah Data Armada
                    </button>
                    </center>
                        <!-- modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal1Label">Tambah Data Armada</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="armadastore" method="post">
                                @csrf
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
                                    <label for="harga" class="col-form-label">Harga :</label>
                                    <input type="harga" class="form-control" id="harga" name="harga">
                                <!-- <div class="form-group">
                                    <label for="foto" class="col-form-label">Foto Armada :</label>
                                        <input type="foto" class="form-control" id="foto" name="foto">
                                    </div> -->
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="berhasil">Add Armada</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Id Armada</th>
                            <th>Category Armada</th>
                            <th>Plat Nomor</th>
                            <th>Kapasitas</th>
                            <th>Fasilitas Armada</th>
                            <th>Harga</th>
                            <th>Action</th>
                            <th>Foto Armada</th>
                            <th>Edit Foto</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($armada as $ar)
                                    <td>
                                        @php $x=0; @endphp
                                            @foreach($schedule_armada as $scd)
                                                @if($ar->ID_ARMADA == $scd->ID_ARMADA)
                                        @php $x=1; @endphp
                                                @endif
                                            @endforeach
                                    @if($x==0)
                                        <form class="post0" method="post" action="armadaupdateswitch">
                                        @csrf
                                            <input type="hidden" name="id" value="{{$ar->ID_ARMADA}}">
                                            @if($ar -> STATUS_ARMADA == 1)
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="switch{{$ar->ID_ARMADA}}">
                                                <label class="custom-control-label" for="switch{{$ar->ID_ARMADA}}">Active</label>
                                            </div>
                                            @else 
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch{{$ar->ID_ARMADA}}">
                                                <label class="custom-control-label" for="switch{{$ar->ID_ARMADA}}">Non-Active</label>
                                            </div>
                                            @endif
                                        </form>
                                    @else
                                        <form id="modal{{$ar->ID_ARMADA}}" onclick="modal(id)" method="post" action="#">
                                            @csrf
                                                <input type="hidden" name="id" value="{{$ar->ID_ARMADA}}">
                                                @if($ar -> STATUS_ARMADA == 1)
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="switch{{$ar->ID_ARMADA}}">
                                                    <label class="custom-control-label" for="switch{{$ar->ID_ARMADA}}">Active</label>
                                                </div>
                                                @else 
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="switch{{$ar->ID_ARMADA}}">
                                                    <label class="custom-control-label" for="switch{{$ar->ID_ARMADA}}">Non-Active</label>
                                                </div>
                                                @endif
                                            </form>
                                    @endif
                                    </td>
                                    <!-- <tr class="table-light"> -->
                                    <td>{{ $ar -> ID_ARMADA }}</td>
                                    <td>{{ $ar -> NAMA_CATEGORY }}</td>
                                    <td>{{ $ar -> PLAT_NOMOR }}</td>
                                    <td>{{ $ar -> KAPASITAS }}</td>
                                    <td>{{ $ar -> FASILITAS_ARMADA }}</td>
                                    <td>{{ $ar -> HARGA }}</td>
                                   
                                    <td>
                                    @if($ar -> STATUS_ARMADA == 1)
                                    <button type="button" class="btn btn-outline-success btn-sm btn-floating" title="Edit" data-toggle="modal" data-target="#exampleModal12{{$ar -> ID_ARMADA}}">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-outline-success btn-sm btn-floating" title="Edit" data-toggle="modal" data-target="#tampil">
                                        <i class="ti-pencil"></i>
                                    </button>

                                        <div class="modal" id="tampil" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content border">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i class="ti-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Sorry, Data Non-Active</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- modal -->
                                        <div class="modal fade" id="exampleModal12{{$ar -> ID_ARMADA}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModal12Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModal12Label">Edit Data Armada</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i class="ti-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                                                <form action="armadaupdate" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $ar->ID_ARMADA }}"> <br/>
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
                                                    <input type="platnomor" class="form-control" id="platnomor" name="platnomor" value="{{ $ar->PLAT_NOMOR }}">
                                                    </div>
                                                <div class="form-group">
                                                    <label for="kapasitas" class="col-form-label">Kapasitas :</label>
                                                    <input type="kapasitas" class="form-control" id="kapasitas" name="kapasitas" value="{{ $ar->KAPASITAS }}">
                                                    </div>
                                                <div class="form-group">
                                                    <label for="fasilitas" class="col-form-label">Fasilitas :</label>
                                                    <input type="fasilitas" class="form-control" id="fasilitas" name="fasilitas" value="{{ $ar->FASILITAS_ARMADA }}">
                                                    </div>
                                                <div class="form-group">
                                                    <label for="harga" class="col-form-label">Harga :</label>
                                                    <input type="harga" class="form-control" id="harga" name="harga" value="{{ $ar->HARGA }}">
                                                <!-- <div class="form-group">
                                                    <label for="foto" class="col-form-label">Foto Armada :</label>
                                                    <input type="foto" class="form-control" id="foto" name="foto" value="{{ $ar->FOTO }}">
                                                    </div> -->
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="edit">Save Changes</button>
                                            </div>
                                            </form>
                                            
                                            </div>
                                        </div>
                                        </div>
                                    
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-floating ml-2" title="Delete" data-toggle="modal" data-target="#exampleModal13{{$ar -> ID_ARMADA}}">
                                        <i class="ti-trash"></i>
                                    </button>
                                    
                                        <!-- modal -->
                                            <div class="modal fade" id="exampleModal13{{$ar -> ID_ARMADA}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModal13Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal13Label">Delete Data Armada</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i class="ti-close"></i>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            <p>Are you sure to Delete this Data?</p>
                                                        </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="armadadestroy/{{$ar -> ID_ARMADA}}">
                                                        <button type="button" class="btn btn-primary" id="delete">Delete</button>
                                                        </a>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                    <td>{{ $ar -> FOTO }}</td>
                                    <td>
                                    @if($ar -> STATUS_ARMADA == 1)
                                    <a href="{{ url('fotoarmada', ['id'=>$ar -> ID_ARMADA]) }}">
                                    <button type="button" class="btn btn-outline-success btn-sm btn-floating" title="Edit Foto">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    </a>
                                    @else
                                    <button type="button" class="btn btn-outline-success btn-sm btn-floating" title="Edit Foto" data-toggle="modal" data-target="#tampil">
                                        <i class="ti-pencil"></i>
                                    </button>

                                        <div class="modal" id="tampil" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content border">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i class="ti-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Sorry, Data Non-Active</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                    <!-- </tr> -->
                                    </tbody>
                                    <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>Id Armada</th>
                            <th>Category Armada</th>
                            <th>Plat Nomor</th>
                            <th>Kapasitas</th>
                            <th>Fasilitas Armada</th>
                            <th>Harga</th>
                            <th>Action</th>
                            <th>Foto Armada</th>
                            <th>Edit Foto</th>
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
