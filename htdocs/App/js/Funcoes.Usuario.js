(() => {
    CarregarTabela()

    document.getElementById("cadRepitaSenhaUser").addEventListener("focusout", () => {
        let senha = document.getElementById("cadSenhaUser")
        let Rep_senha = document.getElementById("cadRepitaSenhaUser")
        if (Rep_senha.value != "" && Rep_senha.value != undefined) {
            if (senha.value !== Rep_senha.value) {
                alerta("verdadeiro", "alertaCadastro-mensagem", "Senhas não conferem")
                Rep_senha.style.backgroundColor = "#fb4747"
                setInterval(() => {
                    Rep_senha.style.backgroundColor = "transparent"
                    Rep_senha.focus()
                }, 3000)
            }
        }
    });

    document.getElementById("edtRepitaSenha").addEventListener("focusout", () => {
        let senha = document.getElementById("edtSenhaUser")
        let Rep_senha = document.getElementById("edtRepitaSenhaUser")
        if (Rep_senha.value != "" && Rep_senha.value != undefined) {
            if (senha.value !== Rep_senha.value) {
                alerta("falso", "alertaCadastro-mensagem", "Senhas não conferem")
                Rep_senha.style.backgroundColor = "#fb4747"
                setInterval(() => {
                    Rep_senha.style.backgroundColor = "transparent"
                    Rep_senha.focus()
                }, 3000)
            }
        }
    });

    document.getElementById("formCadastro").addEventListener("submit", async (event) => {
        event.preventDefault()
        document.querySelector("#btnCadastrar .carregando").classList.toggle("d-none")
        if (document.getElementById("cadNivel").value !== "") {

            if (document.getElementById("cadNomeUser").value !== "") {

                if (document.getElementById("cadSenhaUser").value != "") {

                    if (document.getElementById("cadSenhaUser").value == document.getElementById("cadRepitaSenhaUser").value) {
                        const url = "Request/Usuario/cadUser.php";
                        const formulario = document.getElementById("formCadastro")
                        let form = new FormData(formulario)

                        const response = await fetch(url, {
                            method: "POST",
                            body: form,
                        })
                        document.getElementById("btnCadastrar").querySelector(".carregando").classList.remove("d-none")
                        if (response.ok) {
                            const resposta = await response.json()
                            if (resposta.Retorno === "OK") {

                                alerta("verdadeiro", "alertaCadastro-mensagem", resposta.Motivo)
                                document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                            } else {
                                alerta("false", "alertaCadastro-mensagem", resposta.Motivo)
                                document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                            }
                        } else {
                            alerta("false", "alertaCadastro-mensagem", response.error)
                            document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                        }
                        location.reload()
                    } else {
                        alerta("falso", "alertaCadastro-mensagem", "Confira a senha!")
                    }

                } else {
                    console.log("Nome vazio")
                    alerta("falso", "alertaCadastro-mensagem", "Campo senha nao pode ser vazio")
                }

            } else {
                console.log("Nome vazio")
                alerta("falso", "alertaCadastro-mensagem", "Campo nome nao pode ser vazio")
            }
        } else {
            console.log("Selecione o Nivel")
            alerta("falso", "alertaCadastro-mensagem", "Selecione o Nivel")
        }
        document.querySelector("#btnCadastrar .carregando").classList.toggle("d-none")
    });

    document.getElementById("formEditar").addEventListener("submit", async (event) => {
        event.preventDefault()
        document.querySelector("#btnEditar .carregando").classList.toggle("d-none")
        if (document.getElementById("edtNomeUser").value != "") {

            if(document.getElementById("edtSenhaUser").value === document.getElementById("edtRepitaSenha").value){

                if(document.getElementById("edtNivel").value !== "" ){
                    document.getElementById("edtEmailUser").disabled = false;
                    const formEdt = new FormData(document.getElementById("formEditar"))
                    const url = "Request/Usuario/edtUser.php"
                    const response = await fetch(url,{
                        method: "POST",
                        body: formEdt,
                    })

                    if(response.ok){
                        document.getElementById("edtEmailUser").disabled = true;
                        const dados = await response.json()

                        if(dados.Retorno == "OK"){

                            alerta("verdadeiro", "alertaEditar-mensagem", dados.Motivo)
                            location.reload()

                        }else{
                            alerta("false", "alertaEditar-mensagem", dados.Motivo);
                        }

                    }else{
                        alerta("false", "alertaEditar-mensagem", "ERRO AO GERAR CONSULTA")
                    }

                }else{
                    alerta("false", "alertaEditar-mensagem", "Campo Nivel não pode ser vazio!")
                }

            }else{
                alerta("false", "alertaEditar-mensagem", "Verifique a senha!")
            }

        }else {
            alerta("false", "alertaEditar-mensagem", "Campo Nome não pode ser vazio!")
        }
        document.querySelector("#btnEditar .carregando").classList.toggle("d-none")
    });

    document.getElementById("formExcluir").addEventListener("submit", async (event) => {
        event.preventDefault()
        document.querySelector("#btnExcluir .carregando").classList.toggle("d-none")
        try {
            const response = await fetch(`Request/Usuario/excUser.php?idUser=${document.getElementById("excidUser").value}&EmailUser=${document.getElementById("excEmailUser").value}`)
            if( response.ok ){
                const excDados = await response.json();
                if (excDados.Retorno == "OK") {
                    alerta("verdadeiro", "alertaExcluir-mensagem", excDados.Motivo);
                    setInterval(()=>{
                        location.reload();
                    },3000);
                }else{
                    alerta("falso", "alertaExcluir-mensagem", excDados.Motivo);
                }
            }else{
                alerta("falso", "alertaExcluir-mensagem", "Erro de requisição");
            }
        } catch (error) {
            alerta("falso", "alertaExcluir-mensagem", "Erro na requisição");
        }
        document.querySelector("#btnExcluir .carregando").classList.toggle("d-none")
    });

})();


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

