<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');


$saved = 1;

require("../_class/_class_ic.php");

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
echo '<TR><TD colspan=6>';

$pj->le($protocolo);
/*********************************************************************/
/* Dados do professor */
$prof = $pj->line['pj_professor'];
$doc->le($prof);
//echo $doc->mostra();

/*********************************************************************/
///echo $pj->mostra($pj->line);
echo '</table>';
echo '<center>';

$ic = new ic;
$nw = $ic->ic('ic_fim_avalicao');
echo '<table width="100%"><TR><TD>';
echo '<font style="font-size: 16px;">';
echo mst($nw['nw_descricao']);
echo '</table>';
echo '<BR><BR><BR><BR>';
?>