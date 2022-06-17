$('#sidebar-icon').click(function(){
    $('#sidebar').css('display','inline-block');
    if($(window).width() > 950){
        $('div.content-container').css('width','calc(100% - 300px)');
        $('div.dashboard-icon').css('display','none');
    }else{
        $('div.content-container').css('display','none');
    }
});

$('div.dashboard-close-icon i').click(function(){
    if($(window).width() < 950){
        $('div.content-container').css('width','100%');
        $('div.content-container').css('display','block');
    }else{
        $('div.content-container').css('width','100%');
    }
    $('div.dashboard-icon').css('display','inline-block');
    $('#sidebar').css('display','none');
})

$('#cadastroSidebar').click(function(){
    if($('#cadastroSidebarBox').is(':visible')){
        $('#cadastroSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-up');
        $('#cadastroSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-down');
    }else{
        $('#cadastroSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-down');
        $('#cadastroSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-up');
    }
    $('#cadastroSidebarBox').slideToggle();
})
$('#pedidoSidebar').click(function(){
    if($('#pedidoSidebarBox').is(':visible')){
        $('#pedidoSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-up');
        $('#pedidoSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-down');
    }else{
        $('#pedidoSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-down');
        $('#pedidoSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-up');
    }
    $('#pedidoSidebarBox').slideToggle();
})
$('#monitorSidebar').click(function(){
    if($('#monitorSidebarBox').is(':visible')){
        $('#monitorSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-up');
        $('#monitorSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-down');
    }else{
        $('#monitorSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-down');
        $('#monitorSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-up');
    }
    $('#monitorSidebarBox').slideToggle();
})
$('#sistemaSidebar').click(function(){
    if($('#sistemaSidebarBox').is(':visible')){
        $('#sistemaSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-up');
        $('#sistemaSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-down');
    }else{
        $('#sistemaSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-down');
        $('#sistemaSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-up');
    }
    $('#sistemaSidebarBox').slideToggle();
})

$('#relatorioSidebar').click(function(){
    if($('#relatorioSidebarBox').is(':visible')){
        $('#relatorioSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-up');
        $('#relatorioSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-down');
    }else{
        $('#relatorioSidebar').find('div.dashboard-box-title-arrow i').removeClass('fas fa-angle-down');
        $('#relatorioSidebar').find('div.dashboard-box-title-arrow i').addClass('fas fa-angle-up');
    }
    $('#relatorioSidebarBox').slideToggle();
})