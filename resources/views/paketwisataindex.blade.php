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

    
<div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-0">Table Paket Wisata</h6>
                </div>
                <div class="table-responsive">
                <center>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                Tambah Data Paket Wisata
                    </button>
                    </center>
                        <!-- modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal1Label">Tambah Data Paket Wisata</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="paketwisatastore" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Armada :</label>
                                    <select name="ID_ARMADA" class="form-control" id="ID_ARMADA">
                                        @foreach($armada as $ar)
                                       
                                        <option value="{{$ar->ID_ARMADA}}">{{$ar->NAMA_ARMADA}}</option>
                                       
                                        @endforeach                 
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="namapaket" class="col-form-label">Nama Paket Wisata :</label>
                                    <input type="namapaket" class="form-control" id="namapaket" name="namapaket">
                                    </div>
                                <div class="form-group">
                                    <label for="tipepaket" class="col-form-label">Tipe Paket :</label>
                                    <select name="tipepaket" class="form-control" id="tipepaket">
                                        <option selected="selected">--Pilih Paket--</option>
                                            <option>Normal</option>
                                            <option>Promo</option>
                                    </select>
                                    </div>
                                <div class="form-group">
                                    <label for="hargadasar" class="col-form-label">Harga Dasar :</label>
                                    <input type="hargadasar" class="form-control" id="hargadasar" name="hargadasar">
                                    </div>
                                <div class="form-group">
                                    <label for="hargajual" class="col-form-label">Harga Jual :</label>
                                    <input type="hargajual" class="form-control" id="hargajual" name="hargajual">
                                    </div>
                                <div class="form-group">
                                    <label for="fasilitas" class="col-form-label">Fasilitas :</label>
                                    <input type="fasilitas" class="form-control" id="fasilitas" name="fasilitas">
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="berhasil">Add Paket</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Id Paket</th>
                            <th>Armada</th>
                            <th>Nama Paket Wisata</th>
                            <th>Tipe Paket</th>
                            <th>Harga Dasar</th>
                            <th>Harga Jual</th>
                            <th>Fasilitas</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($paket_wisata as $pw)
                                    <!-- <tr class="table-light"> -->
                                    <td>{{ $pw -> ID_PAKET }}</td>
                                    <td>{{ $pw -> NAMA_ARMADA }}</td>
                                    <td>{{ $pw -> NAMA_PAKET }}</td>
                                    <td>{{ $pw -> TIPE_PAKET }}</td>
                                    <td>{{ $pw -> HARGA_DASAR }}</td>
                                    <td>{{ $pw -> HARGA_JUAL }}</td>
                                    <td>{{ $pw -> FASILITAS }}</td>
                                    <td>
                                    
                                    <button type="button" class="btn btn-success btn-square btn-uppercase" data-toggle="modal" data-target="#exampleModal12{{$pw -> ID_PAKET}}">
                                        <i class="ti-settings mr-2"></i>Edit
                                    </button>
                                    
                                    <!-- modal -->
                                        <div class="modal fade" id="exampleModal12{{$pw -> ID_PAKET}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModal12Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModal12Label">Edit Data Paket</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i class="ti-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                                                <form action="paketwisataupdate" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $pw->ID_PAKET }}"> <br/>
                                                <div class="form-group">
                                                <label for="nama" class="col-form-label">Armada :</label>
                                                <select name="ID_ARMADA" class="form-control" id="ID_ARMADA">
                                                    @foreach($armada as $ar)
                                                
                                                    <option value="{{$ar->ID_ARMADA}}">{{$ar->NAMA_ARMADA}}</option>
                                                
                                                    @endforeach                     
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="namapaket" class="col-form-label">Nama Paket Wisata :</label>
                                                        <input type="namapaket" class="form-control" id="namapaket" name="namapaket" value="{{ $pw->NAMA_PAKET }}">
                                                        </div>
                                                    <div class="form-group">
                                                        <label for="tipepaket" class="col-form-label">Tipe Paket :</label>
                                                        <input type="tipepaket" class="form-control" id="tipepaket" name="tipepaket" value="{{ $pw->TIPE_PAKET }}">
                                                        </div>
                                                    <div class="form-group">
                                                        <label for="hargadasar" class="col-form-label">Harga Dasar :</label>
                                                        <input type="hargadasar" class="form-control" id="hargadasar" name="hargadasar" value="{{ $pw->HARGA_DASAR }}">
                                                        </div>
                                                    <div class="form-group">
                                                        <label for="hargajual" class="col-form-label">Harga Jual :</label>
                                                        <input type="hargajual" class="form-control" id="hargajual" name="hargajual" value="{{ $pw->HARGA_JUAL }}">
                                                        </div>
                                                    <div class="form-group">
                                                        <label for="fasilitas" class="col-form-label">Fasilitas :</label>
                                                        <input type="fasilitas" class="form-control" id="fasilitas" name="fasilitas" value="{{ $pw->FASILITAS }}">
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
                                    
                                    <button type="button" class="btn btn-danger btn-square btn-uppercase" data-toggle="modal" data-target="#exampleModal13{{$pw -> ID_PAKET}}">
                                        <i class="ti-trash mr-2"></i>Delete
                                    </button>
                                    
                                        <!-- modal -->
                                            <div class="modal fade" id="exampleModal13{{$pw -> ID_PAKET}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModal13Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal13Label">Delete Data Paket</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i class="ti-close"></i>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            <p>Are you sure to Delete this Data?</p>
                                                        </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="paketwisatadestroy/{{$pw -> ID_PAKET}}">
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
                            <th>Id Paket</th>
                            <th>Armada</th>
                            <th>Nama Paket Wisata</th>
                            <th>Tipe Paket</th>
                            <th>Harga Dasar</th>
                            <th>Harga Jual</th>
                            <th>Fasilitas</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                    </table>
                </div>
                
        </div>
    </div>


@endsection

@section('script')
<script>
    $(document).ready(function (){
    $('#myTable').DataTable();
});

    function modal(id){
        const y=document.getElementById(id);
            $("#exampleModal12").modal();
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

<script> 
swal(berhasil,"Good job!", "You clicked the button!", "success");
</script>

@endsection
