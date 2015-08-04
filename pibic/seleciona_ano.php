<?
require ("cab.php");

require ("../_class/_class_pibic_bolsa_contempladas.php");

$pb = new pibic_bolsa_contempladas;

require ($include . 'sisdoc_form2.php');
require ($include . 'cp2_gravar.php');







//$cp = array();
$ano = date("Y");

array_push($cp, array('$[2000-' . date("Y") . ']', '', 'Ano para consulta', False, True, ''));
    
    ?><TABLE width="<?=$tab_max?>" align="left"><TR><TD><? editar(); ?></TD></TR></TABLE><?


echo $pb -> rel_aluno_com_bolsa_duplicada($cp[1]);
 
echo $hd -> foot();
?>