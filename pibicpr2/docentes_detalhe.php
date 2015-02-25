<?
require("cab.php");
require('../_class/_class_docentes.php');
require('../_class/_class_grupo_de_pesquisa.php');
require('../_class/_class_programa_pos.php');
require('../_class/_class_pibic_bolsa_contempladas.php');

require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');

$pos = new programa_pos;
$bolsa = new pibic_bolsa_contempladas;

echo msg('docente');
$cp = new docentes;
$cp->le($dd[0]);

echo $cp->mostra_dados_pessoais();

// Grupos de Pesquisa
$gt = new grupo_de_pesquisa;
//$gt->mostra_grupos_pesquisador($cp->doc_codigo);

echo $pos->mostra_docente_programa($cp->pp_cracha);
echo $bolsa->mostra_docentes_orientacoes($cp->pp_cracha);
?>
