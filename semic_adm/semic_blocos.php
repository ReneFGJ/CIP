<?php
require("cab_semic.php");
require("../_class/_class_semic_blocos.php");
$bl = new blocos;

$bl->row();

$tabela = "semic_blocos";
$pre_where = "blk_ano = '".date("Y")."'";

$idcp = "";
$http_edit = 'semic_bloco_ed.php';
$http_ver = 'semic_blocos_mostra.php';
 
 
$editar = true;
$http_redirect = page();
$busca = true;
$offset = 40;
$tab_max = "100%";
$order = 'blk_data, blk_hora, blk_titulo';
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');
echo '</table>';
echo '<A HREF="'.page().'?dd1=SORT">ordenar por referencia</A>';
echo '</div>';




require("../foot.php");
?>
