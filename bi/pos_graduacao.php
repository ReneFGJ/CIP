<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','P�s-gradua��o'));

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
array_push($menu,array('Programas','P�s-Gradua��o','pos_graduacao_resume.php'));

if (strlen($programa_pos) == 0)
	{
					
	} else {
		echo '<h1>Programa de P�s-Gradua��o: <B>'.$programa_nome.'</B></h1>';
		
		if (strlen($programa_pos_anoi) == 0)
			{
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','Defini��o da Delimita��o da an�lise','pos_graduacao_0.php'));
			} else {
				echo '<h3>Base de an�lise: '.$programa_pos_anoi.' a '.$programa_pos_anof.'</h3>';
						
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','Delimita��o da an�lise entre '.$programa_pos_anoi.' e '.$programa_pos_anof,'pos_graduacao_0.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','Programa: <B>'.$programa_nome.'</B>',''));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Corpo Docente (3)','pos_graduacao_3.php')); 
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Compila��o de dados do programa (4)',''));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','____Publica��es Docentes (4a)','pos_graduacao_4.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','______Publica��es Docentes Lista (4a1)','pos_graduacao_4a1.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','____Publica��es Discentes (4b)','pos_graduacao_4a.php')); 
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Quinze melhores produ��es bibliogr�ficas (5)','pos_graduacao_5.php')); 
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Cinco melhores produ��es t�cnicas (6)','')); 
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Inova��es de Destaque e Repercuss�es (7)',''));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Fluxo Discente (8)','pos_graduacao_8.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Reconhecimento Internacional (9)','pos_graduacao_9.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Inser��o Social (10)',''));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Aspectos Relevantes (11)',''));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Metas Previstas para 2013 (12)',''));		
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Rela��o Discente (12)','pos_graduacao_20.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Capta��o de Recursos (12)','pos_graduacao_21.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Capta��o de Recursos vigentes (12)','pos_graduacao_23.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Orienta��o PIBIC/PIBITI (12)','pos_graduacao_22.php'));
				array_push($menu,array('Relat�rio Consultor Externo - Convidado','__Professor com artigos bonificados','pos_graduacao_30.php'));
			}
	}
 
if (($perfil->valid('#ADM#SCR#COO')))
	{
	array_push($menu,array('Produ��o Cient�fica','Produ��o em Revistas','producao_revistas.php'));
	array_push($menu,array('Produ��o Cient�fica','Avalia��o por tri�nio - Peri�dicos',''));

	for ($r=2004;$r <= date("Y");$r=$r+3)
		{
			$d1 = $r;
			$d2 = $d1+2;
			array_push($menu,array('Produ��o Cient�fica','__Tri�nio ('.$d1.'-'.$d2.')','producao_cientifica.php?dd0='.$d1.'&dd1='.$d2));
		}

	array_push($menu,array('Produ��o Cient�fica','Avalia��o por tri�nio - Forma��o de RH',''));

	for ($r=2004;$r <= date("Y");$r=$r+3)
		{
			$d1 = $r;
			$d2 = $d1+2;
			array_push($menu,array('Produ��o Cient�fica','__Tri�nio ('.$d1.'-'.$d2.')','iniciacao_cientifica.php?dd0='.$d1.'&dd1='.$d2));
		}

	array_push($menu,array('Produ��o Cient�fica','Avalia��o por tri�nio - Capta��o',''));

	for ($r=2004;$r <= date("Y");$r=$r+3)
		{
			$d1 = $r;
			$d2 = $d1+2;
			array_push($menu,array('Produ��o Cient�fica','__Tri�nio ('.$d1.'-'.$d2.')','captacoes_programa.php?dd0='.$d1.'&dd1='.$d2));
		}	 
	}																
	$tela = menus($menu,"3");

 require("../foot.php");	
 ?>