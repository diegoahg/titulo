<?php $auth_user = Auth::user();?>
@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Bien Licencia de Software
	    <small>Panel de Control de Inventario</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Bien Licencia de Software</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
           	<div class="col-xs-12">
				<div class="box">
	                <div class="box-header">
	                  <h3 class="box-title">Registro de Bien Licencia de Software</h3>
	                  @if(session("success"))
						@if(session("success")=="ingreso")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Bien creado correctamente!</strong> Tienes {{count($bienlicencias)}} Bienes en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="edit")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Bien editado correctamente!</strong> Tienes {{count($bienlicencias)}} Bienes en el sistema.
							</div>
						@endif
						@if(Session::get("success")=="estado")
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>¡Bien a cambiar de estado correctamente!</strong> 
							</div>
						@endif
					@endif
					@if($auth_user->permisos<=4)
		              <div class="pull-right">
		              	<span><a class="btn btn-block btn-success" href="bien-licencia/add"><i class="fa fa-sign-in"> Agregar</i></a></span>
	                  </div>
	                 @endif
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                      <tr>
	                        <th width="10%">N° Inventario</th>
	                        <th width="35%">Descripcion</th>
	                        <th width="20%">Centro de Costo</th>
	                        <th width="20%">Sector</th>
	                        <th width="15%">Acción</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($bienlicencias as $bienlicencia)
	                      <tr>
	                        <td>{{$bienlicencia->numero}}</td>
	                        <td>{{$bienlicencia->descripcion}}</td>
	                        <td>{{$bienlicencia->centrocosto->nombre}}</td>
	                        <td>{{$bienlicencia->sector->nombre}}</td>
	                        <td>
	                        	<button type="button" class="btn btn-info view-data" data-role="{{$bienlicencia->id}}"><i class="fa fa-info"></i></button>
	                        	@if($auth_user->permisos<=2)
	                        	<a href="/bien-licencia/edit/{{Crypt::encrypt($bienlicencia->id)}}" class="btn btn-block btn-success"><i class="fa fa-edit"></i></a>
	                        	@endif
	                        </td>
	                      </tr>
	                     @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>N° Inventario</th>
                        <th>Descripcion</th>
                        <th>Centro de Costo</th>
                        <th>Sector</th>
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
			$("#inventario").addClass("active");
	        $("#bien-licencia").addClass("active");

	      });

	      function CambiarEstado(key){
	      		var estado = $("#estado").val();
	      		$.get( "bien-licencia/cambiaestado/" + key + "/" + estado, function( data ) {
					console.log(data);
				});
	      }

	      $(".view-data").click(function(){
				  var data = $(this).data("role");
				  $.get( "{{asset('bien-licencia/view/')}}/" + data, function( data ) {
					  $( "#modal" ).html( data );
					  $( "#modalVer" ).modal();
					});
				});

	    </script> 
	@stop     
@stop