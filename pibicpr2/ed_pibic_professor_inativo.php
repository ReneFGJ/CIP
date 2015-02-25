<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');
$label = "Cadastro de rotinas do sistema";

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

//$sql = "ALTER TABLE pibic_professor ADD COLUMN pp_update char(4); ";
//$rlt = db_query($sql);;
$cp = array($cp,array('$H8','','',False,True));
$cp = array($cp,array('$[2011-'.date("Y").']','','Ano',False,True));

echo '<table>';
echo '<TR><TD>Desativar todos os professores cujo ano de atualização seja diferente do informado.';
editar();
echo '</table>';

if ($saved > 0)
	{
	$sql = "update pibic_professor set pp_ativo = 0 where pp_update <> '".$dd[1]."' ";
	$rlt = db_query($sql);
	echo '<BR><BR><Font color="green">Atualização realizada com sucesso !';
	}



require("foot.php");	
?>