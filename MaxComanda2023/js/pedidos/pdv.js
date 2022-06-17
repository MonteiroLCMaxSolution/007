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

function retirarDinheiro(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-retirar-dinheiro').css('display','flex');
}

function cancelRetirarDinheiro(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-retirar-dinheiro').css('display','none');
}

function editarComanda(){
    $('div.caixa-infos-table').css('display','none');
    $('div.caixa-infos-command').css('display','block');
}

function editarProduto(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-editar-produto').css('display','flex');
}

function cancelEditarProduto(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-editar-produto').css('display','none');
}

function adicionarProduto(){
    $('body').css('overflow-y','hidden')
    $('div.pdv-modal.modal-adicionar-produto').css('display','flex');
}

function cancelAdicionarProduto(){
    $('body').css('overflow-y','auto')
    $('div.pdv-modal.modal-adicionar-produto').css('display','none');
}