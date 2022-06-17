$.switcher();

$('.select-local').select2({
    width: 99999
})

$('.select-subcategoria').select2({
    width: 99999
})

// FORMULÁRIO PRINCIPAL

function validarFormulario(){

    var local = document.querySelector("#select-local-produto").value;
    var subcategoria = document.querySelector("#select-subcategoria-produto").value;
	var nome = document.querySelector("#nome-produto").value;
    var descricao = document.querySelector("#descricao-produto").value;
    var fracSabores = document.querySelector('#fracionar-sabores-produto').value;
    var precoCusto = document.querySelector("#preco-custo-produto").value;
    var precoVenda = document.querySelector("#preco-venda-produto").value;
    var estoqueMinimo = document.querySelector('#estoque-minimo-produto').value;

    if(local == 'nulo'){
		document.querySelector('.p-local').style.color = 'red';
		document.querySelector('.p-local').innerHTML = 'Local (Obrigatório)';
    }else{
		document.querySelector('.p-local').style.color = 'green';
		document.querySelector('.p-local').innerHTML = 'Local';
	}

    if(subcategoria == 'nulo'){
		document.querySelector('.p-subcategoria').style.color = 'red';
		document.querySelector('.p-subcategoria').innerHTML = 'SubCategoria (Obrigatório)';
    }else{
		document.querySelector('.p-subcategoria').style.color = 'green';
		document.querySelector('.p-subcategoria').innerHTML = 'SubCategoria';
	}


	if(nome == ''){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Obrigatório)';
	}else if(nome.length < 2){
        document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Min. 2 caracteres)';
    }else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao').style.color = 'red';
		document.querySelector('.p-descricao').innerHTML = 'Descrição (Obrigatório)';
    }else{
		document.querySelector('.p-descricao').style.color = 'green';
		document.querySelector('.p-descricao').innerHTML = 'Descrição';
	}

    if(fracSabores == ''){
		document.querySelector('.p-fracionar-sabores').style.color = 'red';
		document.querySelector('.p-fracionar-sabores').innerHTML = 'Fracionar em quantos sabores ? (Obrigatório)';
    }else if(fracSabores <= 0){
        document.querySelector('.p-fracionar-sabores').style.color = 'red';
		document.querySelector('.p-fracionar-sabores').innerHTML = 'Fracionar em quantos sabores ? (Inválido)';
    }
    else{
		document.querySelector('.p-fracionar-sabores').style.color = 'green';
		document.querySelector('.p-fracionar-sabores').innerHTML = 'Fracionar em quantos sabores ?';
	}

    if(precoCusto == ''){
		document.querySelector('.p-preco-custo').style.color = 'red';
		document.querySelector('.p-preco-custo').innerHTML = 'Preço de custo (Obrigatório)';
    }else if(precoCusto <= 0){
        document.querySelector('.p-preco-custo').style.color = 'red';
		document.querySelector('.p-preco-custo').innerHTML = 'Preço de custo (Inválido)';
    }
    else{
		document.querySelector('.p-preco-custo').style.color = 'green';
		document.querySelector('.p-preco-custo').innerHTML = 'Preço de custo';
	}

    if(precoVenda == ''){
		document.querySelector('.p-preco-venda').style.color = 'red';
		document.querySelector('.p-preco-venda').innerHTML = 'Preço de venda (Obrigatório)';
    }else if(precoVenda <= 0){
        document.querySelector('.p-preco-venda').style.color = 'red';
		document.querySelector('.p-preco-venda').innerHTML = 'Preço de venda (Inválido)';
    }
    else{
		document.querySelector('.p-preco-venda').style.color = 'green';
		document.querySelector('.p-preco-venda').innerHTML = 'Preço de venda';
	}

    if(estoqueMinimo == ''){
		document.querySelector('.p-estoque-minimo').style.color = 'red';
		document.querySelector('.p-estoque-minimo').innerHTML = 'Estoque mínimo (Obrigatório)';
    }else if(estoqueMinimo < 0){
        document.querySelector('.p-estoque-minimo').style.color = 'red';
        document.querySelector('.p-estoque-minimo').innerHTML = 'Estoque mínimo (Inválido)';
    }else{
		document.querySelector('.p-estoque-minimo').style.color = 'green';
		document.querySelector('.p-estoque-minimo').innerHTML = 'Estoque mínimo';
	}

}

