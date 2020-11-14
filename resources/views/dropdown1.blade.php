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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<div class="page-header">
        <div class="page-title">
            <h3>Customer Forms</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        
                            <form class="form-horizontal" action="customerstore2" method="post">
                              @csrf
                                <div class="form-group">
                                <label for="nama">Nama :</label>
                                    <input name="nama" class="form-control"></input>
                                    </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <input name="alamat" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                <label for="provinsi">Select provinsi:</label>
                                 <select name="provinsi" class="form-control">
                                    <option value="">--- Select provinsi ---</option>
                                    @foreach ($provinsi as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                 </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="kota">Select kota:</label>
                                       <select name="kota" class="form-control">
                                          <option>-- Select kota --</option>
                                       </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="kecamatan">Select kecamatan:</label>
                                       <select name="kecamatan" class="form-control">
                                          <option>-- Select kecamatan --</option>
                                       </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="kelurahan">Select Kelurahan - Kode Pos:</label>
                                       <select name="kelurahan" class="form-control">
                                          <option>-- Select Kelurahan - Kode Pos --</option>
                                       </select>
                                 </div>
                                 <p id="hasil"></p>
                                 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                                 Snapshoot
                                 </button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="indexdropdown1" class="btn btn-secondary">Data Customer</a>
                    
   <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-row">
                     <div class="col-md-4">
                     <div id="camera" style="height:auto;width:auto; text-align:left;"></div>
                     </div>
                     <div class="col-md-2">
                     </div>
                     <div class="col-md-4 mt-2">
                     <p id="snapShot"></p>
                     </div>
                     </div>
                     <div class="form-row">
                     <div class="col-md-4">
                     </div>
                     <div class="col-md-3">
                     </div>
                     <div class="col-md-3">
                     <button type="button" class="btn btn-primary btn-square" id="btPic" onclick="takeSnapShot()">Ambil Foto</button>
                     </div>
                     </div>

         </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="notsaveimage()" >Close</button>
                     <button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="saveimage()">Save changes</button>

      </div>
    </div>
  </div>
  </div>
  </div>
                            </form>
                        </div>
                    </div>

@section('script')
<script>
    // CAMERA SETTINGS.
    Webcam.set({
        width: 200,
        height: 170,
        image_format: 'png',
        jpeg_quality: 100,
        flip_horiz: true
    });
    Webcam.attach('#camera');

    // SHOW THE SNAPSHOT.
    takeSnapShot = function () {
        Webcam.snap(function (data_uri) {
            document.getElementById('snapShot').innerHTML = 
                '<img src="' + data_uri + '" width="200px" height="153px" />'
                 
        });
    }

    saveimage = function () {
        Webcam.snap(function (data_uri) {
         document.getElementById('hasil').innerHTML = 
                '<img src="' + data_uri + '" width="200px" height="153px" />'+
                '<input type="hidden" value="'+ data_uri +'" name="foto">'
        });
    }
         
    function notsaveimage(){
               console.log('masuk function not save image');
               document.getElementById('hasil').innerHTML = '';
            }
         
</script>

    <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="provinsi"]').on('change',function(){
               var provinsiID = jQuery(this).val();
               if(provinsiID)
               {
                  jQuery.ajax({
                     url : 'dropdownlist/getstates/' +provinsiID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="kota"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="kota"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="kota"]').empty();
               }
            });

            jQuery('select[name="kota"]').on('change',function(){
               var kotaID = jQuery(this).val();
               if(kotaID)
               {
                
                  jQuery.ajax({
                     url : 'dropdownlist/getkecamatan/' +kotaID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {

                        console.log(data);
                        jQuery('select[name="kecamatan"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="kecamatan"]').empty();
               }
            });

            jQuery('select[name="kecamatan"]').on('change',function(){
               var kecamatanID = jQuery(this).val();
               if(kecamatanID)
               {
                  jQuery.ajax({
                     url : 'dropdownlist/getkelurahan/' +kecamatanID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="kelurahan"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value.NAMA_KELURAHAN + ' - '+ value.KODEPOS+'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="kelurahan"]').empty();
               }
            });
            
    });
    </script>

@endsection


@endsection