<?php
require("db.php");
?>
<!DOCTYPE html>
<html>
    <head>
		<META HTTP-EQUIV=Refresh CONTENT="360; URL=login.php">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="description" content="">
		<link rel="stylesheet" href="<?=http; ?>css/style_cabecalho.css">
		<link rel="stylesheet" href="<?=http; ?>css/style_body.css">
		<link rel="stylesheet" href="<?=http; ?>css/style_fonts.css">
        
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
		<table width="750" align="center">
		<TR><TD>
		<div id="total">
		
			<div id="login">
				<form method="post" action="_login.php">
				<p>Login<br /><input name="dd1" type="text" placeholder="login" class="formulario-entrada" /><br />
				<br />Senha<br /><input name="dd2" type="password" placeholder="******" class="formulario-entrada" /><br />
				<input type="submit" name="acao" class="estilo-botao" value="ENTRAR">
				<input type="hidden" name="dd10" value="<?=$dd[10];?>">
				<br /><?php echo $msg_erro; ?>
				</form>
			</div>
			
			<div id="definicao">
				
				<div id="texto-definicao">	
					<p>
						<li><h1>O que � o CIP?</h1></li>
						<span class="corpo-texto-explicativo">O CIP � o Centro Integrado de Pesquisa da PUCPR. Aqui, coordenadores e pesquisadores podem acessar suas informa��es
						pessoais e de pesquisa para seu controle, gera��o de relat�rios, entre outras atividades.</span>
					</p>
				</div>		
					
				<div id="texto-definicao">	
					<p>
						<li><h1>Como funciona?</h1></li>
						<span class="corpo-texto-explicativo">No CIP, voc� pode buscar as pesquisas existentes, gerar relat�rios de pesquisa e pesquisadores, atualizar informa��es,
							visualizar indicadores.</span>
					</p>
				</div>
				
				<div id="texto-definicao">	
					<p>
						<li><h1>Contato CIP</h1></li>
						<li>
							<span class="corpo-texto-explicativo"><B>Contato Inicia��o Cient�fica</B></span>
						<span class="corpo-texto-explicativo">pibicpr@pucpr.br
							(041) 3271-1165 / 3271 - 2112</span>
													
						<li>
							<span class="corpo-texto-explicativo"><B>Contato Diretoria de Pesquisa</B></span>
						<span class="corpo-texto-explicativo">cip@pucpr.br
							(041) 3271-2582</span>

					</p>
				</div>
					
								
			</div>
			</table>
		</div>	
	</body>
</html>
