<?
require_once($include."sisdoc_form2.php");

$bb1="g r a v a r";
$msgnews = '<B>Aviso via email</B><BR>';
$msgnews = $msgnews . 'Inscreva-se para receber um aviso via email das notícias a cada nova publicação.';
$msgnews = $msgnews . '<P>';
$msgnews = $msgnews . '<B>Declaração de privacidade</B><BR>';
$msgnews = $msgnews . 'Os nomes e endereços submetidos serão usados exclusivamente nos serviços prestados por esta publicação, e não serão disponibilizados à terceiros';
$msgnews = $msgnews . '<P>&nbsp;';

if ($idioma == "2")
	{
	$bb1=" s u b m i t ";
	$msgnews = '<B>Alert by e-mail</B><BR>';
	$msgnews = $msgnews . 'Assign to recive an alert by e-mail about our news publications.';
	$msgnews = $msgnews . '<P>';
	$msgnews = $msgnews . '<B>Declaration of privacy</B><BR>';
	$msgnews = $msgnews . 'The names and submitted addresses will be used exclusively in the services rendered by this publication, and they won´t be supplied to the third';
	$msgnews = $msgnews . '<P>&nbsp;';
	}
	
if (strlen($body_size) == 0) { $body_size = "704"; }
?>
<TABLE width="704" class="ed">
<TR><TD colspan="2" class="lt2">
<?
	echo CharE($msgnews);
	$tabela = "users";
?>
</TD></TR>
<?
require("include/cp_comunicacao.php");
$errc='ERR:';
if (isset($acao))
	{ 
	$err='';
	$errc=+'1.';
	if (isset($dd[5]) and (strlen(trim($dd[5])) >0))
		{
		$errc=+'2.';
		$sql = "select * from users where email='".trim($dd[5])."' and journal_id = '".$jid."'";
		$result = db_query($sql);
		if ($line = db_read($result))
			{
			$errc=+'4.';
			$err = 'Este e-mail já esta incluido no sistema';
			$saved = 1;
			}
		else
			{
			$errc=+'Cadastro efetuado com sucesso!';
			require('include/cp_gravar.php');
			}
		if ($saved > 0)
			{
			require('comunicacao_agradece.php');
			return;	
			}
		} else { 
			$errc=+'5.';
			$err = "Campos em vermelho são obrigatórios"; 
		}
	}
?>
<FORM method="post" action="<?=$path?>">
<input type="hidden" name="dd99" value="comunicate">
	<?
	require('include/cp_gets.php');
	?>
<TR><TD></TD><TD><input type="submit" name="acao" value="<?=$bb1?>" <?=estilo?>></TD></TR>
</TABLE>
<?
if (isset($err))
	{
	?>
	<TABLE width="710" class="lt2" align="center"><TR><TD><FONT COLOR=RED><?=CharE($err.' '.$errc)?></FONT></TD></TR></TR></TABLE>
	<?
	}
?>
</FORM>