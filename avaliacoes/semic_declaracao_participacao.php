<?
require("cab.php");

require($include."sisdoc_colunas.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_debug.php");
require($include."cp2_gravar.php");


$tabela = "";
$cp = array();
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$S12','','Código do aluno',true,True,''));


?>
<table>
<TR><TD><? editar(); ?></TD></TR>
</table>
<?
if ($saved > 0)
	{
	$cod = sonumero($dd[1]);
	if (strlen($cod) == 12) { $cod = substr($cod,3,8); }
	if (strlen($cod) == 11) { $cod = substr($cod,3,8); }
	if (strlen($cod) == 9) { $cod = substr($cod,0,8); }
	
	$asql = "select * from pibic_aluno ";
	$asql .= " where pa_cracha = '".$cod."' ";
	$asql .= " limit 1 ";
	$rlt = db_query($asql);
	
	if (!($line = db_read($rlt)))
		{
			$rlt = db_query($asql);
			require("pucpr_soap_pesquisaAluno.php");
			echo "não localizado";
		} else {
		
		}
	$nome = $line['pa_nome'];
	$curso = $line['pa_cracha'];
	$curso = $line['pa_curso'];
	echo $nome;
	
	$sql = "select * from pibic_bolsas_contempladas ";
	echo $sql;
	$sql .= " limit 1 ";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	
	print_r($line);
	}
require("foot.php");
?>