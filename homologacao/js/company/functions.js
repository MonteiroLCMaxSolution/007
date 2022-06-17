$.switcher();

$('.time-picker').clockTimePicker();

// ******* DELETAR O BOXB - MONTEIRO - 08/06/2022
function dellBox(str) {
  $("#startb" + str).val('');
  $("#endb" + str).val('');
  $("." + str + "_box").hide();

  var sha1 = $("#sha1").val();
  var formData = "";
  formData = new FormData();
  formData.append("period", "PM");
  formData.append("sha1", sha1);
  formData.append("day", str);

  $.ajax({
    url: http + main_directory + "/model/company/company-model.php/?dellBox=1",
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    beforeSend: function () {
      loadShow();
    },
    success: function (response) {
      loadHide();
      showAlert(response.msg, 'green', 3000);
    },
    error: function () {
      loadHide();
      showAlert('Não foi possivel completar a requisição!', 'red', 3000);
    }
  })

}
// ******* FIM - DELETAR O BOX2

// ******* CHAMAR BOX DO DIA DA SEMANA - MONTEIRO - 08/06/2022
function diaSemana(diaSemana) {
	alert(diaSemana);
  var startaDomingo = $("#starta"+diaSemana).val();
  var endaDomingo = $("#enda"+diaSemana).val();
  var startbDomingo = $("#startb"+diaSemana).val();
  var endbDomingo = $("#endb"+diaSemana).val();

  if ($("#" + diaSemana).is(':checked')) {
    $("#box_" + diaSemana).show();


  } else {
    $("#box_" + diaSemana).hide();
    $("." + diaSemana + "_box").hide();
  }
  updateHors(diaSemana);
  updateHorsb(diaSemana);
}
// ******* FIM - CHAMAR BOX DO DIA DA SEMANA

// ******* CHAMA O BOX2 DO DIA DA SEMANA - MONTEIRO - 08/06/2022
function box2(box2) {
  $("." + box2).show();
}
// ******* FIM - CHAMA O BOX2 DO DIA DA SEMANA 

// ******* ATUALIZA HORAS DE FUNCIONAMENTO - MONTEIRO - 08/06/2022
function updateHors(str) {
  var starta = $("#starta" + str).val();
  var enda = $("#enda" + str).val();
  var lockbtn = '';
  var btnChecked = "";
  var sha1 = $("#sha1").val();
  if ($("#" + str).is(':checked')) {
    btnChecked = "Ativo";
  } else {
    btnChecked = "Inativo";
  }
  if (starta == "" || enda == "") {
    if (starta == "") {
      $("#starta" + str).css("border", "1px solid red");
      $("#pstarta" + str).css("color", "red");
      $("#pstarta" + str).html("Início (Campo obrigatório)");
    } else {
      $("#starta" + str).css("border", "1px solid black");
      $("#pstarta" + str).css("color", "black");
      $("#pstarta" + str).html("Início");
    }
    if (enda == "") {
      $("#enda" + str).css("border", "1px solid red");
      $("#penda" + str).css("color", "red");
    } else {

      $("#enda" + str).css("border", "1px solid black");
      $("#penda" + str).css("color", "black");
      $("#penda" + str).html("Até");
    }
  } else {
    // gravar
    $("#starta" + str).css("border", "1px solid black");
    $("#pstarta" + str).css("color", "black");
    $("#enda" + str).css("border", "1px solid black");
    $("#penda" + str).css("color", "black");

    $("#penda" + str).html("Até");

    var diffInMinutes = moment(enda, "HH:mm").diff(moment(starta, "HH:mm"), 'minutes');
  }
  if (diffInMinutes >= 60 || btnChecked == "Inativo") {
    var formData = "";
    formData = new FormData();
    formData.append("period", "AM");
    formData.append("sha1", sha1);
    formData.append("day", str);
    formData.append("open", starta);
    formData.append("close", enda);
    formData.append("status", btnChecked);
    formData.append("folder", directory);
    $.ajax({
      url: http + main_directory + '/model/company/company-model.php/?updateHors=1',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      beforeSend: function () {
        loadShow();
      },
      success: function (response) {
		  $("#hours"+str).show();
        loadHide();
        showAlert(response.msg, 'green', 3000);
      },
      error: function () {
		  $("#hours"+str).hide();
        loadHide();
        showAlert('Não foi possivel completar a requisição!', 'red', 3000);
      }
    })
  } else {
    $("#enda" + str).css("border", "1px solid red");
    $("#penda" + str).css("color", "red");
    $("#penda" + str).html("Deve ser superior a 1 hora!");
  }

}

