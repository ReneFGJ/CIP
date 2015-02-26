<?
$tabela = "articles";
$cp = array();
$nc = $nucleo.":".$nucleo;

$dd[9] = troca($dd[9],chr(13),'');
$dd[9] = troca($dd[9],chr(10),'');

$dd[14] = troca($dd[14],chr(13),'');
$dd[14] = troca($dd[14],chr(10),'');

array_push($cp,array('$H4','id_article','id_article',False,False,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','journal_id','Layout',True,True,''));
array_push($cp,array('$Q title:id_issue:select \'v. \' || issue_volume || chr(32) || \'n. \' || issue_number || chr(32) ||  issue_year as title, * from issue where journal_id = '.intval($journal_id).' order by issue_year desc , issue_volume desc, issue_number desc','article_issue','Ediзгo',True,True,''));
array_push($cp,array('$Q title:section_id:select * from sections where journal_id = '.intval($journal_id).' order by seq','article_section','Seзгo',True,True,''));
array_push($cp,array('$[1-199]','article_seq','Ordem para mostrar',True,True,''));
/////
array_push($cp,array('$A','','Autor(es)',False,True,''));
array_push($cp,array('$T60:5','','Texto para processar',False,True,''));
/////
array_push($cp,array('$A','','Autor(es)',False,True,''));
array_push($cp,array('$T60:9','article_author','Autores',False,True,''));

///// Primeira parte
array_push($cp,array('$A','','Primeiro Idioma',False,True,''));
array_push($cp,array('$T60:2','article_title','Tнtulo original',True,True,''));
array_push($cp,array('$T60:12','article_abstract','Resumo/Abstract',False,False,''));
array_push($cp,array('$T60:2','article_keywords','Palavra chave',False,True,''));
array_push($cp,array('$O pt_BR:Portugues&en:Ingles&fr:Francкs&es:Espanhol','article_idioma','Idioma',False,True,''));
///// Segunda parte
array_push($cp,array('$A','','Segundo Idioma',False,True,''));
array_push($cp,array('$T60:2','article_2_title','Tнtulo alternativo',False,True,''));
array_push($cp,array('$T60:12','article_2_abstract','Resumo/Abstract',False,False,''));
array_push($cp,array('$T60:2','article_2_keywords','Palavra chave',False,True,''));
array_push($cp,array('$O en:Ingles&pt_BR:Portugues&fr:Francкs&es:Espanhol','article_2_idioma','Idioma',False,True,''));
/////////////////////
array_push($cp,array('$A','','Dados sobre o documento',False,True,''));
array_push($cp,array('$S20','article_pages','Pбginas',False,True,''));
array_push($cp,array('$D8','article_dt_envio','Enviado em',True,True,''));
array_push($cp,array('$D8','article_dt_aceite','Aceito em',True,True,''));
array_push($cp,array('$D8','article_dt_revisao','Revisado em',True,True,''));

array_push($cp,array('$O S:SIM&N:NГO&X:CANCELADO','article_publicado','Publicado',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>