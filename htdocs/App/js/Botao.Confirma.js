function Confirma(idElemento) {

    // Selecione o ícone atual
    const iconeAtual = document.getElementById(`${idElemento}`).querySelector('.bi-hand-thumbs-down');
    const novoIcone = document.createElement('i');

    if (iconeAtual.classList.contains('bi-hand-thumbs-down')) {
        // Crie um novo ícone (substituto)
        novoIcone.classList.add('bi', 'bi-hand-thumbs-up-fill'); // Substitua pela classe do ícone desejado
    } else {
        // Crie um novo ícone (substituto)
        novoIcone.classList.add('bi', 'bi-hand-thumbs-down'); // Substitua pela classe do ícone desejado
    }


    // Substitua o ícone atual pelo novo ícone
    document.getElementById(`${idElemento}`).replaceChild(novoIcone, iconeAtual);

}