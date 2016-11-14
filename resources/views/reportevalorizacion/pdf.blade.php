<html>
<title>Reporte</title>
<head>
  <style>
    @page { margin-top: 150px; margin-bottom: 300px;font-size: 12px}
    #header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px; margin-top: 20px}
    #nota { position: fixed; left: 0px; bottom: -300px; right: 0px; height: 300px; }
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
        <td style="text-align: center;">REPORTE DE INVENTARIO VALORIZADO</td>
      </tr>
    </table>
  </div>
  <div id="content">

    <?php $suma_total_inicial = 0; $suma_total_residual = 0;?>
    @foreach($sectors as $key => $sector)
     @if($key != 0)
      <div style="page-break-before: always;" >
    @else
      <div>
    @endif
      CENTRO DE COSTO ..> {{$sector->centrocosto->codigo}} {{$sector->centrocosto->nombre}} <br>
      SECTOR .......................> {{$sector->codigo}} {{$sector->nombre}}<br>
      DIRECCION ................> {{$sector->centrocosto->direccion}}
    </div>
   
    <table width="100%" style="margin-top: 20px; margin-bottom: 20px;text-align:center;">
      <thead>
        <tr>
          <td>Orden</td>
          <td>Número Inventario</td>
          <td>Descripción del Bien</td>
          <td>Fecha Incorporación</td>
          <td>Tipo Bien</td>
          <td>Vida Util</td>
          <td>Valor Inicial</td>
          <td>Valor Residual</td>
        </tr>
      </thead>
      <tbody>
                    <?php $suma_sector_inicial = 0; $suma_sector_residual = 0; ?>
        @foreach($bienes as $s => $bien)
          @if($sector->id == $bien->id_sector)
          <tr>
            <td>{{$s + 1}})</td>
            <td>{{$bien->codigo}}</td>
            <td>{{$bien->descripcion}}</td>
            <td>{{$bien->fecha_incorporacion}}</td>
            <td>{{$bien->bien}}</td>
            <td>{{$bien->vida_util}}</td>
            <td>${{number_format($bien->valor, 0, '', '.')}}</td>
            <td>${{number_format($bien->residual, 0, '', '.')}}</td>
          </tr>
                      <?php $suma_sector_inicial = $bien->valor + $suma_sector_inicial; ?>
                      <?php $suma_sector_residual = $bien->residual + $suma_sector_residual; ?>
                      <?php $suma_total_inicial = $bien->valor + $suma_total_inicial; ?>
                      <?php $suma_total_residual = $bien->residual + $suma_total_residual; ?>
          @endif
        @endforeach
        </tbody>
      <tfoot>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>TOTAL SECTOR</td>
            <td>${{number_format($suma_sector_inicial, 0, '', '.')}}</td>
            <td>${{number_format($suma_sector_residual, 0, '', '.')}}</td>
          </tr>
      </tfoot>
      
    </table>

  <div id="nota">
    <table  width="100%" border="0" style="margin-top: 70px; margin-bottom: 20px;">
        <tr>
          <td style="width:20%">
          </td>
          <td style="width:25%">
          <hr>
          </td>
          <td style="width:10%">
          </td>
          <td style="width:25%">
          <hr>
          </td>
          <td style="width:20%">
          </td>
        </tr>
        <tr>
          <td style="width:10%">
          </td>
          <td style="width:30%">
          <center>FIRMA UNIDAD</center>
          </td>
          <td style="width:20%">
          </td>
          <td style="width:30%">
          <center>FIRMA ENCARGADO DE SECTOR {{$sector->nombre}}</center>
          </td>
          <td style="width:10%">
          </td>
       <tr>
    </table>
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
    @endforeach
    <center><h1><strong>TOTAL VALOR INICIAL ${{number_format($suma_total_inicial, 0, '', '.')}}</strong></h1></center>
    <center><h1><strong>TOTAL VALOR RESIDUAL ${{number_format($suma_total_residual, 0, '', '.')}}</strong></h1></center>
  </div>
</body>
</html>