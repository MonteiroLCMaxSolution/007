function openModal(){
    $('body').css('overflow-y','hidden');
    $('div.details-modal').css('display','block');
}

function closeModal(){
    $('body').css('overflow-y','auto');
    $('div.details-modal').css('display','none');
}

document.getElementById('btn-pagamento-pedidos').onclick = function(){
    $('#table-pagamento-pedidos').slideToggle();
}

document.getElementById('btn-totais-pedidos').onclick = function(){
    $('#box-totais-pedidos').slideToggle();
    $('#box-totais-pedidos').css('display','flex');
}