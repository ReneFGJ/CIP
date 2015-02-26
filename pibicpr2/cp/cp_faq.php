<?
$tabela = "faq";

$cp = array();
array_push($cp,array('$H8','id_faq','id_faq',False,True,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','faq_journal_id','Journal',True,True,''));
array_push($cp,array('$T60:5','faq_pergunta','Pergunta',True,True,''));
array_push($cp,array('$T60:5','faq_resposta','Resposta',True,True,''));
array_push($cp,array('$[1-50]','faq_ordem','Ordem',False,True,''));
array_push($cp,array('$O 1:SIM&0:NГO','faq_ativo','Ativo',False,True,''));
array_push($cp,array('$O 001:FAQ (Revista)&002:FAQ (Editores - Todos)&003:Glossбrio','faq_seccao','Seзгo',False,True,''));
array_push($cp,array('$O pt_BR:Portugues&en:Inglкs','faq_idioma','Idioma',True,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.5
?>