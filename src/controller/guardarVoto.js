$(document).ready(function(){
	// console.log("probando script");
    $('#upload').on('click', function() {
        var file_data = $('#sortpicture').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        alert(form_data);                             
        $.ajax({
            url: './../service/uploadFile.php', // <-- point to server-side PHP script 
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                alert(php_script_response); // <-- display response from the PHP script, if any
            }
         });
    });
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
                // timer: 3000
            });
            setTimeout(function(){ location.reload(); }, 1500);
        } else {
            Swal.fire({
                position: 'top',
                icon: 'info',
                title: 'Oops...',
                text: 'Ya tienes un voto registrado!'
            });
        }
    });
}