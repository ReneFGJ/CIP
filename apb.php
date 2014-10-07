<?php
require("db.php");
?>
<!DOCTYPE html>
<html>
    <head>
		<META HTTP-EQUIV=Refresh CONTENT="360; URL=login.php">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="description" content="">
        <link rel="stylesheet" href="css/estilo.css">
    	<title>CIP - Centro Integrado de Pesquisa | PUCPR</title>
	</head>
	<body>
<?php 
	require("cab_institucional.php");
	
	/* Valida Usuario */
	require($include.'sisdoc_security_pucpr.php');
	require("_login_script.php"); 
?>		
		<div id="cabecalho" class="cabecalho">
			<img src="img/imagem_lampada_cabecalho.png" class="imagem-lampada" />
			<div id="imagem-logos">
					<img src="img/header-logos.png" />
			</div>
		</div>
		
		<div id="total">
<?
//require($include.'sisdoc_windows.php');
//require('_class/_class_language.php');
require($include.'sisdoc_email.php');
require("_class/_class_docentes.php");
$doc = new docentes;
require($include.'sisdoc_colunas.php');

$uss = new usuario;
$us = trim($dd[0]);
$chk2 = substr(checkpost($us),2,2);
$chk = substr($dd[90],0,2);


if ($chk2==$chk)
	{	
	$ok = $uss->usuario_existe($us);
	if ($ok == 0)
		{
			$uss->le_professor($us);
			$uss->LiberarUsuario();
			if ($dd[99]=='main')
				{ redirecina(http."main.php"); exit; }
				
			redirecina("atividades.php");
			redirecina('_login.php?dd10='.$doc->pp_cracha);
		} else {
			$uss->le($ok);
			$uss->LiberarUsuario();
			
			if ($dd[99]=='main')
				{ redirecina(http."main.php"); exit; }
			redirecina("atividades.php");
		}
	} else {
		echo '<H2>Problemas na validação do link de acesso';
		echo '<BR><BR>';
		echo 'Acesso pelo login de rede</H2>';
		echo '<form action="'.http.'login.php">
				<input type="submit" value="avançar >>>" class="botao-enviar">
				</form>';
		$link = http.'apb.php?dd0='.$dd[0];
		$link .= '&dd90='.$dd[90];
		$link .= '&dd91='.$dd[91];
	
		enviaremail('renefgj@gmail.com','','Erro de acesso',$link);
	}

?>
