<?
require("cab.php");

echo $hd->menu();
echo '<div id="conteudo">';
	echo $hd->main_content('Cor de fundo');

require($include."_class_form.php");
$form = new form;

require("_class/_class_journal.php");
$jl = new journal;
$jl->le($jid);
$dd[0] = $jid;

echo $jl->mostra();

$cp = array();
$tabela = "journals";
array_push($cp,array('$H8','journal_id','',False,True));

//$sql = "alter table ".$tabela." add column js_send_link char(200)";
//$rlt = db_query($sql);

array_push($cp,array('$O : &S:SIM&N:NÃO','jn_send','Habilitado submissão de trabalhos',True,True));
array_push($cp,array('$O : &0:NÃO&1:SIM','jn_send_suspense','Submissão suspensa',True,True));
array_push($cp,array('$S100','js_send_link','Link para submissão (Scielo/Scholar One)(opcional)',False,True));

$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		redirecina('personalizar.php');
	} else {
		echo $tela;
	}

require("foot.php");
?>
