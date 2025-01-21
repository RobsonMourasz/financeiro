<div class="main-page">

    <div class="d-grid gap-2">

        <h3 class="title1 mt-2">Usuários</h3>

        <!-- Button trigger modal -->

        <button id="btnCadastro" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">Cadastrar</button>

    </div>

    <div class="mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="esconder">#</th>
                    <th scope="col" class="esconder">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col" class="esconder">Nível</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider" id="tbody">
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

                    <div id="alertaCadastro-mensagem" align="center">
                        <small class="alert"></small>
                    </div>

                    <div class="input-group mb-3">
                        <input id="cadNomeUser" name="NomeUser" type="text" class="form-control" placeholder="Nome Completo" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadEmailUser" name="EmailUser" type="email" class="form-control" placeholder="E-mail" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadcpf_cnpj" name="cpf_cnpj" type="text" class="form-control" placeholder="CNPJ" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadSenhaUser" name="SenhaUser" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Mínimo de caracteres 4 máximo 10" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadRepitaSenhaUser" name="repita-SenhaUser" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Repita a senha " require>
                    </div>
                    <div class="input-group mb-3">
                        <select name="Nivel" id="cadNivel" class="form-select">
                            <option value="" selected>Selecione Nivel</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Usuario">Usuario</option>
                        </select>
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

                    <div id="alertaEditar-mensagem" align="center">
                        <small class="alert"></small>
                    </div>

                    <div class="input-group mb-3">
                        <input id="edtNomeUser" name="NomeUser" type="text" class="form-control" placeholder="Nome Completo" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtEmailUser" name="EmailUser" type="email" class="form-control" placeholder="E-mail" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtcpf_cnpj" name="cpf_cnpj" type="text" class="form-control" placeholder="CNPJ" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtSenhaUser" name="SenhaUser" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Mínimo de caracteres 4 máximo 10" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtRepitaSenha" name="repita-senha" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Repita a senha " require>
                    </div>

                    <div class="input-group mb-3">
                        <select name="Nivel" id="edtNivel" class="form-select">
                            <option value="" selected>Selecione Nivel</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <input id="edtIdUser" name="idUser" type="number" class="form-control" hidden>
                    </div>

                    <div class="modal-footer">
                        <button id="btnEditar" type="submit" class="form-control btn btn-primary">Editar <small class="carregando d-none"></small></button>
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
                <form id="formExcluir" method="post">

                    <div id="alertaExcluir-mensagem" align="center">
                        <small class="alert"></small>
                    </div>

                    <div class="input-group mb-3">
                        <input id="excNome" name="nome" type="text" class="form-control" placeholder="Nome Completo" require disabled>
                    </div>
                    <div class="input-group mb-3">
                        <input id="excEmailUser" name="EmailUser" type="text" class="form-control" placeholder="CNPJ" require disabled>
                    </div>
                    <div class="input-group mb-3">
                        <input id="excidUser" name="idUser" type="number" class="form-control" hidden>
                    </div>

                    <div class="modal-footer">
                        <button id="btnExcluir" type="submit" class="form-control btn btn-danger">Excluir <small class="carregando d-none"></small></button>
                        <button id="btnCancelar" type="button" class="form-control btn btn-light" data-dismiss="modal" aria-label="Fechar">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- FIM MODAL EXCLUIR  -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="App/js/Funcoes.Usuario.js"></script>
<script src="App/js/Funcoes.Feitas.js"></script>

</div><!-- main-page -->