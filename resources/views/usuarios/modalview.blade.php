<div id="modalVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Información del Usuario</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<table class="table table-bordered table-hover table-responsive">
							<tbody>
								<tr>
									<td width="15%">Nombre:</td>
									<td width="35%"> {{$user->name}} {{$user->apellido_paterno}} {{$user->apellido_materno}}</td>
									<td width="15%">Email:</td>
									<td width="35%">{{$user->email}}</td>
								</tr>
								<tr>
								</tr>
								<tr>
									<td>Teléfono Fijo:</td>
									<td>{{$user->fono}}</td>
									<td>Teléfono Móvil:</td>
									<td>{{$user->movil}}</td>
								</tr>
								<tr>
								</tr>
								<tr>
									<td>Departamento:</td>
									<td>{{$user->departamento}}</td>
									<td>Cargo:</td>
									<td>{{$user->cargo}}</td>
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
								<a href="usuarios/edit/{{$user->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a>
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