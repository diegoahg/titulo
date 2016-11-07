<?php use App\Sector as Sector; ?>
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
            <th>Orden</th>
            <th>Número Inventario</th>
            <th>Descripción del Bien</th>
            <th>Fecha Incorporación</th>
            <th>Centro de Costo</th>
            <th>Sector</th>
            <th>Tipo Bien</th>
            <th>Vida Util</th>
            <th>Valor Inicial</th>
            <th>Valor Residual</th>
          </tr>
        </thead>
        <tbody>
            @foreach($bienes as $key => $bien)
              <?php $sector = Sector::find($bien->id_sector); ?>
                <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$bien->codigo}}</td>
                      <td>{{$bien->descripcion}}</td>
                      <td>{{$bien->fecha_incorporacion}}</td>
                      <td>{{$sector->centrocosto->nombre}}</td>
                      <td>{{$sector->nombre}}</td>
                      <td>{{$bien->bien}}</td>
                      <td>{{$bien->vida_util}}</td>
                      <td>{{$bien->valor}}</td>
                      <td>{{$bien->residual}}</td>
                  </tr>
            @endforeach
        </tbody>
      </table>  
  </body>
</html>