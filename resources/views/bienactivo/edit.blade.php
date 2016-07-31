@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Bien-Activo
	    <small>Panel de Control de Inventario</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Bien-Activo</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
           	<div class="col-xs-12">
				<div class="box">
	                <div class="box-header">
	                  <h3 class="box-title">Editar Bienes</h3>
	                </div><!-- /.box-header -->
	                <form action="edit" method="post" enctype="multipart/form-data" class="horizontal-form">
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
								<h3 class="form-section">Datos de Lugar</h3>
								<div class="row">
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
												<select id="oficina" disabled name="oficina" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Oficina">
													<option value="">Elegir Oficina</option> 
													@foreach($sectors as $sector)
														<option value="{{$sector->id}}">{{$sector->nombre}}</option> 
													@endforeach
												</select>
											</div>
										</div>
								</div>
								<h3 class="form-section">Datos de Bienes</h3>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Categoria (*)</label>
											<select id="categoria" name="categoria" required class="form-control select2" style="width: 100%;" data-placeholder="Elegir Categoria">
												<option value="">Elegir Categoria</option> 
												@foreach($categorias as $categoria)
													<option value="{{$categoria->id}}">{{$categoria->codigo}}-{{$categoria->categoria}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Numero. (*)</label>
											<input type="text" id="numero" required name="numero" class="form-control"  value="{{ $bienactivo->numero }}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Descripción del Bien. (*)</label>
											<input type="text" id="descripcion" required name="descripcion" class="form-control"  value="{{ $bienactivo->descripcion }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Valor Unitario. (*)</label>
											<input type="text" id="valor" name="valor" required class="form-control"  value="{{ $bienactivo->valor}}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Unidad. (*)</label>
											<input type="text" id="unidad" name="unidad" required class="form-control"  value="{{ $bienactivo->unidad }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Marca. (*)</label>
											<input type="text" id="marca" name="marca" required class="form-control"  value="{{ $bienactivo->marca }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Modelo. (*)</label>
											<input type="text" id="modelo" name="modelo" class="form-control" required value="{{ $bienactivo->modelo}}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">N° Serie. (*)</label>
											<input type="text" id="serie" name="serie" class="form-control"  required value="{{ $bienactivo->serie }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Largo. (*)</label>
											<input type="text" id="largo" name="largo" class="form-control" required value="{{ $bienactivo->largo }}">

										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Ancho. (*)</label>
											<input type="text" id="ancho" name="ancho" class="form-control"  required value="{{ $bienactivo->ancho }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Alto. (*)</label>
											<input type="text" id="alto" name="alto" class="form-control" required  value="{{ $bienactivo->alto }}">
										</div>
									</div>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="_key" value="{{ Crypt::encrypt($bienactivo->id) }}">

								</div>
								<h3 class="form-section">Datos de Adquisición</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Orden. (*)</label>
											<input type="text" id="orden" name="orden" class="form-control" required value="{{ $bienactivo->orden }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
						                    <label>Fecha de Incorporación:</label>
						                    <div class="input-group">
						                      	<div class="input-group-addon">
						                        	<i class="fa fa-calendar"></i>
						                      	</div>
						                      	<input type="text"  id="fecha" name="fecha" class="form-control" required data-inputmask="'alias': 'dd/mm/aaaa'" value="{{$bienactivo->fecha}}" data-mask="">
						                    </div><!-- /.input group -->
					                  	</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Cuenta Contable. (*)</label>
											<input type="text" id="cuenta_contable" name="cuenta_contable" required class="form-control"  value="{{ $bienactivo->cuenta_contable }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Número Alta. (*)</label>
											<input type="text" id="alta" name="alta" class="form-control" required value="{{ $bienactivo->alta }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Vida Util. (*)</label>
											<input type="text" id="vida_util" name="vida_util" class="form-control" required value="{{ $bienactivo->vida_util }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo Inventario (*)</label>
											<select required name="tipo_inventario" id="tipo_inventario" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="Regular">Regular</option>
												<option value="Leasing">Leasing</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo Bien (*)</label>
											<select required name="tipo_bien" id="tipo_bien" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="Simple">Simple</option>
												<option value="Complejo">Complejo</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Enmienda el Bien Activo(*)</label>
											<select required name="enmienda" id="enmienda" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="SI">SI</option>
												<option value="NO">NO</option>
											</select>
										</div>
									</div>
								</div>	
							</div>
        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../../bien-activo"class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Guardar</button>
						</div>
					</form>
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

	        //Initialize Select2 Elements
	        $(".select2").select2();//Datemask dd/mm/yyyy
	        $("#fecha").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

	        $("#inventario").addClass("active");
	        $("#bien-activo").addClass("active");


			$('#centro').select2('val',"{{$bienactivo->id_centro}}");
			$('#oficina').select2('val',"{{$bienactivo->id_sector}}");
			$('#categoria').select2('val',"{{$bienactivo->categoria}}");
			$('#tipo_inventario').select2('val',"{{$bienactivo->tipo_inventario}}");
			$('#tipo_bien').select2('val',"{{$bienactivo->tipo_bien}}");
			$('#enmienda').select2('val',"{{$bienactivo->enmienda}}");

			@if(old('centro'))
	         $("#centro").select2("val","{{old('centro')}}");
	         $("#oficina").select2("val","{{old('oficina')}}");
	         $("#categoria").select2("val","{{old('categoria')}}");
	         $("#numero").val("{{old('numero')}}");
	         $("#descripcion").val("{{old('descripcion')}}");
	         $("#valor").val("{{old('valor')}}");
	         $("#unidad").val("{{old('unidad')}}");
	         $("#marca").val("{{old('marca')}}");
	         $("#modelo").val("{{old('modelo')}}");
	         $("#serie").val("{{old('serie')}}");
	         $("#largo").val("{{old('largo')}}");
	         $("#ancho").val("{{old('ancho')}}");
	         $("#alto").val("{{old('alto')}}");
	         $("#orden").val("{{old('orden')}}");
	         $("#fecha").val("{{old('fecha')}}");
	         $("#cuenta_contable").val("{{old('cuenta_contable')}}");
	         $("#alta").val("{{old('alta')}}");
	         $("#vida_util").val("{{old('vida_util')}}");
	         $("#tipo_inventario").select2("val","{{old('tipo_inventario')}}");
	         $("#tipo_bien").select2("val","{{old('tipo_bien')}}");
	         $("#enmienda").select2("val","{{old('enmienda')}}");
	        @endif
			
			$("#inventario").addClass( "active" );

	      });

	    </script> 
	@stop     
@stop