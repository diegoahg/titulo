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
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Centro de Costo. (*)</label>
											<select id="centro" name="centro[]" style="width: 100%;" class="form-control selectpicker" required multiple data-actions-box="true" data-placeholder="SELECCIONAR CENTRO DE COSTO" data-live-search="true">
												@foreach($centrocostos as $centrocosto)
													<option value="{{$centrocosto->id}}">{{$centrocosto->nombre}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<!--/span-->
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Sector. (*)</label>
											<select id="oficina" name="oficina[]" style="width: 100%;" class="form-control selectpicker" disabled required multiple data-actions-box="true" data-placeholder="SELECCIONAR CENTRO DE COSTO" data-live-search="true">
												@foreach($sectors as $sector)
													<option value="{{$sector->id}}">{{$sector->nombre}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<!--/span-->
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Permiso. (*)</label>
											<select id="permiso" name="permiso" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Permisos">
													<option value="2">ENCARGADO DE INVENTARIO</option>
													<option value="3">DIRECTOR DE UNIDAD</option> 
													<option value="4">COLABORADOR</option> 
													<option value="5" selected>FUNCIONARIO</option> 
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Estado. (*)</label>
											<select id="estado" name="estado" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Estado">
													<option value="1" selected>ACTIVO</option> 
													<option value="0">INACTIVO</option> 
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Cargo. (*)</label>
											<input type="text" id="cargo" name="cargo" class="form-control" value="{{ old('cargo') }}" placeholder="Ej: Gerencia" required>
										</div>
									</div>

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

			/*$('#centro').change(function() {
				$('#oficina').prop("disabled", false);
				var sectors = {!!$sectors!!};


				$('#oficina').empty();
				$('#oficina').append('<option value="">ELEGIR SECTOR</option>');
				$('#oficina').select2('val','');
				$.each(sectors, function(index, value) {
					if (value.id_centro_costo == $('#centro').val()) {
						$('#oficina').append('<option value="' + value.id + '">' + value.nombre + '</option>');
					}
				});

				if ($('#centro').val() == '') {
					$('#oficina').prop("disabled", true);
				}

			});*/

			$('#centro').on('changed.bs.select', function (e) {
				$('#oficina').prop('disabled', false);
				var sectors = {!!$sectors!!};

				$('#oficina').empty();
				$('#oficina').selectpicker('refresh');

				var centros = $(this).val();

				console.log(centros);
				 
				if(centros != null){
					$.each(centros, function(i, centro) {
						console.log(centro);
						$.each(sectors, function(index, value) {
							if (value.id_centro_costo == centro) {
								$('#oficina').append('<option value="' + value.id + '">' + value.nombre + '</option>');
							}
						});
					  
					});
					$('#oficina').selectpicker('refresh');
				}else{
					$('#oficina').prop('disabled', true);
					$('#oficina').selectpicker('refresh');
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

	      $('.selectpicker').selectpicker({
			  size: 10
			});


			$("#usuarios").addClass( "active" );

			@if(old("centro"))
				$('#oficina').prop('disabled', false);
				$('#oficina').selectpicker('refresh');
				<?php
					$centros = old("centro");
					$selected = "[";
					for($i=0; $i<count($centros); $i++){
						if($i!=0){
							$selected .= ",";
						}
						$selected .= $centros[$i];
					}
					$selected .= "]";
				?>
				$('#centro').selectpicker('val', {{$selected}});
				@if(old("oficina"))
					<?php
						$oficinas = old("oficina");
						$selected = "[";
						for($i=0; $i<count($oficinas); $i++){
							if($i!=0){
								$selected .= ",";
							}
							$selected .= $oficinas[$i];
						}
						$selected .= "]";
					?>
					$('#oficina').selectpicker('val', {{$selected}});
				@endif

			@endif
	      });
	    </script> 

	@stop      
@stop