<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Academic Transcript - Science without Borders | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				 <h1>Academ<span class="lt6light">ic Transcript</span></h1>
				 	<p>The Academic transcript is asked to the student in two moments:</p>
				 	
				 <h4>1. During the application in SwB</h4>
				 <p>First, is asked when you are filling up your application.
				 	The only Academic transcript accepted is the one you order at the SIGA.
				 	 You can order it through <a href="https://auth.pucpr.br/josso/signon/login.do?josso_back_to=http://200.192.112.53/intranet/josso_security_check" target='_blank'>Intranet in PUCPR</a></p>
				<h4>2. During the Partner application</h4>
				<p>In this moment, who asks your Academic transcript is the Partner from the Universities abroad. 
					You will usually need to translate it from portuguese to the language of the country you are appling in:</p>
					<p>Some countries ask the "juramentada" translation (Estados Unidos, for example). You need to get
						in touch with translators who have do this work.</p>
					<p>Other countries do not ask the translation to be 'juramentada' (Reino Unido, for exemple), they ask a simple
						translation, as long as the student do not be the translator himself, and you will also need a sgnature and stamp
						from PUCPR.</p>
						<p>It is important to remember that you can get your stamp in the Academic Transcript in the Núcleo de Intercambio 
							here in PUCPR.
							<a href="contato.php">Get in touch with Núcleo deINtercambio</a> for further informations.</p>
						
				<h1>"Juramentado" translator</h1>
				<p>Check the <a href="http://www2.pucpr.br/reol/cienciasemfronteiras2/docs/tradutores_juramentados.pdf">list of "juramentados" translators</a> that contacted PUCPR.</p>
				
			
			<div id="links-relacionados">
					<h3>Related links:</h3>
					<li><a href="visto.php">When do I need to get the visa?</a></li>
					<li><a href="dicasviagem.php">Find out trip tips from other students</a></li>
			</div>
			
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>