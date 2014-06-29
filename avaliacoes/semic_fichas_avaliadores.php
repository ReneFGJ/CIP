<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_windows.php");
$eve = $dd[1];
if ($eve == 'SEMIC') { $eve = "SEMIC19"; }
if ($eve == 'MP') { $eve = "MP13"; }
echo '<center>';

$sql = "update pibic_semic_avaliador set  psa_p04 = 'HIS' ";
$sql .= " where psa_p04 = 'HI' and psa_p05 = 'SEMIC19'";
//$rlt = db_query($sql);



$sql = "select * from ";
$sql .= "( ";
$sql .= " select psa_p01, count(*) as total from pibic_semic_avaliador ";
$sql .= " where psa_p05 = '".$eve."' ";
$sql .= " group by psa_p01 "; 
$sql .= ") as avaliadores";

$sql .= " left join  pareceristas  on us_codigo = psa_p01 ";
$sql .= " left join  instituicoes  on us_instituicao = inst_codigo ";
$sql .= " order by us_nome ";

$rlt = db_query($sql);
$tot = 0;
while ($line = db_read($rlt))
	{
	$tot++;
//	print_r($line);
//	echo '<HR>';
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
	
	$link = 'onclick="newxy2('.chr(39).'ficha_avaliacao.php?dd10='.$eve.'&dd1='.$line['us_codigo'].chr(39).',750,600);" ';
	$sx .= '<TD><input type="submit" value="Imprimir ficha de avaliação" acao="acao" '.$link.'></TD>';

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

<font class="lt5">Fichas de Avaliação do(a) <?=$eve;?></font>
	<table width="<?=$tab_max;?>">
	<TR><TD><B>Metodologia:</B>
	Gerar as declarações nos botões "Gerar declaração", será criado um arquivo em PDF que junto com o e-mail de agradecimento é encaminhado ao avaliador.
	<BR>
	Para enviar para o avaliador é necessário recarregar a tela e pressionar o botão enviar e-mail para avalidor.
	</TD></TR>
	</table>	
	<table width="<?=$tab_max;?>" class="lt1">
	<?=$sx;?>
	<TR><TD colspan="2">Total de avaliadores: <?=$tot;?> </TD></TR>
	</table>
	

<?
require("foot.php");
?>