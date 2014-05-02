<? 
require("db.php");
$classe = 'aluno';
/////////////////////////////////////////////////////////
$dd[3] = trim($dd[3]);


if ($dd[3] == 'P')
	{ $classe = 'professor'; }
	
if ($dd[3] == 'RG')
	{ $classe = 'rg'; }

if ($dd[3] == 'CPF')
	{ $classe = 'cpf'; }

if ($dd[3] == 'ENDE')
	{ $classe = 'ende'; }
	
$uploaddir = $dir.'/reol/pibic/ass/';
diretorio_checa($uploaddir);
$uploaddir = $dir.'/reol/pibic/ass/'.$classe.'/';
diretorio_checa($uploaddir);

$vlocate = troca($uploaddir,$dir,'');
if (strlen(trim($dd[0])) == 0) { exit; }

require($include."sisdoc_data.php");
require($include."sisdoc_windows.php");
$filename = trim($_FILES['userfile']['name']);
$chave = "pibic".date("Y");
$chksun = md5($dd[0].$dd[1].$chave);
$cracha = $dd[0];
if (($chksun != trim($dd[2])) or (strlen($dd[2]) < 10))
	{
	echo '<CENTER><B><font color=red face="verdana" size="2">Checksun dos parametros incorreto</font>';
	exit;
	}
	
?>
<TITLE>Anexar Imagem de Assinatura - <?=$classe;?></TITLE>
<BODY topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" <?=$bgcolor;?> >
<link rel="stylesheet" href="letras.css" type="text/css" />
<TABLE width="100%" align="center" border="0" class="lt1" >
<TR><TD colspan="10" bgcolor="#c0c0c0" align="center"><B>Anexar Imagem de Assinatura - <?=$classe;?></TD></TR>
<TR><TD colspan="10">Cracha. : <B><?=$cracha;?></TD></TR>
<HR size="1"></TD></TR>
<? if (strlen($filename) == 0 ) { ?>
<TR><TD align="right">
<form enctype="multipart/form-data" action="upload_img.php" method="POST">
</TD><TD>
<input type="hidden" name="MAX_FILE_SIZE" value="300000000">
<TR valign="top"><TD align="right">
Imagem para anexar</TD><TD colspan="3"><input name="userfile" type="file" class="lt2">
&nbsp;<input type="submit" value="e n v i a r" class="lt2" <?=$estilo?>>
<input type="hidden" name="dd0" value="<?=$dd[0]?>">
<input type="hidden" name="dd1" value="<?=$dd[1]?>">
<input type="hidden" name="dd2" value="<?=$dd[2]?>">
<input type="hidden" name="dd3" value="<?=$dd[3]?>">
</form>
</TD>
<TD><?=$xnome?></TD></TR>
<TR><TD colspan="5"><font color="#ff8040">Tamanho máximo por arquivo (10 Mega bytes)</font></TD></TR>
<? } ?>
</TABLE>
<?
///////////
if (strlen($filename) == 0) { exit; }

echo '<HR size="1"><font class=lt1>Filename : '.$filename;
echo '<BR>';


