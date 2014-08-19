<?php
require("cab.php");
require("_class/_class_pareceristas.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');

require("_class/_class_parecer.php");

$par = new parecerista;

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Avaliadores da Revista');
/* Areas */
$edit = 1;
echo $par->lista_avaliadores();
echo '</div>';

require("foot.php");
?>
