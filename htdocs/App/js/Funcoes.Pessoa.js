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
        document.getElementById("btnCadastrar").querySelector(".carregando").classList.remove("d-none")
        const url = 'Request/Pessoa/edtPessoa.php'; // Substitua pela sua URL de destino
        const Formulario = document.querySelector("#formEditar");
        const form = new FormData(Formulario);

        const response = await fetch(url, {
            method: 'POST',
            body: form, // Use o FormData diretamente como corpo da requisição
        });

        if (response.ok) {
            const dados = await response.json()
        }
    });

    /* FETCH PARA EXCLUIR */
    // document.getElementById("btnExcluir").addEventListener("click", async () => {
    //     async function excluirCadastro(id) {
    //         const response = await fetch(`Request/Pessoa/excPessoa.php?id= ${idRec}`)
    //         if (response.ok) {
    //             console.log("ok");
    //         }
    //     }
    // });

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
            document.addEventListener("click", function() {
                const editIcon = document.querySelector('.bi-pencil-square'); // Selecione o ícone de edição
                console.log("clicou")
                if (editIcon) {
                    editIcon.setAttribute('data-target', '#modalEditar'); // Adicione o atributo data-target
                }
            });
            
        }
        return "ok"
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
            td_Nome.innerText = CadPessoa.Dados[index].NomePessoa;
            td_CPF.innerText = CadPessoa.Dados[index].Cpf_Cnpj;
            td_Telefone.innerText = CadPessoa.Dados[index].Telefone;
            td_acoes.innerHTML = `<i data-toggle="modal" class="bi bi-pencil-square" onclick="editarCadastro('${CadPessoa.Dados[index].idPessoa}')" style="cursor: pointer;")></i> <i data-toggle="modal" data-target="#modalExcluir" class="bi bi-trash3" onclick="excluirCadastro('${CadPessoa.Dados[index].idPessoa}')"  style="cursor: pointer;"></i>`;
        }
    }
}
