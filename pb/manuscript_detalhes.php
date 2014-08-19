<?
require_once($include.'sisdoc_windows.php');
require("_class/_class_manuscript.php");
$clx = new manuscript;

/* Dados da publicação */
require("../editora/_class/_class_journal.php");
$jnl = new journal;
$jid = $_SESSION['journal_id'];
$jnl->le($jid);
$send_suspende = $jnl->line['jn_send_suspense'];
$send_open = $jnl->line['jn_send'];
if ($send_suspende == 1 or $send_open == 'N')
	{ $sb = 'N'; } else { $sb = 'S'; }

$clx->author_id(0);
if (strlen($clx->author_codigo) > 0)
	{ $login = 1; }
	
echo '<h6>'.msg('SUBMIT').'</H6>';

echo '<font class="menu_title">'.msg('about_the_submission').'</font>';
echo '<BR><BR>';
	
$clx->le_submit($dd[0]);
echo $clx->mostra();

$protocolo = $clx->protocolo;
require("manuscrito_arquivo.php");

echo '<BR><BR>';
if ($sb == 'S')
	{
	echo $clx->submit_autor_acoes();
	}
echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
?>