@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Sector
	    <small>Panel de Control de Sector</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Sector</li>
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
								<strong>¡Sector creado correctamente!</strong> Tienes {{count($sectores)}} Sectores en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="edit")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Sector editado correctamente!</strong> Tienes {{count($sectores)}} Sectores en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="delete")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Sector eliminado correctamente!</strong> Tienes {{count($sectores)}} Sectores en el sistema.
							</div>
						@endif
					@endif
	                <div class="box-header">
	                  <h3 class="box-title">Listado de Sectores</h3>

		              <div class="pull-right">
		              	<span><a class="btn btn-block btn-success" href="sector/add"><i class="fa fa-sign-in"> Agregar</i></a></span>
	                  </div>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                      <tr>
	                        <th>Código</th>
	                        <th>Nombre</th>
	                        <th>Centro de Costo</th>
	                        <th>Descripción</th>
	                        <th>Acción</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($sectores as $sector)
	                      <tr>
	                        <td>{{$sector->codigo}}</td>
	                        <td>{{$sector->nombre}}</td>
	                        <td>{{$sector->centrocosto->nombre}}</td>
	                        <td>{{$sector->descripcion}}</td>
	                        <td>
	                        	<div class="btn-group">
	                        		<a href="sector/edit/{{$sector->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
	                        		<button type="button" class="btn btn-danger delete-data"  data-role="{{$sector->id}}"><i class="fa fa-trash-o"></i></button>
	                        	</div>
	                        </td>
	                      </tr>
	                     @endforeach
                    </tbody>
                    <tfoot>
                  		<tr>
	                        <th>Código</th>
	                        <th>Nombre</th>
	                        <th>Centro de Costo</th>
	                        <th>Descripción</th>
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
				  $.get( "sector/delete/" + data, function( data ) {
					  $( "#modal" ).html( data );
					  $( "#modalEliminar" ).modal();
					});
				});

				$("#sector").addClass( "active" );
			});
	    </script> 
	@stop      
@stop