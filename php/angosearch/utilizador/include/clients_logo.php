<div class="container">
    <div class="clients_slider owl-carousel">
        <div class="item">
            <img src="../../../midia/img/img-pn.jpg" alt="" width="154" height="70">
        </div>

        <div class="item">
            <img src="../../../midia/img/img-isng.png" alt="" width="154" height="70">
        </div>
        <div class="item">
            <img src="../../../midia/img/img-angola.gif" alt="" width="154" height="70">
        </div>
        <div class="item">
            <img src="../../../midia/img/logo_esquadra.jpg" alt="" width="154" height="70">
        </div>
        <div class="item">
            <img src="../../../midia/logo.png" alt="" width="154" height="70">
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
                        <input type="text" name="valor_pesquisa" class="form-control" id="appointment_name"
                               placeholder="pesquise os desapareidos , digitando o seu nome ou cóodigo">
                    </div>


                    <div class="form-group">
                        <input type="submit" value="Pesquisar" class="btn btn-primary   pesquisa" style="background-color: #005cbf;">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>