document.querySelector('#btn-enviar-form').onclick = function(){

    var local = document.querySelector("#select-local-produto").value;
    var subcategoria = document.querySelector("#select-subcategoria-produto").value;
	var nome = document.querySelector("#nome-produto").value;
    var descricao = document.querySelector("#descricao-produto").value;
    var fracSabores = document.querySelector('#fracionar-sabores-produto').value;
    var precoCusto = document.querySelector("#preco-custo-produto").value;
    var precoVenda = document.querySelector("#preco-venda-produto").value;
    var estoqueMinimo = document.querySelector('#estoque-minimo-produto').value;

    var liberBTN = '';

    if(local == 'nulo'){
		document.querySelector('.p-local').style.color = 'red';
		document.querySelector('.p-local').innerHTML = 'Local (Obrigatório)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-local').style.color = 'green';
		document.querySelector('.p-local').innerHTML = 'Local';
	}

    if(subcategoria == 'nulo'){
		document.querySelector('.p-subcategoria').style.color = 'red';
		document.querySelector('.p-subcategoria').innerHTML = 'SubCategoria (Obrigatório)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-subcategoria').style.color = 'green';
		document.querySelector('.p-subcategoria').innerHTML = 'SubCategoria';
	}


	if(nome == ''){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Obrigatório)';
        liberBTN = '1';
	}else if(nome.length < 2){
        document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Min. 2 caracteres)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao').style.color = 'red';
		document.querySelector('.p-descricao').innerHTML = 'Descrição (Obrigatório)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-descricao').style.color = 'green';
		document.querySelector('.p-descricao').innerHTML = 'Descrição';
	}

    if(fracSabores == ''){
		document.querySelector('.p-fracionar-sabores').style.color = 'red';
		document.querySelector('.p-fracionar-sabores').innerHTML = 'Fracionar em quantos sabores ? (Obrigatório)';
        liberBTN = '1';
    }else if(fracSabores <= 0){
        document.querySelector('.p-fracionar-sabores').style.color = 'red';
		document.querySelector('.p-fracionar-sabores').innerHTML = 'Fracionar em quantos sabores ? (Inválido)';
        liberBTN = '1';
    }
    else{
		document.querySelector('.p-fracionar-sabores').style.color = 'green';
		document.querySelector('.p-fracionar-sabores').innerHTML = 'Fracionar em quantos sabores ?';
	}

    if(precoCusto == ''){
		document.querySelector('.p-preco-custo').style.color = 'red';
		document.querySelector('.p-preco-custo').innerHTML = 'Preço de custo (Obrigatório)';
        liberBTN = '1';
    }else if(precoCusto <= 0){
        document.querySelector('.p-preco-custo').style.color = 'red';
		document.querySelector('.p-preco-custo').innerHTML = 'Preço de custo (Inválido)';
        liberBTN = '1';
    }
    else{
		document.querySelector('.p-preco-custo').style.color = 'green';
		document.querySelector('.p-preco-custo').innerHTML = 'Preço de custo';
	}

    if(precoVenda == ''){
		document.querySelector('.p-preco-venda').style.color = 'red';
		document.querySelector('.p-preco-venda').innerHTML = 'Preço de venda (Obrigatório)';
        liberBTN = '1';
    }else if(precoVenda <= 0){
        document.querySelector('.p-preco-venda').style.color = 'red';
		document.querySelector('.p-preco-venda').innerHTML = 'Preço de venda (Inválido)';
        liberBTN = '1';
    }
    else{
		document.querySelector('.p-preco-venda').style.color = 'green';
		document.querySelector('.p-preco-venda').innerHTML = 'Preço de venda';
	}

    if(estoqueMinimo == ''){
		document.querySelector('.p-estoque-minimo').style.color = 'red';
		document.querySelector('.p-estoque-minimo').innerHTML = 'Estoque mínimo (Obrigatório)';
        liberBTN = '1';
    }else if(estoqueMinimo < 0){
        document.querySelector('.p-estoque-minimo').style.color = 'red';
        document.querySelector('.p-estoque-minimo').innerHTML = 'Estoque mínimo (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-estoque-minimo').style.color = 'green';
		document.querySelector('.p-estoque-minimo').innerHTML = 'Estoque mínimo';
	}

	if(liberBTN == ''){
		return true; //habilita
	}else{
        $('html,body').animate({'scrollTop':'0'},800);
		//window.scrollTo({top: 0, behavior: 'smooth'});
		return false; //desabilita
	}

};

// SABORES

