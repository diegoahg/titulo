@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Bienes de Registro
	    <small>Panel de Control de Inventario</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Bienes de Registro</li>
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
	                <form action="add"  id="form-registros" method="post" enctype="multipart/form-data" class="horizontal-form">
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
								<div id="notificacion">
								</div>
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
												<select id="oficina" disabled name="oficina" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Oficina" onchange="Registros()">
													<option value="">Elegir Oficina</option> 
													@foreach($sectors as $sector)
														<option value="{{$sector->id}}">{{$sector->nombre}}</option> 
													@endforeach
												</select>
											</div>
										</div>
								</div>
								<h3 class="form-section">Bienes de Registros</h3>
									<div class="row" style="font-size:11px">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label">Código. (*)</label>
												<input type="text" id="codigo" name="codigo" class="form-control" value="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Descripcion. (*)</label>
												<input type="text" id="descripcion" name="descripcion" class="form-control" value="">
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label class="control-label">Cant. (*)</label>
												<input type="text" id="cantidad" name="cantidad" class="form-control" value="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label">V. Uni. (*)</label>
												<input type="text" id="valor" name="valor" class="form-control" value="">
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label class="control-label">O. Comp. (*)</label>
												<input type="text" id="orden_compra" name="orden_compra" class="form-control" value="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
							                    <label>Fecha de Incorporación (*)</label>
							                    <div class="input-group">
							                      	<div class="input-group-addon">
							                        	<i class="fa fa-calendar"></i>
							                      	</div>
							                      	<input type="text"  id="fecha" name="fecha" class="form-control" data-inputmask="'alias': 'dd/mm/aaaa'" data-mask="">
							                    </div><!-- /.input group -->
						                  	</div>
										</div>
									</div>							
									<div class="pull-right">
						              	<span><button type="button" class="btn btn-block btn-success"  onclick="Addregistros();"><i class="fa fa-plus"> Agregar Registro</i></button></span>
					                 </div>
				                 <br>
				                 <br>
								<div class="row">
									<table id="tabla_registros" class="table table-bordered table-striped">
									    <thead>
										      <tr>
											        <th width="4%"></th>
											        <th width="5%">Correlativo</th>
											        <th width="20%">Código</th>
											        <th width="25%">Descripción</th>
											        <th width="10%">Cantidad</th>
											        <th width="10%">Valor Unitario</th>
											        <th width="12%">Orden de Compra</th>
											        <th width="14%">Fecha Incorporación</th>

										      </tr>
									    </thead>
									    <tbody id="registros">
									    </tbody>
									</table>
								</div>
							</div>

        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../inventario"class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Guardar</button>
						</div>

									<input type="hidden" name="_token" value="{{ csrf_token() }}">

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
	        $("#bien-registro").addClass("active");






	      });

	      function Registros(){
	      	var centro = $("#centro").val();
	      	var sector = $("#oficina").val();
	      	console.log(sector);
	      	if(sector!=0){
	      	console.log(sector);
	      		$.ajax({
	                data:  "centro=" + centro + "&sector=" + sector +"&_token=" + "{{csrf_token()}}",
	                url:   'registros',
	                type:  'post',
	                success:  function (response) {
	                		$("#registros").html(response);          
	                    }
			    });

	      	}    
	      }


	     function Addregistros(){
	      	var dataString = $('#form-registros').serialize();
	      	var x = $("#form-registros").serializeArray();
	      	var sw = 0;
		    $.each(x, function(i, field){
		        if(field.name != "_token"){
		        	console.log(field.value);
		        	if(field.value == "" || field.value == undefined){
		        		alert("Debe Completar el campo " + field.name);
		        		sw = 1;
		        		return false
		        	}
		        }
		    });
		    if(sw==0){
		      	$.ajax({
	                data:  dataString,
	                url:   'addregistros',
	                type:  'post',
	                success:  function (response) {
	                	console.log(response);
	                		$("#registros").html(response);

	                		$("#codigo").val(""); 
	                		$("#descripcion").val("");
	                		$("#cantidad").val("");
	                		$("#valor").val("");
	                		$("#orden_compra").val("");
	                		$("#fecha").val("");
	                		$("#notificacion").html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>	<i class="icon fa fa-check"></i> Bien Registrado</h4></div>');           
	                    }
				});
		    }
	      }

	        function DeleteRegistros(key, tr){
	      	console.log(key);
	      	var centro = $("#centro").val();
	      	var sector = $("#oficina").val();
	      	$("#tr" + tr).remove();
	      		$.ajax({
	                data:   "key=" + key + "&centro=" + centro + "&sector=" + sector +"&_token=" + "{{csrf_token()}}",
	                url:   'deleteregistros',
	                type:  'post',
	                success:  function (response) {
	                		$("#registros").html(response);          
	                    }
			    });
	      }



	    </script> 
	@stop     
@stop