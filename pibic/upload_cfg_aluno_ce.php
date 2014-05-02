<?
require($include.'sisdoc_debug.php');
$table_bg = "#c0c0c0";
$tp = 'ENDE';
$titulo = "Submeter Documentos (Endereço)";
$classe = "Todos";
$fld = array("jpg","pdf");
$limit = 2 * 1024 * 1024;

////////////// Pasta para gravar imagens
$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/reol/pibic/ass/ende/';
$controle_mes = 0; // abre nova pasta para cada ano / mês
$info = "";

$lt1  = "font-family : Arial, Helvetica, sans-serif; font-size: 12px; color : Black; ";
$lt2  = "font-family : Arial, Helvetica, sans-serif; font-size: 14px; color : Black; ";
$lt1i = "font-family : Arial, Helvetica, sans-serif; font-size: 12px; color : Blue; ";
$body = "background-image : url(upload_bg.png); background-position : center; background-repeat : repeat;";

$tabela_ged = ''; // nome da tabela que salva os arquivos GED
$updatex = ''; // arquivo que chama quando salva corretamente

$xchave = UpperCaseSQL(substr(md5('ENDE'.$dd[1].'ENDE'),0,8));
$dd[0] = $dd[1].'-01-'.$xchave.'-'.$dd[1];
?>