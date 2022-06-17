var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// *************************************** LISTAR COMANDA - BRUNO R. BERNAL - 21/01/2022 *********************

function listOrderSheet() {

    $.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/order-sheet/table.php/?listOrderSheet=1&directory='+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                //showAlert('Comanda Adicionada com sucesso!','green',3000);
				//window.location.href = http + '/view/?pg=order-sheet';
				$("#listOrderSheet").html(data);				
			},error: function(){
                //showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});
}



// ************************************* FIM - LISTAR COMANDA - BRUNO R. BERNAL - 21/01/2022 ****************

// ************************************ MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 *****************
function statusOrderSheet(id) {
    var id = id;
    var status = $("#status"+id).is(':checked'); 

    if(status == true){
        var status = "Ativo";
    } else{
        var status = "Inativo";
    }


    $.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/order-sheet/table.php/?statusOrderSheet='+status+'&id='+id+'&directory='+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Status Atualizado com sucesso!','green',3000);
				window.location.href = http + '/view/?pg=order-sheet';				
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}
// ********************************* FIM - MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 *************

// *************************************** ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 *********************

function addOrderSheet() {

    $.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/order-sheet/table.php/?addOrderSheet=1&directory='+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Comanda Adicionada com sucesso!','green',3000);
				window.location.href = http + '/view/?pg=order-sheet';				
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});
}



// ************************************* FIM - ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 ****************