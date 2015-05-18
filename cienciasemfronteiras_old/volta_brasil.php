<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>
<!DOCTYPE html>
<html>
    <head>
    	<title>Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="<?php echo $name;?>" content="<?php echo $content;?>">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">

				
				
				<img src="img/banner-volta-brasil_maior.jpg"/>
				<h1 style="margin-top:-50px;"><span class="lt6light">Para retornar ao</span> Brasil</h1>
					<p>
						Prezado Bolsista
	 				</p>
	 				<p>
						Você nem acredita que já se passou o período do seu intercâmbio e já é momento de retornar ao Brasil, à Curitiba e à PUCPR.
						 
						Seguem algumas orientações importantes nesta etapa :
						<br>
					 <br>
					 <span class="lt8">1.</span> <span class="lt4"> O bolsista do CsF só deve retornar após o término total do semestre letivo, inclusive exames finais, se for o caso. Se esse prazo for além do período de vigência da bolsa, precisamos conversar, entre em contato conosco urgente.</span>
						
					 <br><br>
						<span class="lt8">2.</span> <span class="lt4"> Você deve solicitar na Universidade estrangeira: o histórico escolar, ementa e conteúdo das disciplinas cursadas. Esses documentos serão necessários para seu processo de validação de disciplina aqui na PUCPR</span>
					 <br><br>
						 <span class="lt8">3.</span> <span class="lt4"> Você deve comunicar ao CNPq/CAPES a data de seu retorno e solicitar o valor da passagem de volta.</span>
					 <br><br>
						<span class="lt8">4.</span> <span class="lt4"> Após o término da vigência da sua bolsa, você tem 30 dias para retornar ao Brasil. Qualquer período além dessa data, deve ser solicitada autorização ao CNPq/CAPES.</span>
					 <br><br>
						<span class="lt8">5.</span> <span class="lt4"> Avise-nos a data prevista de seu retorno, para realizarmos o pedido de reabertura da sua matrícula.</span>
					 <br>
					</p>
					<p>
						Estamos esperando por você e queremos partilhar suas experiências! Qualquer dúvida adicional, não hesite em nos contatuar.
					 	</p><p>
						Bom retorno.</p>
				<br><br>
				
				
				<div id="links-relacionados">
					<h3>Links relacionados:</h3>
					<li><a href="quemjaviajou.php">Descubra quem já viajou!</a></li>
					<li><a href="dequaiscursos.php">De quais cursos são os alunos que já foram selecionados?</a></li>
				</div>
				
				
				
				</div><!--fecha div total-->
				
				
				
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>