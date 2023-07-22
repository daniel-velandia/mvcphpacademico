if(getCookie("rol_usuario") != "docente") {
    location.href ='/proyectoMvcPhp/view/Inicio.html';
}

$(document).ready(function() {
    $("#btnAsignarNota").click(function() {
      var datosArray = [];
  
      // Iterar sobre cada elemento y obtener los valores de los campos
      $("#estudiantes .row").each(function() {
        var elemento = $(this);
        var id_estudiante = elemento.find("#idEstudiante").val();
        var previo_1 = elemento.find("#previo1").val();
        var previo_2 = elemento.find("#previo2").val();
        var nota_3 = elemento.find("#nota3").val();
        var examen = elemento.find("#examen").val();
  
        datosArray.push({
          id_estudiante: id_estudiante,
          previo_1: previo_1,
          previo_2: previo_2,
          nota_3: nota_3,
          examen: examen
        });
      });
  
      console.log(datosArray);

      $.ajax({
        type:"POST",
        url:"../index.php?controlador=Nota&accion=asignarNotas",
        data:{ "id_materia": id, "notas": datosArray },
            success:function(r){
                if(r != null){
                    alert("notas asignadas")
                }else{
                    alert("datos no enviados")
                }
            }
    });
    });
  });
  
var urlParams = new URLSearchParams(window.location.search);
var id = urlParams.get('id');

console.log("ID: " + id);

$("#estudiantes").ready(function(){
		$.ajax({
			type:"GET",
			url:"../index.php?controlador=Nota&accion=ListarEstudiantesPorMateria&id=" + id,
			success:function(estudiantes){
				if(estudiantes != null){

					var contEstudiantes = $("#estudiantes");

					contEstudiantes.empty();

					estudiantes.forEach(function(estudiante){
						contEstudiantes.append(`
                        <div class="row mb-3">
                            <div class="col-2 text-center align-self-center">
                                <label for="nombre">${estudiante.nombre} ${estudiante.apellido}</label>
                                <input type="text" class="form-control" id="idEstudiante" value="${estudiante.id_estudiante}" hidden>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" id="previo1" value="${estudiante.previo_1}">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" id="previo2" value="${estudiante.previo_2}">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" id="nota3" value="${estudiante.nota_3}">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" id="examen" value="${estudiante.examen}">
                            </div>
                        </div>
						`);
					});
				}else{
					console.log("datos no enviados")
				}
			}
		});
	});