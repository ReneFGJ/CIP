<?
require("cab.php");
require('../_class/_class_discentes.php');
require('../_class/_class_grupo_de_pesquisa.php');
require('../_class/_class_programa_pos.php');
require('../_class/_class_pibic_bolsa_contempladas.php');
require('../_class/_class_lattes.php');

require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');

$pos = new programa_pos;
$bolsa = new pibic_bolsa_contempladas;
$lattes = new lattes;

echo msg('discentes');
$cp = new discentes;
$cp->le($dd[0]);

echo $cp->mostra_dados_pessoais();



// Grupos de Pesquisa
$gt = new grupo_de_pesquisa;
//$gt->mostra_grupos_pesquisador($cp->doc_codigo);
//echo $pos->mostra_docentes_orientacoes($cp->pp_cracha);
//echo $bolsa->mostra_docentes_orientacoes($cp->pp_cracha);

echo $lattes->mostra_lattes_producao($cp->pa_cracha);
?>
