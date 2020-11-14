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
<div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                    <!-- <div class="col-lg-4"></div> -->
                    <div class="col-lg-12">
                            <div class="card">
                            <center>
                                <div class="card-body">
                                    <h6 class="card-title">Geolocation</h6>
                                <div>
                                  <button type="button" class="btn btn-success btn-uppercase">
                                      <i class="ti-check-box mr-2" id="startButton">Start</i></button>
                                  <button type="button" class="btn btn-danger btn-uppercase" id="resetButton">
                                  <i class="ti-check-box mr-2" id="startButton">Reset</i></button>
                                  
                                  </div>
                                  <br/>
                                  <div>
                                    <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
                                  </div>
                                  <br/>
                                  <div id="sourceSelectPanel" style="display:none">
                                    <label for="sourceSelect">Change video source:</label>
                                    <select id="sourceSelect" style="max-width:400px">

                                    </select>
                                    <br>
                                    <!-- <br>
                                    <button type="button" class="btn btn-outline-primary">Take Location</button> -->
                                  </div>

                                  <pre><code id="result" type="hidden"></code></pre>

                                  <p><a href="https://github.com/zxing-js/library/tree/master/docs/examples/multi-camera/"></a></p>
                                                </div>
                                                </center>
                            </div></div></div>
                            </div></div>
                           
                            </div>

                        <div class="col-xl-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Lokasi Toko</h6>
                                    <br>
                                    
                                    <div class="form-group">
                                    <label for="latitude">Latitude :</label>
                                        <input name="latitude" id="latitudetoko" readonly class="form-control"></input>
                                        </div>
                                        <br>
                                    <div class="form-group">
                                        <label for="longitude">Longitude :</label>
                                        <input name="longitude" id="longitudetoko" readonly class="form-control"></input>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="accuracy">Accuracy :</label>
                                        <input name="accuracy"id="accuraccytoko" readonly class="form-control"></input>
                                    </div>
                                    
                                    
                                    <!-- <div id="default-map" style="height: 400px"></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Lokasi Sales</h6>
                                    <br>
                                    
                                    <div class="form-group">
                                    <label for="latitude">Latitude :</label>
                                        <input name="latitud" id="latitudesales" readonly class="form-control"></input>
                                        </div>
                                        <br>
                                    <div class="form-group">
                                        <label for="longitude">Longitude :</label>
                                        <input name="longitude" id="longitudesales" readonly class="form-control"></input>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="accuracy">Accuracy :</label>
                                        <input name="accuracy"id="accuraccysales" readonly class="form-control"></input>
                                    </div>
                                    
                                    
                                    <!-- <div id="default-map" style="height: 400px"></div> -->
                                </div>
                            </div>
                        </div>
                        
            <!-- <div class="col-xl-6 col-lg-4" id="map"></div> -->
       
          </div></div></div>

  

  <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
  <script type="text/javascript">
        var aaa;

        var latitudetoko;
        var longitudetoko;
        var accuraccytoko;

        var latitudesales;
        var longitudesales;
        var accuraccysales;

        var jarak;
        
    window.addEventListener('load', function () {
      getlocation();
      let selectedDeviceId;
      const codeReader = new ZXing.BrowserMultiFormatReader()
      console.log('ZXing code reader initialized')
      codeReader.listVideoInputDevices()
        .then((videoInputDevices) => {
          const sourceSelect = document.getElementById('sourceSelect')
          selectedDeviceId = videoInputDevices[0].deviceId
          if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
              const sourceOption = document.createElement('option')
              sourceOption.text = element.label
              sourceOption.value = element.deviceId
              sourceSelect.appendChild(sourceOption)
            })

            sourceSelect.onchange = () => {
              selectedDeviceId = sourceSelect.value;
            };

            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
          }

          document.getElementById('startButton').addEventListener('click', () => {
            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
              if (result) {
                console.log(result)
                document.getElementById('result').textContent = result.text;
                aaa = document.getElementById('result').textContent = result.text;
                data_barcode();
                toastr.options = {
                      timeOut: 3000,
                      progressBar: true,
                      showMethod: "slideDown",
                      hideMethod: "slideUp",
                      showDuration: 200,
                      hideDuration: 200
                  };

              toastr.success(result.text);
              }
              if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err)
                document.getElementById('result').textContent = err

              }
            })
            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
          })

          document.getElementById('resetButton').addEventListener('click', () => {
            codeReader.reset()
            document.getElementById('result').textContent = '';
            console.log('Reset.')
          })

        })
        .catch((err) => {
          console.error(err)
        })
    })

    
  

   function data_barcode(){
    console.log('masuk function data barcode');
          // var resultt = $('#result').value;
          console.log('nilai result');
          console.log(aaa);
                  jQuery.ajax({
                     url : 'barcode/getbarcode/' +aaa,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                       
                        jQuery.each(data, function(key,value){
                          console.log(value.LATITUDE);
                          // $("#latitudetoko").html(value.LATITUDE);
                          // $("#longitudetoko").html(value.LONGITUDE);
                          // $("#accuraccytoko").html(value.ACCURACY);

                          document.getElementById('latitudetoko').value =value.LATITUDE;
                          document.getElementById('longitudetoko').value =value.LONGITUDE;
                          document.getElementById('accuraccytoko').value =value.ACCURACY;
                          latitudetoko = value.LATITUDE;
                          longitudetoko = value.LONGITUDE;
                          accuraccytoko = value.ACCURACY;

                          jarak = getDistanceFromLatLonInKm(latitudetoko,longitudetoko,latitudesales,longitudesales);
                          console.log(jarak);
                          rata2akurasi();
                          console.log(ratakurasi);
                          kesimpulan();
                        });
                     }
                  });
   }

   var ratakurasi;
   
   
        function rata2akurasi(){
            var z = accuraccytoko + accuraccysales;
            ratakurasi = z/2;
        }

        function kesimpulan(){
            if(jarak<=ratakurasi){
              swal("Good job!", "Your Location Accepted!", "success");
            }
            else{
              swal("NO!", "Your Location Not Accepted!", "error");
            }
        }

        var latitude = document.getElementById("latitudesales");
        var longitude = document.getElementById("longitudesales");
        var akurasi = document.getElementById("accuraccysales");
       
        
        function getlocation(){ 
			if(navigator.geolocation){ 
				navigator.geolocation.getCurrentPosition(showLoc, errHand); 
				
			} 
		} 
		function showLoc(pos){ 
		long = pos.coords.longitude; 
			var accuracy = pos.coords.accuracy;	
      	latt = pos.coords.latitude; 

        console.log(latt);
           console.log(long);
          
           console.log(accuracy);
			latitude.value = latt;
			longitude.value = long
			akurasi.value = accuracy;

      latitudesales = latt;
      longitudesales = long;
      accuraccysales = accuracy;
		
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
      
      function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2-lat1); // deg2rad below
        var dLon = deg2rad(lon2-lon1);
        var a =
        Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        Math.sin(dLon/2) * Math.sin(dLon/2)
        ;
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c * 1000; // Distance in km
        return d;
        }
        
      function deg2rad(deg) {
        return deg * (Math.PI/180)
      }

 
    </script>

@endsection