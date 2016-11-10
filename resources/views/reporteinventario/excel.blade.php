<html>
  <title>
    Plancheta
  </title>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
      body{
        font-size: 8px;
      }

      td, tr, th{
        text-align: center;
      }
    </style>
  </head>
  <body>
    <table>
        @if($tipo_bien == "activo")
            <thead>
              <tr>
                <th class="text-center">ORDEN</th>
                <th class="text-center">N° INVENTARIO</th>
                <th class="text-center">DESCRIPCION DEL BIEN </th>
                <th class="text-center">FECHA INSCRIPCIÓN</th>
                <th class="text-center">MARCA</th>
                <th class="text-center">MODELO</th>
                <th class="text-center">N° SERIE</th>
                <th class="text-center">LARGO</th>
                <th class="text-center">ANCHO</th>
                <th class="text-center">ALTO</th>
                <th class="text-center">CENTRO</th>
                <th class="text-center">SECTOR</th>
              </tr>
            </thead>
            <tbody>
            @foreach($bienes as $key => $bien)
                <tr>
                      <td class="text-center">{{$key + 1}}</td>
                      <td class="text-center">{{$bien->category->codigo}}-{{$bien->numero}}</td>
                      <td class="text-center">{{$bien->descripcion}}</td>
                      <td class="text-center">{{$bien->fecha}}</td>
                      <td class="text-center">{{$bien->marca}}</td>
                      <td class="text-center">{{$bien->modelo}}</td>
                      <td class="text-center">{{$bien->serie}}</td>
                      <td class="text-center">{{$bien->largo}}</td>
                      <td class="text-center">{{$bien->ancho}}</td>
                      <td class="text-center">{{$bien->alto}}</td>
                      <td class="text-center">{{$bien->centrocosto->nombre}}</td>
                      <td class="text-center">{{$bien->sector->nombre}}</td>
                  </tr>
                  <?php $bien_components = array_get($componentes, $bien->id); ?>
                  @if(count($bien_components)>0)
                      <tr>
                          <th class="text-center"></th>
                          <th class="text-center"></th>
                          <th class="text-center">Código</th>
                          <th class="text-center" colspan="3">Descripción del Componente </th>
                          <th class="text-center">Marca</th>
                          <th class="text-center">Modelo</th>
                          <th class="text-center">Número de Serie</th>
                          <th class="text-center"></th>
                      </tr>
                      <tr>
                          <th class="text-center"></th>
                          <td class="text-center"></td>
                          <td class="text-center" colspan="8"><hr style="border:1px dotted;"></td>
                      </tr> 
                  @foreach($bien_components as $bien_component)
                      <tr>
                          <th class="text-center"></th>
                          <td class="text-center"></td>
                          <td class="text-center">{{$bien_component["codigo"]}}</td>
                          <td class="text-center" colspan="3">{{$bien_component["descripcion"]}}</td>
                          <td class="text-center">{{$bien_component["marca"]}}</td>
                          <td class="text-center">{{$bien_component["modelo"]}}</td>
                          <td class="text-center">{{$bien_component["serie"]}}</td>
                          <td class="text-center"></td>
                      </tr>  
                  @endforeach

                  <tr>
                      <th class="text-center"></th>
                      <td class="text-center"></td>
                      <td class="text-center" colspan="8" ><hr></td>
                  </tr>
                  @endif
            @endforeach
            </tbody>
          @endif
          @if($tipo_bien == "registro")
              <thead>
                <tr>
                  <th class="text-center">CODIGO</th>
                  <th class="text-center">DESCRIPCIÓN</th>
                  <th class="text-center">CANTIDAD</th>
                  <th class="text-center">ORDEN COMPRA</th>
                  <th class="text-center">FECHA REGISTRO</th>
                  <th class="text-center">CENTRO</th>
                  <th class="text-center">SECTOR</th>
                </tr>
              </thead>
              <tbody>
                @foreach($bienes as $bien)
                <tr>
                    <td class="text-center">{{$bien->codigo}}</td>
                    <td class="text-center">{{$bien->descripcion}}</td>
                    <td class="text-center">{{$bien->cantidad}}</td>
                    <td class="text-center">{{$bien->orden_compra}}</td>
                    <td class="text-center">{{$bien->fecha_incorporacion}}</td>
                    <td class="text-center">{{$bien->centrocosto->nombre}}</td>
                    <td class="text-center">{{$bien->sector->nombre}}</td>
                </tr>
                @endforeach
              </tbody>
          @endif
          @if($tipo_bien == "licencia")
            <thead>
              <tr>
                <th class="text-center">Codigo</th>
                <th class="text-center">Descripción del Bien </th>
                <th class="text-center">Fecha Incorporación</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Modelo</th>
                <th class="text-center">N° Serie</th>
                <th class="text-center">CENTRO</th>
                <th class="text-center">SECTOR</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bienes as $bien)
              <tr>
                  <td class="text-center">{{$bien->numero}}</td>
                  <td class="text-center">{{$bien->descripcion}}</td>
                  <td class="text-center">{{$bien->fecha}}</td>
                  <td class="text-center">{{$bien->marca}}</td>
                  <td class="text-center">{{$bien->modelo}}</td>
                  <td class="text-center">{{$bien->serie}}</td>
                  <td class="text-center">{{$bien->centrocosto->nombre}}</td>
                  <td class="text-center">{{$bien->sector->nombre}}</td>
              </tr>
              @endforeach
            </tbody>
          @endif
      </table>  
  </body>
</html>