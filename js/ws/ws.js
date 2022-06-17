function valid_folder(str){
    
 var find = ["ã","à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","ö","ô","ù","ú","ü","û","ñ","ç"]; "à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","ö","ô","ù","ú","ü","û","ñ","ç"
 var replace = ["a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","u","u","u","u","n","c"];

    for (var i = 0; i < find.length; i++) {
        str = str.replace(new RegExp(find[i], 'gi'), replace[i]);
    }
	str = str.replace(/\s+/g, '-').toLowerCase();
	//str = str.substring(0, str.length - 1)
	alert('chamou valid_folder');
	$.ajax({
		url: 'curl_folder.php/?valid_folder=1&folder='+str,
		type: 'GET',
		dataType: 'json',
		success: function(data){
			$("#namefolder").html(data.message);
		},error: function(){
			alert('erro ao acessar o sistema');
		}
	})
}
// BTN PARA SALVAR OS DADOS - LEÔNIDAS MONTEIRO - 05/01/2022
function btnRecord(){
	
	var folders = '';
	
	var folder = $("#folder").val();
	var find = ["ã","à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","ö","ô","ù","ú","ü","û","ñ","ç"]; "à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","ö","ô","ù","ú","ü","û","ñ","ç"
 var replace = ["a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","u","u","u","u","n","c"];

    for (var i = 0; i < find.length; i++) {
        folder = folder.replace(new RegExp(find[i], 'gi'), replace[i]);
    }
	folders = folder.replace(/\s+/g, '-').toLowerCase();
	
	var name_contact = $("#name_contact").val();
	var mail_contact = $("#mail_contact").val();
	var whatsapp = $("#WhatsApp").val();
	var CNPJ_CPF = $("#CNPJ_CPF").val();
	var CEP = $("#CEP").val();
	$.ajax({
		url: 'curl_folder.php/?btnRecord=1&CNPJ_CPF='+CNPJ_CPF+'&folder='+folder+'&name_contact='+name_contact+'&mail_contact='+mail_contact+'&whatsapp='+whatsapp+'&CEP='+CEP+'&folders='+folders,
		type: 'GET',
		dataType: 'json',
		success: function(data){
			if(data.code == 1){ // reprovado
				alert(data.message);
			}else{// aprovado
				//alert('Passo 1 '+data.directory);
				create_directory(data.directory,data.sha1_service,data.dbHost,data.dbName,data.dbUser,data.dbPass);
			}
		},error: function(){
			alert('erro ao acessar o sistema');
		}
	})
}
// .BTN PARA SALVAR OS DADOS
// FUNCTION PARA CRIAR PASTA E OS ARQUIVOS DO CLIENTE - LEÔNIDAS MONTEIRO - 11/01/2022
function create_directory(directory,sha1_service,dbHost,dbName,dbUser,dbPass){
	
	alert('chamou create_directory');
	$.ajax({
		url: 'create_directory.php/?create_directory=1&directory='+directory+'&sha1_service='+sha1_service+'&dbHost='+dbHost+'&dbName='+dbName+'&dbUser='+dbUser+'&dbPass='+dbPass,
		type: 'GET',
		dataType: 'html',
		success: function(){
			alert('Pasta Criada com sucesso, clique para acessar sua loja!');
			$('#result').html('<a href="https://maxcomanda.com.br/'+directory+'">https://maxcomanda.com.br/'+directory+'</a>');
		},error: function(){
			alert('erro ao acessar o sistema');
		}
	})
}

// .FUNCTION PARA CRIAR PASTA E OS ARQUIVOS DO CLIENTE
// FUNCTION PARA VERIFICAR O STATUS DO PAGAMENTO DO SERVIÇO DO CLIENTE - LEÔNIDAS MONTEIRO - 12/01/2022
function payment_status(clientService,folder){
	$.ajax({
		url: 'https://maxcomanda.com.br/WS/curl_folder.php/?payment_status=1&clientService='+clientService+'&folder='+folder,
		type: 'GET',
		dataType: 'json',
		success: function(data){
			if(data.code == 1){
				$("#divLogado").show();
				$("#module").val(data.tab_mod);
			}else{
				$("#divNegado").show();
			}
			//$('#result').html('<a href="https://maxcomanda.com.br/'+directory+'">https://maxcomanda.com.br/'+directory+'</a>');
		},error: function(){
			alert('erro ao acessar o sistema');
		}
	})
}

// .FUNCTION PARA VERIFICAR O STATUS DO PAGAMENTO DO SERVIÇO DO CLIENTE 
