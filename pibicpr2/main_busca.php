<?
require($include.'sisdoc_search.php');
require("realce.php");
$chk = array('','','','','','');
if (strlen($dd[51]) == 0) { $chk[0] = 'checked'; } else
	{ $chk[$dd[51]] = 'checked'; }
?>
<table align="center">
<TR><TD><form method="post"></TD></TR>
<TR><TD class="lt1">Busca em</TD></TR>
<TR><TD>
<input type="text" name="dd50" value="<?=$dd[50];?>" style="font-size: 26px; width: 600px;">
</TD><TD><input type="submit" name="dd52" value="Buscar >>>" style="height: 40px;"></TD></TR>
<TR><TD class="lt0">
<input type="radio" name="dd51" value="0" <?=$chk[0];?> >Todos&nbsp;&nbsp;
<input type="radio" name="dd51" value="1" <?=$chk[1];?> >Docentes&nbsp;&nbsp;
<input type="radio" name="dd51" value="2" <?=$chk[2];?> >Discentes&nbsp;&nbsp;
<input type="radio" name="dd51" value="3" <?=$chk[3];?> >Títulos dos projetos&nbsp;&nbsp;
</TD></TR>
<TR><TD></form></TD></TR>
</table>

<?

//$sql = "ALTER TABLE pibic_bolsa_contempladas ADD COLUMN pb_titulo_projeto_asc character(255);";
//$rlt = db_query($sql);

///////////////////////////////////////////////////////////////////////////////////////////
$sql = "select * from pibic_bolsa_contempladas where pb_titulo_projeto_asc = '' or (pb_titulo_projeto_asc isnull) limit 500";
$rlt = db_query($sql);
$sqlu = "";
$ida = 0;
while ($line = db_read($rlt))
	{
	$ida++;
	$xn = uppercasesql($line['pb_titulo_projeto']);
	$id = $line['id_pb'];
	$sqlu .= "update pibic_bolsa_contempladas set pb_titulo_projeto_asc = '".$xn."' where id_pb = ".$id."; ".chr(13).chr(10);
	}
if (strlen($sqlu) > 0) { $rlt = db_query($sqlu); echo 'Atualizado '.$ida; }
////////////////////////////////////////////////////////////////////////////////////////////
$sql = "select * from pibic_professor where pp_nome_asc = '' or (pp_nome_asc isnull) limit 500";
$rlt = db_query($sql);
$sqlu = "";
$ida = 0;
while ($line = db_read($rlt))
	{
	$ida++;
	$xn = uppercasesql($line['pp_nome']);
	$id = $line['id_pp'];
	$sqlu .= "update pibic_professor set pp_nome_asc = '".$xn."' where id_pp = ".$id."; ".chr(13).chr(10);
	}
if (strlen($sqlu) > 0) { $rlt = db_query($sqlu); echo '<BR>Atualizado Professores '.$ida; }
//////////////////////////////////////////////////////////////////////////////////////////
$sql = "select * from pibic_aluno where (pa_nome_asc = '' or (pa_nome_asc isnull)) and (trim(pa_nome) <> '') limit 500";
$rlt = db_query($sql);
$sqlu = "";
$ida = 0;
while ($line = db_read($rlt))
	{
	$ida++;
	$xn = uppercasesql($line['pa_nome']);
	$id = $line['id_pa'];
	$sqlu .= "update pibic_aluno set pa_nome_asc = '".$xn."' where id_pa = ".$id."; ".chr(13).chr(10);
	}
if (strlen($sqlu) > 0) { $rlt = db_query($sqlu); echo '<BR>Atualizado Alunos '.$ida; }
//////////////////////////////////////////////////////////////////////////////////////////

if (strlen(trim($dd[50])) > 0)
	{
	$dd[50] = uppercase($dd[50]);
	$sql = "select * from pibic_bolsa_contempladas ";
	$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
	$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
	$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
	$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
	$sql .= " where ";
	if ($dd[51] == '1') { 
		$wh .= sisdoc_search($dd[50],'pp_nome_asc');
		}
	if ($dd[51] == '2') { 
		$wh .= sisdoc_search($dd[50],'pa_nome_asc');
		}
	if ($dd[51] == '3') { 
		$wh .= sisdoc_search($dd[50],'pb_titulo_projeto_asc');
		}
	if ($dd[51] == '0') 
		{ 
			$wh .= "(pb_titulo_projeto_asc like '%".$dd[50]."%')"; 
			$wh .= ' OR ';
		 	$wh .= "(pp_nome_asc like '%".$dd[50]."%')";
			$wh .= ' OR ';
		 	$wh .= "(pa_nome_asc like '%".$dd[50]."%')";
			$wh .= ' OR ';
		 	$wh .= "(pb_protocolo like '%".$dd[50]."%')";
			$wh .= ' OR ';
		 	$wh .= "(pb_protocolo_mae like '%".$dd[50]."%')";
		}
	$sql .= $wh;
	$sql .= " order by pb_ano desc ";
	$rlt = db_query($sql);
	$sr = '';
	$it = 0;
	while ($line = db_read($rlt))
		{
		require("pibic_busca_resultado.php");
		}
	$sr = realce($sr,array(trim($dd[50])));
	}
?>
<table width="100%" class="lt1" border="0" cellpadding="3" cellspacing="0">
<TR><TD></TD></TR>
<?=$sr;?>
</table>
<?
if (strlen($dd[50]) > 0)
	{
	if ($it == 0)
		{ echo '<center><h2>Nenhum resultado encontrado para <B>"'.$dd[50].'"</B></h2></center>'; } else
		{ echo '<center><h2>Total de <B>'.$it.'</B> projetos localizados com o(s) termo(s):'.$dd[50].'</h2></center>'; } 
		
	}
echo '</TABLE>';
if (strlen($sr) > 0)
	{ 
	require("foot.php");
	exit;
	}
?>