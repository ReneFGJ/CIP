<?php
require ("db.php");
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
		require($include.'sisdoc_security_pucpr.php');
		/* Valida Usuario */

		if ((strlen($dd[1]) > 0) and (strlen($dd[2]) > 0)) {
			require ("nusoap/nusoap.php");
			require ("_class/_class_authentic_user.php");
			$lg = new login;
			$rs = $lg -> authentic($dd[1], $dd[2]);

			if (count($rs) > 0) {
				/* Authenticar */
				$nw = new usuario;
				$cpf = $rs['cpf'];
				$email = $rs['emailLogin'];
				$nome = $rs['nome'];
				
				echo '<HR>';
				print_r($nw);
				echo '<HR>';
				print_r($rs);
				
				require ('_class/_class_docentes.php');
				$doc = new docentes;
				$doc -> le($nw -> user_cracha);
				$nw -> user_ss = $doc -> line['pp_ss'];
				//$nw -> LiberarUsuario();
				//redirecina('main.php');
			}
		}
		?>
		<div id="cabecalho" class="cabecalho">
			<img src="img/imagem_lampada_cabecalho.png" class="imagem-lampada" />
			<div id="imagem-logos">
				<img src="img/header-logos.png" />
			</div>
		</div>
		<table width="750" align="center">
			<TR>
				<TD>
				<div id="total">

					<div id="login">
						<form method="post" action="<?=page(); ?>">
							<p>
								Login
								<br />
								<input name="dd1" type="text" placeholder="login" class="formulario-entrada" />
								<br />
								<br />
								Senha
								<br />
								<input name="dd2" type="password" placeholder="******" class="formulario-entrada" />
								<br />
								<input type="submit" name="acao" class="estilo-botao" value="ENTRAR">
								<input type="hidden" name="dd10" value="<?=$dd[10]; ?>">
								<br />
								<?php echo $msg_erro; ?>
						</form>
					</div>

					<div id="definicao">

						<div id="texto-definicao">
							<p>
								<li>
									<h1>O que é o CIP?</h1>
								</li>
								<span class="corpo-texto-explicativo">O CIP é o Centro Integrado de Pesquisa da PUCPR. Aqui, coordenadores e pesquisadores podem acessar suas informações
									pessoais e de pesquisa para seu controle, geração de relatórios, entre outras atividades.</span>
							</p>
						</div>

						<div id="texto-definicao">
							<p>
								<li>
									<h1>Como funciona?</h1>
								</li>
								<span class="corpo-texto-explicativo">No CIP, você pode buscar as pesquisas existentes, gerar relatórios de pesquisa e pesquisadores, atualizar informações,
									visualizar indicadores.</span>
							</p>
						</div>

						<div id="texto-definicao">
							<p>
								<li>
									<h1>Contato CIP</h1>
								</li>
								<li>
									<span class="corpo-texto-explicativo"><B>Contato Iniciação Científica</B></span>
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
