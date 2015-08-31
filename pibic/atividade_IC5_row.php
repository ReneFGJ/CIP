<?
require_once("../_class/_class_ic_relatorio_final.php");
$rl = new ic_relatorio_final;

echo '<h1>PIBIC/PIBITI '.(date("Y")-1).'/'.date("Y").'</h3>';
$user->cracha = $nw->user_cracha;
echo '
	<h3>Relatório Final</h3>
	<div id="total">
	';		
echo $rl->lista_correcoes_pendentes($user->cracha);
// 
?>
