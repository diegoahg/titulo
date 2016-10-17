@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Usuarios
	    <small>Panel de Control de Usuarios</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    <li class="active">Usuarios</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<div class="row">
       	<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Agregar Usuarios</h3>
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
								<h3 class="form-section">Agregar usuarios</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Nombre (*)</label>
											<input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ej: Pedro" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Apellido Paterno (*)</label>
											<input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno') }}" placeholder="Apellido Paterno del Usuario" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Apellido Materno (*)</label>
											<input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}" placeholder="Apellido Materno del Usuario" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Correo (*)</label>
											<input type="email" id="correo" name="correo" class="form-control"  value="{{ old('correo') }}" placeholder="Ej: ejemplo@" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Contraseña (*)</label>
											<input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Contraseña" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Repetir Contraseña. (*)</label>
											<input type="password" id="password_confirmation " name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Repite la Contraseña" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Teléfono Fijo (*)</label>
											<input type="text" id="fono" name="fono" class="form-control" value="{{ old('fono') }}" placeholder="Ej: 287654321" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Teléfono Móvil</label>
											<input type="text" id="movil" name="movil" class="form-control" value="{{ old('movil') }}" placeholder="Ej: 987654321">
										</div>
									</div>
								</div>
								<!--/row-->
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Departamento</label>
											<input type="text" id="departamento" name="departamento" class="form-control" placeholder="Ej: Finanzas"  value="{{ old('departamento') }}" >
										</div>
									</div>
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Cargo. (*)</label>
											<input type="text" id="cargo" name="cargo" class="form-control" value="{{ old('cargo') }}" placeholder="Ej: Gerencia" required>
										</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</div>
        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../usuarios"class="btn btn-default">Cancelar</a>
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
	      $(function () {
	        $("#example1").DataTable();
	        $('#example2').DataTable({
	          "paging": true,
	          "lengthChange": false,
	          "searching": false,
	          "ordering": true,
	          "info": true,
	          "autoWidth": false
	        });
	      });

		$("#usuarios").addClass( "active" );
	    </script> 
	@stop      
@stop