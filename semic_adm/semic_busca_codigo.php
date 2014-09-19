<?php
require("cab_semic.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


$file = '../messages/msg_index.php';
if (file_exists($file)) { require($file); }

$proj = 'ADM10';

$sql = "select * from articles where article_ref = '".$proj."'";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		echo '<HR>';
		echo $line['article_title'];
		echo '<BR>';
		echo $line['article_autores'];
		echo '<BR>';
		echo $line['journal_id'];
	}

require("../foot.php");	
?>