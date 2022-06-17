var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// ************************** ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 ****************************
function addCashier(){


    $.ajax({
        type: 'GET',
        url: '../../MaxComanda/model/cashier/cashier-model.php/?addCashier=1&directory='+directory+'&id_user='+id_user+'&id_company='+id_company,
        //data : data,
        dataType: 'html',
        success: function (data) {
            showAlert('Caixa Adicionado com sucesso!', 'green', 3000);
            window.location.href = http + '/view/?pg=cashier';
        },
        error: function () {
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });


}



// ********************** FIM -  ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 **************************