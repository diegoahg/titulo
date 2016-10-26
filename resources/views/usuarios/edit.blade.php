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
					<form action="edit" method="post" class="horizontal-form">
						<div class="box-body">
							<div class="form-body">
								@if ($errors->has())
									<div class="note note-danger">
										<h4 class="block">Debe Completar los siguientes campos:</h4>
										<ul>
								            @foreach ($errors->all() as $error)
								                <li>{{ $error }}</li>
								            @endforeach
								        </ul>
									</div>
								@endif
								<h3 class="form-section">Editar usuarios</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Nombre (*)</label>
											<input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" placeholder="Ej: Pedro" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Apellido Paterno (*)</label>
											<input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="{{ $user->apellido_paterno }}" placeholder="Apellido Paterno del Usuario" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Apellido Materno (*)</label>
											<input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="{{ $user->apellido_materno }}" placeholder="Apellido Materno del Usuario" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Correo (*)</label>
											<input type="email" id="correo" name="correo" class="form-control"  value="{{ $user->email }}" placeholder="Ej: ejemplo@" required>
										</div>
									</div>
								</div>
								<div class="row">
								<!--
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Contraseña (*)</label>
											<input type="password" id="password" name="password" class="form-control" value="{{ $user->password }}" placeholder="Contraseña" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Repetir Contraseña. (*)</label>
											<input type="password" id="password_confirmation " name="password_confirmation" value="{{ $user->password }}" class="form-control" placeholder="Repite la Contraseña" required>
										</div>
									</div>
									-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Teléfono Fijo (*)</label>
											<input type="text" id="fono" name="fono" class="form-control" value="{{ $user->fono }}" placeholder="Ej: 287654321" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Teléfono Móvil</label>
											<input type="text" id="movil" name="movil" class="form-control" value="{{ $user->movil }}" placeholder="Ej: 987654321">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Centro de Costo (*)</label>
											<select id="centro" name="centro" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="">Elegir Centro de Costo</option> 
												@foreach($centrocostos as $centrocosto)
													<option value="{{$centrocosto->id}}">{{$centrocosto->nombre}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Sector (*)</label>
											<select id="oficina" name="oficina" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Oficina">
												<option value="">Elegir Oficina</option> 
												@foreach($sectors as $sector)
													<option value="{{$sector->id}}">{{$sector->nombre}}</option> 
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<!--/row-->
								<div class="row">
									<!--<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Departamento</label>
											<input type="text" id="departamento" name="departamento" class="form-control" placeholder="Ej: Finanzas"  value="{{ $user->departamento }}" >
										</div>
									</div>-->
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Permiso. (*)</label>
											<select id="permiso" name="permiso" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Permisos">
												@if($user->permisos == 1)
													<option value="1" selected>ADMINISTRADOR</option>
													<option value="2">ENCARGADO DE INVENTARIO</option>
													<option value="3">DIRECTOR DE UNIDAD</option> 
													<option value="4">COLBORADOR</option> 
													<option value="5">FUNCIONARIO</option>
												@endif
												@if($user->permisos == 2)
													<option value="2" selected>ENCARGADO DE INVENTARIO</option>
													<option value="3">DIRECTOR DE UNIDAD</option> 
													<option value="4">COLBORADOR</option> 
													<option value="5">FUNCIONARIO</option>
												@endif
												@if($user->permisos == 3)
													<option value="2">ENCARGADO DE INVENTARIO</option>
													<option value="3" selected>DIRECTOR DE UNIDAD</option> 
													<option value="4">COLBORADOR</option> 
													<option value="5">FUNCIONARIO</option>
												@endif
												@if($user->permisos == 4)
													<option value="2">ENCARGADO DE INVENTARIO</option>
													<option value="3">DIRECTOR DE UNIDAD</option> 
													<option value="4" selected>COLBORADOR</option> 
													<option value="5">FUNCIONARIO</option>
												@endif
												@if($user->permisos == 5)
													<option value="2">ENCARGADO DE INVENTARIO</option>
													<option value="3">DIRECTOR DE UNIDAD</option> 
													<option value="4">COLBORADOR</option> 
													<option value="5" selected>FUNCIONARIO</option>
												@endif			
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Estado. (*)</label>
											<select id="estado" name="estado" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Estado">
												@if($user->activo == 1)
													<option value="1" selected>ACTIVO</option> 
													<option value="0">INACTIVO</option> 
												@else
													<option value="1">ACTIVO</option> 
													<option value="0" selected>INACTIVO</option> 
												@endif
											</select>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Cargo. (*)</label>
											<input type="text" id="cargo" name="cargo" class="form-control" value="{{$user->cargo }}" placeholder="Ej: Gerencia" required>
										</div>
									</div>
								</div>

								<!--/row-->
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_id" value="{{ $user->id }}">
							</div>
						</div>
						<div class="box-footer">
							<a href="{{asset('/usuarios')}}"class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info  pull-right"><i class="fa fa-check"></i> Guardar</button>
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

		//Evento que rellena el select cuando se escoge un elemento
		$('#centro').change(function() {
			$('#oficina').prop("disabled", false);
			var sectors = {!!$sectors!!};

			$('#oficina').empty();
			$('#oficina').append('<option value="">Elegir Sector</option>');
			$('#oficina').select2('val',"");
			$.each(sectors, function(index, value) {
				if (value.id_centro_costo == $('#centro').val()) {
					$('#oficina').append('<option value="' + value.id + '">' + value.nombre + '</option>');
				}
			});

			if ($('#centro').val() == '') {
				$('#oficina').prop("disabled", true);
			}

		});

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

	        $(".select2").select2();

	        $('#centro').select2('val',"{{$user->centro}}");
			$('#oficina').select2('val',"{{$user->sector}}");
	      });

	      $("#usuarios").addClass( "active" );
	    </script> 
	@stop      
@stop