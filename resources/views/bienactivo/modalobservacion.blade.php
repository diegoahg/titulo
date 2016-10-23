<div id="modalObservacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Observaciones</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">	
				<form method="post" action="/bien-activo/observacion">
						<div class="form-group">
		                  <label>Observación</label>
		                  <textarea class="form-control" rows="2" name="observacion" placeholder="Ingresar Observación"></textarea>
		                </div>
		                <input type="hidden" name="tipo_bien" value="{{$tipo}}">
		                <input type="hidden" name="id_bien" value="{{$id}}">
		                <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                <button type="submit" class="btn btn-primary">Guardar</button>
					</form>
					</div><br>
					<div class="row">
						<table class="table table-bordered table-hover table-responsive">
							<thead>
								<td width="80%">Observación</td>
								<td width="20%">Fecha</td>
							</thead>
							<tbody>
								@foreach($observaciones as $observacion)
									<tr>
										<td>{{$observacion->observacion}}</td>
										<td>{{$observacion->created_at}}</td>
									</trthead>
								@endforeach
							</tbody>
						</table>
					</div>
					<!--/row-->
				</div>
			</div>
		</div>
	</div>
</div>