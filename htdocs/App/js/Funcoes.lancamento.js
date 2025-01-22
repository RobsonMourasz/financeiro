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

document.getElementById("cadFixa").addEventListener("click", () => {
    if (document.getElementById("cadFixa").checked) {
        document.getElementById("cadFixa").setAttribute("data-id", "1")
        document.getElementById("cadParcelada").checked = false
        document.getElementById("cadParcelada").setAttribute("data-id", "0")
    }else{
        document.getElementById("cadFixa").setAttribute("data-id", "0")
    }
    if (!document.getElementById("cadQtdParcelas").classList.contains("d-none")) {
        document.getElementById("cadQtdParcelas").classList.add("d-none")
        document.getElementById("cadResposta").classList.add("d-none")
    }
});

document.getElementById("cadParcelada").addEventListener("click", () => {
    if (document.getElementById("cadParcelada").checked) {
        document.getElementById("cadFixa").checked = false
        document.getElementById("cadFixa").setAttribute("data-id", "0")
        document.getElementById("cadParcelada").setAttribute("data-id", "1")
    }else{
        document.getElementById("cadParcelada").setAttribute("data-id", "0")
    }
    document.getElementById("cadQtdParcelas").classList.toggle("d-none")
    document.getElementById("cadResposta").classList.toggle("d-none")
});

document.getElementById("cadQtdParcelas").addEventListener("focusout", () => {
    const valor = getDoubleString(document.getElementById("cadValor").value)
    const parcelas = getDoubleString(document.getElementById("cadQtdParcelas").value)
    const total = valor * parcelas
    document.getElementById("cadResposta").style.fontSize = ".8em"
    document.getElementById("cadResposta").textContent = `Valor final total será de ${formatarReal(total)}`
});

document.getElementById("cadValor").addEventListener("focusout", () => {
    let valorTemporario = formatarReal(getFloat(document.getElementById("cadValor").value))
    document.getElementById("cadValor").value = valorTemporario
});

document.getElementById("btnfiltro").addEventListener("click", ()=>{
    document.getElementById("display-filtro").classList.toggle("d-none")
});