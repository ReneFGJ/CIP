<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


$sql = "select * from docente_ch 
			inner join pibic_professor on ch_cracha = pp_cracha
			where (pp_centro = '' or pp_centro isnull) or (pp_centro <> ch_campus)
			or (pp_escola <> ch_escola) or (pp_escola isnull) or (pp_escola = '')
			or (pp_update isnull)
			limit 100
";
$rlt = db_query($sql);
while ($line = db_read($rlt))
{
	echo '<TR>';
	echo '<TD>'.$line['pp_cracha'];
	echo '<TD>'.$line['ch_cracha'];
	echo '<TD>'.$line['pp_centro'];
	echo '<TD>'.$line['ch_campus'];
	
	$sql = "update pibic_professor set 
					pp_centro = '".trim($line['ch_campus'])."',
					pp_escola = '".trim($line['ch_escola'])."',
					pp_update = '".date("Y")."'
					where pp_cracha = '".$line['pp_cracha']."'";
	$rrr = db_query($sql);
}
require("../foot.php");	
?>