<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');

echo '<table width=95% align=center >';
echo '<TR><TD>';

$file = '../messages/msg_'.page();
if (file_exists($file)) { require($file); }

require("../_class/_class_pibic_bolsa_contempladas.php");
$bolsa = new pibic_bolsa_contempladas;
$id = $dd[0];
if ($dd[90] != checkpost($id)) { echo 'Erro de post'; exit; }
$ok = $parecer->le($id);

echo '<HR>'.$sql.'<HR>';
$sql = "update pibic_parecer_".date("Y")." set pp_data_leitura = ".date("Ymd")." where id_pp = ".round($id);
$qrlt = db_query($sql);

$bolsa->le('',$parecer->protocolo);

echo $bolsa->mostar_dados();

/** GED **/
require_once('../_class/_class_ged.php');
$ged = new ged;

$ged->tabela = $bolsa->tabela_ged;
$ged->protocol = $bolsa->pb_protocolo_mae;
$ged->convert('pibic_ged_files','pibic_ged_documento');

$ged->tabela = $bolsa->tabela_ged;
$ged->protocol = $bolsa->pb_protocolo;
$ged->convert('pibic_ged_files','pibic_ged_documento');

$bolsa->filelist();

$comentarios = '<div style>Comentários</div><TR>';

$sp = '<HR width=70% size=1><BR>';

$form_title = '<BR><B>Ficha de Avaliação do Relatório Parcial</B>';
/** Campos do formulario **/
require('avaliacao_pibic_cp.php');

echo '<TR><TD>'.msg('avaliador_info');
echo '<TR><TD align=center class=lt5>'.$form_title;
echo '<TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
		redirecina('pibic_avaliado.php?dd0='.$dd[0].'&dd90='.$dd[90]);
	}
?>
