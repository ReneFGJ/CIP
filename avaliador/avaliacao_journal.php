<?php
require("cab.php");
//require($include.'sisdoc_form2.php');
//require($include.'cp2_gravar.php');
require($include.'_class_form.php');
$form = new form;

require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

echo '<table width=95% align=center >';
echo '<TR><TD>';

$file = '../messages/msg_'.page();
if (file_exists($file)) { require($file); }

require("../_class/_class_submit_article.php");
$submit = new submit;

$id = $dd[0];
if ($dd[90] != checkpost($id)) { echo 'Erro de post'; exit; }
$ok = $parecer_journal->le($id);

//$sql = "update pibic_parecer_2011 set pp_data_leitura = ".date("Ymd")." where id_pp = ".round($id);
//$qrlt = db_query($sql);

$id = $parecer_journal->protocolo;

$submit->le('',$parecer_journal->protocolo);
echo $submit->mostra_dados();

/** GED **/
require_once('../_class/_class_ged.php');
$ged = new ged;

//$bolsa->filelist();
$comentarios = '<div style>Comentários</div><TR>';

$sp = '<HR width=70% size=1><BR>';

$form_title = '<BR><B>Ficha de Avaliação de Trabalho de Pesquisa</B>';

/** Tabela **/
$tabela = $parecer->tabela;

/** Campos do formulario **/
$cp = $parecer_journal->parecer_cp_modelo();

echo '<TR><TD>'.msg('avaliador_info');

$tabela = 'reol_parecer_enviado';
$tela = $form->editar($cp,$tabela);
echo '<h1>EM MANUTENÇÃO</H1>';
exit;
if ($saved > 0)
	{
		redirecina('pibic_avaliado.php?dd0='.$dd[0].'&dd90='.$dd[90]);
	} else {
		echo $tela;
	}
?>
