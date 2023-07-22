if(getCookie("rol_usuario") != "coordinador") {
    location.href ='/proyectoMvcPhp/view/Inicio.html';
}

$(document).ready(function(){
	
	$('#btnGuardarMateria').click(function(){
		var datos=$('#formMateria').serialize();
		$.ajax({
			type:"POST",
			url:"../index.php?controlador=Materia&accion=crearMateria",
			data:datos,
			success:function(r){
				if(r != null){
					location.href ='/view/Inicio.html';
				}else{
					console.log("datos no enviados")
				}
			}
		});
	});

	$("#docente").ready(function(){
		$.ajax({
			type:"GET",
			url:"../index.php?controlador=Usuario&accion=listarDocentes",
			success:function(docentes){
				if(docentes != null){

					var selectDocente = $("#docente"); // Obtener el elemento select

					// Limpiar el contenido actual del select
					selectDocente.empty();

					// Recorrer el array de usuarios y agregar las opciones al select
					docentes.forEach(function(docente){
						selectDocente.append('<option value="' + docente.id + '">' + docente.nombre + '</option>');
					});
				}else{
					console.log("datos no enviados")
				}
			}
		});
	});

});
