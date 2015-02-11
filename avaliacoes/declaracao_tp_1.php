<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_debug.php");
$ano = date("Y");
echo '<center>';
if (strlen($dd[1]) > 0) 
	{
	$ano = $dd[1];
	}

$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

if ($dd[50]=='DEL')
	{
	$sql = "delete from pibic_documento where doc_tipo = 'D1' and doc_ano = '".$ano."' ";
	$rlt = db_query($sql);
	}
	
$sql = "select * from (";
$sql .= "select count(*) as total, pp_avaliador as cod  ";
$sql .= " from pibic_parecer ";
$sql .= " where pp_status='B' ";
$sql .= " and pp_parecer_data >= ".$ano."0101 ";
$sql .= " and pp_parecer_data <= ".$ano."9999 ";
$sql .= " group by pp_avaliador ";
$sql .= " ) as tabela ";
$sql .= " inner join  pareceristas  on us_codigo = cod ";
$sql .= " inner join  instituicao  on us_instituicao = inst_codigo ";
$sql .= " left join  pibic_documento  on doc_dd0 = us_codigo and doc_tipo = 'D1' and doc_ano = '".$ano."' ";
//$sql .= " where inst_abreviatura != 'PUCPR (c)' ";


//$sql .= " and doc_ano = '".date("Y")."' ";
$sql .= " order by us_nome ";

//$sql = "select * from pibic_parecer order by id_pp desc limit 30 ";

$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
//	print_r($line);
//	exit;
	$arq = trim($line['doc_arquivo']);
		
		if (trim($line['inst_abreviatura']) == 'PUCPR (c)')
		{
			$pucpr++;
		} else {
			$epucpr++;
		}
	//////////////////////////////////////////////////////////////
	if (strlen(trim($line['us_bolsista'])) > 3) { 
		$prod++ ; 
		if (trim($line['inst_abreviatura']) != 'PUCPR (c)')
			{ $eprod++;}
		}
	$tot++;
	$sto = $sto + $line['total'];
	
	$sx .= '<TR><TD colspan="10" height="1" bgcolor="#c0c0c0"></TD></TR>';
	$col = coluna();
	$sx .= '<TR '.$col.'>';
	$sx .= '<TD>';
	$sx .= trim($line['us_titulacao']);

	$sx .= '<TD>';
	$sx .= trim($line['us_nome']);
	
	$sx .= '<TD>';
	$sx .= trim($line['inst_abreviatura']);
	
	$sx .= '<TD align="center">';
	$sx .= trim($line['total']);

	$sx .= '<TD align="center">';
	$sx .= trim($line['us_bolsista']);
	
	$link = 'onclick="newxy2('.chr(39).'semic_declaracao_tipo_1.php?dd0='.$line['us_codigo'].chr(39).',750,600);" ';
	
	if (strlen($arq) > 0)
		{ $sx .= '<TD><input type="submit" value="Enviar por e-mail" acao="acao" '.$link.'></TD>';}
		else 
		{ $sx .= '<TD><input type="submit" value="Gerar declaração" acao="acao" '.$link.'></TD>'; }

	$sx .= '<TR '.$col.'>';
	$sx .= '<TD>';
	$sx .= '<TD colspan="5">';
	$email = trim($line['us_email']);
	$sx .= '<A HREF="mailto:'.$email.'"><font class="lt0">'.$email.'</A>';

	$email = trim($line['us_email_alternativo']);
	if (strlen($email) > 0) 
		{ 
		$sx .= ', <A HREF="mailto:'.$email.'"><font class="lt0">'.$email.'</A>';
		}

	$sx .= '</TR>';
	
	if (strlen($arq) > 0)
		{
		$sx .= '<TR><TD></TD><TD colspan="5" align="right">';
		$sx .= '<P onclick="newxy('.chr(39).$arq.chr(39).',750,600);">';
		$sx .= 'Download da Declaração';
		$sx .= '</P>';
		$sx .= '</TD></TR>';
		}
	}
	?>
<table width="<?=$tab_max;?>">
<TR><TD>Declação por anos</TD></TR>
<TR>
<?
	for ($rx=date("Y");$rx >= 2009;$rx--)
		{
		echo '<TD>';
		echo '<A HREF="declaracao_tp_1.php?dd1='.$rx.'">'.$rx.'</A>';
		echo '</TD>';
		}
?>
</TD></TR>
<TR><TD colspan="20"><HR></TD></TR>
</table>

<font class="lt5">Avaliadores que participaram em <?=$ano;?></font>
	<table width="<?=$tab_max;?>">
	<TR><TD><B>Metodologia:</B>
	Gerar as declarações nos botões "Gerar declaração", será criado um arquivo em PDF que junto com o e-mail de agradecimento é encaminhado ao avaliador.
	<BR>
	Para enviar para o avaliador é necessário recarregar a tela e pressionar o botão enviar e-mail para avalidor.
	</TD></TR>
	</table>	
	<table width="<?=$tab_max;?>">
	<?=$sx;?>
	</table>
	

<?
require("foot.php");
?>