async function EditarUser(id) {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    const response = await fetch(`Request/Usuario/pesqUser.php?id=${id}`)
    if (response.ok) {
        const dados = await response.json()
        document.getElementById("edtIdUser").value = id
        document.getElementById("edtNomeUser").value = dados.Dados[0].NomeUser
        document.getElementById("edtEmailUser").value = dados.Dados[0].EmailUser
        document.getElementById("edtEmailUser").disabled = true
        document.getElementById("edtcpf_cnpj").value = FormatarCpfCnpj(dados.Dados[0].cpf_cnpj)
        const Select = document.getElementById("edtNivel")
        for (let i = 0; i < Select.options.length; i++) {
            if (Select.options[i].value == dados.Dados[0].Nivel) {
                Select.options[i].selected = true
            }

        }
    } else {
        alerta("falso", "alertaEditar-mensagem", "Erro ao buscar")
        console.log(response.error)
    }
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
}

async function ExcluirUser(id) {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    const response = await fetch(`Request/Usuario/pesqUser.php?id=${id}`)
    if (response.ok) {
        const dados = await response.json()
        document.getElementById("excidUser").value = id
        document.getElementById("excNome").value = dados.Dados[0].NomeUser
        document.getElementById("excEmailUser").value = dados.Dados[0].EmailUser
    } else {
        alerta("falso", "alertaEditar-mensagem", "Erro ao buscar")
        console.log(response.error)
    }
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
};

async function CarregarTabela() {
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
    let tbody = document.getElementById("tbody")
    tbody.innerText = ""
    response = await fetch("Request/Usuario/pesqUser.php?id=todos")
    if (response.ok) {
        const user = await response.json()
        for (let i = 0; i < user.Dados.length; i++) {
            let tr = tbody.insertRow();
            let td_id = tr.insertCell();
            let td_Nome = tr.insertCell();
            let td_Email = tr.insertCell();
            let td_Nivel = tr.insertCell();
            let td_acoes = tr.insertCell();
            td_id.innerText = user.Dados[i].idUser;
            td_id.classList.add("esconder")
            td_Nome.innerText = user.Dados[i].NomeUser;
            td_Nome.classList.add("esconder")
            td_Email.innerText = user.Dados[i].EmailUser;
            td_Nivel.innerText = user.Dados[i].Nivel;
            td_Nivel.classList.add("esconder")
            td_acoes.innerHTML = `<i class="bi bi-pencil-square"  data-toggle="modal" data-target="#modalEditar"  style="cursor:pointer;" onclick="EditarUser(${user.Dados[i].idUser})"></i> <i class="bi bi-trash3" data-toggle="modal" data-toggle="modal" data-target="#modalExcluir" style="cursor:pointer;" onclick="ExcluirUser(${user.Dados[i].idUser})"></i>`;
        }
    }
    document.querySelector(".tela-cadastrar").classList.toggle("d-none")
};