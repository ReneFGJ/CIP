<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include.'sisdoc_security_post.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');	
require($include.'cp2_gravar.php');

require('../_class/_class_parecer_pibic.php');
$pb = new parecer_pibic;

$tabela = "";
$cp = array();
array_push($cp,array('$O : &S:SIM','','Confirmar operação de gerar Edital',True,True,''));
array_push($cp,array('$[2013-'.date("Y").']','','Ano Edital',True,True,''));
?>
<H2>Gerar dados para montagem do Edital</H2>
<TABLE width="98%" align="center" border="1">
<TR><TD>
<?
echo $msc;
echo '<TR><TD>';
editar();
?></TD></TR></TABLE><?	

if ($saved < 1) { require('foot.php'); exit; }
$pb->tabela = 'pibic_parecer_'.$dd[1];
$pb->calcula_edital_avaliacoes($dd[1]);
require("foot.php");	?>
