(()=>{
    let data_Inicial = "";
    let data_Final = "";
    const data = new Date();
    const mes = data.getMonth() + 1; // Adicione 1 para obter o mês correto
    const ano = data.getFullYear(); // Obtenha o ano corretamente
    
    // Formate as datas como "YYYY-MM-DD"
    data_Inicial = ano + "-" + (mes < 10 ? "0" : "") + mes + "-01";
    data_Final = ano + "-" + (mes < 10 ? "0" : "") + mes + "-31";
    document.getElementById("data1").value = data_Inicial;
    document.getElementById("data2").value = data_Final;
    
})();

async function Carregar_Tabela() {
    
}