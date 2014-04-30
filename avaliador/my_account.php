<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');


$file = '../messages/msg_'.page();
if (file_exists($file)) { require($file); }

echo '<h1>Meus dados</h1>';
$edit = 1;
echo '<div id="Instruções" style="text-align: left; padding:20px 20px 20px 20px; ">';
echo msg('areas_instructions');
echo '</div>';

$userp_cod = $_SESSION['userp_cod'];
$par->le($userp_cod);
if (strlen($userp_cod) == 8)
	{
		$prof_pucpr = 1;
	} else {
		$prof_pucpr = 0;
	}

if ($prof_pucpr == 1)
	{
		require($include.'sisdoc_debug.php');
		require('../_class/_class_docentes.php');
		$prof = new docentes;
		$prof->le($userp_cod);
		echo $prof->mostra();
	} else {
		echo $par->mostra_dados_grande();		
	}


if ($par->status == 19)
	{
	if ($dd[3]=='AXA')
		{
			$par->alterar_status_avaliador($par->id,$dd[2]);			
			redirecina(page());
		}
	echo $par->aceitar_avalicao();
	exit;
	}
if ($par->status == 9)
	{
		echo '<h1><font color="red">Convite recusado</font></h1>';
	}

echo '<div id="areascadastradas">';
//echo $par->mostra_dados();
echo '</div>';
if ($dd[12]=='DEL')
{
	$sx .= $par->area_excluir($dd[10]);
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=my_account.php">';
	echo $sx;
	exit;
}

if ($edit == 1)
	{
		$sx .= 'Novas áreas';
		$sx .= $par->areas_novas();
		echo $sx;
	}
?>
<script>
$.ajax({
  url: "my_account_area.php",
  cache: false
}).done(function( html ) {
  $("#areascadastradas").append(html);
});
</script>
