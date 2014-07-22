<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Histórico Escolar - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				 <h1>Histórico<span class="lt6light"> Escolar</span></h1>
				 	<p>O Histórico Escolar é solicitado ao aluno em dois momentos:</p>
				 	
				 <h4>1. Durante a insncrição no Ciência sem Fronteiras</h4>
				 <p>Primeiro, é solicitado quando você está preenchendo sua inscrição.
				 	O único Histórico Escolar aceito é aquele retirado no SIGA.
				 	Você pode solicitar através do <a href="https://auth.pucpr.br/josso/signon/login.do?josso_back_to=http://200.192.112.53/intranet/josso_security_check" target='_blank'>Intranet da PUCPR</a></p>
				<h4>2. Durante a inscrição no parceiro</h4>
				<p>Neste momento, quem solicita o seu Histórico Escolar é o parceiro da universidade de destino.
					Possivelmente você precisará traduzir o histórico do Português para a língua do seu país de destino:</p>
					<p>Alguns países solicitam a tradução juramentada (Estados Unidos, por exemplo). Você precisará entrar 
						em contato com tradutores que façam este trabalho.</p>
					<p>Alguns outros países não pedem que a tradução seja juramentada (Reino Unido, por exemplo), eles pedem
						uma tradução simples, embora o próprio aluno não possa fazer a tradução e precisará da assinatura e carimbo
						da PUCPR.</p>
						<p>É importante lembrar que você pode conseguir o carimbo no Histórico Escolar no Núcleo de Intercâmbio aqui
							na PUCPR.<br />
							<a href="contato.php">Entre em contato com o Núcleo de Intercâmbio</a> para maiores informações.</p>
						
				<h1>Tradutores juramentados</h1>
				<p>Confira a <a href="http://www2.pucpr.br/reol/cienciasemfronteiras2/docs/tradutores_juramentados.pdf">lista dos tradutores juramentados</a> que entraram em contato com a PUCPR.</p>
				
			
			<div id="links-relacionados">
					<h3>Links relacionados:</h3>
					<li><a href="visto.php">Quando eu devo solicitar o visto?</a></li>
					<li><a href="dicasviagem.php">Encontre dicas sobre os alunos que já viajaram.</a></li>
			</div>
			
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>