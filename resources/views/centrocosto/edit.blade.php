@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Centro de Costos
	    <small>Panel de Centro de Costos</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Centro de Costos</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<div class="row">
       	<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Editar Centro de Costos</h3>
                </div><!-- /.box-header -->
	                <!-- BEGIN FORM-->
					<form action="../edit" method="post" class="horizontal-form">
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
								<h3 class="form-section">Editar Centro de Costos</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label"> Nombre (*)</label>
											<input type="text" id="nombre" name="nombre" class="form-control" value="{{ $centrocosto->nombre }}" placeholder="Ej: Departamento de Informatica" required>
										</div>
									</div>
								</div>
								<!--/row-->
								<input type="hidden" name="_id" value="{{ $centrocosto->id }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</div>
        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../../centrocosto"class="btn btn-default">Cancelar</a>
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
				$("#centrocosto").addClass( "active" );
			});
	    </script> 
	@stop    
@stop