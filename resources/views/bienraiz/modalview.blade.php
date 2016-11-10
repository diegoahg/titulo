<div id="modalVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="width: 70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Información del Bien Raiz</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<table class="table table-bordered table-hover table-responsive">
							<tbody>
								<tr>
									<th width="10">Descripcion:</th>
									<td width="25%">{{$bienraiz->descripcion}}</td>
									<th width="10">Valor Inicial:</th>
									<td width="25%"> {{$bienraiz->valor_inicial}}</td>
									<th width="10">Avaluo Fiscal:</th>
									<td width="25%"> {{$bienraiz->avaluo_fiscal}}</td>
								</tr>
								<tr>
									<th width="10">Valor Total:</th>
									<td width="25%"> {{$bienraiz->valor_total}}</td>
									<th width="10">Número de ROL:</th>
									<td width="25%"> {{$bienraiz->num_rol}}</td>
									<th width="10">Cuenta Contable:</th>
									<td width="25%">{{$bienraiz->cuentacontable->nombre}}</td>
								</tr>
								<tr>
									<th width="10">Número de Alta:</th>
									<td width="25%"> {{$bienraiz->num_alta}}</td>
									<th width="10">Orden de Compra:</th>
									<td width="25%">{{$bienraiz->orden_compra}}</td>
									<th width="10">F. Incorporación:</th>
									<td width="25%"> {{$bienraiz->fecha_incorporacion}}</td>
								</tr>
								<tr>
									<th width="10">Tipo Inventario:</th>
									<td width="25%"> {{$bienraiz->tipo_inventario}}</td>
									<th width="10">Tipo bien:</th>
									<td width="20%">{{$bienraiz->tipo_bien}}</td>
									<th width="10">Dispone mejoras capitalizables:</th>
									<td width="25%"> {{$bienraiz->mejora}} </td>
								</tr>
								<tr>
									<th width="10">Observacion</th>
									<td width="25%" colspan="5"> {{$bienraiz->observacion}}</td>
								</tr>

							</tbody>
						</table>
						<!--/span-->
					</div>
					<!--/row-->
				</div>
			</div>
		</div>
	</div>
</div>