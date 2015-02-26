<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."cp2_gravar.php");
global $bgc;

$opa = ' :Todas';
for ($ra = date("Y");$ra >= 2009;$ra--) { $opa .= '&'.$ra.':'.$ra; }
$opc = ' :Todas as bolsas ';
$sql = 'select * from pibic_bolsa_tipo order by pbt_descricao';
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$opc .= '&'.trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}

		$tabela = '';
		$cp = array();
		array_push($cp,array('$H8','','',False,True,''));
		array_push($cp,array('$O '.$opa,'','Edital',False,True,''));
		array_push($cp,array('$D8','','De',True,True,''));
		array_push($cp,array('$D8','','até',True,True,''));
		array_push($cp,array('$O '.$opc,'','Bolsa',False,True,''));
		array_push($cp,array('$[2010-'.date("Y").']'.$opc,'','Edital',True,True,''));
		

		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR><TD>';
		editar();
		echo '</TABLE>';	

if ($saved > 0)
{
	require("../_class/_class_pibic_bolsa_contempladas.php");
	$pb = new pibic_bolsa_contempladas;
	$pb->relatorio_cancelamento($dd[5],$dd[4]);

}


require("foot.php");
?>