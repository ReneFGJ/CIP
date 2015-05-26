<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pós-graduação'));

require("cab_bi.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();

		$programa_nome = $_SESSION['pos_nome'];
		$programa_pos = $_SESSION['pos_codigo'];
		$programa_pos_anoi = $_SESSION['pos_anoi'];
		$programa_pos_anof = $_SESSION['pos_anof'];
		//if (strlen($programa_pos_anoi)==0) { $programa_pos_anoi = 1996; }
		//if (strlen($programa_pos_anof)==0) { $programa_pos_anof = date("Y"); }
		
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Programas','Pós-Graduação','pos_graduacao_resume.php'));

if (strlen($programa_pos) == 0)
	{
					
	} else {
		echo '<h1>Programa de Pós-Graduação: <B>'.$programa_nome.'</B></h1>';
		
		if (strlen($programa_pos_anoi) == 0)
			{
				array_push($menu,array('Relatório Consultor Externo - Convidado','Definição da Delimitação da análise','pos_graduacao_0.php'));
			} else {
				echo '<h3>Base de análise: '.$programa_pos_anoi.' a '.$programa_pos_anof.'</h3>';
						
				array_push($menu,array('Relatório Consultor Externo - Convidado','Delimitação da análise entre '.$programa_pos_anoi.' e '.$programa_pos_anof,'pos_graduacao_0.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','Programa: <B>'.$programa_nome.'</B>',''));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Corpo Docente (3)','pos_graduacao_3.php')); 
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Compilação de dados do programa (4)',''));
				array_push($menu,array('Relatório Consultor Externo - Convidado','____Publicações Docentes (4a)','pos_graduacao_4.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','______Publicações Docentes Lista (4a1)','pos_graduacao_4a1.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','____Publicações Discentes (4b)','pos_graduacao_4a.php')); 
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Quinze melhores produções bibliográficas (5)','pos_graduacao_5.php')); 
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Cinco melhores produções técnicas (6)','')); 
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Inovações de Destaque e Repercussões (7)',''));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Fluxo Discente (8)','pos_graduacao_8.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Reconhecimento Internacional (9)','pos_graduacao_9.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Inserção Social (10)',''));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Aspectos Relevantes (11)',''));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Metas Previstas para 2013 (12)',''));		
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Relação Discente (12)','pos_graduacao_20.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Captação de Recursos (12)','pos_graduacao_21.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Captação de Recursos vigentes (12)','pos_graduacao_23.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Orientação PIBIC/PIBITI (12)','pos_graduacao_22.php'));
				array_push($menu,array('Relatório Consultor Externo - Convidado','__Professor com artigos bonificados','pos_graduacao_30.php'));
			}
	}
 
if (($perfil->valid('#ADM#SCR#COO')))
	{
	array_push($menu,array('Produção Científica','Produção em Revistas','producao_revistas.php'));
	array_push($menu,array('Produção Científica','Avaliação por triênio - Periódicos',''));

	for ($r=2004;$r <= date("Y");$r=$r+3)
		{
			$d1 = $r;
			$d2 = $d1+2;
			array_push($menu,array('Produção Científica','__Triênio ('.$d1.'-'.$d2.')','producao_cientifica.php?dd0='.$d1.'&dd1='.$d2));
		}

	array_push($menu,array('Produção Científica','Avaliação por triênio - Formação de RH',''));

	for ($r=2004;$r <= date("Y");$r=$r+3)
		{
			$d1 = $r;
			$d2 = $d1+2;
			array_push($menu,array('Produção Científica','__Triênio ('.$d1.'-'.$d2.')','iniciacao_cientifica.php?dd0='.$d1.'&dd1='.$d2));
		}

	array_push($menu,array('Produção Científica','Avaliação por triênio - Captação',''));

	for ($r=2004;$r <= date("Y");$r=$r+3)
		{
			$d1 = $r;
			$d2 = $d1+2;
			array_push($menu,array('Produção Científica','__Triênio ('.$d1.'-'.$d2.')','captacoes_programa.php?dd0='.$d1.'&dd1='.$d2));
		}	 
	}																
	$tela = menus($menu,"3");

 require("../foot.php");	
 ?>