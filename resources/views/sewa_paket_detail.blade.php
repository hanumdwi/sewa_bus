@extends('layouts.app')

@section('head')
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="{{ url('vendors/fullcalendar/fullcalendar.min.css') }}" type="text/css">

    <!-- Clockpicker -->
    <link rel="stylesheet" href="{{ url('vendors/clockpicker/bootstrap-clockpicker.min.css') }}" type="text/css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ url('vendors/form-wizard/jquery.steps.css') }}" type="text/css">

    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
    

@endsection

@section('content')
@if(\Session::has('kasir') || \Session::has('admin'))
<div class="page-header">
        <div class="page-title">
            <h3>Form Validation</h3>
        </div>
</div>

    <div class="row">
        <div class="col-md-12">
        
        <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Sewa Paket Wisata</h6>
                    <p class="text-muted"></p>
                    <div id="wizard1">
                        <h3>Personal Information</h3>
                        <section class="card card-body border mb-0">
                            
                        <form action="sewa_paketupdate" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="nama" class="col-form-label">Nama User :</label>
                                    
                                        <label>{{$pengguna->NAMA_PENGGUNA}}</label>
                                       
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="nama" class="col-form-label">Nama Customer :</label>
                                    
                                        <label>{{$customer->NAMA_CUSTOMER}}</label>
                                        
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="nama" class="col-form-label">Nama Paket :</label>
                                    
                                        <label>{{$paket_wisata->NAMA_PAKET}}</label>
                                        
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="TGL_SEWA" class="col-form-label">Start Date :</label>
                                    <input type="date" class="form-control" id="TGL_SEWA_PAKET" name="TGL_SEWA_PAKET" value="{{$sewa_paket_wisata->TGL_SEWA_PAKET}}">
                                </div>
                                    
                                <div class="col-md-4 mb-3">
                                    <label for="TGL_AKHIR_SEWA">End Date :</label>
                                    <input type="date" class="form-control create-event-datepicker" id="TGL_AKHIR_SEWA_PAKET" name="TGL_AKHIR_SEWA_PAKET" value="{{$sewa_paket_wisata->TGL_AKHIR_SEWA_PAKET}}">
                                </div>
                            </div>
                                

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="JAM_SEWA" class="col-form-label">Start Time :</label>
                                    <input type="time" class="form-control" id="JAM_SEWA_PAKET" name="JAM_SEWA_PAKET" value="{{$sewa_paket_wisata->JAM_SEWA_PAKET}}">
                                </div>
                                    
                               
                                <div class="col-md-4 mb-3">
                                    <label for="JAM_AKHIR_SEWA" class="col-form-label">End Time :</label>
                                    <input type="time" class="form-control" id="JAM_AKHIR_SEWA_PAKET" name="JAM_AKHIR_SEWA_PAKET" value="{{$sewa_paket_wisata->JAM_AKHIR_SEWA_PAKET}}">
                                </div>
                            </div>

                                <div><label>&nbsp;</label></div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="harga" class="form-control" name="harga" id="harga">
                                </div>
                            </div>
                                
                                <div><label>&nbsp;</label></div>
                                <div><label>&nbsp;</label></div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="gender">Total Payment</label>
                                    <input type="text" class="form-control" name="totalpayment" id="totalpayment">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="profession">DP (25%)</label>
                                    <input type="text" class="form-control" name="dp" id="dp">
                                </div>
                                <!-- <div class="col-md-4 mb-3">
                                    <label for="profession">Harus Bayar</label>
                                    <input type="text" class="form-control" name="harusbayar" id="harusbayar">
                                </div> -->
                                <div class="col-md-4 mb-3">
                                    <label for="profession">Sisa Bayar</label>
                                    <input type="sisabayar" class="form-control" name="sisabayar" id="sisabayar">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" id="berhasil">Update Sewa</button>
                        </form>
              
                        </section>

                        

                        <h3>Payment Details</h3>
                        <section class="card card-body border mb-0">
                            <h5>Invoice</h5>
                            
                            
                            <div class="invoice">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <img src="{{ url('assets/media/image/logo/mdc.png') }}" alt="logo">
                            <h3 class="text-xs-left m-b-0">#INV-{{$sewa_paket_wisata->ID_SEWA_PAKET}}</h3>
                        </div>
                        <hr class="m-t-b-50">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <b>PT. Medina Dzikra Cemerlang Trans</b><br>
                                    JL. Suwoko No. 43 A Lamongan - Jawa Timur<br>
                                    Telp : (0322) 3101285
                                </p>
                                <p>
                                <b>{{$pengguna->NAMA_PENGGUNA}},</b><br>{{$sewa_paket_wisata->TGL_SEWA_PAKET}}   -   {{$sewa_paket_wisata->TGL_AKHIR_SEWA_PAKET}}
                                <br>{{$sewa_paket_wisata->JAM_SEWA_PAKET}}       -      {{$sewa_paket_wisata->JAM_AKHIR_SEWA_PAKET}}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right">
                                    <b>Invoice to</b>
                                </p>
                                <p class="text-right"> {{$customer->NAMA_CUSTOMER}},<br> {{$customer->TELEPHONE}},<br> {{$customer->ALAMAT}}.
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table my-4">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Unit Cost</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-right">
                                    <td class="text-left">1</td>
                                    <td class="text-left">Brochure Design</td>
                                    <td>2</td>
                                    <td>$20</td>
                                    <td>$40</td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <p>Sub - Total amount: $12,348</p>
                            <p>vat (10%) : $138</p>
                            <h4 class="font-weight-800">Total : $13,986</h4>
                        </div>
                        <p class="text-center small text-muted  m-t-50">
                            <span class="row">
                                <span class="col-md-6 offset-3">
                                    Invoice of PT. MDC Trans
                                </span>
                            </span>
                        </p>
                    </div>
                    <div class="text-right d-print-none">
                        <hr class="my-5">
                        <a href="#" class="btn btn-primary">Send Invoice</a>
                        <a href="javascript:window.print()" class="btn btn-success m-l-5">
                            <i class="ti-printer mr-2"></i> Print
                        </a>
                    </div>
            </section>

                        <h3>Schedule Armada</h3>
                        <section class="card card-body border mb-0">
                            <h5>Schedule Sewa Armada</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice">
                                        <div class="d-md-flex justify-content-between align-items-center">
                                            <img src="{{ url('assets/media/image/logo/mdc.png') }}" alt="logo">
                                            <h3 class="text-xs-left m-b-0">Invoice #INV-16</h3>
                                        </div>
                                        <hr class="m-t-b-50">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>
                                                    <b>PT. Medina Dzikra Cemerlang Trans</b>
                                                </p>
                                                <p>104,<br>Minare SK,<br>Canada, K1A 0G9.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-right">
                                                    <b>Invoice to</b>
                                                </p>
                                                <p class="text-right">Gaala &amp; Sons,<br> C-201, Beykoz-34800,<br> Canada, K1A 0G9.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table my-4">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Description</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Cost</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="text-right">
                                                    <td class="text-left">1</td>
                                                    <td class="text-left">Brochure Design</td>
                                                    <td>2</td>
                                                    <td>$20</td>
                                                    <td>$40</td>
                                                </tr>
                                                <tr class="text-right">
                                                    <td class="text-left">2</td>
                                                    <td class="text-left">Web Design Packages(Template) - Basic</td>
                                                    <td>05</td>
                                                    <td>$25</td>
                                                    <td>$125</td>
                                                </tr>
                                                <tr class="text-right">
                                                    <td class="text-left">3</td>
                                                    <td class="text-left">Print Ad - Basic - Color</td>
                                                    <td>08</td>
                                                    <td>$500</td>
                                                    <td>$4000</td>
                                                </tr>
                                                <tr class="text-right">
                                                    <td class="text-left">4</td>
                                                    <td class="text-left">Down Coat</td>
                                                    <td>1</td>
                                                    <td>$5</td>
                                                    <td>$5</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-right">
                                            <p>Sub - Total amount: $12,348</p>
                                            <p>vat (10%) : $138</p>
                                            <h4 class="font-weight-800">Total : $13,986</h4>
                                        </div>
                                        <p class="text-center small text-muted  m-t-50">
                                            <span class="row">
                                                <span class="col-md-6 offset-3">
                                                    Invoice of PT. MDC Trans
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="text-right d-print-none">
                                        <hr class="my-5">
                                        <a href="#" class="btn btn-primary">Send Invoice</a>
                                        <a href="javascript:window.print()" class="btn btn-success m-l-5">
                                            <i class="ti-printer mr-2"></i> Print
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>

                    
            
