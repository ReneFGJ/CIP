<?
$tabela = "reol_submit";
$cp = array();
array_push($cp,array('$H8','id_doc','id_doc',False,True,''));
array_push($cp,array('$S8','doc_protocolo','Protocolo',False,False,''));
array_push($cp,array('$Q title:section_id:select * from sections where journal_id = '.intval($journal_id).' order by seq','doc_section','Se��o',True,True,''));
array_push($cp,array('$S3','doc_ord','Ordem no sum�rio',True,True,''));
array_push($cp,array('$T80:3','doc_2_titulo','T�tulo Proj. Professor',False,True,''));
array_push($cp,array('$T80:3','doc_1_titulo','T�tulo Proj. Aluno',False,True,''));
array_push($cp,array('$T80:3','doc_autor','Autor',False,True,''));

array_push($cp,array('$S100','doc_1_key','Curso - Setor',False,True,''));
array_push($cp,array('$S100','doc_2_key','Nome do aluno/cracha',False,True,''));
array_push($cp,array('$S7','doc_3_key','Protocolo do aluno',True,True,''));

array_push($cp,array('$O -:Bolsa&P:PUCPR&C:CNPq&F:Funda��o Arauc�ria&I:ICV','doc_3_idioma','Bolsa',True,True,''));

array_push($cp,array('$T80:6','doc_1_resumo','Resumo',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.5
?>