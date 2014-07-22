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
				  <h1>Allan Amorin - Estados Unidos</h1>
<p>"I've always had the american image wanted to be the best of all (and in fact some of them think like this), but when you tell them you are from Brazil, it´s different. They want to know about soccer, about our food and about how much we are kind and happy. Nowadays, to be brazilian is a reason of being proud. After saying your name, never forget to tell you are from Brazil. I did this and I realized that chatting becomes more relaxed. In the early days I was impressed with everything, because here most of things are exaggerated. Looks like everything comes from Itú... hehehehe... The college buildings seems like castles, and the "small size" glasses in american fast-food are the "extra-large" ones in Brazil. The large ones can feed a family in Brasil. You will find queer a lot the food, and seriously, who likes beans, rice and steak for lunch will find strange in the first days but you will get used to it. Coffee, how I miss our brazilian coffee, with a cheese-bread"... yumyyy... but we have to follow the flow, and I am here and need to get used to it. You will be shocked with how we are a exploitatived and you feel even so happy in the same time with the cars, eletronics and shoes that seems always for sale, because the taxes aren´t that expensive like Brazil´s one! whoops, I think the rest you have to figure out by yourself. Good luck in this new time of your lives. It will be a experience to remember throught all your life."
08/21/2012</p>
				<img src="img/allan-amorin-eua-foto-grande.jpg" /><br />
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