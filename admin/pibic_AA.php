<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_parecer_pibic.php");
$clx = new parecer_pibic;


$clx->tabela = "pibic_parecer_".date("Y");

$sql = "select * from ".$clx->tabela." where pp_tipo = 'SUBMI' and pp_protocolo like '0%' ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$sql = "update ".$clx->tabela." set pp_tipo = 'SUBMP' 
				where id_pp = ".$line['id_pp'];
		$rrr = db_query($sql);
		echo '<BR>'.$sql;
	}	

require("../foot.php");	
?>