function validarAddSabores(){

    var nome = document.querySelector("#nome-add-sabor").value;
    var descricao = document.querySelector("#descricao-add-sabor").value;
    var status = document.querySelector('#select-status-add-sabor').value;

	if(nome == ''){
		document.querySelector('.p-nome-add-sabor').style.color = 'red';
		document.querySelector('.p-nome-add-sabor').innerHTML = 'Nome (Obrigatório)';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-add-sabor').style.color = 'red';
		document.querySelector('.p-nome-add-sabor').innerHTML = 'Nome (Min. 2 caracteres)';
    }else{
		document.querySelector('.p-nome-add-sabor').style.color = 'green';
		document.querySelector('.p-nome-add-sabor').innerHTML = 'Nome';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao-add-sabor').style.color = 'red';
		document.querySelector('.p-descricao-add-sabor').innerHTML = 'Descrição (Obrigatório)';
    }else{
		document.querySelector('.p-descricao-add-sabor').style.color = 'green';
		document.querySelector('.p-descricao-add-sabor').innerHTML = 'Descrição';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-add-sabor').style.color = 'red';
        document.querySelector('.p-status-add-sabor').innerHTML = 'Status (Inválido)';
    }else{
		document.querySelector('.p-status-add-sabor').style.color = 'green';
		document.querySelector('.p-status-add-sabor').innerHTML = 'Status';
	}
}

document.querySelector('#btn-enviar-add-sabor').onclick = function(){

    var nome = document.querySelector("#nome-add-sabor").value;
    var descricao = document.querySelector("#descricao-add-sabor").value;
    var status = document.querySelector('#select-status-add-sabor').value;

    var liberBTN = '';

	if(nome == ''){
		document.querySelector('.p-nome-add-sabor').style.color = 'red';
		document.querySelector('.p-nome-add-sabor').innerHTML = 'Nome (Obrigatório)';
        liberBTN = '1';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-add-sabor').style.color = 'red';
		document.querySelector('.p-nome-add-sabor').innerHTML = 'Nome (Min. 2 caracteres)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-nome-add-sabor').style.color = 'green';
		document.querySelector('.p-nome-add-sabor').innerHTML = 'Nome';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao-add-sabor').style.color = 'red';
		document.querySelector('.p-descricao-add-sabor').innerHTML = 'Descrição (Obrigatório)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-descricao-add-sabor').style.color = 'green';
		document.querySelector('.p-descricao-add-sabor').innerHTML = 'Descrição';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-add-sabor').style.color = 'red';
        document.querySelector('.p-status-add-sabor').innerHTML = 'Status (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-status-add-sabor').style.color = 'green';
		document.querySelector('.p-status-add-sabor').innerHTML = 'Status';
	}

	if(liberBTN == ''){
		return true; //habilita
	}else{
		return false; //desabilita
	}

};

function validarEditSabores(){

    var nome = document.querySelector("#nome-edit-sabor").value;
    var descricao = document.querySelector("#descricao-edit-sabor").value;
    var status = document.querySelector('#select-status-edit-sabor').value;

	if(nome == ''){
		document.querySelector('.p-nome-edit-sabor').style.color = 'red';
		document.querySelector('.p-nome-edit-sabor').innerHTML = 'Nome (Obrigatório)';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-edit-sabor').style.color = 'red';
		document.querySelector('.p-nome-edit-sabor').innerHTML = 'Nome (Min. 2 caracteres)';
    }else{
		document.querySelector('.p-nome-edit-sabor').style.color = 'green';
		document.querySelector('.p-nome-edit-sabor').innerHTML = 'Nome';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao-edit-sabor').style.color = 'red';
		document.querySelector('.p-descricao-edit-sabor').innerHTML = 'Descrição (Obrigatório)';
    }else{
		document.querySelector('.p-descricao-edit-sabor').style.color = 'green';
		document.querySelector('.p-descricao-edit-sabor').innerHTML = 'Descrição';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-edit-sabor').style.color = 'red';
        document.querySelector('.p-status-edit-sabor').innerHTML = 'Status (Inválido)';
    }else{
		document.querySelector('.p-status-edit-sabor').style.color = 'green';
		document.querySelector('.p-status-edit-sabor').innerHTML = 'Status';
	}
}


document.querySelector('.btn-open-edit-sabor').onclick = function(){

    $("form.search-flavors").css('display','none');
    $("form.edit-flavors").css('display','flex');

}

document.querySelector('#btn-cancel-edit-sabor').onclick = function(){

    $("form.search-flavors").css('display','flex');
    $("form.edit-flavors").css('display','none');

}


