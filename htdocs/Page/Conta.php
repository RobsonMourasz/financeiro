<div class="main-page">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Conta</h1>

    </div> <!-- Page Heading -->
    <div class="d-grid gap-2">

        <button id="btnCadastro" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">Cadastrar</button>

    </div> <!-- d-grid gap-2 -->
    <div class="mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Saldo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider" id="tbody">

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

                       <div id="alertaCadastro-mensagem" align="center">
                            <small class="alert"></small>
                       </div>

                        <div class="input-group mb-3">
                            <input id="cadDescricaoConta" name="DescricaoConta" type="text" class="form-control" placeholder="Descrição Carteira" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="cadSaldoConta" name="SaldoConta" type="text" class="form-control" placeholder="Qual Saldo atual ? R$ 0,00" require>
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
                            <input id="edtDescricaoConta" name="DescricaoConta" type="text" class="form-control" placeholder="Descrição Carteira" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="edtSaldoConta" name="SaldoConta" type="text" class="form-control" placeholder="Qual Saldo atual ? R$ 0,00" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="edtIdConta" name="IdConta" type="number" class="form-control" hidden>
                        </div>
                        <div class="modal-footer">
                            <button id="btnEditar" type="submit" class="form-control btn btn-primary" >Alterar <small class="carregando d-none"></small></button>
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
                    <form id="formExcluir" method="post">

                        <div id="alertaExcluir-mensagem" align="center">
                            <small class="alert"></small>
                        </div>

                        <div class="input-group mb-3">
                            <input id="excDescricaoConta" name="DescricaoConta" type="text" class="form-control" placeholder="Descrição Carteira" require disabled>
                        </div>
                        <div class="input-group mb-3">
                            <input id="excSaldoConta" name="SaldoConta" type="text" class="form-control" placeholder="Qual Saldo atual ? R$ 0,00" require disabled>
                        </div>
                        <div class="input-group mb-3">
                            <input id="excidConta" name="idConta" type="number" class="form-control" hidden>
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

    <script src="App/js/Funcoes.Conta.js"></script>

</div><!-- main-page -->