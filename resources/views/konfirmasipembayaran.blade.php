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
                    <h6 class="card-title mb-0">Table Category</h6>
                </div>
                <div class="table-responsive">
                
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Id Pembayaran</th>
                            <th>Id Sewa Bus</th>
                            <th>Nama Customer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($pembayaran as $c)
                                    <!-- <tr class="table-light"> -->
                                    <td>KonfPemb00{{ $c -> id }}</td>
                                    <td>{{ $c -> ID_SEWA_BUS }}</td>
                                    <td>{{ $c -> NAMA_CUSTOMER }}</td>
                                    <td>
                                    
                                    <a href="{{ url('detailbayarbus', ['id'=>$c -> id]) }}">
                                    <button type="button" class="btn btn-outline-success">
                                        <i class="ti-money mr-2"></i>Detail
                                    </button>
                                    </a>
                                    
                                    <a href="{{ url('printbayarbus', ['id'=>$c -> id]) }}">
                                    <button type="button" class="btn btn-outline-warning">
                                        <i class="ti-printer mr-2"></i>Print
                                    </button>
                                    </a>

                                    </td>
                                    </tr>
                                    @endforeach
                                    <!-- </tr> -->
                                    </tbody>
                                    <tfoot>
                        <tr>
                            <th>Id Pembayaran</th>
                            <th>Id Sewa Bus</th>
                            <th>Nama Customer</th>
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
