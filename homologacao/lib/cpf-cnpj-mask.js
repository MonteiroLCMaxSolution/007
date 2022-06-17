var behavior2 = function (val2) {
    return val2.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-00999';
  },
  options2 = {
    onKeyPress: function (val2, e2, field2, options2) {
      field2.mask(behavior2.apply({}, arguments), options2);
    }
  };
  
  $('.cpf_cnpj').mask(behavior2, options2);