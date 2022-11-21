<?php



//Incluindo conexão com o bd
include_once './db.php';

//Formatando a tabela
$html_func = '';
$html_func = '<link rel="stylesheet" href="estilo/bootstrap.min.css">';
$html_func = '<table border=1';	
$html_func .= '<thead>';
$html_func .= '<tr>';
$html_func .= '<th scope="col">ID</th>';
$html_func .= '<th scope="col">Nome</th>';
$html_func .= '<th scope="col">Genero</th>';
$html_func .= '<th scope="col">Data nascimento</th>';
$html_func .= '<th scope="col">Telefone</th>';
$html_func .= '<th scope="col">E-mail</th>';
$html_func .= '</tr>';
$html_func .= '</thead>';
$html_func .= '<tbody>';

//QUERY
$query_func = "SELECT idFunc, nomeFunc, generoFunc, dataNascFunc, emailFunc, telFunc from tbfunc";
$resultado_func = mysqli_query($con, $query_func);
while($row_tbfunc = mysqli_fetch_assoc($resultado_func)){
    $html_func .=  '<tr><td>'.$row_tbfunc['idFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['nomeFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['generoFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['dataNascFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['telFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['emailFunc'] . "</td></tr>";

}

$html_func .= '</tbody>';
$html_func .= '</table';


//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// Carregar o Composer
require './vendor/autoload.php';

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html('
        <h1 style="text-align: left;">Relatório Funcionários</h1>
        '. $html_func .'
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


