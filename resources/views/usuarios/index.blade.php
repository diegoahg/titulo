@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Usuarios
	    <small>Panel de Control de Usuarios</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    <li class="active">Usuarios</li>
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
							<strong>¡Usuario creado correctamente!</strong> Tienes {{count($users)}} usuarios en el sistema.
						</div>
					@endif
					@if(Session::get("success")=="edit")
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<strong>¡Usuario editado correctamente!</strong> Tienes {{count($users)}} usuarios en el sistema.
						</div>
					@endif
					@if(Session::get("success")=="delete")
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<strong>¡Usuario eliminado correctamente!</strong> Tienes {{count($users)}} usuarios en el sistema.
						</div>
					@endif
				@endif
                <div class="box-header">
                  <h3 class="box-title">Panel de Usuarios</h3>

                  <div class="pull-right">
                  	<a class="btn btn-block btn-success" href="usuarios/add"><i class="fa fa-plus-circle"> Agregar</i></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($users as $user)
           				<tr>
	                        <td>{{$user->name}} {{$user->apellido_paterno}} {{$user->apellido_materno}}</td>
	                        <td>{{$user->email}}</td>
	                        <td>{{$user->cargo}}</td>
	                        <td>{{$user->departamento}}</td>
	                        <td>{{$user->fono}}</td>
	                        <td>
	                        	<div class="btn-group">
	                        		<button type="button" class="btn btn-info view-data" data-role="{{$user->id}}"><i class="fa fa-info"></i></button>
	                        		<a href="usuarios/edit/{{$user->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
	                        		<button type="button" class="btn btn-danger delete-data"  data-role="{{$user->id}}"><i class="fa fa-trash-o"></i></button>
	                        		<button type="button" class="btn btn-success"><i class="fa fa-key"></i></button>
	                        	</div>
	                        </td>
	                    </tr>
                    	@endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Teléfono</th>
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
				  $.get( "usuarios/delete/" + data, function( data ) {
					  $( "#modal" ).html( data );
					  $( "#modalEliminar" ).modal();
					});
				});

			   $(".view-data").click(function(){
				  var data = $(this).data("role");
				  $.get( "usuarios/view/" + data, function( data ) {
					  $( "#modal" ).html( data );
					  $( "#modalVer" ).modal();
					});
				});

				$("#usuarios").addClass( "active" );
			});
	    </script> 
	@stop      
@stop