function updateHorsb(str) {
  var end = $("#enda" + str).val();
  var starta = $("#startb" + str).val();
  var enda = $("#endb" + str).val();
  var lockbtn = '';
  var btnChecked = "";
  var sha1 = $("#sha1").val();
  var diffHoursAM = moment(starta, "HH:mm").diff(moment(end, "HH:mm"), 'minutes');
  if (diffHoursAM >= 60) {

    if ($("#" + str).is(':checked')) {
      btnChecked = "Ativo";
    } else {
      btnChecked = "Inativo";
    }
    if (starta == "" || enda == "") {
      if (starta == "") {
        $("#startb" + str).css("border", "1px solid red");
        $("#pstartb" + str).css("color", "red");
      } else {
        $("#startb" + str).css("border", "1px solid black");
        $("#pstartb" + str).css("color", "black");
        $("#pstartb" + str).html("Início");
      }
      if (enda == "") {
        $("#endb" + str).css("border", "1px solid red");
        $("#pendb" + str).css("color", "red");
      } else {

        $("#endb" + str).css("border", "1px solid black");
        $("#pendb" + str).css("color", "black");
      }
    } else {
      // gravar
      $("#startb" + str).css("border", "1px solid black");
		 $("#pstartb" + str).html("Início");
      $("#pstartb" + str).css("color", "black");
      $("#endb" + str).css("border", "1px solid black");
      $("#pendb" + str).css("color", "black");
      var diffInMinutes = moment(enda, "HH:mm").diff(moment(starta, "HH:mm"), 'minutes');
    }
    if (diffInMinutes >= 60 || btnChecked == "Inativo") {
      var formData = "";
      formData = new FormData();
      formData.append("period", "PM");
      formData.append("sha1", sha1);
      formData.append("day", str);
      formData.append("open", starta);
      formData.append("close", enda);
      formData.append("status", btnChecked);
      formData.append("folder", directory);
      $.ajax({
        url: http + main_directory + '/model/company/company-model.php/?updateHors=1',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
          loadShow();
        },
        success: function (response) {
			$("#dell_box_"+str).show();
          loadHide();
          showAlert(response.msg, 'green', 3000);
        },
        error: function () {
			
			$("#dell_box_"+str).hide();
          loadHide();
          showAlert('Não foi possivel completar a requisição!', 'red', 3000);
        }
      })
    } else {
      $("#endb" + str).css("border", "1px solid red");
      $("#pendb" + str).css("color", "red");
    }
  } else {
    $("#startb" + str).css("border", "1px solid red");
    $("#pstartb" + str).css("color", "red");
    $("#pstartb" + str).html('Deve ser superior a 1 hora!');
  }

}
// ******* - FIM - ATUALIZA HORAS DE FUNCIONAMENTO

// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 14/01/2022 ****************
function validaForm() {
  var lockbtn = "";

  if (validaInput("status") == false) {
    lockbtn = 1;
  }

  if (validaInput("email") == false) {
    lockbtn = 1;
  }

  if (validaInput("phone") == false) {
    lockbtn = 1;
  }

  if (validaInput("UF") == false) {
    lockbtn = 1;
  }

  if (validaInput("city") == false) {
    lockbtn = 1;
  }

  if (validaInput("district") == false) {
    lockbtn = 1;
  }

  if (validaInput("number") == false) {
    lockbtn = 1;
  }

  if (validaInput("address") == false) {
    lockbtn = 1;
  }

  if (validaInput("CEP") == false) {
    lockbtn = 1;
  }

  if (validaInput("cpf_cnpj") == false) {
    lockbtn = 1;
  }

  if (validaInput("name_razSocial") == false) {
    lockbtn = 1;
  }


  if (lockbtn == "") {
    $("#btnSaveCompany").attr('disabled', false);
  } else {
    $("#btnSaveCompany").attr('disabled', true);
  }

}

