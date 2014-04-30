<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
require($include."sisdoc_debug.php");

/* Le dados da Indica��o */
require("../_class/_class_parecer_pibic.php");
$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");

if (strlen($dd[1]) > 0)
	{
		$sql = "update ".$parecer_pibic->tabela." 
					set 
					pp_status ='D',
					pp_abe_15 = '** DECLINA��O AUTOM�TICA EM ".date('d/m/Y')." **'
				where pp_status = '@' and pp_tipo = '".$dd[1]."' ";
		$rlt = db_query($sql);
	}

$sql = "select count(*) as total, pp_status, pp_tipo 
		from ".$parecer_pibic->tabela."
		where pp_status = '@' 
		group by pp_status, pp_tipo order by pp_tipo, pp_status ";
$rlt = db_query($sql);


$sx .= '<form action="'.page().'" method="get" id="formx">';
$sx .= '<input type="hidden" value="" name="dd1" id="dd1">';
$sx .= '<table width="100%" class="tabela00">';
while ($line = db_read($rlt))
	{
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01">';
		$tipo = trim($line['pp_tipo']);
		switch ($tipo)
			{
				case 'RPAC': $sx .= 'Corre��o do relat�rio parcial'; break;
				case 'RPAR': $sx .= 'Relat�rio parcial'; break;
				case 'RFIC': $sx .= 'Corre��o do relat�rio final'; break;
				case 'RFIN': $sx .= 'Relat�rio final'; break;
				case 'SUBMI': $sx .= 'Avalia��o da submiss�o - Projeto do professor'; break;
				case 'SUBMP': $sx .= 'Avalia��o da submiss�o - Plano'; break;
				default: $sx .= '?????'.$tipo; break;
			}
		$sx .= '<TD width="5%" class="tabela01" align="center">'.$line['total'];
		$sx .= '<TD width="5%" class="tabela01" align="center">';
		$sx .= '<input type="button" name="acao" onclick="enviar_dados(\''.$tipo.'\');" value="declinar todos" class="botao-geral">';
	}
	$sx .= '</table>';
	$sx .= '</form>';
	$sx .= '
	<script>
		function enviar_dados(tipo)
			{
				$("#dd1").val(tipo);
				$("#formx").submit();
			}
	</script>
	';
	
echo $sx;
require("../foot.php");	
?>