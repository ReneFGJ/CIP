<?
//$sql = "ALTER TABLE pibic_bolsa_contempladas ADD COLUMN pb_ano char(4);";
//$rrr = db_query($sql);
//$sql = "update pibic_bolsa_contempladas set pb_ano = '2009' ;";
//$rrr = db_query($sql);

$ac1 = "Implementar Bolsa";

if (strlen($dd[6]) > 0)
	{
	$link = 'atividade_bolsa_implantacao_ativacao.php?dd0='.$dd[0]."&dd1=".$dd[1]."&dd2=".$dd[2].'&dd5=';
	if ($ac1 == $dd[6])
		{ redirecina($link.'5'); }
	}
	
	
//$sql = "ALTER TABLE pibic_aluno ADD COLUMN pa_img_rg char(100);";
//$rrr = db_query($sql);
//$sql = "ALTER TABLE pibic_aluno ADD COLUMN pa_img_residencia char(100);";
//$rrr = db_query($sql);


$sql = "select * from pibic_aluno where pa_cracha = '".trim($aluno)."' ";
$rrr = db_query($sql);
$rline = db_read($rrr);

	$err = 0;
	$mae = trim($rline['pa_mae']);
	$nasc = round($rline['pa_nasc']);
	$pai = trim($rline['pa_pai']);
	$rg  = trim($rline['pa_rg']);
	$cpf = trim($rline['pa_cpf']);
	$ende= trim($rline['pa_endereco']);
	$cep = trim($rline['pa_cep']);
	$ass = trim($rline['pa_ass']);
	$cracha = trim($rline['pa_cracha']);
	$img_rg = trim($rline['pa_img_rg']);
	$img_cpf = trim($rline['pa_img_cpf']);
	$img_resi = trim($rline['pa_img_residencia']);
	$idpa = $rline['id_pa'];

	$chave = "pibic".date("Y");
	$chksun = md5($cracha.''.$chave);

	$link_img = '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para enviar a imagem da assintatura</A>';
	if (strlen($mae) == 0) { $mae = '<font color="RED">Nome da máe é obrigatório</font>'; $err++; }
	if (strlen($pai) == 0) { $pai = '<font color="RED">Nome do pai é obrigatório</font>'; $err++; }
	if (strlen($rg) == 0) { $rg = '<font color="RED">RG é obrigatório</font>'; $err++; }
	if (strlen($cpf) == 0) { $cpf = '<font color="RED">CPF é obrigatório</font>'; $err++; }
	if ($nasc < 1900) 
		{ $nasc = '<font color="RED">Data de nascimento é obrigatória</font>'; $err++; }
	else { $nasc = stodbr($nasc); } 
	if (strlen($cep) == 0) { $cep = '<font color="RED">CEP é obrigatório</font>'; $err++; }
	if (strlen($ende) == 0) { $ende = '<font color="RED">Endereço é obrigatório</font>'; $err++; }
	if (strlen($img_rg) == 0) { $img_rg = '<font color="RED"><B>O Documento RG é obrigatório scanneado</B></font>'; $err++; 
				$img_rg .= '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=RG&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para substituir ou enviar o documento de RG scanneado</A><BR><BR>';
	} else {
		$img_rg = '<A HREF="'.$img_rg.'" target="new"><font class="lt2"><font color="GREEN"><B>Visualização do documento</A></font>';
		$img_rg .= '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=RG&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para substituir ou enviar o documento de RG scanneado</A><BR><BR>';
	}
	
	if (strlen($img_cpf) == 0) { $img_cpf = '<font color="RED"><B>O Documento CPF é obrigatório scanneado</B></font>'; $err++; 
				$img_cpf .= '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=CPF&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para substituir ou enviar o documento de CPF scaneado</A><BR><BR>';
	} else {
		$img_cpf = '<A HREF="'.$img_cpf.'" target="new"><font class="lt2"><font color="GREEN"><B>Visualização do documento</A></font>';
		$img_cpf .= '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=CPF&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para substituir ou enviar o documento de CPF scanneado</A><BR><BR>';
	} 

	if (strlen($img_resi) == 0) { $img_resi = '<font color="RED"><B>O Comprovante de endereço é obrigatório scanneado</B></font>'; $err++; 
				$img_resi .= '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=ENDE&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para substituir ou enviar o comprovante de endereço scaneado</A><BR><BR>';
	} else {
		$img_resi = '<A HREF="'.$img_resi.'" target="new"><font class="lt2"><font color="GREEN"><B>Visualização do documento</A></font>';
		$img_resi .= '<A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd3=ENDE&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para substituir ou enviar o comprovante de endereço scanneado</A><BR><BR>';
	} 

//	if (strlen($ass) == 0) { $img_ass = '<font color="RED"><B>Imagem da Assintura é obrigatória</B></font>'.$link_img; $err++; } else
//			{ 
//			$img_ass = '<img src="'.$ass.'" width="300" >'; 
//			$img_ass .= '<BR><A HREF="javascript:newxy2('.chr(39).'upload_img.php?dd0='.$cracha.'&dd2='.$chksun.chr(39).',600,300);"><BR>Click <B>aqui</B> para substituir a imagem da assintatura</A>';
//			
//			}
	$chksun2 = $idpa.$chave;

	
?>
<form method="post">
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<input type="hidden" name="dd1" value="<?=$dd[1];?>">
	<input type="hidden" name="dd2" value="<?=$dd[2];?>">
	<input type="hidden" name="dd3" value="<?=$dd[3];?>">
	<input type="hidden" name="dd4" value="<?=$dd[4];?>">
	<input type="hidden" name="dd5" value="<?=$dd[5];?>">
