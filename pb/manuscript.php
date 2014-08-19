<?
require($include.'sisdoc_debug.php');
require_once($include."_class_form.php");
$form = new form;

/* Paginacao */
$pages = $_GET['pag'];
if (strlen($pages) > 0) { $pag = $pages; } else { $pag = $_COOKIE['pages']; }
if (strlen($pag)==0) { $pag = 1; }

/* ************************************ */
$proto = $_SESSION['protocol_submit'];
$author_id = $_SESSION['autor_cod'];


/* ************************************ */
require("_class/_class_manuscript.php");
$sb = new manuscript;
$sb->protocolo = $proto;
$sb->author_codigo = $author_id;

if (strlen($proto) > 0) { $dd[0] = round(substr($proto,1,6)); }

/* Position */
require("_class/_class_position.php");
$pos = new posicao;
$pages = array();
$desc  = array();

/* Botoes do menu */
echo $sb->top_menu('1');

$page = http.'pb/'.page().'/'.$path.'?dd99='.$dd[99].'&pag=';
array_push($pages,$page.'1');	array_push($desc,array(msg('man_pag_1')));
array_push($pages,$page.'2');
array_push($pages,$page.'3');
array_push($pages,$page.'4');
array_push($pages,$page.'5');
echo $pos->show($pag,count($pages),$desc,$pages);

//* ************************************ */

echo 'Protocolo: '.$proto;

$tela = $sb->submit_01($pag);

echo $tela;
?>