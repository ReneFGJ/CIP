<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Apply - Science without Borders | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Ap<span class="lt6light">ply</span></h1>
				  <p>You have two option for apply:</p>
				  
				  <div id="inscricao-campo">
				  	
				  	<div id="inscricao-interessado">
				  		<p class="texto-caixa-interesse">In this option you are applying <strong>as interested</strong>. Use your PUCPR card number:</p>
				  			<input type="text" class="input-dark" placeholder="000000000-0"></input><br />
				  			<button class="botao-grande">I am only interested</button>
				  	</div>
				  	
				  	<div id="inscricao-edital">
				  		<p class="texto-caixa-inscricao-edital">Here you are really  <strong>applying for SwB</strong>.
				  			 Use your PUCPR card number:</p>
				  			<input type="text" class="input-light" placeholder="000000000-0"></input><br />
				  			<button class="botao-grande">I want to apply for SwB</button>
				  	</div>
				  	
				  </div>
				 	
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>