document.querySelector('#btn-salvar-edit-sabor').onclick = function(){

    var nome = document.querySelector("#nome-edit-sabor").value;
    var descricao = document.querySelector("#descricao-edit-sabor").value;
    var status = document.querySelector('#select-status-edit-sabor').value;

    var liberBTN = '';

	if(nome == ''){
		document.querySelector('.p-nome-edit-sabor').style.color = 'red';
		document.querySelector('.p-nome-edit-sabor').innerHTML = 'Nome (Obrigatório)';
        liberBTN = '1';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-edit-sabor').style.color = 'red';
		document.querySelector('.p-nome-edit-sabor').innerHTML = 'Nome (Min. 2 caracteres)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-nome-edit-sabor').style.color = 'green';
		document.querySelector('.p-nome-edit-sabor').innerHTML = 'Nome';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao-edit-sabor').style.color = 'red';
		document.querySelector('.p-descricao-edit-sabor').innerHTML = 'Descrição (Obrigatório)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-descricao-edit-sabor').style.color = 'green';
		document.querySelector('.p-descricao-edit-sabor').innerHTML = 'Descrição';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-edit-sabor').style.color = 'red';
        document.querySelector('.p-status-edit-sabor').innerHTML = 'Status (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-status-edit-sabor').style.color = 'green';
		document.querySelector('.p-status-edit-sabor').innerHTML = 'Status';
	}

	if(liberBTN == ''){
		return true; //habilita
	}else{
		return false; //desabilita
	}

};


// COMPLEMENTOS

function validarAddComplementos(){

    var nome = document.querySelector("#nome-add-complemento").value;
    var preco = document.querySelector("#preco-add-complemento").value;
    var status = document.querySelector('#select-status-add-complemento').value;

	if(nome == ''){
		document.querySelector('.p-nome-add-complemento').style.color = 'red';
		document.querySelector('.p-nome-add-complemento').innerHTML = 'Nome (Obrigatório)';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-add-complemento').style.color = 'red';
		document.querySelector('.p-nome-add-complemento').innerHTML = 'Nome (Min. 2 caracteres)';
    }else{
		document.querySelector('.p-nome-add-complemento').style.color = 'green';
		document.querySelector('.p-nome-add-complemento').innerHTML = 'Nome';
	}

    if(preco == ''){
		document.querySelector('.p-preco-add-complemento').style.color = 'red';
		document.querySelector('.p-preco-add-complemento').innerHTML = 'Preço (Obrigatório)';
    }else if(preco <= 0){
        document.querySelector('.p-preco-add-complemento').style.color = 'red';
		document.querySelector('.p-preco-add-complemento').innerHTML = 'Preço (Inválido)';
    }else{
		document.querySelector('.p-preco-add-complemento').style.color = 'green';
		document.querySelector('.p-preco-add-complemento').innerHTML = 'Preço';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-add-complemento').style.color = 'red';
        document.querySelector('.p-status-add-complemento').innerHTML = 'Status (Inválido)';
    }else{
		document.querySelector('.p-status-add-complemento').style.color = 'green';
		document.querySelector('.p-status-add-complemento').innerHTML = 'Status';
	}
}

document.querySelector('#btn-enviar-add-complemento').onclick = function(){

    var nome = document.querySelector("#nome-add-complemento").value;
    var preco = document.querySelector("#preco-add-complemento").value;
    var status = document.querySelector('#select-status-add-complemento').value;

    var liberBTN = '';

	if(nome == ''){
		document.querySelector('.p-nome-add-complemento').style.color = 'red';
		document.querySelector('.p-nome-add-complemento').innerHTML = 'Nome (Obrigatório)';
        liberBTN = '1';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-add-complemento').style.color = 'red';
		document.querySelector('.p-nome-add-complemento').innerHTML = 'Nome (Min. 2 caracteres)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-nome-add-complemento').style.color = 'green';
		document.querySelector('.p-nome-add-complemento').innerHTML = 'Nome';
	}

    if(preco == ''){
		document.querySelector('.p-preco-add-complemento').style.color = 'red';
		document.querySelector('.p-preco-add-complemento').innerHTML = 'Preço (Obrigatório)';
        liberBTN = '1';
    }else if(preco <= 0){
        document.querySelector('.p-preco-add-complemento').style.color = 'red';
		document.querySelector('.p-preco-add-complemento').innerHTML = 'Preço (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-preco-add-complemento').style.color = 'green';
		document.querySelector('.p-preco-add-complemento').innerHTML = 'Preço';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-add-complemento').style.color = 'red';
        document.querySelector('.p-status-add-complemento').innerHTML = 'Status (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-status-add-complemento').style.color = 'green';
		document.querySelector('.p-status-add-complemento').innerHTML = 'Status';
	}

	if(liberBTN == ''){
		return true; //habilita
	}else{
		return false; //desabilita
	}

};

