@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Bien Registro
	    <small>Panel de Control de Inventario</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Bien Registro</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
           	<div class="col-xs-12">
				<div class="box">
	                <div class="box-header">
	                  <h3 class="box-title">Registro de Inventario</h3>
	                  @if(session("success"))
						@if(session("success")=="ingreso")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Bien creado correctamente!</strong> Tienes {{count($bienregistros)}} Bienes en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="edit")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Bien editado correctamente!</strong> Tienes {{count($bienregistros)}} Bienes en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="estado")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Bien a cambiado de estado correctamente!</strong> 
							</div>
						@endif
					@endif

		              <div class="pull-right">
		              	<span><a class="btn btn-block btn-success" href="bien-registro/add"><i class="fa fa-sign-in"> Ingresos</i></a></span>
	                  </div>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                      <tr>
	                        <th width="10%">Código</th>
	                        <th width="35%">Descripcion</th>
	                        <th width="20%">Centro de Costo</th>
	                        <th width="20%">Sector</th>
	                        <th width="20%">Valor</th>
	                        <th width="15%">Acción</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($bienregistros as $bienregistro)
	                      <tr>
	                        <td>{{$bienregistro->codigo}}</td>
	                        <td>{{$bienregistro->descripcion}}</td>
	                        <td>{{$bienregistro->centrocosto->nombre}}</td>
	                        <td>{{$bienregistro->sector->nombre}}</td>
	                        <td>${{number_format($bienregistro->valor, 0, '', '.')}}</td>
	                        <td>
	                        	<a href="bien-registro/edit/{{Crypt::encrypt($bienregistro->id)}}" class="btn btn-block btn-success">Ver</a>
	                        </td>
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
			
			$("#inventario").addClass("active");
	        $("#bien-registro").addClass("active");

	      });

	      function CambiarEstado(key){
	      		var estado = $("#estado").val();
	      		$.get( "bien-registro/cambiaestado/" + key + "/" + estado, function( data ) {
					console.log(data);
				});
	      }

	    </script> 
	@stop     
@stop