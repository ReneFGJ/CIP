<?php
if (empty($include)) { $include = ''; }
require('db.php');
require('security.php');
$user = new usuario;
$tela = $user->Security();
require('_class/_class_user_perfil.php');
$perfil = new user_perfil;

$ss = $user;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1" /> 
	<title>::CIP::</title>
	<link rel="shortcut icon" type="image/x-icon" href="http://www.pucpr.br/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/letras.css" />
	<script language="JavaScript" type="text/javascript" src="js/jquery-1.7.1.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/jquery.corner.js"></script>	
</head>
