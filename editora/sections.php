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

/* Ordenar */
if ($dd[1]=='SORT')
	{
		$sc->ordenar_sessoes($jid);
	}

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Se��es da revista');

$sc->row();
$tabela = $sc->tabela;
$idcp = "";
$http_edit = 'sections_ed.php';  
$editar = true;
$http_redirect = page();
$busca = true;
$offset = 40;
$pre_where = " (journal_id = ".$jid.") ";
$order  = "seq";
$tab_max = "100%";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');
echo '</table>';
echo '<A HREF="'.page().'?dd1=SORT">ordenar por referencia</A>';
echo '<BR><A HREF="sections_duplicar.php">duplicar se��es</A>';
echo '</div>';

require('foot.php');
?>