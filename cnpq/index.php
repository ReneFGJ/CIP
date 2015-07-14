<?
$breadcrumbs = array();
require ("cab_cnpq.php");

require ($include . "sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

/////////////////////////////////////////////////// MANAGERS

echo '<h1>Inciação Científica (IC) da PUCPR</h1>';
$menu = array();
//array_push($menu,array('Iniciação Científica','Panorama da Pesquisa na PUCPR','cnpq_panorama_2015.php'));
array_push($menu, array('Iniciação Científica', 'Experiência Institucional na IC', 'cnpq_experiencia_institucional_ic_2015.php'));
array_push($menu, array('Iniciação Científica', 'Experiência Institucional na IC Júnior', 'cnpq_experiencia_institucional_ic_jr_2015.php'));
array_push($menu, array('Iniciação Científica', 'Relato do processo de seleção', 'cnpq_relato_do_processo_de_selecao_2015.php'));
array_push($menu, array('Iniciação Científica', 'Membros do Comitê Gestor', 'cnpq_membros_do_comite_gestor_2015.php'));
array_push($menu, array('Iniciação Científica', 'Seminário de Iniciação Científica (SEMIC)', 'cnpq_semic_2015.php'));
array_push($menu, array('Iniciação Científica', 'Novos programas IC', 'cnpq_mobilidade_2015.php'));
array_push($menu, array('Iniciação Científica', 'Edital IC 003/2015', 'arq/2015/cadernos_de_normas_2015.pdf'));

//array_push($menu, array('Anos Anteriores', 'Dados referente ao edital 2014', 'index_2014.php'));
//array_push($menu, array('Anos Anteriores', 'Dados referente ao edital 2013', 'index_2013.php'));

//Validacao de perfil de test
if ($perfil -> valid('#TST')) {
	array_push($menu, array('Teste grafico', 'pizza', 'view/apresentacao_origem_bolsas.php'));
	array_push($menu, array('Teste grafico', 'barras', 'view/apresentacao_semic.php'));
}

//array_push($menu,array('Edital de Iniciação Ciêntífica e Tecnológica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2015'));

array_push($menu, array('Programas', '<font color="BLUE" class="lt3"><B>PIBIC</B></font></a><br>Programa de Inciação Científica<br>', 'index_ic.php?dd0=PIBIC'));
array_push($menu, array('Programas', '<font color="BROWN" class="lt3"><B>PIBITI</B></font></a><br> Programa de Iniciação Tecnológica e Inovação<br>', 'index_ic.php?dd0=PIBITI'));
array_push($menu, array('Programas', '<font color="ORANGE" class="lt3"><B>PIBIC_EM (Jr)</B></font></a><br>Programa de Iniciação Ciêntifica de Ensino Médio<br>', 'index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC Jr</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="GREEN"><B>Ciência sem Fronteiras</B></font>','index_ic.php?dd0=CSF'));
?>
<table width="900" align="center">
	<tr valign="top">
		<td width="300" class="lt2"><img src="../img/img_bem_vindo.png" width="200">
		<div style="width: 300px">
		<br><br>
		Prezado avaliador CNPq,<br><br>
		Bem vindo ao processo de homologação do Edital 2015 PIBIC/PIBITI com vigência em 2015 e 2016.<br><br>
		Organizamos ao lado um menu onde poderá ter acesso a diversas informações sobre o processo de submissão, avaliação e resultado final, bem como informações sobre a pesquisa na PUCPR. <br><br>
		Em caso de dúvida não hesite em entrar em contato pelo e-mail <A href="mailto:cleybe.vieira@pucpr.br">cleybe.vieira@pucpr.br</A> ou diretamente com nossa equipe de Iniciação Científica pelos telefones (41) 3271-2112, 3271-1165 de segunda a sexta-feira das 08h00 as 18h00. <br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		
		</div>
		</td>
		<td style="border-right: 1px solid #333333;"></td>
		<td><?php echo menus($menu, "3"); ?></td>
	</tr>
</table>
<?
require ("../foot.php");
?>