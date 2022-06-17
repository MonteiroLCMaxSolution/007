function validarCPF(cpf){
    var cpf = cpf;
    var cpf = cpf.replace(/\D/g, '');

    if( cpf.length == 11 )
    {

        var v = [];

            //Calcula o primeiro dígito de verificação.
            v[0] = 1 * cpf[0] + 2 * cpf[1] + 3 * cpf[2];
            v[0] += 4 * cpf[3] + 5 * cpf[4] + 6 * cpf[5];
            v[0] += 7 * cpf[6] + 8 * cpf[7] + 9 * cpf[8];
            v[0] = v[0] % 11;
            v[0] = v[0] % 10;

            //Calcula o segundo dígito de verificação.
            v[1] = 1 * cpf[1] + 2 * cpf[2] + 3 * cpf[3];
            v[1] += 4 * cpf[4] + 5 * cpf[5] + 6 * cpf[6];
            v[1] += 7 * cpf[7] + 8 * cpf[8] + 9 * v[0];
            v[1] = v[1] % 11;
            v[1] = v[1] % 10;

            //Retorna Verdadeiro se os dígitos de verificação são os esperados.
            if ( (v[0] != cpf[9]) || (v[1] != cpf[10]) )
            {

                //$libCPF = '1';
            //$('#msgCPF').html('<div style="color:#F00">CPF INVÁLIDO</div>');
            return false;
        }else if(cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999"){
        return false;
       } else {
                //$('#msgCPF').html('<div style="color:#000">CPF VÁLIDO</div>');
                return true;
            }
        }
        else{
            //$libCPF = '1';
            //$('#msgCPF').html('<div style="color:#F00">CPF INVÁLIDO</div>');
            return false;

            
        }


    }