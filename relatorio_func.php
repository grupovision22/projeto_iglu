<?php

//Incluindo conexão com o bd
include_once './db.php';
function cargo_func($id){
        
    if($id == 1){
         return "Administrador";
    }else if($id == 2){
        return "Caixa";
    }
}

//Formatando a tabela
$html_func = '';
$html_func = '<link rel="stylesheet" href="estilo/bootstrap.min.css">';
$html_func = '<table class="table" border=1>';	
$html_func .= '<thead>';
$html_func .= '<tr>';
$html_func .= '<th scope="col">ID</th>';
$html_func .= '<th scope="col">Nome</th>';
$html_func .= '<th scope="col">Cargo</th>';
$html_func .= '<th scope="col">Genero</th>';
$html_func .= '<th scope="col">Data nascimento</th>';
$html_func .= '<th scope="col">Telefone</th>';
$html_func .= '<th scope="col">E-mail</th>';
$html_func .= '</tr>';
$html_func .= '</thead>';
$html_func .= '<tbody>';

//QUERY
$query_func = "SELECT * from tbfunc";
$resultado_func = mysqli_query($con, $query_func);
while($row_tbfunc = mysqli_fetch_assoc($resultado_func)){
    $html_func .=  '<tr><td>'.$row_tbfunc['idFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['nomeFunc'] . "</td>";
    $html_func .= '<td>'.cargo_func($row_tbfunc['idCargo'])."</td>";
    $html_func .= '<td>'.$row_tbfunc['generoFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['dataNascFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['telFunc'] . "</td>";
    $html_func .= '<td>'.$row_tbfunc['emailFunc'] . "</td></tr>";

}

$html_func .= '</tbody>';
$html_func .= '</table>';


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
$f;
$l;
if(headers_sent($f,$l))
{
    echo $f,'<br/>',$l,'<br/>';
    die('now detect line');
}
$dompdf->stream(
    "relatorio.pdf", 
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
?>


