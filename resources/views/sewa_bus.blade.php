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
                    <h6 class="card-title mb-0">Table Sewa</h6>
                </div>
                <div class="table-responsive">
                <center>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                Tambah Data Sewa
                    </button>
                    </center>
                        <!-- modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal1Label">Tambah Data Sewa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="sewa_busstore" method="post">
                                @csrf
                               
                                <!-- <input type="hidden" name="TGL" id="TGL1" value=""> -->
                                <!-- <div class="form-group"> -->
                                    <!-- <label for="nama" class="col-form-label">Nama User :</label> -->
                                    @php $nama_pengg=Session::get('coba'); @endphp
                                    <!-- <select name="ID_PENGGUNA" class="form-control" id="ID_PENGGUNA"> -->
                                        @foreach($pengguna as $png)
                                       @if($png->NAMA_PENGGUNA==$nama_pengg)
                                       <input type="hidden" value="{{$png->ID_PENGGUNA}}" name="ID_PENGGUNA">
                                       @endif
                                      
                                       
                                        @endforeach                 
                                <!-- </select> -->
                                <!-- </div> -->
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama Customer :</label>
                                    <select name="ID_CUSTOMER" class="form-control" id="ID_CUSTOMER">
                                        @foreach($customer as $cus)
                                       
                                        <option value="{{$cus->ID_CUSTOMER}}">{{$cus->NAMA_CUSTOMER}}</option>
                                       
                                        @endforeach                 
                                </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="TGL_SEWA" class="col-form-label">Start Date :</label>
                                        </div>
                                        <div class="col-lg-6">
                                        <label for="JAM_SEWA" class="col-form-label">Start Time :</label>
                                        
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6"><input type="date" class="form-control" id="TGL_SEWA" name="TGL_SEWA"></div>
                                        <div class="col-lg-6"><input type="time" class="form-control" id="JAM_SEWA" name="JAM_SEWA"></div>
                                    
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <label for="TGL_AKHIR_SEWA">End Date :</label>
                                        </div>
                                        <div class="col-lg-6">
                                        <label for="JAM_AKHIR_SEWA" class="col-form-label">End Time :</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6"><input type="date" class="form-control create-event-datepicker" id="TGL_AKHIR_SEWA" name="TGL_AKHIR_SEWA"></div>
                                        <div class="col-lg-6"><input type="time" class="form-control" id="JAM_AKHIR_SEWA" name="JAM_AKHIR_SEWA"></div>
                                    
                                    </div>
                                    </div>
                                
                                <div class="form-group">
                                <div class="form-group">
                                    <label for="statussewa" class="col-form-label">Status Sewa :</label>
                                    <select name="statussewa" class="form-control" id="statussewa">
                                        <option selected="selected">-- Status --</option>
                                            <option>Booking</option>
                                            <option>On Schedule</option>
                                            <option>Lunas</option>
                                    </select>
                                    </div>
                                    </div>
                                
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
                            <th>Status Sewa</th>
                            <th>Id Sewa Bus</th>
                            <th>Nama User</th>
                            <th>Nama Customer</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>End Date</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($sewa_bus as $sb)
                                    @if($sb -> STATUS_SEWA == 'Booking')
                                    <td><span class="badge bg-success-bright text-secondary">{{ $sb -> STATUS_SEWA}}</span></td>
                                    @endif
                                    @if($sb -> STATUS_SEWA == 'Lunas')
                                    <td><span class="badge bg-success-bright text-success">{{ $sb -> STATUS_SEWA}}</span></td>
                                    @endif
                                    @if($sb -> STATUS_SEWA == 'On Schedule')
                                    <td><span class="badge bg-success-bright text-danger">{{ $sb -> STATUS_SEWA}}</span></td>
                                    @endif
                                    <td>{{ $sb -> ID_SEWA_BUS }}</td>
                                    <td>{{ $sb -> NAMA_PENGGUNA }}</td>
                                    <td>{{ $sb -> NAMA_CUSTOMER }}</td>
                                    <td>{{ $sb -> TGL_SEWA_BUS }}</td>
                                    <td>{{ $sb -> JAM_SEWA }}</td>
                                    <td>{{ $sb -> TGL_AKHIR_SEWA }}</td>
                                    <td>{{ $sb -> JAM_AKHIR_SEWA }}</td>
                                    <td>
                                    <a href="{{ url('datatable', ['id'=>$sb -> ID_SEWA_BUS]) }}">
                                    <button type="button" class="btn btn-outline-success btn-sm btn-floating" title="Edit" data-toggle="modal" data-target="#exampleModal12">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-floating ml-2" title="Delete" data-toggle="modal" data-target="#exampleModal13">
                                        <i class="ti-trash"></i>
                                    </button>
                                    <a href="invoice/{{$sb -> ID_SEWA_BUS}}">
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
                                                            <h5 class="modal-title" id="exampleModal13Label">Delete Data Sewa Bus</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i class="ti-close"></i>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            <p>Are you sure to Delete this Data?</p>
                                                        </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="sewa_busdestroy/{{$sb -> ID_SEWA_BUS}}">
                                                        <button type="button" class="btn btn-primary" id="delete">Delete</button>
                                                        </a>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                        <tr>
                            <th>Status Sewa</th>
                            <th>Id Sewa Bus</th>
                            <th>Nama User</th>
                            <th>Nama Customer</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>End Date</th>
                            <th>End Time</th>
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
