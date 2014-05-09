<?
$breadcrumbs=array();
require("cab_bi.php");
require("../_class/_class_infografico.php");
$gr = new graphic;
require("../_class/_class_indicadores.php");
$indi = new indicador;

$dados = array();
array_push($dados,array('CNPq',94,''));
array_push($dados,array('Fundação Araucária',145,''));
array_push($dados,array('PUCPR',325,''));
array_push($dados,array('Inclusão Social FA',42,''));
//array_push($dados,array('AG-PUC',15,''));
array_push($dados,array('IC Volutária',313,''));
$title = 'Bolsas 2012/2013';
$texto = 'Bolsas PIBIC vigentes no periodo de ago./2012 ate jul./2013.';
echo $gr->gr_bolinhas($dados,$title,$texto);

$dados = array();
array_push($dados,array('CNPq',38,''));
array_push($dados,array('PUCPR',25,''));
array_push($dados,array('Agência PUC',25,''));
array_push($dados,array('Inclusão Social FA',8,''));
array_push($dados,array('ICT Volutária',22,''));
$title = 'Bolsas 2013/2014';
$texto = 'Bolsas PIBITI vigentes no periodo de ago./2013 ate jul./2014.';
echo $gr->gr_bolinhas($dados,$title,$texto);

$dados = array();
array_push($dados,array('CNPq',35,''));
array_push($dados,array('PUCPR',45,''));
$title = 'Bolsas 2012/2013';
$texto = 'Bolsas PIBIC_EM (Jr) vigentes no periodo de ago./2012 ate jul./2013.';
echo $gr->gr_bolinhas($dados,$title,$texto);

require("../foot.php");	
?>