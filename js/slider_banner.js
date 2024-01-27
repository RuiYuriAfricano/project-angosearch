/**
 * Created by RUI YURI on 11/06/2019.
 */
/*Vetor de fotos*/
var slides = new Array("../midia/img/banner/tt.jpg","../midia/img/banner/tt.jpg");
/*O tamanho das fotos*/
var tam = slides.length;
/*O primeiro*/
var satul = 1;

var  tmpSlider;

function trocaAutomatica(){
    satul++;
    if(satul>= tam){
        satul=0;
    }
    document.getElementById("dvSlider").style.backgroundImage="url('"+slides[satul]+"')";
}

function iniciaSlider(){
    document.getElementById("dvSlider").style.backgroundImage="url('"+slides[satul]+"')";
    tmpSlider = setInterval(trocaAutomatica,2500);
}
function parar(){
    clearInterval(tmpSlider);
}
