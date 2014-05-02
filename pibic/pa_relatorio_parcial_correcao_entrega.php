<?
require("cab.php");

require($include.'sisdoc_message.php');
require($include.'sisdoc_debug.php');
//require($include.'sisdoc_data.php');

require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_windows.php');

require("../_class/_class_pibic_bolsa_contempladas.php");

	/* Mensagens */
	$tabela = 'pa_relatorio_parcial_entrega';
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
/* checa post */
$dd1 = $dd[1];
if (checkpost($dd1) != $dd[90])
	{
		echo msg_erro('Erro de checagem de envio de dados.');
		exit;
	}
$pb = new pibic_bolsa_contempladas;
$pb->le('',$dd1);
echo "<table width='".$tab_max."'>";
echo '<TR><TH colspan=2>'.msg('post_rel_parcial');

echo '<TR><TD>';
echo $pb->mostar_dados();

echo $pb->bolsa_relatorio_parcial_correcao_entrega();
echo '</table>';

require("foot.php");
?>
