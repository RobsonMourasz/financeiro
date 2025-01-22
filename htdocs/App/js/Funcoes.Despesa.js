(() => {
    let data_Inicial = "";
    let data_Final = "";
    const data = new Date();
    const mes = data.getMonth() + 1; // Adicione 1 para obter o mês correto
    const ano = data.getFullYear(); // Obtenha o ano corretamente

    // Formate as datas como "YYYY-MM-DD"
    data_Inicial = ano + "-" + (mes < 10 ? "0" : "") + mes + "-01";
    data_Final = ano + "-" + (mes < 10 ? "0" : "") + mes + "-31";
    document.getElementById("Data1").value = data_Inicial;
    document.getElementById("Data2").value = data_Final;

    document.getElementById("form-pesquisa").addEventListener("submit", async (event) => {
        event.preventDefault()
        try {

            const url = "Request/Despesa/pesqDespesa.php";
            const formPesq = new FormData(document.getElementById("form-pesquisa"));
            const response = await fetch(url, {
                method: "POST",
                body: formPesq,
            });
    
            if (response.ok) {
    
                const dados = await response.json();
                if (dados.Retorno = "OK") {
                    TelaAvisos("verdadeiro", "dados.Motivo");
                } else {
                    TelaAvisos("falso", dados.Motivo);
                }
    
            } else {
                alert("falha na requisição")
            }    
        } catch (error) {
            TelaAvisos("falso", "error");
        }

    });


})();

async function Carregar_Tabela() {

}