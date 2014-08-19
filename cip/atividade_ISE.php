<?
require("cab_cip.php");
require_once($include.'sisdoc_email.php');
require_once($include.'sisdoc_data.php');
require_once($include.'sisdoc_windows.php');
require_once($include.'sisdoc_pdf.php');

require_once("_ged_bonificacao_ged_documento.php");

require_once("../_class/_class_docentes.php");
$doc = new docentes;

require_once("../_class/_class_bonificacao.php");
$bon = new bonificacao;

require_once("../_class/_class_position.php");
$pos = new posicao;

require_once("../_class/_class_captacao.php");
$cap = new captacao;

//echo '<h2>Em construção</h2>';
$bon->le($dd[0]);

$proto = $bon->protocolo;
$proto2 = $bon->origem_protocolo;

$cap->le($proto2);
		//$sql = "delete from ".$bon->tabela." where id_bn = 78 ";
		//$rlt = db_query($sql);

if ($bon->origem_tipo = 'IPR')
	{
		if ($bon->status == '!')
			{
				require("atividade_ISE_01.php");
			}		
		if ($bon->status == '*')
			{
				echo '<center>Já foi informado estudante para isenção</center>';
			}
	}
echo $cap->mostra($cap);	
echo '</table>';
require('../foot.php');
?>

