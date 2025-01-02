<div class="main-page">

    <div class="d-grid gap-2">

        <h3 class="title1 mt-2">Categoria</h3>

        <!-- Button trigger modal -->

        <button id="btnCadastro" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">Cadastrar</button>

    </div>
    <div class="mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Tipo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>Carro</td>
                    <td>Despesa</td>
                    <td><button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Casa</td>
                    <td>Despesa</td>
                    <td><button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Carteira</td>
                    <td>Receita</td>
                    <td><button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button><button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

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
                            <input id="cadDescricao" name="descricao" type="text" class="form-control" placeholder="Descrição Categoria" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="cadTipo" name="tipo" type="text" class="form-control" placeholder="Tipo (Receita ou Despesa)" require>
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
                            <input id="edtDescricao" name="descricao" type="text" class="form-control" placeholder="Descrição Categoria" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="edtTipo" name="tipo" type="text" class="form-control" placeholder="Tipo (Receita ou Despesa)" require>
                        </div>

                        <div class="modal-footer">
                            <button id="btnEditar" type="button" class="form-control btn btn-primary">Alterar</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Deseja Realmente excluir esse Cadastro?</h5>
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
                            <input id="edtDescricao" name="descricao" type="text" class="form-control" placeholder="Descrição Categoria" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="edtTipo" name="tipo" type="text" class="form-control" placeholder="Tipo (Receita ou Despesa)" require>
                        </div>

                        <div class="modal-footer">
                            <button id="btnEditar" type="button" class="form-control btn btn-danger">Excluir</button>
                            <button id="btnCancelar" type="button" class="form-control btn btn-light" data-dismiss="modal" aria-label="Fechar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- FIM MODAL EXCLUIR  -->

</div><!-- main-page -->