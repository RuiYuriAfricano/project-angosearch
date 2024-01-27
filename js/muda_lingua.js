/**
 * Created by ELISANDRA SERRA on 18/08/2019.
 */
function pages_views(){

    $('.pagetr').remove();

    var p = $('#pages-select').val();
    if(p==2){
        window.location="index_eng.php";
    }
    else if(p==1){
        window.location="index.php";
    }

}

pages_views();
$('#pages-select').change(function(){
    pages_views();
});

