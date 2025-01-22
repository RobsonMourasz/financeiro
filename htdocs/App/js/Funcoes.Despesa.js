(() => {
    let data_Inicial = "";
    let data_Final = "";
    const data = new Date();
    const mes = data.getMonth() + 1; // Adicione 1 para obter o mês correto
    const ano = data.getFullYear(); // Obtenha o ano corretamente
    let  dia = "";
    
    // Formate as datas como "YYYY-MM-DD"
    if(mes == "2"){
        dia = "28"
    }else if(mes == "1" || mes =="3" || mes == "5" || mes == "7" || mes == "8" || mes =="10"){
        dia = "31"
    }else{
        dia = "30"
    }
    data_Inicial = ano + "-" + (mes < 10 ? "0" : "") + mes + "-01";
    data_Final = ano + "-" + (mes < 10 ? "0" : "") + mes + "-"+ dia;
    document.getElementById("Data1").value = data_Inicial;
    document.getElementById("Data2").value = data_Final;
    Carregar_Tabela();
    
    document.getElementById("form-pesquisa").addEventListener("submit", async (event) => {
        event.preventDefault()
        Carregar_Tabela();
    });


})();

async function Carregar_Tabela() {
    ChamarTelaCarregando("FadeIn");
    try {
        
        const url = "Request/Despesa/pesqDespesa.php";
        const formPesq = new FormData(document.getElementById("form-pesquisa"));
        const response = await fetch(url, {
            method: "POST",
            body: formPesq,
        });

        if (response.ok) {

            const dados = await response.json();
            if (dados.Retorno = "OK") {

                let tbody = document.getElementById("tbody");
                tbody.textContent = '';
                for (let i = 0; i < dados.Dados.length; i++) {
                    let tr = tbody.insertRow();
                    let td_Vencimento = tr.insertCell();
                    let td_Descricao = tr.insertCell();
                    let td_vr = tr.insertCell();
                    let td_confirmado = tr.insertCell();
                    let td_acao = tr.insertCell();
                     
                    td_Vencimento.textContent = formatDate(dados.Dados[i].DataVencimento);
                    td_Descricao.textContent = dados.Dados[i].Descricao;
                    td_vr.textContent = formatarReal(dados.Dados[i].ValorParcela);
                    if(dados.Dados[i].Confirmada === "S"){
                        td_confirmado.innerHTML = `<i class="bi bi-hand-thumbs-up-fill" id="confirma${dados.Dados[i].idCR}" onclick="Confirma('${dados.Dados[i].idCR}')" style="cursor:pointer;"></i>`;
                    }else{
                        td_confirmado.innerHTML = `<i class="bi bi-hand-thumbs-down" id="${dados.Dados[i].idCR}" onclick="Confirma('${dados.Dados[i].idCR}')" style="cursor:pointer;"></i>`;
                    }

                    td_acao.innerHTML = `<i class="bi bi-trash" data-toggle="modal" data-target="#modalExcluir" onclick="Excluir(${dados.Dados[i].idCR})" style="cursor:pointer;"></i> <i class="bi bi-clipboard-check-fill" data-toggle="modal" data-target="#modalEditar" onclick="Editar(${dados.Dados[i].idCR})" style="cursor:pointer;"></i>`
                    
                }

            } else {
                TelaAvisos("falso", dados.Motivo);
            }

        } else {
            alert("falha na requisição")
        }
    } catch (error) {
        TelaAvisos("falso", "error");
    }
    ChamarTelaCarregando("FadeOut")
}

function Confirma(idElemento) {

    const iconeAtual = document.getElementById(`${idElemento}`);

    if (iconeAtual.classList.contains('bi-hand-thumbs-down')) {
        iconeAtual.classList.remove("bi-hand-thumbs-down")
        iconeAtual.classList.add("bi-hand-thumbs-up-fill")
    } else {
        iconeAtual.classList.remove("bi-hand-thumbs-up-fill")
        iconeAtual.classList.add("bi-hand-thumbs-down")
    }

}