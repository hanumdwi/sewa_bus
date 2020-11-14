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

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
   
    <style type="text/css">
     
      #map {
        height: 100%;
      }

      html,
      body {
        height: 80%;
        margin: 0;
        padding: 0;
      }
    </style>
  
@endsection

        @section('content')
        <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Form Default</h6>
                                    <br>
                                    <form class="form-horizontal" action="insertlokasi" method="post">
                              @csrf
                                    <div class="form-group">
                                    <label for="latitude">Nama Toko :</label>
                                        <input name="namatoko" class="form-control"></input>
                                        </div>
                                    <div class="form-group">
                                    <label for="latitude">Latitude :</label>
                                        <input name="latitude" id="lat" readonly class="form-control"></input>
                                        </div>
                                    <div class="form-group">
                                        <label for="longitude">Longitude :</label>
                                        <input name="longitude" id="lng" readonly class="form-control"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="accuracy">Accuracy :</label>
                                        <input name="accuracy"id="accuraccy" readonly class="form-control"></input>
                                    </div>
                                    <br>
                                    <button  type="button" class="btn btn-primary btn-xl-6 btn-lg-2" id ="geolocation" onclick="getlocation()">Submit Geolocation</butoon>
                                    <button  type="submit" class="btn btn-secondary btn-xl-6 btn-lg-2 ml-3" >Submit Data</butoon>
                                    
                                    <!-- <div id="default-map" style="height: 400px"></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Geolocation</h6>
                                    <div id="map" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- <div class="col-xl-6 col-lg-4" id="map"></div> -->
          </div></div></div></div>
        @endsection

@section('script')

 <!-- <script src="{{ url('assets/js/examples/google-map.js') }}"></script> -->

<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAznbmf9fxvDrf8Fnv8MPq09mQN5NVXtZk&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
<script>

        var latitude = document.getElementById("lat");
        var longitude = document.getElementById("lng");
        var akurasi = document.getElementById("accuraccy");

        
        function getlocation(){ 
			if(navigator.geolocation){ 
				navigator.geolocation.getCurrentPosition(showLoc, errHand); 
				
			} 
		} 
		function showLoc(pos){ 
			latt = pos.coords.latitude; 
			long = pos.coords.longitude; 
			var accuracy = pos.coords.accuracy;
            // x.innerHTML = "Latitude: " + latt + "<br>Longitude: " + long;
			latitude.value = latt;
			longitude.value = long
			akurasi.value = accuracy;

			var hasil = "Latitude: " + latt + "\n Longitude: " + long + "\n Accuracy: "+accuracy;
			swal("Lokasi Di Temukan ",hasil, "success");
			var lattlong = new google.maps.LatLng(latt, long); 
			var OPTions = { 
				center: lattlong, 
				zoom: 10, 
				mapTypeControl: true, 
				navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL} 
			} 
			var mapg = new google.maps.Map(document.getElementById("map"), OPTions); 
	
			var markerg = 
			new google.maps.Marker({position:lattlong, map:mapg, title:"You are here!"}); 
		} 

		
		
		function errHand(err) { 
			switch(err.code) { 
				case err.PERMISSION_DENIED: 
					result.innerHTML = "The application doesn't have the permission" + 
							"to make use of location services" 
					break; 
				case err.POSITION_UNAVAILABLE: 
					result.innerHTML = "The location of the device is uncertain" 
					break; 
				case err.TIMEOUT: 
					result.innerHTML = "The request to get user location timed out" 
					break; 
				case err.UNKNOWN_ERROR: 
					result.innerHTML = "Time to fetch location information exceeded"+ 
					"the maximum timeout interval" 
					break; 
			} 
		} 
      
    </script>

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
