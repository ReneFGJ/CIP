<?php
require("../_class/_class_captacao.php");
$cap = new captacao;
if (strlen($dd[50]) > 0)
	{
		$txt = trim($dd[50]);
		$sql = "select * from ".$cap->tabela."
				inner join pibic_professor on ca_professor = pp_cracha 
			where ";
		$wh .= sisdoc_search($dd[50],'ca_processo');
		$wh .= ' or '.sisdoc_search($dd[50],'ca_protocolo');
		$wh .= ' or '.sisdoc_search($dd[50],'ca_agencia');
		$wh .= ' or '.sisdoc_search($dd[50],'ca_edital_nr');
		$wh .= ' or '.sisdoc_search(UpperCaseSQL($dd[50]),'pp_nome_asc');
		$wh .= ' or '.sisdoc_search(UpperCaseSQL($dd[50]),'asc7(ca_titulo_projeto)');
		$wh .= ' or '.sisdoc_search(UpperCaseSQL($dd[50]),'asc7(ca_descricao)');
		
		$sql .= $wh.' order by ca_vigencia_ini_ano desc, ca_vigencia_ini_mes desc ';
		$rlt = db_query($sql);
		$sr = '<table width="'.$tab_max.'" class="lt1">';
		$tot = 0;
		while ($line = db_read($rlt))
			{
				$link = '<A HREF="captacao_detalhe.php?dd0='.$line['id_ca'].'&dd90='.checkpost($line['id_ca']).'">';
				$tot++;
				$sr .= '<TR>';
				$sr .= '<TD>';
				$sr .= $line['ca_protocolo'];
				$sr .= '<TD colspan=2>'.$link;
				$sr .= '<B>'.'Captação de Recursos / Projetos';
				$sr .= ' - '.$line['pp_nome'];
				$sr .= '</A>';
				
				$sr .= '<TR>';
				$sr .= '<TD>';
				$sr .= '<TD colspan=2>';
				$sr .= ' Agência: <i>'.trim($line['ca_agencia']).'</i>, ';
				$sr .= ' Edital/chamada: <i>'.trim($line['ca_edital_nr']).'/'.trim($line['ca_edital_ano']).' - '.trim($line['ca_descricao']).'</i>, ';
				$sr .= ' Processo: <i>'.trim($line['ca_processo']).'</i>, ';
				$sr .= ' Início: <i>'.strzero(trim($line['ca_vigencia_ini_mes']),2).'/'.$line['ca_vigencia_ini_ano'].'</i>,';
				$sr .= ' Duração: <i>'.strzero(trim($line['ca_duracao']),2).' mês(es)</i>.';
				
				$sr .= '<TR>';
				$sr .= '<TD>';
				$sr .= '<TD colspan=2><i>';
				$sr .= trim($line['ca_titulo_projeto']).'</I> ';
				
				$ln = $line;
			}
		$sr .= '<TR><TD colspan=3><B>Recuperados '.$tot.' registros.</B>';
		$sr .= '</table>';
		echo $sr;
	}
?>