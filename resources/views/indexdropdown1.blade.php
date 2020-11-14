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

<div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-0">Table Customers</h6>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                                    <th>Id Customer</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Id Kelurahan</th>
                                    <th>Foto</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($customer as $cus)
                                    <td>{{ $cus -> ID_CUSTOMER }}</td>
                                    <td>{{ $cus -> NAMA }}</td>
                                    <td>{{ $cus -> ALAMAT }}</td>
                                    <td>{{ $cus -> ID_KELURAHAN }}</td>
                                    <td>{{ $cus -> FILE_PATH }}</td>
                                    </td>
                                    </tr>
                                    @endforeach
                                    <!-- </tr> -->
                                    
                                    </tbody>
                                    <tfoot>
                        <tr>
                            <th>Id Barang</th>
                            <th>Nama Barang</th>
                            <th>Stock Barang</th>
                            <th>Deskripsi Barang</th>
                            <th>Cetak Barcode</th>
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
@endsection