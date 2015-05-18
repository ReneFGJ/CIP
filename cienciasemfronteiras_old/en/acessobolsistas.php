<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Scholarship Holder Access - Acsess toScience Without Borders | PUCPR</title>
        <meta charset="utf-8">
        <meta name="<?php echo $name;?>" content="<?php echo $content;?>">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Scholarship Holder<span class="lt6light"> Access</span></h1>
				  
				  	<div id="acesso-bolsista">
					  	<div id="acesso-login">
					  		<p class="texto-caixa-acesso-bolsistas">Dear student,<br />

During your exchange you must post within 30 days after traveling, the following documents: <strong>insure receipt and enrollment receipt</strong>, as well include the following information: <strong>address abroad, International Relations contact of your University, contact in Brasil</strong>. 

Is it your first access? Create a password:</p>
					  			<span class="lt4">CPF</span><br /><input type="text" class="input-light" placeholder="000.000.000-000"></input><br />
					  			<span class="lt4">Password</span><br /><input type="text" class="input-light" placeholder="*****"></input><br />
					  			<button class="botao-grande">Login</button>
					  	</div>
				  	</div>
				 	
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>