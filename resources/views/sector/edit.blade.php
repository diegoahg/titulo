@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Sector
	    <small>Panel de Control de Sector</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Sector</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<div class="row">
       	<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Editar Sector</h3>
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
								<h3 class="form-section">Editar Sector</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label"> Código (*)</label>
											<input type="text" id="codigo" name="codigo" class="form-control" value="{{ $sector->codigo }}" placeholder="Ej: Departamento de Informatica" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label"> Nombre (*)</label>
											<input type="text" id="nombre" name="nombre" class="form-control" value="{{ $sector->nombre }}" placeholder="Ej: Laboratorio 1" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Centro de Costo (*)</label>
											<select id="centro" name="centro" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="">Elegir Centro de Costo</option> 
												@foreach($centrocostos as $centrocosto)
													@if($centrocosto->id == $sector->id_centro_costo)
														<option value="{{$centrocosto->id}}" selected>{{$centrocosto->nombre}}</option> 
													@else
														<option value="{{$centrocosto->id}}">{{$centrocosto->nombre}}</option>
													@endif
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label"> Descripción (*)</label>
											<input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ $sector->descripcion }}" placeholder="Ej: Descripción" required>
										</div>
									</div>

								</div>
								<!--/row-->
								<input type="hidden" name="_id" value="{{ $sector->id }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</div>
        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../../sector"class="btn btn-default">Cancelar</a>
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
				$("#sector").addClass( "active" );
			});
	    </script> 
	@stop        
@stop