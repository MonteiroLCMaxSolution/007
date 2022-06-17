<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js">
</script>
<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);*/
$domAMI = "";
$domAMF == "";
$segAMI = "";
$segAMF == "";
$terAMI = "";
$terAMF == "";
$quaAMI = "";
$quaAMF == "";
$quiAMI = "";
$quiAMF == "";
$sexAMI = "";
$sexAMF == "";
$sabgAMI = "";
$sabAMF == "";
$domPMI = "";
$domPMF == "";
$segPMI = "";
$segPMF == "";
$terPMI = "";
$terPMF == "";
$quaPMI = "";
$quaPMF == "";
$quiPMI = "";
$quiPMF == "";
$sexPMI = "";
$sexPMF == "";
$sabPMI = "";
$sabPMF == "";


$sha1 = sha1( date( 'd-m-Y H:i:s' ) . "protectedBYgood" );

$ModelCompany = $_SESSION[ 'server' ] . '/model/company/company-model.php';
include_once( $ModelCompany );
$ModelUserPermission = $_SESSION[ 'server' ] . '/model/permission/user-permission.php';
include_once( $ModelUserPermission );

if ( !empty( $ROW_Perm_Register_Company->search ) ) {
  if ( $ROW_Perm_Register_Company->search == 'N' && $ROW_Perm_Register_Company->include == 'N' && $ROW_Perm_Register_Company->edit == 'N' ) {
    $modalPermission = $_COOKIE[ 'server' ] . '/view/modalPermission.php';
    include_once( $modalPermission );
  }
}
// CONFIGURAÇÃO DA TELA 
$start = "09:00";
$end = "23:00";
$km_delivery = '10';

// FIM - CONFIGURAÇÃO DA TELA

if ( !empty( $_GET[ 'bloq' ] ) ) {
  $bloq = $_GET[ 'bloq' ];

} else {
  $bloq = '';
}

