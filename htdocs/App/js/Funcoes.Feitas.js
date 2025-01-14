function FormatarCpfCnpj(str) {
    str = FormatarSomenteNumero(str)
    let temp = "";
    if (str.length === 11) { // CPF
        temp = str.substring(0, 3) + ".";
        temp += str.substring(3, 6) + ".";
        temp += str.substring(6, 9) + "-";
        temp += str.substring(9);
    } else if (str.length === 14) { // CNPJ
        temp = str.substring(0, 2) + ".";
        temp += str.substring(2, 5) + ".";
        temp += str.substring(5, 8) + "/";
        temp += str.substring(8, 12) + "-";
        temp += str.substring(12);
    } else {
        console.log("Formato inválido: a entrada deve ter 11 (CPF) ou 14 (CNPJ) dígitos.");
    }
    console.log(temp);
    return temp;
}

function FormatarTelefoneCelular(str) {
    str = FormatarSomenteNumero(str)
    let temp = "";
    if (str.length === 12) { // 034999999999 -> 12
        temp = "(" + str.substring(0, 3) + ") ";
        temp += str.substring(6);
    } else if (str.length === 11) { //34999999999 -> 11
        temp = "(" + str.substring(0, 2) + ") ";
        temp += str.substring(2);
    } else if (str.length === 10) { // 3434531490 -> 10
        temp = "(" + str.substring(0, 2) + ") " ;
        temp += str.substring(2); 
    } else if (str.length === 8) { // 34531490 -> 8
        temp = "(00) ";
        temp += str.substring(0);
    }else{
        temp = str
        console.log("Formato inválido: a entrada deve ter 13 (CELULAR) ou 11 (TELEFONE) dígitos.");
    }
    return temp;
}

function FormatarSomenteNumero(num) {
    temp = num.replace(/[^0-9]/g, '')
    return temp
}

/* FORMATA EM REAL */
function getFloat(str) {
    return str.replace(",", ".")
}

function formatarReal(valor) {
    // Arredonda o valor para duas casas decimais
    const valorFormatado = parseFloat(valor).toFixed(2);

    // Divide o valor em reais e centavos
    const [reais, centavos] = valorFormatado.split('.');

    // Formata o valor com vírgula e o símbolo de R$
    const valorFinal = `R$ ${reais},${centavos.padEnd(2, '0')}`;

    return valorFinal;
}

/* FORMATA EM REAL */

/* FORMATAR DOUBLE PARA STRING */

function getDoubleString(valor) {
    const temp = valor.replace(/[^0-9,]/g, '').replace(/,/g, '.');
    return parseFloat(temp);
}

/* FORMATAR DOUBLE PARA STRING */

/* FORMATAR DATA ATUAL */
function formatDate(data) {
    const dataNova = new Date()
    let tempData = "nada"

    if (data == "") {
        const tempDia = dataNova.getDate()
        const tempMes = dataNova.getMonth() + 1
        const tempAno = dataNova.getFullYear()
        tempData = `${tempAno}-${tempMes.toString().padStart(2, '0')}-${tempDia.toString().padStart(2, '0')}`

    }

    return tempData
}
/* FORMATAR DATA ATUAL */
