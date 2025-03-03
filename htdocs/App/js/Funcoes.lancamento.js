/* FORMATA EM REAL */
function getFloat(str) {

    return str.replace(",", ".")

};


/* FORMATAR DOUBLE PARA STRING */

function getDoubleString(valor) {

    const temp = valor.replace(/[^0-9,]/g, '').replace(/,/g, '.');
    return parseFloat(temp);

};

/* FORMATAR DOUBLE PARA STRING */

document.getElementById("cadFixa").addEventListener("click", () => {

    if (document.getElementById("cadFixa").checked) {
        document.getElementById("cadFixa").setAttribute("data-id", "S")
        document.getElementById("cadFixa").value ="S"
        document.getElementById("cadParcelada").checked = false
        document.getElementById("cadParcelada").setAttribute("data-id", "N")
        document.getElementById("btnConfirmada").classList.remove("bi-hand-thumbs-up-fill")
        document.getElementById("btnConfirmada").classList.add("bi-hand-thumbs-down")
        document.getElementById("cadConfirmada").value = "N"
        
    }else{
        document.getElementById("cadFixa").setAttribute("data-id", "N")
        document.getElementById("cadFixa").value ="N"
        document.getElementById("cadConfirmada").value = "S"
    }
    if (!document.querySelector(".QtdParcelas").classList.contains("d-none")) {
        document.querySelector(".QtdParcelas").classList.add("d-none")
    }

});

document.getElementById("cadParcelada").addEventListener("click", () => {

    if (document.getElementById("cadParcelada").checked) {
        document.getElementById("cadFixa").checked = false
        document.getElementById("cadFixa").setAttribute("data-id", "N")
        document.getElementById("cadFixa").value ="N"
        document.getElementById("cadParcelada").setAttribute("data-id", "S")
        document.getElementById("cadParcelada").value ="S"
        document.querySelector(".QtdParcelas").classList.remove("d-none")
        document.getElementById("btnConfirmada").classList.remove("bi-hand-thumbs-up-fill")
        document.getElementById("btnConfirmada").classList.add("bi-hand-thumbs-down")
        document.getElementById("cadConfirmada").value = "N"
    }else{
        document.getElementById("cadParcelada").setAttribute("data-id", "N")
        document.getElementById("cadParcelada").value ="N"
        document.getElementById("cadResposta").textContent = "";
        document.getElementById("cadVrTotal").value = "";
        document.getElementById("cadQtdParcelas").value = "1";
        document.querySelector(".QtdParcelas").classList.add("d-none")
        document.getElementById("cadConfirmada").value = "S"
    }

});

document.getElementById("cadQtdParcelas").addEventListener("focusout", () => {

    const valor = getDoubleString(document.getElementById("cadValor").value)
    const parcelas = getDoubleString(document.getElementById("cadQtdParcelas").value)
    const total = valor * parcelas
    document.getElementById("cadResposta").style.fontSize = ".8em"
    document.getElementById("cadResposta").textContent = `Valor final total será de ${formatarReal(total)}`
    document.getElementById("cadVrTotal").value = formatarReal(total)

});

document.getElementById("cadValor").addEventListener("focusout", () => {

    let valorTemporario = formatarReal(getFloat(document.getElementById("cadValor").value))
    document.getElementById("cadValor").value = valorTemporario

});

document.getElementById("edtValor").addEventListener("focusout", () => {

    let valorTemporario = formatarReal(getFloat(document.getElementById("edtValor").value))
    document.getElementById("edtValor").value = valorTemporario

});

document.getElementById("btnfiltro").addEventListener("click", ()=>{

    document.getElementById("display-filtro").classList.toggle("d-none")

});

document.getElementById("btnConfirmada").addEventListener("click", ()=>{
    
    if(document.getElementById("btnConfirmada").classList.contains("bi-hand-thumbs-up-fill")){
        document.getElementById("btnConfirmada").classList.remove("bi-hand-thumbs-up-fill")
        document.getElementById("btnConfirmada").classList.add("bi-hand-thumbs-down")
        document.getElementById("cadConfirmada").value = "N"
    }else{
        document.getElementById("btnConfirmada").classList.remove("bi-hand-thumbs-down")
        document.getElementById("btnConfirmada").classList.add("bi-hand-thumbs-up-fill")
        document.getElementById("cadConfirmada").value = "S"
    }
    
});

document.getElementById("edtBtnConfirmada").addEventListener("click", ()=>{
    
    if(document.getElementById("edtBtnConfirmada").classList.contains("bi-hand-thumbs-up-fill")){
        document.getElementById("edtBtnConfirmada").classList.remove("bi-hand-thumbs-up-fill")
        document.getElementById("edtBtnConfirmada").classList.add("bi-hand-thumbs-down")
        document.getElementById("edtBtnConfirmada").setAttribute("data-id", "N")
        document.getElementById("edtConfirmada").value = "N"
    }else{
        document.getElementById("edtBtnConfirmada").classList.remove("bi-hand-thumbs-down")
        document.getElementById("edtBtnConfirmada").classList.add("bi-hand-thumbs-up-fill")
        document.getElementById("edtBtnConfirmada").setAttribute("data-id", "S")
        document.getElementById("edtConfirmada").value = "S"
    }
    
});
