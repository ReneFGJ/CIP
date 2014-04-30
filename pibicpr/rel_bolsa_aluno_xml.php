<?

$export = $_GET["dd1"];
if (strlen($export) > 0)
	{
	$include = '../';
	require("../db.php");
	} else {
	require("cab.php");	
	}
require($include."sisdoc_data.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

if ($dd[1]=='XLS')
{
 $file='relatorio de pibic - aluno - bolsa '.date("d-m-Y").'.xls';
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=".$file );
  header('Pragma: no-cache');
  header('Expires: 0');
  echo $pb->relatorio_bolsas();
} else {
	echo '<A HREF="'.page().'?dd1=XLS">Versão para Excel</A>';
	echo $pb->relatorio_bolsas();
	
	require("../foot.php");	
}

	
?>