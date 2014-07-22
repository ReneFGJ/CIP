<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Depoimentos - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
		
		<script type="text/javascript">
			function mudaAba (numero_aba)
			{
			if (numero_aba == 1)
			{
			      document.getElementById('aba1').style.display="inline";
			      document.getElementById('aba2').style.display="none";
			}
			else if (numero_aba == 2)
			{
			      document.getElementById('aba2').style.display="inline";
			      document.getElementById('aba1').style.display="none";
			}
			}
		</script>
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Eduardo Moreira - Noruega</h1>
<p>"God created the world, and the dutchmen created Netherlands." - and I add that them made a good job. Everywhere it is noticed the concerning about life quality, since the concerts on tv and fresh air cinemas to an extensive commom carrier covering all the city and country. Living under the level sea (some placesm more than 10 meters bellow) it is not reason to dutchman living ashamed - on contrary, they are welcoming and they don´t wast time in parting, doesn´t matter with who neither where. As a matter of fact, the campus and the city are rich in foreign students: sérvio, iranian, colombian, chinese, canadian, french... 
Who choose coming to here, I have some tips. Pay attention to the of getting the residence and entrance visa, even if without mistakes in documents, the process can be delayed and you can lost some classes trying to solve this. Try to find a place to live before you arrive in the country - it saves a lot of time. Finally, buy the ov-chipkaart as soon as possible, because you can travel over all the Netherlands by train, subway, buses, and the taxes get chipper."
Netherlands is a incredible country, and it goes beyond the coffee shops and the Red Light District. Coming over here it is a unique experience and living here in unforgettable.
09/03/2012</p>
				<img src="img/eduardo-noruega-foto-grande.jpg" /><br />
				<p><a href="">Ver depoimento de Chris Friedrich - Estados Unidos >></a></p>
			 
			<div id="links-relacionados">
				<br />  
					<h3>Links relacionados:</h3>
					<li><a href="depoimentos.php">Leia os depoimentos feitos por alunos que estão viajando</a></li>
					<li><a href="index.php">Como funciona o Ciência sem Fronteiras?</a></li>
							
			</div>
				 	
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>