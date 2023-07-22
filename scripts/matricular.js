if(getCookie("rol_usuario") != "coordinador") {
    location.href ='/proyectoMvcPhp/view/Inicio.html';
}

$(document).ready(function(){
	
	$('#btnAsignarMateria').click(function(){
        estudiantesSeleccionados = [];

        $('input[type="checkbox"]').each(function() {
            if (this.checked) {
                estudiantesSeleccionados.push($(this).val());
            }
        });

        var materia = $('#materia').val();
        console.log({"materia": materia, "estudiantes": estudiantesSeleccionados})
        
        $.ajax({
            type:"POST",
            url:"../index.php?controlador=Nota&accion=matricular",
            data:{ "materia": materia, "estudiantesSeleccionados": estudiantesSeleccionados },
                success:function(r){
                    if(r != null){
                        alert("estudiantes matriculados")
                    }else{
                        alert("datos no enviados")
                    }
                }
		});
	});

	$("#estudiantes").ready(function(){
		$.ajax({
			type:"GET",
			url:"../index.php?controlador=Usuario&accion=listarEstudiantes",
			success:function(estudiantes){
				if(estudiantes != null){

					var contEstudiantes = $("#estudiantes");

					contEstudiantes.empty();

					estudiantes.forEach(function(estudiante){
						contEstudiantes.append(`
						<li class="list-group-item">
							<input class="form-check-input me-1" type="checkbox" value="${estudiante.id}" id="${estudiante.id}">
							<label class="form-check-label stretched-link" for="${estudiante.id}">${estudiante.nombre} ${estudiante.apellido}</label>
						</li>
						`);
					});
				}else{
					console.log("datos no enviados")
				}
			}
		});
	});

	var urlParams = new URLSearchParams(window.location.search);
	var id = urlParams.get('id');
	
	console.log("ID: " + id);

    $("#materia").ready(function(){
		$.ajax({
			type:"GET",
			url:"../index.php?controlador=Materia&accion=obtenerMateria&id=" + id,
			success:function(materia){
				if(materia != null){

					var divMateria = $("#divmateria"); // Obtener el elemento select

					$('#materia').val(materia.id)
					// Limpiar el contenido actual del select
					divMateria.empty();

					// Recorrer el array de usuarios y agregar las opciones al select
					divMateria.append('' + materia.id + ' ' + materia.nombre + ' ');
				}else{
					console.log("datos no enviados")
				}
			}
		});
	});

});
