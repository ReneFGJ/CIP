<?
$tabela = "submit_crono_orca";

$cp = array();
array_push($cp,array('$H8','id_ocr','id_sa',False,True,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','ocr_journal_id','Journal',True,True,''));
array_push($cp,array('$S80','ocr_descricao','Abrev. titulacao',False,True,''));
array_push($cp,array('$H8','ocr_codigo','Tipo',False,True,''));
array_push($cp,array('$O 1:Orçamento&2:cronograma','ocr_tipo','Tipo',True,True,''));
array_push($cp,array('$I8','ocr_ordem','Ordem de mostragem',True,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','ocr_ativo','Ativo',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.5
?>