<table width="98%">
<TR><TD colspan="2" class="lt1">
Prezado professor(a),
<BR>
<BR>Confirme os dados do aluno e atualize os campos necessários, lembrando que os dados aqui inseridos farão parte do Termo da Bolsa.
<BR>
<BR>
</TD></TR>
<TR><TD colspan="2" class="lt0">Protocolo</TD></TR>
<TR><TD class="lt2" colspan="2"><B><?=$proto;?></B></TD></TR>
<TR><TD colspan="2" class="lt0">Título do plano do aluno</TD></TR>
<TR><TD class="lt2" align="center" colspan="2"><B><?=$tit_plano;?></TD></TR>


<?
if ($err != 0)
	{
	?>
	<TR><TD><BR></TD></TR>
	<TR align="center" class="lt2">
	<TD colspan="2"><font color=red>** ATENÇÃO **<br>existem dados faltando sobre o aluno que impedem a continuidade do processo</font>
	<? } ?>
</TR>

<TR><TD><BR></TD></TR>
<TR><TD class="lt1"><img src="../img/icone_alert.png" align="left">*** Atenção ***<BR>
	<font color="red">
	Este ano para as modalidades de IC é necessário que o e-mail do estudante estaja atualizado, ele recebera um link para validação do contrato tendo que digitar o login e a senha de rede.
	Esta validação só poderá ser feita pelo link que o estudante receberá pelo e-mail.
	Caso o estudante não ative e valide o link, o <B>plano não estará</B> ativado.
	</font>
</TD></TR>
<TR bgcolor="#c0c0c0" class="lt1"><TD colspan="2" class="lt2">Dados do Aluno</TD></TR>

<TR><TD colspan="2"><input type="submit" value="Atualizar dados do aluno" name="editar" onclick="newxy2('pibic_aluno_editar.php?dd0=<?=$idpa;?>&dd2=<?=$chksun2;?>',720,500);"></TD></TR>

<TR><TD colspan="2" class="lt0">Nome</TD></TR>
<TR><TD colspan="2" class="lt2"><B><?=$aluno_nome; ?></B></TD></TR>
<TR class="lt0"><TD>Cracha</TD><TD>Data Nascimento</TD></TR>
<TR class="lt2"><TD><B><?=$rline['pa_cracha'];?></B></TD>
	<TD><B><?=$nasc;?></B></TD>
</TR>

<TR class="lt0"><TD>RG.</TD><TD>CPF</TD></TR>
<TR class="lt2"><TD><B><?=$rg;?></B></TD>
	<TD><B><?=$cpf;?></B></TD></TR>
	
<TR class="lt0"><TD>Curso</TD><TD>Período</TD></TR>
<TR class="lt2"><TD><B><?=$rline['pa_curso'];?></B></TD>
	<TD><B><?=$rline['pa_periodo'];?></B></TD></TR>
	
<TR class="lt0"><TD colspan="2">e-mail</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$rline['pa_email'];?>&nbsp;</B></TD></TR>

<TR class="lt0"><TD colspan="2">e-mail (alternativo)</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$rline['pa_email_1'];?>&nbsp;</B></TD></TR>


<TR class="lt0"><TD>Telefone</TD><TD>Celular</TD></TR>
<TR class="lt2"><TD><B><?=$rline['pa_tel1'];?></B></TD>
	<TD><B><?=$rline['pa_tel2'];?></B></TD></TR>

<TR class="lt0"><TD colspan="2">Endereço</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$ende;?>&nbsp;</B></TD></TR>

<TR class="lt0"><TD>CEP</TD></TR>
<TR class="lt2"><TD><B><?=$cep;?>&nbsp;</B></TD>

<TR class="lt1"><TD colspan="2"><B>Dados bancários</TD></TR>

<TR class="lt0"><TD>Banco</TD><TD>Agência</TD></TR>
<TR class="lt2"><TD><B><?=$rline['pa_cc_banco'];?>&nbsp;</B></TD>
	<TD><B><?=$rline['pa_cc_agencia'];?></B></TD></TR>
	
<TR class="lt0"><TD colspan="2">Conta corrente (individual)</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$rline['pa_cc_conta'];?>&nbsp;</B></TD></TR>

<TR class="lt0"><TD colspan="2">Filiação: Nome do Pai</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$pai;?>&nbsp;</B></TD></TR>
<TR class="lt0"><TD colspan="2">Filiação: Nome do Mãe</TD></TR>
<TR class="lt2"><TD colspan="2"><B><?=$mae;?>&nbsp;</B></TD></TR>
<TR class="lt0"><TD colspan="2">Assinatura do Aluno</TD></TR>
<TR class="lt2"><TD colspan="2"><?=$img_ass;?></TD></TR>
<TR class="lt0"><TD colspan="2">Documentos Obrigatórios</TD></TR>
<TR class="lt2"><TD colspan="2"><?=$img_rg;?></TD></TR>
<TR class="lt2"><TD colspan="2"><?=$img_cpf;?></TD></TR>
<TR class="lt2"><TD colspan="2"><?=$img_resi;?></TD></TR>
<?
if ($err == 0)
	{
	?>
	<TR><TD colspan="2" class="lt0">Selecione a opção</TD></TR>
	<TR align="center" class="lt2">
	<TD><input type="submit" name="dd6" value="<?=$ac1;?>" style="width:200px; height:50px;"></TD>	
	<?
	} ?>
</form>
</table>
<BR><BR><BR>