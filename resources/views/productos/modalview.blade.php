<div id="modalVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog modal-wide">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Información del Producto</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td rowspan="6" width="60%"><img src="productos/product-image/{{$producto->imagen}}" width="100%" heigth="100%"/></td>
									<th width="20%">Código: </th>
									<td width="20%"> {{$producto->codigo}}</td>
								</tr>

								<tr>
									<th>Nombre:</th>
									<td>{{$producto->nombre}}</td>
								</tr>
								<tr>
									<th>Descripción:</th>
									<td>{{$producto->descripcion}}</td>
								</tr>
								<tr>
									<th>Precio:</th>
									<td>${{number_format($producto->precio, 0, '', '.')}}</td>
								</tr>
								<tr>
									<th>Categoría:</th>
									<td>{{$producto->categoria}}</td>
								</tr>
								<tr>
									<th>Marca:</th>
									<td>{{$producto->marca}}</td>
								</tr>
								<tr>
									<td rowspan="6"><strong>Descripcion:</strong> {{$producto->descripcion}}</td>
									<th>Modelo:</th>
									<td>{{$producto->modelo}}</td>
								</tr>
								<tr>
									<th>Serie:</th>
									<td>{{$producto->serie}}</td>
								</tr>
								<tr>
									<th>Peso:</th>
									<td>{{$producto->peso}}</td>
								</tr>
								<tr>
									<th>Alto:</th>
									<td>{{$producto->alto}}</td>
								</tr>
								<tr>
									<th>Ancho:</th>
									<td>{{$producto->ancho}}</td>
								</tr>
								<tr>
									<th>Largo:</th>
									<td>{{$producto->largo}}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!--/row-->
					 
				</div>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-offset-3 col-md-9">
								<a href="productos/edit/{{$producto->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a>
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