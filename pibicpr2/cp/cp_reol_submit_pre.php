<?
$tabela = "reol_submit";
$cp = array();
array_push($cp,array('$H8','id_doc','id_doc',False,True,''));
array_push($cp,array('$S8','doc_protocolo','Protocolo',False,False,''));
array_push($cp,array('$Q title:section_id:select * from sections where journal_id = '.intval($journal_id).' order by seq','doc_section','Seção',True,True,''));
array_push($cp,array('$S3','doc_ord','Ordem no sumário',True,True,''));
array_push($cp,array('$T80:3','doc_2_titulo','Título Proj. Professor',False,True,''));
array_push($cp,array('$T80:3','doc_1_titulo','Título Proj. Aluno',False,True,''));
array_push($cp,array('$T80:3','doc_autor','Autor',False,True,''));

array_push($cp,array('$S100','doc_1_key','Curso - Setor',False,True,''));
array_push($cp,array('$S100','doc_2_key','Nome do aluno/cracha',False,True,''));
array_push($cp,array('$S7','doc_3_key','Protocolo do aluno',True,True,''));

array_push($cp,array('$O -:Bolsa&P:PUCPR&C:CNPq&F:Fundação Araucária&I:ICV','doc_3_idioma','Bolsa',True,True,''));

array_push($cp,array('$T80:6','doc_1_resumo','Resumo',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.5
?>