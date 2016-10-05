@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Reporte de Inventario
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    <li class="active">Reporte de Inventario</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<div class="row">
       	<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                <h3 class="box-title">Filtrar Bienes por:</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="{{asset('reporte-inventario/buscar')}}"  id="form-reporte-inventario" method="post" enctype="multipart/form-data" class="horizontal-form">
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
						<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Centro de Costo (*)</label>
										<select id="centro" name="centro" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
											<option value="Todos">Todos</option> 
											@foreach($centrocostos as $centrocosto)

												<option value="{{$centrocosto->id}}">{{$centrocosto->nombre}}</option> 
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Oficina (*)</label>
										<select id="oficina" disabled name="oficina" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Oficina">
											<option value="Todos">Todos</option> 
											@foreach($sectors as $sector)
												<option value="{{$sector->id}}">{{$sector->nombre}}</option> 
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Estado (*)</label>
										<select id="oficina" name="estado" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Estado">
											<option value="">Elegir un Estado</option>
											<option value="activo">Activo</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										<button type="submit" class="btn btn-block btn-primary">Filtrar</button>
									</div>
								</div>
								@if($filtro == 1)
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										<a href="{{asset('reporte-inventario/exportar-pdf')}}" class="btn btn-block btn-danger">PDF</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										<a href="{{asset('reporte-inventario/exportar-excel')}}" class="btn btn-block btn-success">EXCEL</a>
									</div>
								</div>
								@endif
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

						</div>
					</div> 
                  </form>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">N° Inventario</th>
                        <th class="text-center">Descripción del Bien </th>
                        <th class="text-center">Fecha Incorporación</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Modelo</th>
                        <th class="text-center">N° Serie</th>
                        <th class="text-center">Largo</th>
                        <th class="text-center">Ancho</th>
                        <th class="text-center">Alto</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($bienactivos as $bienactivo)
                    	<tr>
	                        <td class="text-center">{{$bienactivo->category->codigo}}-{{$bienactivo->numero}}</td>
	                        <td class="text-center">{{$bienactivo->descripcion}}</td>
	                        <td class="text-center">{{$bienactivo->fecha}}</td>
	                        <td class="text-center">{{$bienactivo->marca}}</td>
	                        <td class="text-center">{{$bienactivo->modelo}}</td>
	                        <td class="text-center">{{$bienactivo->serie}}</td>
	                        <td class="text-center">{{$bienactivo->largo}}</td>
	                        <td class="text-center">{{$bienactivo->ancho}}</td>
	                        <td class="text-center">{{$bienactivo->alto}}</td>
	                    </tr>
                    	@endforeach
                    </tbody>
                  </table>
	            </div><!-- /.box-body -->
	         </div><!-- /.box -->
	    </div><!-- /.col -->
	</div><!-- /.row -->
		
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="modal"></div>
@section('script')
	<script>


		//Evento que rellena el select cuando se escoge un elemento
		$('#centro').change(function() {
			$('#oficina').prop("disabled", false);
			var sectors = {!!$sectors!!};

			if($('#centro').val()=="Todos"){
				$('#oficina').empty();
				$('#oficina').append('<option value="Todos">Todos</option>');
				$('#oficina').select2('val',"Todos");
				$('#oficina').prop("disabled", true);
				return false;
			}

			$('#oficina').empty();
			$('#oficina').append('<option value="Todos">Todos</option>');
			$('#oficina').select2('val',"Todos");
			$.each(sectors, function(index, value) {
				if (value.id_centro_costo == $('#centro').val()) {
					$('#oficina').append('<option value="' + value.id + '">' + value.nombre + '</option>');
				}
			});

			if ($('#centro').val() == '') {
				$('#oficina').prop("disabled", true);
			}

		});

	      $(document).ready(function() {
				$("#reportes").addClass( "active" );

				 //Initialize Select2 Elements
	        	$(".select2").select2();
			});
	 </script> 
	@stop      
@stop