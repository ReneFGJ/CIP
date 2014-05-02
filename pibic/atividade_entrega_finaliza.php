<?

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pb = ".$dd[1]."";
$sql .= "order by pa_nome";
$rlt = db_query($sql);
$line = db_read($rlt);
?>
<center>
<?
$sx = '';
$sx .= '<table width="95%" align="center" class="lt1">';
$sx .= '<TR><TD align="center" colspan="2" class="lt3"><B>PROTOCOLO DE ENTREGA DE '.uppercase($rtipo).'<BR><BR></TD></TR>';

$sx .= '<TR><TD align="right">Protocolo</TD><TD><B>';
$sx .= $line['pb_protocolo'];
$sx .=' / ';
$sx .= $line['pb_protocolo_mae'];
$sx .= '</TR>';

$sx .= '<TR valign="top"><TD><BR>&nbsp;</TD>';

$sx .= '<TR valign="top"><TD align="right">Título do projeto</TD><TD><B>';
$sx .= $line['pb_titulo_projeto'];
$sx .= '</TR>';

$sx .= '<TR><TD><BR></TD>';

$sx .= '<TR><TD align="right">Aluno</TD><TD><B>';
$sx .= $line['pa_nome'];
$sx .= ' ('.$line['pa_cracha'].')';
$sx .= '</TR>';

$sx .= '<TR><TD><BR></TD>';

$sx .= '<TR><TD align="right">Título do plano do aluno</TD><TD><B>';
$sx .= $line['doc_1_titulo'];
$sx .= '</TR>';

$sx .= '<TR><TD><BR></TD>';

$sx .= '<TR><TD colspan=2 align=center ><BR><B>';
$sx .= '<B>Data de postagem '.date("d/m/Y H:m:s");

$sx .= '<TR><TD colspan=2 ><BR>';

$sql = "select * from ic_noticia where nw_ref = '".$ic_msg."' ";
$rrr = db_query($sql);
if ($eline = db_read($rrr))
	{ $sx .= ($eline['nw_descricao']); }
	
$sx .= '</TD></TR>';
$sx .= '</table>';
?>
<?=$sx;?>
<form method="post" action="main.php"><input type="submit" name="acao" value="voltar para tela inicial"></form></center>
<?
$sql = "update pibic_bolsa_contempladas set ";
$sql .= " ".$fld." = '".date("Ymd")."', ".$fld_nota." = ".(0+$valor);
$sql .= " where id_pb = '".$dd[1]."' ";

$rlt = db_query($sql);

////////////////////////////////////////// Enviar e-mail

	$e3 = '[PIBIC] - Entrega de '.$rtipo.' - '.$aluno;
	$e4 = $sx;
	/////////////// e-mail de segurança - Gestor
	$e1 = 'pibicpr@pucpr.br';
	enviaremail($e1,$e2,$e3,$e4);
	/////////////// e-mail de segurança - Rene
//	$e1 = 'rene@sisdoc.com.br';
//	enviaremail($e1,$e2,$e3,$e4);
	
	//// Enviar para professor
exit;
	if (strlen($professor_email) > 0)
		{ 
			echo $professor_email.' '; 
			$e1 = $professor_email;
			enviaremail($e1,$e2,$e3,$e4);
		}
	if (strlen($professor_email_1) > 0)
		{ 
			echo 'e '.$professor_email_1.' '; 
			$e1 = $professor_email_1;
			enviaremail($e1,$e2,$e3,$e4);
		}
?>