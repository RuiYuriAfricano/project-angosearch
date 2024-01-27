/**
 * Created by ELISANDRA SERRA on 17/08/2019.
 */

/** Gráfico horario
 *
 *
 */

var ctx = document.getElementById("lineChart").getContext("2d");
ctx.canvas.height=130;

function ret(param){
    var valores = [];
    $.each(param, function(key, val){
        valores.push(val);

    });

    return valores;
}





var periodo = "-3 days";

$.getJSON("../../../relatorios/trafego_por_hora/"+periodo ,function(resposta){



    var lineChartData = {
        labels : Object.keys(resposta),
        datasets : [
            {
                label: "My First dataset",
                fillColor : "rgba(220,220,220,0.2)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)",
                data : ret(resposta)
            },
            {
                label: "My Second dataset",
                fillColor : "rgba(151,187,205,0.2)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(151,187,205,1)",
                data : ret(resposta)
            }
        ]

    }



        window.myLine = new Chart(ctx).Line(lineChartData, {
            responsive: true  });
});







/**
 * Created by ELISANDRA SERRA on 17/08/2019.
 */

/** Gráfico Semanal
 *
 *
 */

var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

$.getJSON("../../../relatorios/trafego_semanal/" ,function(resposta){

var barChartData = {
    labels : Object.keys(resposta),
    datasets : [
        {
            fillColor : "rgba(220,220,220,0.5)",
            strokeColor : "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data : ret(resposta)
        },
        {
            fillColor : "rgba(151,187,205,0.5)",
            strokeColor : "rgba(151,187,205,0.8)",
            highlightFill : "rgba(151,187,205,0.75)",
            highlightStroke : "rgba(151,187,205,1)",
            data : ret(resposta)
        }
    ]

}


    var ctx = document.getElementById("barChart").getContext("2d");
    ctx.canvas.height=130;
    window.myBar = new Chart(ctx).Bar(barChartData, {
        responsive : true
    });


    });




/** Gráfico Semanal
 *
 *
 */

var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

$.getJSON("../../../relatorios/trafego_mensal/" ,function(resposta){

    var barChartData1 = {
        labels : Object.keys(resposta),
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data : ret(resposta)
            },
            {
                fillColor : "#C4BE15",
                strokeColor : "rgba(151,187,205,0.8)",
                highlightFill : "rgba(151,187,205,0.75)",
                highlightStroke : "rgba(151,187,205,1)",
                data : ret(resposta)
            }
        ]

    }


    var ctx1 = document.getElementById("barChartMensal").getContext("2d");
    ctx1.canvas.height=130;
    window.myBar = new Chart(ctx1).Bar(barChartData1, {
        responsive : true
    });


});

var para = "-90 days";
$.getJSON("../../../relatorios/trafego_por_plataforma/"+para ,function(resposta){

var pieData = resposta;


    var ctx = document.getElementById("pieChart").getContext("2d");
    ctx.canvas.height=250;
    ctx.canvas.width=560;
    window.myPie = new Chart(ctx).Pie(pieData);

    });
$.getJSON("../../../relatorios/trafego_por_navegador/"+para ,function(resposta){

    var pieData = resposta;


    var ctx = document.getElementById("doughnutChart").getContext("2d");
    ctx.canvas.height=250;
    ctx.canvas.width=560;
    window.myPie = new Chart(ctx).Doughnut(pieData);

});