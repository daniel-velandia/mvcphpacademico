const Id = getCookie("id_usuario");
const rol = getCookie("rol_usuario");
$("#div-links").ready(function(){
    var divLinks = $("#div-links"); // Obtener el elemento select
  
    // Limpiar el contenido actual del select
    divLinks.empty();
  
    divLinks.append(`
      ${rol == "coordinador" ? '<li class="nav-item"><a class="nav-link text-dark" href="CrearUsuario.html">Crear Usuario</a></li>': ''}
      ${rol == "coordinador" ? '<li class="nav-item"><a class="nav-link text-dark" href="CrearMateria.html">Crear Materia</a></li>': ''}
      ${parseInt(Id) > 0 ? '<li class="nav-item"><a class="nav-link text-dark" href="../index.php?controlador=Usuario&accion=logout">Logout</a></li>': '<li class="nav-item"><a class="nav-link text-dark" href="Login.html">Login</a></li>'}
    `);
  });