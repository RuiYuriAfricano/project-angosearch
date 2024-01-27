/**
 * Created by ELISANDRA SERRA on 18/08/2019.
 */
function pages_views(){

    $('.pagetr').remove();

var periodo = $('#pages-select').val();
$.getJSON("../../../relatorios/trafego_por_pagina/"+periodo ,function(resposta){


    var i = 1;
    $.each(resposta,function(key,val){

        var container='<tr class="pagetr">';
        container +=      '<td>'+i+'</td>';
        container +=      '<td>'+key+'</td>';
        container +=      '<td>'+val+'</td>';
        container +='</tr>';;

        i++;

        $('#pages').append(container);
    });
});
    }

pages_views();
$('#pages-select').change(function(){
    pages_views();
});

