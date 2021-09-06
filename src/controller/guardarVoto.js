$(document).ready(function(){
	// console.log("probando script");
});

function guardarVoto(dataVoto) {
    console.log('Data voto --> ', dataVoto);
    $.post('./../service/voto.php',{
        data: dataVoto
    },function(e){
        resp = JSON.parse(e);
        console.log('Mensaje del servidor --> ', resp);
        if (resp) { // Se actualiza la vista si el usuario registra voto
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Voto registrado con éxito!',
                showConfirmButton: false,
                timer: 1500
            });
            location.reload();
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Ya hay un voto registrado!'
            });
        }
    });
}