<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_debug.php');
if (strlen($acao) > 0)
	{
		if (substr($dd[0],0,1) == '1')
		{
			$sql = "update pibic_projetos set pj_status = 'X' where pj_codigo = '".$dd[0]."'";
			$rlt = db_query($sql);
			$sql = "update pibic_submit_documento set doc_status = 'X' where doc_protocolo_mae = '".$dd[0]."'";
			$rlt = db_query($sql);						
		} else {
			$sql = "update pibic_submit_documento set doc_status = 'X' where doc_protocolo = '".$dd[0]."'";
			$rlt = db_query($sql);
		}
		require("../close.php");
	}
//main_submit_cancel.php?dd0=0004519&dd90=0b0d29fb7f
?>
<center>
	<h2>Confirmar cancelamento deste protocolo <?php echo $dd[0];?></h2>
	<form method="post" action="<?php echo page();?>">
	<input type="hidden" name="dd0" value="<?php echo $dd[0];?>">
	<input type="hidden" name="dd90" value="<?php echo $dd[90];?>">
	<input type="submit" name="acao" value="canclear">
</center>