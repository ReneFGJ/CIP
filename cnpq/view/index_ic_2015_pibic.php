<BR><BR><BR><hr size=1 width="50%"><BR><BR>
<center>
	<table class="tabela00 lt2" width="900" align="center" border=0 cellpadding="10">
		<tr><td>
		<img src="../img/logo_ic_pibic.png">
		<tr valign="top">
			<td width="300" class="tabela01 border01" style="background-color: #FFFFFF;"><?php
			/* PIBIC */
			$dado = array('2010' => 359, '2011' => 418, '2012' => 596, '2013' => 850, '2014' => 955, '2015' => 1058);
			$title = 'Hist�rico dos projetos finalizados';
			$title2 = 'Apresenta��o SEMIC - PIBIC';
			$ybar = 'Total de trabalhos';
			$xbar = 'Ano';
			$div_name = 'pibic';
			require ("view/apresentacao_semic.php");

			/* PIBIC  model: pizza */
			$dado = array('CNPq' => 94, 'FA' => 145, 'PUCPR' => 350, 'ICV' => 465);
			$title = 'Bolsas PIBIC Implementadas - ' . date("Y");
			$title2 = '';
			$ybar = 'Distribui��o';
			$div_name = 'pibic_pie';
			require ("view/apresentacao_origem_bolsas.php");
			?></td>
			<td width="10" style="border-right: 1px solid #333333;"></td>
			<td><?php
			$dados = array();
			$dados['title'] = 'Disp�ndio Anual com Bolsas';
			$dados['2010-2011'] = array(1296000, 253600, 378000);
			$dados['2011-2012'] = array(1296000, 546000, 399000);
			$dados['2012-2013'] = array(1482000, 936000, 451200);
			$dados['2013-2014'] = array(1560000, 696000, 451200);
			$dados['2014-2015'] = array(1680000, 696000, 417600);
			$dados['2015-2016'] = array(1680000, 696000, 417600);

			require ("view/tabela_dispendio_anual.php");

			$dados = array();
			$dados['title'] = 'N�mero de Alunos em Inicia��o Cient�fica';
			$dados['2010-2011'] = array(160, 200, 58, 90);
			$dados['2011-2012'] = array(225, 206, 130, 95);
			$dados['2012-2013'] = array(325, 370, 195, 94);
			$dados['2013-2014'] = array(325, 448, 145, 94);
			$dados['2014-2015'] = array(350, 465, 145, 94);
			$dados['2015-2016'] = array(350, 524, 0, 94);
			$dados['obs'] = '2015-2016 - planos de trabalho com possibilidade de implementa��o';
			require ("view/tabela_alunos.php");

			$dados = array();
			$dados['title'] = 'Demanda Bruta e Atendida	';
			$dados[0] = array('Edital 2014', 1300, 1238, 62, 582);
			$dados[1] = array('Edital 2015', 1244, 1165, 79, 437);
			$dados['obs'] = 'at� a promunga��o do edital atual n�o foi aberto edital da Funda��o Arauc�ria (FA)';
			require ("view/tabela_demanda.php");
			?></td>
		</tr>
	</table>
