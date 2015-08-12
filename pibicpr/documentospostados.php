<?php
require("cab.php");

/**
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('iniciação científica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Submissões</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

require('../_class/_class_submit.php');
	$docs_post = new submit;

	echo $docs_post->submit_documentos_postados();

	require("../foot.php");	
?>