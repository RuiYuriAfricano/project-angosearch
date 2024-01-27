<?php

$con= conecta();

$sql =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
?>
<div class="container">




    <div class="border_line"></div>
    <div class="row footer-bottom d-flex justify-content-between align-items-center">
        <p class="col-lg-8 col-md-8 footer-text m-0">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<?php echo $dados['ano']; ?> Todos Direitos reservados</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <!-- <a href="#" onclick="window.print(); return false;" style="position: absolute;left: 50px;">-->
                 <!-- <span class="glyphicon glyphicon-print"></span> Imprimir-->
                  <!--</a>--></p>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalAppointment" tabindex="-1" role="dialog"
     aria-labelledby="modalAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAppointmentLabel">Pesquisa AngoSearch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="apresentaPesquisa.php" method="post">
                    <div class="form-group">
                        <label for="appointment_name" class="text-black">Efectue a sua Pesquisa</label>
                        <input type="text" name="valor_pesquisa" class="form-control" id="appointment_name" placeholder="escreva o nome do desaparecido">
                    </div>


                    <div class="form-group">
                        <input type="submit" value="Pesquisar" class="btn btn-primary   pesquisa" style="background-color: #005cbf;">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>