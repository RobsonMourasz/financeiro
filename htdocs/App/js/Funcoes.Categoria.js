(() => {
    CarregarTabela()

    document.getElementById("formCadastro").addEventListener("submit", async (event) => {
        event.preventDefault()
        if (document.getElementById("cadDescricaoCat").value !== "") {
            if (document.getElementById("cadTipo").value !== "") {
                document.getElementById("btnCadastrar").querySelector(".carregando").classList.toggle("d-none")
                const url = "Request/Categoria/cadCategoria.php"
                const formCad = new FormData(document.getElementById("formCadastro"))
                const response = await fetch(url, {
                    method: "POST",
                    body: formCad,
                })
                if (response.ok) {
                    const dados = await response.json()
                    if (dados.Retorno == "OK") {
                        alerta("verdadeiro", "alertaCadastro-mensagem", dados.Motivo)
                        location.reload()
                    } else {
                        alerta("false", "alertaCadastro-mensagem", "Erro ao tentar cadastrar")
                    }
                } else {
                    alert("ERRO na requisição")
                }
            } else {
                alerta("false", "alertaCadastro-mensagem", "Campo Tipo não pode ser vazio!")
            }
        } else {
            alerta("false", "alertaCadastro-mensagem", "Campo descrição não pode ser vazio!")
        }

        document.getElementById("btnCadastrar").querySelector(".carregando").classList.remove("d-none")
    });

    document.getElementById("formEditar").addEventListener("submit", async (event) => {
        event.preventDefault()
        if (document.getElementById("cadDescricaoCat").value !== "") {
            if (document.getElementById("cadTipo").value !== "") {
                document.getElementById("btnCadastrar").querySelector(".carregando").classList.toggle("d-none")
                try {
                    const url = "Request/Categoria/edtCategoria.php"
                    const formEdit = new FormData(document.getElementById("formEditar"))
                    const response = await fetch(url, {
                        method: "POST",
                        body: formEdit,
                    })
                    if (response.ok) {
                        const dados = await response.json()
                        if (dados.Retorno == "OK") {
                            alerta("verdadeiro", "alertaEditar-mensagem", dados.Motivo)
                        } else {
                            alerta("falso", "alertaEditar-mensagem", dados.Motivo)
                        }

                    } else {
                        alert("Erro na requisição")
                    }

                } catch (error) {
                    alert("Erro ao enviar formulário")
                }
            } else {
                alerta("falso", "alertaEditar-mensagem", "Campo descrição não pode ser vazio")
            }
        } else {
            alerta("falso", "alertaEditar-mensagem", "Campo descrição não pode ser vazio")
        }
        document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
    })

    document.getElementById("formExcluir").addEventListener("submit", async (event) => {
        event.preventDefault()
        try {
            document.getElementById("btnExcluir").querySelector(".carregando").classList.toggle("d-none")
            const response = await fetch(`Request/Categoria/excCategoria.php?idCat=${document.getElementById("excIdCat").value}&idSub=${document.getElementById("excIdSub").value}`)
            const dados = await response.json()
            if (dados.Retorno == "OK") {
                alerta("verdadeiro", "alertaExcluir-mensagem", dados.Motivo)
                document.getElementById("btnExcluir").querySelector(".carregando").classList.add("d-none")
            } else {
                alerta("falso", "alertaExcluir-mensagem", dados.Motivo)
                document.getElementById("btnExcluir").querySelector(".carregando").classList.add("d-none")
            }
            location.reload()
        } catch (error) {
            alert("Erro ao enviar formulário: "+ error)
            document.getElementById("btnExcluir").querySelector(".carregando").classList.add("d-none")
        }
        
    });

})();

async function CarregarTabela() {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    let tbody = document.getElementById("tbody");
    tbody.innerHTML = ""

    const response = await fetch("Request/Categoria/pesqCategoria?id=todos")
    if (response.ok) {
        const dados = await response.json()
        if (dados.Retorno == "OK") {
            for (let i = 0; i < dados.Dados.length; i++) {
                let th = tbody.insertRow();
                let td_idCat = th.insertCell();
                let td_DescricaoCat = th.insertCell();
                let td_Sub = th.insertCell();
                let td_Tipo = th.insertCell();
                let td_Acoes = th.insertCell();
                td_idCat.innerText = dados.Dados[i].idCat
                td_DescricaoCat.innerText = dados.Dados[i].DescricaoCat
                if (dados.Dados[i].DescricaoSub == null) {
                    td_Sub.innerText = "-----"
                } else {
                    td_Sub.innerText = dados.Dados[i].DescricaoSub
                    td_idCat.innerText = dados.Dados[i].idCat + "-" + dados.Dados[i].idSub
                }
                if (dados.Dados[i].Tipo === "D") {
                    td_Tipo.innerText = "Despesa"
                } else {
                    td_Tipo.innerText = "Receita"
                }
                td_Tipo.classList.add("esconder")
                td_Acoes.innerHTML = `<i class="bi bi-clipboard-check-fill" data-toggle="modal" data-target="#modalEditar" style="cursor: pointer;" onclick="Editar(${dados.Dados[i].idCat})"></i> <i class="bi bi-trash" data-toggle="modal" data-target="#modalExcluir" style="cursor: pointer;" onclick="Excluir(${dados.Dados[i].idCat})"></i>`
            }
        } else {
            alert(dados.Motivo)
        }
    } else {
        alert("Erro na requisição")
    }
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
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

async function Editar(id) {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    const response = await fetch(`Request/Categoria/pesqCategoria.php?id=${id}`)
    if (response.ok) {
        const dados = await response.json()
        if (dados.Retorno == "OK") {
            document.getElementById("edtDescricaoCat").value = dados.Dados[0].DescricaoCat
            document.getElementById("edtTipo").value = dados.Dados[0].Tipo
            document.getElementById("edtDescricaoSub").value = dados.Dados[0].DescricaoSub
            document.getElementById("edtIdCat").value = id
            if (dados.Dados[0].idSub === null) {
                document.getElementById("edtIdSub").value = 0
            } else {
                document.getElementById("edtIdSub").value = dados.Dados[0].idSub
            }
        } else {
            alert("ERRO" + dados.Motivo)
        }
    } else {
        alert("ERRO na requisição")
    }

    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
}

async function Excluir(id) {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    const response = await fetch(`Request/Categoria/pesqCategoria.php?id=${id}`)
    if (response.ok) {
        const dados = await response.json()
        if (dados.Retorno == "OK") {
            document.getElementById("excDescricaoCat").value = dados.Dados[0].DescricaoCat
            if (dados.Dados[0].DescricaoSub === null) {
                document.getElementById("excDescricaoSub").value = "----"
            } else {
                document.getElementById("excDescricaoSub").value = dados.Dados[0].DescricaoSub
            }
            document.getElementById("excIdCat").value = id
            if (dados.Dados[0].idSub === null) {
                document.getElementById("excIdSub").value = 0
            } else {
                document.getElementById("excIdSub").value = dados.Dados[0].idSub
            }
        } else {
            alert("ERRO: " + dados.Motivo)
        }
    } else {
        alert("ERRO na requisição")
    }

    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
}