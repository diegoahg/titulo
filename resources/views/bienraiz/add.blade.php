@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Bien Raiz
	    <small>Panel de Control de Bienes Raices</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Inventario</li>
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
														<option value="{{$centrocosto->id}}">{{$centrocosto->nombre}}</option> 
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
														<option value="{{$sector->id}}">{{$sector->nombre}}</option> 
													@endforeach
												</select>
											</div>
										</div>
								</div>
								<h3 class="form-section">Datos de Bien Raiz</h3>
								<div class="row">							
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Descripción. (*)</label>
											<input type="text" id="descripcion" required name="descripcion" class="form-control"  value="">
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Valor Inicial. (*)</label>
											<input type="text" id="valor_inicial" required name="valor_inicial" class="form-control"  value="">
										</div>
									</div>																
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Avaluo Fiscal. (*)</label>
											<input type="text" id="avaluo_fiscal" required name="avaluo_fiscal" class="form-control"  value="">
										</div>
									</div>																
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Numero de ROL. (*)</label>
											<input type="text" id="num_rol" required name="num_rol" class="form-control"  value="">
										</div>
									</div>	
								</div>
								<div class="row">										
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Valor Total. (*)</label>
											<input type="text" id="valor_total" required name="valor_total" class="form-control"  value="">
										</div>
									</div>											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Cuenta Contable. (*)</label>
											<input type="text" id="cuenta_contable" required name="cuenta_contable" class="form-control"  value="">
										</div>
									</div>											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Numero Alta. (*)</label>
											<input type="text" id="num_alta" required name="num_alta" class="form-control"  value="">
										</div>
									</div>											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Oden Compra. (*)</label>
											<input type="text" id="orden_compra" required name="orden_compra" class="form-control"  value="">
										</div>
									</div>	
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</div>
								<div class="row">
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
											<label class="control-label">Tipo Bien (*)</label>
											<select id="centro" required name="tipo_bien" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="Edificio">Edificio</option>
												<option value="Terreno">Terreno</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo Inventario (*)</label>
											<select id="centro" required name="tipo_inventario" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="Regular">Regular</option>
												<option value="Leasing">Leasing</option>
												<option value="Arriendo">Arriendo</option>
												<option value="Comodato">Comodato</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">¿Dispone de mejoras capitalizables? (*)</label>
											<select id="mejora" required name="mejora" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="Si">Si</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
					                      <label>Observación</label>
					                      <textarea class="form-control" rows="3" id="observacion" name="observacion" placeholder="Ingrese una observación ..."></textarea>
					                    </div>
									</div>
								</div>
							</div>

        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../bien-raiz"class="btn btn-default">Cancelar</a>
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

	        @if(old('centro'))
	         $("#centro").select2("val","{{old('centro')}}");
	         $("#oficina").select2("val","{{old('oficina')}}");
	         $("#valor_inicial").val("{{old('valor_inicial')}}");
	         $("#avaluo_fiscal").val("{{old('avaluo_fiscal')}}");
	         $("#num_rol").val("{{old('num_rol')}}");
	         $("#valor_total").val("{{old('valor_total')}}");
	         $("#num_alta").val("{{old('num_alta')}}");
	         $("#orden_compra").val("{{old('orden_compra')}}");
	         $("#fecha").val("{{old('fecha')}}");
	         $("#cuenta_contable").val("{{old('cuenta_contable')}}");
	         $("#tipo_inventario").select2("val","{{old('tipo_inventario')}}");
	         $("#tipo_bien").select2("val","{{old('tipo_bien')}}");
	         $("#mejora").select2("val","{{old('mejora')}}");
	         $("#observacion").html("{{old('observacion')}}");
	         $("#descripcion").val("{{old('descripcion')}}");
	        @endif

	        //Initialize Select2 Elements
	        $(".select2").select2();//Datemask dd/mm/yyyy
	        $("#fecha").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

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
			});

			$("#inventario").addClass("active");
	        $("#bien-raiz").addClass("active");
	      });


	    </script> 
	@stop     
@stop