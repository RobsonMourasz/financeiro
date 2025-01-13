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

    async function editarCadastro(id) {
        const response = await fetch(`Request/Pessoa/Pessoa.php?id= ${id}`)
        const dadosEdt = await response.json()
        document.getElementById("edtSocial").value = dadosEdt.Dados.NomePessoa;
        document.getElementById("edtEndereco").value = dadosEdt.Dados.EnderecoPessoa;
        document.getElementById("edtCnpj").value = dadosEdt.Dados.Cpf_Cnpj;
        document.getElementById("edtEmail").value = dadosEdt.Dados.Email;
        document.getElementById("edtTelefone").value = dadosEdt.Dados.Telefone;
    };

    async function excluirCadastro(id) {
        const idRec = id
        const response = await fetch(`Request/Pessoa/Pessoa.php?id= ${idRec}`)
        const dadosCad = await response.json()
        document.getElementById("excNomeSocial").value = dadosCad.Dados.NomePessoa;
        document.getElementById("excCnpj").value = dadosCad.Dados.Cpf_Cnpj;
    };

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
    document.getElementById("btnExcluir").addEventListener("click", async () => {
        async function excluirCadastro(id) {
            const response = await fetch(`Request/Pessoa/excPessoa.php?id= ${idRec}`)
            if (response.ok) {
                console.log("ok");
            }
        }
    });

    ListarTabela();
})();

function ListarTabela() {
    const response = fetch(`Request/Pessoa/Pessoa.php?id= 0`)
    if (response.ok) {
        const cadPessoa = response.json()
        let tbody = document.getElementById("tbody")
        tbody.innerText = ''
        for (let i = 0; i < cadPessoa.length; i++) {
            let tr = tbody.insertRow()
            let td_id = tr.insertCell()
            let td_Nome = tr.insertCell()
            let td_Telefone = tr.insertCell()
            let td_Acoes = tr.insertCell()

            td_id = cadPessoa[i].idPessoa
            td_Nome = cadPessoa[i].idPessoa
            td_Telefone = cadPessoa[i].idPessoa
            td_Acoes = `<button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i onclick="excluirCadastro('${cadPessoa[i].idPessoa}')" class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i onclick="editarCadastro('${cadPessoa[i].idPessoa}')" class="bi bi-clipboard-check-fill"></i></button>`
        }

    }
};

