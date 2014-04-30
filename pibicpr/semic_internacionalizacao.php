<?php
require("cab.php");
require($include.'sisdoc_colunas.php');

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

//$sql = "ALTER TABLE articles ADD COLUMN article_modalidade char(8)";
//$rlt = db_query($sql);
//$sql = "ALTER TABLE articles ADD COLUMN article_apresentacao char(3)";
//$rlt = db_query($sql);

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$sql = "select * from articles 
		inner join pibic_bolsa_contempladas on pb_protocolo = article_protocolo_original
		inner join ajax_areadoconhecimento on a_cnpq = pb_semic_area
		inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
		where journal_id = $jid ";
		//and pb_semic_idioma like 'en%'
$sql .= " order by pb_semic_idioma, pb_semic_area, pb_semic_idioma ";
$rlt = db_query($sql);
	echo '<TT>';
	$xarea = '';
$tot = 0;
$sqli = '';

echo '<table width="100%"><TR><TD><TT>';
while ($line = db_read($rlt))
{
	$idi = trim($line['pb_semic_idioma']);
	if (strlen($idi) == 0) { $idi = 'pt_BR'; }	
	$edital = trim($line['pbt_edital']);
	$idi = lowercase(substr($idi,0,2));
	
	$sqli .= "update articles set article_apresentacao = '$idi', article_modalidade = '$edital' where id_article = ".$line['id_article'].';'.chr(13).chr(10);
	//print_r($line);
	//exit;
	$tot++;
	$area = $line['pb_semic_area'];
	if ($xarea != $area)
		{
			echo '<BR><B>'.$area.' '.$line['a_descricao'].'</B>';
			$xarea = $area;
		}
	echo ' ';
	echo '<BR>';
	echo $line['article_title'];
		
	//print_r($line);
	//exit;
}
echo '</table>';
if (strlen($sqli) > 0)
	{
		$rlti = db_query($sqli);
	}
	
echo '<BR>Total de '.$tot.' projetos';
require("../foot.php");	
?>