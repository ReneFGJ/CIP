<?php
require("cab_semic.php");
require("../_class/_class_semic.php");
require($include.'sisdoc_data.php');
$semic = new semic;


$sql = "select * from articles where 
			journal_id = 75 
			and article_autores like '%- [confirmar]%' 	";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		print_r($line);
	//	exit;
	}
//exit;
$jid = $semic->recupera_jid_do_semic();
echo '-->'.$jid;
echo $semic->page_index_create();
echo $semic->lista_de_trabalhos_to_site();
?>
