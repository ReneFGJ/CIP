<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$sql = "select * from pibic_edital_indicacao 
			left join pibic_professor on pei_professor = pp_cracha
			left join pibic_bolsa_tipo on pbt_codigo = pei_modalidade
			order by pp_nome
		";
$rlt = db_query($sql);
$sx = '<table width="100%" class="tabela00">';
$xprof = 'X';
$sx .= '<TR><TH>Modalidade<TH>Edital<TH>Ano<TH>Estatus
			<TH>Valor da bolsa<TH>Transporte';
$id=0;
while ($line = db_read($rlt))
	{
		$prof = trim($line['pp_nome']);
		if ($prof != $xprof)
			{
				$sx .= '<TR><TD colspan=5 class="lt2"><B>'.$prof.'</B>';
				$sx .= ' ('.trim($line['pp_cracha']).')';
				$xprof = $prof;
			}
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pbt_descricao'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pei_edital'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pei_ano'];
		$sx .= '<TD class="tabela01">';
		$sta = $line['pei_status'];
		switch ($sta)
			{
			case '@': $sta = 'Não implementado'; break;
			case '!': $sta = 'Indicado, aguardando validação aluno'; break; 
			}
		$sx .= $sta;
		$sx .= '<TD class="tabela01" align="right" width="80">';
		$sx .= number_format($line['pei_valor'],2,',','.');

		$sx .= '<TD class="tabela01" align="right" width="80">';
		$sx .= number_format($line['pei_transporte'],2,',','.');
				
		$id++;
	}
$sx .= '<TR><TD colspan=5>Total '.$id;
$sx .= '</table>';
echo $sx;
require("../foot.php");	
?>