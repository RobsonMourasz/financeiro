<div class="main-page">

    <div class="d-grid gap-2">

        <h3 class="title1 mt-2">Pessoas</h3>

        <!-- Button trigger modal -->

        <button id="btnCadastro" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">Cadastrar</button>

    </div>

    <div class="mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereco</th>
                    <th scope="col">telefone</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i onclick="excluirCadastro('1')" class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i onclick="editarCadastro('1')" class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td><button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry the Bird</td>
                    <td>@twitter</td>
                    <td>@twitter</td>
                    <td><button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />

<!-- MODAL CADASTRAR  -->
<div class="modal fade" id="modalCadastro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCadastro" method="post">
                    <small>
                        <div id="alertaCadastro-mensagem" align="center"></div>
                    </small>

                    <div class="input-group mb-3">
                        <input id="cadSocial" name="nomeSocial" type="text" class="form-control" placeholder="Nome Social" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadEndereco" name="endereco" type="text" class="form-control" placeholder="Endereco Completo">
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadCnpj" name="cnpj" type="text" class="form-control" placeholder="CNPJ">
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadEmail" name="email" type="text" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadTelefone" name="telefone" type="text" class="form-control" placeholder="(00) 0 0000-0000">
                    </div>

                    <div class="modal-footer">
                        <button id="btnCadastrar" type="submit" class="form-control btn btn-success">Cadastrar <small class="carregando d-none"></small></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div> <!-- FIM MODAL CADASTRAR  -->

<!-- MODAL EDITAR  -->
<div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditar" method="post">
                    <small>
                        <div id="alertaEditar-mensagem" align="center"></div>
                    </small>

                    <div class="input-group mb-3">
                        <input id="edtSocial" name="nomeSocial" type="text" class="form-control" placeholder="Nome Social" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtEndereco" name="endereco" type="text" class="form-control" placeholder="Endereco Completo">
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtCnpj" name="cnpj" type="text" class="form-control" placeholder="CNPJ">
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtEmail" name="email" type="text" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtTelefone" name="telefone" type="text" class="form-control" placeholder="(00) 0 0000-0000">
                    </div>

                    <div class="modal-footer">
                        <button id="btnEditar" type="button" class="form-control btn btn-primary">Editar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div> <!-- FIM MODAL EDITAR  -->

<!-- MODAL EXCLUIR  -->
<div class="modal fade" id="modalExcluir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Deseja Realmente excluir esse cadastro ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCadastro" method="post">
                    <small>
                        <div id="alertaCadastro-mensagem" align="center"></div>
                    </small>

                    <div class="input-group mb-3">
                        <input id="excNomeSocial" name="nomeSocial" type="text" class="form-control" placeholder="Nome Social" require disabled>
                    </div>
                    <div class="input-group mb-3">
                        <input id="excCnpj" name="cnpj" type="text" class="form-control" placeholder="CNPJ" require disabled>
                    </div>

                    <div class="modal-footer">
                        <button id="btnExcluir" type="button" class="form-control btn btn-danger">Excluir</button>
                        <button id="btnCancelar" type="button" class="form-control btn btn-light" data-dismiss="modal" aria-label="Fechar">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- FIM MODAL EXCLUIR  -->

<script>
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
</script>

<script>
    async function editarCadastro(id) {
        const response = await fetch(`Request/Pessoa/Pessoa.php?id= ${id}`)
        const dados = await response.json()
        document.getElementById("edtSocial").value = dados.Dados.NomePessoa;
        document.getElementById("edtEndereco").value = dados.Dados.EnderecoPessoa;
        document.getElementById("edtCnpj").value = dados.Dados.Cpf_Cnpj;
        document.getElementById("edtEmail").value = dados.Dados.Email;
        document.getElementById("edtTelefone").value = dados.Dados.Telefone;
    }

    async function excluirCadastro(id) {
        const idRec = id
        const response = await fetch(`Request/Pessoa/Pessoa.php?id= ${idRec}`)
        const dados = await response.json()
        document.getElementById("excNomeSocial").value = dados.Dados.NomePessoa;
        document.getElementById("excCnpj").value = dados.Dados.Cpf_Cnpj;
    }
</script>



<script>
    /* FETCH PARA EDITAR */
    document.getElementById("btnEditar").addEventListener("click", async () => {
        event.preventDefault(); // Evita o comportamento padrão do formulário
        document.getElementById("btnCadastrar").querySelector(".carregando").classList.remove("d-none")
        const url = 'Request/Pessoa/edtPessoa.php'; // Substitua pela sua URL de destino
        const Formulario = document.querySelector("#formEditar");
        const form = new FormData(Formulario);

        const response = await fetch(url, {
            method: 'POST',
            body: form, // Use o FormData diretamente como corpo da requisição
        });

        if(response.ok){
            const dados = await response.json()
        }
    })
</script>

<script>
    /* FETCH PARA EXCLUIR */
    document.getElementById("btnExcluir").addEventListener("click", async () => {
        async function excluirCadastro(id) {
            const response = await fetch(`Request/Pessoa/excPessoa.php?id= ${idRec}`)
            if(response.ok){
                console.log("ok");
            }
        }
    })
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</div><!-- main-page -->