function validarEditComplementos(){

    var nome = document.querySelector("#nome-edit-complemento").value;
    var preco = document.querySelector("#preco-edit-complemento").value;
    var status = document.querySelector('#select-status-edit-complemento').value;

	if(nome == ''){
		document.querySelector('.p-nome-edit-complemento').style.color = 'red';
		document.querySelector('.p-nome-edit-complemento').innerHTML = 'Nome (Obrigatório)';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-edit-complemento').style.color = 'red';
		document.querySelector('.p-nome-edit-complemento').innerHTML = 'Nome (Min. 2 caracteres)';
    }else{
		document.querySelector('.p-nome-edit-complemento').style.color = 'green';
		document.querySelector('.p-nome-edit-complemento').innerHTML = 'Nome';
	}

    if(preco == ''){
		document.querySelector('.p-preco-edit-complemento').style.color = 'red';
		document.querySelector('.p-preco-edit-complemento').innerHTML = 'Preço (Obrigatório)';
    }else if(preco <= 0){
        document.querySelector('.p-preco-edit-complemento').style.color = 'red';
		document.querySelector('.p-preco-edit-complemento').innerHTML = 'Preço (Inválido)';
    }else{
		document.querySelector('.p-preco-edit-complemento').style.color = 'green';
		document.querySelector('.p-preco-edit-complemento').innerHTML = 'Preço';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-edit-complemento').style.color = 'red';
        document.querySelector('.p-status-edit-complemento').innerHTML = 'Status (Inválido)';
    }else{
		document.querySelector('.p-status-edit-complemento').style.color = 'green';
		document.querySelector('.p-status-edit-complemento').innerHTML = 'Status';
	}
}


document.querySelector('.btn-open-edit-complemento').onclick = function(){

    $("form.search-add-ons").css('display','none');
    $("form.edit-add-ons").css('display','flex');

}

document.querySelector('#btn-cancel-edit-complemento').onclick = function(){

    $("form.search-add-ons").css('display','flex');
    $("form.edit-add-ons").css('display','none');

}


document.querySelector('#btn-salvar-edit-complemento').onclick = function(){

    var nome = document.querySelector("#nome-edit-complemento").value;
    var preco = document.querySelector("#preco-edit-complemento").value;
    var status = document.querySelector('#select-status-edit-complemento').value;

    var liberBTN = '';

	if(nome == ''){
		document.querySelector('.p-nome-edit-complemento').style.color = 'red';
		document.querySelector('.p-nome-edit-complemento').innerHTML = 'Nome (Obrigatório)';
        liberBTN = '1';
	}else if(nome.length < 2){
        document.querySelector('.p-nome-edit-complemento').style.color = 'red';
		document.querySelector('.p-nome-edit-complemento').innerHTML = 'Nome (Min. 2 caracteres)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-nome-edit-complemento').style.color = 'green';
		document.querySelector('.p-nome-edit-complemento').innerHTML = 'Nome';
	}

    if(preco == ''){
		document.querySelector('.p-preco-edit-complemento').style.color = 'red';
		document.querySelector('.p-preco-edit-complemento').innerHTML = 'Preço (Obrigatório)';
        liberBTN = '1';
    }else if(preco <= 0){
        document.querySelector('.p-preco-edit-complemento').style.color = 'red';
		document.querySelector('.p-preco-edit-complemento').innerHTML = 'Preço (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-preco-edit-complemento').style.color = 'green';
		document.querySelector('.p-preco-edit-complemento').innerHTML = 'Preço';
	}

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status-edit-complemento').style.color = 'red';
        document.querySelector('.p-status-edit-complemento').innerHTML = 'Status (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-status-edit-complemento').style.color = 'green';
		document.querySelector('.p-status-edit-complemento').innerHTML = 'Status';
	}

	if(liberBTN == ''){
		return true; //habilita
	}else{
		return false; //desabilita
	}

};

// IMAGENS

