<? ob_start(); ?>
<?
global $nocab;
require('db.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_cookie.php');
//exit;
//require($include.'sisdoc_security.php');	

$chk = substr(md5($dd[0].$secu),0,8);
$rd_journal = $vars['journal_id'];
if (strlen($rd_journal) > 0)
	{
		setcookie('journal_id',strzero($rd_journal,7));
		setcookie('journal_title',$dd[1]);
		$journal_id = $rd_journal;
		$journal_title = $dd[1];
	} else {
		$journal_id = read_cookie("journal_id");
		$journal_title = read_cookie("journal_title");
	}
$jid = intval($journal_id);

			$sql = "select * from pareceristas  ";
			$sql .= "inner join instituicoes on us_instituicao = inst_codigo ";
			$sql .= " where id_us = 0".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
				$nome = trim($line['us_titulacao'].' '.$line['us_nome']);
				$instituicao = trim($line['inst_nome']).' ('.trim($line['inst_abreviatura']).')';;
				$email = trim($line['us_email'].' '.$line['us_email_alt']);
				$atual = $line['us_aceito'];
				if ($atual == '1') { $ss = '<TR><TD align="right">Status</TD><TD<B>Aceito como perecerista</B></TR>'; }
				if ($atual == '0') { $ss = '<TR><TD align="right">Status</TD><TD<B>Não aceitou ser perecerista</B></TR>'; }
	} else {
		exit;
	}
	
				$isql = "select * from pareceristas_area ";
				$isql .= "inner join pareceristas on us_codigo = pa_parecerista ";
				$isql .= "inner join ajax_areadoconhecimento on a_codigo = pa_area ";
				$isql .= " where id_us = ".$line['id_us'];
				$irlt = db_query($isql);
				$area = '';
				while ($iline = db_read($irlt))
					{
					$area .= $iline['a_cnpq'];
					$area .= '<B>';
					$area .= $iline['a_descricao'];
					$area .= '</B><BR>'.chr(13).chr(10);
					}	
?>
<head>
<title>PUCPR - PIBIC <?=date("Y");?></title>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>

<body bgcolor="#FFFFFF">
<TABLE width="<?=$tab_max;?>" align="center">
<TR>
<TD><img src="http://www2.pucpr.br/nep/img/logo_puc.jpg" border="0"></TD>
<TD><img src="http://www2.pucpr.br/reol/pibic/img/homeHeaderLogoImage.jpg"></TD>
</TR>
</TABLE>
<?

if ($chk != $dd[1])
	{ echo '<center><font color="red">Checksun não confere</font><BR>Voce pode entrar em contato com <BR>Patrícia Ribeiro<BR>Secretária<BR>(41) 3271-1602 ou pelo e-mail pibic@pucpr.br</center>'; exit; }
		$sql = "select * from ic_noticia ";
		$sql .= " where nw_ref = 'PAR_PAGINA' ";

		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$titulo = $line['nw_titulo'];
			$texto = troca($line['nw_descricao'],chr(13),'¢');
			}
?>

<TABLE width="<?=$tab_max;?>" align="center" class="lt1">
<TR><TD colspan="2"><?=mst($texto);?></TD></TR>
<TR><TD align="right">nome:</TD><TD class="lt2"><B><?=$nome;?></TD></TR>
<TR><TD align="right">instituição:</TD><TD class="lt2"><B><?=$instituicao;?></TD></TR>
<TR><TD align="right">áreas do conhecimento cadastradas:</TD><TD class="lt2"><B><?=$area;?></TD></TR>
<?=$ss;?>
</TABLE>
<?
if (strlen($dd[50]) > 0)
	{
		$respo = substr($dd[50],0,3);
		?>
		<BR><BR>
		<CENTER>
		<font class="lt4"><font color="green">Resposta enviada com sucesso !</font></font>
		</CENTER>
		<?
		global $email_adm, $admin_nome;
		$email_adm = "pibicpr@pucpr.br";
		$admin_nome = "PUCPR - PIBIC ".date("Y")." - Resposta do parecerista";
		$e3 = "PUCPR PIBIC ".date("Y");
		$e4 = $nome.'<BR>'.$instituicao.'<BR><BR>'.$dd[3];
		$ec1 = "rene@sisdoc.com.br";

		if ($respo == 'SIM')
			{
			$sql = "update pareceristas set us_aceito=1, us_aceito_resp=".date("Ymd")." where id_us = ".$dd[0];
			$rlt = db_query($sql);
			} else {
			$sql = "update pareceristas set us_aceito=0, us_aceito_resp=".date("Ymd")." where id_us = ".$dd[0];
			$rlt = db_query($sql);
			}
			echo '<font color="white">';
			$rsp = enviaremail($ec1,$e2,$e3,$e4); 
			$rsp = enviaremail($email_adm,$e2,$e3,$e4);
	} else {
	?>
	<TABLE width="<?=$tab_max;?>" align="center" class="lt1">
	<TR><TD><form method="post" action="parecerista_resposta.php"></TD></TR>
	<TR><TD>
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<input type="hidden" name="dd1" value="<?=$dd[1];?>">
	</TD></TR>
	<TR align="center">
	<TD><input type="submit" name="dd50" value="SIM, Aceito ser parecerista" style="width:200px; height:50px; background-color:#eaffea;"></TD>
	<TD><input type="submit" name="dd50" value="NÃO aceito ser parecerista" style="width:200px; height:50px; background-color:#fff2f2;"></TD>
	</TR>
	<TR><TD><BR><BR></TD></TR>
	<TR><TD colspan="2">
	Dúvidas, sugestões e críticas voce pode comentar abaixo:
	<textarea cols="60" rows="5" name="dd3"><?=$dd[3];?></textarea>
	</TD></TR>
	<TR><TD></form></TD></TR>
	</TABLE>	
	<?
	}
?>


