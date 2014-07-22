<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Processo de Inscrição - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Quero m<span class="lt6light">e inscrever</span></h1>
				 	<p>Confira seus dados e responda às perguntas para se inscrever na PUCPR para o programa Ciência sem Fronteiras.</p>
				 	
				 	<div id="coluna-dados-aluno">
				 		
				 		<div id="dados-puxado-alunos">
				 			
				 			<table class="tabela-dados-pessoais">
				 				
				 				<tr class="lt3">
				 					<td><strong>Nome</strong>
				 						<br />Juliana Souza
				 					</td>
				 					<td><strong>Número da Carteirinha</strong>
				 						<br />99229292929
				 					</td>
				 				</tr>
				 				<tr class="lt3">
				 					<td><strong>Email 1</strong>
				 						<br />juliana.souza@pucpr.br
				 					</td>
				 					<td><strong>Email 2</strong>
				 						<br />ju.souza@hotmail.com
				 					</td>
				 				</tr>
				 				<tr class="lt3">
				 					<td><strong>Currículo Lattes</strong>
				 						<br />Link lattes
				 					</td>
				 				</tr>
				 			</table>
				 		</div>
				 		
				 		<div id="problemas-dados-siga">
				 			<p class="lt2">* Se eventualmente algum destes seus dados estiver incorreto, contate o SIGA para que possa ser feita qualquer alteração.
Telefone: (41) 3271-1555 </p>
				 		</div>
				 		
				 	</div> <!-- fecha div dados alunos -->
				 	
				 	<br />
				 	<br />
				 	<p><strong>1. Para qual Edital você está se candidatanto?</strong><br /><br />
				 	<input type="radio" />Reino Unido - 2012/2013 (Chamada 123/13)<br />
				 	<input type="radio" />Japão - 2012/2013 (Chamada 123/13)<br />
				 	<input type="radio" />Noruega - 2012/2013 (Chamada 123/13)<br />
				 	<input type="radio" />China - 2012/2013 (Chamada 123/13)<br /></p>
				 	
				 	<br />
				 	<p><strong>2. Você possui passaporte?</strong><br />
				 	<select>
				 		<option value="passaportesim">Sim</option>
						  <option value="passaportenao">Não</option>
						  <option value="passaporteemandamento">Em andamento</option>
				 	</select></p>
				 	<br />
				 	
				 	<p><strong>3. Qual período você está cursando?</strong><br />
				 	<select>
				 		  <option value="1periodo">1º período</option>
						  <option value="2periodo">2º período</option>
						  <option value="3periodo">3º período</option>
						  <option value="4periodo">4º período</option>
						  <option value="5periodo">5º período</option>
						  <option value="6periodo">6º período</option>
						  <option value="7periodo">7º período</option>
						  <option value="8periodo">8º período</option>
						  <option value="9periodo">9º período</option>
				 	</select></p>
				 	<br />
				 	
				 	
				 	<p><strong>4. Você possui algum dos certificados de proficiência em língua estrangeira citado abaixo?</strong>
				 	<br /><span class="lt2">Fique atento à qual destes testes de proficiência é solicitado no edital do país que você escolheu.</span>
				 	<br />
				 	<select>
				 		  <option value="toefl">TOEFL</option>
						  <option value="ielts">IELTS</option>
						  <option value="dele">DELE</option>
						  <option value="delf">DELF</option>
						  <option value="toeic">TOEIC</option>
						  
				 	</select></p>
				 	<br />
				 	
				 	<p><strong>5. Caso possua o certificado, qual foi a sua nota?</strong><br />
				 	<span class="lt2">Se não houver, responda com 0.</span><br />
				 	<input type="text" /></p>
				 	<br />
				 	
				 	<p><strong>6. Você possui algum destes auxílios para cursar sua graduação?</strong><br />
				 	<select>
				 		  <option value="prouni">PROUNI</option>
						  <option value="fies">FIES</option>
						  <option value="bolsapuc">Bolsa PUC</option>
						  
				 	</select></p>
				 
				 	<br />
				 	<button class="botao-super">Finalizar minha inscrição</button>
				 	
			</div> <!-- fecha div corpo -->
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>