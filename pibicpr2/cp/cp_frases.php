<?
require($include."sisdoc_editor.php");
$tabela = "frases";
$op = 'instrution:Instru��es para autores';
$op .= '&editor:Corpo editorial';
$op .= '&about:Sobre a revista';
$op .= '&progr:Programa��o';
$op .= '&faq:FAQ';
$op .= '&edital:Edital';
$op .= '&contact:Contato';
$cp = array();
$qh = 'where ((journal_id = '.intval($journal_id).') or (journal_id = 34)) ';
array_push($cp,array('$H8','id_fr','id_fr',False,True,''));
array_push($cp,array('$Q title:journal_id:select * from journals '.$wh.' order by upper(asc7(title))','journal_id','Journal',True,True,''));
array_push($cp,array('$O '.$op,'fr_word','Tipo',False,True,''));
//array_push($cp,array('$T70:7','fr_texto','Dados',False,True,''));
array_push($cp,array('$E600:400','fr_texto','Dados',False,True,''));
array_push($cp,array('$O pt_BR:Portugues&en:Ingl�s&es:Espanhol&fr:Franc�s','fr_idioma','Idioma',True,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.5
?>