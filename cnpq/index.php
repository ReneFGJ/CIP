<?
$breadcrumbs = array();
require ("cab_cnpq.php");

require ($include . "sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menua = array();
array_push($menua,array('Sobre o Semin�rio o XXIII SEMIC','Panorama do evento','semic_about.php'));
array_push($menua,array('Sobre o Semin�rio o XXIII SEMIC','Premia��es do SEMIC','semic_premiacao.php'));
array_push($menua,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','semic_ic.php?dd0=PIBIC'));
array_push($menua,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','semic_ic.php?dd0=PIBITI'));
array_push($menua,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','semic_ic.php?dd0=PIBICE'));


/////////////////////////////////////////////////// MANAGERS

echo '<h1>Incia��o Cient�fica (IC) da PUCPR</h1>';
$menu = array();
//array_push($menu,array('Inicia��o Cient�fica','Panorama da Pesquisa na PUCPR','cnpq_panorama_2015.php'));
array_push($menu, array('Inicia��o Cient�fica', 'Experi�ncia Institucional na IC', 'cnpq_experiencia_institucional_ic_2015.php'));
array_push($menu, array('Inicia��o Cient�fica', 'Experi�ncia Institucional na IC J�nior', 'cnpq_experiencia_institucional_ic_jr_2015.php'));
array_push($menu, array('Inicia��o Cient�fica', 'Relato do processo de sele��o', 'cnpq_relato_do_processo_de_selecao_2015.php'));
array_push($menu, array('Inicia��o Cient�fica', 'Membros do Comit� Gestor', 'cnpq_membros_do_comite_gestor_2015.php'));
array_push($menu, array('Inicia��o Cient�fica', 'Semin�rio de Inicia��o Cient�fica (SEMIC)', 'cnpq_semic_2015.php'));
array_push($menu, array('Inicia��o Cient�fica', 'Novos programas IC', 'cnpq_mobilidade_2015.php'));
array_push($menu, array('Inicia��o Cient�fica', 'Edital IC 003/2015', 'arq/2015/cadernos_de_normas_2015.pdf'));

//array_push($menu, array('Anos Anteriores', 'Dados referente ao edital 2014', 'index_2014.php'));
//array_push($menu, array('Anos Anteriores', 'Dados referente ao edital 2013', 'index_2013.php'));


//array_push($menu,array('Edital de Inicia��o Ci�nt�fica e Tecnol�gica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2015'));

array_push($menu, array('Programas', '<font color="BLUE" class="lt3"><B>PIBIC</B></font></a><br>Programa de Incia��o Cient�fica<br>', 'index_ic.php?dd0=PIBIC'));
array_push($menu, array('Programas', '<font color="BROWN" class="lt3"><B>PIBITI</B></font></a><br> Programa de Inicia��o Tecnol�gica e Inova��o<br>', 'index_ic.php?dd0=PIBITI'));
array_push($menu, array('Programas', '<font color="ORANGE" class="lt3"><B>PIBIC_EM (Jr)</B></font></a><br>Programa de Inicia��o Ci�ntifica de Ensino M�dio<br>', 'index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC Jr</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="GREEN"><B>Ci�ncia sem Fronteiras</B></font>','index_ic.php?dd0=CSF'));
?>
<table width="900" align="center">
	<tr valign="top">
		<td width="300" class="lt2"><img src="../img/img_bem_vindo.png" width="200">
		<div style="width: 300px">
		<br><br>
		Prezado avaliador CNPq,<br><br>
		Bem vindo ao processo de avalia��o do SEMIC do Edital 2014/2015 PIBIC/PIBITI.<br><br>
		Organizamos ao lado um menu onde poder� ter acesso a diversas informa��es sobre o processo de submiss�o, avalia��o e resultado final, bem como informa��es sobre a pesquisa na PUCPR. <br><br>
		Em caso de d�vida n�o hesite em entrar em contato pelo e-mail <A href="mailto:cleybe.vieira@pucpr.br">cleybe.vieira@pucpr.br</A> ou diretamente com nossa equipe de Inicia��o Cient�fica pelos telefones (41) 3271-2112, 3271-1165 de segunda a sexta-feira das 08h00 as 18h00. <br><br>
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
		<td>
			<h3>Sobre o XXIII SEMIC</h3>
			<?php echo menus($menua, "3"); ?>
			<h3>Incia��o Cient�fica (IC) da PUCPR</h3>
			<?php echo menus($menu, "3"); ?>
		</td>
	</tr>
</table>
<?
require ("../foot.php");
?>