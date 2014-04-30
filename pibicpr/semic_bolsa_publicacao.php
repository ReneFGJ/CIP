<?php
require("cab.php");
require($include.'sisdoc_data.php');

$ano = (date("Y")-1);
$sql = "select * from pibic_bolsa_contempladas
			inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
			left join articles on  article_3_keywords = ('IC' || pb_protocolo )
			where pb_ano = '".$ano."' and (pb_status <> 'C') 
			order by pbt_edital ";
$rlt = db_query($sql);

$sx .= '<table class="tabela00" width="100%">';
$tot = 0;
while ($line = db_read($rlt))
	{
		$tot++;
		$sx .= '<TR class="tabela01">';
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pbt_edital'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pb_protocolo'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pb_ano'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pb_titulo_projeto'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pb_protocolo'];
		$sx .= '<TD class="tabela01">';
		$dt = $line['pb_relatorio_final'];
		if ($dt < 20000101)
			{
				$sx .= 'Não postado';
			} else {
				$sx .= stodbr($line['pb_relatorio_final']);
			}
		$sx .= '<TD class="tabela01">';
		$sx .= $line['article_title'];
		$sx .= '<TD class="tabela01">';
		$sx .= stodbr($line['article_dt_revisao']);
		$sx .= chr(13);
	}
$sx .= '<TR><TD colspan=5>'.$tot;
$sx .= '</table>';
echo $sx;
require("../foot.php");	
?>