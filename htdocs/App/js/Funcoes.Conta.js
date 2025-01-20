(() => {
    PreencherTabela();

    document.getElementById("formCadastro").addEventListener("submit", async(event)=>{
        event.preventDefault();
        if(document.getElementById("cadDescricaoConta").value !== ""){
            document.getElementById("btnCadastrar").querySelector(".carregando").classList.toggle("d-none")
            const url = "Request/Conta/cadConta.php";
            const CadForm = new FormData(document.getElementById("formCadastro"))
            const response = await fetch(url,{
                method:"POST",
                body:CadForm,
            })

            if(response.ok){
                const dados = await response.json();
                if(dados.Retorno == "OK"){
                    alerta("verdadeiro", "alertaCadastro-mensagem", dados.Motivo)
                    location.reload()
                }else{
                    alerta("falso", "alertaCadastro-mensagem", dados.Motivo)
                }
            }else{
                alert("Falha ao cadastrar")
            }

        }else{
            alerta("false", "alertaCadastro-mensagem", "Campo nome não pode estar vazio")
        }
        document.getElementById("btnCadastrar").querySelector(".carregando").classList.toggle("d-none")

    });

    document.getElementById("formEditar").addEventListener("submit", async (event)=>{
        event.preventDefault()
        if(document.getElementById("edtDescricaoConta").value !== ""){
            document.getElementById("btnEditar").querySelector(".carregando").classList.toggle("d-none")
            const url = "Request/Conta/edtConta.php"
            const formEdit = new FormData(document.getElementById("formEditar"))
            const response = await fetch(url,{
                method: "POST",
                body: formEdit,
            })

            if(response.ok){
                const dados =  await response.json()
                if(dados.Retorno == "OK"){
                    alerta("verdadeiro", "alertaEditar-mensagem", dados.Motivo)
                    location.reload()
                }else{
                    alerta("falso", "alertaEditar-mensagem", dados.Motivo)
                }

            }else{
                alert("Erro na requisição")
            }

        }else{
            alerta("falso", "alertaCadastro-mensagem", "Campo descricao não pode ser vazio")
        }
        document.getElementById("btnEditar").querySelector(".carregando").classList.toggle("d-none")
    });

    document.getElementById("formExcluir").addEventListener("submit", async (event)=>{
        event.preventDefault()
        document.getElementById("btnExcluir").querySelector(".carregando").classList.toggle("d-none")
        const response = (await fetch(`Request/Conta/excConta.php?id=${document.getElementById("excidConta").value}`))
        if(response.ok){
            const dados =  await response.json()
            if(dados.Retorno == "OK"){
                alerta("verdadeiro", "alertaExcluir-mensagem", dados.Motivo)
                location.reload()
            }else{
                alerta("falso", "alertaExcluir-mensagem", dados.Motivo)
            }
        }else{
            alert("Erro na requisição")
        }
        document.getElementById("btnExcluir").querySelector(".carregando").classList.toggle("d-none")
    });

})();

async function Excluir(id) {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    const response = await fetch(`Request/Conta/PesqConta?id=${id}`)
    if(response.ok){
        const dados = await response.json()
        if(dados.Retorno == "OK"){
            document.getElementById("excDescricaoConta").value = dados.Dados[0].DescricaoConta
            document.getElementById("excSaldoConta").value = dados.Dados[0].SaldoConta
            document.getElementById("excidConta").value = dados.Dados[0].IdConta
        }else{
            alerta("false", "alertaCadastro-mensagem", dados.Motivo)
        }
    }else{
        alert("Erro na requisição")
    }
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
}

async function Editar(id) {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    const response = await fetch(`Request/Conta/PesqConta?id=${id}`)
    if(response.ok){
        const dados = await response.json()
        if(dados.Retorno == "OK"){
            document.getElementById("edtDescricaoConta").value = dados.Dados[0].DescricaoConta
            document.getElementById("edtSaldoConta").value = dados.Dados[0].SaldoConta
            document.getElementById("edtIdConta").value = dados.Dados[0].IdConta
        }else{
            alerta("false", "alertaCadastro-mensagem", dados.Motivo)
        }
    }else{
        alert("Erro na requisição")
    }
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
}

async function PreencherTabela() {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    let body = document.getElementById("tbody")
    let tr = body.insertRow();
    let td_id = tr.insertCell();
    let td_descricao = tr.insertCell();
    let td_saldo = tr.insertCell();
    let acoes = tr.insertCell();
    const response = await fetch("Request/Conta/pesqConta?id=todos")
    if(response.ok){
        const dados = await response.json();
        for (let i = 0; i < dados.Dados.length; i++) {
            td_id.innerText = dados.Dados[i].IdConta
            td_descricao.innerText = dados.Dados[i].DescricaoConta
            td_saldo.innerText = dados.Dados[i].SaldoConta
            acoes.innerHTML = `<i class="bi bi-pencil-square" data-toggle="modal" data-target="#modalEditar" style="cursor:pointer"; onclick="Editar(${dados.Dados[i].IdConta})"></i> <i class="bi bi-trash3" data-toggle="modal" data-target="#modalExcluir" style="cursor:pointer;" onclick="Excluir(${dados.Dados[i].IdConta})"></i>`;
        }

    }else{
        console.log("DEU MERDA")
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