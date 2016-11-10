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
        @if($tipo_bien == "activo")
          <td style="text-align: center;">PLANCHETA DE BIENES ACTIVOS</td>
        @endif
        @if($tipo_bien == "registro")
          <td style="text-align: center;">PLANCHETA DE BIENES DE REGISTRO</td>
        @endif
        @if($tipo_bien == "licencia")
          <td style="text-align: center;">PLANCHETA DE BIENES DE LICENCIA</td>
        @endif
      </tr>
      <tr>
        <td style="text-align: center;">---------------------------------------------</td>
      </tr>
      <tr>
        <td style="text-align: center;">REPORTE DE INVENTARIO</td>
      </tr>
    </table>
  </div>
  <div id="content">
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
      @if($tipo_bien == "activo")
        <thead>
          <tr>
            <td colspan="10"><hr></td>
          </tr>
          <tr>
            <td style="width: 5%">ORDEN</td>
            <td style="width: 15%">N° INVENTARIO</td>
            <td style="width: 25%">DESCRIPCION DEL BIEN </td>
            <td style="width: 10%">FECHA INSCRIPCIÓN</td>
            <td style="width: 10%">MARCA</td>
            <td style="width: 10%">MODELO</td>
            <td style="width: 10%">N° SERIE</td>
            <td style="width: 5%">LARGO</td>
            <td style="width: 5%">ANCHO</td>
            <td style="width: 5%">ALTO</td>
          </tr>
          <tr>
            <td colspan="10"><hr></td>
          </tr>
        </thead>
        <tbody>
          @foreach($bienes as $orden => $bien)
            @if($bien->id_sector == $sector->id)
              <tr>
                    <td>{{$orden + 1}})</td>
                    <td>{{$bien->category->codigo}}-{{$bien->numero}}</td>
                    <td>{{$bien->descripcion}}</td>
                    <td>{{$bien->fecha}}</td>
                    <td>{{$bien->marca}}</td>
                    <td>{{$bien->modelo}}</td>
                    <td>{{$bien->serie}}</td>
                    <td>{{$bien->largo}}</td>
                    <td>{{$bien->ancho}}</td>
                    <td>{{$bien->alto}}</td>
                </tr>
                <?php $bien_components = array_get($componentes, $bien->id); ?>
                @if(count($bien_components)>0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Código</td>
                        <td colspan="3">Descripción del Componente </td>
                        <td>Marca</td>
                        <td>Modelo</td>
                        <td>Número de Serie</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="8"><hr style="border:1px dotted;"></td>
                    </tr> 
                  @foreach($bien_components as $cant => $bien_component)
                      <tr>
                          <td></td>
                          <td></td>
                          <td>{{$bien_component["codigo"]}} {{$cant+1}}/{{count($bien_components)}}</td>
                          <td colspan="3">{{$bien_component["descripcion"]}}</td>
                          <td>{{$bien_component["marca"]}}</td>
                          <td>{{$bien_component["modelo"]}}</td>
                          <td>{{$bien_component["serie"]}}</td>
                          <td></td>
                      </tr>  
                  @endforeach

                  <tr>
                      <td></td>
                      <td></td>
                      <td colspan="8" ><hr></td>
                  </tr>
                @endif
              @endif
          @endforeach
        </tbody>
      @endif
      @if($tipo_bien == "registro")
          <thead>
            <tr>
              <td colspan="10"><hr></td>
            </tr>
            <tr>
              <td style="width: 5%">ORDEN</td>
              <td style="width: 20%">CODIGO</td>
              <td style="width: 25%">DESCRIPCIÓN</td>
              <td style="width: 20%">CANTIDAD</td>
              <td style="width: 15%">ORDEN DE COMPRA</td>
              <td style="width: 15%">FECHA DE REGISTRO</td>
            </tr>
            <tr>
              <td colspan="10"><hr></td>
            </tr>
          </thead>
          <tbody>
          @foreach($bienes as $orden => $bien)
            @if($bien->id_sector == $sector->id)
              <tr>
                  <td>{{$orden + 1}})</td>
                  <td>{{$bien->codigo}}</td>
                  <td>{{$bien->descripcion}}</td>
                  <td>{{$bien->cantidad}}</td>
                  <td>{{$bien->orden_compra}}</td>
                  <td>{{$bien->fecha_incorporacion}}</td>
              </tr>
            @endif
        @endforeach
      @endif
      @if($tipo_bien == "licencia")
        <thead>
          <tr>
            <td colspan="10"><hr></td>
          </tr>
          <tr>
            <td style="width: 5%">ORDEN</td>
            <td style="width: 15%">CODIGO</td>
            <td style="width: 25%">DESCRIPCION DEL BIEN </td>
            <td style="width: 10%">FECHA INSCRIPCIÓN</td>
            <td style="width: 15%">MARCA</td>
            <td style="width: 15%">MODELO</td>
            <td style="width: 15%">N° SERIE</td>
          </tr>
          <tr>
            <td colspan="10"><hr></td>
          </tr>
        </thead>
        <tbody>
          @foreach($bienes as $orden => $bien)
            @if($bien->id_sector == $sector->id)
              <tr>
                  <td>{{$orden + 1}})</td>
                  <td>{{$bien->numero}}</td>
                  <td>{{$bien->descripcion}}</td>
                  <td>{{$bien->fecha}}</td>
                  <td>{{$bien->marca}}</td>
                  <td>{{$bien->modelo}}</td>
              </tr>
            @endif
          @endforeach
        </tbody>
      @endif
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
          <center>FIRMA UNIDAD DE INVENTARIOS</center>
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
  </div>
</body>
</html>