?>
<input hidden id="bloq"  value="<?php echo $bloq;?>">
<input hidden id="sha1"  value="<?php echo $sha1;?>">
<section class="register-form">
  <div class="center">
    <div class="section-title">
      <h2>Cadastro de Empresa</h2>
    </div>
    <!--section-title-->
    <form id="formCompany" enctype="multipart/form-data" method="POST" class="flexbox">
      <div class="inp-single w20">
        <p>ID</p>
        <input type="text" readonly value="<?php echo $list_id_sequence; ?>">
        <input id="id" name="id" type="text" readonly hidden value="<?php echo $list_id; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w40">
        <p id="p-cpf_cnpj">CPF / CNPJ</p>
        <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="cpf_cnpj" onkeyup="validaForm();buscaCNPJ(this.value,'validaForm')" value="<?php echo $list_CPF_CNPJ; ?>" <?php if (!empty($list_CPF_CNPJ)) { ?> readonly <?php } ?>>
        <input type="hidden" id="type" name="type" value="<?php echo $list_type; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w40">
        <p id="p-name_razSocial">Nome / Razão social</p>
        <input type="text" id="name_razSocial" name="name_razSocial" onkeyup="validaForm()" value="<?php echo $list_name_razSocial; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w33 formCNPJ">
        <p id="p-fantasia">Nome Fantasia</p>
        <input type="text" id="fantasia" name="fantasia" onkeyup="validaForm()" value="<?php echo $list_fantasia; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w33 formCNPJ">
        <p id="p-insc_municipal">Inscrição Municipal</p>
        <input type="text" id="insc_municipal" name="insc_municipal" onkeyup="validaForm()" value="<?php echo $list_insc_municipal; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w33 formCNPJ">
        <p id="p-insc_estadual">Inscrição Estadual</p>
        <input type="text" id="insc_estadual" name="insc_estadual" onkeyup="validaForm()" value="<?php echo $list_insc_estadual; ?>">
      </div>
      <!--inp-single-->
      
      <div class="form-title w100">
        <h2>Endereço</h2>
      </div>
      <!--form-title-->
      
      <div class="inp-single w30">
        <p id="p-CEP">CEP</p>
        <input type="text" id="CEP" name="CEP" onkeyup="validaForm();buscaCEP('validaForm')" value="<?php echo $list_CEP; ?>" maxlength="9">
      </div>
      <!--inp-single-->
      <div class="inp-single w50">
        <p id="p-address">Endereço</p>
        <input type="text" id="address" name="address" onkeyup="validaForm()" value="<?php echo $list_address; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w20">
        <p id="p-number">Número</p>
        <input type="text" id="number" name="number" onkeyup="validaForm()" value="<?php echo $list_number; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w100">
        <p id="p-complement">Complemento</p>
        <input type="text" id="complement" name="complement" onkeyup="validaForm()" value="<?php echo $list_complement; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w40">
        <p id="p-district">Bairro</p>
        <input type="text" id="district" name="district" onkeyup="validaForm()" value="<?php echo $list_district; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w40">
        <p id="p-city">Cidade</p>
        <input type="text" id="city" name="city" onkeyup="validaForm()" value="<?php echo $list_city; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w20">
        <p id="p-UF">UF</p>
        <input type="text" id="UF" name="UF" maxlength="2" style="text-transform: uppercase"  onkeyup="validaForm()" value="<?php echo $list_UF; ?>">
      </div>
      <!--inp-single-->
      <div class="form-title w100">
        <h2 id="p-contato">Contato</h2>
      </div>
      <!--form-title-->
      <div class="inp-single w50">
        <p id="p-phone">Telefone</p>
        <input type="text" id="phone" name="phone" onkeyup="validaForm()" value="<?php echo $list_phone; ?>" class="phone">
      </div>
      <!--inp-single-->
      <div class="inp-single w50">
        <p id="p-email">Email</p>
        <input type="email" id="email" name="email" onkeyup="validaForm()" value="<?php echo $list_email; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w100">
        <p id="p-site">Site</p>
        <input type="url" id="site" name="site" onkeyup="validaForm()" value="<?php echo $list_site; ?>">
      </div>
      <!--inp-single-->
      
      <div class="form-title w100">
        <h2>Personalizar</h2>
      </div>
      <!--form-title-->
      
      <div class="inp-single w50">
        <p>Cor Primária do Sistema</p>
        <input type="color"  id="color-header" name="color-header" onchange="validaForm()" value="<?php echo $list_color_header; ?>">
      </div>
      <!--inp-single-->
      
      <div class="inp-single w50">
        <p>Cor do texto</p>
        <input type="color" class="color-picker cor-texto" id="color-text" name="color-text" onclick="validaForm()" value="<?php echo $list_color_text; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w50">
        <p id="p-logo">Logo</p>
        <input type="file" id="logo" name="logo" accept=".jpg,.jpeg,.png" onchange="validaForm()">
      </div>
      <!--inp-single-->
      <div class="inp-single w50">
        <p id="p-status">Status</p>
        <select id="status" onchange="validaForm()">
          <option value="Ativo" <?php if ($list_status == "Ativo") {
                                                echo 'selected';
                                            } ?>>Ativo</option>
          <option value="Inativo" <?php if ($list_status == "Inativo") {
                                                echo 'selected';
                                            } ?>>Inativo</option>
        </select>
      </div>
      <!--inp-single--> 
      
      <!-- Delivery - Monteiro - 03/06/2022 -->
      <div class="form-title w100">
        <h2>Horário de entrega do Delivery</h2>
      </div>
      <!--<div class="inp-single w25">
                <p id="p-logo">Entrega</p>
                
            </div>
			<div class="inp-single w25">
                <p id="p-logo">Início</p>
                <input type="time" id="delivery_start" name="delivery_start" onchange="validaForm()">
            </div>
			<div class="inp-single w25">
                <p id="p-logo">Até</p>
                <input type="time" id="delivery_end" name="delivery_end" onchange="validaForm()">
            </div>-->
      <div class="inp-single">
        <p>Entrega</p>
        <input type="checkbox" id="delivery_status" name="delivery_status" value="Ativo" onchange="validaForm()">
      </div>
      <div class="inp-single">
        <p>Inicio</p>
        <input type="text" id="delivery_start" value="<?php echo $start;?>" class="time-picker" placeholder="09:00">
      </div>
      <div class="inp-single">
        <p>Até</p>
        <input type="text" id="delivery_end" value="<?php echo $end;?>" class="time-picker" placeholder="23:00">
      </div>
      <div class="inp-single">
        <p>Raio de entrega</p>
        <input type="text" id="km_delivery" value="<?php echo $km_delivery;?>" placeholder="KM">
      </div>
      <!--raio-de-entrega--> 
      
      <!-- Fim - Delvery -->
      <div class="form-title w100">
        <h2>Horário de funcionamento da sua empresa</h2>
      </div>
      <!--form-title-->
      
      <div class="delivery-box">
      <div class="delivery-single">
        <div class="delivery-single-content flexbox">
          <div class="delivery-single-day flexbox">
            <h3>Domingo</h3>
            <input type="checkbox" class="" name=""   <?php if($domsta == 'Ativo'){?> checked <?php } ?>id="Domingo" value="1" onChange="diaSemana('Domingo');">
          </div>
        </div>
        <BR/>
        <BR/>
        <!--delivery-single-day-->
        <div id="box_Domingo" <?php if($domsta != 'Ativo'){?> style="display: none"<?php } ?>>
          <div class="delivery-single-horary flexbox">
            <div class="inp-single w25">
              <p id="pstartaDomingo">Início</p>
              <input type="text" id="startaDomingo" class="time-picker" value="<?php echo $domAMI;?>" placeholder="09:00"  onChange="updateHors('Domingo')">
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <p id="pendaDomingo">Até</p>
              <input type="text" id="endaDomingo" class="time-picker" value="<?php echo $domAMF;?>" placeholder="23:59" onChange="updateHors('Domingo')">
              <br/>
              <a href="javascript: box2('Domingo_box')">
              <div id="hoursDomingo" <?php if(empty($domAMF)){?> style="display: none"<?php } ?>>+ horas</div>
              </a> </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Domingo_box" <?php if(empty($domPMI)){?> style="display: none"<?php } ?> >
                <p id="pstartbDomingo">Início</p>
                <input type="text" id="startbDomingo" class="time-picker" value="<?php echo $domPMI;?>" placeholder="00:00" onChange="updateHorsb('Domingo')">
              </div>
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Domingo_box" <?php if(empty($domPMI)){?> style="display: none"<?php } ?>>
                <p id="pendbDomingo">Até</p>
                <input type="text"  id="endbDomingo" class="time-picker" value="<?php echo $domPMF;?>" placeholder="00:00" onChange="updateHorsb('Domingo')">
                <br/>
                <div id="dell_box_Domingo" <?php if(empty($domPMF)){?> style="display: none"<?php } ?>><a href="javascript: dellBox('Domingo')">Excluir</a></div>
              </div>
            </div>
            <!--delivery-single-horary--> 
          </div>
          <!--delivery-single-content--> 
        </div>
        <HR/>
      </div>
		  
		  <div class="delivery-single">
        <div class="delivery-single-content flexbox">
          <div class="delivery-single-day flexbox">
            <h3>Segunda</h3>
            <input type="checkbox" class="" name=""   <?php if($segsta == 'Ativo'){?> checked <?php } ?>id="Segunda" value="1" onChange="diaSemana('Segunda');">
          </div>
        </div>
        <BR/>
        <BR/>
        <!--delivery-single-day-->
        <div id="box_Segunda" <?php if($segsta != 'Ativo'){?> style="display: none"<?php } ?>>
          <div class="delivery-single-horary flexbox">
            <div class="inp-single w25">
              <p id="pstartaSegunda">Início</p>
              <input type="text" id="startaSegunda" class="time-picker" value="<?php echo $segAMI;?>" placeholder="09:00"  onChange="updateHors('Segunda')">
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <p id="pendaSegunda">Até</p>
              <input type="text" id="endaSegunda" class="time-picker" value="<?php echo $segAMF;?>" placeholder="23:59" onChange="updateHors('Segunda')">
              <br/>
              <a href="javascript: box2('Segunda_box')">
              <div id="hoursSegunda" <?php if(empty($segAMF)){?> style="display: none"<?php } ?>>+ horas</div>
              </a> </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Segunda_box" <?php if(empty($segPMI)){?> style="display: none"<?php } ?> >
                <p id="pstartbSegunda">Início</p>
                <input type="text" id="startbSegunda" class="time-picker" value="<?php echo $segPMI;?>" placeholder="00:00" onChange="updateHorsb('Segunda')">
              </div>
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Segunda_box" <?php if(empty($segPMI)){?> style="display: none"<?php } ?>>
                <p id="pendbSegunda">Até</p>
                <input type="text"  id="endbSegunda" class="time-picker" value="<?php echo $segPMF;?>" placeholder="00:00" onChange="updateHorsb('Segunda')">
                <br/>
                <div id="dell_box_Segunda" <?php if(empty($segPMF)){?> style="display: none"<?php } ?>><a href="javascript: dellBox('Segunda')">Excluir</a></div>
              </div>
            </div>
            <!--delivery-single-horary--> 
          </div>
          <!--delivery-single-content--> 
        </div>
        <HR/>
      </div>
		  
		  <div class="delivery-single">
        <div class="delivery-single-content flexbox">
          <div class="delivery-single-day flexbox">
            <h3>Terça</h3>
            <input type="checkbox" class="" name=""   <?php if($tersta == 'Ativo'){?> checked <?php } ?>id="Terça" value="1" onChange="diaSemana('Terça');">
          </div>
        </div>
        <BR/>
        <BR/>
        <!--delivery-single-day-->
        <div id="box_Terça" <?php if($tersta != 'Ativo'){?> style="display: none"<?php } ?>>
          <div class="delivery-single-horary flexbox">
            <div class="inp-single w25">
              <p id="pstartaTerça">Início</p>
              <input type="text" id="startaTerça" class="time-picker" value="<?php echo $terAMI;?>" placeholder="09:00"  onChange="updateHors('Terça')">
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <p id="pendaTerça">Até</p>
              <input type="text" id="endaTerça" class="time-picker" value="<?php echo $terAMF;?>" placeholder="23:59" onChange="updateHors('Terça')">
              <br/>
              <a href="javascript: box2('Terça_box')">
              <div id="hoursTerça" <?php if(empty($terAMF)){?> style="display: none"<?php } ?>>+ horas</div>
              </a> </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Terça_box" <?php if(empty($terPMI)){?> style="display: none"<?php } ?> >
                <p id="pstartbTerça">Início</p>
                <input type="text" id="startbTerça" class="time-picker" value="<?php echo $terPMI;?>" placeholder="00:00" onChange="updateHorsb('Terça')">
              </div>
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Terça_box" <?php if(empty($terPMI)){?> style="display: none"<?php } ?>>
                <p id="pendbTerça">Até</p>
                <input type="text"  id="endbTerça" class="time-picker" value="<?php echo $terPMF;?>" placeholder="00:00" onChange="updateHorsb('Terça')">
                <br/>
                <div id="dell_box_Terça" <?php if(empty($terPMF)){?> style="display: none"<?php } ?>><a href="javascript: dellBox('Terça')">Excluir</a></div>
              </div>
            </div>
            <!--delivery-single-horary--> 
          </div>
          <!--delivery-single-content--> 
        </div>
        <HR/>
      </div>
		  
		  <div class="delivery-single">
        <div class="delivery-single-content flexbox">
          <div class="delivery-single-day flexbox">
            <h3>Quarta</h3>
            <input type="checkbox" class="" name=""   <?php if($quasta == 'Ativo'){?> checked <?php } ?>id="Quarta" value="1" onChange="diaSemana('Quarta');">
          </div>
        </div>
        <BR/>
        <BR/>
        <!--delivery-single-day-->
        <div id="box_Quarta" <?php if($quasta != 'Ativo'){?> style="display: none"<?php } ?>>
          <div class="delivery-single-horary flexbox">
            <div class="inp-single w25">
              <p id="pstartaQuarta">Início</p>
              <input type="text" id="startaQuarta" class="time-picker" value="<?php echo $quaAMI;?>" placeholder="09:00"  onChange="updateHors('Quarta')">
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <p id="pendaQuarta">Até</p>
              <input type="text" id="endaQuarta" class="time-picker" value="<?php echo $quaAMF;?>" placeholder="23:59" onChange="updateHors('Quarta')">
              <br/>
              <a href="javascript: box2('Quarta_box')">
              <div id="hoursQuarta" <?php if(empty($quaAMF)){?> style="display: none"<?php } ?>>+ horas</div>
              </a> </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Quarta_box" <?php if(empty($quaPMI)){?> style="display: none"<?php } ?> >
                <p id="pstartbQuarta">Início</p>
                <input type="text" id="startbQuarta" class="time-picker" value="<?php echo $quaPMI;?>" placeholder="00:00" onChange="updateHorsb('Quarta')">
              </div>
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Quarta_box" <?php if(empty($quaPMI)){?> style="display: none"<?php } ?>>
                <p id="pendbQuarta">Até</p>
                <input type="text"  id="endbQuarta" class="time-picker" value="<?php echo $quaPMF;?>" placeholder="00:00" onChange="updateHorsb('Quarta')">
                <br/>
                <div id="dell_box_Quarta" <?php if(empty($quaPMF)){?> style="display: none"<?php } ?>><a href="javascript: dellBox('Quarta')">Excluir</a></div>
              </div>
            </div>
            <!--delivery-single-horary--> 
          </div>
          <!--delivery-single-content--> 
        </div>
        <HR/>
      </div>
		  
		  
		  <div class="delivery-single">
        <div class="delivery-single-content flexbox">
          <div class="delivery-single-day flexbox">
            <h3>Quinta</h3>
            <input type="checkbox" class="" name=""   <?php if($quista == 'Ativo'){?> checked <?php } ?>id="Quinta" value="1" onChange="diaSemana('Quinta');">
          </div>
        </div>
        <BR/>
        <BR/>
        <!--delivery-single-day-->
        <div id="box_Quinta" <?php if($quista != 'Ativo'){?> style="display: none"<?php } ?>>
          <div class="delivery-single-horary flexbox">
            <div class="inp-single w25">
              <p id="pstartaQuinta">Início</p>
              <input type="text" id="startaQuinta" class="time-picker" value="<?php echo $quiAMI;?>" placeholder="09:00"  onChange="updateHors('Quinta')">
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <p id="pendaQuinta">Até</p>
              <input type="text" id="endaQuinta" class="time-picker" value="<?php echo $quiAMF;?>" placeholder="23:59" onChange="updateHors('Quinta')">
              <br/>
              <a href="javascript: box2('Quinta_box')">
              <div id="hoursQuinta" <?php if(empty($quiAMF)){?> style="display: none"<?php } ?>>+ horas</div>
              </a> </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Quinta_box" <?php if(empty($quiPMI)){?> style="display: none"<?php } ?> >
                <p id="pstartbQuinta">Início</p>
                <input type="text" id="startbQuinta" class="time-picker" value="<?php echo $quiPMI;?>" placeholder="00:00" onChange="updateHorsb('Quinta')">
              </div>
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Quinta_box" <?php if(empty($quiPMI)){?> style="display: none"<?php } ?>>
                <p id="pendbQuinta">Até</p>
                <input type="text"  id="endbQuinta" class="time-picker" value="<?php echo $quiPMF;?>" placeholder="00:00" onChange="updateHorsb('Quinta')">
                <br/>
                <div id="dell_box_Quinta" <?php if(empty($quiPMF)){?> style="display: none"<?php } ?>><a href="javascript: dellBox('Quinta')">Excluir</a></div>
              </div>
            </div>
            <!--delivery-single-horary--> 
          </div>
          <!--delivery-single-content--> 
        </div>
        <HR/>
      </div>
		  
		  <div class="delivery-single">
        <div class="delivery-single-content flexbox">
          <div class="delivery-single-day flexbox">
            <h3>Sexta</h3>
            <input type="checkbox" class="" name=""   <?php if($sexsta == 'Ativo'){?> checked <?php } ?>id="Sexta" value="1" onChange="diaSemana('Sexta');">
          </div>
        </div>
        <BR/>
        <BR/>
        <!--delivery-single-day-->
        <div id="box_Sexta" <?php if($sexsta != 'Ativo'){?> style="display: none"<?php } ?>>
          <div class="delivery-single-horary flexbox">
            <div class="inp-single w25">
              <p id="pstartaSexta">Início</p>
              <input type="text" id="startaSexta" class="time-picker" value="<?php echo $sexAMI;?>" placeholder="09:00"  onChange="updateHors('Sexta')">
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <p id="pendaSexta">Até</p>
              <input type="text" id="endaSexta" class="time-picker" value="<?php echo $sexAMF;?>" placeholder="23:59" onChange="updateHors('Sexta')">
              <br/>
              <a href="javascript: box2('Sexta_box')">
              <div id="hoursSexta" <?php if(empty($sexAMF)){?> style="display: none"<?php } ?>>+ horas</div>
              </a> </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Sexta_box" <?php if(empty($sexPMI)){?> style="display: none"<?php } ?> >
                <p id="pstartbSexta">Início</p>
                <input type="text" id="startbSexta" class="time-picker" value="<?php echo $sexPMI;?>" placeholder="00:00" onChange="updateHorsb('Sexta')">
              </div>
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Sexta_box" <?php if(empty($sexPMI)){?> style="display: none"<?php } ?>>
                <p id="pendbSexta">Até</p>
                <input type="text"  id="endbSexta" class="time-picker" value="<?php echo $sexPMF;?>" placeholder="00:00" onChange="updateHorsb('Sexta')">
                <br/>
                <div id="dell_box_Sexta" <?php if(empty($sexPMF)){?> style="display: none"<?php } ?>><a href="javascript: dellBox('Sexta')">Excluir</a></div>
              </div>
            </div>
            <!--delivery-single-horary--> 
          </div>
          <!--delivery-single-content--> 
        </div>
        <HR/>
      </div>
		  
		  <div class="delivery-single">
        <div class="delivery-single-content flexbox">
          <div class="delivery-single-day flexbox">
            <h3>Sábado</h3>
            <input type="checkbox" class="" name=""   <?php if($sabsta == 'Ativo'){?> checked <?php } ?>id="Sabado" value="1" onChange="diaSemana('Sabado');">
          </div>
        </div>
        <BR/>
        <BR/>
        <!--delivery-single-day-->
        <div id="box_Sabado" <?php if($sabsta != 'Ativo'){?> style="display: none"<?php } ?>>
          <div class="delivery-single-horary flexbox">
            <div class="inp-single w25">
              <p id="pstartaSabado">Início</p>
              <input type="text" id="startaSabado" class="time-picker" value="<?php echo $sabAMI;?>" placeholder="09:00"  onChange="updateHors('Sabado')">
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <p id="pendaSabado">Até</p>
              <input type="text" id="endaSabado" class="time-picker" value="<?php echo $sabAMF;?>" placeholder="23:59" onChange="updateHors('Sabado')">
              <br/>
              <a href="javascript: box2('Sabado_box')">
              <div id="hoursSabado" <?php if(empty($sabAMF)){?> style="display: none"<?php } ?>>+ horas</div>
              </a> </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Sabado_box" <?php if(empty($sabPMI)){?> style="display: none"<?php } ?> >
                <p id="pstartbSabado">Início</p>
                <input type="text" id="startbSabado" class="time-picker" value="<?php echo $sabPMI;?>" placeholder="00:00" onChange="updateHorsb('Sabado')">
              </div>
            </div>
            <!--inp-single-->
            <div class="inp-single w25">
              <div class="Sabado_box" <?php if(empty($sabPMI)){?> style="display: none"<?php } ?>>
                <p id="pendbSabado">Até</p>
                <input type="text"  id="endbSabado" class="time-picker" value="<?php echo $sabPMF;?>" placeholder="00:00" onChange="updateHorsb('Sabado')">
                <br/>
                <div id="dell_box_Sabado" <?php if(empty($sabPMF)){?> style="display: none"<?php } ?>><a href="javascript: dellBox('Sabado')">Excluir</a></div>
              </div>
            </div>
            <!--delivery-single-horary--> 
          </div>
          <!--delivery-single-content--> 
        </div>
        <HR/>
      </div>
