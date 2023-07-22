if(getCookie("rol_usuario") != "coordinador") {
    location.href ='/proyectoMvcPhp/view/Inicio.html';
}

$(document).ready(function(){
	
	$('#btnGuardarUsuario').click(function(){
		var datos=$('#formUsuario').serialize();
		$.ajax({
			type:"POST",
			url:"../index.php?controlador=Usuario&accion=crearUsuario",
			data:datos,
			success:function(r){
				if(r != null){
					location.href ='/view/Inicio.html';
				}else{
					alert("datos no enviados")
				}
			}
		});
	});

});