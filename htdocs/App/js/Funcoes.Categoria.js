(() => {
    CarregarTabela()

    document.getElementById("formCadastro").addEventListener("submit", async (event)=>{
        event.preventDefault()
        if(document.getElementById("cadDescricaoCat").value !== ""){
            if(document.getElementById("cadTipo").value !== ""){
                document.getElementById("btnCadastrar").querySelector(".carregando").classList.toggle("d-none")
                const url = "Request/Categoria/cadCategoria.php"
                const formCad = new FormData(document.getElementById("formCadastro"))
                const response = await fetch(url, {
                    method: "POST",
                    body:formCad,
                })
                if(response.ok){
                    const dados = await response.json()
                    if(dados.Retorno == "OK"){
                        alerta("verdadeiro", "alertaCadastro-mensagem", dados.Motivo)
                        location.reload()
                    }else{
                        alerta("false", "alertaCadastro-mensagem", "Erro ao tentar cadastrar")
                    }
                }else{
                    alert("ERRO na requisição")
                }
            }else{
                alerta("false", "alertaCadastro-mensagem", "Campo Tipo não pode ser vazio!")  
            }
        }else{
            alerta("false", "alertaCadastro-mensagem", "Campo descrição não pode ser vazio!")
        }

        document.getElementById("btnCadastrar").querySelector(".carregando").classList.toggle("d-none")
    });

})();

async function CarregarTabela() {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    let tbody = document.getElementById("tbody");
    tbody.innerHTML = ""

    const response = await fetch("Request/Categoria/pesqCategoria?id=todos")
    if(response.ok){
        const dados = await response.json()
        if(dados.Retorno == "OK"){
            for (let i = 0; i < dados.Dados.length; i++) {
                let th = tbody.insertRow();
                let td_idCat = th.insertCell();
                let td_DescricaoCat = th.insertCell();
                let td_Sub = th.insertCell();
                let td_Tipo = th.insertCell();
                let td_Acoes = th.insertCell();
                td_idCat.innerText = dados.Dados[i].idCat
                td_DescricaoCat.innerText = dados.Dados[i].DescricaoCat
                if(dados.Dados[i].DescricaoSub == null){
                    td_Sub.innerText = "-----"
                }else{
                    td_idCat.innerText = dados.Dados[i].idCat + "-" + dados.Dados[i].idSub
                }
                if(dados.Dados[i].Tipo ==="D"){
                    td_Tipo.innerText = "Despesa"
                }else{
                    td_Tipo.innerText = "Receita"
                }
                td_Acoes.innerHTML = `<i class="bi bi-clipboard-check-fill" data-toggle="modal" data-target="#modalEditar" style="cursor: pointer;"></i> <i class="bi bi-trash" data-toggle="modal" data-target="#modalExcluir" style="cursor: pointer;"></i>`
            }
        }else{
            alert(dados.Motivo)
        }       
    }else{
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