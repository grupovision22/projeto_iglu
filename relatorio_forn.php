<?php



//Incluindo conexão com o bd
include_once './db.php';

//Formatando a tabela
$html_forn = '';
$html_forn = '<link rel="stylesheet" href="estilo/bootstrap.min.css">';
$html_forn = '<table border=1';	
$html_forn .= '<thead>';
$html_forn .= '<tr>';
$html_forn .= '<th scope="col">ID</th>';
$html_forn .= '<th scope="col">Nome</th>';
$html_forn .= '<th scope="col">E-mail</th>';
$html_forn .= '<th scope="col">CNPJ</th>';
$html_forn .= '<th scope="col">Telefone</th>';
$html_forn .= '</tr>';
$html_forn .= '</thead>';
$html_forn .= '<tbody>';

//QUERY
$query_forn = "SELECT idFornecedor, nomeEmpresaFornecedor, emailFornecedor, cnpjFornecedor, telFornecedor from tbfornecedor";
$resultado_forn = mysqli_query($con, $query_forn);
while($row_tbfornecedor = mysqli_fetch_assoc($resultado_forn)){
    $html_forn .=  '<tr><td>'.$row_tbfornecedor['idFornecedor'] . "</td>";
    $html_forn .= '<td>'.$row_tbfornecedor['nomeEmpresaFornecedor'] . "</td>";
    $html_forn .= '<td>'.$row_tbfornecedor['emailFornecedor'] . "</td>";
    $html_forn .= '<td>'.$row_tbfornecedor['cnpjFornecedor'] . "</td>";
    $html_forn .= '<td>'.$row_tbfornecedor['telFornecedor'] . "</td></tr>";
}

$html_forn .= '</tbody>';
$html_forn .= '</table';


//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// Carregar o Composer
require './vendor/autoload.php';

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html('
        <h1 style="text-align: left;">Relatório Fornecedores</h1>
        '. $html_forn .'
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


