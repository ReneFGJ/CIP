<?
require("include/sisdoc_autor.php");

	if (strlen($dd[0])==0)
	{
	$sql = "select max(id_article) as art_id from ".$tabela;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$dd[0] = $line['art_id'];
		}
	}
	$tit1 = $dd[5];
	
	//// ZERA DADOS PARA INDEXAR NOVAMENTE OS AUTORES
	$sql = "delete from autores where ia_article = '".$dd[0]."' and journal_id = '".$jid."';";
	$rrr = db_query($sql);
	
	//// INICIA PROCESSO DE INDEXACAO
		//titulos
		
	$nme=$dd[5];
	$autor = ext_autor($nme);
	echo '<HR>';
	for ($k=0;$k < count($autor);$k++)
		{
		indexar_autor('AU',$autor[$k][0],$dd[0]);
		}
	

function indexar_autor($v1,$v2,$id)
	{
	global $jid;
	$va1 = nbr_autor($v2,1);
	$va2 = nbr_autor($v2,2);
	$va3 = nbr_autor($v2,3);
	if (strlen(trim($va3)) > 0)
		{
		$sql = "insert into autores (journal_id,ia_article,ia_word,ia_asc,ia_mst) values ";
		$sql = $sql . "('".$jid."','".$id."','".substr($va3,0,100)."','".substr($va2,0,100)."','".substr($va1,0,100)."')";
		$rrr = db_query($sql);
		}
	}
?>