document.querySelector('#btn-add-imagem').onclick = function(){

    var imagem = document.querySelector("#imagem-add-img").value;

    var liberBTN = '';

    if(imagem == ''){
        document.querySelector('.p-img-imagem').style.color = 'red';
        document.querySelector('.p-img-imagem').innerHTML = 'Imagem (Obrigatório)';
        liberBTN = '1';
    }else{
        idxDot = imagem.lastIndexOf(".") + 1,
        extFile = imagem.substr(idxDot, imagem.length).toLowerCase();
    
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            document.querySelector('.p-img-imagem').style.color = 'green';
            document.querySelector('.p-img-imagem').innerHTML = 'Imagem';
        }else{
            document.querySelector('.p-img-imagem').style.color = 'red';
            document.querySelector('.p-img-imagem').innerHTML = 'Imagem (Inválido)';
            liberBTN = '1';
        }
    }


	if(liberBTN == ''){
		return true; //habilita
	}else{
		return false; //desabilita
	}

};

$('#data-inicio-all-exit').mask('00/00/0000');
$('#data-fim-all-exit').mask('00/00/0000');

function validarAllExit(){

    var dataInicio = document.querySelector("#data-inicio-all-exit").value;
    var dataFim = document.querySelector("#data-fim-all-exit").value;

    if(dataInicio.length > 0 && dataInicio.length < 10){
		document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Inválido)';
	}else{
		document.querySelector('.p-data-inicio').style.color = 'green';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}

    if(dataFim.length > 0 && dataFim.length < 10){
		document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Inválido)';
	}else{
		document.querySelector('.p-data-fim').style.color = 'green';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
	}
}

document.getElementById('pesquisar-all-exit').onclick = function(){//Aparece a tabela

    var dataInicio = document.querySelector("#data-inicio-all-exit").value;
    var dataFim = document.querySelector("#data-fim-all-exit").value;

    var liberBTN = '';

    if(dataInicio.length > 0 && dataInicio.length < 10){
		document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-data-inicio').style.color = 'green';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}

    if(dataFim.length > 0 && dataFim.length < 10){
		document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-data-fim').style.color = 'green';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
	}

    if(liberBTN == ''){
		$('#table-all-exit-entrance').fadeIn('fast');
	}else{
        $('#table-all-exit-entrance').css('display','none');
		return false; //desabilita
	}
}

function validarAddExit(){
    var quantidade = document.querySelector("#quantidade-add-exit").value;
    var descricao = document.querySelector("#descricao-add-exit").value;

    if(quantidade == ''){
		document.querySelector('.p-quantidade').style.color = 'red';
		document.querySelector('.p-quantidade').innerHTML = 'Quantidade (Obrigatório)';
        
	}else if(quantidade <= 0){
		document.querySelector('.p-quantidade').style.color = 'red';
		document.querySelector('.p-quantidade').innerHTML = 'Quantidade (Inválido)';
	}else{
		document.querySelector('.p-quantidade').style.color = 'green';
		document.querySelector('.p-quantidade').innerHTML = 'Quantidade';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao').style.color = 'red';
		document.querySelector('.p-descricao').innerHTML = 'Descrição (Obrigatório)';
	}else{
		document.querySelector('.p-descricao').style.color = 'green';
		document.querySelector('.p-descricao').innerHTML = 'Descrição';
	}
}

document.getElementById('btn-salvar-exit').onclick = function(){//Aparece a tabela

    var quantidade = document.querySelector("#quantidade-add-exit").value;
    var descricao = document.querySelector("#descricao-add-exit").value;

    var liberBTN = '';

    if(quantidade == ''){
		document.querySelector('.p-quantidade').style.color = 'red';
		document.querySelector('.p-quantidade').innerHTML = 'Quantidade (Obrigatório)';
        liberBTN = '1';
        
	}else if(quantidade <= 0){
		document.querySelector('.p-quantidade').style.color = 'red';
		document.querySelector('.p-quantidade').innerHTML = 'Quantidade (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-quantidade').style.color = 'green';
		document.querySelector('.p-quantidade').innerHTML = 'Quantidade';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao').style.color = 'red';
		document.querySelector('.p-descricao').innerHTML = 'Descrição (Obrigatório)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-descricao').style.color = 'green';
		document.querySelector('.p-descricao').innerHTML = 'Descrição';
	}

    if(liberBTN == ''){
        return true;
	}else{
		return false; //desabilita
	}
}

// STOCK MOVEMENTS - MOVIMENTAÇÃO DE ESTOQUE

$('#data-inicio-entrance').mask('00/00/0000');
$('#data-fim-entrance').mask('00/00/0000');

function validarEntrance(){

    var dataInicio = document.querySelector("#data-inicio-entrance").value;
    var dataFim = document.querySelector("#data-fim-entrance").value;

    if(dataInicio.length > 0 && dataInicio.length < 10){
		document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Inválido)';
	}else{
		document.querySelector('.p-data-inicio').style.color = 'green';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}

    if(dataFim.length > 0 && dataFim.length < 10){
		document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Inválido)';
	}else{
		document.querySelector('.p-data-fim').style.color = 'green';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
	}
}

