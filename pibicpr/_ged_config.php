<?
/* ged */
require_once("../_class/_class_ged.php");
$ged = new ged;
$path = $_SERVER['SCRIPT_FILENAME'];
$path = troca($path,page(),'').'../pibic/document/';
$ged_up_path = $path; 
$ged_up_maxsize = 1024 * 1024 * 10; /* 10 Mega */
$ged_up_format = array('*');
$ged_up_month_control = 1; 
$ged_up_doc_type = $tipo;
$ged_del = 'delete';
$ged_tabela = 'pibic_ged_documento';

//if (($tipo == 'RELAP') or ($tipo == 'RELPC'))
	{
		/* Relatorio Parcial */
		$ged_up_format = array('.pdf');
	}
	
$ged = new ged;
$ged->up_maxsize = $ged_up_maxsize;
$ged->up_path = $ged_up_path; 
$ged->up_format = $ged_up_format;
$ged->up_month_control = $ged_up_month_control; 
$ged->up_doc_type = $ged_up_doc_type;
$ged->tabela = $ged_tabela;		
$ged->protocol = $dd[1];	
?>