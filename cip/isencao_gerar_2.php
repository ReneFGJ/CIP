<?php
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_email.php');

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

echo '1';
require_once("../_class/_class_captacao.php");
$cap = new captacao;
$id = $dd[3];
$cap->le($id);
echo '2';
require("../_class/_class_docentes.php");
$doc = new docentes;
$doc->le($cap->professor);
echo '3';
echo $doc->mostra_dados();
echo $cap->mostra();

echo '<H2>Gerar Isenção</h2>';
/* Identificar vinculo */

$cp = array();
$dd[4]=$dd[3];
array_push($cp,array('$H8','','',False,Ture));
array_push($cp,array('$H8','','',False,Ture));
array_push($cp,array('$H8','','',True,Ture));
array_push($cp,array('$H8','','',True,Ture));
array_push($cp,array('$Q ca_descricao:ca_protocolo:select * from captacao where ca_protocolo=\''.$dd[4].'\' and ca_professor='.chr(39).$dd[2].chr(39).' order by ca_vigencia_ini_ano','','Vinculos ao projeto',True,Ture));
array_push($cp,array('$HV','','1',False,Ture));
array_push($cp,array('$B8','','Confirmar ativação da Isenção >>>',False,Ture));
echo '<table><TR><TD>';
editar();
echo '</table>';
if ($saved > 0)
	{
	require("../_class/_class_bonificacao.php");
	$bon = new bonificacao;
	$bon->updatex();
	$professor = $dd[2];
	$protocolo = $dd[3];
	echo '<BR>'.date("d/m/Y H:i:s").' Gerando isenção '.$professor.' '.$protocolo;
	$er = $bon->isencao_projeto_ativar($professor,$protocolo);
	echo '<BR>'.date("d/m/Y H:i:s").' Registrando histórico';
	echo '<BR>'.date("d/m/Y H:i:s").' '.$bon->erro;
	if ($er == 1)
		{
		require("_email.php");
		$bon->isencao_produtividade_comunicar_pesquisador($bon);
		echo '<BR>'.date("d/m/Y H:i:s").' enviado email';
		echo '<BR>'.date("d/m/Y H:i:s").' Finalizado Isenção';
		}
	echo '<form action="index.php"><input type="submit" value="voltar"></form>';
	}

require("../foot.php");
?>
