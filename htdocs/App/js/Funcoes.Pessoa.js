(() => {

    document.getElementById("btnCadastrar").addEventListener("click", async (event) => {
        event.preventDefault(); // Evita o comportamento padrão do formulário
        document.getElementById("btnCadastrar").querySelector(".carregando").classList.remove("d-none")
        const url = 'Request/Pessoa/cadPessoa.php'; // Substitua pela sua URL de destino
        const nome = document.getElementById('cadSocial').value;
        const Formulario = document.querySelector("#formCadastro");

        const form = new FormData(Formulario);

        if (nome !== "") {
            try {

                const response = await fetch(url, {
                    method: 'POST',
                    body: form, // Use o FormData diretamente como corpo da requisição
                });

                if (response.ok) {
                    const data = await response.json(); // Parse do JSON retornado pelo servidor

                    if (data.Retorno == "OK") {

                        document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                        document.querySelector("#alertaCadastro-mensagem").textContent = data.Motivo
                        document.querySelector("#alertaCadastro-mensagem").style.color = "green"
                        setTimeout(() => {
                            document.querySelector("#alertaCadastro-mensagem").textContent = ""
                            location.reload()
                        }, 2000)


                    } else {

                        document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                        document.querySelector("#alertaCadastro-mensagem").textContent = data.Motivo
                        document.querySelector("#alertaCadastro-mensagem").style.color = "green"
                        setTimeout(() => {
                            document.querySelector("#alertaCadastro-mensagem").textContent = ""
                        }, 2000)
                        console.error('Erro na requisição:', data.Motivo);

                    }
                }
            } catch (error) {

                document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                document.querySelector("#alertaCadastro-mensagem").textContent = "Erro na requisição"
                setTimeout(() => {
                    document.querySelector("#alertaCadastro-mensagem").textContent = ""
                }, 2000)
                console.error('Erro na requisição:', error);

            }
        }


    });



    /* FETCH PARA EDITAR */
    document.getElementById("btnEditar").addEventListener("click", async (event) => {
        event.preventDefault(); // Evita o comportamento padrão do formulário
        document.getElementById("btnEditar").querySelector(".carregando").classList.remove("d-none")
        const url = 'Request/Pessoa/edtPessoa.php'; // Substitua pela sua URL de destino
        const Formulario = document.querySelector("#formEditar");
        const form = new FormData(Formulario);
        const response = await fetch(url, {
            method: 'POST',
            body: form, // Use o FormData diretamente como corpo da requisição
        });

        if (response.ok) {
            const RespEditar = await response.json()
            if(RespEditar.Retorno == "OK"){
                document.getElementById("btnEditar").querySelector(".carregando").classList.add("d-none")
                document.getElementById("alertaEditar-mensagem").querySelector(".alert").style="color: green;font-size: 1.2em;"
                document.getElementById("alertaEditar-mensagem").querySelector(".alert").textContent = RespEditar.Motivo
                setInterval(()=>{
                    document.getElementById("alertaEditar-mensagem").querySelector(".alert").textContent = ""
                    location.reload()
                },3000)
            }else{
                document.getElementById("btnEditar").querySelector(".carregando").classList.add("d-none")
                document.getElementById("alertaEditar-mensagem").querySelector(".alert").style="color: red;font-size: 1.2em;"
                document.getElementById("alertaEditar-mensagem").querySelector(".alert").textContent = RespEditar.Motivo
                setInterval(()=>{
                    document.getElementById("alertaEditar-mensagem").querySelector(".alert").textContent = ""
                    location.reload()
                },3000)  
                console.error('Erro na requisição:', RespExcluir.Motivo);
            }
        }else{
            alert("")
        }
    });

    /* FETCH PARA EXCLUIR */
    document.getElementById("btnExcluir").addEventListener("click", async () => {
        document.getElementById("btnExcluir").querySelector(".carregando").classList.remove("d-none")
        const response = await fetch(`Request/Pessoa/excPessoa.php?id= ${document.getElementById("excIdPessoa").value}`)
        if (response.ok) {
            const RespExcluir = await response.json()
            if(RespExcluir.Retorno == "OK"){
                document.getElementById("btnExcluir").querySelector(".carregando").classList.add("d-none")
                document.getElementById("alertaExcluir-mensagem").querySelector(".alert").textContent = RespExcluir.Motivo
                document.getElementById("alertaExcluir-mensagem").querySelector(".alert").style="color: green;font-size: 1.2em;"
                setTimeout(() => {
                    document.getElementById("alertaExcluir-mensagem").querySelector(".alert").textContent = ""
                    location.reload()
                }, 3000)
            }else{
                document.getElementById("btnExcluir").querySelector(".carregando").classList.add("d-none")
                document.querySelector("#alertaExcluir-mensagem").textContent = RespExcluir.Motivo
                document.querySelector("#alertaExcluir-mensagem").style.color = "red"
                setTimeout(() => {
                    document.querySelector("#alertaExcluir-mensagem").textContent = ""
                }, 3000)
                console.error('Erro na requisição:', RespExcluir.Motivo);
            }

            
            if (data.Retorno == "OK") {

                document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                document.querySelector("#alertaCadastro-mensagem").textContent = data.Motivo
                document.querySelector("#alertaCadastro-mensagem").style.color = "green"
                setTimeout(() => {
                    document.querySelector("#alertaCadastro-mensagem").textContent = ""
                }, 2000)

            } else {

                document.getElementById("btnCadastrar").querySelector(".carregando").classList.add("d-none")
                document.querySelector("#alertaCadastro-mensagem").textContent = data.Motivo
                document.querySelector("#alertaCadastro-mensagem").style.color = "green"
                setTimeout(() => {
                    document.querySelector("#alertaCadastro-mensagem").textContent = ""
                }, 2000)
                console.error('Erro na requisição:', data.Motivo);

            }
        }
    });

    PreencherTabela()
})();

