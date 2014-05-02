<?
$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pb = '".$dd[1]."'";
$sql .= "order by pa_nome";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$rp = $line['pb_relatorio_parcial'];
	$rf = $line['pb_relatorio_final'];
	$rm = $line['pb_resumo'];
	if ($rp > 20100101) { $trp = 'Entregue em <B>'.stodbr($rp).'</B>'; }
	if ($rf > 20100101) { $trf = 'Entregue em <B>'.stodbr($rf).'</B>'; }
	if ($rm > 20100101) { $trm = 'Entregue em <B>'.stodbr($rm);'</B>'; } 
	}

$img = '<img src="img/icone_editar.gif" width="20" height="19" alt="">';
if ($rp < 20090101 ) { $img_rp = $img; } else { $img_rp = '<img src="img/icone_check.jpg" width="20" height="19" alt="">'; }
if ($rf < 20090101 ) { $img_rf = $img; } else { $img_rf = '<img src="img/icone_check.jpg" width="20" height="19" alt="">'; }
if ($rm < 20090101 ) { $img_resumo = $img; } else { $img_resumo = '<img src="img/icone_check.jpg" width="20" height="19" alt="">'; }
?>

</center>
<HR>
<table width="100%" class="lt1">
<TR><TH colspan="2">Cronograma de atividades</TH></TR>
<TR><TD width="20"><img src="img/icone_check.jpg" width="20" height="20" alt=""></TD><TD>Projeto de pesquisa</TD></TR>
<TR><TD><img src="img/icone_check.jpg" width="20" height="20" alt=""></TD><TD>Plano do aluno</TD></TR>
<TR><TD height="20"><?=$img_rp;?></TD><TD>Relatório parcial <?=$trp;?></TD></TR>
<TR><TD height="20"><?=$img_rf;?></TD><TD>Relatório Final <?=$trf;?></TD></TR>
<TR><TD height="20"><?=$img_resumo;?></TD><TD>Resumo <?=$trm;?></TD></TR>
</table>