<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));

/* Atualização dos campus */
//$sql = "update pibic_professor set pp_centro = 'PUC MARINGA' where pp_centro = 'CCAS' ";
//$rlt = db_query($sql);

if (strlen($dd[2]=='SET'))
	{
		$_SESSION['campus'] = $dd[1];
		redirecina('indicadores.php');
	}

echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

echo '<h1><I>Campus</I></h1>';
echo '<font class="lt2">Selecione o campus para delimitação</font>';

$sql = "select pp_centro, count(*) as total from pibic_professor group by pp_centro order by pp_centro ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$link = '<A HREF="'.page().'?dd1='.trim($line['pp_centro']).'&dd2=SET" class="lt1 link">';
		echo '<BR>'.$link.$line['pp_centro'].'</A>';
		echo ' ('.$line['total'].')';
	}


require("../foot.php");	
?>