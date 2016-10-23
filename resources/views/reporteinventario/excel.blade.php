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
          </tr>
        </thead>
        <tbody>
          @if($tipo_bien == "activo")
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
          @endif
        </tbody>
      </table>  
  </body>
</html>