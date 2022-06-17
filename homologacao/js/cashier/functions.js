
// ************************** ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 ****************************
function addCashier(){

    $.ajax({
        type: 'GET',
        url: http + main_directory + '/model/cashier/cashier-model.php/?addCashier=1&directory='+directory+'&id_user='+id_user+'&id_company='+id_company+'&id_contract='+id_contract,
        //data : data,
        dataType: 'html',
        success: function (data) {
            showAlert('Caixa Adicionado com sucesso!', 'green', 3000);
            window.location.href = '?pg=cashier';
        },
        error: function () {
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
            alert("Não foi possível completar a requisição!");
        }
    });


}



// ********************** FIM -  ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 **************************