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

<div class="page-header">
        <div class="page-title">
            <h3>Form Validation</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        
        <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Basic Content Wizard</h6>
                    <p class="text-muted">Below is an example of a basic horizontal form wizard.</p>
                    <div id="wizard1">
                        <h3>Personal Information</h3>
                        <section class="card card-body border mb-0">
                            
                            <form action="sewa_busstore" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                    <label for="nama" class="col-form-label">Nama User :</label>
                                    
                                        <label>{{$pengguna->NAMA_PENGGUNA}}</label>
                                       
                                </div>
                                
                                    <div class="col-md-4 mb-3">
                                    <label for="nama" class="col-form-label">Nama Customer :</label>
                                    
                                        <label>{{$customer->NAMA_CUSTOMER}}</label>
                                        </div>
                                
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                    <label for="TGL_SEWA" class="col-form-label">Start Date :</label>
                                    <input type="date" class="form-control" id="TGL_SEWA" name="TGL_SEWA" value="{{$sewa_bus->TGL_SEWA_BUS}}">
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                    <label for="TGL_AKHIR_SEWA">End Date :</label>
                                    <input type="date" class="form-control create-event-datepicker" id="TGL_AKHIR_SEWA" name="TGL_AKHIR_SEWA" value="{{$sewa_bus->TGL_AKHIR_SEWA}}">
                                    </div>
                                   </div>
                                

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                    <label for="JAM_SEWA" class="col-form-label">Start Time :</label>
                                    <input type="time" class="form-control" id="JAM_SEWA" name="JAM_SEWA" value="{{$sewa_bus->JAM_SEWA}}">
                                    </div>
                                    
                               
                                    <div class="col-md-4 mb-3">
                                    <label for="JAM_AKHIR_SEWA" class="col-form-label">End Time :</label>
                                    <input type="time" class="form-control" id="JAM_AKHIR_SEWA" name="JAM_AKHIR_SEWA" value="{{$sewa_bus->JAM_AKHIR_SEWA}}">
                                    </div>
                                   
                                  
                               
                                    <div class="col-md-4 mb-3">
                                    <label for="LAMA_SEWA" class="col-form-label">Lama sewa :</label>
                                    <input type="LAMA_SEWA" class="form-control" id="LAMA_SEWA" name="LAMA_SEWA" value="{{$sewa_bus->LAMA_SEWA}}">
                                    </div>
                                    </div>
                                    

                                
                                    
                                    
                                
                           
                                <button type="submit" class="btn btn-primary" id="berhasil">Update Sewa</button>
                                </form>
              

                        </section>
                        <h3>Billing Information</h3>
                        <section class="card card-body border mb-0">
                        <div class="row">
                         <form class="basic-repeater">
                            <div data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="row">
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <label for="name">Category Armada</label>
                                        <select name="ID_CATEGORY" class="form-control" id="ID_CATEGORY">
                                        @foreach($category_armada as $c)
                                       
                                        <option value="{{$c->ID_CATEGORY}}">{{$c->NAMA_CATEGORY}}</option>
                                       
                                        @endforeach                 
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <label for="harga">Harga</label>
                                        <input type="harga" class="form-control" name="harga" id="harga">
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <label for="gender">Quantity</label>
                                        <div>
                                            <input type="number" class="form-control" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <label for="profession">Tanggal Sewa</label>
                                        <input type="date" class="form-control" name="tglsewa" id="tglsewa">
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <label for="profession">Sub Total</label>
                                        <input type="subtotal" class="form-control" name="subtotal" id="subtotal">
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <div><label>&nbsp;</label></div>
                                        <button type="button" class="btn btn-danger" data-repeater-delete>
                                            <i class="ti-close font-size-10 mr-2"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <button type="button" class="btn btn-primary" id="add" data-repeater-create>
                            <i class="ti-plus font-size-10 mr-2"></i> Add
                        </button>
                        <button type="submit" class="btn btn-success" id="save">
                            <i class="ti-plus font-size-10 mr-2"></i> Submit
                        </button>
                    </form>
                    </div>
                    
                        <div class="col-md-2 col-sm-12 form-group">
                                        <label for="gender">Total Payment</label>
                                        <div>
                                            <input type="number" class="form-control" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <label for="profession">DP</label>
                                        <input type="text" class="form-control" name="dp" id="dp">
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group">
                                        <label for="profession">Sisa Bayar</label>
                                        <input type="sisabayar" class="form-control" name="sisabayar" id="sisabayar">
                                    </div>
 
                    

                        </section>
                        <h3>Payment Details</h3>
                        <section class="card card-body border mb-0">
                            <h5>Payment Details</h5>
                            <p>The next and previous buttons help you to navigate through your content.</p>
                        </section>
                    </div>
                    </div>
                    </div>
                    </div>

                    
            

@endsection

@section('script')
<script>

$('#save').hide();
$('#add').click(function(){
    $('#save').show();
});

$('#wizard-example').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    autoFocus: true,
    titleTemplate: '&lt;span class="wizard-index"&gt;#index#&lt;/span&gt; #title#',
    onStepChanging: function (event, currentIndex, newIndex) {
        if (currentIndex &lt; newIndex) {
            var form = document.getElementById('form1'),
                form2 = document.getElementById('form2');

            if (currentIndex === 0) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                } else {
                    return true;
                }
            } else if (currentIndex === 1) {
                if (form2.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    form2.classList.add('was-validated');
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
});

</script>
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

<!-- Form wizard -->
<script src="{{ url('vendors/form-wizard/jquery.steps.min.js') }}"></script>
<script src="{{ url('assets/js/examples/form-wizard.js') }}"></script>

<!-- Prism -->
<script src="{{ url('vendors/prism/prism.js') }}"></script>

@endsection