<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>What is it? - Science without Borders | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>What i<span class="lt6light">s it?</span></h1>
				 <p>"<a href="http://www.cienciasemfronteiras.gov.br" target="_blank">Science without Borders</a> 
				 	is a governamental program that aims to consolidate, expand and internationalize
				 	the science and technology, inovation and brazilian competitiveness by means of exchange and
				 	international mobility.</>
				 	<p>The initiative comes from a combined effort of the Science, Technology and Inovation
				 		ministery (MCTI) and from the Education Ministery (MEC), by means of its respective 
				 		fomentation instituitions - CNPq and CAPES -, and MEC Higher Education Boureau and
				 		Technology Education.</p>
				 		
				 	<p>The project foresee 101.000 scholarship in 4 years to promote the exchange, 
				 		in order to graduation and post-graduated students look for internship with the
				 		purpose to keep in touch with the competitive educational system related to
				 		technology and inovation. Besides, the program is looking forward to bring
				 		foreing researchers who wants to come to Brazil or settle partnership with
				 		brazilian researchers in the priority areas defined in the program, as well as create
				 		opportunities to the employees to take specialized training abroad."</p>
				 	
				 	
				 	
			
			<div id="links-relacionados">
					<h3>Related links:</h3>
					<li><a href="quemjaviajou.php">Find out who is in exchange</a></li>
					<li><a href="dequaiscursos.php">Find out which courses belong the students who are in exchange from PUCPR</a></li>
				</div>
			
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>