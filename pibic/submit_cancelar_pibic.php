<?
require("cab.php");
require("cab_main.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_windows.php");

if (strlen(trim($dd[1])) != 5)
	{
	$protocolo = $dd[1];
	$tipo      = $dd[0];
	$docid     = $dd[3];
	} else {
	$protocolo = $dd[0];
	$tipo      = $dd[1];
	$docid     = $dd[3];
	}

$bt_1 = "Confirmar cancelamento";
$bt_1_acao = 'submit_cancelar_pibic.php';
$bt_2 = "Voltar ao menu";
$bt_2_acao = 'main.php';

$stylo = 'style="width: 200; height:50px; "';

$sql = "select * from ".$tdoc." ";
$sql .= "left join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where doc_protocolo = '".$protocolo."' ";
$sql .= " and doc_status = '@' ";
//$sql .= " and doc_autor_principal = '".$id_pesq."' ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$pp_titulo = trim($line['doc_1_titulo']);
	$pp_professor = trim($line['pp_nome']);
	$pp_lattes = trim($line['pp_lattes']);
	$pp_email = trim($line['pp_email']);
	$pp_email2 = trim($line['pp_email_2']);
	$pp_titulacao = trim($line['ap_tit_titulo']);
	$pp_curso = trim($line['pp_curso']);
	$pp_mae = trim($line['doc_protocolo_mae']);
	$pp_principal = False;
	if (strlen($pp_mae) > 0)
		{
		$pg_redireciona = 'submit_phase_1_pibic_sel.php?dd0=00014&dd1='.$pp_mae.'&dd98=3';
		} else {
		$pp_principal = True;
		$pg_redireciona = 'resume.php';
		}
		
	////////////////////////////////////// ACAO DE CANCELAR O PROJETO
	if (trim($acao) == trim($bt_1))
		{
		echo 'Cacnelar projeto';
		$sql = "update ".$tdoc." set doc_status = 'X' ";
		$sql .= " where doc_protocolo = '".$protocolo."' ";
		$sql .= " and doc_status = '@' ";
		$sql .= " and doc_autor_principal = '".$id_pesq."'; ";
		
		////////// cancela projedos relacionados
		if ($pp_principal == true)
			{
			$sql .= "update ".$tdoc." set doc_status = 'X' ";
			$sql .= " where doc_protocolo_mae = '".$protocolo."' ";
			$sql .= " and doc_status = '@' ";
			$sql .= " and doc_autor_principal = '".$id_pesq."'; ";
			}
		$rlt = db_query($sql);
		echo '<HR>';
		echo $pg_redireciona;
		echo '<HR>';
		redirecina($pg_redireciona);
		exit;
		}
	
	}

$pp_area_2 = "área do conhecimento";
?>
<CENTER><FONT CLASS="lt1">Resumo do projeto</FONT></CENTER>
<BR><BR>
<TABLE width="<?=$tab_max;?>" align="center" class="lt2" border=0 >
<TR><TD colspan="2" align="center"><font class="lt5"><?=$pp_titulo;?></font></TD></TR>
<TR><TD colspan="2" align="center"><font class="lt2">Protocolo <?=$protocolo;?></font></TD></TR>
<?
//<TR><TD colspan="2" align="right"><font class="lt0">Prof. responsável&nbsp;</font><font class="lt2"><1?=$pp_titulacao;?1>&nbsp;<1?=$pp_professor;?1></font></TD></TR>
//<TR><TD colspan="2" align="right"><font class="lt0"><font class="lt1"><1?=$pp_email2;?1>&nbsp;<1?=$pp_email;?1></font></TD></TR>
//<TR><TD colspan="2" align="right"><font class="lt0"><A HREF="<1?=$pp_lattes;?1>" target="_new"><font class="lt1"><?=$pp_lattes;?1></A></font></TD></TR>
//<TR><TD colspan="2" align="right"><font class="lt1"><1?=$pp_curso;?1></font></TD></TR>
?>
<TR><Th colspan="2" align="center" bgcolor="#E0E0E0"><font class="lt2">Projeto de pesquisa do professor/Plano de trabalho</font></TD></TR>
<?
///////////////////////////// pROJETO DO PROFESSOR ORIENTADOR
$sql = "select * from ".$tdov." ";
$sql .= " left join ".$submit_manuscrito_field." on spc_codigo  = sub_codigo ";
$sql .= " where spc_projeto = '".$protocolo."' ";
$sql .= " order by sub_pag,sub_pos ";
//echo $sql;
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$vlr = trim($line['spc_content']);
	if (strlen($vlr) > 0)
		{
		$content = $line['spc_content'];
		if (($content == '1') or ($content == 'S')) { $content = 'SIM'; }
		if (($content == '0') or ($content == 'N')) { $content = 'NÃO'; }
		?>
		<TR <?=coluna();?>>
		<TD colspan="1" align="right"><font class="lt0"><?=$line['sub_descricao'];;?></font></TD>
		<TD colspan="1" align="left"><font class="lt1"><B><?=$content;?></B></font></TD>
		</TR>
		<?
		}
	}
?>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
</table>
<?
if ($pp_principal == true)
	{
	$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_CANCELA' and nw_journal = ".$jid;
	$sql .= " and nw_idioma = '".$idioma_id."'";
	$rrr = db_query($sql);
	$texto = 'SUB_CANCELA';
	if ($eline = db_read($rrr)) 
		{
		echo mst($eline['nw_descricao']);
		}
	}
?>
<TABLE width="<?=$tab_max;?>" align="center" class="lt2">
<TR align="center">
<TD><form method="post" action="<?=$bt_1_acao;?>">
<input type="submit" name="acao" value="<?=$bt_1;?>" <?=$stylo;?>>
<input type="hidden" name="dd0" value="<?=$dd[0];?>">
<input type="hidden" name="dd1" value="<?=$dd[1];?>">
<input type="hidden" name="dd3" value="<?=$dd[3];?>">
</form></TD>
<TD>
<form method="post" action="<?=$bt_2_acao;?>"><input type="submit" name="acao" value="<?=$bt_2;?>" <?=$stylo;?>>
</form></TD>
</TR>
</table>
<? require("foot.php"); ?>

