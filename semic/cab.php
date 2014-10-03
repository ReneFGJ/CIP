<?php
require ("db.php");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="XXII SEMIC">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>XXII SEMIC</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/estilo.css" />
		<link rel="stylesheet" href="fontes/font-awesome-4.2.0/css/font-awesome.css" />
		<link rel="stylesheet" href="fontes/font-awesome-4.2.0/css/font-awesome.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<srcipt type="text/javascript" href="prettify.js"></srcipt>
		<script src="js/modernizr.custom.js"></script>
		<script>
			$(function() {
				var pull = $('#pull');
				menu = $('#menu ul');
				menuHeight = menu.height();

				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});

				$(window).resize(function() {
					var w = $(window).width();
					if (w > 320 && menu.is(':hidden')) {
						menu.removeAttr('style');
					}
				});
			});
		</script>
	</head>
	<body>

		<div class="container">
			<div id="menu" class="clearfix">
				<div class="brand">
					<span class="red"></span>
				</div>
				<ul class="clearfix link-flip">
					<li>
						<a href="index.php">SEMIC</a>
					</li>
					<li>
						<a href="programacao.php">Programação</a>
					</li>
					<li>
						<a href="expediente.php">Expediente</a>
					</li>
					<li>
						<a href="indice-onomastico.php">Índice Onomástico</a>
					</li>
					<li>
						<a href="sumario-geral.php">Sumário Geral</a>
					</li>
					<li>
						<a href="edicoes-anteriores.php">Edições Anteriores</a>
					</li>
				</ul>
				<a href="#" id="pull">XXII SEMIC</a>
			</div>
		</div>
		<div id="conteudo">
			<div class="main">
