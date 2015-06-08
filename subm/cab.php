<?php
require("db.php");
require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
if (file_exists($file)) { require($file); }
$LANG = "pt_BR";

require("../_class/_class_submit.php");
require($include.'sisdoc_data.php');
$clx = new submit;

$clx->author_id();

?>
<head>
	<title><?=msg('submit_title');?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/subm_login.css" />
	<link rel="stylesheet" type="text/css" href="css/style_autocomplete.css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery.corner.js"></script>
	<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>
</head>
<center>
<div id="cab">
	<img src="img/logo_cs.png" align="left">
	<img src="img/logo_reol2.0.png" align="right">
</div>
<BR>
<div id="content">