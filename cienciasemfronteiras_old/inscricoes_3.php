<?php
$include = '../';

require("../db.php");
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

require("../_class/_class_message.php");
require('../messages/msg_pt_BR.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_windows.php');
/**
* Submissao de projeto parametrizado
* @author Rene F. Gabriel Junior <rene@sisdoc.com.br>
* @version 1.0m
* @copyright Copyright - 2012, Rene F. Gabriel Junior.
* @access public
* @package CEP
* @subpackage submit
*/
$login = 1;
require('../_class/_class_discentes.php');



require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

$dis = new discentes;
if ($dis->valida())
	{
		echo '';
	} else {
		echo 'não validado';
		redirecina('inscricoes.php');
	}
$dd[1] = $dis->pa_codigo;

require('_ged_config_csf_documentos.php');
$ddg = $_GET['ddg'];
$ddf = round($_GET['ddf']);
if ($ddg='DEL')
	{
		$ged->id_doc = $ddf;
		$ged->file_delete();
	}

?>
<!DOCTYPE html>
<html>
    <head>
    	<title>Inscrição - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Inscr<span class="lt6light">ição</span></h1>
			
<?
require('../_class/_class_fomento.php');
$fom = new fomento;

require('../_class/_class_csf.php');
$csf = new csf;


/* Sessao e pagina da Submissao */
echo '<div>';
echo '<Table width="'.$tab_max.'" class="lt1" align="center" >';
echo '<TR><TD>';
echo utf8_encode(msg("inscricoes_instrucoes"));
echo '</table>';

echo utf8_encode($dis->mostra_dados_pessoais());
echo '<BR><BR>';

$edit_mode = $_SESSION['editmode'];

echo '<h2>Anexar documentos</h2>';
require($include.'sisdoc_debug.php');

echo utf8_encode($ged->file_list());
echo utf8_encode($ged->file_attach_form());

$total = $ged->total_files;

if ($total == 0)
	{
		echo '<h1><font color="red">O histórico escolar é obrigatório</font></h1>';
		echo '<font color="red">Anexar o comprovante do teste de idioma se estiver disponível</font>';
	} else {
		echo '<form action="inscricao-finalizada-sucesso.php">';
		echo '<input type="submit" value="Finalizar inscrição >>" style="font-size: 20px;">';
		echo '<form>';
	}
echo '</div>';
echo '</div>';

require("footer.php");
?>
<script>
	$("#content").corner();
	
</script>
</body>
</html>
