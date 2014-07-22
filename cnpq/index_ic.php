<?
$breadcrumbs=array();
require("cab_cnpq.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$moda = $dd[0];
switch ($moda)
	{
		case 'PIBIC': $modalidade = '<font color="blue">PIBIC'; $logo = 'img_pibic.jpg'; break; 
		case 'PIBICE': $modalidade = '<font color="blue">PIBIC_<font color="orange">EM</font> (Jr)';  $logo = 'img_pibice.jpg';break; 
		case 'CSF': $modalidade = '<font color="green">Ciência sem Fronteiras</font>';  $logo = 'img_csf.jpg';break; 
		case 'PIBITI': $modalidade = '<font color="BROWN">PIBITI</font>';  $logo = 'img_pibiti.jpg';break; 
	}
/////////////////////////////////////////////////// MANAGERS

echo '<img src="../img/'.$logo.'" align="right">';
echo '<h1>Iniciação Científica da PUCPR</h1>';
echo '<h3>'.$moda.' - PUCPR</h3>';
$menu = array();

if (date("m") >= 10)
	{
		array_push($menu,array('SEMIC','Site do SEMIC','http://www.pucpr.br/semic" target="_new'));
		array_push($menu,array('SEMIC','Trabalhos apresentados no SEMIC','semic_trabalhos.php?dd1='.$moda));		
	} else {
		if ($moda == 'PIBITI')
			{
				array_push($menu,array('Edital de aprovação','Aprovados com bolsa CNPq','edital.php?dd0=B&dd1='.$moda.'&dd2='.date("Y")));		
			} else {
				array_push($menu,array('Edital de aprovação','Aprovados com bolsa CNPq','edital.php?dd0=C&dd1='.$moda.'&dd2='.date("Y")));
			}
		array_push($menu,array('Edital de aprovação','Aprovados em todas as modalidades','edital.php?dd0=&dd1='.$moda.'&dd2='.date("Y")));
		array_push($menu,array('Edital de aprovação','Projetos não aprovados','edital.php?dd0=R&dd1='.$moda.'&dd2='.date("Y")));
	}
//array_push($menu,array('Edital de aprovação','Panorama dos projetos '.$modalidade,'edital_panorama.php?dd0=H&dd1='.$moda.'&dd2='.date("Y")));

array_push($menu,array('Formulário','Modelo do Projeto de Pesquisa','arq/2013/modelo_projeto_do_professor_'.$moda.'.doc'));
array_push($menu,array('Formulário','Modelo do Plano de trabalho do aluno','arq/2013/modelo_plano_de_aluno_'.$moda.'.doc'));
array_push($menu,array('Formulário','Caderno de Normas IC','arq/2013/cadernos_de_normas_2013.pdf'));
array_push($menu,array('Formulário','Ficha do Avaliador '.$modalidade,'arq/2013/modelo_ficha_avaliaca_'.$moda.'_2013.pdf'));
if ($moda == 'PIBITI')
	{
		array_push($menu,array('Formulário','Questionário de inovação','arq/2013/questionario_de_Inovacao.doc'));
	}
array_push($menu,array('Avaliação CNPq ','<b>Instruções para o avaliador CNPq</B>','link_cnpq_'.$moda.'.php'));
array_push($menu,array('Avaliação CNPq ','Link de acesso externo do CNPq','http://www.cnpq.br/web/guest/comite-externo-institucional'));
echo menus($menu,"3");

require("../foot.php");	
?>