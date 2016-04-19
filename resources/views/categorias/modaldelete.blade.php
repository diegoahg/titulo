<div id="modalEliminar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Advertencia</h4>
			</div>
			<div class="modal-body">
				<p>
					 ¿Esta seguro que desea borrar este dato para siempre?
				</p>
			</div>
			<form action="categorias/delete" method="post">
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
				<button type="submit"  class="btn btn-info btn-borrar">Confirmar</a>

			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_id" value="{{ $categoria->id }}">
			</form>
		</div>
	</div>
</div>