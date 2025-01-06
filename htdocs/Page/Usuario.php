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
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">CPF</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
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

                        <div class="form-check form-switch mx-auto">
                            <input id="cadAtivo" name="ativo" type="checkbox" class="form-check-input" value="S" checked>
                            <label class="form-check-label mx-auto" for="cadAtivo" style="user-select: none;">Cadastro Ativo ? </label>
                        </div>

                    </div>

                    <div class="input-group mb-3">
                        <input id="cadNome" name="nome" type="text" class="form-control" placeholder="Nome Completo" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadEmail" name="email" type="email" class="form-control" placeholder="E-mail" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadCnpj" name="cnpj" type="text" class="form-control" placeholder="CNPJ" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadSenha" name="senha" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Mínimo de caracteres 4 máximo 10" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="cadRepitaSenha" name="repita-senha" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Repita a senha " require>
                    </div>
                    <div class="modal-footer">
                        <button id="btnCadastrar" type="button" class="form-control btn btn-success">Cadastrar</button>
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
                <form id="formCadastro" method="post">
                    <small>
                        <div id="alertaCadastro-mensagem" align="center"></div>
                    </small>

                    <div class="input-group mb-3">

                        <div class="form-check form-switch mx-auto">
                            <input id="edtAtivo" name="ativo" type="checkbox" class="form-check-input" value="S" checked>
                            <label class="form-check-label mx-auto" for="cadAtivo" style="user-select: none;">Cadastro Ativo ? </label>
                        </div>

                    </div>

                    <div class="input-group mb-3">
                        <input id="edtNome" name="nome" type="text" class="form-control" placeholder="Nome Completo" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtEmail" name="email" type="email" class="form-control" placeholder="E-mail" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtCnpj" name="cnpj" type="text" class="form-control" placeholder="CNPJ" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtSenha" name="senha" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Mínimo de caracteres 4 máximo 10" require>
                    </div>
                    <div class="input-group mb-3">
                        <input id="edtRepitaSenha" name="repita-senha" type="password" class="form-control" minlength="4" maxlength="10" placeholder="Repita a senha " require>
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
                <h5 class="modal-title" id="staticBackdropLabel">Deseja Realmente excluir esse cadastro ?'</h5>
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
                        <input name="nome" type="text" class="form-control" placeholder="Nome Completo" require disabled>
                    </div>
                    <div class="input-group mb-3">
                        <input name="cnpj" type="text" class="form-control" placeholder="CNPJ" require disabled>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</div><!-- main-page -->