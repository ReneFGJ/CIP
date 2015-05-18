<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>O que é? - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>O q<span class="lt6light">ue é</span></h1>
				 <p>"<a href="http://www.cienciasemfronteiras.gov.br" target="_blank">Ciência sem Fronteiras</a> é um programa que busca promover a consolidação, expansão e internacionalização da 
				 	ciência e tecnologia, da inovação e da competitividade brasileira por meio do intercâmbio e da mobilidade 
				 	internacional. A iniciativa é fruto de esforço conjunto dos Ministérios da Ciência, Tecnologia e Inovação 
				 	(MCTI) e do Ministério da Educação (MEC), por meio de suas respectivas instituições de fomento – CNPq e Capes –, 
				 	e Secretarias de Ensino Superior e de Ensino Tecnológico do MEC.<br /><br />

					O projeto prevê a utilização de até 101 mil bolsas em quatro anos para promover intercâmbio, de forma que 
					alunos de graduação e pós-graduação façam estágio no exterior com a finalidade de manter contato com sistemas 
					educacionais competitivos em relação à tecnologia e inovação. Além disso, busca atrair pesquisadores do 
					exterior que queiram se fixar no Brasil ou estabelecer parcerias com os pesquisadores brasileiros nas áreas 
					prioritárias definidas no Programa, bem como criar oportunidade para que pesquisadores de empresas recebam 
					treinamento especializado no exterior."</p>
			
			<div id="links-relacionados">
					<h3>Links relacionados:</h3>
					<li><a href="quemjaviajou.php">Descubra quem já viajou!</a></li>
					<li><a href="dequaiscursos.php">De quais cursos são os alunos que já foram selecionados?</a></li>
				</div>
			
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>