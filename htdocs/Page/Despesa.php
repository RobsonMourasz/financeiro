<div class="main-page">

    <div class="d-grid gap-2">

        <h3 class="title1 mt-2">Despesa</h3>

        <!-- Button trigger modal -->

        <div class="col_6">
            <button id="btnCadastro" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCadastro"><i class="bi bi-plus"></i> Despesas</button>

        </div>

    </div> <!-- d-grid gap-2 -->

    <div class="mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor R$</th>
                    <th scope="col">Confirmado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>10-01-2025</td>
                    <td>Aluguel Casa</td>
                    <td>R$ 700,00</td>
                    <td>Não</td>
                    <td>
                        <button id="confirma1" style="border: none; outline: none;" onclick="Confirma('confirma1')"><i class="bi bi-hand-thumbs-down"></i></button>
                        <button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button>
                        <button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>10-01-2025</td>
                    <td>Carro</td>
                    <td>R$ 753,00</td>
                    <td>Não</td>
                    <td>
                        <button id="confirma2" style="border: none; outline: none;" onclick="Confirma('confirma2')"><i class="bi bi-hand-thumbs-down"></i></button>
                        <button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button>
                        <button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>10-01-2025</td>
                    <td>Financiamento</td>
                    <td>R$ 1280,00</td>
                    <td>Não</td>
                    <td>
                        <button id="confirma3" style="border: none; outline: none;" onclick="Confirma('confirma3')"><i class="bi bi-hand-thumbs-down"></i></button>
                        <button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button>
                        <button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <!-- MODAL CADASTRAR  -->
    <div class="modal fade" id="modalCadastro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nova despesa</h5>
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
                            <input id="cadDescricao" name="descricao" type="text" class="form-control" placeholder="Descrição" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="cadValor" name="valor" type="text" class="form-control" placeholder="R$ 0,00" require>
                        </div>
                        <div class="input-group mb-3">
                            <input id="cadVencimento" name="vencimento" type="date" class="form-control" require>
                        </div>
                        <div class="input-group mb-3">
                            <select name="conta" id="cadConta" class="form-select mb-3">
                                <option value="" selected>Selecione uma Conta</option>
                                <option value="inicial">Inicial</option>
                                <option value="outro">Outro Banco</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <select name="categoria" id="cadCategoria" class="form-select mb-3">
                                <option value="" selected>Selecione uma categoria</option>
                                <option value="aluguel">Aluguel</option>
                                <option value="carro">Carro</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6 d-flex justify-content-center" style="background-color: transparent;">
                                <div class="form-check form-switch mb-3">
                                    <input data-id="0" id="cadFixa" name="fixa" type="checkbox" class="form-check-input" require>
                                    <label for="cadFixa" class="form-check-label" style="user-select: none;">Despesa Fixa?</label>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-center" style="background-color: transparent;">
                                <div class="form-check form-switch mb-3">
                                    <input data-id="0" id="cadParcelada" name="parcelada" type="checkbox" class="form-check-input" require>
                                    <label for="cadParcelada" class="form-check-label" style="user-select: none;">Despesa Parcelada?</label>
                                    <input type="text" name="qtdParcelas" id="cadQtdParcelas" value="0" class="d-none">
                                    <p style="color: red;" id="cadResposta" class="d-none">R$ 0,00</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="btnCadastrar" type="button" class="form-control btn btn-danger">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- FIM MODAL CADASTRAR  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <script src="App/js/Botao.Confirma.js"></script>
    <script src="App/js/Funcoes.lancamento.js"></script>


</div> <!-- manin-page -->