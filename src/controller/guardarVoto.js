$(document).ready(function(){
	console.log("probando script");
    // var height = $(window).height();
    // $('#carouselExampleCaptions').height(height);
});

function guardarVoto(dataVoto) {
    console.log('Data voto --> ', dataVoto);
    $.post('./../service/voto.php',{
        data: dataVoto
    },function(e){
        console.log('Mensaje del servidor --> ', e);
    });
}