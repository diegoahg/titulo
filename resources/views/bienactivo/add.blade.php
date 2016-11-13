@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Bien Activos
	    <small>Panel de Control de Inventario</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Bien Activos</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
           	<div class="col-xs-12">
				<div class="box">
	                <div class="box-header">
	                  <h3 class="box-title">Registro de Bien Activos</h3>
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
														<option value="{{$sector->id}}">{{$sector->codigo}}  {{$sector->nombre}}</option> 
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
											<input type="text" id="numero" required name="numero" class="form-control"  value="">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Descripción del Bien. (*)</label>
											<div id="bienes">
												<input type="text" id="descripcion" required name="descripcion" class="typeahead form-control"  value="">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Valor Unitario. (*)</label>
											<input type="text" id="valor" name="valor" required class="form-control"  value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Unidad. (*)</label>
											<input type="text" id="unidad" name="unidad" required class="form-control"  value="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Marca. (*)</label>
											<input type="text" id="marca" name="marca" required class="form-control"  value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Modelo. (*)</label>
											<input type="text" id="modelo" name="modelo" class="form-control" required value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">N° Serie. (*)</label>
											<input type="text" id="serie" name="serie" class="form-control"  required value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Largo(m). (*)</label>
											<input type="text" id="largo" name="largo" class="form-control" required value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Ancho(m). (*)</label>
											<input type="text" id="ancho" name="ancho" class="form-control"  required value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Alto(m). (*)</label>
											<input type="text" id="alto" name="alto" class="form-control" required  value="">
										</div>
									</div>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</div>
								<h3 class="form-section">Datos de Adquisición</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Orden. (*)</label>
											<input type="text" id="orden" name="orden" class="form-control" required value="">
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
											<select id="cuenta_contable" required name="cuenta_contable" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
													@foreach($cuentacontables as $cuentacontable)
														<option value="{{$cuentacontable->id}}">{{$cuentacontable->nombre}}</option> 
													@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Número Alta. (*)</label>
											<input type="text" id="alta" name="alta" class="form-control" required value="">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Vida Util (años). (*)</label>
											<input type="text" id="vida_util" name="vida_util" class="form-control" required value="10">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo Inventario (*)</label>
											<select id="tipo_inventario" required name="tipo_inventario" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="REGULAR">REGULAR</option>
												<option value="LEASING">LEASING</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo Bien (*)</label>
											<select id="tipo_bien" required name="tipo_bien" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="SIMPLE">SIMPLE</option>
												<option value="COMPLEJO">COMPLEJO</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Enmienda el Bien Activo(*)</label>
											<select id="enmienda" required name="enmienda" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
												<option value="SI">SI</option>
												<option value="NO">NO</option>
											</select>
										</div>
									</div>
								</div>	
							</div>

        				</div><!-- /.box-body -->

        				<div class="box-body" id="div_componente" style="display:none;font-size:11px">
							<h3 class="form-section">Componentes Equipos Computacionales</h3>
	        				<div class="row">
	        					<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Categoria (*)</label>
										<select id="add_categoria" name="add_categoria" class="form-control select2" style="width: 100%;" data-placeholder="Elegir Categoria">
											<option value="">Elegir Categoria</option> 
											@foreach($categorias as $categoria)
												<option value="{{$categoria->id}}">{{$categoria->codigo}}-{{$categoria->categoria}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">Número(*)</label>
										<input type="text" id="add_codigo" name="add_codigo" class="form-control" value="">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">Descripción(*)</label>
										<input type="text" id="add_descripcion" name="add_descripcion" class="form-control" value="">
									</div>
								</div>
								<div class="col-md-3">
								</div>
							</div>
						 	<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Nro Serie(*)</label>
										<input type="text" id="add_serie" name="add_serie" class="form-control" value="">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Marca(*)</label>
										<input type="text" id="add_marca" name="add_marca" class="form-control" value="">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Modelo(*)</label>
										<input type="text" id="add_modelo" name="add_modelo" class="form-control" value="">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tipo Componentes(*)</label>
										<input type="text" id="add_tipo" name="add_tipo" class="form-control" value="">
									</div>
								</div>

								<div class="col-md-1">
								</div>
								<div class="col-md-3">
									<label class="control-label">&nbsp</label>
									<button class="btn btn-block btn-info" type="button" onclick="AgregarLinea()">Agregar Componenete<i class="fa fa-plus-circle"></i></button>
								</div>
	        					<table id="" class="table table-bordered">
				                    <thead>
				                      <tr>
				                        <th width="2%"></th>
				                        <th width="8%">Código</th>
				                        <th width="15%">Descripcion</th>
				                        <th width="10%">N° de Serie</th>
				                        <th width="12%">Marca</th>
				                        <th width="12%">Modelo</th>
				                        <th width="15%">Tipo Componente</th>
				                      </tr>
				                    </thead>
				                    <tbody id="componentes">
				                    </tbody>
				                </table>
	        				</div>
	        			</div>
						<div class="box-footer">
							<a href="../bien-activo"class="btn btn-default">Cancelar</a>
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
					$('#oficina').append('<option value="' + value.id + '">' + value.codigo + " " + value.nombre + '</option>');
				}
			});

			if ($('#centro').val() == '') {
				$('#oficina').prop("disabled", true);
			}

		});

		//Evento que rellena el select cuando se escoge un elemento
		$('#tipo_bien').change(function() {
			var tipo_bien = $("#tipo_bien").val();
			console.log(tipo_bien);
			if(tipo_bien == "SIMPLE"){
				$('#div_componente').hide();
			}
			if(tipo_bien == "COMPLEJO"){
				$('#div_componente').show();
			}

		});

		$('#cuenta_contable').change(function() {
			var id_cuenta_contable = $("#cuenta_contable").val();
			$.ajax({
                data:  "id_cuenta_contable=" + id_cuenta_contable + "&_token=" + "{{csrf_token()}}",
                url:   'cuentacontable',
                type:  'post',
                success:  function (response) { 
                		$("#vida_util").val(response.vida_util);  
                    }
			});

		});

		


	      var cont = 0;



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
	        $(".select2").select2();
	        $("#fecha").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});//Datemask dd/mm/yyyy

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

	        $("#inventario").addClass("active");
	        $("#bien-activo").addClass("active");

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

			var bienes = {!!$json!!};

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

                		$("#orden").val(response.orden);    
                		$("#fecha").val(response.fecha);     
                		$("#cuenta_contable").val(response.cuenta_contable);     
                		$("#alta").val(response.alta);   
                		$("#vida_util").val(response.vida_util);  
                		$("#tipo_inventario").select2("val","'" + response.tipo_inventario + "'");
                		$("#enmienda").select2("val",response.enmienda);       

                    }
			        });

			   $.ajax({
                data:  "descripcion=" + item + "&_token=" + "{{csrf_token()}}",
                url:   'componentes',
                type:  'post',
                success:  function (response) {
                		console.log(response.length);
                		if(response.length>0){
							$('#div_componente').show();

							var categorias =  {!!$categorias!!};
							$.each(response,function(key,data){
	                			cont ++;
						      	var add_codigo = data.codigo;
						      	var add_descripcion = data.descripcion;
						      	var add_serie = data.serie;
						      	var add_marca = data.marca;
						      	var add_modelo = data.modelo;
						      	var add_categoria = data.categoria;
						      	var add_tipo = data.tipo;

						      	$.each(categorias, function(index, value) {
									if (value.id == add_categoria) {
										nom_categoria = value.categoria;
										cod_categoria = value.codigo;
									}
								})

						      	var table = "<tr id='tr" + cont + "'>";
						      	table += "<td><a href='javascript:EliminarLinea(" + cont + ");'><i class='fa fa-times'></i></a></td>";
						      	table += "<td>" + cod_categoria + "-" + add_codigo + "<input type='hidden' name='comp_codigo' value='" + add_codigo + "'></td>";
						      	table += "<td>" + add_descripcion + "<input type='hidden' name='comp_descripcion' value='" + add_descripcion + "'></td>";
						      	table += "<td>" + add_serie + "<input type='hidden' name='comp_serie' value='" + add_serie + "'></td>";
						      	table += "<td>" + add_marca + "<input type='hidden' name='comp_marca' value='" + add_marca + "'></td>";
						      	table += "<td>" + add_modelo + "<input type='hidden' name='comp_modelo' value='" + add_modelo + "'></td>";
						      	table += "<input type='hidden' name='comp_categoria' value='" + add_categoria + "'>";
						      	table += "<td>" + add_tipo + "<input type='hidden' name='comp_tipo' value='" + add_tipo + "'></td>";
						      	table += "</tr>";

						      	$("#componentes").append(table);
	                		}); 
                		}
                		else{
							$('#div_componente').hide();
                		}
                    }
			        });

			})


	      });

	      function AgregarLinea(){
	      	cont ++;
	      	var add_codigo = $("#add_codigo").val();
	      	var add_descripcion = $("#add_descripcion").val();
	      	var add_serie = $("#add_serie").val();
	      	var add_marca = $("#add_marca").val();
	      	var add_modelo = $("#add_modelo").val();
	      	var add_categoria = $("#add_categoria").val();
	      	var add_tipo = $("#add_tipo").val();
	      	var nom_categoria;
	      	var cod_categoria;
			var categorias =  {!!$categorias!!};

	      	$.each(categorias, function(index, value) {
				if (value.id == add_categoria) {
					nom_categoria = value.categoria;
					cod_categoria = value.codigo;
				}
			})

	      	var table = "<tr id='tr" + cont + "'>";
	      	table += "<td><a href='javascript:EliminarLinea(" + cont + ");'><i class='fa fa-times'></i></a></td>";
	      	table += "<td>" + cod_categoria.toUpperCase() + "-" + add_codigo + "<input type='hidden' name='comp_codigo' value='" + add_codigo + "'></td>";
	      	table += "<td>" + add_descripcion.toUpperCase() + "<input type='hidden' name='comp_descripcion[]' value='" + add_descripcion + "'></td>";
	      	table += "<td>" + add_serie.toUpperCase() + "<input type='hidden' name='comp_serie[]' value='" + add_serie + "'></td>";
	      	table += "<td>" + add_marca.toUpperCase() + "<input type='hidden' name='comp_marca[]' value='" + add_marca + "'></td>";
	      	table += "<td>" + add_modelo.toUpperCase() + "<input type='hidden' name='comp_modelo[]' value='" + add_modelo + "'></td>";
	      	table += "<input type='hidden' name='comp_categoria[]' value='" + add_categoria + "'>";
	      	table += "<td>" + add_tipo.toUpperCase() + "<input type='hidden' name='comp_tipo[]' value='" + add_tipo + "'></td>";
	      	table += "</tr>";

	      	$("#componentes").append(table);
	      }

	    function EliminarLinea(l) {
                var tr = $('#tr' + l);
                tr.fadeOut(400, function(){
                    tr.remove();
                });
        }


	    </script> 
	@stop     
@stop