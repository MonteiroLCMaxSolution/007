<!-- Materialize CSS -->
<link rel="stylesheet" href="<?php echo $lib; ?>/lib/materialize-v1.0.0/css/materialize.css">

<script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>
<!-- Materialize JS -->
<script src="<?php echo $lib; ?>/lib/materialize-v1.0.0/js/materialize.min.js"></script>

<!-- Materialize Custom JS -->
<script src="<?php echo $lib; ?>/lib/custom/script-custom.js"></script>

<script>
    $(document).ready(function() {
        $('.modal-static').modal({
            dismissible: false,
            opacity: 0.5,
        });
        $('#modalSelectCompany').modal('open');
        $('select').formSelect();
    });
</script>



<!-- Modal Structure -->
<div id="modalSelectCompany" class="modal modal-static">
    <div class="modal-content">
        <h4 class="center">Olá!</h4>

        <h5 class="center">É um prazer receber você em nosso estabelecimento!</h5>
        <h6 class="center">Por favor, informe em qual dos nossos endereços você está para poder ver as ofertas que separamos para você.</h6>

        <div class="input-field col s12 m12 l2">
            <select id="company" onclick="selectCompany()">
                <option value="">Selecione</option>
                <?php while($rowCompany = $searchCompany->fetch()) { ?>
                    <option value="<?php echo $rowCompany->id; ?>">
                        <?php echo $rowCompany->fantasia; ?> || <?php echo $rowCompany->address; ?>, <?php echo $rowCompany->number; ?> || <?php echo $rowCompany->neighborhood; ?> || <?php echo $rowCompany->city; ?> - <?php echo $rowCompany->UF; ?>
                    </option>
                <?php } ?>
            </select>
            <label>Empresa</label>
            <span class="helper-text" id="msgCompany">Selecione a Empresa para ver o Cardápio!</span>
        </div>


    </div>
    <div class="modal-footer">
        <a class="waves-effect waves-green btn-flat" onclick="listMenu()">Ver Cardápio</a>
    </div>
</div>