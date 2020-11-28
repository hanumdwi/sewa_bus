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
                    <h6 class="card-title mb-0">Table Galeri Armada</h6>
                </div>
                <div class="table-responsive">
                <center>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                Tambah Data Galeri Armada
                    </button>
                    </center>
                        <!-- modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal1Label">Tambah Data Galeri Armada</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="galeristore" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="ID_ARMADA" class="col-form-label">Id Armada :</label>
                                        <select name="ID_ARMADA" class="form-control" id="ID_ARMADA">
                                            @foreach($armada as $ar)
                                                       
                                                <option value="{{$ar->ID_ARMADA}}">{{$ar->NAMA_ARMADA}}</option>
                                                       
                                            @endforeach                 
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="fotoarmada" class="col-form-label">Foto Armada :</label>
                                    <input type="text" class="form-control" id="fotoarmada" name="fotoarmada">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsifoto" class="col-form-label">Deskripsi Foto :</label>
                                    <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto">
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="berhasil">Add Category</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Status Foto</th>
                            <th>Id Galeri</th>
                            <th>Nama Armada</th>
                            <th>Foto Armada</th>
                            <th>Deskripsi Foto</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($galeri as $g)
                                    <!-- <tr class="table-light"> -->
                                    <td>
                                    @php $x=0; @endphp
                                            @foreach($armada as $ar)
                                                @if($g -> ID_GALERI == $ar->ID_GALERI)
                                        @php $x=1; @endphp
                                                @endif
                                            @endforeach
                                    @if($x==0)
                                        <form class="post0" method="post" action="galeriupdateswitch">
                                        @csrf
                                            <input type="hidden" name="id" value="{{$g -> ID_GALERI}}">
                                            @if($g -> STATUS_FOTO == 1)
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="switch{{$g -> ID_GALERI}}">
                                                <label class="custom-control-label" for="switch{{$g -> ID_GALERI}}">Active</label>
                                            </div>
                                            @else 
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch{{$g -> ID_GALERI}}">
                                                <label class="custom-control-label" for="switch{{$g -> ID_GALERI}}">Non-Active</label>
                                            </div>
                                            @endif
                                        </form>
                                    @else
                                        <form id="modal{{$g -> ID_GALERI}}" onclick="modal(id)" method="post" action="#">
                                            @csrf
                                                <input type="hidden" name="id" value="{{$g -> ID_GALERI}}">
                                                @if($g -> STATUS_FOTO == 1)
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="switch{{$g -> ID_GALERI}}">
                                                    <label class="custom-control-label" for="switch{{$g -> ID_GALERI}}">Active</label>
                                                </div>
                                                @else 
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="switch{{$g -> ID_GALERI}}">
                                                    <label class="custom-control-label" for="switch{{$g -> ID_GALERI}}">Non-Active</label>
                                                </div>
                                                @endif
                                            </form>
                                    @endif
                                    <td>{{ $g -> ID_GALERI }}</td>
                                    <td>{{ $g -> NAMA_ARMADA }}</td>
                                    <td>{{ $g -> FOTO_ARMADA }}</td>
                                    <td>{{ $g -> DESKRIPSI_FOTO }}</td>
                                    <td>
                                    
                                    <button type="button" class="btn btn-outline-success btn-sm btn-floating" title="Edit" data-toggle="modal" data-target="#exampleModal12{{$g -> ID_GALERI}}">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    
                                    <!-- modal -->
                                        <div class="modal fade" id="exampleModal12{{$g -> ID_GALERI}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModal12Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModal12Label">Edit Data Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i class="ti-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                                                <form action="galeriupdate" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $g -> ID_GALERI }}"> <br/>
                                                <div class="form-group">
                                                    <label for="ID_ARMADA" class="col-form-label">Id Armada :</label>
                                                    <select name="ID_ARMADA" class="form-control" id="ID_ARMADA">
                                                        @foreach($armada as $ar)
                                                       
                                                        <option value="{{$ar->ID_ARMADA}}">{{$ar->NAMA_ARMADA}}</option>
                                                       
                                                        @endforeach                 
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsifoto" class="col-form-label">Deskripsi Foto :</label>
                                                    <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto" value="{{ $g->FOTO_ARMADA }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fotoarmada" class="col-form-label">Foto Armada :</label>
                                                    <input type="text" class="form-control" id="fotoarmada" name="fotoarmada" value="{{ $g->FOTO_ARMADA }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsifoto" class="col-form-label">Deskripsi Foto :</label>
                                                    <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto" value="{{ $g->FOTO_ARMADA }}">
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
                                    
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-floating ml-2" title="Delete" data-toggle="modal" data-target="#exampleModal13{{$g -> ID_GALERI}}">
                                        <i class="ti-trash"></i>
                                    </button>
                                    
                                        <!-- modal -->
                                            <div class="modal fade" id="exampleModal13{{$g -> ID_GALERI}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModal13Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal13Label">Delete Foto Armada</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i class="ti-close"></i>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            <p>Are you sure to Delete this Photo?</p>
                                                        </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="galeridestroy/{{$g -> ID_GALERI}}">
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
                            <th>Status Foto</th>
                            <th>Id Galeri</th>
                            <th>Nama Armada</th>
                            <th>Foto Armada</th>
                            <th>Deskripsi Foto</th>
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

        console.log('x : ')
            const x = document.getElementsByClassName('post0');
            for(let i=0;i<x.length;i++){
                x[i].addEventListener('click',function(){
                    x[i].submit();
                });
            }

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
