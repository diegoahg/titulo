<html>
	<title>
		Plancheta
	</title>
	<head>
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
		<table  width="100%" border="0">
            <tr>
              <td style="text-align: left;width:50%">
                UNIVERSIDAD TECNOLÓGICA METROPOLITANA<br>
                DEPARTAMENTO DE ABASTECIMIENTO<br>
                UNIDAD DE INVENTARIOS<br>
              </td>
              <td style="text-align: right;width:50%">
                FECHA  : {{date("Y-m-d")}}<br>
                HORA   : {{date("H-i-s")}}<br>
                Página :  <br>
              </td>
           <tr>
        </table>

		<U><center>PLANCHETA DE BIENES</center></u>

		CENTRO DE COSTO<br>
		OFICINA<br>
		DIRECCIÓN<br>
		<br>
		<br>
		<table width="100%">
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
        	@foreach($bienactivos as $key => $bienactivo)
            	<tr>
                    <td class="text-center">{{$key + 1}})</td>
                    <td class="text-center">{{$bienactivo->category->codigo}}-{{$bienactivo->numero}}</td>
                    <td class="text-center">{{$bienactivo->descripcion}}</td>
                    <td class="text-center">{{$bienactivo->fecha}}</td>
                    <td class="text-center">{{$bienactivo->marca}}</td>
                    <td class="text-center">{{$bienactivo->modelo}}</td>
                    <td class="text-center">{{$bienactivo->serie}}</td>
                    <td class="text-center">{{$bienactivo->largo}}</td>
                    <td class="text-center">{{$bienactivo->ancho}}</td>
                    <td class="text-center">{{$bienactivo->alto}}</td>
                </tr>
                <?php $bien_components = array_get($componentes, $bienactivo->id); ?>
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
      </table>  
      <br><br><br><br><br><br><br><br><br>
        <table  width="100%" border="0">
            <tr>
              <td style="width:20%">
              </td>
              <td style="width:20%">
              <hr><br>
              <center>Firma Unidad</center><br>
              </td>
              <td style="width:20%">
              </td>
              <td style="width:20%">
              <hr>
              <center>Firma Encargado de Oficina</center><br>
              </td>
              <td style="width:20%">
              </td>
           <tr>
        </table>
	</body>
</html>