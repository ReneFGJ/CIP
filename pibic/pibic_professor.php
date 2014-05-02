<?
$sql = "select * from pibic_professor ";
$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= "where pp_cracha = '".$id_pesq."' ";
$rlt = db_query($sql);

$submitok = 0;
$tituok = False;


if ($line = db_read($rlt))
	{
	$lattes = trim($line['pp_lattes']);
	$nome   = $line['pp_nome'];
	$titulo = trim($line['ap_tit_titulo']);

	$titc = trim($line['ap_tit_codigo']);
	$fone   = trim($line['pp_telefone']);
	$celu   = trim($line['pp_celular']);
	$email  = trim($line['pp_email']);
	$emaila  = trim($line['pp_email_1']);
	$cpf  = trim($line['pp_cpf']);
	$horas  = $line['pp_carga_semanal'];
	$codfunc= $line['pp_cracha'];
	$curso  = $line['pp_curso'];
	$prof_id= 1;
	$bolsista = $line['pp_ss'];
	if ($bolsista == 'S') { $bolsista = "Sim"; } else { $bolsista = "Não"; }
	if ($horas >= 1) {	$submitok = 1; }
	
	if (($titc=='002') or ($titc=='003') or ($titc=='001'))
		{
		$tituok = True;
		}
	
	if (strlen($lattes) > 0)
		{
		if (UpperCase(substr($lattes,0,4)) == 'HTTP')
			{ $lattes = '<A HREF="'.$lattes.'" target="_new">'.$lattes.'</A>'; } else
			{ $lattes = '<A HREF="http://'.$lattes.'" target="_new">'.$lattes.'</A>'; } 
		}
	if ($submitok == 1)
		{
		$checklist = true;
		if (strlen($lattes) == 0) { $checklist = false; }
		if (strlen($fone) == 0) { $checklist = false; }
		if (strlen($email) == 0) { $checklist = false; }
		$checklist = $tituok;
		}
	}

?>
<BR>
<TABLE width="500" class="lt1" border="0" cellpadding="0" cellspacing="0">
<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Informações do professor</font></B>&nbsp;</legend>
<TABLE width="100%" class="lt1" border="0">
<TR>
	<TD align="right" width="30%">Nome do prof.</TD>
	<TD width="70%"><B><?=$titulo;?>&nbsp;<?=$nome;?></B></TD>
</TR>
<TR>
	<TD align="right">Código funcional</TD>
	<TD><B><?=$codfunc;?></B></TD>
</TR>
<TR>
	<TD align="right">CPF</TD>
	<TD><B><?=$cpf;?></B></TD>
</TR>
<TR valign="top">
	<TD align="right">Carga horária semanal<BR><font class="lt0">últimos 12 meses</font></TD>
	<TD><B><?=$horas;?> horas</B></TD>
</TR>
<TR>
	<TD align="right">Curso vinculado</TD>
	<TD><B><?=$curso;?></B></TD>
</TR>
<TR>
	<TD align="right">Stricto Sensu</TD>
	<TD><B><?=$bolsista;?></B></TD>
</TR>

<TR>
	<TD align="right">Link para o lattes</TD>
	<TD><?=$lattes;?></TD>
</TR>
<TR>
	<TD align="right">Telefone(s):</TD>
	<TD><B><?=$fone;?></B></TD>
</TR>
<TR>
	<TD align="right"></TD>
	<TD><B><?=$celu;?></B></TD>
</TR>

<TR>
	<TD align="right">e-mail</TD>
	<TD><B><?=$email;?></B></TD>
</TR>
<TR>
	<TD align="right"></TD>
	<TD><B><?=$emaila;?></B></TD>
</TR>

<TR><TD colspan="2" align="right">
<form method="post" action="meusdados.php">
<input type="submit" name="dd50" value="atualizar dados">
</form>
</TD></TR>
</TABLE>
<font class="lt2">
<?
if ((strlen($lattes) == 0) or (strlen($email.$emaila) == 0) or (strlen($fone.$celu) == 0))
	{
	?>
	<table class="lt2">
	<TR><TD rowspan="4"><img src="img/icone_stop.png" width="64" height="64" alt="" border="0">
	<TD>Corrigir as pendências para submeter projetos</TD>
	<?
	if (strlen($lattes) == 0)
		{ echo '<TR><TD><font color="red">Link para o Lattes é obrigatório<BR>'; $submitok = 0; }
	if (strlen($email.$emaila) == 0)
		{ echo '<TR><TD><font color="red">Um e-mail é obrigatório<BR>'; $submitok = 0; }
	if (strlen($fone.$celu) == 0)
		{ echo '<TR><TD><font color="red">Um telefone de contato é obrigatório<BR>'; $submitok = 0; }
	?>
	</table>
	<? } ?>
<BR>
</TD></TR>
</TABLE>