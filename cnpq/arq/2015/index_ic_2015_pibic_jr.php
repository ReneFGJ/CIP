<BR><BR><BR><hr size=1 width="50%"><BR><BR>
<center>
	<table class="tabela00 lt2" width="900" align="center" border=0 cellpadding="10">
		<tr><td>
		<img src="../img/logo_ic_pibic_em.png">
		<tr valign="top">
			<td width="300" class="tabela01 border01" style="background-color: #FFFFFF;"><?php
			/* PIBIC */
			$dado = array('2009' => 19,'2010' => 28, '2011' => 40, '2012' => 49, '2013*' => 9, '2014' => 74);
			$title = 'Histórico dos projetos finalizados';
			$title2 = 'Apresentação SEMIC - PIBIC';
			$ybar = 'Total de trabalhos';
			$xbar = 'Ano';
			$div_name = 'pibic_jr';
			require ("view/apresentacao_semic.php");
			echo '<font class="lt0">* Em 2013 as bolsas do CNPq foram prorrogadas, os alunos apresentaram no ano seguinte, com dois eventos no ano.</font>';

			/* PIBIC  model: pizza */
			$dado = array('CNPq' => 35, 'PUCPR' => 50);
			$title = 'Bolsas PIBIC Implementadas - ' . date("Y");
			$title2 = '';
			$ybar = 'Distribuição';
			$div_name = 'pibic_jr_pie';
			require ("view/apresentacao_origem_bolsas.php");
			?></td>
			<td width="10" style="border-right: 1px solid #333333;"></td>
			<td><?php
			$mul1 = 100 * 12; /* Valor da bolsa no ano em 12 meses */
			$mul2 = 150 * 12; /* Valor da bolsa no ano em 12 meses */
			$mul2 = 150 * 12; /* Valor da bolsa no ano em 12 meses */
			$mul3 = 50 * 12; /* Complemento */
			
			$dados = array();
			$dados['title'] = 'Dispêndio Anual com Bolsas';
			$dados['2010-2011'] = array(40 * $mul1,  40 * $mul1, 80 * $mul1);
			$dados['2011-2012'] = array(45 * $mul1,  0 * $mul1, 35 * $mul1);
			$dados['2012-2013'] = array(45 * $mul2,  0 * $mul3, 35 * $mul2);
			$dados['2013-2014'] = array(30 * $mul2,  0 * $mul2, 35 * $mul2);
			$dados['2014-2015'] = array(50 * $mul2 + 35 * $mul3,  16 * $mul2, 35 * $mul2);
			$dados['2015-2016'] = array(50 * $mul2 + 35 * $mul3,  0 * $mul2, 35 * $mul2);
			
			$dados['obs'] = 'As bolsas do CNPq são complementadas em R$ 50,00 pela PUCPR nos anos de 2014 e 2015 para equiparação com as bolsas da Fundação Araucária.';
			$dados['header'] = array('Vigências das bolsas','PUCPR','Fundação Araucária (FA)','CNPq*','Total');
			require ("view/tabela_dispendio_anual.php");
			
			$dados = array();
			$dados['title'] = 'Demanda Bruta e Atendida	';
			$dados[1] = array('Edital 2015', 53, 50, 3, 50);
			$dados['obs'] = '';
			require ("view/tabela_demanda.php");

			?></td>
		</tr>
	</table>
