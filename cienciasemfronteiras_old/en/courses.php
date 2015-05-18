<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Priority Areas - Science Withour Borders | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				 <h1>Priority<span class="lt6light"> Areas</span></h1>
				 	<p>You need to be enrolled in a course that belongs to the priority areas defined by the Government. Also, your
				 		course need to be included in the MEC system.</p>
				 
				 <h2>Which are they?</h2>
					<p>The Government decided that some areas are priority. This means that only the students which
						are enrolled in these areas are allowed to participate in SwB. 

						<strong><p>- Engeneering and Technological field;<br />
						- Exact and earth Sciences;<br />
						- Biology, Biomedical Science and Health;<br />
						- Computer and Information technology;<br />
						- Aerospacial Technology;<br />
						- Pharmacy<br />
						- Sustainable Agricultural Production;<br />
						- Oil, gas and mineral coal;<br />
						- Renewable Energies;<br />
						- Mineral Technologies;<br />
						- Biotechnology;<br />
						- Nanotechnology and New Materials;<br />
						- Natural Disaters Prevention and Mitigation Technology;<br />
						- Biodiversity and Bioprospection;<br />
						- Sea Sciences;<br />
						- Creative Industry (inovation and technological development);<br />
						- New technologies in Building Engineering;<br />
						- Technical formation;</p></strong>
						
								
				<h2>Priority areas from students in exchange:</h2>
			
			<img src="img/grafico-areas.jpg" />
			
			<div id="links-relacionados">
					<h3>Related Links:</h3>
					<li><a href="testedeproficiencia.php">Understand how works the Proficiency exams</a></li>
					<li><a href="beneficios.php">Which are the Science without Borders benefits?</a></li>
			</div>
			
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>