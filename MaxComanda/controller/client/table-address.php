<?php

$ModelClient = 'MaxComanda/model/client/client-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelClient)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelClient = $tag . $ModelClient;
include_once($ModelClient);

$ModelUserPermission = 'MaxComanda/model/permission/user-permission.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelUserPermission)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelUserPermission = $tag . $ModelUserPermission;
include_once($ModelUserPermission);


?>

<table id="tableClientAddress" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>UF</th>
            <th>Última Atualização</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchClientAddress = $sqlSearchClientAddress->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchClientAddress->id; ?></td>
                <td><?php echo $rowSearchClientAddress->CEP; ?></td>
                <td><?php echo $rowSearchClientAddress->address; ?></td>
                <td><?php echo $rowSearchClientAddress->number; ?></td>
                <td><?php echo $rowSearchClientAddress->complement; ?></td>
                <td><?php echo $rowSearchClientAddress->neighborhood; ?></td>
                <td><?php echo $rowSearchClientAddress->city; ?></td>
                <td><?php echo $rowSearchClientAddress->UF; ?></td>
                <td><?php echo $rowSearchClientAddress->last_update; ?></td>
                <td>

                    <?php if ($ROW_Perm_Register_Client->edit == 'S') { ?>
                        <a class="btn-floating waves-effect waves-light blue tooltipped modal-trigger" href="#modalAddress<?php echo $rowSearchClientAddress->id; ?>" data-tooltip="Editar" onclick="validaFormEditAddress('<?php echo $rowSearchClientAddress->id; ?>')"><i class="material-icons">edit</i></a>

                        <a class="btn-floating waves-effect waves-light red tooltipped" data-tooltip="Deletar" onclick="deleteClientAddress('<?php echo $rowSearchClientAddress->id; ?>','<?php echo $rowSearchClientAddress->client_id; ?>')"><i class="material-icons">delete</i></a>
                    <?php } ?>

                </td>
            </tr>



            <!-- Modal Structure -->
            <div id="modalAddress<?php echo $rowSearchClientAddress->id; ?>" class="modal bottom-sheet">
                <div class="modal-content">
                    <div class="row">
                        <form id="formClientAddress<?php echo $rowSearchClientAddress->id; ?>" enctype="multipart/form-data" method="POST">

                            <script>
                                $(".CEP").mask('#####-###');
                            </script>

                            <div class="input-field col s12 m4 l2">
                                <label for="CEP" class="active">CEP</label>
                                <input type="text" id="CEP<?php echo $rowSearchClientAddress->id; ?>" name="CEP" onkeyup="validaFormEditAddress('<?php echo $rowSearchClientAddress->id; ?>')" onBlur="buscaCEPCliente('<?php echo $rowSearchClientAddress->id; ?>')" value="<?php echo $rowSearchClientAddress->CEP; ?>" maxlength="9" class="CEP">
                                <span class="helper-text" id="msgCEP<?php echo $rowSearchClientAddress->id; ?>"></span>
                            </div>

                            <div class="input-field col s9 m6 l4">
                                <label for="address" class="active">Endereço</label>
                                <input type="text" id="address<?php echo $rowSearchClientAddress->id; ?>" name="address" onkeyup="validaFormEditAddress('<?php echo $rowSearchClientAddress->id; ?>')" value="<?php echo $rowSearchClientAddress->address; ?>">
                                <span class="helper-text" id="msgAddress<?php echo $rowSearchClientAddress->id; ?>"></span>
                            </div>

                            <div class="input-field col s3 m2 l2">
                                <label for="number" class="active">Número</label>
                                <input type="text" id="number<?php echo $rowSearchClientAddress->id; ?>" name="number" onkeyup="validaFormEditAddress('<?php echo $rowSearchClientAddress->id; ?>')" value="<?php echo $rowSearchClientAddress->number; ?>">
                                <span class="helper-text" id="msgNumber<?php echo $rowSearchClientAddress->id; ?>"></span>
                            </div>

                            <div class="input-field col s12 m6 l4">
                                <label for="complement" class="active">Complemento</label>
                                <input type="text" id="complement<?php echo $rowSearchClientAddress->id; ?>" name="complement" onkeyup="validaFormEditAddress('<?php echo $rowSearchClientAddress->id; ?>')" value="<?php echo $rowSearchClientAddress->complement; ?>">
                                <span class="helper-text" id="msgComplement<?php echo $rowSearchClientAddress->id; ?>"></span>
                            </div>

                            <div class="input-field col s12 m6 l5">
                                <label for="neighborhood" class="active">Bairro</label>
                                <input type="text" id="neighborhood<?php echo $rowSearchClientAddress->id; ?>" name="neighborhood" onkeyup="validaFormEditAddress('<?php echo $rowSearchClientAddress->id; ?>')" value="<?php echo $rowSearchClientAddress->neighborhood; ?>">
                                <span class="helper-text" id="msgNeighborhood<?php echo $rowSearchClientAddress->id; ?>"></span>
                            </div>

                            <div class="input-field col s9 m10 l5">
                                <label for="city" class="active">Cidade</label>
                                <input type="text" id="city<?php echo $rowSearchClientAddress->id; ?>" name="city" onkeyup="validaFormEditAddress('<?php echo $rowSearchClientAddress->id; ?>')" value="<?php echo $rowSearchClientAddress->city; ?>" readonly>
                                <span class="helper-text" id="msgCity<?php echo $rowSearchClientAddress->id; ?>"></span>
                            </div>

                            <div class="input-field col s3 m2 l2">
                                <label for="UF" class="active">UF</label>
                                <input type="text" id="UF<?php echo $rowSearchClientAddress->id; ?>" name="UF" onkeyup="validaFormAddress('<?php echo $rowSearchClientAddress->id; ?>')" value="<?php echo $rowSearchClientAddress->UF; ?>" readonly>
                                <span class="helper-text" id="msgUF<?php echo $rowSearchClientAddress->id; ?>"></span>
                            </div>



                        </form>
                    </div>

                    <div class="col s12 m12 l12">
                        <a class="btn-floating waves-effect waves-light blue tooltipped right" data-tooltip="Atualizar" id="btnEditClientAddress<?php echo $rowSearchClientAddress->id; ?>" onclick="editClientAddress('<?php echo $rowSearchClientAddress->id; ?>','<?php echo $rowSearchClientAddress->client_id; ?>')" disabled><i class="material-icons">sync</i></a>
                    </div>

                </div>

            </div>





        <?php } ?>
    </tbody>
</table>