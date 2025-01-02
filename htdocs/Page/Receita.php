

<div class="main-page">

    <div class="d-grid gap-2">

        <h3 class="title1 mt-2">Receita</h3>

        <!-- Button trigger modal -->

        <div class="col_6">
            <button id="btnCadastro" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastro"><i class="bi bi-plus"></i> Receita</button>

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
                        <button style="border: none; outline: none;"><i class="bi bi-hand-thumbs-down"></i></button>
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
                        <button style="border: none; outline: none;"><i class="bi bi-hand-thumbs-down"></i></button>
                        <button data-toggle="modal" data-target="#modalExcluir" style="border: none; outline: none;"><i class="bi bi-trash"></i></button>
                        <button data-toggle="modal" data-target="#modalEditar" style="border: none; outline: none;"><i class="bi bi-clipboard-check-fill"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <script src="App/js/Botao.Confirma.js"></script>

</div> <!-- manin-page -->