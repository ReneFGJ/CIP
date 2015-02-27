<?php
$LANG = 'pt';
$idv = substr(date("s"), 1, 1);
$idv = '4';
$video = '';

require ("db.php");

?><
!DOCTYPE html><!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js wf-loading">
	<!--<![endif]-->

	<!DOCTYPE html>
<html>

	<head>

		<title>III CIC&PG - PUCPR</title>
		<meta charset="ISO-8859-1">

		<meta name="description" content="Encontro Sul de Iniciacao Cientifica e Pps-Graduacao">
		<link rel="icon" type="img/png" href="favicon.png">
		<link rel="stylesheet" href="css/cicpg-inport-font.css">
		<link rel="stylesheet" href="css/cicpg-header-main.css">
		<link rel="stylesheet" href="css/cicpg_normal.css">
		<link rel="stylesheet" href="css/font-awesome-4.2.0/css/font-awesome.css">
		<link rel="stylesheet" href="css/font-awesome-4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/component.css">
		<script src="js/jquery.js"></script>
		<script src="js/scrooling.js"></script>
		<script src="js/jquery.maskedinput.js"></script>

		<script src="js/modernizr.custom.js"></script>
		<script src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$('article.tabs section > h3').click(function() {
					$('article.tabs section').removeClass('current');
					$(this).closest('section').addClass('current');
				});
			});
		</script>

		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o), m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-12712904-7', 'auto');
			ga('send', 'pageview');

		</script>
	</head>

	<body>
		<?
		require ("cab_top_menu.php");
		?>

		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu(document.getElementById('gn-menu'));
		</script>
