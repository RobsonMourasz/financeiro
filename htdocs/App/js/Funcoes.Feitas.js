function FormatarCpfCnpj(str) {
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
    let temp = "";
    if (str.length === 13) { // 034999999999 -> 13
        temp = "(" + str.substring(0, 3) + ") ";
        temp += str.substring(6);
    } else if (str.length === 12) { //34999999999 -> 12
        temp = "(" + str.substring(0, 2) + ") ";
        temp += str.substring(2);
    } else if (str.length === 10) { //999999999 -> 10
        temp = "(00) ";
        temp += str.substring(0);
    } else if (str.length === 11) { // 3434531490 -> 11
        temp = "(" + str.substring(0, 2) + ") " ;
        temp += str.substring(2); 
    } else if (str.length === 9) { // 34531490 -> 9
        temp = "(00) ";
        temp += str.substring(0);
    }else{
        console.log("Formato inválido: a entrada deve ter 13 (CELULAR) ou 11 (TELEFONE) dígitos.");
    }
    console.log(temp);
    return temp;
}
