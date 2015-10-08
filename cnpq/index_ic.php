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
//array_push($menu,array('Edital de aprova��o','Panorama dos projetos '.$modalidade,'edital_panorama.php?dd0=H&dd1='.$moda.'&dd2='.date("Y")));

array_push($menu,array('Formul�rio','Modelo do Projeto de Pesquisa','arq/'.$ano.'/modelo_projeto_do_professor_'.$moda.'.doc'));
array_push($menu,array('Formul�rio','Modelo do Plano de trabalho do aluno','arq/'.$ano.'/modelo_plano_de_aluno_'.$moda.'.doc'));
array_push($menu,array('Formul�rio','Caderno de Normas IC','arq/'.$ano.'/cadernos_de_normas.pdf'));
array_push($menu,array('Formul�rio','Ficha do Avaliador '.$modalidade,'arq/'.$ano.'/modelo_ficha_avaliaca_'.$moda.'.pdf'));
if ($moda == 'PIBITI')
	{
		array_push($menu,array('Formul�rio','Question�rio de inova��o','arq/'.$ano.'/questionario_de_Inovacao.doc'));
	}
array_push($menu,array('Avalia��o CNPq ','<b>Instru��es para o avaliador CNPq</B>','link_cnpq_'.$moda.'.php'));
array_push($menu,array('Avalia��o CNPq ','Link de acesso externo do CNPq','http://www.cnpq.br/web/guest/comite-externo-institucional'));

array_push($menu,array('Recursos/Reconsidera��o','Pedidos de Reconsidera��o/Recursos','recursos_lista.php?dd1='.$moda));

echo menus($menu,"3");

require("../foot.php");	
?>