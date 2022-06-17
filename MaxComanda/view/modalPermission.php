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
            opacity: 0.97,
        });
        $('#modalPermission').modal('open');
    });
</script>



<!-- Modal Structure -->
<div id="modalPermission" class="modal modal-static">
    <div class="modal-content">
        <h4 class="center" style="color: red"><i class="medium material-icons">warning</i></h4>

        <h5 class="center">Acesso Negado!</h5>
        <h6 class="center">Ops! Parece que você não possui permissão para acessar esta página!</h6>
        <p class="center">Consulte o Administrador para mais informações.</p>
    </div>
    <div class="modal-footer">
        <a href="?pg=dashboard" class="waves-effect waves-green btn-flat">PÁGINA INICIAL</a>
    </div>
</div>