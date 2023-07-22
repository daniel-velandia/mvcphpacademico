$(document).ready(function(){

	$('#btnLogin').click(function(){
		var datos=$('#formLogin').serialize();
		$.ajax({
			type:"POST",
			url:"../index.php?controlador=Usuario&accion=login",
			data:datos,
			success:function(r){
				if(r) {
					location.href ='/view/Inicio.html';
				} else {
					alert('error al loguearse')
				}
			}
		});
	});

});