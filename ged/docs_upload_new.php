<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));

require("cab.php");
require("_ged_config_docs.php");
require($include.'sisdoc_windows.php');

$url = 'ged_upload.php?dd0=1';
echo '<A HREF="javascript:newxy2(\''.$url.'\',400,400);">';
echo 'upload';
echo '</A>';
