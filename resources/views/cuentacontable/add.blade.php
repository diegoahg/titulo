@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Cuenta Contable
	    <small>Panel de Control de  Cuenta Contable</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active"> Cuenta Contable</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<div class="row">
       	<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Agregar Cuenta Contable</h3>
                </div><!-- /.box-header -->
	                <!-- BEGIN FORM-->
					<form action="add" method="post" class="horizontal-form">
        				<div class="box-body">
							<div class="form-body">
								@if ($errors->has())
									<div class="callout callout-danger">
										<h4 class="block">Debe Completar los siguientes campos:</h4>
										<ul>
								            @foreach ($errors->all() as $error)
								                <li>{{ $error }}</li>
								            @endforeach
								        </ul>
									</div>
								@endif
								<h3 class="form-section">Agregar Centro de Costos</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label"> Codigo (*)</label>
											<input type="text" id="codigo" name="codigo" class="form-control" value="{{ old('codigo') }}" placeholder="Ej: 01.01.01" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label"> Nombre (*)</label>
											<input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Departamento de Informática" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label"> Vida Útil (*)</label>
											<input type="text" id="vida_util" name="vida_util" class="form-control" value="{{ old('vida_util') }}" placeholder="Ej: 5" required>
										</div>
									</div>
								</div>
								<!--/row-->
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</div>
        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../cuentacontable"class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Guardar</button>
						</div>
					</form>
					<!-- END FORM-->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
     @section('script')
		<script>
	      $(document).ready(function() {
				$("#cuentacontable").addClass( "active" );
			});
	    </script> 
	@stop    
@stop