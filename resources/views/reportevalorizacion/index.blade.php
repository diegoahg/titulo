@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Reporte de Valorización
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    <li class="active">Reporte de Valorización</li>
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
                  <form action="{{url('reporte-inventario')}}"  id="form-reporte-inventario" method="post" enctype="multipart/form-data" class="horizontal-form">
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
										<label class="control-label">Tipo Bien (*)</label>
										<select id="tipo_bien"  name="tipo_bien" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Oficina">
											<option value="TODOS" selected>TODOS</option>
											<option value="activo">ACTIVO</option>
											<option value="registro">REGISTRO</option> 
											<option value="licencia">LICENCIA</option> 
											<!--<option value="raiz">RAIZ</option> -->
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										@if($filtro == 1)
											<button type="button" onclick="actionForm(this.form.id, 'buscar')" class="btn btn-block btn-primary">Filtrar</button>
										@else
											<button type="button" onclick="actionForm(this.form.id, 'reporte-valorizacion/buscar')" class="btn btn-block btn-primary">Filtrar</button>
										@endif
									</div>
								</div>
								@if($filtro == 1)
								<div class="col-md-2">
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
								</div>
								@endif
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

						</div>
					</div> 
                  </form>
                  <?php $suma_total_inicial = 0; $suma_total_residual = 0;?>
                 	@foreach($preg_sectors as $key => $sector)
                 	    <div class="box box-info">
					        <div class="box-header with-border">
				              <h3 class="box-title">SECTOR: {{$sector->codigo}} {{$sector->nombre}}, CENTRO COSTO: {{$sector->centrocosto->codigo}} {{$sector->centrocosto->nombre}} </h3>
				              <div class="box-tools pull-right">
				                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				                </button>
				              </div>
				            </div>
				            <!-- /.box-header -->
				            <div class="box-body">
				              <div class="table-responsive">
			                  	<table id="example1" class="table table-bordered table-striped">
			                    <thead>
				                      <th>Orden</th>
							          <th>Número Inventario</th>
							          <th>Descripción del Bien</th>
							          <th>Fecha Incorporación</th>
							          <th>Tipo Bien</th>
							          <th>Vida Util</th>
							          <th>Valor Inicial</th>
							          <th>Valor Residual</th>
			                    </thead>
			                    <tbody>
						      	<?php $suma_sector_inicial = 0; $suma_sector_residual = 0; ?>
						        @foreach($bienes as $s => $bien)
						          @if($sector->id == $bien->id_sector)
						          <tr>
						            <td class="text-center">{{$s + 1}})</td>
						            <td class="text-center">{{$bien->codigo}}</td>
						            <td class="text-center">{{$bien->descripcion}}</td>
						            <td class="text-center">{{$bien->fecha_incorporacion}}</td>
						            <td class="text-center">{{$bien->bien}}</td>
						            <td class="text-center">{{$bien->vida_util}}</td>
						            <td class="text-right">${{number_format($bien->valor, 0, '', '.')}}</td>
						            <td class="text-right">${{number_format($bien->residual, 0, '', '.')}}</td>
						          </tr>
						          <?php $suma_sector_inicial = $bien->valor + $suma_sector_inicial; ?>
						          <?php $suma_sector_residual = $bien->valor + $suma_sector_residual; ?>
						          <?php $suma_total_inicial = $bien->valor + $suma_total_inicial; ?>
						          <?php $suma_total_residual = $bien->valor + $suma_total_residual; ?>
						          @endif
						        @endforeach
						        </tbody>
			                    <tfoot>
			                    	<td class="text-center"></td>
			                    	<td class="text-center"></td>
			                    	<td class="text-center"></td>
			                    	<td class="text-center"></td>
			                    	<td class="text-center"></td>
			                        <td class="text-center">TOTAL SECTOR</td>
			                        <th class="text-right">${{number_format($suma_sector_inicial, 0, '', '.')}}</th>
			                        <th class="text-right">${{number_format($suma_sector_residual, 0, '', '.')}}</th>
			                    </tfoot>
							 </table>

		                	 </div>
		                	</div>
		                </div>
                   	@endforeach
			                <center><h1><strong>TOTAL VALOR INICIAL ${{number_format($suma_total_inicial, 0, '', '.')}}</strong></h1></center>
			                <center><h1><strong>TOTAL VALOR RESIDUAL ${{number_format($suma_total_residual, 0, '', '.')}}</strong></h1></center>
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
				$("#reporte-valorizacion").addClass( "active" );
		        $(".select2").select2();

				
				 	@if($filtro == 1)
						 $('#centro').select2('val',"{{$centro}}");
						 $('#oficina').select2('val',"{{$oficina}}");
						 $('#oficina').prop("disabled", false);
						 $('#tipo_bien').select2('val',"{{$tipo_bien}}");
		        	@endif
			});
	 </script> 
	@stop      
@stop