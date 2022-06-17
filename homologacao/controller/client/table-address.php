<?php

$clientModel = $_COOKIE['server'] . '/model/client/client-model.php';
include_once($clientModel);

$ModelUserPermission = $_COOKIE['server'] . '/model/permission/user-permission.php';
include_once($ModelUserPermission);


?>

<table id="tableClientAddress">
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
                <td><?php echo $rowSearchClientAddress->district; ?></td>
                <td><?php echo $rowSearchClientAddress->city; ?></td>
                <td><?php echo $rowSearchClientAddress->UF; ?></td>
                <td><?php echo $rowSearchClientAddress->last_update; ?></td>
                <td>

                    <?php if ($ROW_Perm_Register_Client->edit == 'S') { ?>
                        <a onclick="editAddress('<?php echo $rowSearchClientAddress->id; ?>','<?php echo $rowSearchClientAddress->CEP; ?>','<?php echo $rowSearchClientAddress->address; ?>','<?php echo $rowSearchClientAddress->number; ?>','<?php echo $rowSearchClientAddress->complement; ?>','<?php echo $rowSearchClientAddress->district; ?>','<?php echo $rowSearchClientAddress->city; ?>','<?php echo $rowSearchClientAddress->UF; ?>')">
                            <i class="fas fa-edit i-edit"></i>
                        </a>

                        <a onclick="deleteClientAddress('<?php echo $rowSearchClientAddress->id; ?>','<?php echo $rowSearchClientAddress->client_id; ?>')">
                            <i class="fas fa-window-close"></i>
                        </a>
                    <?php } ?>

                </td>
            </tr>

        <?php } ?>
    </tbody>
</table>