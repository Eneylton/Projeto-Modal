
async function listarProdutos(id_cat){
    const dadosProd = await fetch('listar-produtos.php?id_cat=' + id_cat);
    const respostaProd = await dadosProd.json();
  
    const listarProdutosModal = new bootstrap.Modal(document.getElementById("listarProdutosModal"));
    listarProdutosModal.show();
    document.querySelector(".listar-produtos").innerHTML = respostaProd['dados'];
 
}

