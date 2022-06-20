<?php
require_once('../../functions.php');


/*
*
*
* EXIBIR PRIMEIRO OS PARÂMETROS OBRIGATÓRIOS E DEPOIS OS OPCIONAIS DO ANÚNCIO
*
*
*/
?>
<h3 class="text-center"><b>Atributos do Anúncio</b></h3>

<div class="card text-center" style="margin-bottom: 15px">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item" style="width: 50%">
                <a class="nav-link active" id="obrigatorios-tab" data-toggle="tab" href="#obrigatorios" role="tab" aria-controls="obrigatorios" aria-selected="true">Obrigatórios</a>
            </li>
            <li class="nav-item" style="width: 50%">
                <a class="nav-link" id="opcionais-tab" data-toggle="tab" href="#opcionais" role="tab" aria-controls="opcionais" aria-selected="false">Opcionais</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="obrigatorios" role="tabpanel" aria-labelledby="obrigatorios-tab">

                <?php
                $count = 0;
                foreach ($attributes as $key => $value) {
                    $inputID = $attributes[$key]['id'];
                    $inputLabel = $attributes[$key]['name'];

                    // --- VERIFICAR SE A INFORMAÇÃO É OBRIGATÓRIA OU OPCIONAL ---
                    if (array_key_exists("required", $attributes[$key]['tags'])) {
                        $required = 'required'; // OBRIGATÓRIO
                        $textoRequired = "Obrigatório";
                        //continue;
                    } else {
                        $required = ""; // OPCIONAL
                        $textoRequired = "Opcional";
                        continue;
                    }
                    $count++;

                    // --- VERIFICAR SE O VALOR É 'LIVRE' OU PRÉ-DETERMINADO (PARA FAZER SELECT OU INPUT) ---
                    if (array_key_exists("values", $attributes[$key])) {
                        $values = true; // VALOR PRÉ-DETERMINADO (SELECT)
                        $textoValues = "Possui Valores Pré-Determinados:";
                    } else {
                        $values = false; // VALOR 'LIVRE' (INPUT)
                        $textoValues = "Não Possui Valores Pré-Determinados";
                    }

                    // --- VERIFICAR O TIPO DE VALOR ---
                    $valueType = $attributes[$key]['value_type'];

                    /*
    *
    * -> OBSERVAÇÃO: SE O VALUE_TYPE FOR 'BOOLEAN' OU 'LIST', DEVERÁ LISTAR OS VALUES NO SELECT OBRIGATORIAMENTE.
    *   SE FOR 'STRING', 'NUMBER' OU 'NUMBER_UNIT', OS VALUES SÃO APENAS UMA SUGESTÃO.
    *
    */

                    // --- VERIFICAR COMPRIMENTO MÁXIMO PERMITIDO ---
                    $maxLength = $attributes[$key]['value_max_length'];


                ?>
                    <?php if ($valueType == 'string' || $valueType == 'number') {
                        if ($valueType == 'number') {
                            $type = 'number';
                        } else {
                            $type = 'text';
                        }
                    ?>

                        <div class="form-group">
                            <label class="control-label" for="<?php echo $inputID; ?>">
                                <?php echo $inputLabel; ?>
                            </label>
                            <input class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID; ?>" name="<?php echo $inputID; ?>" type="<?php echo $type; ?>" maxlength="<?php echo $maxLength; ?>" onkeyup="validaForm()" />
                        </div>

                    <?php } else if ($valueType == 'number_unit') { ?>
                        <label class="control-label" for="<?php echo $inputID; ?>" hidden><?php echo $inputLabel; ?></label>
                        <label class="control-label" style="float: right" for="<?php echo $inputID . "Unit"; ?>" hidden><?php echo $inputLabel . " - Unidade"; ?></label>
                        <div class="input-group" style="margin-bottom: 15px">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $inputLabel; ?></span>
                            </div>
                            <input type="number" class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID; ?>" name="<?php echo $inputID; ?>" onkeyup="validaForm()" maxlength="<?php echo $maxLength; ?>">
                            <select class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID . 'Unit'; ?>" name="<?php echo $inputID . 'Unit'; ?>" onchange="validaForm()">
                                <option value="">Selecione a Unidade ...</option>
                                <?php
                                foreach ($attributes[$key]['allowed_units'] as $key3 => $value3) { ?>
                                    <option value="<?php echo $value3['id']; ?>"><?php echo $value3['name']; ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                    <?php } else if ($valueType == 'list' || $valueType == 'boolean') { ?>

                        <div class="form-group">
                            <label class="control-label" for="<?php echo $inputID; ?>">
                                <?php echo $inputLabel; ?>
                            </label>
                            <select class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID; ?>" name="<?php echo $inputID; ?>" onchange="validaForm()">
                                <option value="">Selecione...</option>
                                <?php
                                foreach ($attributes[$key]['values'] as $key2 => $value2) { ?>
                                    <option value="<?php echo $value2['name']; ?>"><?php echo $value2['name']; ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                    <?php } ?>

                <?php

                } if($count < 1){
                    echo "<h4 class='text-center'><b>Não há Atributos Obrigatórios para esta Categoria!</b></h4>";
                    echo "<small class='form-text text-muted text-center'>Mas você pode preencher os Atributos Opcionais para deixar seu anúncio ainda mais completo e ganhar mais Visibilidade!</small>";
                }

                ?>


            </div> <!-- .PARÂMETROS OBRIGATÓRIOS -->

            <div class="tab-pane fade" id="opcionais" role="tabpanel" aria-labelledby="opcionais-tab">


                <?php
                foreach ($attributes as $key => $value) {
                    $inputID = $attributes[$key]['id'];
                    $inputLabel = $attributes[$key]['name'];

                    // --- VERIFICAR SE A INFORMAÇÃO É OBRIGATÓRIA OU OPCIONAL ---
                    if (array_key_exists("required", $attributes[$key]['tags'])) {
                        $required = 'required'; // OBRIGATÓRIO
                        $textoRequired = "Obrigatório";
                        continue;
                    } else {
                        $required = ""; // OPCIONAL
                        $textoRequired = "Opcional";
                    }

                    // --- VERIFICAR SE O VALOR É 'LIVRE' OU PRÉ-DETERMINADO (PARA FAZER SELECT OU INPUT) ---
                    if (array_key_exists("values", $attributes[$key])) {
                        $values = true; // VALOR PRÉ-DETERMINADO (SELECT)
                        $textoValues = "Possui Valores Pré-Determinados:";
                    } else {
                        $values = false; // VALOR 'LIVRE' (INPUT)
                        $textoValues = "Não Possui Valores Pré-Determinados";
                    }

                    // --- VERIFICAR O TIPO DE VALOR ---
                    $valueType = $attributes[$key]['value_type'];

                    /*
    *
    * -> OBSERVAÇÃO: SE O VALUE_TYPE FOR 'BOOLEAN' OU 'LIST', DEVERÁ LISTAR OS VALUES NO SELECT OBRIGATORIAMENTE.
    *   SE FOR 'STRING', 'NUMBER' OU 'NUMBER_UNIT', OS VALUES SÃO APENAS UMA SUGESTÃO.
    *
    */

                    // --- VERIFICAR COMPRIMENTO MÁXIMO PERMITIDO ---
                    $maxLength = $attributes[$key]['value_max_length'];


                ?>
                    <?php if ($valueType == 'string' || $valueType == 'number') {
                        if ($valueType == 'number') {
                            $type = 'number';
                        } else {
                            $type = 'text';
                        }
                    ?>

                        <div class="form-group">
                            <label class="control-label" for="<?php echo $inputID; ?>">
                                <?php echo $inputLabel; ?>
                            </label>
                            <input class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID; ?>" name="<?php echo $inputID; ?>" type="<?php echo $type; ?>" maxlength="<?php echo $maxLength; ?>" onkeyup="validaForm()" />
                        </div>

                    <?php } else if ($valueType == 'number_unit') { ?>
                        <label class="control-label" for="<?php echo $inputID; ?>" hidden><?php echo $inputLabel; ?></label>
                        <label class="control-label" style="float: right" for="<?php echo $inputID . "Unit"; ?>" hidden><?php echo $inputLabel . " - Unidade"; ?></label>
                        <div class="input-group" style="margin-bottom: 15px">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $inputLabel; ?></span>
                            </div>
                            <input type="number" class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID; ?>" name="<?php echo $inputID; ?>" onkeyup="validaForm()" maxlength="<?php echo $maxLength; ?>">
                            <select class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID . 'Unit'; ?>" name="<?php echo $inputID . 'Unit'; ?>" onchange="validaForm()">
                                <option value="">Selecione a Unidade ...</option>
                                <?php
                                foreach ($attributes[$key]['allowed_units'] as $key3 => $value3) { ?>
                                    <option value="<?php echo $value3['id']; ?>"><?php echo $value3['name']; ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                    <?php } else if ($valueType == 'list' || $valueType == 'boolean') { ?>

                        <div class="form-group">
                            <label class="control-label" for="<?php echo $inputID; ?>">
                                <?php echo $inputLabel; ?>
                            </label>
                            <select class="form-control <?php echo $required; ?> formCategory" <?php echo $required; ?> id="<?php echo $inputID; ?>" name="<?php echo $inputID; ?>" onchange="validaForm()">
                                <option value="">Selecione...</option>
                                <?php
                                foreach ($attributes[$key]['values'] as $key2 => $value2) { ?>
                                    <option value="<?php echo $value2['name']; ?>"><?php echo $value2['name']; ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                    <?php } ?>

                <?php

                }

                ?>


            </div> <!-- .PARÂMETROS OPCIONAIS -->
        </div>
    </div>
</div>