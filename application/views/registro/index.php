<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Carrera</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/jquery.tagit.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/tagit.ui-zendesk.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/estilo.css') ?>">
	<link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="<?php echo base_url('assets/javascripts/jquery-1.11.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/javascripts/jquery-ui.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/javascripts/tag-it.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/javascripts/bootstrap.min.js') ?>"></script>
	<script type="text/javascript">
		$(function () {
			$("#enfermedades").tagit();
			$(".btn-siguiente").on("click", function(){
				var siguiente = $(this).data("siguiente");
				$(".panel-collapse.collapse").removeClass("in");
				$(siguiente).addClass("in");
			});

			$("#btn-modificar").on("click", function(){
				$(".panel-collapse.collapse").removeClass("in");
				$("#panel-registro").addClass("in");
			})

			$("#btn-verificar").on("click", function(){
				var nombre 	= $("#nombre").val();
				var telefono = $("#telefono").val();
				var correo 	= $("#correo").val();
				var enfermedades = $("#enfermedades").tagit("assignedTags");
				//$("#enfermedades").val()

				$("#span-nombre").text(nombre);
				$("#span-telefono").text(telefono);
				$("#span-correo").text(correo);
				$(".modal").modal();
			});

			$("#btn-agendar").on("click", function(){
				var datos = {
					nombre: $("#nombre").val(),
					telefono: $("#telefono").val(),
					correo: $("#correo").val(),
				}
				$.ajax({
					url: "<?php echo site_url('registro/agregar_participante') ?>",
					type: "POST",
					dataType: "JSON",
					data: datos,
					success: function(data){
						console.log(data);
						window.location = "/";
					}
				});
			});

		});
	</script>
</head>
<body>
	<div class="container">
		<div class="panel-group" id="accordion">

			<div id="panel-registro" class="row panel-collapse collapse in">
				<div class="col-sm-12">
					<h2 class="titulo">Formulario de registro</h2>
				</div>
				<div class="col-md-4">
					<div class="edit-field">
						<label for="">Nombre</label>
						<input type="text" class="form-control" name="nombre" id="nombre">
					</div>
					<div class="edit-field">
						<label for="">Apellido</label>
						<input type="text" class="form-control" name="apellido" id="apellido">
					</div>
					<div class="edit-field">
						<label for="">Dirección</label>
						<input type="text" class="form-control" name="direccion" id="direccion">
					</div>
					<div class="edit-field">
						<label for="">Teléfono</label>
						<input type="text" class="form-control" name="telefono" id="telefono">
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label for="">Edad</label>
							<input type="text" class="form-control" name="telefono" id="telefono">
						</div>
						<div class="col-sm-6">
							<label for="">Sexo</label>
							<select name="sexo" id="sexo" class="form-control">
								<option value=""></option>
								<option value="F">FEMENINO</option>
								<option value="M">MASCULINO</option>
							</select>
						</div>
					</div>
					<div class="edit-field">
						<label for="">Enfermedades o Alergias</label>
						<input type="text" id="enfermedades">
					</div>
					<!--<div class="edit-field">
						<label for="">Correo</label>
						<input type="text" class="form-control" name="correo" id="correo">
					</div>-->
					<div class="btn btn-siguiente" data-siguiente="#panel-seleccion">Siguiente</div>
				</div>
			</div>

			<div id="panel-seleccion" class="row panel-collapse collapse">
				<div class="col-sm-12">
					<h2 class="titulo">Escoge la fecha</h2>
				</div>
				<div class="col-sm-4" >
					<div id="datetimepicker12"></div>
					<span class="fecha-hora"></span>
					<br>
					<br>
					<div class="btn" id="btn-verificar">Verificar</div>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Verificación de información</h4>
				</div>
				<div class="modal-body">
					<div class="field">
						<label>Nombre:</label>
						<span id="span-nombre"></span>
					</div>
					<div class="field">
						<label>Teléfono:</label>
						<span id="span-telefono"></span>
					</div>
					<div class="field">
						<label>Correo:</label>
						<span id="span-correo"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="btn-modificar">Modificar</button>
					<button type="button" class="btn btn-success" id="btn-agendar">Agendar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</body>
</html>