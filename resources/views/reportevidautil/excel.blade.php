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
  </body>
</html>