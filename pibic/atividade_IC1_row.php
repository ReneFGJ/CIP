<?
require("../_class/_class_ic_relatorio_parcial.php");
$rl = new ic_relatorio_parcial;

echo '<h1>Inicia��o Cient�fica e Tecnol�gica - '.(date("Y")-1).'/'.date("Y").'</h3>';
echo '<font class="lt4">Entrega dos Relat�rios Parciais</font>';

$tela =  '<div id="total">';	

	$user->cracha = $nw->user_cracha;

$prazo_rp = 20140210;
$file = "__submit_RPAR.php";
$open = 0;
if (file_exists($file))
	{ require($file); }
if ($open == 1)
	{					
		$tela .= $rl->lista_relatorios_pendentes($user->cracha);

		if ($rl->total > 0) { echo $tela; }
		else {
			{echo '<font class="lt3" color="red">Nenum relat�rio pendente</font>'; }
		}
	} else {
		if (date("m") < 3)
			{
			//echo ' - <font color="red" class="lt4">Prazo encerrado!</font>';
			}
	}

echo '</div>';
echo '<HR>';
?>

