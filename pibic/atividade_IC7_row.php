<?
require_once("../_class/_class_ic_relatorio_parcial.php");
$rl = new ic_relatorio_parcial;

$tela =  '
	<font class="lt4">Entrega da Correção dos Relatórios Parciais</font>
	<div id="total">
	';	

	$user->cracha = $nw->user_cracha;

$file = "__submit_RPAC.php";
$open = 0;
if (file_exists($file)) { require($file); }

if ($open == 1)
	{
							
		$tela .= $rl->lista_relatorios_pendentes_correcoes($user->cracha);
		
		if ($rl->total > 0) 
			{ echo $tela; }
		else 
			{
				//echo '<font class="lt3" color="red">Nenum relatório pendente</font>'; 
			}
	} else {
		if ($open == 1)
			{
			echo '<h1>Relatório Parcial - Correção</h2>';
			echo '<font color="red" class="lt4">Prazo encerrado!</font>';
			}
	}

?>

