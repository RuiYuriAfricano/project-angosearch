

var M = new Array();
M=["Janeiro", "Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","outubro","Novembro","Dezembro"];


function apresentaData(){
    var data = new Date();
    var dia = data.getDate();
    var mes = data.getMonth();
    var ano = data.getFullYear();

    var hor = data.getHours();
    var minuto = data.getMinutes();
    var seg = data.getSeconds();


    var hora = hor+":"+minuto+":"+seg;
    var hj = dia+"/"+M[mes]+"/"+ano +" , "+hora;
    var hjdb = ano+"/"+M[mes]+"/"+dia;

    document.getElementById("dat").setAttribute("value", hj);



}





var windowH = $(window).height()/2;

$(window).on('load',function(){
    $("#myBtn").css('display','none');
});

$(window).on('scroll',function(){
    if ($(this).scrollTop() > windowH) {
        $("#myBtn").css('display','flex');
    } else {
        $("#myBtn").css('display','none');
    }
});

$('#myBtn').on("click", function(){
    $('html, body').animate({scrollTop: 0}, 1000);
});

$('#pessoas').on("click", function(){
    $('html, body').animate(3000);
});



