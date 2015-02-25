<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_email.php");
require($include."cp2_gravar.php");
$tabela = "pibic_bolsa_contempladas";
$email_producao = trim($dd[2]);
$dd[3] = $dd[2];
if (strlen($dd[3]) == 0)
	{

//if ((strlen(trim($dd[1])) == 0) or (strlen($email_producao) == 0))
//	{
//	$crnf = chr(13).chr(10);
//	$dd[1] = $s;
//	}
		$tabela = '';
		$cp = array();
		array_push($cp,array('$O : &pb_relatorio_parcial:Relatório Parcial&pb_relatorio_final:Relatório Final','','Tipo:',False,True,''));
		array_push($cp,array('$T60:10','','Texto para enviar',True,True,''));
		array_push($cp,array('$O : &TST:e-mail de teste para pibucpr@pucpr.br (limite 10)&VID:Somente no video&SIM:SIM Confirmar envio de email','','Com dados detalhados',True,True,''));
		array_push($cp,array('$H8','','',True,True,''));

		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR><TD>';
		editar();
		echo '<TR><TD colspan="2">';
		?>
		$professor, $titulo, $protocolo, $link
		<?
		echo '</TD></TR>';
		echo '</TABLE>';	
		
		$sql = " select * from pibic_bolsa_contempladas ";
		$sql .= " inner join pibic_parecer_2011 on pp_protocolo = pb_protocolo ";
		$sql .= " inner join  pareceristas on pp_avaliador = us_codigo ";
		$sql .= " where (pb_status <> 'C' and pb_status <> '@')";
		$sql .= " and (pp_status = '@') ";
		$sql .= " order by us_nome ";
		$rlt = db_query($sql);
		$s = '';
		$total = 0;
		$usnome = 'X';
		$hr = '<TR><TH>Protocolo</TH><TH>Projeto</TH><TH>Ação</TH></TR>';
		while ($line = db_read($rlt))
			{
			$tipo = $line['pp_tipo'];
			$sta = $line['pp_status'];

			$link = '<input type="button" name="ax" value="cancelar" onclick="newxy2('.chr(39).'rel_bolsa_envio_email_avaliador_local_cancelar.php?dd0='.$line['id_pp'].chr(39).',400,140);">';
			$total++;
			$nome = $line['us_nome'];
			if ($nome != $usnome)
				{ $s .= '<TR class="lt4"><TD colspan="3">'.$nome.'</TD></TR>'.$hr; $usnome = $nome; }
			$s .= '<TR '.coluna().'>';
			$s .= '<TD>'.$line['pb_protocolo'].'</TD>';
			$s .= '<TD>'.$tipo.'('.$sta.')<BR>'.$line['id_pb'].'</TD>';
			$s .= '<TD>'.$line['pb_titulo_projeto'].'/'.$line['pb_ano'].'</TD>';
//			$s .= '<TD>'.$line['us_instituicao'].'</TD>';
			$s .= '<TD>'.$link.'</TD>';
			$s .= '<TD>'.$line['pp_tipo'].'</TD>';
			$s .= '</TR>';
			}
		?>
		<table width="<?=$tab_max;?>" align="center" class="lt1">
		<?=$s;?>
		<TR><TD colspan="5" align="right">total de <?=$total;?> projetos não avaliados</TD></TR>
		</table>
		<?
	} else {
		$sql = "select * from (";
		$sql .= "select pp_avaliador from pibic_parecer_2011 
			inner join pibic_bolsa_contempladas on pp_protocolo = pb_protocolo
			where pp_status = '@' and not (pp_protocolo like 'X%') and (pb_status <> 'C' and pb_status <> '@') group by pp_avaliador
			) as tabela 
			inner join pareceristas on pp_avaliador = us_codigo 
			order by us_nome
		";
		$rlt = db_query($sql);
		
		$texto2 = troca($dd[1],chr(13),'<BR>');
		$texto2 = '<table width=600 align=center><TR><TD>'.$texto2.'</table>';
		$tot = 0;
		while ($line = db_read($rlt))
			{
			$tot++;
			$email_1 = trim($line['us_email']);
			$email_2 = trim($line['us_email_alternativo']);
			
			$dd[10] = $line['pp_avaliador'];
			$idp = $line['id_us'];

			$key = substr(md5('pibic'.date("Y").$idp),0,10);
			
			if ($dd[0] == 'pb_relatorio_parcial')
				{ 
				$e3 = '[PIBIC] - Avaliação do relatório parcial - '.$titulo;
				$link = $site.'avaliador/acesso.php?dd0='.$idp.'&dd90='.$key.''; 
				}
			if ($dd[0] == 'pb_relatorio_final')
				{ 
				$e3 = '[PIBIC] - Avaliação do relatório final e resumo - '.$titulo;
				$link = $site.'pibic/pibic_avaliacao_final.php?dd0='.$idp.'&dd1='.$key.'&dd2='.$dd[10].'&dd3='.$protocolo.'&dd4=003'; 
				}
				
			if (strlen($link) == 0) { echo 'Erro a seleção do tipo '; exit; }

			$texto = $texto2;
			$link = '<A HREF="'.$link.'" target="new">'.$link.'</A>';
			require("email_body_tratar.php");

			$e4 = $texto;
			// e-mail de segurança
			if (($email_producao == 'VID') and ($tot < 999))
				{ echo '<HR>'.$e4; }			
			
			if (($email_producao == 'TST') and ($tot < 11))
				{
				$e1 = 'pibicpr@pucpr.br';
	//			enviaremail($e1,$e2,$e3,$e4);
				$e1 = 'rene@sisdoc.com.br';
				enviaremail($e1,$e2,'TST-'.$e3,$e4);
				}
				
			if ($email_producao == 'SIM')
				{
				$e1 = 'pibicpr@pucpr.br';
				enviaremail($e1,$e2,$e3,$e4);
				$e1 = 'renefgj@gmail.com';
				enviaremail($e1,$e2,$e3,$e4);	
				echo '<BR>enviado para ';		
				if (strlen($email_2) > 0) { enviaremail($email_2,$e2,$e3,$e4); echo $email_2.'<BR>'; }
				if (strlen($email_1) > 0) { enviaremail($email_1,$e2,$e3,$e4); echo $email_1.'<BR>'; }
				if (strlen($email_2.$email_1) == 0) { echo 'Sem e-mail '.$line['us_nome']; }
				}
		}
		echo "<center>Total de ".$tot." comunicados enviados</center>";
}

require("foot.php");	
?>