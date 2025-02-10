(()=>{
    let data_Inicial = "";
    let data_Final = "";
    const data = new Date();
    const mes = data.getMonth() + 1; // Adicione 1 para obter o mês correto
    const ano = data.getFullYear(); // Obtenha o ano corretamente
    let dia = "";

    // Formate as datas como "YYYY-MM-DD"
    if (mes == "2") {
        dia = "28"
    } else if (mes == "1" || mes == "3" || mes == "5" || mes == "7" || mes == "8" || mes == "10") {
        dia = "31"
    } else {
        dia = "30"
    }
    data_Inicial = ano + "-" + (mes < 10 ? "0" : "") + mes + "-01";
    data_Final = ano + "-" + (mes < 10 ? "0" : "") + mes + "-" + dia;
    document.getElementById("Data1").value = data_Inicial;
    document.getElementById("Data2").value = data_Final;

    document.addEventListener('DOMContentLoaded', Carregar_Tabela());
    document.getElementById('form-pesquisa').addEventListener('submit', function (event) {
        event.preventDefault();
        Carregar_Tabela();
    });

})();

async function Carregar_Tabela() {
    ChamarTelaCarregando("FadeIn");
    try {
        let VrConfirmado = 0;
        let VrAberto = 0;
        const url = "Request/Receita/pesqReceita.php";
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
                if (dados.Dados.length > 0) {
                    for (let i = 0; i < dados.Dados.length; i++) {
                        let tr = tbody.insertRow();
                        let td_Vencimento = tr.insertCell();
                        let td_Descricao = tr.insertCell();
                        let td_vr = tr.insertCell();
                        let td_confirmado = tr.insertCell();
                        let td_acao = tr.insertCell();

                        td_Vencimento.setAttribute("scope", "row")
                        td_Vencimento.classList.add("esconder")
                        td_Vencimento.textContent = formatDate(dados.Dados[i].DataVencimento);
                        td_Descricao.setAttribute("scope", "row")
                        td_Descricao.textContent = dados.Dados[i].Descricao;
                        td_vr.setAttribute("scope", "row")
                        td_vr.classList.add("tex-center")
                        td_vr.textContent = formatarReal(dados.Dados[i].ValorParcela);
                        if (dados.Dados[i].Confirmada === "S") {
                            td_confirmado.innerHTML = `<i class="bi bi-hand-thumbs-up-fill" id="${dados.Dados[i].idCR}" onclick="Confirma('${dados.Dados[i].idCR}')" style="cursor:pointer;"></i>`;
                            VrConfirmado = VrConfirmado + parseFloat(dados.Dados[i].ValorParcela);
                        } else {
                            td_confirmado.innerHTML = `<i class="bi bi-hand-thumbs-down" id="${dados.Dados[i].idCR}" onclick="Confirma('${dados.Dados[i].idCR}')" style="cursor:pointer;"></i>`;
                            VrAberto += parseFloat(dados.Dados[i].ValorParcela);
                        }

                        td_acao.innerHTML = `<i class="bi bi-trash" data-toggle="modal" data-target="#modalExcluir" onclick="Excluir(${dados.Dados[i].idCR})" style="cursor:pointer;"></i> <i class="bi bi-clipboard-check-fill" data-toggle="modal" data-target="#modalEditar" onclick="Editar(${dados.Dados[i].idCR})" style="cursor:pointer;"></i>`
                    }

                    let tfoot_linha1 = document.getElementById("tfoot");
                    tfoot_linha1.textContent = "";

                    const tr2 = tfoot_linha1.insertRow();
                    const td_Confirmado = tr2.insertCell();
                    td_Confirmado.setAttribute("colspan", "5")
                    td_Confirmado.classList.add("text-center")
                    td_Confirmado.style.color = "green";
                    td_Confirmado.textContent = `Valor Confirmado: ${formatarReal(VrConfirmado)}`;


                    const tr = tfoot_linha1.insertRow();
                    const td_Aberto = tr.insertCell();
                    td_Aberto.setAttribute("colspan", "5")
                    td_Aberto.classList.add("text-center")
                    td_Aberto.style.color = "red";
                    td_Aberto.textContent = `Valor em Aberto: ${formatarReal(VrAberto)}`;

                    const tr3 = tfoot_linha1.insertRow();
                    const td_total = tr3.insertCell();
                    td_total.setAttribute("colspan", "5")
                    td_total.classList.add("text-center")
                    td_total.style = "font-weight: bold;";
                    const VrTotal = VrConfirmado + VrAberto;
                    td_total.textContent = `Total: ${formatarReal(VrTotal)}`
                } else {
                    const tr = tbody.insertRow();
                    const td_linha = tr.insertCell();
                    td_linha.setAttribute("colspan", "4")
                    td_linha.classList.add("text-center")
                    td_linha.textContent = "Nenhum Registro encontrado"
                }

                const Categoria = document.getElementById("pesqCategoria");
                const pesqCat = await fetch("Request/Categoria/pesqCategoriaReceita.php?id=todos")
                if (pesqCat.ok) {
                    const dadosCat = await pesqCat.json();
                    if (dadosCat.Retorno == "OK") {
                        dadosCat.Dados.forEach(Cat => {
                            const option = document.createElement("option")
                            if (Cat.idSub !== 0 && Cat.idSub !== null) {
                                option.value = Cat.idSub
                                option.textContent = Cat.DescricaoCat + " -> " + Cat.DescricaoSub

                            } else {
                                option.value = Cat.idCat
                                option.textContent = Cat.DescricaoCat
                            }

                            Categoria.appendChild(option);
                        });

                    }
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
};

async function Confirma(idElemento) {

    const iconeAtual = document.getElementById(`${idElemento}`);

    if (iconeAtual.classList.contains('bi-hand-thumbs-down')) {

        const response = await fetch(`Request/Receita/edtReceita.php?id=${idElemento}&Confirmado=S`);
        if (response.ok) {
            const dados = await response.json();
            if (dados.Retorno == "OK") {
                Carregar_Tabela();
            } else {
                TelaAvisos("falso", "Erro ao tentar confirmar");
            }
        }
    } else {
        const response = await fetch(`Request/Receita/edtReceita.php?id=${idElemento}&Confirmado=N`);
        if (response.ok) {
            const dados = await response.json();
            if (dados.Retorno == "OK") {
                Carregar_Tabela();
            } else {
                TelaAvisos("falso", "Erro ao tentar confirmar");
            }
        }
    }

};