(()=>{
    document.getElementById("cadRepitaSenhaUser").addEventListener("onchange", ()=>{
        const senha = document.getElementById("cadSenhaUser").value
        const Rep_senha = document.getElementById("cadRepitaSenhaUser").value
        if(senha !== Rep_senha){
            document.getElementById("alertaCadastro-mensagem").querySelector("alert").textContent = "Senhas não conferem"
            setInterval(()=>{
                document.getElementById("alertaCadastro-mensagem").querySelector("alert").textContent = "";
            },3000)
        }
    })
})();

function ListarTabela(){

};
