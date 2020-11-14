<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode-{{$barcode}}</title>
</head>
<style type="text/css">
  /* @page {size: F4 potrait; margin-left: 12.44px; margin-top: 11.33px;} */
  @page {size: F4 potrait; margin-left: 12.44px; margin-top: 16;}
  body {font-size: 20pt;}
  td { border:0px solid !important; width: 146.9px; height: 47.99; text-align: center; padding-bottom: 2.1; padding-top: 3; padding-left: 2.5;}
  img{text-align: left;}
</style>
<body>
  <table width="100%">
      <tr>
        <td align="center">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
          <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($barcode, 'QRCode')}}" height="300" width="300" >
          <br>{{$barcode}}
          @foreach($lokasi_toko as $b)
          <br>{{$b->NAMA_TOKO}}
          @endforeach
        </td>
      </tr>
  </table>
</body>
</html>