document.getElementById('pesquisar-entrance').onclick = function(){//Aparece a tabela

    var dataInicio = document.querySelector("#data-inicio-entrance").value;
    var dataFim = document.querySelector("#data-fim-entrance").value;

    var liberBTN = '';

    if(dataInicio.length > 0 && dataInicio.length < 10){
		document.querySelector('.p-data-inicio-entrance').style.color = 'red';
		document.querySelector('.p-data-inicio-entrance').innerHTML = 'Data - Início (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-data-inicio-entrance').style.color = 'green';
		document.querySelector('.p-data-inicio-entrance').innerHTML = 'Data - Início';
	}

    if(dataFim.length > 0 && dataFim.length < 10){
		document.querySelector('.p-data-fim-entrance').style.color = 'red';
		document.querySelector('.p-data-fim-entrance').innerHTML = 'Data - Fim (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-data-fim-entrance').style.color = 'green';
		document.querySelector('.p-data-fim-entrance').innerHTML = 'Data - Fim';
	}

    if(liberBTN == ''){
		$('#table-all-exit-entrance').fadeIn('fast');
	}else{
        $('#table-all-exit-entrance').css('display','none');
		return false; //desabilita
	}
}

function validarAddEntrance(){
    var fornecedor = document.querySelector("#select-fornecedor-add-entrance").value;
    var quantidade = document.querySelector("#quantidade-add-entrance").value;
    var descricao = document.querySelector("#descricao-add-entrance").value;

    if(fornecedor == 'nulo'){
		document.querySelector('.p-fornecedor-add-entrance').style.color = 'red';
		document.querySelector('.p-fornecedor-add-entrance').innerHTML = 'Fornecedor (Obrigatório)';
	}else{
		document.querySelector('.p-fornecedor-add-entrance').style.color = 'green';
		document.querySelector('.p-fornecedor-add-entrance').innerHTML = 'Fornecedor';
	}

    if(quantidade == ''){
		document.querySelector('.p-quantidade-add-entrance').style.color = 'red';
		document.querySelector('.p-quantidade-add-entrance').innerHTML = 'Quantidade (Obrigatório)';
        
	}else if(quantidade <= 0){
		document.querySelector('.p-quantidade-add-entrance').style.color = 'red';
		document.querySelector('.p-quantidade-add-entrance').innerHTML = 'Quantidade (Inválido)';
	}else{
		document.querySelector('.p-quantidade-add-entrance').style.color = 'green';
		document.querySelector('.p-quantidade-add-entrance').innerHTML = 'Quantidade';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao-add-entrance').style.color = 'red';
		document.querySelector('.p-descricao-add-entrance').innerHTML = 'Descrição (Obrigatório)';
	}else{
		document.querySelector('.p-descricao-add-entrance').style.color = 'green';
		document.querySelector('.p-descricao-add-entrance').innerHTML = 'Descrição';
	}
}

document.getElementById('btn-salvar-entrance').onclick = function(){//Aparece a tabela

    var fornecedor = document.querySelector("#select-fornecedor-add-entrance").value;
    var quantidade = document.querySelector("#quantidade-add-entrance").value;
    var descricao = document.querySelector("#descricao-add-entrance").value;

    var liberBTN = '';

    if(fornecedor == 'nulo'){
		document.querySelector('.p-fornecedor-add-entrance').style.color = 'red';
		document.querySelector('.p-fornecedor-add-entrance').innerHTML = 'Fornecedor (Obrigatório)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-fornecedor-add-entrance').style.color = 'green';
		document.querySelector('.p-fornecedor-add-entrance').innerHTML = 'Fornecedor';
	}

    if(quantidade == ''){
		document.querySelector('.p-quantidade-add-entrance').style.color = 'red';
		document.querySelector('.p-quantidade-add-entrance').innerHTML = 'Quantidade (Obrigatório)';
        liberBTN = '1';
	}else if(quantidade <= 0){
		document.querySelector('.p-quantidade-add-entrance').style.color = 'red';
		document.querySelector('.p-quantidade-add-entrance').innerHTML = 'Quantidade (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-quantidade-add-entrance').style.color = 'green';
		document.querySelector('.p-quantidade-add-entrance').innerHTML = 'Quantidade';
	}

    if(descricao == ''){
		document.querySelector('.p-descricao-add-entrance').style.color = 'red';
		document.querySelector('.p-descricao-add-entrance').innerHTML = 'Descrição (Obrigatório)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-descricao-add-entrance').style.color = 'green';
		document.querySelector('.p-descricao-add-entrance').innerHTML = 'Descrição';
	}

    if(liberBTN == ''){
        return true;
	}else{
		return false; //desabilita
	}
}

