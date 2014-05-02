<?
require_once("../_class/_class_ic_relatorio_final.php");
$rl = new ic_relatorio_final;

echo '<h1>PIBIC/PIBITI '.(date("Y")-1).'/'.date("Y").'</h3>';
echo '
	<h3>Entrega do Resumo</h3>
	<div id="total">
	';		
$user->cracha = $nw->user_cracha;
echo $rl->lista_resumos_pendentes($user->cracha);

?>