@endif
@endsection

@section('script')

<script>
   $(document).ready(function () {
      $('.repeater').repeater();
   });
</script>

<script>

$('#save').hide();
$('#add').click(function(){
    $('#save').show();
});



</script>
<!-- Form wizard -->
<script src="{{ url('vendors/form-wizard/jquery.steps.min.js') }}"></script>
<script src="{{ url('assets/js/examples/form-wizard.js') }}"></script>

<!-- Fullcalendar -->
<script src="{{ url('vendors/fullcalendar/moment.min.js') }}"></script>
<script src="{{ url('vendors/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ url('assets/js/examples/fullcalendar.js') }}"></script>

<!-- Clockpicker -->
<script src="{{ url('vendors/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ url('assets/js/examples/clockpicker.js') }}"></script>

<!-- Datepicker -->
<script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>
<script src="{{ url('assets/js/examples/datepicker.js') }}"></script>

<script src="{{ url('assets/js/examples/pages/calendar.js') }}"></script>

<!-- Form repeater -->
<script src="{{ url('vendors/jquery.repeater.min.js') }}"></script>

<!-- Form repeater examples -->
<script src="{{ url('assets/js/examples/pages/form-repeater.js') }}"></script>


<!-- Prism -->
<script src="{{ url('vendors/prism/prism.js') }}"></script>

@endsection