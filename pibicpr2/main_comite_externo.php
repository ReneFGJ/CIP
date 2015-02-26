<?php
$pibic = 1;
$pibiti = 1;
$pibic_em = 1;
$cr = chr(13).chr(10);
if (trim($user_log) == 'cnpq_em') { $pibic = 0; $pibiti = 0; $pibic_em = 1; }

echo '<div id="comite_externo">';

echo '<table cellpadding="4" cellspacing="0" border="0" class="lt1" width="100%">';

echo '<TR>';
echo '<TD colspan=5>';

		echo '<style>'.$cr;
		echo ' #pibic_cm { background-color:#f0f0fe; width: 100%; }';
		echo ' #pibic_cm a { color: #0000FF; }';
		echo '</style>'.$cr;
		echo '<div id="pibic_cm">'.$cr;

echo '
		<center><b><font class="lt3">Iniciação Científica na PUCPR</font></b></center>
		<ul>
		<li><a href="/reol/public/20/archive/PUCPR_PANORAMA_DA_PESQUISA_NA_PUCPR_2012.pdf" target="m1">Panorama da Pesquisa na PUCPR</a>  
		<li><a href="/reol/public/20/archive/PUCPR_EXPERIENCIA_INSTITUCIONAL_IC_2012.pdf" target="m2">Experiência Institucional na Iniciação Científica</a>  
		<li><a href="/reol/public/20/archive/PUCPR_EXPERIENCIA_INSTITUCIONAL_NA_INICIACAO_CIENTIFICA_JUNIOR_2012.pdf" target="m3">Experiência Institucional na Iniciação Científica Júnior</a>
		<li><a href="/reol/public/20/archive/PUCPR_relato_do_processo_de_selecao_2012.pdf" target="m4">Relato do processo de seleção</a>		    
		<li><a href="/reol/public/20/archive/PUCPR_MEMBROS_DO_COMITE_GESTOR.pdf" target="m9">Membros do Comitê Gestor</a>
		<li><a href="/reol/public/20/archive/PUCPR_EDITAL_2012_01.pdf" target="m9">Edital IC 001/2012</a> 
		</UL>
		<BR><BR>
';
echo '</div>';

		echo '<script>'.$cr;
		echo '	$("#pibic_cm").corner()'.$cr;
		echo '</script>'.$cr;

echo '<TR class="lt5" valign="top">';
if ($pibic == 1) { echo '<TH width="33%">PIBIC'; }
if ($pibiti == 1) { echo '<TH width="33%">PIBITI'; }
if ($pibic_em == 1) { echo '<TH width="33%"><font color="blue">PIBIC_</font><font color="yellow">EM</font></h2></B>'; }

echo '<TR valign="top">';	  

if ($pibic == 1)
	{
		echo '<TD>';
		echo '<style>'.$cr;
		echo ' #pibic { background-color:#f0f0fe; width: 100%; }';
		echo ' #pibic a { color: #0000FF; }';
		echo '</style>'.$cr;
		echo '<div id="pibic">';
		?>
		<br><center><b>Formulários</b></center>
		<ul>    
		<li><a href="/reol/public/20/archive/PUCPR_PIBIC_PROJETO_MODELO.pdf" target="m7">Modelo do Projeto de Pesquisa</a> 
		<li><a href="/reol/public/20/archive/PUCPR_PIBIC_PLANO_MODELO.pdf" target="m7">Modelo do Plano de trabalho do aluno</a> 
		<li><a href="/reol/public/20/archive/PUCPR_CADERNO_DE_NORMAS.pdf" target="m8">Caderno de Normas IC</a> 
		<li><a href="/reol/public/20/archive/FICHA_DO_AVALIADOR_PIBIC.pdf" target="m8">Ficha do Avaliador PIBIC</a> 
			
		<BR>
		<br><b>Edital de aprovação</b>
		<br>
		<li><A HREF="edital.php?dd0=C&dd1=PIBIC&dd2=2012">Aprovados com bolsa CNPq</A>
		<li><A HREF="edital.php?dd0=&dd1=PIBIC&dd2=2012">Aprovados em todas as modalidades</A>
		<li><A HREF="edital.php?dd0=D&dd1=PIBIC&dd2=2012">Projetos não aprovados</A>
		<li><A HREF="edital_panorama.php?dd0=H&dd1=PIBIC&dd2=2012">Panorama dos projetos PIBIC</A>
		<BR>
		<br><b>Avaliação CNPq</b>
		<br>
		<li><A HREF="#">Link de acesso ao processo de avaliação CNPq <font color="orange">(BREVE)</font></A>
		</ul>
		<br>
		<?
		echo '</div>'.$cr;
		echo '<BR>&nbsp;'.$cr;

		echo '<script>'.$cr;
		echo '	$("#pibic").corner()'.$cr;
		echo '</script>'.$cr;
		
	}

