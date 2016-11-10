@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Bien Licencia de Software
	    <small>Panel de Control de Inventario</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Bien Licencia de Software</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
           	<div class="col-xs-12">
				<div class="box">
	                <div class="box-header">
	                  <h3 class="box-title">Registro de Ingresos</h3>
	                </div><!-- /.box-header -->
	                <form action="add" method="post" enctype="multipart/form-data" class="horizontal-form">
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
														<option value="{{$centrocosto->id}}">{{$centrocosto->codigo}} {{$centrocosto->nombre}}</option> 
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Oficina (*)</label>
												<select id="oficina" disabled name="oficina" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Oficina">
													<option value="">Elegir Oficina</option> 
													@foreach($sectors as $sector)
														<option value="{{$sector->id}}">{{$centrocosto->codigo}} {{$sector->nombre}}</option> 
													@endforeach
												</select>
											</div>
										</div>
								</div>
								<h3 class="form-section">Datos de Bienes</h3>
								<div class="row">
									<!--<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Categoria (*)</label>
											<select id="categoria" name="categoria" required class="form-control select2" style="width: 100%;" data-placeholder="Elegir Categoria">
												<option value="">Elegir Categoria</option> 
												@foreach($categorias as $categoria)
													<option value="{{$categoria->id}}">{{$categoria->codigo}}-{{$categoria->categoria}}</option>
												@endforeach
											</select>
										</div>
									</div>-->
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Numero. (*)</label>
											<input type="text" id="numero" required name="numero" class="form-control"  value="{{ old('numero') }}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Descripción del Bien. (*)</label>
											<div id="bienes">
												<input type="text" id="descripcion" required name="descripcion" class="typeahead form-control"  value="{{ old('descripcion') }}">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Valor Unitario. (*)</label>
											<input type="text" id="valor" name="valor" required class="form-control"  value="{{ old('valor') }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Unidad. (*)</label>
											<input type="text" id="unidad" name="unidad" required class="form-control"  value="{{ old('valor') }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Marca. (*)</label>
											<input type="text" id="marca" name="marca" required class="form-control"  value="{{ old('marca') }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Modelo. (*)</label>
											<input type="text" id="modelo" name="modelo" class="form-control" required value="{{ old('modelo') }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">N° Serie. (*)</label>
											<input type="text" id="serie" name="serie" class="form-control"  required value="{{ old('serie') }}">
										</div>
									</div>
									<!--<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Largo. (*)</label>
											<input type="text" id="largo" name="largo" class="form-control" required value="{{ old('largo') }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Ancho. (*)</label>
											<input type="text" id="ancho" name="ancho" class="form-control"  required value="{{ old('ancho') }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Alto. (*)</label>
											<input type="text" id="alto" name="alto" class="form-control" required  value="{{ old('alto') }}">
										</div>
									</div>-->
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</div>
								<h3 class="form-section">Datos de Adquisición</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Orden. (*)</label>
											<input type="text" id="orden" name="orden" class="form-control" required value="{{ old('orden') }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
						                    <label>Fecha de Incorporación:</label>
						                    <div class="input-group">
						                      	<div class="input-group-addon">
						                        	<i class="fa fa-calendar"></i>
						                      	</div>
						                      	<input type="text"  id="fecha" name="fecha" class="form-control" required data-inputmask="'alias': 'dd/mm/aaaa'" data-mask="">
						                    </div><!-- /.input group -->
					                  	</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Cuenta Contable. (*)</label>
											<input type="text" id="cuenta_contable" name="cuenta_contable" required class="form-control"  value="{{ old('cuenta_contable') }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Número Alta. (*)</label>
											<input type="text" id="alta" name="alta" class="form-control" required value="{{ old('alta') }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Vida Util. (*)</label>
											<input type="text" id="vida_util" name="vida_util" class="form-control" required value="{{ old('vida_util') }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo Inventario (*)</label>
											<select id="centro" required name="tipo_inventario" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="Regular">Regular</option>
												<option value="Leasing">Leasing</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo Bien (*)</label>
											<select id="centro" required name="tipo_bien" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="Simple">Simple</option>
												<option value="Complejo">Complejo</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Enmienda el Bien Activo(*)</label>
											<select id="centro" required name="enmienda" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="SI">SI</option>
												<option value="NO">NO</option>
											</select>
										</div>
									</div>
								</div>	
							</div>

        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../bien-licencia"class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Guardar</button>
						</div>
					</form>
              	</div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--<form action="descripcion" method="post">
<input type="submit" value="Envar">
</form>-->
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
					$('#oficina').append('<option value="' + value.id + '">' + value.codigo + ' ' + value.nombre + '</option>');
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
	        $("#bien-licencia").addClass("active");

	        //Codigo parra TYPEAHEAD
			var substringMatcher = function(strs) {
			  return function findMatches(q, cb) {
			    var matches, substringRegex;

			    // an array that will be populated with substring matches
			    matches = [];

			    // regex used to determine if a string contains the substring `q`
			    substrRegex = new RegExp(q, 'i');

			    // iterate through the pool of strings and for any string that
			    // contains the substring `q`, add it to the `matches` array
			    $.each(strs, function(i, str) {
			      if (substrRegex.test(str)) {
			        matches.push(str);
			      }
			    });

			    cb(matches);
			  };
			};

			var bienes = {!!$json!!}

			$('#bienes .typeahead').typeahead({
			  hint: true,
			  highlight: true,
			  minLength: 1
			},
			{
			  name: 'bienes',
			  source: substringMatcher(bienes)
			});

			$('#bienes .typeahead').on('typeahead:selected', function(evt, item) {
			   $.ajax({
                data:  "descripcion=" + item + "&_token=" + "{{csrf_token()}}",
                url:   'descripcion',
                type:  'post',
                success:  function (response) {
                		$("#valor").val(response.valor);  
                		$("#unidad").val(response.unidad);   
                		$("#marca").val(response.marca);   
                		$("#modelo").val(response.modelo);  
                		$("#serie").val(response.serie);   
                		$("#largo").val(response.largo);   
                		$("#ancho").val(response.ancho);   
                		$("#alto").val(response.alto);           
                    }
			        });
			})






	      });


	    </script> 
	@stop     
@stop