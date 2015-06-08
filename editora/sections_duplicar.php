<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require("_class/_class_journal.php");
$jl = new journal;

require("include_journal.php");
require("_class/_class_secoes.php");
$sc = new secoes;

require($include.'_class_form.php');
$form = new form;

$cp = array();

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Seções da revista');

array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$Q title:journal_id:select * from journals order by title','','',True,True));
array_push($cp,array('$O : &1:SIM&0:NÃO','','Excluir Anteriores',True,True));

$tela = $form->editar($cp,'');
if ($form->saved > 0)
	{
		$jid1 = $jid;
		$jid2 = $dd[1];
		$sc->duplicar_section($jid2,$jid1,$dd[2]);
	} else {
		echo $tela;
	}
require('foot.php');
?>