<BR><BR><BR><hr size=1 width="50%"><BR><BR>
<center>
	<table class="tabela00 lt2" width="900" align="center" border=0 cellpadding="10">
		<tr><td>
		<img src="../img/logo_ic_pibic.png">
		<tr valign="top">
			<td width="300" class="tabela01 border01" style="background-color: #FFFFFF;"><?php
			/* PIBIC */
			$dado = array('2010' => 359, '2011' => 418, '2012' => 596, '2013' => 850, '2014' => 955, '2015' => 1058);
			$title = 'Histórico dos projetos finalizados';
			$title2 = 'Apresentação SEMIC - PIBIC';
			$ybar = 'Total de trabalhos';
			$xbar = 'Ano';
			$div_name = 'pibic';
			require ("view/apresentacao_semic.php");

			/* PIBIC  model: pizza */
			$dado = array('CNPq' => 94, 'FA' => 145, 'PUCPR' => 350, 'ICV' => 465);
			$title = 'Bolsas PIBIC Implementadas - ' . date("Y");
			$title2 = '';
			$ybar = 'Distribuição';
			$div_name = 'pibic_pie';
			require ("view/apresentacao_origem_bolsas.php");
			?></td>
			<td width="10" style="border-right: 1px solid #333333;"></td>
			<td><?php
			$mul1 = 360 * 12; /* Valor da bolsa no ano em 12 meses */
			$mul2 = 400 * 12; /* Valor da bolsa no ano em 12 meses */
			
			$dados = array();
			$dados['title'] = 'Dispêndio Anual com Bolsas';
			$dados['2010-2011'] = array(1296000, 253600, 378000);
			$dados['2011-2012'] = array(1296000, 546000, 399000);
			$dados['2012-2013'] = array(1482000, 936000, 451200);
			$dados['2013-2014'] = array(1560000, 696000, 451200);
			$dados['2014-2015'] = array(1680000, 696000, 417600);
			$dados['2015-2016'] = array(1680000, 0, 417600);
			$dados['2010-2011'] = array(160 * $mul1, 58 * $mul1, 90 * $mul1);
			$dados['2011-2012'] = array(225 * $mul1,  130 * $mul1, 95 * $mul1);
			$dados['2012-2013'] = array(325 * $mul2,  195 * $mul2, 94 * $mul2);
			$dados['2013-2014'] = array(325 * $mul2,  145 * $mul2, 94 * $mul2);
			$dados['2014-2015'] = array(350 * $mul2,  145 * $mul2, 94 * $mul2);
			$dados['2015-2016'] = array(350 * $mul2,  0 * $mul2, 94 * $mul2);
			
			$dados['obs'] = 'até a promungação do edital atual não foi aberto edital da Fundação Araucária (FA)';
			$dados['header'] = array('Vigências das bolsas','PUCPR','Fundação Araucária (FA)','CNPq','Total');
			require ("view/tabela_dispendio_anual.php");

			$dados = array();
			$dados['title'] = 'Número de Alunos em Iniciação Científica';
			$dados['2010-2011'] = array(160, 200, 58, 90);
			$dados['2011-2012'] = array(225, 206, 130, 95);
			$dados['2012-2013'] = array(325, 370, 195, 94);
			$dados['2013-2014'] = array(325, 448, 145, 94);
			$dados['2014-2015'] = array(350, 465, 145, 94);
			$dados['2015-2016'] = array(350, 524, 0, 94);
			$dados['obs'] = '2015-2016 - planos de trabalho com possibilidade de implementação';
			$dados['header'] = array('Vigências das bolsas','PUCPR','Voluntários','Fundação Araucária','CNPq','Total');
			require ("view/tabela_alunos.php");

			$dados = array();
			$dados['title'] = 'Demanda Bruta e Atendida	';
			$dados[0] = array('Edital 2014', 1300, 1238, 62, 582);
			$dados[1] = array('Edital 2015', 1244, 1165, 79, 437);
			$dados['obs'] = 'até a promungação do edital atual não foi aberto edital da Fundação Araucária (FA)';
			require ("view/tabela_demanda.php");
			?></td>
		</tr>
	</table>
