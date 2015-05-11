<?php
require("cab.php");

require('../_include/_class_form.php');

require("../_class/_class_docentes.php");
$doc = new docentes;

require("../_class/_class_pareceristas.php");
$par = new parecerista;

require("../_class/_class_parecer_pibic.php");
$pa = new parecer_pibic;

$doc->le($dd[0]);

echo $doc->mostra_dados();
$cracha = trim($doc->pp_cracha);
$par->codigo = $cracha;
echo $par->mostra_link_avaliador($cracha);
echo '<BR><BR><BR>';

echo $doc->avaliador_ic();

echo '<BR>';
echo $par->area_do_conhecomento_professor_adicionar($cracha);

echo $par->area_do_conhecomento_professor($cracha);

$ano = date("Y");
echo $pa->avaliacoes_indicadas($cracha,$ano);
echo '<BR><BR><BR><BR>';
echo '</div>';
echo $hd->foot();
?>
