(() => {
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

    document.getElementById("btnCadastro").addEventListener("click", async () => {
        ChamarTelaCarregando("FadeIn");

        const responseConta = await fetch("Request/Conta/pesqConta.php?id=todos")
        if (responseConta.ok) {
            const dadosConta = await responseConta.json();
            if (dadosConta.Retorno == "OK") {
                const selectConta = document.getElementById("cadConta");
                selectConta.innerHTML = "";
                dadosConta.Dados.forEach(Conta => {
                    const optionConta = document.createElement('option')
                    optionConta.value = Conta.IdConta;
                    optionConta.textContent = Conta.DescricaoConta;
                    selectConta.appendChild(optionConta)
                });
            }
        }

        const responseCat = await fetch("Request/Categoria/pesqCategoriaReceita.php?id=todos")
        if (responseCat.ok) {
            const Cat = await responseCat.json();
            if (Cat.Retorno == "OK") {
                selectCat = document.getElementById("cadCategoria");
                selectCat.innerHTML = "";
                selectCat.innerHTML = "<option value='' selected>Selecione uma categoria</option>"
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
                    selectCat.appendChild(optionCat)
                });
            }
        }

        document.getElementById("cadVencimento").value = formatDate("");
        document.getElementById("cadConfirmada").value = "S"
        document.getElementById("cadFixa").value = "N"
        document.getElementById("cadParcelada").value = "N"
        ChamarTelaCarregando("FadeOut");
    })

    /* MODAL CADASTRAR */

    document.getElementById("formCadastro").addEventListener("submit", async (event) => {
        event.preventDefault();
        if (document.getElementById("cadDescricao").value !== "") {
            if (document.getElementById("cadValor").value !== "") {
                if (document.getElementById("cadConta").value !== "") {
                    if (document.getElementById("cadCategoria").value !== "") {
                        document.getElementById("btnCadastrar").querySelector(".carregando").classList.toggle("d-none");
                        const url = "Request/Receita/cadReceita.php";
                        const formCad = new FormData(document.getElementById("formCadastro"))
                        const responseCad = await fetch(url, {
                            method: "POST",
                            body: formCad,
                        })
                        if (responseCad.ok) {
                            const dadosCad = await responseCad.json();
                            if (dadosCad.Retorno == "OK") {
                                document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none");
                                alerta("verdadeiro", "alertaCadastro-mensagem", dadosCad.Motivo);
                                Carregar_Tabela();
                                limparInputs('formCadastro');
                            } else {
                                alerta("falso", "alertaCadastro-mensagem", dadosCad.Motivo);
                            }

                            // Fecha o modal usando JavaScript puro e Bootstrap
                            fecharModal('formCadastro')
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
        if (!document.getElementById("btnCadastrar").querySelector(".carregando").classList.contains("d-none")) {
            document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none");
        }
    }); /* MODAL CADASTRAR */

    /* MODAL EDITAR */

    document.getElementById("btnEditar").addEventListener("click", async () => {
        if (document.getElementById("edtDescricao").value !== "") {
            if (document.getElementById("edtValor").value !== "") {
                if (document.getElementById("edtConta").value !== "") {
                    if (document.getElementById("edtCategoria").value !== "") {
                        document.querySelector(".tela-confirmar-lancamento").classList.toggle("d-none")
                    } else {
                        alerta("falso", "alertaEditar-mensagem", "Selecione uma categoria !")
                    }
                } else {
                    alerta("falso", "alertaEditar-mensagem", "Selecione uma conta !")
                }
            } else {
                alerta("falso", "alertaEditar-mensagem", "Campo valor não pode ser vazio")
            }
        } else {
            alerta("falso", "alertaEditar-mensagem", "Campo Descrição não pode ser vazio")
        }
    })

    document.getElementById("btn-alterar-todos-lancamentos").addEventListener("click", () => {
        document.getElementById("edtAlterar").value = "S"
        document.querySelector(".tela-confirmar-lancamento").classList.toggle("d-none")
        ChamarTelaCarregando("FadeIn");
    });

    document.getElementById("btn-alterar-lancamento").addEventListener("click", () => {
        document.getElementById("edtAlterar").value = "N"
        document.querySelector(".tela-confirmar-lancamento").classList.toggle("d-none")
    });

    document.getElementById("formEditar").addEventListener("submit", async (event) => {
        event.preventDefault();
        const url = "Request/Receita/edtReceita.php";
        const dados = new FormData(document.getElementById("formEditar"))
        const response = await fetch(url, {
            method: "POST",
            body: dados,
        })
        if (response.ok) {
            const Envio = await response.json();
            ChamarTelaCarregando("FadeOut");
            if (Envio.Retorno == "OK") {
                alerta("verdadeiro", "alertaEditar-mensagem", Envio.Motivo)
                Carregar_Tabela();
                fecharModal('formEditar');
            } else {
                alerta("falso", "alertaEditar-mensagem", Envio.Retorno)
            }
        } else {
            ChamarTelaCarregando("FadeOut");
            alerta("falso", "alertaEditar-mensagem", "Erro na sincronização")
        }
    });


    /* MODAL EDITAR */

    /* MODAL EXCLUIR */

    document.getElementById("btnExcluir").addEventListener("click", async () => {
        document.querySelector(".tela-excluir-lancamento").classList.toggle("d-none")
    });

    document.getElementById("btn-excluir-todos-lancamentos").addEventListener("click", () => {
        document.getElementById("excParcelas").value = "S"
    });

    document.getElementById("btn-excluir-lancamento").addEventListener("click", () => {
        document.getElementById("excParcelas").value = "N"
    });

    document.getElementById("formExcluir").addEventListener("submit", async (event) => {
        event.preventDefault();
        document.querySelector(".tela-excluir-lancamento").classList.toggle("d-none")
        ChamarTelaCarregando("FadeIn");
        const excResponse = await fetch(`Request/Receita/delReceita.php?idCR=${document.getElementById("excidCR").value}&todos=${document.getElementById("excParcelas").value}&vencimento=${document.getElementById("excVencimento").value}`);
        if (excResponse.ok) {
            const delDados = await excResponse.json();
            if (delDados.Retorno == "OK") {
                alerta("verdadeiro", "alertaExcluir-mensagem", delDados.Motivo)
                Carregar_Tabela();
                fecharModal('formExcluir');
            } else {
                alerta("falso", "alertaExcluir-mensagem", delDados.Motivo)
            }

        } else {
            alerta("falso", "alertaExcluir-mensagem", "Erro na sincronização")
        }
        ChamarTelaCarregando("FadeOut");
    });

    /* MODAL EXCLUIR */


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
                            VrConfirmado +=  parseFloat(dados.Dados[i].ValorParcela);
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
    ChamarTelaCarregando("FadeIn");

    const iconeAtual = document.getElementById(`${idElemento}`);

    if (iconeAtual.classList.contains('bi-hand-thumbs-down')) {

        const response = await fetch(`Request/Receita/edtReceita.php?id=${idElemento}&Confirmado=S`);
        if (response.ok) {
            const dados = await response.json();
            if (dados.Retorno == "OK") {
                iconeAtual.classList.remove("bi-hand-thumbs-down")
                iconeAtual.classList.add("bi-hand-thumbs-up-fill")
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
                iconeAtual.classList.remove("bi-hand-thumbs-up-fill")
                iconeAtual.classList.add("bi-hand-thumbs-down")
                Carregar_Tabela();
            } else {
                TelaAvisos("falso", "Erro ao tentar confirmar");
            }
        }
    }

    ChamarTelaCarregando("FadeOut");

};

async function Excluir(id) {
    ChamarTelaCarregando("FadeIn");

    const idReceita = FormatarSomenteNumero(id);
    const response = await fetch(`Request/Receita/pesqReceita.php?idCR=${idReceita}`)
    if (response.ok) {
        const dados = await response.json()
        document.getElementById("excDescricao").value = dados.Dados[0].Descricao
        document.getElementById("excidCR").value = idReceita
        document.getElementById("excVencimento").value = timeTempParaDate(dados.Dados[0].DataVencimento)
    } else {
        alerta("falso", "alertaExcluir-mensagem", "Erro na requisição!");
    }

    ChamarTelaCarregando("FadeOut");
};

async function Editar(idReceita) {
    ChamarTelaCarregando("FadeIn");

    const responseConta = await fetch("Request/Conta/pesqConta.php?id=todos")
    if (responseConta.ok) {
        const dadosConta = await responseConta.json();
        if (dadosConta.Retorno == "OK") {
            dadosConta.Dados.forEach(Conta => {
                const option = document.createElement('option')
                option.value = Conta.IdConta;
                option.textContent = Conta.DescricaoConta;
                document.getElementById("edtConta").appendChild(option)
            });
        }
    }

    const responseCat = await fetch("Request/Categoria/pesqCategoriaReceita.php?id=todos")
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
                document.getElementById("edtCategoria").appendChild(optionCat)
            });
        }
    }

    const id = FormatarSomenteNumero(idReceita);
    const response = await fetch(`Request/Receita/pesqReceita.php?idCR=${id}`)
    if (response.ok) {
        const resposta = await response.json();
        if (resposta.Retorno == "OK") {
            document.getElementById("edtDescricao").value = resposta.Dados[0].Descricao
            document.getElementById("edtValor").value = formatarReal(resposta.Dados[0].ValorParcela)
            document.getElementById("edtVencimento").value = timeTempParaDate(resposta.Dados[0].DataVencimento)
            document.getElementById("edtidCR").value = id
            document.getElementById("edtControle").value = resposta.Dados[0].Controle
            document.getElementById("edtConta").value = resposta.Dados[0].idConta
            document.getElementById("edtAlterar").value = "N"
            if (resposta.Dados[0].Parcelada == "S" || resposta.Dados[0].Fixa == "S") {
                document.getElementById("edtParcelado").value = "S"
            } else {
                document.getElementById("edtParcelado").value = "N"
            }
            const idCategoria = resposta.Dados[0].idCategoria;
            const idSubCategoria = resposta.Dados[0].id_SubCategoria;
            document.getElementById("edtSub").value = idSubCategoria
            const elementoSelect = document.getElementById("edtCategoria")
            for (let option of elementoSelect.options) {
                if (option.value == idCategoria && option.getAttribute("data-sub") == idSubCategoria) {
                    option.selected = true;
                    break;
                }
            }
            if (resposta.Dados[0].Confirmada == "S") {
                document.getElementById("edtBtnConfirmada").classList.add("bi-hand-thumbs-up-fill")
                document.getElementById("edtConfirmada").value = "S"
                document.getElementById("edtBtnConfirmada").setAttribute("data-id", "S")
            } else {
                document.getElementById("edtBtnConfirmada").classList.add("bi-hand-thumbs-down")
                document.getElementById("edtConfirmada").value = "N"
                document.getElementById("edtBtnConfirmada").setAttribute("data-id", "N")
            }
        }
    }

    ChamarTelaCarregando("FadeOut");
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