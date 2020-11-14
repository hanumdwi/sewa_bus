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
  <main class="wrapper">
  <div class="card-body">
                <div class="table-responsive">
                <table class="table">
    <section class="container" id="demo-content">
    <center>
      <h1 class="title">Scan Barcode</h1>

      <p></p>

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
        <label for="sourceSelect">Change video source : </label>
        <select id="sourceSelect" style="max-width:400px">
        </select>
      </div>

      <div class="form-group col-md-2">
      <label for="inputZip">Result :</label>
      <input type="text" readonly class="form-control" id="result">
    </div>
  </div>
<!-- <div class="row" style="background-color:red;">
      <label>Result : </label>
      <pre><code id="result"></code></pre>
      </div> -->
      

      <p><a href="https://github.com/zxing-js/library/tree/master/docs/examples/multi-camera/"></a></p>
    </section>
    </center>
    <footer class="footer">
      <section class="container">
        <p><a target="_blank"
            href="https://github.com/zxing-js/library#license" title="MIT"></a></p>
      </section>
    </footer>
</table>
</div>
</div>
  </main>
  </div>
  </div>

  <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
  <script type="text/javascript">
    window.addEventListener('load', function () {
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
                console.log(result);
                document.getElementById('result').textContent = result.text;
                document.getElementById('result').value = result.text;
                console.log('woi');
                console.log(result.text);
                $('#result').html(result.text);
                toastr.options = {
                      timeOut: 3000,
                      progressBar: true,
                      showMethod: "slideDown",
                      hideMethod: "slideUp",
                      showDuration: 200,
                      hideDuration: 200
                  };
              var muncul = "Your barcode Detected : \n" + result.text;
              toastr.success('Successfully Scan Barcode', muncul);
              
                
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
  </script>

@endsection