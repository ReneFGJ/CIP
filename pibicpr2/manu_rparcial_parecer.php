<?
require("cab.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
require("../_class/_class_parecer.php");
$pa = new parecer;

print_r($pb);

$sql = "update pibic_ged_documento set doc_status = 'A' where doc_tipo = 'AVLRP' and doc_ativo=1  ";
$rlt = db_query($sql);

$sql = "select * from ".$pa->tabela." where pp_status = 'C' ";	
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		$proto = trim($line['pp_protocolo']);
		$avali = trim($line['pp_p01']);
		
		echo '<BR>'.$proto.'-=-->'.$avali;
		$pa->protocolo = $proto;
		$sql = "select * from ".$pb->tabela." where pb_protocolo = '$proto' ";
		$rrlt = db_query($sql);
		$rline = db_read($rrlt);
		
		$sql = "update ".$pb->tabela." set pb_relatorio_parcial_nota = $avali 
			where pb_protocolo = '$proto' ";
		$trlt = db_query($sql);
	}

require("foot.php");	
?>