<?

require("../editora/_class/_class_parecer.php");
$pp = new parecer;

$tela = $pp->resumo_avaliador_pendencia($par->codigo);

$tot = $tot + $tela[0];
echo $tela[1];
?>