<?php
require("cab.php");
require("../_class/_class_pareceristas.php");
$par = new parecerista;
$par->tabela_instituicao = "instituicoes";

require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;

require("../_class/_class_parecer.php");

$par->le($dd[0]);
echo '<h3>Participação nas avaliações</h3>';


/* */
$par = new parecerista;
$par->le(round($dd[0]));

/* Areas */
$edit = 1;
$page = page();
if (($dd[12]=='ADD') and (strlen($dd[10]) > 0)) { $par->area_adiciona($dd[10]); }
if (($dd[12]=='DEL') and (strlen($dd[10]) > 0)) { $par->area_excluir($dd[10]); }


/* dados do parecerista */
echo $par->mostra_dados();


/* resumo do avalidor */
echo '<div style="float: right;">'.chr(13);
echo $par->resumo_avaliador();

echo '</div>'.chr(13);

$pp->avaliacoes_pelo_avaliador($par->codigo);

echo '<div style="float: clear;"></div>';

	$pa = new parecer;
	echo '<hr>';
	/* echo $pa->parecer_avaliador_mostrar($par->codigo); */
	echo '<hr>';
	
echo $par->mostra_areas();
echo '<table align="center">';
	echo '<TR><TD>';
echo $par->area_mostra_adiciona();
echo '</table>';

echo '</div>';

require("../foot.php");
?>