// ********************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 14/01/2022 ****************


// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 14/01/2022 *********************

function saveCompany() {
  var formData = '';
  var bloq = $("#bloq").val();
  var id = $("#id").val();
  var type = $("#type").val();
  var cpf_cnpj = $("#cpf_cnpj").val();
  var name_razSocial = $("#name_razSocial").val();
  var fantasia = $("#fantasia").val();
  var insc_municipal = $("#insc_municipal").val();
  var insc_estadual = $("#insc_estadual").val();
  var CEP = $("#CEP").val();
  var address = $("#address").val();
  var number = $("#number").val();
  var complement = $("#complement").val();
  var district = $("#district").val();
  var city = $("#city").val();
  var UF = $("#UF").val();
  var phone = $("#phone").val();
  var email = $("#email").val();
  var site = $("#site").val();
  var status = $("#status").val();
  var color_header = $("#color-header").val();
  var color_text = $("#color-text").val();
  var logo = $('#logo')[0].files[0];
  var delivery_status = $("#delivery_status").val();
  var delivery_start = $("#delivery_start").val();
  var delivery_end = $("#delivery_end").val();
  var km_delivery = $("#km_delivery").val();
  var sha1 = $("#sha1").val();

  formData = new FormData();
  formData.append('bloq', bloq);
  formData.append('id', id);
  formData.append('type', type);
  formData.append('cpf_cnpj', cpf_cnpj);
  formData.append('name_razSocial', name_razSocial);
  formData.append('fantasia', fantasia);
  formData.append('insc_municipal', insc_municipal);
  formData.append('insc_estadual', insc_estadual);
  formData.append('CEP', CEP);
  formData.append('address', address);
  formData.append('number', number);
  formData.append('complement', complement);
  formData.append('district', district);
  formData.append('city', city);
  formData.append('UF', UF);
  formData.append('phone', phone);
  formData.append('email', email);
  formData.append('site', site);
  formData.append('status', status);
  formData.append('color_header', color_header);
  formData.append('color_text', color_text);
  formData.append('logo', logo);
  formData.append('request', 1);
  formData.append('id_contract', id_contract);
  formData.append('id_user', id_user);
  formData.append('id_company', id_company);
  formData.append('directory', directory);
  formData.append('delivery_status', delivery_status);
  formData.append('delivery_start', delivery_start);
  formData.append('delivery_end', delivery_end);
  formData.append('km_delivery', km_delivery);
  formData.append('sha1', sha1);

  $.ajax({

    url: http + main_directory + '/model/company/company-model.php/?saveCompany=1',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    beforeSend: function () {
      loadShow();
      $("#btnSaveCompany").attr('disabled', true);
    },
    success: function (response) {
      if (response.codigo == 1) {
        loadHide();
        showAlert(response.mensagem, 'green', 3000);
        window.location.href = '?pg=company';
      } else {
        if (response.codigo == 0) {
          loadHide();
          showAlert('Erro: ' + response.mensagem, 'red', 3000);
          $("#btnSaveCompany").attr('disabled', false);
        } else {
          loadHide();
          showAlert(response.mensagem, 'green', 3000);
          window.location.href = '../';
        }
      }
    },
    error: function () {
      loadHide();
      showAlert('Não foi possivel completar a requisição!', 'red', 3000);
      $("#btnSaveCompany").attr('disabled', false);
    }
  });


}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 14/01/2022 ****************

// ********************************* PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 ************************

function searchCompany() {
  var companyName = $("#companyName").val();
  $.ajax({
    type: 'POST',
    url: http + main_directory + '/controller/company/table.php/?searchCompany=1',
    data: 'companyName=' + companyName + '&id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
    dataType: 'html',
    success: function (data) {
      showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
      $('#listCompany').html(data);
    },
    error: function () {
      showAlert('Não foi possível completar a requisição!', 'red', 3000);
    }
  });

}

// ****************************** FIM - PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 ***********************
