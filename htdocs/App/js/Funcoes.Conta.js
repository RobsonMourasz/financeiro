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

})();

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
            acoes.innerHTML = `<i class="bi bi-pencil-square" data-toggle="modal" data-target="#modalEditar" style="cursor:pointer;"></i> <i class="bi bi-trash3" data-toggle="modal" data-target="#modalExcluir" style="cursor:pointer;"></i>`;
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