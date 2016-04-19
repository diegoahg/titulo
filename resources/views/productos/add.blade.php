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
	    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    <li class="active">Productos</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<div class="row">
       	<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Agregar Productos</h3>
                </div><!-- /.box-header -->
	                <!-- BEGIN FORM-->
					<form action="add" method="post" enctype="multipart/form-data" class="horizontal-form">
        				<div class="box-body">
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
								<h3 class="form-section">Agregar Productos</h3>
								<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Nombre. (*)</label>
												<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej: Licuadora" value="{{ old('nombre') }}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Código (*)</label>
												<input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ej: A123B123" value="{{ old('codigo') }}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Categoria</label>
												<select id="categoria" name="categoria" class="form-control select2" style="width: 100%;" data-placeholder="Seleccionar Categoria">
													<option value="">Elegir Categoria</option> 
													<option>Alaska</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
						                      <label>Descripción</label>
						                      <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese Descripción ..."></textarea>
						                    </div>
						                </div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Precio. (*)</label>
												<input type="text"  id="precio" name="precio" class="form-control" placeholder="Ej: 1400" value="{{ old('precio') }}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Marca. (*)</label>
												<input type="text"  id="marca" name="marca" class="form-control" placeholder="Ej: Somela" value="{{ old('marca') }}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Modelo. (*)</label>
												<input type="text"  id="modelo" name="modelo" class="form-control" placeholder="Ej: V2-HGD" value="{{ old('modelo') }}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Serie. (*)</label>
												<input type="text"  id="serie" name="serie" class="form-control" placeholder="Ej: 0011001223" value="{{ old('serie') }}">
											</div>
										</div>
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Peso</label>
												<input type="text" id="peso" name="peso" class="form-control" value="{{ old('peso') }}" placeholder="En kilos">
											</div>
										</div>
										<!--/span-->
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Alto</label>
												<input type="text" id="alto" name="alto" class="form-control" value="{{ old('alto') }}" placeholder="En centimetros">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Ancho</label>
												<input type="text" id="ancho" name="ancho" class="form-control" value="{{ old('ancho') }}" placeholder="En centimetros">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Largo</label>
												<input type="text" id="largo" name="largo" class="form-control" value="{{ old('largo') }}" placeholder="En centimetros">
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
						                      <label for="exampleInputFile">Subir Imagen</label>
						                      <input type="file" name="inputfile" id="inputfile"/>
						                      <p class="help-block">Ingrese la Imagen.</p>
						                    </div>
										</div>
									</div>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</div>
        				</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="../productos"class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Guardar</button>
						</div>
					</form>
					<!-- END FORM-->
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

	        //Initialize Select2 Elements
	        $(".select2").select2();
	      });
	    </script> 
	@stop      
@stop