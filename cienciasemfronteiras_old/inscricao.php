<?php
$include = '../';
require("../db.php");
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

/**
* Submissao de projeto parametrizado
* @author Rene F. Gabriel Junior <rene@sisdoc.com.br>
* @version 1.0m
* @copyright Copyright - 2012, Rene F. Gabriel Junior.
* @access public
* @package CEP
* @subpackage submit
*/
$login = 1;

require('../_class/_class_discentes.php');
$dis = new discentes;

/*
 * Inscricoes
 */
 
if (strlen($dd[1]) > 1)
	{
		$cod = trim(sonumero($dd[1]));
		if (strlen($cod) > 8)
			{
				$cod = substr($cod,3,8);
			}
		if (strlen($cod) != 8)
			{
				$erro = 'Código do discente inválido '.$cod;
			} else {
				if ($dis->consulta($cod))
					{
						$dis->le('',$cod);
						$dis->valida_set();
						redirecina('inscricoes_2.php');						
					} else {
						$erro = 'Código não localizado';
					}
			}
	}

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Inscrição - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Inscr<span class="lt6light">ição</span></h1>
				  <p>Você tem duas opções para se inscrever:</p>
				  
				  <div id="inscricao-campo">
				  	<!--
				  	<div id="inscricao-interessado">
				  		<p class="texto-caixa-interesse">Nesta opção você está se <strong>cadastrando como interessado</strong>. Utilize o número da sua carteirinha da PUCPR:</p>
				  			<input type="text" class="input-dark" placeholder="000000000-0"></input><br />
				  			<button class="botao-grande">Estou apenas interessado</button>
				  	</div>
				  	-->
				  	<form method="post">
				  	<div id="inscricao-edital">
				  		<p class="texto-caixa-inscricao-edital">Aqui você está realmente se <strong>inscrevendo para algum dos editais</strong> do Ciência
				  			sem Fronteiras. Utilize o número da sua carteirinha da PUCPR:</p>
				  			<input type="text" name="dd1" class="input-light" placeholder="000000000"></input><br />
				  			<input type="submit" class="botao-grande" style="height: 50px;" name="acao" value="Quero me inscrever">
				  	</div>
				  	</form>
				  	
				  </div>
				 	
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>