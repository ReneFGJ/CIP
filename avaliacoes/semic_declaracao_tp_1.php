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

if ($dd[50]=='DEL')
	{
	$sql = "delete from pibic_documento where doc_tipo = 'D2' ";
	$rlt = db_query($sql);
	echo '--->Deletado';
	}
	
if ($dd[91]=='XDEL')
	{
	$sql = "delete from pibic_documento where id_doc = '".sonumero($dd[90])."' ";
	$rlt = db_query($sql);
	redirecina('semic_declaracao_tp_1.php');
	echo '--->Deletado';
	}
	
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$sql = "select * from ";
$sql .= "( ";
$sql .= " select psa_p01, count(*) as total from pibic_semic_avaliador ";
//$sql .= " where psa_p05 = '".$eve."' ";
$sql .= " group by psa_p01 "; 
$sql .= ") as avaliadores";

$sql .= " left join  pareceristas  on us_codigo = psa_p01 ";
$sql .= " left join  instituicoes  on us_instituicao = inst_codigo ";
$sql .= " left join  pibic_documento on (doc_dd0 = us_codigo) and (doc_tipo = 'D2') ";
$sql .= " order by us_nome ";

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

	$sxa = '<A href="semic_declaracao_tp_1.php?dd90='.$line['id_doc'].'&dd91=XDEL">';
	$sxa .= '[Gerar nova]';
	$sxa .= '</A>';
	
	$link = 'onclick="newxy2('.chr(39).'semic_declaracao_tipo_1_email.php?dd0='.$line['us_codigo'].chr(39).',750,600);" ';
	$linkd = 'onclick="newxy2('.chr(39).trim($line['doc_arquivo']).chr(39).',750,600);" ';
	$linka = 'onclick="newxy2('.chr(39).'semic_declaracao_tipo_1.php?dd0='.$line['us_codigo'].chr(39).',750,600);" ';

	if (strlen($arq) > 0)
		{ 
		$sx .= '<TD align="right"><input type="submit" value="Enviar por e-mail" acao="acao" '.$link.'>';
		$sx .= '&nbsp;';
		$sx .= '<input type="button" value="Imprimir" acao="acao" '.$linkd.'>';
		$sx .= '<TD>'.$sxa;
		}
		else 
		{ $sx .= '<TD><input type="submit" value="Gerar declaração" acao="acao" '.$linka.'></TD>'; }

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
	}
	?>
<table width="100%">
<TR><TD>Declação por anos</TD></TR>
<TR>
<?
	for ($rx=date("Y");$rx >= 2009;$rx--)
		{
		echo '<TD>';
		echo '<A HREF="semic_declaracao_tp_1.php?dd1='.$rx.'">'.$rx.'</A>';
		echo '</TD>';
		}
?>
</TD></TR>
<TR><TD colspan="20"><HR></TD></TR>
</table>

<font class="lt5">Avaliadores que participaram em <?=$ano;?></font>
	<table width="100%">
	<TR><TD><B>Metodologia:</B>
	Gerar as declarações nos botões "Gerar declaração", será criado um arquivo em PDF que junto com o e-mail de agradecimento é encaminhado ao avaliador.
	<BR>
	Para enviar para o avaliador é necessário recarregar a tela e pressionar o botão enviar e-mail para avalidor.
	</TD></TR>
	</table>	
	<table width="100%">
	<?=$sx;?>
	</table>
	

<?
require("foot.php");
?>