@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Reporte de Vida Útil
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    <li class="active">Reporte de Vida Útil</li>
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
                  <form action="{{url('reporte-vida-util')}}"  id="form-reporte-inventario" method="post" enctype="multipart/form-data" class="horizontal-form">
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
											<option value="TODOS">TODOS</option> 
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
											<option value="TODOS">TODOS</option> 
											@foreach($sectors as $sector)
												<option value="{{$sector->id}}">{{$sector->nombre}}</option> 
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										@if($filtro == 1)
											<button type="button" onclick="actionForm(this.form.id, 'buscar')" class="btn btn-block btn-primary">Filtrar</button>
										@else
											<button type="button" onclick="actionForm(this.form.id, 'reporte-vida-util/buscar')" class="btn btn-block btn-primary">Filtrar</button>
										@endif
									</div>
								</div>
								@if($filtro == 1)
								<!--<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										<button type="button" onclick="actionForm(this.form.id, 'exportar-pdf')" class="btn btn-block btn-danger">PDF</button>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										<button type="button" onclick="actionForm(this.form.id, 'exportar-excel')" class="btn btn-block btn-success">EXCEL</button>
									</div>
								</div>-->
								@endif
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

						</div>
					</div> 
                  </form>
                  <table id="example1" class="table table-bordered table-striped">
                  @if(isset($bienes))
	                    <thead>
	                      <tr>
	                        <th class="text-center">N° Inventario</th>
	                        <th class="text-center">Descripción del Bien </th>
	                        <th class="text-center">Fecha Incorporación</th>
	                        <th class="text-center">Cuenta Contable</th>
	                        <th class="text-center">Vida Util</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($bienes as $bien)
	                    	<tr>
		                        <td class="text-center">{{$bien->category->codigo}}-{{$bien->numero}}</td>
		                        <td class="text-center">{{$bien->descripcion}}</td>
		                        <td class="text-center">{{$bien->fecha}}</td>
		                        <td class="text-center">{{$bien->cuentacontable->nombre}}</td>
		                        <td class="text-center">{{$bien->vida_util}}</td>
		                    </tr>
	                    	@endforeach
	                    </tbody>
                    @endif
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

			if($('#centro').val()=="TODOS"){
				$('#oficina').empty();
				$('#oficina').append('<option value="TODOS">TODOS</option>');
				$('#oficina').select2('val',"TODOS");
				$('#oficina').prop("disabled", true);
				return false;
			}

			$('#oficina').empty();
			$('#oficina').append('<option value="TODOS">TODOS</option>');
			$('#oficina').select2('val',"TODOS");
			$.each(sectors, function(index, value) {
				if (value.id_centro_costo == $('#centro').val()) {
					$('#oficina').append('<option value="' + value.id + '">' + value.nombre + '</option>');
				}
			});

			if ($('#centro').val() == '') {
				$('#oficina').prop("disabled", true);
			}

		});

		function actionForm(formid,url){
				$("#" + formid).attr('action', url);
	  	   		$("#" + formid).submit();
	  	}

	      $(document).ready(function() {
				$("#reportes").addClass( "active" );
				$("#reporte-vida-util").addClass( "active" );
		        $(".select2").select2();

				
				 	@if($filtro == 1)
						 $('#centro').select2('val',"{{$centro}}");
						 $('#oficina').select2('val',"{{$oficina}}");
						 $('#oficina').prop("disabled", false);
		        	@endif
			});
	 </script> 
	@stop      
@stop