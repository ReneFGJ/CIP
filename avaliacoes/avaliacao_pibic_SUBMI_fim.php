<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');


$saved = 1;

require("../_class/_class_docentes.php");
$doc = new docentes;

require("../pibic/_ged_config_submit_pibic.php");
//if ($dd[90] != checkpost($id)) { echo 'Erro de post'; exit; }

require("../_class/_class_pibic_projetos.php");
$pj = new projetos;

/* Le dados da Indicação */
$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");
$parecer_pibic->le($dd[0]);

/* Recupera protocolo do projeto */
$protocolo = $parecer_pibic->protocolo;
$id = $parecer_pibic->id_pp;

echo '<table width=95% align=center border=0 >';
echo '<TR><TD>';

$pj->le($protocolo);
/*********************************************************************/
/* Dados do professor */
echo '<center><h3>Dados do Professor Orientador</h3></center>';
$prof = $pj->professor;
$doc->le($prof);
echo $doc->mostra();

/*********************************************************************/
echo '<center><h3>Projeto do Professor Orientador</h3></center>';
echo $pj->mostra($pj->line);
echo '</table>';
echo '<center>';
echo '<BR><BR><H1>Projeto avaliado com sucesso!</h1>';
