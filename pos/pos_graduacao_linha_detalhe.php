<?php
/*** Modelo ****/
require ("cab_pos.php");
global $acao, $dd, $cp, $tabela;
require ($include . 'sisdoc_colunas.php');
require ($include . 'sisdoc_form2.php');
require ($include . 'sisdoc_debug.php');

/* Dados da Classe */
require ('../_class/_class_programa_pos.php');
$pos = new programa_pos;

require ("../_class/_class_programa_pos_linhas.php");
$lin = new pos_linha;

$lin_id = round('0'.$dd[0]);
$lin->le($lin_id);

$pos_id = round('0'.$lin->programa);
$pos->le($pos_id);

echo $pos->mostra();

echo $lin->mostra();
echo $lin->mostra_docentes();

require ("../foot.php");
?>
