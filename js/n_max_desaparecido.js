
var n = document.getElementById("n").value();
document.write(n);

function mais(){


    if(n >=1){
        n=n+10;
    document.getElementById("n").setAttribute("value", n);

        }

}


function subtrair(){

    if(n==10){
        document.getElementById("n").setAttribute("value", n);
    } else if(n > 10){
        n = n - 10;
        document.getElementById("n").setAttribute("value", n);
    }
}
