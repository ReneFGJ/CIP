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
				  <h1>Chris Friedrich - Alemanha</h1>
				  <p>"I believe that doesn´t matter where I am going, if I am going to live by myself and moving out from my house to live without my parents it is a big learning. It was the first time that I really had to muddle through by myself, and I confess in the beggining I made some mistakes, but as time goes by it becomes more rare and now, after more than six months away from Brazil, I realize how much I´ve grown up with all I´ve learned here. Germany is an incredible place, with all the background stories, the food, people I get surprised with everything. They say germans are cold and boring, and some of them really are, but there is this kind of people everywhere. Doesn´t matter where you are, most of them are very cool, able to help you whenever you need. There is no problem if you don´t speak german very well: people know how to speak English and just those ones who have difficulties with this language that gets angry when they´re helping you. But it doesn´t mean they won´t help you. My program is being oriented to laboratory projects, and I had the opportunity to attend just to two subjects, which won´t count in my undergraduation when I come back to Brazil, because I am immersed here in another degree course. However a paper reward is nothing compared to what I am learning, not only in academic discussions, but in personal life. I recommend Germany, in fact, I would recommend anywhere, because it is a unique experience in exchange and this chance can´t be wasted."</p>
				<img src="img/chris-alemanha-foto-grande.jpg" /><br />
				<p><a href="">Ver depoimento de Allan Amorin - Estados Unidos >></a></p>
			 
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