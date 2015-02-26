<? ob_start(); ?>
<?
global $nocab;
require('db.php');
require($include.'sisdoc_security.php');
require($include.'sisdoc_onekey.php');
$http_site = 'http://www2.pucpr.br/reol/pibicpr/';

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
security();
$jid = intval($journal_id);
?><title><?=$site_titulo?></title>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />