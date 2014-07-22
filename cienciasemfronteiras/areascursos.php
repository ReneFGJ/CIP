<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Áreas Prioritárias - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				 <h1>Áreas priorit<span class="lt6light">árias</span></h1>
				 	<p>Para inscrever-se no programa Ciência sem Fronteiras, você precisa ser aluno matriculado em um curso que pertença
				 		primeiramente à uma das áreas prioritárias definidas pelo Governo, e também precisa que seu curso esteja cadastrado
				 		no sistema do MEC.</p>
				 
				 <h2>Quais são?</h2>
					<p>O Governo definiu algumas áreas de estudo como "prioritárias". Isso quer dizer que apenas alunos
						com cursos pertencentes à estas áreas poderão de inscrever. Recentemente houveram protestos contra esta
						decisão por parte dos alunos, pois infelizmente não são todos os cursos que podem. Mas o governo
						entrou com uma ação na justiça afirmando que eles <strong>não aceitarão</strong> incrições de cursos
						fora das seguintes áreas:</p>

						<strong><p>- Engenharias e demais áreas tecnológicas;<br />
						- Ciências Exatas e da Terra;<br />
						- Biologia, Ciências Biomédicas e da Saúde;<br />
						- Computação e Tecnologias da Informação;<br />
						- Tecnologia Aeroespacial;<br />
						- Fármacos;<br />
						- Produção Agrícola Sustentável;<br />
						- Petróleo, Gás e Carvão Mineral;<br />
						- Energias Renováveis;<br />
						- Tecnologia Mineral;<br />
						- Biotecnologia;<br />
						- Nanotecnologia e Novos Materiais;<br />
						- Tecnologias de Prevenção e Mitigação de Desastres Naturais;<br />
						- Biodiversidade e Bioprospecção;<br />
						- Ciências do Mar;<br />
						- Indústria Criativa (voltada a produtos e processos para desenvolvimento tecnológico e inovação);<br />
						- Novas Tecnologias de Engenharia Construtiva;<br />
						- Formação de Tecnólogos.</p></strong>
				 
								
				<h2>Áreas Prioritárias dos alunos que já estão viajando:</h2>
			
			<img src="img/grafico-areas.jpg" />
			
			<div id="links-relacionados">
					<h3>Links relacionados:</h3>
					<li><a href="testedeproficiencia.php">Entenda como funcionam os Testes de Proficiência</a></li>
					<li><a href="beneficios.php">Quais são os benefícios no Ciência sem Fronteiras?</a></li>
			</div>
			
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>