<?php

$con= conecta();

$sql =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
?>

<?php
$sql =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
?>
<div class="pull-right hidden-xs">
    <b>Versão</b> 1.0
</div>
<strong>Copyright <script>document.write(new Date().getFullYear());</script> <a href="http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/index.php">Angosearch</a>.</strong> Todos Direitos Reservados.

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