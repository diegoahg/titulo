@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Centro de Costos
	    <small>Panel de Control de Centro de Costos</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Centro de Costos</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
           	<div class="col-xs-12">
				<div class="box">
					@if(session("success"))
						@if(session("success")=="add")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Centro de Costo creado correctamente!</strong> Tienes {{count($centrocostos)}} Centros de Costos en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="edit")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Centro de Costo editado correctamente!</strong> Tienes {{count($centrocostos)}} Centros de Costos en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="delete")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Centro de Costo eliminado correctamente!</strong> Tienes {{count($centrocostos)}} Centros de Costos en el sistema.
							</div>
						@endif
					@endif
	                <div class="box-header">
	                  <h3 class="box-title">Listado de Centros de costos</h3>

		              <div class="pull-right">
		              	<span><a class="btn btn-block btn-success" href="centrocosto/add"><i class="fa fa-sign-in"> Agregar</i></a></span>
	                  </div>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                      <tr>
	                        <th>Código</th>
	                        <th>Nombre</th>
	                        <th>Descripción</th>
	                        <th>Dirección</th>
	                        <th>Acción</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($centrocostos as $centrocosto)
	                      <tr>
	                        <td>{{$centrocosto->codigo}}</td>
	                        <td>{{$centrocosto->nombre}}</td>
	                        <td>{{$centrocosto->descripcion}}</td>
	                        <td>{{$centrocosto->direccion}}</td>
	                        <td>
	                        	<div class="btn-group">
	                        		<a href="centrocosto/edit/{{$centrocosto->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
	                        		<button type="button" class="btn btn-danger delete-data"  data-role="{{$centrocosto->id}}"><i class="fa fa-trash-o"></i></button>
	                        	</div>
	                        </td>
	                      </tr>
	                     @endforeach
                    </tbody>
                    <tfoot>
                  		<tr>
	                        <th>Código</th>
	                        <th>Nombre</th>
	                        <th>Descripción</th>
	                        <th>Dirección</th>
	                        <th>Acción</th>
                     	</tr>
                    </tfoot>
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
	      });

	      $(document).ready(function() {
			   $(".delete-data").click(function(){
				  var data = $(this).data("role");
				  $.get( "centrocosto/delete/" + data, function( data ) {
					  $( "#modal" ).html( data );
					  $( "#modalEliminar" ).modal();
					});
				});

				$("#centrocosto").addClass( "active" );
			});
	    </script> 
	@stop      
@stop