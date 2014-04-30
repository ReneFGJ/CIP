<?php
require("cab.php");
require($include.'sisdoc_windows.php');

require("../_class/_class_docentes.php");
$dis = new docentes;

$tabela = $dis->tabela;
require("../_class/_class_pibic_pagamento.php");
$pag = new pagamentos;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_pibic_historico.php");
$hi = new pibic_historico;

$dis->le(round($dd[0]));

echo $dis->mostra_dados();
$cracha = $dis->pa_cracha;
$cpf = $dis->pa_cpf;

echo 'Link rápido de acesso: '.$dis->shortlink.'<BR><BR><BR>';

echo $dis->blacklist();
echo '<A HREF="docente_bl.php?dd0='.$dd[0].'">';
echo 'Editar Black List';
echo '</A>';	
echo '<BR>';

require("../foot.php");
