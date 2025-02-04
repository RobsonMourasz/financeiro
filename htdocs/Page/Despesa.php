<div class="main-page">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Despesa</h1>

    </div> <!-- Page Heading -->
    <div class="d-grid gap-2">

        <button id="btnCadastro" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCadastro"><i class="bi bi-plus"></i> Despesas</button>

    </div> <!-- d-grid gap-2 -->
    <div class="btnfiltro p-2" id="btnfiltro">
        <i class="bi bi-sort-down"></i>
    </div><!-- btnfiltro -->

    <div id="display-filtro" class="row px-5 d-none">
        <div class="row">
            <form method="post" id="form-pesquisa">
                <div class="row">
                    <div class="col-md-2">
                        <div class="input-group mb-3">
                            <input id="Data1" name="DataInicial" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group mb-3">
                            <input id="Data2" name="DataFinal" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select name="categoria" id="pesqCategoria" class="form-select">
                            <option value="" selected>Categoria</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select name="Tipo" id="pesqTipo" class="form-select">
                            <option value="" selected>Tipo</option>
                            <option value="R">Receita</option>
                            <option value="D">Despesa</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select name="Situacao" id="pesqSituacao" class="form-select">
                            <option value="" selected>Situacao</option>
                            <option value="S">Confirmado</option>
                            <option value="N">Aberto</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Pesqisar</button>
                    </div>
                </div>
            </form>
        </div>

    </div> <!-- display-filtro -->



    <div class="d-grid gap-2">

        <div class="col_6">

        </div>

    </div>

    <div class="mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="esconder">Vencimento</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor R$</th>
                    <th scope="col" class="esconder">Confirmado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider" id="tbody">

            </tbody>
        </table>

    </div>

    <!-- MODAL CADASTRAR  -->
    <div class="modal fade" id="modalCadastro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nova despesa</h5>
                    <button onclick="" type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCadastro" method="post">

                        <div id="alertaCadastro-mensagem" align="center">
                            <small class="alert"></small>
                        </div>

                        <div class="input-group mb-3">
                            <input id="cadDescricao" name="Descricao" type="text" class="form-control" placeholder="Descrição" require autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input id="cadValor" name="ValorParcela" type="text" class="form-control" placeholder="R$ 0,00" require autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input id="cadVencimento" name="DataVencimento" type="date" class="form-control" require>
                        </div>
                        <div class="input-group mb-3">
                            <select name="idConta" id="cadConta" class="form-select mb-3">
                                <option value="" selected>Selecione uma Conta</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <select name="categoria" id="cadCategoria" class="form-select mb-3">
                                <option value="" selected>Selecione uma categoria</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-5 d-flex justify-content-center" style="background-color: transparent;">
                                <div class="form-check form-switch mb-3">
                                    <input data-id="N" id="cadFixa" name="fixa" type="checkbox" class="form-check-input" style="cursor: pointer;" value="N">
                                    <label for="cadFixa" class="form-check-label" style="user-select: none; cursor: pointer;" title="É uma despesa fixa ? então marque essa opção">Fixa</label>
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-center" style="background-color: transparent;">
                                <div class="form-check form-switch mb-3">
                                    <input data-id="N" id="cadParcelada" name="parcelada" type="checkbox" class="form-check-input" style="cursor: pointer;" value="N">
                                    <label for="cadParcelada" class="form-check-label" style="user-select: none; cursor: pointer;" title="Caso desejar parcela essa despesa basta marcar a opção">Parcelar</label>
                                    <input type="text" name="QtdParcela" id="cadQtdParcelas" class="d-none" value="1">
                                    <p style="color: red;" id="cadResposta" class="d-none">R$ 0,00</p>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center" style="background-color: transparent;">
                                <i id="btnConfirmada" class="bi bi-hand-thumbs-up-fill" style="cursor: pointer;" title="opção de confirmar despesa" data-id="S"></i>
                            </div>
                            <input type="text" name="ValorTotal" id="cadVrTotal" hidden>
                            <input type="text" name="Confirmada" id="cadConfirmada" value="S" hidden>
                            <input type="number" name="sub" id="cadSub" hidden>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Despesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditar" method="post" style="position: relative;">

                        <div id="alertaEditar-mensagem" align="center">
                            <small class="alert"></small>
                        </div>

                        <div class="input-group mb-3">
                            <input id="edtDescricao" name="Descricao" type="text" class="form-control" placeholder="Descrição" require autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input id="edtValor" name="ValorParcela" type="text" class="form-control" placeholder="R$ 0,00" require autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input id="edtVencimento" name="DataVencimento" type="date" class="form-control" require>
                        </div>
                        <div class="input-group mb-3">
                            <select name="idConta" id="edtConta" class="form-select mb-3">
                                <option value="" selected>Selecione uma Conta</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <select name="categoria" id="edtCategoria" class="form-select mb-3">
                                <option value="" selected>Selecione uma categoria</option>
                            </select>
                        </div>

                        <div class="row">

                            <div class="col d-flex justify-content-center" style="background-color: transparent;">
                                <i id="edtBtnConfirmada" class="bi" style="cursor: pointer;" title="opção de confirmar despesa" data-id="S"></i>
                            </div>
                            <input type="text" name="Confirmada" id="edtConfirmada" hidden>
                            <input type="number" name="sub" id="edtSub" hidden>
                            <input type="number" name="idCR" id="edtidCR" hidden>
                            <input type="number" name="Controle" id="edtControle" hidden>
                            <input type="text" name="Parcelado" id="edtParcelado" hidden>
                            <input type="text" name="AlterarTodos" id="edtAlterar" hidden>

                        </div>

                        <div class="modal-footer">
                            <button id="btnEditar" type="button" class="form-control btn btn-primary">Alterar <small class="carregando d-none"></small></button>
                        </div>
                        <div style="width: 100%; height: 80%; background-color: rgba(0, 0, 0, .8); position: absolute; top: 2%; z-index: 100; display: flex; align-items: center; justify-content: center;" class="d-none tela-confirmar-lancamento">
                            <div class="flex-column">
                                <div class="col-md m-2" style="display: flex; justify-content: center; align-items: center;">
                                    <button type="submit" id="btn-alterar-todos-lancamentos" class="btn btn-danger">Alterar para todos os lançamentos</button>
                                </div>
                                <div class="col-md m-2" style="display: flex; justify-content: center; align-items: center;">
                                    <button type="submit" id="btn-alterar-lancamento" class="btn btn-success">Alterar apenas para esse lancamento</button>
                                </div>
                            </div>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Excluir Despesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formExcluir" method="post" style="position: relative;">

                        <div id="alertaExcluir-mensagem" align="center">
                            <small class="alert"></small>
                        </div>

                        <div class="input-group mb-3">
                            <input id="excDescricao" name="Descricao" type="text" class="form-control" placeholder="Descrição" disabled>
                        </div>

                        <input type="number" id="excidCR" hidden>
                        <input type="text" id="excParcelas" hidden>

                        <div class="modal-footer">
                            <button id="btnExcluir" type="button" class="form-control btn btn-danger">Excluir <small class="carregando d-none"></small></button>
                        </div>
                        <div style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, .8); position: absolute; top: 2%; z-index: 100; display: flex; justify-content: center; align-items: center;" class="d-none tela-excluir-lancamento">
                            <div class="row d-flex align-self-center">

                                <div class="col-md m-2" style="display: flex; justify-content: center; align-items: center;">
                                    <button type="submit" id="btn-excluir-todos-lancamentos" class="btn btn-danger">Excluir todos os lançamentos</button>
                                </div>
                                <div class="col-md  m-2" style="display: flex; justify-content: center; align-items: center;">
                                    <button type="submit" id="btn-excluir-lancamento" class="btn btn-success">Excluir apenas esse lancamento</button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div> <!-- FIM MODAL EXCLUIR  -->

    <!-- <script src="App/js/Botao.Confirma.js"></script> -->
    <script src="App/js/Funcoes.Feitas.js"></script>
    <script src="App/js/Funcoes.lancamento.js"></script>
    <script src="App/js/Funcoes.Despesa.js"></script>


</div> <!-- manin-page -->