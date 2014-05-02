<?
ob_start();
session_start();

require("db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require('../_class/_class_language.php');
require('../_class/_class_login_pucpr.php');
require('../_class/_class_layout.php');
$dt = new date;

$file = '../messages/msg_pt_BR.php';
if (file_exists($file)) { require($file); } else { echo 'not found! '.$file;}
$user = new user;
$user->loged();
$id_pesq = $user->cracha;
$jid = 20;
$idioma_id = 'pt_BR'; 
$submissao_aberta = true;

/* Layout */
$lay = new layout;
$lay->menu_bg_color = '#808080';
$lay->menu_bar_color = '#0000EA';
$img_cab = $lay->HeaderLogo();
?>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" type="text/css" href="../css/fieldset.css" />
	<script language="JavaScript" type="text/javascript" src="../js/jquery-1.7.1.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/jquery.corner.js"></script>		
	<title>:: CIP :: Portal do Pesquisador</title>
</head>
<style>
body
	{
	background-image: url(img/bg_index.png);
	background-repeat: repeat-x;
	background-attachment: fixed;
	font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 130%;
	}
#corpo
	{
	border: 4px solid #FFD700;
	background-color: White;
	width: 735px;
	padding-bottom: 10px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	position: absolute;
	left: 50%;
	margin-left:-365px;
	line-height: 160%;
	}

</style>
<?
/**
 * Menu do usuario
 */
$menu = array();
//array_push($menu,array('mpibic_home','index.php?dd99='));
//array_push($menu,array('mpibic_edital','index.php?dd99=edital'));
//array_push($menu,array('mpibic_faq','index.php?dd99=faq'));
//array_push($menu,array('mpibic_contact','index.php?dd99=contact'));
//array_push($menu,array('mpibic_access','submissao.php'));

array_push($menu,array('home','ativacao_bolsa_aluno.php.php'));

if (strlen($user->cracha) > 0)
	{
		array_push($menu,array('sair','../logout.php'));	
	}
$top_menu = $lay->TopMenu($menu);
?>
<div id="corpo">
	<div id="topcab"><?=$img_cab;?></div>	
	<?=$top_menu;?>
	<div id="cab_left" style="float: left"><?=$user->nome;?> [<?=$user->cracha;?>]</div>
	<div id="cab_right" style="text-align: right;"><?=$dt->stod(date("Ymd"));?> <?=date("H:i:s");?></div>		
	<BR>


