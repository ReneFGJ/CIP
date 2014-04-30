<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_email.php');
require("../_class/_class_ic.php");
$ic = new ic;

require("_email.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

echo '<A HREF="'.page().'?dd0=1">Enviar e-mail para professores</A>';
echo $semic->resumos_sem_ingles((date("Y") - 1));

if (strlen($dd[0]) > 0)
{
			$sql = "select * from articles 
					inner join pibic_professor on pp_cracha = article_author_pricipal
					left join sections on article_section = section_id
					where articles.journal_id = $jid
					and ((article_2_abstract = '') or (article_2_title = '') or (article_2_keywords = ''))
					and article_publicado <> 'X'
				order by pp_nome
				limit 40000
			";
			$jid = '';
			$txt = $ic->ic('semic_resumo_sem_ing');
			$texto = mst($txt['nw_descricao']);
				
			$rlt = db_query($sql);
			$xnome = "";
							
			while ($line = db_read($rlt))
			{
				$titulo = trim($line['article_title']);
				$nome = trim($line['pp_nome']);
				$link = 'http://www2.pucpr.br/reol/pesquisador/semic.php?orientador='.trim($line['pp_cracha']);
				$link = '<A HREF="'.$link.'">'.$link.'</A>';
				$email1 = trim($line['pp_email']);
				$email2 = trim($line['pp_email_1']);
			
				if ($nome != $xnome)
				{
					$xnome = $nome;	
					$tt = $texto;
					$tt = troca($tt,'$link',$link);
					$tt = troca($tt,'$projeto',$tit);
					$tt = troca($tt,'$nome',$nome);
					
					if (strlen($email1) > 0) { enviaremail($email1,'','XX SEMIC - Inserção do Titulo, resume e palavras-chave em Inglês',$tt); echo '<BR>enviado para '.$email1; }
					if (strlen($email2) > 0) { enviaremail($email2,'','XX SEMIC - Inserção do Titulo, resume e palavras-chave em Inglês',$tt); echo '<BR>enviado para '.$email2; }
				}
			}
}
require("../foot.php");	
?>