<?
$tabela = "journals";
$cp = array();
$nc = $nucleo.":".$nucleo;
array_push($cp,array('$H4','journal_id','journal_id',False,False,''));
array_push($cp,array('$A4','','Dados pessoais',False,True,''));
array_push($cp,array('$S200','jn_title','Tнtulo da publicaзгo',True,True,''));
array_push($cp,array('$S200','title','Tнtulo abreviado (para citaзгo)',True,True,''));
array_push($cp,array('$T50:5','description','Descriзгo da publicaзгo',False,True,''));
array_push($cp,array('$S30','path','Path',True,True,''));

array_push($cp,array('$[1-40]','seq','Seq',True,True,''));
array_push($cp,array('$O 1:Sim&0:Nгo','enabled','Habilitado',True,True,''));
array_push($cp,array('$Q layout_descricao:layout_cod:select * from layout where layout_ativo = '.chr(39).'S'.chr(39).' order by layout_descricao ','layout','Layout',True,True,''));
array_push($cp,array('$S30','journal_issn','ISSN (rev. impressa)',False,True,''));
array_push($cp,array('$S8','jn_bgcor','Cor',True,True,''));
array_push($cp,array('$S60','jn_id','ID',True,True,''));
array_push($cp,array('$S100','jn_http','OAI-http',True,True,''));
array_push($cp,array('$S100','jn_email','e-mail administrador',True,True,''));

array_push($cp,array('$O S:Sim&N:Nгo','jn_send','Submissгo on-line',True,True,''));
array_push($cp,array('$O 0:Nгo&1:Sim','jn_send_suspense','Submissгo on-line suspensa',False,True,''));

array_push($cp,array('$O S:Sim&N:Nгo','jn_noticia','Notнcias',False,True,''));
array_push($cp,array('$O S:Sim&N:Nгo','jn_suplemento','Suplemento',False,True,''));
//////////////////////// Novos campos
array_push($cp,array('$S15','jn_eissn','e-ISSN (rev. eletronico)',False,True,''));
array_push($cp,array('$S15','jn_isbn','ISBN (livro)',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>