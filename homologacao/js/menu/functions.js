var http = $("#http").val();
var directory = $("#directory").val();

// ************************* LISTAR CARDÁPIO LOCAL - BRUNO R. BERNAL - 15/02/2022 ******************************

function listMenu(){
    var idCompany = $("#idCompany").val();

    if(idCompany == undefined){
        var idCompany = $("#company").val();
    }

    alert(idCompany);


    if(idCompany == ""){
        showAlert('Selecione uma empresa para ver o Cardápio!', 'red', 3000);
    } else{

        $.ajax({
            type: 'GET',
            url: '../../MaxComanda/controller/cardapio/list-menu-local.php/?listMenuLocal=1&directory='+directory+'&idCompany='+idCompany,
            //data : data,
            dataType: 'html',
            success: function (data) {
                showAlert('Bem-vindo(a)!', 'green', 3000);
                $('#listMenu').html(data);
                $("#modalSelectCompany").modal('close');
            },
            error: function () {
                showAlert('Não foi possível completar a requisição!', 'red', 3000);
            }
        });
    }
}

// ****************** FIM - LISTAR CARDÁPIO LOCAL - BRUNO R. BERNAL - 15/02/2022 ******************************