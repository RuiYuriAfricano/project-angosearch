<?php

$con= conecta();

$sql =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
?>

<div  class="footer_background" style="background-image:url(images/footer_background.png); background-position: center center; ">
    <div class="container" >
        <?php echo utf8_encode($dados['rodape']); ?>

        <div class="row footer-bottom d-flex justify-content-between">
            <p class="col-lg-8 col-sm-12 footer-text m-0">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos Direitos Reservados |
                ANGOSEARCH <i class="fa fa-use" aria-hidden="true"></i> by <a href="#" target="_blank">JORIE</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            <div class="col-lg-4 col-sm-12 footer-social">
                <a href="www.facebook.com"><i class="fa fa-facebook-f"></i></a>
                <a href="www.twitter.com"><i class="fa fa-twitter"></i></a>
                <a href="www.instagram.com"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div></div>