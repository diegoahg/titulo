<?php $auth_user = Auth::user();?>
@extends('master')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Dashboard
	    <small>Control panel</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Dashboard</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
	  	@if($auth_user->permisos <= 3)
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-aqua">
	        <div class="inner">
	          <h3>{{$user}}</h3>
	          <p>Usuarios</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-person-stalker"></i>
	        </div>
	        <a href="{{asset('usuarios')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-green">
	        <div class="inner">
	          <h3>{{$inventario}}<sup style="font-size: 20px"></sup></h3>
	          <p>Bienes Activos</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-cube"></i>
	        </div>
	        <a href="{{asset('bien-activo')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	    @if($auth_user->permisos <= 2)
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-yellow">
	        <div class="inner">
	          <h3>{{$centro}}</h3>
	          <p>Centros de Costos</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-university"></i>
	        </div>
	        <a href="{{asset('centrocosto')}}" class="small-box-footer">Mas Información<i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-red">
	        <div class="inner">
	          <h3>{{$sector}}</h3>
	          <p>Sectores</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-easel"></i>
	        </div>
	        <a href="{{asset('sector')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	    @endif
	    @else
	    	<div class="col-lg-12 col-xs-12">
	   			<center><h2>Bienvenido al Software de Inventario de</h2></center> 	
	   			<center><h2>la Universidad Tecnologica Metropolitana</h2></center>
	   		</div>
	    @endif
	  </div><!-- /.row -->
	  <!-- Main row -->

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->    
@section('script')   
    <script type="text/javascript">
    	$(document).ready(function() {
	        $("#main").addClass( "active" );
	    });
    </script>
@stop   
@stop