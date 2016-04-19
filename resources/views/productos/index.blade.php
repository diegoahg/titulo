@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Productos
	    <small>Panel de Control de Productos</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Productos</li>
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
								<strong>¡Producto creado correctamente!</strong> Tienes {{count($productos)}} productos en el sistema. <button type="button" class="btn btn-info view-data" data-role="{{session('id_producto')}}">Has click aqui para ver el último usuario que creaste</button>
							</div>
						@endif
						@if(Session::get("success")=="edit")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Producto editado correctamente!</strong> Tienes {{count($productos)}} productos en el sistema. <button type="button" class="btn btn-info view-data" data-role="{{session('id_producto')}}">Has click aqui para ver el último usuario que editaste</button>
							</div>
						@endif
						@if(Session::get("success")=="delete")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Producto eliminado correctamente!</strong> Tienes {{count($productos)}} productos en el sistema.
							</div>
						@endif
					@endif
	                <div class="box-header">
	                  <h3 class="box-title">Panel de Productos</h3>
		              <div class="pull-right">
	                  	<a class="btn btn-block btn-success" href="productos/add"><i class="fa fa-plus-circle"> Agregar</i></a>
	                  </div>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                      <tr>
	                        <th  width="15%">Imagen</th>
	                        <th>Nombre</th>
	                        <th>Precio</th>
	                        <th width="20%">Acción</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($productos as $producto)
		                      <tr>
		                        <td class="hidden-xs img-responsive img-rounded center-block"><img src="productos/product-image/{{$producto->imagen}}" width="100%"/></td>
		                        <td>{{$producto->nombre}}</td>
		                        <td>{{$producto->precio}}</td>
		                        <td>
		                        	<div class="btn-group">
		                        		<button type="button" class="btn btn-info view-data" data-role="{{$producto->id}}"><i class="fa fa-info"></i></button>
		                        		<a href="productos/edit/{{$producto->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
		                        		<button type="button" class="btn btn-danger delete-data"  data-role="{{$producto->id}}"><i class="fa fa-trash-o"></i></button>
		                        	</div>
	                        	</td>
		                      </tr>
	                    	@endforeach
	                    </tbody>
	                    <tfoot>
	                      <tr>
	                        <th>Imagen</th>
	                        <th>Nombre</th>
	                        <th>Precio</th>
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
				  $.get( "productos/delete/" + data, function( data ) {
					  $( "#modal" ).html( data );
					  $( "#modalEliminar" ).modal();
					});
				});

			   $(".view-data").click(function(){
				  var data = $(this).data("role");
				  $.get( "productos/view/" + data, function( data ) {
					  $( "#modal" ).html( data );
					  $( "#modalVer" ).modal();
					});
				});

				$("#usuarios").addClass( "active" );
			});
	    </script> 
	@stop
@stop