async function editarCadastro(id) {
    try {
        const response = await fetch(`Request/Pessoa/Pessoa.php?id= ${id}`)
        if (response.ok) {
            const dadosEdt = await response.json()
            document.getElementById("edtSocial").value = dadosEdt.Dados.NomePessoa;
            document.getElementById("edtEndereco").value = dadosEdt.Dados.EnderecoPessoa;
            document.getElementById("edtCnpj").value = dadosEdt.Dados.Cpf_Cnpj;
            document.getElementById("edtEmail").value = dadosEdt.Dados.Email;
            document.getElementById("edtTelefone").value = dadosEdt.Dados.Telefone;
            document.getElementById("edtidPessoa").value = dadosEdt.Dados.idPessoa;
        }
    } catch (error) {
        alert(error)
    }
};

async function excluirCadastro(id) {
    try {
        const idRec = id
        const response = await fetch(`Request/Pessoa/Pessoa.php?id= ${idRec}`)
        const dadosCad = await response.json()
        document.getElementById("excNomeSocial").value = dadosCad.Dados.NomePessoa;
        document.getElementById("excCnpj").value = dadosCad.Dados.Cpf_Cnpj;
        document.getElementById("excIdPessoa").value = dadosCad.Dados.idPessoa;
    } catch (error) {
        alert(error)
    }

};

async function PreencherTabela() {
    const response = await fetch('Request/Pessoa/Pessoa.php?id=todos');
    if (response.ok) {
        const CadPessoa = await response.json();
        let tbody = document.getElementById("tbody");
        tbody.innerHTML = ""; // Limpa o conteúdo atual da tabela

        for (let index = 0; index < CadPessoa.Dados.length; index++) {
            let tr = tbody.insertRow();
            let td_id = tr.insertCell();
            let td_Nome = tr.insertCell();
            let td_CPF = tr.insertCell();
            let td_Telefone = tr.insertCell();
            let td_acoes = tr.insertCell();
            td_id.innerText = CadPessoa.Dados[index].idPessoa
            td_id.classList.add("esconder")
            td_Nome.innerText = CadPessoa.Dados[index].NomePessoa;
            td_CPF.innerText = FormatarCpfCnpj(CadPessoa.Dados[index].Cpf_Cnpj);
            td_CPF.classList.add("esconder")
            td_Telefone.innerText = FormatarTelefoneCelular(CadPessoa.Dados[index].Telefone);
            td_Telefone.classList.add("esconder")
            td_acoes.innerHTML = `<i data-toggle="modal" data-target="#modalEditar" class="bi bi-pencil-square" onclick="editarCadastro('${CadPessoa.Dados[index].idPessoa}')" style="cursor: pointer;")></i> <i data-toggle="modal" data-target="#modalExcluir" class="bi bi-trash3" onclick="excluirCadastro('${CadPessoa.Dados[index].idPessoa}')"  style="cursor: pointer;"></i>`;
        }
    }
}
