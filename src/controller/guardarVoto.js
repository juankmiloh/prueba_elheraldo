$(document).ready(function(){
	// console.log("probando script");
    // $('#upload').on('click', function() {
        
    // });
});

function guardarImagen(oauth_uid) {
    console.log('Guardar imagen!');
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('idusuario', oauth_uid);
    // console.log(JSON.stringify(form_data));
    $.post({
        url: './../service/uploadFile.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post'
    },function(e){
        // console.log('Mensaje del servidor --> ', e);
        Swal.fire({
            // title: 'Are you sure?',
            text: e,
            icon: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok',
            allowOutsideClick: false
          }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    });
}

function guardarVoto(dataVoto) {
    // console.log('Data voto --> ', dataVoto);
    $.post('./../service/voto.php',{
        data: dataVoto
    },function(e){
        resp = JSON.parse(e);
        // console.log('Mensaje del servidor --> ', resp);
        if (resp) { // Se actualiza la vista si el usuario registra voto
            Swal.fire({
                title: 'Voto registrado con éxito!',
                // text: e,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                allowOutsideClick: false
              }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        } else {
            Swal.fire({
                position: 'top',
                icon: 'info',
                title: 'Oops...',
                text: 'Ya tienes un voto registrado!',
                allowOutsideClick: false
            });
        }
    });
}