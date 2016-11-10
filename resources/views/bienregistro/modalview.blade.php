<div id="modalVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="width: 70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Información del Bien Registro</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<table class="table table-bordered table-hover table-responsive">
							<tbody>
								<tr>
									<th width="10">Código:</th>
									<td width="25%">{{$bienregistro->codigo}}</td>
									<th width="10">Descripción:</th>
									<td width="25%">{{$bienregistro->descripcion}}</td>
									<th width="10">Cantidad:</th>
									<td width="25%"> {{$bienregistro->cantidad}}</td>
								</tr>
								<tr>
									<th width="10">Orden de Compra:</th>
									<td width="25%"> {{$bienregistro->orden_compra}}</td>
									<th width="10">Centro de Costo:</th>
									<td width="25%">{{$bienregistro->centrocosto->nombre}}</td>
									<th width="10">Sector:</th>
									<td width="25%"> {{$bienregistro->sector->nombre}}</td>
								</tr>
								<tr>
									<th width="10">Valor Unitario:</th>
									<td width="25%"> {{$bienregistro->valor}}</td>
									<th width="10"></th>
									<td width="25%"></td>
									<th width="10"></th>
									<td width="25%"></td>
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