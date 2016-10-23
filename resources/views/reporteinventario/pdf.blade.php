<html>
	<title>
		Plancheta
	</title>
	<head>
		<style type="text/css">
			body{
				font-size: 8px;
        font-family: '911', "Agency FB", verdana, helvetica, sans-serif; 
			}

			.text-center{
				text-align: center;
			}

      .header,{
          width: 100%;
          text-align: center;
          position: relative;
      }
      .header {
          top: 0px;
      }
      .pagenum:before {
          content: counter(page);
      }
		</style>
	</head>
	<body>
    
		<div class="header">
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
              Página :  <span class="pagenum"></span><br>
            </td>
         <tr>
      </table>

      <U><center>PLANCHETA DE BIENES</center></u>

      <table  width="100%" border="0">
        <tr>
            <td style="text-align: left;width:50%">
              CENTRO DE COSTO<br>
              OFICINA<br>
              DIRECCIÓN<br>
            </td>
         <tr>
      </table>

      
      <br>
      <br>
    </div>
		<table width="100%" class="text-center">
      @if($tipo_bien == "activo")
        <thead>
          @for($i=0; $i<30; $i++)
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
          @endfor
        </thead>
        <tbody>
        	@foreach($bienes as $key => $bien)
            	<tr>
                    <td class="text-center">{{$key + 1}})</td>
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

        </tbody>
        @endif
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
        <br>
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
        
	</body>
</html>