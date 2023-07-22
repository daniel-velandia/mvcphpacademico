if(getCookie("rol_usuario") != "estudiante") {
    location.href ='/proyectoMvcPhp/view/Inicio.html';
}

var urlParams = new URLSearchParams(window.location.search);
var id = urlParams.get('id');



$("#notas").ready(function(){
		$.ajax({
			type:"GET",
			url:"../index.php?controlador=Nota&accion=verMisnotas&id=" + id,
			success:function(notas){
				if(notas != null){

					var divNotas = $("#notas");

					divNotas.empty();

					notas.forEach(function(nota){
						divNotas.append(`
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="nombre">${nota.nombre} ${nota.apellido}</label>
                                    </div>
                                    <div class="col-2">
                                        ${nota.previo_1}
                                    </div>
                                    <div class="col-2">
                                        ${nota.previo_2}
                                    </div>
                                    <div class="col-2">
                                        ${nota.nota_3}
                                    </div>
                                    <div class="col-2">
                                        ${nota.examen}
                                    </div>
                                </div>
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