async function deletarFunc(codigo){
    var response = await fetch("/iglu/funcoes/funcionario.php", {
        method:"DELETE",
        body: JSON.stringify({codigo: codigo}),
    })
    var text = await response.text();
    window.location.reload()

    //console.log(text);
    
}