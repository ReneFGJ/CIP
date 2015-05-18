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
				  <h1>Depoi<span class="lt6light">mentos</span></h1>
				  <p>Está com curiosidade de saber como o pessoal está se saindo lá fora? 
				  	Nesta página, alguns alunos contam como foi ou está sendo a vida em outro país:</p>
			
			<div id="caixa-abas">
				<a href='#' OnClick="mudaAba(1)" class="aba-1-link">Textos</a>
				<a href='#' OnClick="mudaAba(2)" class="aba-2-link">Vídeos</a>
			</div>
			
			<div id="aba1" style="display:inline;">
				<div id="depoimentos-texto">
					<h3>Depoimentos em Textos</h3>
				
					<div id="depoimento-texto-1">
						<a href="depoimento-detalhe.php"><h4>Chris Friedrich <span class="lt5">Alemanha</span></h4></a>
						<img src="img/chris-alemanha.jpg" />
						
					</div>
					
					<div id="depoimento-texto-2">
						<a href="depoimento-detalhe-2.php"><h4>Eduardo Moreira <span class="lt5">Noruega</span></h4></a>
						<img src="img/eduardo-moreira-noruega.jpg" />
					</div>
					
					<div id="depoimento-texto-1">
						<a href="depoimento-detalhe-3.php"><h4>Allan Amorin <span class="lt5">Estados Unidos</span></h4></a>
						<img src="img/allan-amorin-eua.jpg" />
					</div>
					
			
				</div><!-- fecha div depoimento texto -->
			</div> <!-- fecha div aba1 -->
			
				  
			<div id="aba2" style="display:none;">
				<div id="depoimentos-video">
				<h3>Depoimentos em Vídeos</h3>
				
				<div id="video-1">
					<h4>Ana Paula (Estados Unidos)</h4>
					<video width="320" height="240" controls>
					  <source src="videos/Ana Paula_WMV V9.mp4.mp4" type="video/mp4">
					  <source src="videos/Ana Paula_WMV V9.oggtheora.ogv" type="video/ogg">
					  Seu browser não permite visualizar este vídeo. Você pode atualizá-lo para visualizar.
					</video>					
				</div>
				
				<div id="video-2">
					<h4>Eduardo e Matheus (Holanda)</h4>
					<video width="320" height="240" controls>
					  <source src="videos/Ana Paula_WMV V9.mp4.mp4" type="video/mp4">
					  <source src="videos/Ana Paula_WMV V9.oggtheora.ogv" type="video/ogg">
					  Your browser does not support the video tag.
					</video>
				</div>
				
				<div id="linha-divisoria"></div>
				
				<div id="video-1">
					<h4>Elori (Japão)</h4>
					<video width="320" height="240" controls>
					  <source src="videos/Ana Paula_WMV V9.mp4.mp4" type="video/mp4">
					  <source src="videos/Ana Paula_WMV V9.oggtheora.ogv" type="video/ogg">
					  Seu browser não permite visualizar este vídeo. Você pode atualizá-lo para visualizar.
					</video>					
				</div>
				
				<div id="video-2">
					<h4>Maria Eduarda (França)</h4>
					<video width="320" height="240" controls>
					  <source src="videos/Ana Paula_WMV V9.mp4.mp4" type="video/mp4">
					  <source src="videos/Ana Paula_WMV V9.oggtheora.ogv" type="video/ogg">
					  Your browser does not support the video tag.
					</video>
				</div>
				
				
				</div> <!-- fecha div depoimento video -->
				
				
				
			</div><!-- fecha div aba2 -->
			
			
			
			<br />  
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