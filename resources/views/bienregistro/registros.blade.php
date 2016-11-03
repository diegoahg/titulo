@foreach($registros as $key => $registro)
<tr id="tr{{ $key +1}}">
	<td class="text-center">
		<button type="button" onclick="eliminarRegistro(this);"><i class="fa fa-remove"></i></button>
	</td>
	<td class="text-center">
		{{ $key +1  }}
	</td>
    <td class="text-center">
    	<div id="data">{{ $registro->codigo }}</div><input type='hidden' value='{{ $registro->codigo }}' name='data_codigo[]'/>
	</td>
    <td class="text-center">
        <div id="data">{{ $registro->descripcion }}</div><input type='hidden' value='{{ $registro->descripcion }}' name='data_descripcion[]'/>
    </td>
    <td class="text-center" class="text-center">
        <div id="data">{{ $registro->cantidad }}</div><input type='hidden' value='{{ $registro->cantidad }}' name='data_cantidad[]'/>
    </td>
    <td class="text-center">
        <div id="data">{{ $registro->valor}}</div><input type='hidden' value='{{ $registro->valor }}' name='data_valor[]'/>
    </td>
    <td class="text-center">
        <div id="data">{{ $registro->orden_compra }}</div><input type='hidden' value='{{ $registro->orden_compra }}' name='data_orden_compra[]'/>
    </td>
    <td class="text-center">
        <div id="data">{{ $registro->fecha_incorporacion }}</div><input type='hidden' value='{{ $registro->fecha_incorporacion }}' name='data_fecha[]'/>
    </td>
</tr>
@endforeach