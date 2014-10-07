<?php
$LANG = 'pt';
$idv = substr(date("s"),1,1);
$idv = '4';
$video = '';

require("db.php");

function msg($x) 
	{
	switch ($x)
		{
		case '1': $x = '1'; break;
		}	
	return($x);
	}
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js wf-loading"> <!--<![endif]-->
	
	
<!DOCTYPE html>
<html>
    
    <head>
	    <meta charset="iso-8859-1">
		<title>III CIC&PG - PUCPR</title>
        <meta charset="ISO-8859-1" description" content="">
		<meta name="description" content="Encontro Sul de Iniciacao Cientifica e Pps-Graduacao">
	    <link rel="icon" type="img/png" href="favicon.png">
	    <link rel="stylesheet" href="css/cicpg-inport-font.css">
		<link rel="stylesheet" href="css/cicpg-header-main.css">
		<link rel="stylesheet" href="css/cicpg_normal.css">
		<script src="js/jquery.js"></script>
        <script src="js/scrooling.js"></script>
		<script src="js/jquery.maskedinput.js"></script>
    	<script src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js" type="text/javascript"></script>
    	<script type="text/javascript"> 
        $(function(){
            $('article.tabs section > h3').click(function(){
                $('article.tabs section').removeClass('current');
                $(this)
                .closest('section').addClass('current');
            });
        });
    	</script>
   	</head>

		
	<body>
	<?
	require("cab_top_menu_en.php");
	?>