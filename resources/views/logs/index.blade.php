@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Logs de Usuarios
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    <li class="active">Logs de Usuarios</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<div class="row">
       	<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                <h3 class="box-title">Filtrar por:</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="{{url('reporte-inventario')}}"  id="form-reporte-inventario" method="post" enctype="multipart/form-data" class="horizontal-form">
                  	<div class="form-body">
						<div id="notificacion">
						</div>
						<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Usuario (*)</label>
										<select id="usuario" name="usuario" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Centro de Costo">
											<option value="TODOS">TODOS</option> 
											@foreach($usuarios as $usuario)

												<option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->apellido_paterno}}</option> 
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tipo Bien (*)</label>
										<select id="tipo_bien"  name="tipo_bien" required class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Oficina">
											<option value="activo" selected>ACTIVO</option>
											<option value="registro">REGISTRO</option> 
											<option value="licencia">LICENCIA</option> 
											<option value="raiz">RAIZ</option> 
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">&nbsp</label>
										@if($filtro == 1)
											<button type="button" onclick="actionForm(this.form.id, 'buscar')" class="btn btn-block btn-primary">Filtrar</button>
										@else
											<button type="button" onclick="actionForm(this.form.id, 'logs/buscar')" class="btn btn-block btn-primary">Filtrar</button>
										@endif
									</div>
								</div>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

						</div>
					</div> 
                  </form>
                  <table id="example1" class="table table-bordered table-striped">
                  @if(isset($infos))
	                    <thead>
	                      <tr>
	                        <th class="text-center">Modulo</th>
	                        <th class="text-center">Detalle </th>
	                        <th class="text-center">Usuario </th>
	                        <th class="text-center">Acción</th>
	                        <th class="text-center">Fecha</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($infos as $info)
	                    	<tr>
		                        <td class="text-center">{{$info->modulo}}</td>
		                        <td class="text-center">{{$info->detalle}}</td>
		                        <td class="text-center">{{$info->getuser->nombre}} {{$info->getuser->apellido_paterno}} {{$info->getuser->apellido_materno}}</td>
		                        <td class="text-center">{{$info->accion}}</td>
		                        <td class="text-center">{{$info->created_at}}</td>
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

		function actionForm(formid,url){
				$("#" + formid).attr('action', url);
	  	   		$("#" + formid).submit();
	  	}

	      $(document).ready(function() {
				$("#registros").addClass( "active" );
		        $(".select2").select2();

				
				 	@if($filtro == 1)
						 $('#usuario').select2('val',"{{$data_usuario}}");
						 $('#tipo_bien').select2('val',"{{$tipo_bien}}");
		        	@endif
			});
	 </script> 
	@stop      
@stop