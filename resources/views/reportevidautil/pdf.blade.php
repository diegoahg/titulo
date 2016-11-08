<html>
<title>Reporte</title>
<head>
  <style>
    @page { margin-top: 150px; margin-bottom: 150px;font-size: 12px}
    #header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px; margin-top: 20px}
    #nota { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px; }
    #header .page:after { content: counter(page); }
    #content { margin-left: : 50px;  margin-right: 50px }
  </style>
<body>
  <div id="header">
    <table width="100%" border="0">
      <tr>
        <td style="text-align: center;width: 40%">UNIVERSIDAD TECNÓLOGICA METROPOLITANA<br>DEPARTAMENTO DE ABASTECIMIENTO<br>UNIDAD DE INVENTARIOS</td>
        <td style=";width: 42%"></td>
        <td style="text-align: left;width: 18%"> 
              FECHA  : <span style="text-align: right;">{{date("d/m/Y")}} </span><br>
              HORA   : <span style="text-align: right;">{{date("H:i:s")}} </span><br>
              PÁGINA :  <span class="page" style="text-align: right;"> </span><br>
        </td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr>
        <td style="text-align: center;">PLANCHETA DE BIENES</td>
      </tr>
      <tr>
        <td style="text-align: center;">---------------------------------------------</td>
      </tr>
      <tr>
        <td style="text-align: center;">REPORTE DE VIDA UTIL</td>
      </tr>
    </table>
  </div>
  <div id="nota">
    <table  width="50%" border="0">
        <tr>
          <td style="width:10%" style="text-align: right;">
            NOTA:
          </td>
          <td style="width:90%" style="text-align: left !important;">
            ESTA ESTRICTAMENTE PROHIBIDO EFECTUAR MOVIMIENTO DE LOS BIENES AQUÍ ESPEFICADOS SIN LA AUTORIZACION DEL JEFE DE LA OFICINA Y DE LA UNIDAD DE INVENTARIOS
          </td>
       <tr>
    </table> 
  </div>
  <div id="content">   
    <table width="100%" style="margin-top: 20px; margin-bottom: 20px;text-align:center;">
      <thead>
        <tr>
          <th>N° Inventario</th>
          <th>Descripción del Bien </th>
          <th>Fecha Incorporación</th>
          <th>Centro de Costo</th>
          <th>Sector</th>
          <th>Cuenta Contable</th>
          <th>Vida Util</th>
          <th>Año Expiración</th>
        </tr>
      </thead>
      <tbody>
            @foreach($bienes as $bien)
            <tr>
                <td class="text-center">{{$bien->codigo}}</td>
                <td class="text-center">{{$bien->descripcion}}</td>
                <td class="text-center">{{$bien->fecha_incorporacion}}</td>
                <td class="text-center">{{$bien->centro}}</td>
                <td class="text-center">{{$bien->sector}}</td>
                <td class="text-center">{{$bien->cuenta_contable}}</td>
                <td class="text-center">{{$bien->vida_util}}</td>
                <td class="text-center">{{$bien->expiracion}}</td>
            </tr>
            @endforeach
        </tbody>
      
    </table>
  </div>
</body>
</html>