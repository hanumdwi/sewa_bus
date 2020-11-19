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
                    <h6 class="card-title mb-0">Table Customer</h6>
                </div>
                <div class="table-responsive">
                <center>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                Tambah Data Customer
                    </button>
                    </center>
                        <!-- modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal1Label">Tambah Data Customer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="customerstore" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama :</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email :</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                <div class="form-group">
                                    <label for="telephone" class="col-form-label">Telephone :</label>
                                    <input type="telephone" class="form-control" id="telephone" name="telephone">
                                    </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-form-label">Alamat :</label>
                                    <input type="alamat" class="form-control" id="alamat" name="alamat">
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="berhasil">Add Customer</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Id Customer</th>
                            <th>Nama Customer</th>
                            <th>Email Customer</th>
                            <th>Telephone Customer</th>
                            <th>Alamat Customer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($customer as $cus)
                                    <!-- <tr class="table-light"> -->
                                    <td>{{ $cus -> ID_CUSTOMER }}</td>
                                    <td>{{ $cus -> NAMA_CUSTOMER }}</td>
                                    <td>{{ $cus -> EMAIL }}</td>
                                    <td>{{ $cus -> TELEPHONE }}</td>
                                    <td>{{ $cus -> ALAMAT }}</td>
                                    <td>
                                    <a href="customeredit{{$cus -> ID_CUSTOMER}}">
                                    <button type="button" class="btn btn-success btn-square btn-uppercase">
                                        <i class="ti-settings mr-2"></i>Edit
                                    </button>
                                    </a>
                                    <a href="customeredit{{$cus -> ID_CUSTOMER}}">
                                    <button type="button" class="btn btn-danger btn-square btn-uppercase">
                                        <i class="ti-trash mr-2"></i>Delete
                                    </button>
                                    </a>
                                    </td>
                                    </tr>
                                    @endforeach
                                    <!-- </tr> -->
                                    </tbody>
                                    <tfoot>
                        <tr>
                            <th>Id Customer</th>
                            <th>Nama Customer</th>
                            <th>Email Customer</th>
                            <th>Telephone Customer</th>
                            <th>Alamat Customer</th>
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
