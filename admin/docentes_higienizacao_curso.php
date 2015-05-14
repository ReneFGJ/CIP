<?
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

$sql = "update pibic_professor set pp_centro = 'Curitiba' where pp_centro = 'PUC CURITIBA' ";
$rlt = db_query($sql);
$sql = "update pibic_professor set pp_centro = 'Londrina' where pp_centro = 'PUC LONDRINA' ";
$rlt = db_query($sql);
$sql = "update pibic_professor set pp_centro = 'Maringa' where pp_centro = 'PUC MARINGA' ";
$rlt = db_query($sql);
$sql = "update pibic_professor set pp_centro = 'Maringa' where pp_centro = 'Maringá' ";
$rlt = db_query($sql);
$sql = "update pibic_professor set pp_centro = 'São José dos Pinhais' where pp_centro = 'PUC SAO JOSE' ";
$rlt = db_query($sql);
$sql = "update pibic_professor set pp_centro = 'Toledo' where pp_centro = 'PUC TOLEDO' ";
$rlt = db_query($sql);


$sql = "select * from pibic_professor ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$curso = trim($line['pp_curso']);
		$zcurso = $line['pp_curso'];
		$xcurso = UpperCase(trim($line['pp_curso']));
		if ($curso != $xcurso)
			{
				$id = $line['id_pp'];
				echo '<BR>'.$curso.' - '.$xcurso;
				$sql = "update pibic_professor set pp_curso = '$xcurso' where id_pp = '$id' ";
				$xrlt = db_query($sql);				
			}
	}

//$sql = "update pibic_professor set pp_centro = 'Curitiba' where pp_centro = 'PUC CURITIBA' ";
//$rlt = db_query($sql);
//$sql = "update pibic_professor set pp_centro = 'Curitiba' where pp_centro = 'PUC CURITIBA' ";
//$rlt = db_query($sql);
//$sql = "update pibic_professor set pp_centro = 'Curitiba' where pp_centro = 'PUC CURITIBA' ";
//$rlt = db_query($sql);

	/* Dados da Classe */
	require('../_class/_class_docentes.php');

	$clx = new docentes;
	$clx->higienizacao_curso();
	
require("../foot.php");		
?> 