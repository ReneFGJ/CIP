<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Cadastrar - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				 <h1>Cadastr<span class="lt6light">ar como interessado</span></h1>
				 	<p>Confira seus dados abaixo e clique em confirmar para cadastrar-se como interessado:</p>
				 	
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
				 	
				 	<p>Em qual país você está interessado?</p>
				 	<select>
				 		<option>Alemanha</option>
				 		<option>Áustria</option>
				 		<option>Austrália</option>
				 		<option>Bélgica</option>
				 		<option>Canadá</option>
				 		<option>China</option>
				 		<option>Coreia do Sul</option>
				 		<option>Dinamarca</option>
				 		<option>Estados Unidos</option>
				 		<option>Espanha</option>
				 		<option>Finlândia</option>
				 		<option>França</option>
				 		<option>Holanda</option>
				 		<option>Hungria</option>
				 		<option>Índia</option>
				 		<option>Irlanda</option>
				 		<option>Itália</option>
				 		<option>Japão</option>
				 		<option>Noruega</option>
				 		<option>Portugal</option>
				 		<option>Reino Unido</option>
				 		<option>República Tcheca</option>
				 		<option>Ucrânia</option>
				 	</select>
				 	<br />
				 	<br />
				 	
				 	<button class="botao-super">Confirmar</button>
			
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>