<?
$tabela = "sections";
$cp = array();
array_push($cp,array('$H8','section_id','id_ed',False,True,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.$journal_id,'journal_id','Publicaзгo',False,True,''));
array_push($cp,array('$S120','title','Titulo da seзгo',True,True,''));
array_push($cp,array('$S20','abbrev','Abreviatura',False,True,''));
array_push($cp,array('$[1-20]','seq','Ordem para mostrar',False,True,''));
array_push($cp,array('$O 0:NГO&1:SIM','editor_restricted','Nome Abreviado',False,True,''));
array_push($cp,array('$O 1:SIM&0:NВO','meta_indexed','Indexado',False,True,''));
array_push($cp,array('$O 0:NГO&1:SIM','hide_title','Titulo oculto',False,True,''));
array_push($cp,array('$O 1:SIM&0:NВO','abstracts_disabled','Resumo',False,True,''));
array_push($cp,array('$U8','identify_type','Identificaзгo',False,True,''));
array_push($cp,array('$T60:5','policy','Politica',False,True,''));



/// Gerado pelo sistem "base.php" versao 1.0.5
?>