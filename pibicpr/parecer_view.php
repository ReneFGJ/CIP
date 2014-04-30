<?php
$include = '../';
require("../db.php");

require("../avaliador/avaliacao_pibic_RFIN_cp.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$bolsa = new pibic_bolsa_contempladas;

/* Le dados da Indicação */
require("../_class/_class_parecer_pibic.php");
$parecer_pibic = new parecer_pibic;
$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");
$parecer_pibic->le($dd[0]);

/* Recupera protocolo do projeto */
$protocolo = $parecer_pibic->protocolo;

$view = 'screen';
$bolsa->le('',$protocolo);
for ($r=1;$r < 99;$r++)
	{
		$line = $parecer_pibic->line;
		$field = trim($cp[$r][1]);
		$dd[$r] = $line[$field];
	}
require("../avaliador/avaliacao_pibic_RFIN_pdf.php");
?>
