<table width="98%">
<TR bgcolor="#c0c0c0" class="lt1"><TD colspan="2">Dados do Professor</TD></TR>
<?

//$sql = "ALTER TABLE pibic_professor ADD COLUMN pp_ass char(100);";
//$rrr = db_query($sql);

$sql = "select * from pibic_professor ";
$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where pp_cracha = '".trim($id_pesq)."' ";
$rrr = db_query($sql);
$pline = db_read($rrr);
$err = 0;

	$professor_nome = trim($pline['pp_nome']);
	$cpf = trim($pline['pp_cpf']);
	$nasc= trim($pline['pp_nasc']);
	$cep = trim($pline['ap_tit_titulo']);
	$ass = trim($pline['pp_ass']);
	$tit = trim($pline['ap_tit_titulo']);
	$email = trim($pline['pp_email']);
	$email_1 = trim($pline['pp_email_1']);
	$cracha = trim($pline['pp_cracha']);
	$idpa = $pline['id_pp'];
	$tel1 = $pline['pp_telefone'];
	$tel2 = $pline['pp_celular'];
	$chave = "pibic".date("Y");
	$chksun = md5($cracha.''.$chave);
	$curso = trim($pline['pp_curso']);
	$idpa = $pline['id_pp'];

	if ((strlen($nasc) < 8) or ($nasc == '19000101')) { $nasc = ''; } else { $nasc = stodbr($nasc); }
	$link_img = '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=P&dd2='.$chksun.chr(39).',400,200);"><BR>Click <B>aqui</B> para enviar a imagem da assintatura</A>';
	if (strlen($cpf) == 0) { $cpf = '<font color="RED">CPF é obrigatório</font>'; $err++; }
	if (strlen($nasc) == 0) { $nasc = '<font color="RED">Data Nascimento é obrigatório</font>'; $err++; }
	if (strlen($tel1) == 0) { $cep = '<font color="RED">Telefone é obrigatório</font>'; $err++; }
	if (strlen($curso) == 0) { $curso = '<font color="RED">Curso é obrigatório</font>'; $err++; }
	if (strlen($ass) == 0) { $img_ass = '<font color="RED"><B>Imagem da Assintura é obrigatória</B></font>'.$link_img; $err++; } else
			{ 
			$img_ass = '<img src="'.$ass.'" width="300" >'; 
			$img_ass .= '<BR><A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=P&dd2='.$chksun.chr(39).',400,200);"><BR>Click <B>aqui</B> para substituir a imagem da assintatura</A>';
			
			}
	$chksun2 = $idpa.$chave;
/////////////////////////////////////////
$errp = $err;
if ($err != 0)
	{
	?>
	<TR><TD><BR></TD></TR>
	<TR align="center" class="lt2">
	<TD colspan="2"><font color=red>** ATENÇÃO **<br>existem dados faltando sobre o professor que impedem a continuidade do processo</font>
	<? } ?>
	</TR>
<TR><TD colspan="2"><form method="get" action="meusdados.php"><input type="submit" value="Atualizar dados do professor"></TD><TD></form></TD></TR>
<TR><TD colspan="2" class="lt0">Nome</TD></TR>
<TR><TD colspan="2" class="lt2"><B><?=$professor_nome; ?></B></TD></TR>
<TR class="lt0"><TD>Cracha</TD><TD>Data Nascimento</TD></TR>
<TR class="lt2"><TD><B><?=$cracha;?></B></TD>
				<TD><B><?=$nasc;?></B></TD>
</TR>

<TR class="lt0"><TD>Titulação</TD></TR>
<TR class="lt2"><TD><B><?=$tit;?></B></TD></TR>

<TR class="lt0"><TD>CPF</TD></TR>
<TR class="lt2"><TD><B><?=$cpf;?></B></TD></TR>
	
<TR class="lt0"><TD>Curso</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$curso;?></B></TD>
	
<TR class="lt0"><TD colspan="2">e-mail</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$email;?>&nbsp;</B></TD></TR>

<TR class="lt0"><TD colspan="2">e-mail (alternativo)</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$email_1;?>&nbsp;</B></TD></TR>


<TR class="lt0"><TD>Telefone</TD><TD>Celular</TD></TR>
<TR class="lt2"><TD><B><?=$tel1;?></B></TD>
	<TD><B><?=$tel2;?></B></TD></TR>
<TR class="lt0"><TD colspan="2">Assinatura do Professor</TD></TR>
<TR class="lt2"><TD colspan="2"><?=$img_ass;?></TD></TR>
</table>
<BR><BR>