function mudarListagem(){

    $('form.add-all-exit').css('display','none');
    $('form.add-entrance').css('display','none');

    if($('form.all-exit').is(':visible')){
        if($('#select-all-exit').val() == 'entrada'){

            $('#select-entrance option').each(function() {
                if($(this).text() == 'Entrada') {
                  $(this).attr('selected', false);
                }
                if($(this).text() == 'Todos') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Saída') {
                $(this).attr('selected', false);
                }
                if($(this).text() == 'Entrada') {
                    $(this).attr('selected', true);
                }
            });

            $('form.all-exit.flexbox').css('display','none');
            $('form.entrance.flexbox').css('display','flex');
        }
    }else if($('form.entrance').is(':visible')){
        if($('#select-entrance').val() == 'todos'){

            $('#select-all-exit option').each(function() {
                if($(this).text() == 'Todos') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Saída') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Entrada') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Todos') {
                    $(this).attr('selected', true);
                }
            });

            $('form.entrance.flexbox').css('display','none');
            $('form.all-exit.flexbox').css('display','flex');
            
        }else if($('#select-entrance').val() == 'saida'){

            $('#select-all-exit option').each(function() {
                // se localizar a frase, define o atributo selected
                if($(this).text() == 'Saída') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Todos') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Entrada') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Saída') {
                    $(this).attr('selected', true);
                }
            });

            $('form.entrance.flexbox').css('display','none');
            $('form.all-exit.flexbox').css('display','flex');
        }
    }
}

document.querySelector('#btn-add-exit').onclick = function(){//abrir form para adicionar
    $('form.all-exit').css('display','none');
    $('form.add-exit').css('display','flex');
}

document.querySelector('#btn-cancel-exit').onclick = function(){//fechar form para adicionar
    $('form.all-exit').css('display','flex')
    $('form.add-exit').css('display','none');
}

document.querySelector('#btn-add-entrance').onclick = function(){//abrir form para adicionar
    $('form.entrance').css('display','none');
    $('form.add-entrance').css('display','flex');
}

document.querySelector('#btn-cancel-entrance').onclick = function(){//fechar form para adicionar
    $('form.entrance').css('display','flex');
    $('form.add-entrance').css('display','none');
}

function mudarListagem2(){

    if($('form.add-exit').is(':visible')){
        if($('#select-add-exit').val() == 'entrada'){

            $('#select-add-entrance option').each(function() {
                if($(this).text() == 'Entrada') {
                  $(this).attr('selected', false);
                }
                if($(this).text() == 'Saída') {
                $(this).attr('selected', false);
                }
                if($(this).text() == 'Entrada') {
                    $(this).attr('selected', true);
                }
            });

            $('form.add-exit.flexbox').css('display','none');
            $('form.add-entrance.flexbox').css('display','flex');
    }

    }else if($('form.add-entrance').is(':visible')){
            if($('#select-add-entrance').val() == 'saida'){

            $('#select-add-exit option').each(function() {
                // se localizar a frase, define o atributo selected
                if($(this).text() == 'Saída') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Entrada') {
                    $(this).attr('selected', false);
                }
                if($(this).text() == 'Saída') {
                    $(this).attr('selected', true);
                }
            });

            $('form.add-entrance.flexbox').css('display','none');
            $('form.add-exit.flexbox').css('display','flex');
        }
    }
}

const myDatePicker1 = MCDatepicker.create({ 
    el: '#data-inicio-all-exit',
    dateFormat: 'DD/MM/YYYY',
    customWeekDays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    customMonths: [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
        ]
})

const myDatePicker2 = MCDatepicker.create({ 
    el: '#data-fim-all-exit',
    dateFormat: 'DD/MM/YYYY',
    customWeekDays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    customMonths: [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
        ]
})


const myDatePicker3 = MCDatepicker.create({ 
    el: '#data-inicio-entrance',
    dateFormat: 'DD/MM/YYYY',
    customWeekDays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    customMonths: [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
        ]
})

const myDatePicker4 = MCDatepicker.create({ 
    el: '#data-fim-entrance',
    dateFormat: 'DD/MM/YYYY',
    customWeekDays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    customMonths: [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
        ]
})
