<BR><BR><BR><hr size=1 width="50%"><BR><BR>
<center>
	<table class="tabela00 lt2" width="900" align="center" border=0 cellpadding="10">
		<tr><td>
		<img src="../img/logo_ic_pibiti.png">
		<tr valign="top">
			<td width="300" class="tabela01 border01" style="background-color: #FFFFFF;"><?php
			/* PIBITI */
			$dado = array('2011'=>51,'2012'=>81,'2013'=>95,'2014'=>107,'2015'=>140);
			$title = 'Histórico dos projetos finalizados';
			$title2 = 'Apresentação SEMIC - PIBITI';
			$ybar = 'Total de trabalhos';
			$xbar = 'Ano';
			$div_name = 'pibiti';
			require ("view/apresentacao_semic.php");

			/* PIBITI  model: pizza */
			$dado = array('CNPq' => 94, 'FA' => 145, 'PUCPR' => 350, 'ICV' => 465);
			$title = 'Bolsas PIBITI Implementadas - ' . date("Y");
			$title2 = '';
			$ybar = 'Distribuição';
			$div_name = 'pibiti_pie';
			require ("view/apresentacao_origem_bolsas.php");
			?></td>
			<td width="10" style="border-right: 1px solid #333333;"></td>
			<td><?php
			$dados = array();
			$dados['title'] = 'Dispêndio Anual com Bolsas';
			$dados['2010-2011'] = array(108000, 108000, 129600);
			$dados['2011-2012'] = array(108000, 108000, 129600);
			$dados['2012-2013'] = array(120000, 120000, 144000);
			$dados['2013-2014'] = array(120000, 120000, 211200);
			$dados['2014-2015'] = array(144000, 120000, 153600);
			$dados['2015-2016'] = array(144000, 120000, 153600);

			require ("view/tabela_dispendio_anual.php");

			$dados = array();
			$dados['title'] = 'Número de Alunos em Iniciação Tecnológica';
			$dados['2010-2011'] = array(14, 13, 30, 30);
			$dados['2011-2012'] = array(25, 25, 53, 30);
			$dados['2012-2013'] = array(25, 25, 25, 30);
			$dados['2013-2014'] = array(25, 25, 56, 27);
			$dados['2014-2015'] = array(30, 25, 61, 32);
			$dados['2015-2016'] = array(30, 25, 0, 38);
			$dados['obs'] = '2015-2016 - planos de trabalho com possibilidade de implementação';
			require ("view/tabela_alunos.php");

			$dados = array();
			$dados['title'] = 'Demanda Bruta e Atendida	';
			$dados[0] = array('Edital 2014', 200, 194, 6, 87);
			$dados[1] = array('Edital 2015', 190, 182, 8, 93);
			$dados['obs'] = 'até a promungação do edital atual não foi aberto edital da Fundação Araucária (FA)';
			require ("view/tabela_demanda.php");
			?></td>
		</tr>
	</table>
