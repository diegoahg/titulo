<div id="modalVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="width: 70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Información del Bien Licencia</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<table class="table table-bordered table-hover table-responsive">
							<tbody>
								<tr>
									<th width="10">Numero:</th>
									<td width="25%">{{$bienlicencia->numero}}</td>
									<th width="10">Descripcion:</th>
									<td width="25%">{{$bienlicencia->descripcion}}</td>
									<th width="10"></th>
									<td width="25%"></td>
								</tr>
								<tr>
									<th width="10">Centro de Costo:</th>
									<td width="25%"> {{$bienlicencia->centrocosto->nombre}}</td>
									<th width="10">Sector:</th>
									<td width="25%">{{$bienlicencia->sector->nombre}}</td>
									<th width="10">Valor Unitario:</th>
									<td width="25%"> {{$bienlicencia->valor}}</td>
								</tr>
								<tr>
									<th width="10">Unidad:</th>
									<td width="25%"> {{$bienlicencia->unidad}}</td>
									<th width="10">Orden:</th>
									<td width="25%">{{$bienlicencia->orden}}</td>
									<th width="10">F. Incorporación:</th>
									<td width="25%"> {{$bienlicencia->fecha_incorporacion}}</td>
								</tr>
								<tr>
									<th width="10">Marca:</th>
									<td width="25%"> {{$bienlicencia->marca}}</td>
									<th width="10">Modelo:</th>
									<td width="25%"> {{$bienlicencia->modelo}}</td>
									<th width="10">Serie:</th>
									<td width="25%"> {{$bienlicencia->serie}}</td>
								</tr>
								<tr>
									<th width="10">Cuenta Contable:</th>
									<td width="25%"> {{$bienlicencia->cuentacontable}}</td>
									<th width="10">Alta:</th>
									<td width="20%">{{$bienlicencia->alta}}</td>
									<th width="10">Vida Util:</th>
									<td width="25%"> {{$bienlicencia->vida_util}}</td>
								</tr>
								<tr>
									<th width="10">Tipo Inventario:</th>
									<td width="25%"> {{$bienlicencia->tipo_inventario}}</td>
									<th width="10">Tipo bien:</th>
									<td width="20%">{{$bienlicencia->tipo_bien}}</td>
									<th width="10">Enmienda:</th>
									<td width="25%"> {{$bienlicencia->enmienda}} </td>
								</tr>

							</tbody>
						</table>
					</div>
					<!--/row-->
				</div>
			</div>
		</div>
	</div>
</div>