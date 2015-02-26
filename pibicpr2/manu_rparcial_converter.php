<?
require("cab.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
require("../_class/_class_parecer.php");

$sql = "select * from ".$pb->tabela." where pb_status = 'A' ";	
$rlt = db_query($sql);
echo $sql;
while ($line = db_read($rlt))
	{
		$pr = trim($line['pb_relatorio_parcial']);
		if ($pr < 20100101)
			{
			print_r($line);
			echo '<HR>';
			$proto = $line['pb_protocolo'];
			$sql = "update ".$pb->tabela." set
				pb_relatorio_parcial = ".date("Ymd")." , 
			 	pb_relatorio_parcial_nota = 2 
				where pb_protocolo = '$proto' ";
			$trlt = db_query($sql);
			}
	}

require("foot.php");	
?>