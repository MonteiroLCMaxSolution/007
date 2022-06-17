$(window).on('load',function(){
    $('html,body').animate({'scrollTop':0},10);
})

$('.custom-check').checkradios({
	
    checkbox: { 
    iconClass:'fa-solid fa-check'
    }
    
});

function openMenu(){
    $('div.welcome-modal').css('display','none');
    $('html, body').css('overflow-y','auto');
}

function openWithdrawModal(){
    $('div.welcome-modal-home').css('display','none');
    $('div.welcome-modal-withdraw').css('display','block');
}

function closeWithdrawModal(){
    $('div.welcome-modal-withdraw').css('display','none');
    $('div.welcome-modal-home').css('display','block');
}

function openDeliveryModal(){
    $('div.welcome-modal-home').css('display','none');
    $('div.welcome-modal-delivery').css('display','block');
}

function closeDeliveryModal(){
    $('div.welcome-modal-delivery').css('display','none');
    $('div.welcome-modal-home').css('display','block');
}

function openProductsContainer(){
    $('div.select-category').css('display','none');
    $('div.products-container').css('display','block');
}

function openCartModal(){
    $('div.cart-modal').css('display','block');
    $('html,body').animate({'scrollTop':0},10);
    $('html, body').css('overflow-y','hidden');
}

function closeCartModal(){
    $('div.cart-modal').css('display','none');
    $('html, body').css('overflow-y','auto');
}

function openProductModal(){
    $('#product-modal').css('display','flex');
    $('html,body').animate({'scrollTop':0},10);
    $('html, body').css('overflow-y','hidden');
}

function closeProductModal(){
    $('#product-modal').css('display','none');
    $('html, body').css('overflow-y','auto');
}

function openEditProductModal(){
    $('#edit-product-modal').css('display','flex');
    $('html,body').animate({'scrollTop':0},10);
}

function closeEditProductModal(){
    $('#edit-product-modal').css('display','none');
}

function openConfirmModalForm(){
    $('html,body').animate({'scrollTop':0},10);
    $('div.confirm-modal').css('display','block');
    $('div.confirm-modal-form').css('display','block');
    $('div.cart-modal').css('display','none');
    $('div.confirm-modal-finish').css('display','none');
}

function closeConfirmModalForm(){
    $('div.confirm-modal').css('display','none');
    $('div.confirm-modal-form').css('display','none');
    $('div.confirm-modal-finish').css('display','none');
    $('html, body').css('overflow-y','auto');
}

function openMoneyInput(id){
    if(id != 1){
        $('div.inp-money').css('display','none');
    }else{
        $('div.inp-money').css('display','block');
    }
}

function openConfirmModalFinish(){
    $('div.confirm-modal-finish').css('display','block');
    $('div.confirm-modal-form').css('display','none');
}

function closeConfirmModalFinish(){
    $('div.confirm-modal-form').css('display','block');
    $('div.confirm-modal-finish').css('display','none');
}

function openFinishedModal(){
    $('div.confirm-modal').css('display','none')
    $('div.confirm-modal-finish').css('display','none');
    $('div.finished-modal').css('display','block');
    $('html, body').css('overflow-y','hidden');
}

function closeFinishedModal(){
    $('div.finished-modal').css('display','none');
    $('html, body').css('overflow-y','auto');
}

function alterarQuantidade(quant, element, id){
    var classValue = parseInt(element.parentElement.querySelector('#'+id).value);
    classValue+=quant;

    if(classValue < 1){
        element.parentElement.querySelector('#'+id).value = 1;
    }else{
        element.parentElement.querySelector('#'+id).value = classValue;
    }

}