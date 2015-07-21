<?
$breadcrumbs = array();
require ("cab_cnpq.php");
echo '
<script src="http://www2.pucpr.br/reol/js/highcharts.js"></script>
<script src="http://www2.pucpr.br/reol/js/modules/exporting.js"></script>
';
?>
<h1>SEMIC</h1>
<span class="corpo-texto-explicativo"> <h1>Tema do SEMIC 2015</h1>
	<BR>
	<table width="1024" class="tabela00 lt1" border=0 align="center" cellpadding="10">
		<tr valign="top">
			<td colspan=2><img src="img/semic_2015.png" width="100%"></td>
		<tr valign="top">
			<td><?php

			/* PIBIC */
			$dado = array('1993' => 20, '1994' => 23, '1995' => 27, '1996' => 35, '1997' => 35, '1998' => 37, '1999' => 49, '2000' => 58, '2001' => 64, '2002' => 106, '2003' => 224, '2004' => 220, '2005' => 172, '2006' => 166, '2007' => 184, '2008' => 231, '2009' => 265, '2010' => 466, '2011' => 515, '2013' => 892, '2014' => 974, '2015*' => 1114);
			$title = 'Hist�rico de trabalhos no SEMIC';
			$title2 = '1993-2015';
			$ybar = 'Total de trabalhos';
			$xbar = 'Ano';
			$div_name = 'semic';
			require ("view/apresentacao_semic_trabalhos.php");
			echo '<font class="lt0">* 2015 - Valor estimado de apresenta��es, os relat�rios est�o em submiss�o e avalia��o.';
			echo '<td width="60%" style="padding: 5px; font-family: Roboto, CICPG, Arial; font-size: 12px;">';
			?>
			Novidades no evento:
			<uL>
				<li>
					Sess�o internacional - apresenta��o oral e p�ster em Ingl�s, argui��o em ingl�s.
				</li>
				<li>
					Pesquisa � evoluir - exposi��o de prot�tipos de projeto de pesquisa com teor de inova��o para estudantes da gradua��o e P�s-Gradua��o.
				</li>
				<li>
					Concurso Jovens Ideias - exposi��o de prot�tipos de alunos empreendedores.
				</li>
				<li>
					Eventos Culturais: Ci�ncia, Arte e cultura.
				</li>
				<li>
					Evento tem�tico focado nas �reas estrat�gicas da PUCPR, em 2015 a �rea selecionada foi de Direitos Humanos.
				</li>
				<li>
					Avalia��o por iPad diretamente no evento desde 2013.
				</li>
			</uL>
			<BR>
			<BR>
			<BR>
			Premia��es:
			<ul>
				<li>
					Desde 2010 as premia��es s�o divuldadas no �ltimo dia do evento, na palestra de encerramento.
				</li>
				<li>
					At� 2012 a premia��o dos 10 melhores do PIBIC e 2 melhores trabalhos do PIBITI. Os estudantes premiados foram para o SBPC com todas as despesas pagas.
				</li>
				<li>
					A partir de 2013, a premia��o � a participa��o em congresso nacional (8 melhores do PIBIC e 2 melhores do PIBITI) e em congresso internacional os 2 melhores trabalhos da sess�o internacional.
				</li>
				<li>
					Em 2013, para o PIBICjr/PIBIC_EM a premia��o dos 2 melhores trabalhos foi um tablete Samsung em 2014 e 2 iPod da Apple.
				</li>
				<li>
					Em 2014 foram premiados com men��o honrosa os trabalhos nas modalidades P�ster e Oral, os trabalhos melhor avaliados por categorias foram premiados em dinheiro. Neste ano os estudantes da P�s-Gradua��o foram integrados com os da gradua��o, tanto na apresenta��o oral como p�ster.
				</li>
			</ul> Em 2014 a PUCPR sediou o 3� Congresso Sul Brasileiro de Inicia��o Cient�fica e P�s-Gradua��o, com representantes de Universidades do Paran�, Santa Catarina e Rio Grande do Sul. </td>
		</tr>
		<tr>
			<td colspan=2>
			<div id="colCenter">
				<h1>Semin�rio de Inicia��o Cient�fica - SEMIC</h1>
				<p>
					<strong>O Evento</strong>
					<br />
					O Semin�rio de Inicia��o Cient�fica (SEMIC) � realizado anualmente, com o objetivo de permitir aos bolsistas do PIBIC a apresenta��o dos resultados da pesquisa. O evento � de participa��o obrigat�ria por bolsistas e orientadores e � avaliado pelo CNPq. Simultaneamente ao Semin�rio, � realizada a Mostra de Pesquisa, com apresenta��o de trabalhos de pesquisa de estudantes de Inicia��o Cient�fica Volunt�ria e de estudantes de p�s-gradua��o.
				</p>
				<p></p>
				<p>
					<strong>Hist�rico SEMIC</strong>
				</p>
				<table width="100%" cellpadding="10">
				<tr align="center" valign="top">
				<td width="25%">
					<img src="../pibicpr/img/semic_2014.jpg" width="150"><br>
					<a title="CICPG" href="http://www2.pucpr.br/reol/eventos/cicpg/" target="_blank">Evento 2014 + CICPG (Congresso Sul Brasileiro de Inicia��o Cient�fica e P�s-Gradua��o)</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2013.jpg" width="150"><br>
					<a href="http://www2.pucpr.br/reol/semic2013/" target="_blank">Evento 2013</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2012.jpg" width="150"><br>
					<a title="XX SEMIC" href="http://www2.pucpr.br/reol/semic2012/">Evento 2012</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2011.jpg" width="150"><br>
					<a href="http://www2.pucpr.br/reol/index.php/SEMIC19?dd99=contact" target="_blank">Evento 2011</a>
				</td>
				<tr align="center" valign="top">
				<td width="25%">
					<img src="../pibicpr/img/semic_2010.jpg" width="150"><br>
					<a href="http://www2.pucpr.br/reol/index.php/semic18">Evento 2010</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2009.jpg" width="150"><br>
					<a href="http://www2.pucpr.br/reol/index.php/semic17" target="_blank">Evento 2009</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2008.jpg" width="150"><br>
					<a href="http://www2.pucpr.br/reol/index.php/PIBIC2008?dd99=" target="_blank">Evento 2008</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2007.jpg" width="150"><br>
					<a href="http://www2.pucpr.br/reol/index.php/PIBIC2007?dd99=" target="_blank">Evento 2007</a>
				</td>
				<tr align="center" valign="top">
				<td width="25%">
					<img src="../pibicpr/img/semic_2006.jpg" width="150"><br>
					<a href="http://www2.pucpr.br/reol/index.php/PIBIC2006" target="_blank">Evento 2006</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2005.jpg" width="150"><br>
					<a href="http://www.pucpr.br/pesquisa_cientifica/iniciacao_pibic/pibic/eventos/evento2005/index.html" target="_blank">Evento 2005</a>
				</td>
				<td width="25%">
					<img src="../pibicpr/img/semic_2004.jpg" width="150"><br>
					<a href="http://www.pucpr.br/pesquisa_cientifica/iniciacao_pibic/pibic/eventos/evento2004/index.html" target="_blank">Evento 2004</a>
				</td>
				</table>
			</td>
		</tr>
	</table> <?php
	require ("../foot.php");
	?>