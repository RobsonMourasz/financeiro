

(async () => {

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

    /* MODAL CADASTRAR */

    document.getElementById("btnCadastro").addEventListener("click", async () => {
        ChamarTelaCarregando("FadeIn");

        const responseConta = await fetch("Request/Conta/pesqConta.php?id=todos")
        if (responseConta.ok) {
            const dadosConta = await responseConta.json();
            if (dadosConta.Retorno == "OK") {
                dadosConta.Dados.forEach(Conta => {
                    const option = document.createElement('option')
                    option.value = Conta.IdConta;
                    option.textContent = Conta.DescricaoConta;
                    document.getElementById("cadConta").appendChild(option)
                });
            }
        }

        const responseCat = await fetch("Request/Categoria/pesqCategoriaDespesa.php?id=todos")
        if (responseCat.ok) {
            const Cat = await responseCat.json();
            if (Cat.Retorno == "OK") {
                Cat.Dados.forEach(Categoria => {
                    const optionCat = document.createElement("option")
                    if (Categoria.idSub !== 0 && Categoria.idSub !== null) {
                        optionCat.value = Categoria.idCat
                        optionCat.textContent = Categoria.DescricaoCat + " -> " + Categoria.DescricaoSub
                        optionCat.setAttribute("data-sub", Categoria.idSub)                       
                    } else {
                        optionCat.value = Categoria.idCat
                        optionCat.textContent = Categoria.DescricaoCat
                        optionCat.setAttribute("data-sub", Categoria.idSub)
                    }
                    document.getElementById("cadCategoria").appendChild(optionCat)
                });
            }
        }

        document.getElementById("cadVencimento").value = formatDate("");

        ChamarTelaCarregando("FadeOut");
    })

    /* MODAL CADASTRAR */



    document.getElementById("formCadastro").addEventListener("submit", async (event) => {
        event.preventDefault();
        if (document.getElementById("cadDescricao").value !== "") {
            if (document.getElementById("cadValor").value !== "") {
                if (document.getElementById("cadConta").value !== "") {
                    if (document.getElementById("cadCategoria").value !== "") {
                        const url = "Request/Despesa/cadDespesa.php";
                        const formCad = new FormData(document.getElementById("formCadastro"))
                        const responseCad = await fetch(url, {
                            method: "POST",
                            body: formCad,
                        })
                        if (responseCad.ok) {
                            const dadosCad = await responseCad.json();
                            if (dadosCad.Retorno == "OK") {
                                alerta("verdadeiro", "alertaCadastro-mensagem", dadosCad.Motivo);
                                setInterval(() => {
                                    location.reload();
                                }, 4000)
                                
                            } else {
                                alerta("falso", "alertaCadastro-mensagem", dadosCad.Motivo);
                            }

                        } else {
                            alerta("falso", "alertaCadastro-mensagem", "Erro de requisição");
                        }
                    } else {
                        alerta("falso", "alertaCadastro-mensagem", "Campo Categoria não pode estar vazio");
                    }
                } else {
                    alerta("falso", "alertaCadastro-mensagem", "Campo Conta não pode estar vazio");
                }
            } else {
                alerta("falso", "alertaCadastro-mensagem", "Campo valor não pode estar vazio");
            }
        } else {
            alerta("falso", "alertaCadastro-mensagem", "Campo descricao não pode estar vazio");
        }
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
                if (dados.Dados.length > 0) {
                    for (let i = 0; i < dados.Dados.length; i++) {
                        let tr = tbody.insertRow();
                        let td_Vencimento = tr.insertCell();
                        let td_Descricao = tr.insertCell();
                        let td_vr = tr.insertCell();
                        let td_confirmado = tr.insertCell();
                        let td_acao = tr.insertCell();

                        td_Vencimento.setAttribute("scope", "row")
                        td_Vencimento.textContent = formatDate(dados.Dados[i].DataVencimento);
                        td_Descricao.setAttribute("scope", "row")
                        td_Descricao.textContent = dados.Dados[i].Descricao;
                        td_vr.setAttribute("scope", "row")
                        td_vr.classList.add("tex-center")
                        td_vr.textContent = formatarReal(dados.Dados[i].ValorParcela);
                        if (dados.Dados[i].Confirmada === "S") {
                            td_confirmado.innerHTML = `<i class="bi bi-hand-thumbs-up-fill" id="${dados.Dados[i].idCR}" onclick="Confirma('${dados.Dados[i].idCR}')" style="cursor:pointer;"></i>`;
                        } else {
                            td_confirmado.innerHTML = `<i class="bi bi-hand-thumbs-down" id="${dados.Dados[i].idCR}" onclick="Confirma('${dados.Dados[i].idCR}')" style="cursor:pointer;"></i>`;
                        }

                        td_acao.innerHTML = `<i class="bi bi-trash" data-toggle="modal" data-target="#modalExcluir" onclick="Excluir(${dados.Dados[i].idCR})" style="cursor:pointer;"></i> <i class="bi bi-clipboard-check-fill" data-toggle="modal" data-target="#modalEditar" onclick="Editar(${dados.Dados[i].idCR})" style="cursor:pointer;"></i>`

                    }
                } else {
                    const tr = tbody.insertRow();
                    const td_linha = tr.insertCell();
                    td_linha.setAttribute("colspan", "4")
                    td_linha.classList.add("text-center")
                    td_linha.textContent = "Nenhum Registro encontrado"
                }
                const Categoria = document.getElementById("pesqCategoria");
                const pesqCat = await fetch("Request/Categoria/pesqCategoria.php?id=todos")
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

        const response = await fetch(`Request/Despesa/edtDespesa.php?id=${idElemento}&Confirmado=S`);
        if (response.ok) {
            const dados = await response.json();
            if (dados.Retorno == "OK") {
                iconeAtual.classList.remove("bi-hand-thumbs-down")
                iconeAtual.classList.add("bi-hand-thumbs-up-fill")
            } else {
                TelaAvisos("falso", "Erro ao tentar confirmar");
            }
        }
    } else {
        const response = await fetch(`Request/Despesa/edtDespesa.php?id=${idElemento}&Confirmado=N`);
        if (response.ok) {
            const dados = await response.json();
            if (dados.Retorno == "OK") {
                iconeAtual.classList.remove("bi-hand-thumbs-up-fill")
                iconeAtual.classList.add("bi-hand-thumbs-down")
            } else {
                TelaAvisos("falso", "Erro ao tentar confirmar");
            }
        }
    }

};

function alerta(TipoAlerta, IdElemento, mensagem) {

    if (TipoAlerta == "verdadeiro") {
        document.getElementById(IdElemento).querySelector(".alert").textContent = `${mensagem}`
        document.getElementById(IdElemento).querySelector(".alert").style = "font-size: 1.5em; color:#26a632;"
        setInterval(() => {
            document.getElementById(IdElemento).querySelector(".alert").textContent = ""
        }, 3000)
    } else {
        document.getElementById(IdElemento).querySelector(".alert").textContent = `${mensagem}`
        document.getElementById(IdElemento).querySelector(".alert").style = "font-size: 1.5em; color:#f10d06;"
        setInterval(() => {
            document.getElementById(IdElemento).querySelector(".alert").textContent = ""
        }, 3000)
    }

};

document.getElementById('cadCategoria').addEventListener('change', function(event) {
    const selectedOption = event.target.options[event.target.selectedIndex];
    const atributo = selectedOption.getAttribute('data-sub');
    document.getElementById("cadSub").value = atributo;
});