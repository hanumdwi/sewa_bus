@extends('layouts.app')

@section('head')
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="{{ url('vendors/fullcalendar/fullcalendar.min.css') }}" type="text/css">
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
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
            <h3>Form Sewa Armada</h3>
        </div>
</div>

    <div class="row">
        <div class="col-md-12">
        
        <div class="card">
                <div class="card-body">
                    <p class="text-muted"></p>
                    <div id="wizard1">
                        <h3>Personal Information</h3>
                        <section class="card card-body border mb-0">
                            
                        <form action="{{ $sewa_bus->ID_SEWA_BUS }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="ID_SEWA_BUS" value="{{ $sewa_bus->ID_SEWA_BUS }}"> <br/>
                            <div class="form-row">
                            <input type="hidden" name="ID_PENGGUNA" value="{{ $sewa_bus->ID_PENGGUNA }}"> <br/>
                                <div class="col-md-4 mb-3">
                                    <label for="nama" class="col-form-label">Nama User :</label>
                                    
                                        <label>{{$pengguna->NAMA_PENGGUNA}}</label>
                                       
                                </div>
                                <input type="hidden" name="ID_CUSTOMER" value="{{ $sewa_bus->ID_CUSTOMER }}"> <br/>
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

                                <div class="col-md-4 mb-3">
                                    <label for="statussewa" class="col-form-label">Status Sewa :</label>
                                    <select name="statussewa" class="form-control" id="statussewa" value="{{$sewa_bus->STATUS_SEWA}}">
                                        <option selected="selected">-- Status --</option>
                                            <option>Booking</option>
                                            <option>Belum Bayar</option>
                                            <option>Lunas</option>
                                    </select>
                                    </div>
                            </div>
                                    
                           
                            <button type="submit" class="btn btn-primary" id="berhasil">Update Sewa</button>
                        </form>
              
                        </section>

                        <h3>Billing Information</h3>
                        <section class="card card-body border mb-0">
                        
                         <form class="basic-repeater" action="" method="POST" enctype="multipart/form-data">
                         {{ csrf_field() }}
                         <!-- <center>
                         <div class="col-md-4 mb-3">
                                        <label for="profession">Tanggal Sewa</label>
                                        <input type="date" class="form-control" name="tglsewa" id="tglsewa">
                                   </div></center> -->
                                   <!-- <div><label>&nbsp;</label></div> -->
                                   <div class="form-group row">
		<div class="col-sm-12 col-md-2">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Choose Armada</button>
		</div>
	</div>

	<table class="table table-bordered" id="keranjang">
		<thead>
			<tr>
				<th scope="col">Armada</th>
				<th scope="col">Tujuan Sewa</th>
				<th scope="col">Price</th>
				<th scope="col">Quantity</th>
				<th scope="col">Discount (Rp.)</th>
				<th scope="col">Sub Total</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
	</table>

	<br>
	<div class="clearfix" >
			<div class="form-group row">
				<div class="col-sm-12 col-md-7"></div>
				<div class="col-sm-12 col-md-2">
					<label><strong>Sub Total</strong></label><br>
				</div>
				<div class="col-sm-12 col-md-1">
					<label>Rp.</label><br>
				</div>
				<div class="col-sm-12 col-md-2">
					<label id="subtotal-val"></label><br>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12 col-md-7"></div>
				<div class="col-sm-12 col-md-2">
					<label><strong>DP 25%</strong></label><br>
				</div>
				<div class="col-sm-12 col-md-1">
					<label>Rp.</label><br>
				</div>
				<div class="col-sm-12 col-md-2">
					<label id="dpbus"></label><br>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12 col-md-7"></div>
				<div class="col-sm-12 col-md-2">
					<label><strong>SISA BAYAR</strong></label><br>
				</div>
				<div class="col-sm-12 col-md-1">
					<label>Rp.</label><br>
				</div>
				<div class="col-sm-12 col-md-2">
					<input type="hidden" name="total_payment" id="total_payment"><label id="total-val"></label><br>
				</div>
			</div>
	</div>
	<div class="clearfix" align="center">
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>
	<!-- Modal -->
	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered">
					
						<thead>
							<tr role="row">
								<th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Armada</th>
								<th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Tujuan Sewa</th>
								<th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Price</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $pricelist_sewa_armada as $p )
							<tr role="row" class="odd" onclick="pilihBarang('{{ $p -> ID_PRICELIST }}')" style="cursor:pointer">
								<td>{{ $p->NAMA_CATEGORY }}</td>
								<td>{{ $p->TUJUAN_SEWA }}</td>
                                <td>
                                Rp <?php echo number_format($p->PRICELIST_SEWA,'0',',','.'); ?>
                                </td>
								<!-- <td>{{ $p->PRICELIST_SEWA }}</td> -->
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<div>

					                            </div>
               
                    </form>

                </section>

                        <h3>Payment Details</h3>
                        <section class="card card-body border mb-0">
                            <h5>Invoice</h5>
                                    <div class="invoice">
                                        <div class="d-md-flex justify-content-between align-items-center">
                                            <img src="{{ url('assets/media/image/logo/mdc.png') }}" alt="logo">
                                            <h3 class="text-xs-left m-b-0">#INV-{{$sewa_bus->ID_SEWA_BUS}}</h3>
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
                                                    <b>{{$pengguna->NAMA_PENGGUNA}},</b><br>{{$sewa_bus->TGL_SEWA_BUS}}   -   {{$sewa_bus->TGL_AKHIR_SEWA}}
                                                    <br>{{$sewa_bus->JAM_SEWA}}       -      {{$sewa_bus->JAM_AKHIR_SEWA}}</p>
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
                                                        <th class="text-right">Total Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sewa_bus_category as $sbc)
                                                    @if($sbc->ID_SEWA_BUS == $sewa_bus->ID_SEWA_BUS)
                                                    <tr class="text-right">
                                                        <td class="text-left">{{ $loop->iteration }}</td>
                                                        <td class="text-left">{{$sbc -> NAMA_CATEGORY}} - 
                                                        {{$sbc -> TUJUAN_SEWA}}
                                                        </td>
                                                        <td>{{$sbc -> QUANTITY}}</td>
                                                        <td>Rp. {{$sbc -> PRICELIST_SEWA}}</td>
                                                        <td>Rp. {{$sbc -> TOTAL}}</td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="text-right">
                                                <p>Sub - Total : $12,348</p>
                                                <p>DP (25%) : $138</p>
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
                                
                        </section>
                        <h3>Schedule Armada</h3>
                        <section class="card card-body border mb-0">
                            <h5>Schedule Sewa Armada</h5>
                            <p>The next and previous buttons help you to navigate through your content.</p>
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
var barang = <?php echo json_encode($pricelist_sewa_armada); ?>;
	console.log(barang[0]["NAMA_CATEGORY"]);
	var colnum=0;

	function getVal(event){
		if (event.keyCode === 13) {
			modal();
		}
	}
	function pilihBarang(id){
		var index;
		for(var i=0;i<barang.length;i++){
			if(barang[i]["ID_PRICELIST"]==id){
				console.log(barang[i]);
				index=i;
				break;
			}
		}
		$("#myModal").modal("hide");

		var table = document.getElementById("keranjang");
		var row = table.insertRow(table.rows.length);
		row.setAttribute('id','col'+colnum);
		var id = 'col'+colnum;
		colnum++;

		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		var cell7 = row.insertCell(6);
		console.log(index);
		cell1.innerHTML = '<input type="hidden" name="id['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["ID_PRICELIST"]+'">'+barang[index]["NAMA_CATEGORY"];
		cell2.innerHTML = '<input type="hidden" name="id['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["NAMA_CATEGORY"]+'">'+barang[index]["TUJUAN_SEWA"];	
		cell3.innerHTML = '<input type="hidden" id="harga'+barang[index]["ID_PRICELIST"]+'" name="harga['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["PRICELIST_SEWA"]+'">'+barang[index]["PRICELIST_SEWA"];
		cell4.innerHTML = '<input type="number" name="qty['+barang[index]["ID_PRICELIST"]+']" value="1" oninput="recount(\''+barang[index]["ID_PRICELIST"]+'\')" id="qty'+barang[index]["ID_PRICELIST"]+'" style="background:secondary; border:none; text-align:left; width=100%">';	
        cell5.innerHTML = '<input class="discount" type="number" name="discount['+barang[index]["ID_PRICELIST"]+']" value="0" oninput="recount(\''+barang[index]["ID_PRICELIST"]+'\')" id="discount'+barang[index]["ID_PRICELIST"]+'" style="background:primary; border:none; text-align:left; width=100%">';	
		cell6.innerHTML = '<input type="hidden" class="subtotal" name="subtotal['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["PRICELIST_SEWA"]+'" id="subtotal'+barang[index]["ID_PRICELIST"]+'"><span id="subtotalval'+barang[index]["ID_PRICELIST"]+'">'+barang[index]["PRICELIST_SEWA"]+'</span>';
		cell7.innerHTML = '<button onclick="hapusEl(\''+id+'\')" class="btn btn-primary btn-block text-uppercase">Delete</button>';

		total();
		
	}
	function lm(i){
		var min =  document.getElementById("qty"+i).value;
		if(min <= 1){

		}else{
		min--;
		document.getElementById("qty"+i).value = min;
		recount(i);
		}
	}
	function ln(i){
		var plus =  document.getElementById("qty"+i).value;
		console.log(plus);
		plus++;
		document.getElementById("qty"+i).value = plus;
		console.log(plus);
		recount(i);
	}

	function total(){
		var subtotals = document.getElementsByClassName("subtotal");
		var total = 0;
		for(var i=0; i<subtotals.length;++i){
			total += Number(subtotals[i].value); 
		}
		document.getElementById("subtotal-val").innerHTML = total;
		var dp = parseInt(25/100*total);
		document.getElementById("dpbus").innerHTML = dp;
		total = parseInt(75/100*total);
		document.getElementById("total-val").innerHTML = total;
		document.getElementById("total_payment").value = total;

	}

	function recount(id){
		var price = document.getElementById("harga"+id).value;
		var diskon = document.getElementById("discount"+id).value;
		var sembarang = document.getElementById("qty"+id).value;
     
		var lego = Number(price*sembarang)-diskon; 
		document.getElementById("subtotal"+id).value = lego;
		document.getElementById("subtotalval"+id).innerHTML = lego;
		total();
	}

	function modal(){
		$("#myModal").modal("show");
		document.getElementById("myText").value = "";
	}
	function hapusEl(idCol) {
		document.getElementById(idCol).remove();
		total();
	}
</script>

<!-- Form wizard -->
<script src="{{ url('vendors/form-wizard/jquery.steps.min.js') }}"></script>
<script src="{{ url('assets/js/examples/form-wizard.js') }}"></script>

<!-- DataTable -->
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/datatable.js') }}"></script>

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