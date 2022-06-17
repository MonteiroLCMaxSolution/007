function validarFormulario(){
    var comanda = document.querySelector("#comanda").value;
    var produto = document.querySelector("#select-produto").value;

    if(comanda == ''){
        document.querySelector('.p-comanda').style.color = 'red';
        document.querySelector('.p-comanda').innerHTML = 'Comanda (Obrigatório)';
    }else if(comanda < 0){
        document.querySelector('.p-comanda').style.color = 'red';
        document.querySelector('.p-comanda').innerHTML = 'Comanda (Inválido)';
    }else{
        document.querySelector('.p-comanda').style.color = 'green';
        document.querySelector('.p-comanda').innerHTML = 'Comanda';
    }

    if(produto == 'nulo'){
        document.querySelector('.p-produto').style.color = 'red';
        document.querySelector('.p-produto').innerHTML = 'Produto (Obrigatório)';
    }else{
        document.querySelector('.p-produto').style.color = 'green';
        document.querySelector('.p-produto').innerHTML = 'Produto';
    }
}

function abrirBoxProducts(){
    if($('div.box-products').is(':visible')){

        $('div.box-products').fadeOut("fast");
        $('div.box-products').fadeIn("fast");
        $('div.box-products').css('display','flex');
    }else{
        $('div.box-products').fadeIn();
        $('div.box-products').css('display','flex');
    }
}

function abrirModalAddProduct(){
    $('div.modal-add-product').css('display','block');
    $('html,body').animate({'scrollTop':0},100);
    $('body').css('overflow-y','hidden');
}

function fecharModalAddProduct(){
    $('div.modal-add-product').css('display','none');
    $('body').css('overflow-y','auto');
}

function finalizarPedido(){
    $('body').css('overflow-y','hidden');
    $('div.modal-confirm-order').css('display','block');
}

function fecharFinalizarPedido(){
    $('body').css('overflow-y','auto');
    $('div.modal-confirm-order').css('display','none');
}

function alterarQuantidade(quant, element){
    var classValue = parseInt(element.parentElement.querySelector('#quantidade-carrinho-table').value);
    classValue+=quant;

    if(classValue < 1){
        element.parentElement.querySelector('#quantidade-carrinho-table').value = 1;
    }else{
        element.parentElement.querySelector("#quantidade-carrinho-table").value = classValue;
    }

}
