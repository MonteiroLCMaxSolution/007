var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();


// ***************************** MUDAR OS VALORES DOS CHECKBOX QUANDO CLICAR EM PERMISSÃO TOTAL **************

function fullPermission(id){
    var id = id;
    var full_permission = $("#full_permission"+id).prop("checked");

    

    if(full_permission == true){
        if($("#search"+id).prop("checked",false)){
            $("#search"+id).prop("checked",true);
        }

        if($("#include"+id).prop("checked",false)){
            $("#include"+id).prop("checked",true);
        }

        if($("#edit"+id).prop("checked",false)){
            $("#edit"+id).prop("checked",true);
        }
    }
    
    if(full_permission == false){
        if($("#search"+id).prop("checked",true)){
            $("#search"+id).prop("checked",false);
        }

        if($("#include"+id).prop("checked",true)){
            $("#include"+id).prop("checked",false);
        }

        if($("#edit"+id).prop("checked",true)){
            $("#edit"+id).prop("checked",false);
        }
    }

    
}

function verifypermission(id){
    var id = id;
    var search = $("#search"+id).prop("checked");
    var include = $("#include"+id).prop("checked");
    var edit = $("#edit"+id).prop("checked");

    if(search == false || include == false || edit == false){
        $("#full_permission"+id).prop("checked",false);
    }

    if(search == true && include == true && edit == true){
        $("#full_permission"+id).prop("checked",true);
    }



    
}



// ***************************** FIM - MUDAR OS VALORES DOS CHECKBOX QUANDO CLICAR EM PERMISSÃO TOTAL ***********

// ****************************** HABILITAR BOTÃO SALVAR ******************************************
function unlockBtn(id){
    var id = id;


    $("#btnSavePermission"+id).attr('disabled', false);

}

// ****************************** FIM - HABILITAR BOTÃO SALVAR ******************************************

// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 *********************

function savePermission(id) {
    var id = id;
    var full_permission = $("#full_permission"+id).is(':checked'); 
    var search = $("#search"+id).is(':checked'); 
    var include = $("#include"+id).is(':checked'); 
    var edit = $("#edit"+id).is(':checked'); 

    if(full_permission == true){
        var full_permission = "S";
    } else{
        var full_permission = "N";
    }

    if(search == true){
        var search = "S";
    } else{
        var search = "N";
    }

    if(include == true){
        var include = "S";
    } else{
        var include = "N";
    }

    if(edit == true){
        var edit = "S";
    } else{
        var edit = "N";
    }



    $.ajax({

        url: "../../MaxComanda/model/permission/permission-model.php/?savePermission=1&directory="+directory+"&idPermission="+id+"&full_permission="+full_permission+"&search="+search+"&include="+include+"&edit="+edit+'&id_user='+id_user+'&id_company='+id_company,
        type: 'GET',
       //data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSavePermission"+id).attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                //window.location.href = http + '/view/?pg=profile';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSavePermission"+id).attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSavePermission"+id).attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 ****************