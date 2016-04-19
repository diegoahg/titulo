@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Inventario
	    <small>Panel de Control de Inventario</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Inventario</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
           	<div class="col-xs-12">
				<div class="box">
	                <div class="box-header">
	                  <h3 class="box-title">Registro de Inventario</h3>

		              <div class="pull-right">
		              	<span><a class="btn btn-block btn-success" href="inventario/ingreso"><i class="fa fa-sign-in"> Ingresos</i></a></span>
	                  </div>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                      <tr>
	                        <th>N° Inventario</th>
	                        <th>Descripcion</th>
	                        <th>Centro de Costo</th>
	                        <th>Sector</th>
	                        <th>Acción</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($inventarios as $inventario)
	                      <tr>
	                        <td>{{$inventario->category->codigo}}-{{$inventario->numero}}</td>
	                        <td>{{$inventario->descripcion}}</td>
	                        <td>{{$inventario->centrocosto->nombre}}</td>
	                        <td>{{$inventario->sector->sector}}</td>
	                        <td></td>
	                      </tr>
	                     @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
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
	    </script> 
	@stop     
@stop