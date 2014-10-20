<?php
require ("cab_semic.php");

require($include.'sisdoc_debug.php');
require("../_class/_class_semic.php");

echo '<h1>Lista de Submissões de trabalhos</h1>';
$semic = new semic;
$semic->tabela = "semic_ic_trabalho";
$semic->tabela_autor = "semic_ic_trabalho_autor";

$sql = "select * from semic_trabalho 
			left join programa_pos on sm_programa = pos_codigo
			where sm_ano = '".date("Y")."'
			and sm_status <> 'X' and sm_status <> '@'
			order by sm_modalidade, pos_nome
";

$rlt = db_query($sql);
$sx .= '<table>';
while ($line = db_read($rlt))
	{
		$mod = $line['sm_modalidade'];
		if ($mod != $xmod)
			{
				$sx .= '<TR><TD colspan=5><h1>'.$mod.'</h1>';
				$xmod = $mod;
			}
		$sx .= '<TR>';
		$sx .= '<TD>'.$line['pos_nome'];
		$sx .= '<TD>'.$line['sm_status'];
		$sx .= '<TD>'.$line['sm_titulo'];
		$ln = $line;
	}
$sx .= '</table>';
echo $sx;
?>