if ((strlen($filename) > 0 ) and (strlen($dd[0]) > 0))
	{
	$ver = count($versoes)+1;
	$ext = UpperCaseSQL(substr($filename,strlen($filename)-3,3));
	$filename = UpperCaseSQL($cracha).'.'.lowercase($ext);
	$filename = troca($filename,' ','_');
	$chave = UpperCaseSQL(substr(md5($chave.$dd[0]),0,8));
	$xfilename = $dd[0].'-'.strzero($ver,2).'-'.$chave.'-'.$filename;

	if (($ext == 'JPG') or (($ext == 'PDF') and (($classe == 'rg') or ($classe == 'cpf') or ($classe == 'ende'))))
		{	
		while (file_exists($uploaddir.$xfilename)) 
			{
			$ver++;
			$xfilename = $dd[0].'-'.strzero($ver,2).'-'.$chave.'-'.$filename;
			}
		////////////////////////////////////////////////////////////////
		echo '<TABLE class="lt1" width="100%">';
		$arq = $uploaddir.$xfilename;
	
		$uploadfile = $uploaddir.''.$xfilename;
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
			{
				if ($classe == 'professor')
					{
					$img = $vlocate.$xfilename;
					$ged_files = 'pibic_professor';
					$ged_campo = 'pp_ass';
					$ged_id = 'pp_cracha';
					}
					
				if ($classe == 'aluno')
					{
					$img = $vlocate.$xfilename;
					$ged_files = 'pibic_aluno';
					$ged_campo = 'pa_ass';
					$ged_id = 'pa_cracha';
					}

				if ($classe == 'rg')
					{
					$img = $vlocate.$xfilename;
					$ged_files = 'pibic_aluno';
					$ged_campo = 'pa_img_rg';
					$ged_id = 'pa_cracha';
					}

				if ($classe == 'cpf')
					{
					$img = $vlocate.$xfilename;
					$ged_files = 'pibic_aluno';
					$ged_campo = 'pa_img_cpf';
					$ged_id = 'pa_cracha';
					}

				if ($classe == 'ende')
					{
					$img = $vlocate.$xfilename;
					$ged_files = 'pibic_aluno';
					$ged_campo = 'pa_img_residencia';
					$ged_id = 'pa_cracha';
					}

				$name = $_FILES['userfile']['name'];
				$size = round($_FILES['userfile']['size']/10);
				$type = $_FILES['userfile']['name'];
				$type = substr($type,strlen($type)-3,3);
				$doc_acesso = '1';
				
				$sql = "update ".$ged_files." set ";
				$sql .= " ".$ged_campo ." = '".$img."' ";
				$sql .= " where ".$ged_id." = '".$dd[0]."' ";
				
				$rlt = db_query($sql);
				////////////// ATUALIZA
				?>
				<script>
					window.opener.location.reload();
					close();
				</script>
				<?
				echo '<TR><TD colspan="10">versão do arquivo : <B>'.$ver.'</B></TD></TR>';
				echo '<TR><TD colspan="10">'.$message.'</TD></TR>';
				echo '<TR><TD colspan="10"><A HREF="#" onclick="winclose();">[Fechar]</A></TD></TR>';
			} else {
			    print "<CENTER><FONT COLOR=RED>ERRO EM SALVAR O ARQUIVO";
				print "<BR>->".$uploadfile;
		    //print_r($_FILES);
			}
		echo '</TABLE>';
		} else {
		echo '<CENTER><BR><CENTER><font class="lt3"><FONT COLOR="RED">Somente é aceito arquivo em JPG ou PDF para Documentos</FONT></CENTER>';
		}
	}
	
function diretorio_checa($vdir)
	{
	if(is_dir($vdir))
		{ $rst =  '<FONT COLOR=GREEN>OK';
		} else { 
			$rst =  '<FONT COLOR=RED>NÃO OK';	
			mkdir($vdir, 0777);
			if(is_dir($vdir))
				{
				$rst =  '<FONT COLOR=BLUE>CRIADO';	
				}
		}
		$filename = $vdir."/index.htm";	
		if (!(file_exists($filename)))
		{
			$ourFileHandle = fopen($filename, 'w') or die("can't open file");
			$ss = "<!DOCTYPE HTML PUBLIC -//W3C//DTD HTML 4.01 Transitional//EN><html><head><title>404 : Page not found</title></head>";
			$ss = $ss . "<body bgcolor=#0080c0 marginheight=0 marginwidth=0><table align=center border=0 cellpadding=0 cellspacing=0>	";
			$ss = $ss . "<tbody><tr>	<td height=31 width=33><img src=/reol/noacess/quadro_lt.gif alt= border=0 height=31 width=33></td>	";
			$ss = $ss . "<td><img src=/reol/noacess/quadro_top.gif alt= border=0 height=31 width=600></td>	<td height=31 width=33>";
			$ss = $ss . "<img src=/reol/noacess/quadro_rt.gif alt= border=0 height=31 width=33></td>	</tr>	<tr>	<td>	";
			$ss = $ss . "<img src=/reol/noacess/quadro_left.gif alt= border=0 height=300 width=33></td>	<td align=center bgcolor=#ffffff>";
			$ss = $ss . "<img src=/reol/noacess/sisdoc_logo.jpg width=590 height=198 alt= border=0><BR>	<font color=#808080 face=Verdana size=1>";
			$ss = $ss . "&nbsp;&nbsp;&nbsp;&nbsp;	programação / program : <a href=mailto:rene@sisdoc.com.br>Rene F. Gabriel Junior</a>	<p>";
			$ss = $ss . "<font color=#808080 face=Verdana size=4>	<font color=#808080 face=Verdana size=1>&nbsp;	<font color=#ff0000 face=Verdana size=3><B>";
			$ss = $ss . "Acesso Restrito / Access restrit	</font></font></td>	<td><img src=/reol/noacess/quadro_right.gif alt= border=0 height=300 width=33></td></tr><tr>";
			$ss = $ss . "<td height=31 width=33><img src=/reol/noacess/quadro_lb.gif alt= border=0 height=31 width=33></td>	<td><img src=/reol/noacess/quadro_botton.gif alt= border=0 height=31 width=600></td>";
			$ss = $ss . "<td height=31 width=33><img src=/reol/noacess/quadro_rb.gif alt= border=0 height=31 width=33></td>	</tr></tbody></table></body></html>";
			$rst = $rst . '*';
			fwrite($ourFileHandle, $ss);
			fclose($ourFileHandle);		
		}
		return($rst);
	}	
?>
