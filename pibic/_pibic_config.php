<?
/* ged */
$path = $_SERVER['SCRIPT_FILENAME'];
$path = troca($path,page(),'').'document/';
$ged_up_path = '/'; 
$ged_up_maxsize = 1024 * 1024 * 10; /* 10 Mega */
$ged_up_format = array('.doc','.docx','.pdf');
$ged_up_month_control = 1; 
$ged_up_doc_type;
$ged_tabela = '';
?>