if ($pibiti == 1)
	{
		echo '<TD>';
		echo '<style>'.$cr;
		echo ' #pibiti { background-color:#f0f0fe; width: 100%; }';
		echo ' #pibiti a { color: #0000FF; }';
		echo '</style>'.$cr;
		echo '<div id="pibiti">';
		?>
		<br><center><b>Formulários</b></center>
		<ul>    
		<li><a href="/reol/public/20/archive/PUCPR_PIBITI_PROJETO_MODELO.pdf" target="m5">Modelo do Projeto de Pesquisa PIBITI</a> 
		<li><a href="/reol/public/20/archive/PUCPR_PIBITI_PLANO_MODELO.pdf" target="m1">Modelo do Plano de trabalho do aluno PIBITI</a> 
		<li><a href="/reol/public/20/archive/PUCPR_CADERNO_DE_NORMAS.pdf" target="m8">Caderno de Normas IT</a> 
		<li><a href="/reol/public/20/archive/FICHA_DO_AVALIADOR_PIBITI.pdf" target="m8">Ficha do Avaliador PIBITI</a>
		<li><a href="/reol/public/20/archive/PUCPR_QUESTIONARIO_CHECKLIST_PIBITI.pdf" target="m8">Questionário para identificação da inovaçao tecnológica</a>		
		<BR>
		<br><b>Edital de aprovação</b>
		<br>
		<li><A HREF="edital.php?dd0=B&dd1=PIBITI&dd2=2012">Aprovados com bolsa CNPq</A>
		<li><A HREF="edital.php?dd0=&dd1=PIBITI&dd2=2012">Aprovados em todas as modalidades</A>
		<li><A HREF="edital.php?dd0=D&dd1=PIBITI&dd2=2012">Projetos não aprovados</A>
		<li><A HREF="edital_panorama.php?dd0=H&dd1=PIBITI&dd2=2012">Panorama dos projetos PIBITI</A>
		<BR>
		<br><b>Avaliação CNPq</b>
		<br>
		<li><A HREF="#">Link de acesso ao processo de avaliação CNPq <font color="orange">(BREVE)</font></A>
		</ul>
		</ul>
		<br>
		<?
		echo '</div>'.$cr;
		echo '<BR>&nbsp;'.$cr;

		echo '<script>'.$cr;
		echo '	$("#pibiti").corner()'.$cr;
		echo '</script>'.$cr;
		
	}

if ($pibic_em == 1)
	{
		echo '<TD>';
		echo '<style>'.$cr;
		echo ' #pibic_em { background-color:#f0f0fe; width: 100%; }';
		echo ' #pibic_em a { color: #0000FF; }';
		echo '</style>'.$cr;
		echo '<div id="pibic_em">'.$cr;
		?>
		<br><center><b>Formulários</b></center>
		<ul>    
		<li><a href="/reol/public/20/archive/PUCPR_FICHA_DE_INSCRICAO_DO_ALUNO_NO_PIBIC_EM.pdf" target="m5">Ficha de Inscrição do Aluno PIBIC_EM</a> 
		<li><a href="/reol/public/20/archive/PUCPR_FICHA_DO_PROFESSOR_SUPERVISOR_PIBIC_EM.pdf" target="m1">Ficha de Inscrição do Professor Supervisor do PIBIC_EM</a> 
		<li><a href="/reol/public/20/archive/PUCPR_INSCRICAO_PROJETO_DE_PESQUISA.pdf" target="m7">Modelo do Projeto de Pesquisa</a> 
		<li><a href="/reol/public/20/archive/PUCPR_Manual_PIBIC_JR_2012.pdf" target="m8">Manual do PIBIC_EM em 2012</a> 
		<BR>
		<br><b>Planos aprovados</b>
		<br>
		<li><A HREF="edital.php?dd0=H&dd1=PIBICE&dd2=2012">Relatório dos Planos Aprovados</A>
		</ul>
		<br>
		<?
		echo '</div>'.$cr;
		echo '<BR>&nbsp;'.$cr;

		echo '<script>'.$cr;
		echo '	$("#pibic_em").corner()'.$cr;
		echo '</script>'.$cr;
	}


?>
</table>
</div>