<!--delivery-single--> 
        
      </div>
      <div class="buttons-box"> <a href="?pg=company">Cancelar</a>
        <button type="submit" id="btnSaveCompany" disabled onclick="saveCompany()">Confirmar</button>
      </div>
      <!--buttons-box-->
      <div class="clear"></div>
    </form>
    <div class="register-infos flexbox">
      <div class="register-info-single w25">
        <p>Data cadastro</p>
        <input type="text" value="<?php if (isset($list_date_register) && $list_date_register != 0) {
                                                echo date("d/m/Y H:i:s", strtotime($list_date_register));
                                            }  ?>" readonly>
      </div>
      <!--register-info-single-->
      <div class="register-info-single w25">
        <p>Usuário cadastro</p>
        <input type="text" value="<?php echo $list_user_register;  ?>" readonly>
      </div>
      <!--register-info-single-->
      <div class="register-info-single w25">
        <p>Última atualização</p>
        <input type="text" value="<?php if (isset($list_last_update) && $list_last_update != 0) {
                                                echo date("d/m/Y H:i:s", strtotime($list_last_update));
                                            } ?>" readonly>
      </div>
      <!--register-info-single-->
      <div class="register-info-single w25">
        <p>Usuário última atualização</p>
        <input type="text" value="<?php echo $list_user_update; ?>" readonly>
      </div>
      <!--register-info-single--> 
    </div>
    <!--register-infos--> 
    
  </div>
  <!--center--> 
</section>
<!--register-form-->