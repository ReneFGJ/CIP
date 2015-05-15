<?
$breadcrumbs=array();
$include = '../';
require("../db.php");

require("../_class/_class_lattes.php");

require("../_class/_class_bi.php");
$bi = new bi;
$bi->ano_ini = $dd[1];
$bi->ano_fim = $dd[1];

//header("Content-Type: application/vnd.ms-excel; charset=utf-8");

//header("Content-type: application/x-msexcel; charset=iso-8859-1");
//header("Content-type: application/x-msexcel; charset=utf-8");
header("Content-type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=estatistica_".date("Y-m-d").".xls"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Transfer-Encoding: binary");
echo '<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>';

/* Professores com projetos de captacao aprovados e andamento
 * Campus, escola, programa
 */
echo trim($bi->professor_com_captacao());

 /* Captacao de Recursos via Agência d Fomento e Governamentais
  * Campus, escola, programa
  */
echo trim($bi->professor_com_captacao_ag_gov());

 /* Mobilidade Internacional Docente - SS
  * Campus, escola, programa
  */
echo trim($bi->mobilidade_docente()); 

 /* Mobilidade Internacional Discente - SS 
  * Campus, escola, programa
  */
echo trim($bi->mobilidade_discente());
 /* Nível de produção Qualificada - PPG
  * Campus, escola, programa
  */
echo trim($bi->producao_docente());

?>