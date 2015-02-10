<?
require_once ($include . 'sisdoc_windows.php');

require ("_class/_class_manuscript.php");
$sbm = new manuscript;

require ("_class/_class_submit.php");
$clx = new submit;

$linke = $pb -> submission_link;
if (strlen($linke) > 0)
	{
		redirecina($linke);
		exit;
	}
/* Dados da publicação */
require ("../editora/_class/_class_journal.php");
$jnl = new journal;
$jid = $_SESSION['journal_id'];
$jnl -> le($jid);
$send_suspende = $jnl -> line['jn_send_suspense'];
$send_open = $jnl -> line['jn_send'];
if ($send_suspende == 1 or $send_open == 'N') { $sb = 'N';
	$sbs = '1';
} else { $sb = 'S';
	$sbs = '0';
}

/* Protocolo */
$_SESSION['protocol_submit'] = '';

$clx -> author_id(0);
if (strlen($clx -> author_codigo) > 0) { $login = 1;
}

/*
 */
$sbm -> set_journal($jid);
$sbm -> set_autor($clx -> author_codigo);

if ($login == 0) {
	$page = http . 'pb/index.php/' . $path . '?dd99=submit';
	echo '<img src="' . http . '/img/logo_reol_20_' . $LANG . '.png" align="right" height="60">';
	echo $clx -> autor_login_form($page);
} else {
	//echo $clx->top_menu();
	//echo '<BR><BR>';
	//$clx->le_autor($clx->author_codigo);

	/* Top Menu */
	echo $sbm -> top_menu($sbs);

	/* Título da página */
	echo '<BR>';
	echo '<font class="menu_title">' . msg('submission') . '</font>';
	echo '<BR><BR><BR>';

	$page = http . 'pb/index.php/' . $path . '?dd99=submit_myaccount';
	echo $clx -> mostra_autor($page);

	/* texto informativo */
	$txt = 'smbt_' . strzero($jid, 4);
	if ($txt == msg($txt)) { $txt = '';
	} else {
		$txt = msg($txt);
	}
	echo($txt);

	$link = http . 'pb/index.php/' . $path . '?';

	echo '<h1>' . msg('resume_submission') . '</h1>';
	echo $sbm -> resume();

	$http = 'http://www2.pucpr.br/reol/';
	$link = $http . 'pb/index.php/' . $path . '?dd99=submit_resume';
	//echo $sbm->resumo($link);

	/* Botao novo projeto */
	if ($sb == 'S') {
		echo $sbm -> form_new_project($link);
	}

	echo '<BR><BR><BR><BR><BR><BR><BR><BR>';
}
?>