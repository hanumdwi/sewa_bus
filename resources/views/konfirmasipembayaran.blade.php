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
                    <h6 class="card-title mb-0">Table Pembayaran</h6>
                </div>
                <div class="table-responsive">
                
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Status Pengechekan</th>
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
                                    <td>
                                        <form class="post0" method="post" action="pembayaranupdateswitch">
                                        @csrf
                                            <input type="hidden" name="update1" value="{{$c->id}}">
                                            @if($c -> STATUS_BAYAR == 1)
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="switch{{$c->id}}">
                                                <label class="custom-control-label" for="switch{{$c->id}}">New</label>
                                            </div>
                                            @else 
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch{{$c->id}}">
                                                <label class="custom-control-label" for="switch{{$c->id}}">Done</label>
                                            </div>
                                            @endif
                                        </form>
                                    </td>
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
                            <th>Status Pengechekan</th>
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
const x = document.getElementsByClassName('post0');
            for(let i=0;i<x.length;i++){
                x[i].addEventListener('click',function(){
                    x[i].submit();
                });
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
