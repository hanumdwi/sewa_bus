<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode-{{$barang_id}}</title>
</head>
<style type="text/css">
  /* @page {size: F4 potrait; margin-left: 12.44px; margin-top: 11.33px;} */
  @page {size: F4 potrait; margin-left: 12.44px; margin-top: 16;}
  body {font-size: 7pt;}
  td { border:0px solid !important; width: 146.9px; height: 47.99; text-align: center; padding-bottom: 2.1; padding-top: 3; padding-left: 2.5;}
  img{text-align: left;}
  tr{margint-top:2mm;}
</style>
<body>
  <table width="100%">
      @php for($i=0;$i<8;$i++){ @endphp
      <tr>
        <td align="center">
          <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('$barang_id', 'C128')}}" height="15" width="100" >
          <br>{{$barang_id}}
          @foreach($barang as $b)
          <br>{{$b->NAMA_BARANG}}
          @endforeach
        </td>
        <td align="center">
          <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('$barang_id', 'C128')}}" height="15" width="100">
          <br>{{$barang_id}}
          @foreach($barang as $b)
          <br>{{$b->NAMA_BARANG}}
          @endforeach
        </td>
        <td align="center">
          <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('$barang_id', 'C128')}}" height="15" width="100">
          <br>{{$barang_id}}
          @foreach($barang as $b)
          <br>{{$b->NAMA_BARANG}}
          @endforeach
        </td>
        <td align="center">
          <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('$barang_id', 'C128')}}" height="15" width="100">
          <br>{{$barang_id}}
          @foreach($barang as $b)
          <br>{{$b->NAMA_BARANG}}
          @endforeach
        </td>
        <td align="center">
          <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('$barang_id', 'C128')}}" height="15" width="100">
          <br>{{$barang_id}}
          @foreach($barang as $b)
          <br>{{$b->NAMA_BARANG}}
          @endforeach
        </td>
      </tr>
      @php } @endphp
  </table>
</body>
</html>

