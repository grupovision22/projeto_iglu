<?php



//Incluindo conexão com o bd
include_once './db.php';

//Formatando a tabela
$html_est = '';
$html_est = '<link rel="stylesheet" href="estilo/bootstrap.min.css">';
$html_est = '<table border=1';	
$html_est .= '<thead>';
$html_est .= '<tr>';
$html_est .= '<th scope="col">ID</th>';
$html_est .= '<th scope="col">Nome Produto</th>';
$html_est .= '<th scope="col">Descrição</th>';
$html_est .= '<th scope="col">Data Fabricação</th>';
$html_est .= '</tr>';
$html_est .= '</thead>';
$html_est .= '<tbody>';

//QUERY
$query_est = "SELECT idProduto, nomeProduto, descricaoProduto, dataFabricacaoProduto from tbproduto";
$resultado_est = mysqli_query($con, $query_est);
while($row_tbproduto = mysqli_fetch_assoc($resultado_est)){
    $html_est .=  '<tr><td>'.$row_tbproduto['idProduto'] . "</td>";
    $html_est .= '<td>'.$row_tbproduto['nomProduto'] . "</td>";
    $html_est .= '<td>'.$row_tbproduto['descricaoProduto'] . "</td>";
    $html_est .= '<td>'.$row_tbproduto['dataFabricacao'] . "</td></tr>";

}

$html_est .= '</tbody>';
$html_est .= '</table';


//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// Carregar o Composer
require './vendor/autoload.php';

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html('
        <h1 style="text-align: left;">Relatório Estoque</h1>
        '. $html_est .'
    ');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "relatorio.pdf", 
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
?>


