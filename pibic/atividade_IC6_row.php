<?
require_once("../_class/_class_ic_relatorio_parcial.php");
$rl = new ic_relatorio_parcial;

echo '<h1>PIBIC_EM (Jr) '.(date("Y")-1).'/'.date("Y").'</h3>';
echo '
	<h3>Entrega do Resumo Parcial</h3>
	<div id="total">
	';		
$user->cracha = $nw->user_cracha;
$ano = date("Y");

echo '<HR>';
echo $rl->lista_relatorios_pendentes_jr($user->cracha,$ano);

?>
