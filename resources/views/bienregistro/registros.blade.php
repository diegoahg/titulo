@foreach($registros as $key => $registro)
<tr id="tr{{ $key +1}}">
	<td>
		<button type="button" onclick="DeleteRegistros({{$registro->id}},{{ $key +1}});"><i class="fa fa-remove"></i></button>
	</td>
	<td>
		{{ $key +1  }}
	</td>
    <td>
    	{{ $registro->codigo }}
	</td>
    <td>
    	{{ $registro->descripcion }}
    </td>
    <td>
    	{{ $registro->cantidad }}
    </td>
    <td>
    	${{ number_format($registro->valor, 0, '', '.') }}
    </td>
    <td>
    	{{ $registro->orden_compra }}
    </td>
    <td>
    	{{ $registro->fecha_incorporacion }}
    </td>
</tr>
@endforeach
<tr>
	<th colspan="7" style="text-align:right">Total</th>
	<th>${{number_format($total, 0, '', '.')}}</th>
</tr>
