<div id="modalVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="width: 70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Información del Bien Activo</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<table class="table table-bordered table-hover table-responsive">
							<tbody>
								<tr>
									<th width="10">Numero:</th>
									<td width="25%"> {{$bienactivo->category->codigo}}-{{$bienactivo->numero}}</td>
									<th width="10">Descripcion:</th>
									<td width="25%">{{$bienactivo->descripcion}}</td>
									<th width="10">Categoria:</th>
									<td width="25%"> {{$bienactivo->category->categoria}}</td>
								</tr>
								<tr>
									<th width="10">Centro de Costo:</th>
									<td width="25%"> {{$bienactivo->centrocosto->nombre}}</td>
									<th width="10">Sector:</th>
									<td width="25%">{{$bienactivo->sector->nombre}}</td>
									<th width="10">Valor Unitario:</th>
									<td width="25%"> {{$bienactivo->valor}}</td>
								</tr>
								<tr>
									<th width="10">Unidad:</th>
									<td width="25%"> {{$bienactivo->unidad}}</td>
									<th width="10">Orden:</th>
									<td width="25%">{{$bienactivo->orden}}</td>
									<th width="10">F. Incorporación:</th>
									<td width="25%"> {{$bienactivo->fecha_incorporacion}}</td>
								</tr>
								<tr>
									<th width="10">Marca:</th>
									<td width="25%"> {{$bienactivo->marca}}</td>
									<th width="10">Modelo:</th>
									<td width="25%"> {{$bienactivo->modelo}}</td>
									<th width="10">Serie:</th>
									<td width="25%"> {{$bienactivo->serie}}</td>
								</tr>
								<tr>
									<th width="10">Largo:</th>
									<td width="25%"> {{$bienactivo->largo}}</td>
									<th width="10">Alto:</th>
									<td width="20%">{{$bienactivo->alto}}</td>
									<th width="10">Ancho:</th>
									<td width="25%"> {{$bienactivo->ancho}}</td>
								</tr>
								<tr>
									<th width="10">Cuenta Contable:</th>
									<td width="25%"> {{$bienactivo->cuentacontable->nombre}}</td>
									<th width="10">Alta:</th>
									<td width="20%">{{$bienactivo->alta}}</td>
									<th width="10">Vida Util:</th>
									<td width="25%"> {{$bienactivo->vida_util}}</td>
								</tr>
								<tr>
									<th width="10">Tipo Inventario:</th>
									<td width="25%"> {{$bienactivo->tipo_inventario}}</td>
									<th width="10">Tipo bien:</th>
									<td width="20%">{{$bienactivo->tipo_bien}}</td>
									<th width="10">Enmienda:</th>
									<td width="25%"> {{$bienactivo->enmienda}} </td>
								</tr>

							</tbody>
						</table>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3"></label>
								<div class="col-md-9">
									<p class="form-control-static">
										 
									</p>
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3"></label>
								<div class="col-md-9">
									<p class="form-control-static">
										 
									</p>
								</div>
							</div>
						</div>
						<!--/span-->
					</div>
					<!--/row-->
				</div>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-offset-3 col-md-9">
								<a href="bien-activo/edit/{{$bienactivo->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a>
							</div>
						</div>
						<div class="col-md-6">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>