// ***************************************** MENU DROPDOWN ********************************************
const elemensDropdown = document.querySelectorAll(".dropdown-trigger");
const instancesDropdown = M.Dropdown.init(elemensDropdown, {
	coverTrigger: false,
});



// ********************************************* FUNÇÕES DO PRELOADER ***********************************
function loadShow() {
	$("#loading").show();
}

function loadHide() {
	$("#loading").hide();
}



// ************************************** FUNÇÃO MOSTRA DIÁLOGO ****************************************
const elemensToast = document.querySelector("#toast");
const showAlert = (text, color, duration) => {
	M.toast({
		html: text,
		classes: "rounded " + color,
		displayLength: duration
	})
}

// ************************************** HEADER - MENU MOBILE *****************************************
$(document).ready(function () {
	$('.sidenav').sidenav({
		draggable: true
	});
});


// ************************************* BOTÃO FLOATING ACTION *****************************************
$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton({
		hoverEnabled: false,
	});
  });


// ******************************************* TOOLTIP *************************************************
$(document).ready(function(){
    $('.tooltipped').tooltip({
		inDuration: 350,
		position: 'bottom'
	});
  });

// ***************************************** VALIDAÇÃO - CSS *************************************************
function invalidInput(id,helperText,msg) {
    document.getElementById(id).style.cssText ='border-bottom: 1px solid #F44336;' +'-webkit-box-shadow: 0 1px 0 0 #F44336;' +'box-shadow: 0 1px 0 0 #F44336';

    document.getElementById(helperText).style.cssText = 'color: #F44336';

    document.getElementById(helperText).textContent = msg;
}

function validInput(id,helperText,msg) {
    document.getElementById(id).style.cssText = 'border-bottom: 1px solid #4CAF50;' + '-webkit-box-shadow: 0 1px 0 0 #4CAF50;' + 'box-shadow: 0 1px 0 0 #4CAF50';

    document.getElementById(helperText).style.cssText = 'color: #4CAF50';

    document.getElementById(helperText).textContent = msg;
}

function defaultInput(id,helperText,msg){
    document.getElementById(id).style.cssText = 'background-color: transparent;' + 'border: none;' + 'border-bottom: 1px solid #9e9e9e;' + 'border-radius: 0;' + 'outline: none;' + 'height: 3rem;' + 'width: 100%;' + 'font-size: 16px;' + 'margin: 0 0 8px 0;' + 'padding: 0;' + '-webkit-box-shadow: none;' + '        box-shadow: none;' + '-webkit-box-sizing: content-box;' + '        box-sizing: content-box;' + '-webkit-transition: border .3s, -webkit-box-shadow .3s;' + 'transition: border .3s, -webkit-box-shadow .3s;' + 'transition: box-shadow .3s, border .3s;' + 'transition: box-shadow .3s, border .3s, -webkit-box-shadow .3s';

    document.getElementById(helperText).textContent = "";
}

// *********************************************** MÁSCARAS *************************************************
$("#CEP").mask('#####-###');
$(".CEP").mask('#####-###');
$(".CPF").mask('###.###.###-##');
$('.money').mask('#.##0,00', {reverse: true});


// ********************************************* SELECT *****************************************************
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems, {});
});


// *********************************************** DATEPICKER **********************************************
$('.datepicker').datepicker({
  format:'dd/mm/yyyy',
i18n:{
  months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
  monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
  weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
  weekdaysAbbrev: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
  weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
  today: 'Hoje',
  clear: 'Limpar',
  close: 'Pronto',
  labelMonthNext: 'Próximo mês',
  labelMonthPrev: 'Mês anterior',
  labelMonthSelect: 'Selecione um mês',
  labelYearSelect: 'Selecione um ano',
  selectMonths: true,
  selectYears: 15,
  cancel: 'Cancelar',
  clear: 'Limpar'
}
});

// ********************************************* TABS ******************************************************
$(document).ready(function(){
  $('.tabs').tabs();
});


// ********************************************* MODAL *****************************************************
$(document).ready(function(){
  $('.modal').modal();
});

$(document).ready(function(){
  $('.modal-static').modal({
    dismissible: false,
  });
});


// *********************************************** SELECT 2 ************************************************
$(document).ready(function(){
  // Basic Select2 select
$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});
// Select With Icon
$(".select2-icons").select2({
  dropdownAutoWidth: true,
  width: '100%',
  minimumResultsForSearch: Infinity,
  templateResult: iconFormat,
  templateSelection: iconFormat,
  escapeMarkup: function (es) { return es; }
});

// Format icon
function iconFormat(icon) {
  var originalOption = icon.element;
  if (!icon.id) { return icon.text; }
  var $icon = "<i class='material-icons'>" + $(icon.element).data('icon') + "</i>" + icon.text;
  return $icon;
}
// Theme support
$(".select2-theme").select2({
  dropdownAutoWidth: true,
  width: '100%',
  placeholder: "Classic Theme",
  theme: "classic"
});
});

// ***************************************** CONTADOR DE CARACTERES *****************************************
$(document).ready(function() {
  $('.count').characterCounter();
});

// ********************************************** SCROLLSPY ************************************************
$(document).ready(function(){
  $('.scrollspy').scrollSpy();
});


