function retirarDinheiro(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-retirar-dinheiro').css('display','flex');
}

function cancelRetirarDinheiro(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-retirar-dinheiro').css('display','none');
}

function editarProduto(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-editar-produto').css('display','flex');
}

function cancelEditarProduto(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-editar-produto').css('display','none');
}

function fecharCaixa(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-fechar-caixa').css('display','flex');
}

function cancelFecharCaixa(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-fechar-caixa').css('display','none');
}

function finalizarCaixa(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-finalizar-pedido').css('display','flex');
}

function cancelFinalizarCaixa(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-finalizar-pedido').css('display','none');
}

function adicionarProduto(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-adicionar-produto').css('display','flex');
}

function cancelAdicionarProduto(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-adicionar-produto').css('display','none');
}

function editarComanda(){
    $('section.pdv div.pdv-painel-comanda').css('display','block');
    $('section.pdv div.pdv-painel-mesa').css('display','none');
}

function abrirPdvContainer(){
    if($('div.pdv-container').is(':visible')){
        $('div.pdv-add-cart-header i').removeClass('fas fa-cart-plus');
        $('div.pdv-add-cart-header i').addClass('fas fa-border-all');
        $('div.pdv-painel').css('display','block');
        $('div.pdv-container').css('display','none');
    }else{
        $('div.pdv-add-cart-header i').removeClass('fas fa-border-all');
        $('div.pdv-add-cart-header i').addClass('fas fa-cart-plus');
        $('div.pdv-painel').css('display','none');
        $('div.pdv-container').css('display','block');
    }

}