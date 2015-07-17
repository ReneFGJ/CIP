<?
$breadcrumbs=array();
require("cab_cnpq.php");
$ano = '2014';
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$moda = $dd[0];
switch ($moda)
	{
		case 'PIBIC': $modalidade = '<font color="blue">PIBIC'; $logo = 'img_pibic.jpg'; break; 
		case 'PIBICE': $modalidade = '<font color="blue">PIBIC_<font color="orange">EM</font> (Jr)';  $logo = 'img_pibice.jpg';break; 
		case 'CSF': $modalidade = '<font color="green">Ci�ncia sem Fronteiras</font>';  $logo = 'img_csf.jpg';break; 
		case 'PIBITI': $modalidade = '<font color="BROWN">PIBITI</font>';  $logo = 'img_pibiti.jpg';break; 
	}
/////////////////////////////////////////////////// MANAGERS

echo '<img src="../img/'.$logo.'" align="right">';
echo '<h1>Inicia��o Cient�fica da PUCPR</h1>';
echo '<h3>'.$moda.' - PUCPR</h3>';
$ano = $dd[1];
if (strlen($ano) == 0)
	{
		$ano = date("Y");
	}
$menu = array();

if (date("m") >= 10)
	{
		array_push($menu,array('SEMIC','Site do SEMIC','http://www.pucpr.br/semic" target="_new'));
		array_push($menu,array('SEMIC','Trabalhos apresentados no SEMIC','semic_trabalhos.php?dd1='.$moda));
		array_push($menu,array('SEMIC','Avalia��o dos trabalhos','semic_notas.php'));
		array_push($menu,array('SEMIC','Vinculos Protocolos / SEMIC','semic_apresentacao.php'));		
	} else {
		if ($moda == 'PIBITI')
			{
				array_push($menu,array('Edital de aprova��o','Aprovados com bolsa CNPq','edital.php?dd0=B&dd1='.$moda.'&dd2='.date("Y")));		
			} else {
				if ($moda == 'PIBICE') {
					array_push($menu,array('Edital de aprova��o','Aprovados com bolsa CNPq','edital.php?dd0=H&dd1='.$moda.'&dd2='.date("Y")));	
				} else {
					array_push($menu,array('Edital de aprova��o','Aprovados com bolsa CNPq','edital.php?dd0=C&dd1='.$moda.'&dd2='.date("Y")));
				}
				
			}
		array_push($menu,array('Edital de aprova��o','Rela��o dos projetos submetidos em '.$ano,'edital.php?dd0=&dd1='.$moda.'&dd2='.date("Y")));
		array_push($menu,array('Edital de aprova��o','Projetos n�o aprovados','edital.php?dd0=R&dd1='.$moda.'&dd2='.date("Y")));		
	}
array_push($menu,array('Avaliadores','Lista de avaliadores e avalia��es','semic_avaliadores.php'));
array_push($menu,array('Avaliadores','Notas dos avaliadores','semic_avaliadores_2.php'));
echo menus($menu,"3");

require("../foot.php");	
?>