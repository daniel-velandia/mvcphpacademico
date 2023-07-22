
const Idusuario = getCookie("id_usuario");
const rolusuario = getCookie("rol_usuario");

$("#materia").ready(function(){
  $.ajax({
      type:"GET",
      url: "../index.php?controlador=Materia&accion=listarMaterias",
      success:function(materias){
        if(materias != null){

          var selectMateria = $("#materia");

          selectMateria.empty();

          materias.forEach(function(materia){
            selectMateria.append(`
              <div class="col-md-3 p-4">
                <div class="card-body border border-secondary rounded">
                  <h5 class="card-title">${materia.nombre_materia}</h5>
                  <div class="card-text">${materia.nombre_docente} ${materia.apellido_docente}</div>
                  <hr class="mt-1"/>
                  ${rolusuario == "coordinador" ? '<a href="Matricular.html?id=' + materia.id +'" class="btn btn-primary">matricular</a>': ''}
                  ${rolusuario == "docente" ? '<a href="AsignarNotas.html?id=' + materia.id +'" class="btn btn-danger">asignar notas</a>': ''}
                  ${rolusuario == "estudiante" ? '<a href="VerMisNotas.html?id=' + materia.id +'" class="btn btn-danger">ver notas</a>': ''}
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
