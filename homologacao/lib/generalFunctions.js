// ******************************  FUNÇÃO DE ALERTA - BRUNO R. BERNAL - 11/05/2022 **************************

function showAlert(msg, color, time) {
    if (color == "red") {
        type = "error";
    } else if (color == "green") {
        type = "success";
    } else if (color == "yellow") {
        type = "warning";
    } else {
        type = "info";
    }


    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": time,
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    }

    Command: toastr[type](msg)
}

function loadHide() {
    toastr.clear();
}

function loadShow() {
    showAlert("Por Favor Aguarde...", "yellow", 0);
}

// **************************** FIM - FUNÇÃO DE ALERTA - BRUNO R. BERNAL - 11/05/2022 *************************


// **************************** FUNÇÃO DE VALIDAR INPUT - BRUNO R. BERNAL - 11/05/2022 ************************
function validaInput(id) {
    var input = $("#" + id).val();


    if (id == "email") {
        if (input == "") {
            $("#" + id).css('border', '1px solid red');
            $("#p-" + id).css('color', 'red');
            $("#p-" + id).html('Email: Campo Obrigatório!*');
            return false;
        } else if (validarEmail(input) == false) {
            $("#" + id).css('border', '1px solid red');
            $("#p-" + id).css('color', 'red');
            $("#p-" + id).html('Email: Formato Inválido!*');
            return false;
        } else {
            $("#" + id).css('border', '1px solid #ccc');
            $("#p-" + id).css('color', 'black');
            $("#p-" + id).html('Email');
            return true;
        }
    } else if (id == "phone") {
        if (input == "") {
            $("#" + id).css('border', '1px solid red');
            $("#p-" + id).css('color', 'red');
            $("#p-" + id).html('Telefone: Campo Obrigatório!*');
            return false;
        } else if (input.length < 14) {
            $("#" + id).css('border', '1px solid red');
            $("#p-" + id).css('color', 'red');
            $("#p-" + id).html('Telefone: Formato Inválido!*');
            return false;
        } else {
            $("#" + id).css('border', '1px solid #ccc');
            $("#p-" + id).css('color', 'black');
            $("#p-" + id).html('Telefone');
            return true;
        }
    } else if (id == "cpf_cnpj") {
        if (input == "") {
            $("#cpf_cnpj").css('border', '1px solid red');
            $("#p-cpf_cnpj").css('color', 'red');
            $("#p-cpf_cnpj").html('CPF / CNPJ: Campo Obrigatório!*');
            $("#type").val("");
            return false;
        } else if (input.length < 14 || (input.length > 14 && input.length < 18)) {
            $("#cpf_cnpj").css('border', '1px solid red');
            $("#p-cpf_cnpj").css('color', 'red');
            $("#p-cpf_cnpj").html('CPF / CNPJ: Formato Inválido!*');
            $("#type").val("");
            return false;
        } else if (input.length == 14) {
            $("#p-name_razSocial").text('Nome');
            $(".formCNPJ").hide();
            if (validarCPF(input) == false) {
                $("#cpf_cnpj").css('border', '1px solid red');
                $("#p-cpf_cnpj").css('color', 'red');
                $("#p-cpf_cnpj").html('CPF Inválido!*');
                $("#type").val("");
                return false;
            } else {
                $("#cpf_cnpj").css('border', '1px solid #ccc');
                $("#p-cpf_cnpj").css('color', 'black');
                $("#p-cpf_cnpj").html('CPF Válido!');
                $("#type").val("Física");
                return true;
            }
        } else if (input.length == 18) {
            $("#p-name_razSocial").text('Razão Social');
            $(".formCNPJ").show();
            if (validarCNPJ(input) == false) {
                $("#cpf_cnpj").css('border', '1px solid red');
                $("#p-cpf_cnpj").css('color', 'red');
                $("#p-cpf_cnpj").html('CNPJ Inválido!*');
                $("#type").val("");
                return false;
            } else {
                $("#cpf_cnpj").css('border', '1px solid #ccc');
                $("#p-cpf_cnpj").css('color', 'black');
                $("#p-cpf_cnpj").html('CNPJ Válido!');
                $("#type").val("Jurídica");
                return true;
            }
        }
    } else if(id == "CEP"){
        if (input == "") {
            $("#"+id).css('border', '1px solid red');
            $("#p-"+id).css('color', 'red');
            $("#p-"+id).text('CEP: Campo Obrigatório!*');
            return false;
        } else if (input.length < 9) {
            $("#"+id).css('border', '1px solid red');
            $("#p-"+id).css('color', 'red');
            $("#p-"+id).text('CEP Inválido!*');
            return false;
        } else if (input.length == 9) {
            $("#"+id).css('border', '1px solid #ccc');
            $("#p-"+id).css('color', 'black');
            $("#p-"+id).text('CEP');
            return true;
        }
    } else {
        if (input == "") {
            $("#" + id).css('border', '1px solid red');
            $("#p-" + id).css('color', 'red');
            return false;
        } else {
            $("#" + id).css('border', '1px solid #ccc');
            $("#p-" + id).css('color', 'black');
            return true;
        }
    }

}

// ********************** FIM - FUNÇÃO DE VALIDAR INPUT - BRUNO R. BERNAL - 11/05/2022 ************************


// *********************************************** MÁSCARAS *************************************************
$("#CEP").mask('#####-###');
$(".CEP").mask('#####-###');
$(".CPF").mask('###.###.###-##');
$('.money').mask('#.##0,00', {
    reverse: true
});



var behavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options = {
        onKeyPress: function (val, e, field, options) {
            field.mask(behavior.apply({}, arguments), options);
        }
    };

$('.phone').mask(behavior, options);


var behavior2 = function (val2) {
        return val2.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-00999';
    },
    options2 = {
        onKeyPress: function (val2, e2, field2, options2) {
            field2.mask(behavior2.apply({}, arguments), options2);
        }
    };

$('.cpf_cnpj').mask(behavior2, options2);
// ******************************************** FIM - MÁSCARAS **********************************************
